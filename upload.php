<?php
// アップロードディレクトリのパスを設定します
$uploadDir = 'uploads/';

// ファイルが正しくアップロードされたかを確認します
if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'ファイルのアップロード中にエラーが発生しました']);
    exit();
}

// 一意のファイル名を生成します
$fileName = uniqid() . '_' . basename($_FILES['file']['name']);
$uploadPath = $uploadDir . $fileName;

// ファイルをアップロードします
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
    echo json_encode(['message' => 'ファイルがアップロードされました', 'file_name' => $fileName]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'ファイルのアップロード中にエラーが発生しました']);
}
?>