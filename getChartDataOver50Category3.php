<?php
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

$row_cnt2= array();
for($i = 1; $i < $row_cnt; $i++){
	// echo "db_name is ".$db_name."\n"."\n";
	// $str_sql = "select * from $db_name　where pca > 50 and category1 = '$pieces[$i]'";
	$str_sql = "select * from $db_name where correct/(correct + incorrect)*100 > 80 and category3 = '$pieces[$i]' and  correct > 2";
	// echo $str_sql.",\n"."\n";//
	$result = $mysqli->query($str_sql);
	// echo mysqli_num_rows($result)."\n"."\n";
	$row_cnt2[] = mysqli_num_rows($result);
}
//     var_dump($result);
$row_cnt3 = explode(",", $row_cnt2);
$row_cnt4 = implode("^", $row_cnt3);
$reply = implode("^", $row_cnt2);


echo $reply;

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
