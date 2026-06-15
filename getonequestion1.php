<?php
// $testnumber = $testnumber + 1;
// echo $testnumber."\n"."\n";
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// echo "20e"."\n"."\n";

$pieces = explode(".", $_POST["data"]);

// echo ("pieces is ")."\n";
// var_dump ($pieces);

$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[1];


// //蟆剰ｪｬ逡ｪ蜿ｷ險倬鹸
require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}
$mysqli->set_charset("utf8");
$str = "UPDATE $db_name SET imagefolder = $pieces[2] WHERE question = 'settings'";
// echo "str_sql is ".$str."\n"."\n";/////
$result = $mysqli->query($str);


$str_sql = "select * from $db_name where questionnumber = $questionnumber";


//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
// $mysqli->set_charset("utf8");
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


    }
}
else {
    echo '蝠城｡後′縺ゅｊ縺ｾ縺帙ｓ縲・;
}



echo $reply[1]["question"]."^^^";
echo $reply[1]["category1"];
if ((!is_null($reply[1]["category2"])) AND (!empty($reply[1]["category2"]))) {
  echo " - ".$reply[1]["category2"];
}
if ((!is_null($reply[1]["category3"])) AND (!empty($reply[1]["category3"]))){
  echo " - ".$reply[1]["category3"];
}
if ((!is_null($reply[1]["category4"])) AND (!empty($reply[1]["category4"]))){
  echo " - ".$reply[1]["category4"];
}
if ((!is_null($reply[1]["category5"])) AND (!empty($reply[1]["category5"]))){
  echo " - ".$reply[1]["category5"];
}
// echo '<br>';
echo '    ';
echo '<br>';
echo "Level・・.$reply[1]["q_level"].'   ';
echo "豁｣隗｣謨ｰ・・.$reply[1]["correct2"]." 荳肴ｭ｣隗｣謨ｰ・・.$reply[1]["incorrect2"];
echo '   ';
echo "蜑榊屓・・.substr($reply[1]["pre_qdate"],0,33);
echo '<br>';
echo "險倬鹸・・.$reply[1]["q_record"];
if ((!is_null($reply[1]["qsentence"])) AND (!empty($reply[1]["qsentence"]))) {
  echo '<br>';
  echo $reply[1]["qsentence"];
}else{
}
if ((!is_null($reply[1]["tag"])) AND (!empty($reply[1]["tag"]))) {
  echo '<br>';
  echo $reply[1]["tag"];
}else{
}
echo '<br>';
echo "蝠城｡檎分蜿ｷ・・.$reply[1]["questionnumber"];
echo "^^^";
echo $reply[1]["imagefolder"];





mysqli_close($mysqli);
?>

