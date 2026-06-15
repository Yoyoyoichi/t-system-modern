<?php
// ini_set('display_errors', "On");
mb_language("ja");
mb_internal_encoding('UTF-8');

// echo "19bb"."\n"."\n";
$pieces = explode("^^^", $_POST["data"]);



require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
$mysqli->set_charset("utf8");

$str_sql = "select * from ChordProgressions where name = '$pieces[0]'";
$result = $mysqli->query($str_sql);
/* 邨先棡繧ｻ繝・ヨ縺ｮ陦梧焚繧貞叙蠕励＠縺ｾ縺・*/
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
  SET    chordProgression = '$pieces[1]', guitarChordHtml = '$pieces[2]'
  WHERE (name = '$pieces[0]')";
}else{
  $str_sql = "insert into ChordProgressions
  (name,chordProgression,guitarChordHtml)
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

