<?php
// $testnumber = $testnumber + 1;
// echo $testnumber."\n"."\n";
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// echo "20e"."\n"."\n";

$pieces = explode("^^", $_POST["data"]);
// var_dump ($pieces);

$db_name =  $pieces[0];
$pieces2 = explode(" --- ", $pieces[1]);
$question = addslashes($pieces2[0]);
$questionnumber = addslashes($pieces2[1]);
// var_dump ($pieces2);

$str_sql = "select * from $db_name where questionnumber = '$questionnumber'";
// echo "str_sql is ".$str_sql."\n"."\n";/////
require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();
// require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
$mysqli->set_charset("utf8");
$row = "";
//繝・・繧ｿ繝吶・繧ｹ蜿門ｾ・
$result = $mysqli->query($str_sql);
// //var_dump($result);
$row_cnt = mysqli_num_rows($result);
// print "gtq1 33 row_cnt is ".$row_cnt."\n"."\n";

$reply[] = "";

if( $result = $mysqli->query($str_sql) ){
//    echo "8.1"."\n"."\n";
    while($row = $result->fetch_assoc() ){
        $reply[] = $row;/////
  //       var_dump($row);
		// echo ""."\n"."\n";

    }
}
else {
    echo 'Run Failed4';
}

// echo ("reply is ")."\n";
// var_dump ($reply);

// if (!($reply[1]["qsentence"])=="") {
// 	echo $reply[1]["qsentence"]."\n"."\n";
// 	// echo "1"."\n"."\n";
// }


// if(!$reply["qsentence"]=="" )
// {

// 	echo $reply[0]["qsentence"]."\n"."\n";
// }
// or !is_null($reply["qsentence"])


// if (isset($reply[1]["correct"]) and isset($reply[1]["incorrect"]) and isset($reply[1]["question"])) {


  echo $reply[1]["answer1"]."^^";
  echo $reply[1]["answer2"]."^^";
  echo $reply[1]["answer3"]."^^";
  echo $reply[1]["answer4"]."^^";
  echo $reply[1]["answer5"]."^^";
  echo $reply[1]["answer6"]."^^";
  echo $reply[1]["answer7"]."^^";
  echo $reply[1]["answer8"]."^^";
  echo $reply[1]["answer9"]."^^";
  echo $reply[1]["answer10"]."^^";
  echo $reply[1]["answer11"]."^^";
  echo $reply[1]["answer12"]."^^";
  echo $reply[1]["answer13"]."^^";
  echo $reply[1]["answer14"]."^^";
  echo $reply[1]["answer15"]."^^";
  echo $reply[1]["question"]."^^";
  echo $reply[1]["category1"]."^^";
  echo $reply[1]["category2"]."^^";
  echo $reply[1]["category3"]."^^";
  echo $reply[1]["qsentence"]."^^";
  echo $reply[1]["imagefolder"]."^^";
  echo $reply[1]["22"]."^^";
  echo $reply[1]["23"]."^^";
  echo $reply[1]["24"]."^^";
  echo $reply[1]["hint"]."^^";
  echo $reply[1]["tag"]."^^";
  echo $reply[1]["27"]."^^";
  echo $reply[1]["28"]."^^";
  echo $reply[1]["29"]."^^";
  echo $reply[1]["30"]."^^";
  echo $reply[1]["31"]."^^";
  echo $reply[1]["32"]."^^";
  echo $reply[1]["33"]."^^";
  echo $reply[1]["34"]."^^";
  echo $reply[1]["q_level"]."^^";
  echo $reply[1]["pasttime"]."^^";
  echo $reply[1]["poorat"]."^^";
  echo $reply[1]["q_record"]."^^";
  echo $reply[1]["nextQdate"]."^^";
  echo $reply[1]["incorrect"]."^^";
  echo $reply[1]["correct"]."^^";
  echo $reply[1]["pre_qdate"]."^^";
  echo $reply[1]["pca"]."^^";
  echo $reply[1]["qdate"]."^^";
  echo $reply[1]["questionnumber"]."^^";
  echo $reply[1]["category4"]."^^";
  echo $reply[1]["category5"]."^^";


// }

mysqli_close($mysqli);
?>

