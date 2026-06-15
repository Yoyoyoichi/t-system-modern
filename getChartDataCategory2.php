<?php
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    // $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
// echo "getChartData 1"."\n"."\n";
if( $mysqli->connect_errno){
    echo 'Access Failed';//謗･邯壼､ｱ謨・
    exit;
}

$db_name = $_POST["data"];//$_GET["DB_name"];///////
// echo ("db_name is ").$db_name."\n"."\n";

//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
$mysqli->set_charset("utf8");
$row = "";

$str_sql = "select category2 from $db_name where question != 'settings'";
//     echo $str_sql.",\n"."\n";//
$result = $mysqli->query($str_sql);

if (is_array($result)) {
$row_cnt =count($result);
}
//     var_dump($result);
//     echo $row_cnt.",\n"."\n";

if (!$result) {error_log($mysqli->error);exit;}
// $response[] = array();
while($dat = $result->fetch_assoc()){
    $response[] = $dat['category2'];
}

// echo ("response is ")."\n";
// var_dump ($response);

$response = array_values(array_unique($response));
// echo "1"."\n";
// var_dump ($response);
//蜑企勁螳溯｡・
for ($i = 0 ; $i < count($response); $i++){
  //謖・ｮ壹＠縺滓擅莉ｶ縺ｮ譁・ｭ怜・縺ｪ繧蛾・蛻励ｒ蜑企勁
  if ($response[$i] == ''){
    unset($response[$i]);
  }
}
// $response = array_diff($response, "");
// echo "2"."\n";
// var_dump ($response);


$row_cnt = count($response);
$reply = implode("^", $response);
// for($i = 1; $i < $row_cnt; $i++){
// $reply2[$i] = $reply2[$i].",".$response[$i];
// }

echo $reply;

?>
