<?php
require_once('jsonconfig.php');
require_once('jsonfunctions.php');

mb_language("uni");
mb_internal_encoding("utf-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("utf-8");

$dbh = connectDb();

$sth = $dbh->prepare("SELECT * FROM Yutaka0625Z");
$sth->execute();

$userData = array();

while($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $userData[]=array(
    'question'=>$row['question'],
    'answer1'=>$row['answer1'],
    'category1'=>$row['category1'],
    'category2'=>$row['category2']
    );
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($userData);