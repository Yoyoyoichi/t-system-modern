<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^", $_POST["data"]);
$db_name =  $pieces[0];
$information = $pieces[1];


require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();


if( $mysql->connect_errno){
    echo 'Access Failed7';//謗･邯壼､ｱ謨・
    exit;
}

$str_sql = "SELECT min(questionnumber) FROM $db_name";
$result = $mysqli->query($str_sql);
$test  = $result->fetch_assoc();
$minimum = $test['min(questionnumber)'];
// // //繝・・繧ｿ譖ｴ譁ｰ
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

// // SQL螳溯｡・
$res = $mysqli->query($sql);



?>

