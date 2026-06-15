<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    // $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
// echo "getChartData 1"."\n"."\n";
if( $mysqli->connect_errno){
    echo 'Access Failed';//謗･邯壼､ｱ謨・
    exit;
}
$pieces = explode("^", $_POST["data"]);
// var_dump($pieces);
$db_name = $pieces[0];
// echo "db_name is ".$db_name."\n"."\n";
// $db_column = $pieces[1];

//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
$mysqli->set_charset("utf8");

$row_cnt = count($pieces);
// echo ("pieces row_cnt is ").$row_cnt."\n";

$levels = array();

for($i = 1; $i < $row_cnt; $i++){
  // echo "i".$i."\n"."\n";;
  for($j = 0; $j < 6; $j++){
    if ($j < 5) {
      $str_sql = "SELECT * FROM  $db_name where (category1 = '$pieces[$i]') And (q_level = $j)";
      // echo "str_sql is ".$str_sql."\n"."\n";
    	$result = $mysqli->query($str_sql);
    	$row_cnt2 = mysqli_num_rows($result);
      // echo "levels row_cnt is ".$row_cnt2."\n"."\n";
      $levels[$i][$j] = $row_cnt2;
    } else {
      $str_sql = "SELECT * FROM  $db_name where (category1 = '$pieces[$i]') And (q_level >= $j)";
      // echo "str_sql is ".$str_sql."\n"."\n";
    	$result = $mysqli->query($str_sql);
    	$row_cnt2 = mysqli_num_rows($result);
      // echo "levels row_cnt is ".$row_cnt2."\n"."\n";
      $levels[$i][$j] = $row_cnt2;
    }

  	// $str_sql = "SELECT * FROM  $db_name where (category1 = '$pieces[$i]') And (q_level = $j)";
    //
  	// $result = $mysqli->query($str_sql);
  	// $row_cnt2 = mysqli_num_rows($result);
    // $levels[$i][$j] = $row_cnt2;

  }
}
$levels2=array();
for($i = 1; $i < $row_cnt; $i++){
  $levels2[$i] = implode("^", $levels[$i]);
}
$levels3 = "";
for($i = 0; $i < 6; $i++){
  $levels3 = implode(",", $levels2);
}
echo $levels3;
// if (!$result) {error_log($mysqli->error);exit;}
// // $response[] = array();
// while($dat = $result->fetch_assoc()){
//     $response[] = $dat['category1'];
// }

// // // echo ("response is ")."\n";
// // // var_dump ($response);

// // $response = array_values(array_unique($response));
// // $row_cnt = count($response);
// // $reply = implode(",", $response);
// for($i = 1; $i < $row_cnt; $i++){
// $reply2[$i] = $reply2[$i].",".$response[$i];
// }

// echo $row_cnt;

?>
