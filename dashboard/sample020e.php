<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');


$pieces = explode(".", $_POST["data"]);

$DB=$_GET["DB_name"];
echo $DB."\n"."\n";

$questionnumber = $pieces[0];
// $DB_name =  $pieces[1];
$db_name =  "MuAnki";

// echo "$pieces[1]"."\n"."\n";

$str_sql = "select question from $db_name where questionnumber = $questionnumber";

$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");
$row = "";
//データベース取得
$result = $mysqli->query($str_sql);
// //var_dump($result);
$row_cnt = mysqli_num_rows($result);
// print "row_cnt is ".$row_cnt."\n"."\n";

$reply = "";

if( $result = $mysqli->query($str_sql) ){
//    echo "8.1"."\n"."\n";
    while($row = $result->fetch_assoc() ){
        $reply[] = $row;/////
        // var_dump($row);
        
    }
}
else {
    echo 'Run Failed4';
}
//echo ""."\n"."\n";
// echo $reply[3];
// //var_dump($pieces) ;
//var_dump($reply);
//echo "9"."\n"."\n";
echo $reply[0]["question"];


// print  "問題数は ".$row_cnt."\n";


?>
