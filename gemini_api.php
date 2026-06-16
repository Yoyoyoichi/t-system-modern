<?php
// gemini_api.php
// T-SystemからGemini APIを呼び出すためのバックエンド用スクリプト

header('Content-Type: application/json; charset=utf-8');

// POSTリクエストからJSONデータを取得
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!isset($data['prompt']) || empty($data['prompt'])) {
    echo json_encode(['error' => 'プロンプトが空です']);
    exit;
}

$prompt = $data['prompt'];

// ----------------------------------------------------
// 【重要】ここにGoogle AI Studioで取得したAPIキーを入力してください
// ----------------------------------------------------
$apiKey = 'YOUR_GEMINI_API_KEY_HERE'; 

// Gemini APIのエンドポイント (gemini-1.5-flashを推奨)
$url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey;

// 送信するデータ構造
$postData = [
    'contents' => [
        [
            'parts' => [
                ['text' => $prompt]
            ]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if(curl_errno($ch)){
    echo json_encode(['error' => 'cURLエラー: ' . curl_error($ch)]);
} else if ($httpcode >= 400) {
    echo json_encode(['error' => 'APIエラー', 'details' => json_decode($response)]);
} else {
    // 成功時、そのままGemini APIからのJSONをフロントに返す
    echo $response;
}

curl_close($ch);
?>
