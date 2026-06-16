?<?php
require_once 'db_wrapper.php';
// $testnumber = $testnumber + 1;
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// echo "20e"."\n"."\n";

$pieces = explode("^", $_POST["data"]);
// var_dump ($pieces);


$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[1];

// echo "$pieces[1]"."\n"."\n";

$str_sql = "select * from $db_name where questionnumber = $questionnumber";
// echo $str_sql."\n"."\n";/////
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}
// mysql_query("set names utf8"); or $db_obj->Query("set names utf8");
//デフォルト文字セットを設定
$mysqli->set_charset("utf8");
$row = "";
//データベース取得
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
    echo '問題がありません。';
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

// echo "\n"."ここ以降は今開発中"."\n"."テストナンバー $testnumber";///aaaaaaあああ
// print  "問題数は ".$row_cnt."\n";///あああ



?>

