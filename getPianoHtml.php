<?php
// ini_set('display_errors', "On");
mb_language("ja");
mb_internal_encoding('UTF-8');

// echo "19bb"."\n"."\n";
$pieces = explode("^^^", $_POST["data"]);



$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
$mysqli->set_charset("utf8");

//繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ1繧貞叙蠕・
$str_sql = "select pianoChordHtml from ChordProgressions where name = '$pieces[0]'";
// echo $str_sql.",\n"."\n";//
$result = $mysqli->query($str_sql);
if (is_array($result)) {
  $row_cnt =count($result);
}

// echo $row_cnt.",\n"."\n";
$response ="";
if (!$result) {error_log($mysqli->error);exit;}
// $response[] = array();
while($dat = $result->fetch_assoc()){
  $response = $dat['pianoChordHtml'];
}
// echo $str_sql;

// $res = $mysqli->query($str_sql);


echo  $response;



mysqli_close($mysqli);

// echo "\n"."\n";
// echo $res;





function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>
