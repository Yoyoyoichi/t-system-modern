<?php
// ai_hint.php
// OpenAI APIを利用して問題文からヒント・解説を生成するバックエンドエンドポイント

// ==========================================
// 【重要】ここにOpenAIのAPIキーを設定してください
// ==========================================
$api_key = "YOUR_OPENAI_API_KEY_HERE";

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
    // 解答表示後：解説と過去の状況に対するコメント
    $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーはすでにこの問題の解答を確認しました。\nこの問題のわかりやすい「解説」を行ってください。\n\nさらに、ユーザーの過去の解答記録が提供されるので、それに基づいて『最近正解できているか』『苦手な問題になっているか』『久しぶりの復習か』などを分析し、ユーザーへ向けた「コメント（励ましやアドバイス）」を必ず回答に含めてください。";
    
    $user_message = "以下の問題についての解説と、私の学習状況へのコメントをお願いします。\n\n【問題】\n" . $question . "\n\n【正解】\n" . $answer;
    if ($history_text) {
        $user_message .= "\n\n【私の解答記録】\n" . $history_text;
    }
} else {
    // 解答表示前：直接的な答えを言わずにヒントだけ
    $system_prompt = "あなたは優秀な学習サポートAIです。ユーザーが提示した問題文に対して、直接的な答え（正解）は絶対に教えず、ユーザー自身が答えにたどり着けるような「解き方のヒント」や「関連する考え方」だけを簡潔に提供してください。";
    
    $user_message = "以下の問題に対するヒントを教えてください。\n\n【問題】\n" . $question;
    if ($answer) {
        $user_message .= "\n\n（※システム注: 実際の正解は「" . $answer . "」です。この正解テキストをそのまま出力しないようにヒントを組み立ててください。）";
    }
}

// ---------------------------------------------------------
// OpenAI APIとの通信 (cURL)
// ---------------------------------------------------------
if ($api_key === "YOUR_OPENAI_API_KEY_HERE") {
    echo json_encode([
        'hint' => "【APIキーが設定されていません】\nai_hint.php の上部にある \$api_key に有効なOpenAIのAPIキーを設定すると、AIからの回答がここに表示されます！\n\n設定されるプロンプトの内容：\n" . $system_prompt . "\n\n送信データ：\n" . $user_message
    ]);
    exit;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $api_key
]);

$payload = [
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role" => "system", "content" => $system_prompt],
        ["role" => "user", "content" => $user_message]
    ],
    "max_tokens" => 800,
    "temperature" => 0.7
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
$result = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_status !== 200) {
    echo json_encode(['error' => 'API Error: ' . $http_status, 'details' => $result]);
    exit;
}

$response_data = json_decode($result, true);
if (isset($response_data['choices'][0]['message']['content'])) {
    $hint = $response_data['choices'][0]['message']['content'];
    echo json_encode(['hint' => $hint]);
} else {
    echo json_encode(['error' => 'Unexpected API response format', 'details' => $result]);
}
?>
