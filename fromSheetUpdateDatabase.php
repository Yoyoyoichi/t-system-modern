<?php
// error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^^^^^", $_POST["data"]);
// echo "modifyqa pieces is".$pieces."\n"."\n";
var_dump ($pieces);
$str = $pieces[0];
$db_name =  $pieces[1];
$column = $pieces[2];
$value = $pieces[3];
$questionnumber = $pieces[4];///

    //変数を確認


$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');


if( $mysql->connect_errno){
    echo 'Access Failed7';//接続失敗
    exit;
}
if ($str === "update"){
  $sql ="UPDATE $db_name SET $column = '$value' WHERE questionnumber = '$questionnumber'";
  echo " sql is ".$sql."\n"."\n";
  $result = $mysqli->query($sql);
} else if ($str === "insertrow"){
  $sql ="INSERT INTO $db_name (answer1,qdate) VALUES('','2001-01-01'); ";
  echo " sql is ".$sql."\n"."\n";
  $result = $mysqli->query($sql);
  $sql = "SELECT LAST_INSERT_ID();";
  echo " sql is ".$sql."\n"."\n";
  $result = $mysqli->query($sql);
  echo "^^^^^";
  $response="";
  while($dat = $result->fetch_assoc()){
      $response = $dat['LAST_INSERT_ID()'];
  }
  echo $response;
} elseif ($str === "deleterow"){
  $sql ="DELETE FROM $db_name WHERE questionnumber = '$questionnumber'";
  echo " sql is ".$sql."\n"."\n";
  $result = $mysqli->query($sql);
}


?>
