?<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    // $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
// echo "getChartData 1"."\n"."\n";
if( $mysqli->connect_errno){
    echo 'Access Failed';//接続失敗
    exit;
}
$pieces = explode("^", $_POST["data"]);
// var_dump($pieces);
$db_name = $pieces[0];
// echo "db_name is ".$db_name."\n"."\n";
// $db_column = $pieces[1];

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");

$row_cnt = count($pieces);
// echo ("row_cnt is ").$row_cnt."\n";

$test2 = array();

for($i = 1; $i < $row_cnt; $i++){
	// echo "db_name is ".$db_name."\n"."\n";
	// $str_sql = "select * from $db_name　where pca > 50 and category1 = '$pieces[$i]'";
	$str_sql = "SELECT incorrect FROM  A01tsystemrecord01 where qdate = '$pieces[$i]' and id = '$db_name'";
	// echo $str_sql.",\n"."\n";//
	$result = $mysqli->query($str_sql);
	$row_cnt2 = mysqli_num_rows($result);
	// echo "row_cnt2 is ".$row_cnt2."\n"."\n";
	if ($row_cnt2==0) {
	$test2[] = 0;
	} else {
	$test  = $result->fetch_assoc();
    $test2[] = $test['incorrect'];;
	}
}

echo $test2 =implode("^", $test2);



?>
