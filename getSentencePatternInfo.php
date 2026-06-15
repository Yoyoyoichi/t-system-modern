<?php
// $testnumber = $testnumber + 1;
// echo $testnumber."\n"."\n";
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// echo "20e"."\n"."\n";

$pieces = $_POST["data"];




// //蟆剰ｪｬ逡ｪ蜿ｷ險倬鹸
require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}
$mysqli->set_charset("utf8");
$str = "Select answer1 From SentencePattern WHERE question like '%$pieces%'";
echo "str_sql is ".$str."\n"."\n";
echo "<br><br>";
$result = $mysqli->query($str);

$row = "";
//繝・・繧ｿ繝吶・繧ｹ蜿門ｾ・
// $result = $mysqli->query($str);
// var_dump($result);
$row_cnt = mysqli_num_rows($result);
echo "Row Count is ";
echo $row_cnt;
$reply[] = "";

if( $result = $mysqli->query($str) ){
//    echo "8.1"."\n"."\n";
  while($row = $result->fetch_assoc() ){
      $reply[] = $row["answer1"];/////
      echo $row["answer1"];
  }
}
else {
    echo '蝠城｡後′縺ゅｊ縺ｾ縺帙ｓ縲・;
}
echo '^^^^^';
// for 譁・
for($i = 0; $i < $row_cnt+1; $i++){
echo $reply[$i];
}


mysqli_close($mysqli);
?>

