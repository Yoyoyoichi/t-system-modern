<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode(".", $_POST["data"]);
// var_dump ($pieces);
$DB_name =  $pieces[0];///
$novelNumber = $pieces[1];///
$novel = $pieces[2];
// echo $pieces[0];
require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();


if( $mysql->connect_errno){
    echo 'Access Failed7';//謗･邯壼､ｱ謨・
    exit;
}

$sql = "UPDATE $DB_name SET
    category1 = $novel
    category2 = $novelNumber
    WHERE where  question = 'settings'";
// echo $sql;    
$result = $mysqli->query($sql);

$query = "SELECT sentence FROM `Novels` where (RowNumber = $novelNumber) AND (novel = '$novel') ";
$result = $mysqli->query($query);
$result = $result->fetch_assoc();
$result = $result['sentence'];//
// echo $query;
echo $result;
?>

