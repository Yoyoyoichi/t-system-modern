<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^", $_POST["data"]);
// var_dump ($pieces);
$questionnumber = $pieces[0];///
$DB_name =  $pieces[1];
$db_name =  $pieces[1];
$poorat = $pieces[2];
$getPastTime = $pieces[3];

$pieces = explode(".", $_POST["data"]);

$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');


if( $mysql->connect_errno){
    echo 'Access Failed7';//接続失敗
    exit;
}


$sql = "DELETE FROM $db_name WHERE questionnumber = $questionnumber";


echo "sql is ".$sql."\n"."\n";
// // SQL実行
$res = $mysqli->query($sql);


?>
