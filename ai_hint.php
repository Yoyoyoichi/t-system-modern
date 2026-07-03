<?php
// ai_hint.php
// Gemini APIを利用して問題文からヒント・解説を生成するバックエンドエンドポイント

// ==========================================
// 【重要】ここにGoogle GeminiのAPIキーを設定してください
// ==========================================
$api_key = "AIzaSyBHvYkCZIPlH4EaHcUsHChqBPDLHTNnamw";
$model = "gemini-2.5-flash-lite";

header('Content-Type: application/json');

// POSTリクエストからJSONデータを取得
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['question'])) {
    echo json_encode(['error' => 'Question text is required.']);
    exit;
}

$question = $data['question'];
$answer = isset($data['answer']) ? $data['answer'] : '';
$is_answer_revealed = isset($data['is_answer_revealed']) ? $data['is_answer_revealed'] : false;
$history_text = isset($data['history_text']) ? $data['history_text'] : '';

$depth = isset($data['depth']) ? intval($data['depth']) : 1;

$previous_hints = isset($data['previous_hints']) ? trim($data['previous_hints']) : '';

// ---------------------------------------------------------
// AIへのプロンプト（指示）の構成
// ---------------------------------------------------------
if ($is_answer_revealed) {
    if ($depth == 1) {
        // 解答表示後（1回目）：解説のみ
        $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーはすでにこの問題の解答を確認しました。\nこの問題のわかりやすい「解説」を行ってください。\n\n【重要】回答は全体で「4〜5行程度」に収めてください。学習者が楽しく記憶に定着させやすいように「語源」「暗記法」「イメージ法」「面白い語呂合わせ（ダジャレ等）」のいずれかを簡潔に盛り込み、さらに必ず【短い例文を1つ】含めてください。問題文や解答自体をそのまま繰り返す必要はありません。";
        $user_message = "以下の問題についての解説をお願いします。\n\n【問題】\n" . $question . "\n\n【正解】\n" . $answer;
    } else if ($depth == 2) {
        // 解答表示後（2回目）：深掘り
        $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーは一度解説を読みましたが、さらに深い情報を求めています。\n\n【重要】回答は全体で「4〜5行程度」に収めてください。前回とは異なる視点で、記憶に残る語源の解説や強烈なイメージ法、ひねりの効いた語呂合わせなどを簡潔に提供し、必ず【別の短い例文を1つ】含めてください。";
        $user_message = "以下の問題について、もっと深掘りした解説や、別の角度からの暗記法（語源や語呂合わせなど）、そして例文を1つお願いします。\n\n【問題】\n" . $question . "\n\n【正解】\n" . $answer;
    } else {
        // 解答表示後（3回目以降）：さらに深掘り
        $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーはさらに高度な情報を求めています。\n\n【重要】回答は全体で「4〜5行程度」に収めてください。同義語・反意語との使い分けなどを説明しつつ、ユーモアを交えた独自の暗記法や語源を提案し、必ず【実用的な例文を1つ】含めてください。";
        $user_message = "以下の問題について、さらに高度で実践的な知識（類義語の使い分けなど）と、それを覚えるための面白いイメージ法や語源、そして例文を1つ教えてください。\n\n【問題】\n" . $question . "\n\n【正解】\n" . $answer;
    }
} else {
    if ($depth == 1) {
        // 解答表示前（1回目）：直接的な答えを言わずにヒントだけ
        $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーが提示した問題文に対して、直接的な答え（正解）は絶対に教えず、ユーザー自身が答えにたどり着けるような「解き方のヒント」や「関連する考え方」を提供してください。\n\n【重要】回答は全体で「4〜5行程度」に収めてください。答えを伏せたまま、記憶のトリガーとなるような「語源」「イメージ」「語呂合わせのヒント」などを提供し、さらに答えの単語を使った【短い例文を1つ（重要箇所は伏せ字で）】含めてください。";
        $user_message = "以下の問題の答えを自力で出したいので、答えは言わずにヒント（語源やイメージ、伏せ字の例文など）をください。\n\n【問題】\n" . $question;
    } else {
        // 解答表示前（2回目以降）：さらに大きなヒント
        $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーは最初のヒントでは答えが分かりませんでした。直接的な答え（正解）は絶対に教えずに、もう少し踏み込んだ「決定的なヒント」を提供してください。\n\n【重要】回答は全体で「4〜5行程度」に収めてください。強力なイメージや語呂合わせの「前半部分」、語源などを交えて答えを閃かせるサポートをし、さらに【別の短い例文を1つ（重要箇所は伏せ字で）】含めてください。";
        $user_message = "最初のヒントでは分かりませんでした。答えは言わずに、もう少しだけ決定的なヒント（強力なイメージや語呂合わせ、伏せ字の例文など）をください。\n\n【問題】\n" . $question;
    }
    if ($answer) {
        $user_message .= "\n\n（※システム注: 実際の正解は「" . $answer . "」です。この正解テキストをそのまま出力しないようにヒントを組み立ててください。）";
    }
}

if ($previous_hints && $depth > 1) {
    $user_message .= "\n\n【これまでに出た解説・ヒント】\n" . $previous_hints . "\n\n（※上記の内容と被らないように、新しい情報で続きを解説してください）";
}

// ---------------------------------------------------------
// Gemini APIとの通信 (cURL)
// ---------------------------------------------------------
if (empty($api_key) || $api_key === "YOUR_OPENAI_API_KEY_HERE") {
    echo json_encode([
        'hint' => "【APIキーが正しく設定されていません】\nai_hint.php に有効なAPIキーを設定してください。"
    ]);
    exit;
}

$url = "https://generativelanguage.googleapis.com/v1beta/models/" . $model . ":generateContent?key=" . $api_key;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);

$payload = [
    "system_instruction" => [
        "parts" => [
            ["text" => $system_prompt]
        ]
    ],
    "contents" => [
        [
            "role" => "user",
            "parts" => [
                ["text" => $user_message]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 0.7,
        "maxOutputTokens" => 8192
    ]
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

$max_retries = 3;
$retry_delay = 1; // seconds
$http_status = 0;
$result = false;

for ($attempt = 1; $attempt <= $max_retries; $attempt++) {
    $result = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // If it's a 50x error (like 503) or 429 (Too Many Requests), wait and retry
    if (($http_status == 429 || ($http_status >= 500 && $http_status < 600)) && $attempt < $max_retries) {
        sleep($retry_delay);
        $retry_delay *= 2; // Exponential backoff
        continue;
    }
    // Success or client error (4xx) -> break out and handle it
    break;
}

curl_close($ch);

if ($http_status !== 200) {
    if ($http_status == 429) {
        $error_msg = "API制限に達しました（1分間の回数上限）。約1分ほど待ってからもう一度お試しください。";
    } else {
        $error_msg = 'API Error: ' . $http_status . ' (リトライ後)';
    }
    echo json_encode(['error' => $error_msg, 'details' => $result]);
    exit;
}

$response_data = json_decode($result, true);
if (isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
    $hint = $response_data['candidates'][0]['content']['parts'][0]['text'];
    echo json_encode(['hint' => $hint]);
} else {
    echo json_encode(['error' => 'Unexpected API response format', 'details' => $result]);
}
?>
