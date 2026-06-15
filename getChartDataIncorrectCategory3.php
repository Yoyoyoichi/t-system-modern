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

$test2 = array();

for($i = 1; $i < $row_cnt; $i++){
	// echo "db_name is ".$db_name."\n"."\n";
	// $str_sql = "select * from $db_name縲where pca > 50 and category3 = '$pieces[$i]'";
	$str_sql = "SELECT sum(incorrect) FROM  $db_name where category3 = '$pieces[$i]'";
	// echo $str_sql.",\n"."\n";//
	$result = $mysqli->query($str_sql);
	$test  = $result->fetch_assoc();
	// echo ("test is ")."\n";
	// var_dump ($test);
    $test2[] = $test['sum(incorrect)'];
}

echo $test2 =implode("^", $test2);


?>

