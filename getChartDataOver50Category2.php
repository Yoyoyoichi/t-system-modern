<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();
    // require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();
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
// echo ("row_cnt is ").$row_cnt."\n";

$row_cnt2= array();
for($i = 1; $i < $row_cnt; $i++){
	// echo "db_name is ".$db_name."\n"."\n";
	// $str_sql = "select * from $db_name縲where pca > 50 and category1 = '$pieces[$i]'";
	$str_sql = "select * from $db_name where correct/(correct + incorrect)*100 > 80 and category2 = '$pieces[$i]' and  correct > 2";
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

