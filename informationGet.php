<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^", $_POST["data"]);
$db_name =  $pieces[0];
$information = $pieces[1];


$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');


if( $mysql->connect_errno){
    echo 'Access Failed7';//接続失敗
    exit;
}

$str_sql = "SELECT min(questionnumber) FROM $db_name";
$result = $mysqli->query($str_sql);
$test  = $result->fetch_assoc();
$minimum = $test['min(questionnumber)'];
// // //データ更新
// $sql = "UPDATE $db_name SET
//     information = '$information'
//     WHERE questionnumber = $minimum";

// $res = $mysqli->query($sql);
$str_sql = "SELECT information FROM $db_name where questionnumber = $minimum";
$result = $mysqli->query($str_sql);
$test  = $result->fetch_assoc();
$information = $test['information'];

// echo "sql is ".$sql."\n"."\n";
echo $information;

// // SQL実行
$res = $mysqli->query($sql);



?>
