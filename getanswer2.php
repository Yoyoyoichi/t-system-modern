<?php
// $testnumber = $testnumber + 1;
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// echo "20e"."\n"."\n";

$pieces = explode(".", $_POST["data"]);
// var_dump ($pieces);


$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[1];

// echo "$pieces[1]"."\n"."\n";

$str_sql = "select * from $db_name where questionnumber = $questionnumber";
// echo $str_sql."\n"."\n";/////
require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}
// mysql_query("set names utf8"); or $db_obj->Query("set names utf8");
//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
$mysqli->set_charset("utf8");
$row = "";
//繝・・繧ｿ繝吶・繧ｹ蜿門ｾ・
$result = $mysqli->query($str_sql);
// var_dump($result);
$row_cnt = mysqli_num_rows($result);
// print "row_cnt is ".$row_cnt."\n"."\n";

$reply[] = "";

if( $result = $mysqli->query($str_sql) ){
//    echo "8.1"."\n"."\n";
    while($row = $result->fetch_assoc() ){
        $reply[] = $row;/////
        // var_dump($row);

    }
}
else {
    echo '蝠城｡後′縺ゅｊ縺ｾ縺帙ｓ縲・;
}
//echo ""."\n"."\n";
// echo $reply[3];
// //var_dump($pieces) ;
//var_dump($reply);

// if(!$reply[1]["qsentence"]=="" or !$reply[1]["qsentence"] == null)
// {

// 	echo $reply[1]["qsentence"]."\n"."\n";
// }

if (!($reply[1]["qsentence"])=="") {
	echo $reply[1]["qsentence"]."\n"."\n";
	echo "1"."\n"."\n";
}

echo $reply[1]["question"];

// echo "\n"."縺薙％莉･髯阪・莉企幕逋ｺ荳ｭ"."\n"."繝・せ繝医リ繝ｳ繝舌・ $testnumber";///aaaaaa縺ゅ≠縺・
// print  "蝠城｡梧焚縺ｯ ".$row_cnt."\n";///縺ゅ≠縺・



?>

