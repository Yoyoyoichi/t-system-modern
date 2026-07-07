?<?php
require_once 'db_wrapper.php';
// ini_set('display_errors', "On");
mb_language("ja");
mb_internal_encoding('UTF-8');

// echo "19bb"."\n"."\n";
$pieces = explode("^^^", $_POST["data"]);



$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");

$str_sql = "select * from ChordProgressions where name = '$pieces[0]'";
$result = $mysqli->query($str_sql);
/* 結果セットの行数を取得します */
$row_cnt = $result->num_rows;


// print_r($result);
// $string = array();
// while ($row = $result->fetch_assoc()) {
//   $string[]=$row;
// }
// var_dump ($string);
// echo $str_sql;
// echo "\n"."\n";
echo $row_cnt;
echo "\n"."\n";
if ($row_cnt>0){
  $str_sql = "UPDATE  ChordProgressions
  SET    chordProgression = '$pieces[1]', padChordHtml = '$pieces[2]'
  WHERE (name = '$pieces[0]')";
}else{
  $str_sql = "insert into ChordProgressions
  (name,chordProgression,padChordHtml)
  select '$pieces[0]','$pieces[1]','$pieces[2]'
  ";
}




echo $str_sql;

$res = $mysqli->query($str_sql);






mysqli_close($mysqli);

echo "\n"."\n";
echo $res;





function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>
