<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^", $_POST["data"]);
// var_dump ($pieces);
$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
// $db_name =  $pieces[1];
// $poorat = $pieces[2];
// $getPastTime = $pieces[3];

$pieces = explode(".", $_POST["data"]);

require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();


if( $mysql->connect_errno){
    echo 'Access Failed7';//謗･邯壼､ｱ謨・
    exit;
}


$sql = "DELETE FROM ChordProgressions WHERE name = '$questionnumber'";


echo "sql is ".$sql."\n"."\n";
// // SQL螳溯｡・
$res = $mysqli->query($sql);


?>

