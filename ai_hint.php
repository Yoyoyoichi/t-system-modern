<?php
// ai_hint.php
// Gemini APIを利用して問題文からヒント・解説を生成するバックエンドエンドポイント

// ==========================================
// 【重要】ここにGoogle GeminiのAPIキーを設定してください
// ==========================================
$api_key = "AIzaSyBHvYkCZIPlH4EaHcUsHChqBPDLHTNnamw";

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

// ---------------------------------------------------------
// AIへのプロンプト（指示）の構成
// ---------------------------------------------------------
if ($is_answer_revealed) {
    // 解答表示後：解説のみ
    $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーはすでにこの問題の解答を確認しました。\nこの問題のわかりやすい「解説」を行ってください。\n\n【重要】回答は非常に簡潔に、全体で「3行程度」に収めてください。問題文や解答自体を繰り返す必要はありません。語源情報や記憶に残るような新しい視点だけを端的に提供してください。";
    
    $user_message = "以下の問題についての解説をお願いします。\n\n【問題】\n" . $question . "\n\n【正解】\n" . $answer;
} else {
    // 解答表示前：直接的な答えを言わずにヒントだけ
    $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーが提示した問題文に対して、直接的な答え（正解）は絶対に教えず、ユーザー自身が答えにたどり着けるような「解き方のヒント」や「関連する考え方」だけを簡潔に提供してください。\n\n【重要】回答は非常に簡潔に、全体で「3行程度」に収めてください。問題文の情報をそのまま繰り返す必要はありません。語源情報や、推測の足がかりとなるような新しい視点だけを端的に提示してください。";
    
    $user_message = "以下の問題に対するヒントを教えてください。\n\n【問題】\n" . $question;
    if ($answer) {
        $user_message .= "\n\n（※システム注: 実際の正解は「" . $answer . "」です。この正解テキストをそのまま出力しないようにヒントを組み立ててください。）";
    }
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

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key=" . $api_key;

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
    
    // If it's a 50x error (like 503), wait and retry
    if ($http_status >= 500 && $http_status < 600 && $attempt < $max_retries) {
        sleep($retry_delay);
        $retry_delay *= 2; // Exponential backoff
        continue;
    }
    // Success or client error (4xx) -> break out and handle it
    break;
}

curl_close($ch);

if ($http_status !== 200) {
    echo json_encode(['error' => 'API Error: ' . $http_status . ' (リトライ後)', 'details' => $result]);
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
