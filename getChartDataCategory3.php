<?php
require_once 'db_wrapper.php';
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    // $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
// echo "getChartData 1"."\n"."\n";
if( $mysqli->connect_errno){
    echo 'Access Failed';//接続失敗
    exit;
}

$db_name = $_POST["data"];//$_GET["DB_name"];///////
// echo ("db_name is ").$db_name."\n"."\n";

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");
$row = "";

$str_sql = "select category3 from $db_name where question != 'settings'";
    // echo $str_sql.",\n"."\n";//
$result = $mysqli->query($str_sql);

if (is_array($result)) {
$row_cnt =count($result);
}
//     var_dump($result);
//     echo $row_cnt.",\n"."\n";

if (!$result) {error_log($mysqli->error);exit;}
// $response[] = array();
while($dat = $result->fetch_assoc()){
    $response[] = $dat['category3'];
}

// echo ("response is ")."\n";
// var_dump ($response);

$response = array_values(array_unique($response));
// echo "1"."\n";
// var_dump ($response);
//削除実行
for ($i = 0 ; $i < count($response); $i++){
  //指定した条件の文字列なら配列を削除
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
