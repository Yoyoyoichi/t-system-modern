<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^^", $_POST["data"]);
var_dump ($pieces);
$DB_name = $pieces[0];///
$MaxQuestionNumber = $pieces[1];
$fontresize = $pieces[2];
$autoSpeed = $pieces[3];
$autoReading = $pieces[4];
$jpSpeed = $pieces[5];
$engSpeed = $pieces[6];
$NOC = $pieces[7];
$autoAnswer = $pieces[8];
$qachange = $pieces[9];
$autoread = $pieces[10];
$keyControl = $pieces[11];
$answerByMyself = $pieces[12];
$randomOrNot = $pieces[13];
$backGround = $pieces[14];
$novel = $pieces[15];
$flex = $pieces[17];
$turnBlack = $pieces[18];
// echo "getPastTime is ".$getPastTime."\n";


// echo "addcorrect poorat is ".$poorat."\n"."\n";
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
// $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//問題番号最大値取得
$str_sql = "SELECT max(questionnumber) FROM $DB_name";
$result = $mysqli->query($str_sql);
$result2  = $result->fetch_assoc();
$maxQuestionNumber = $result2['max(questionnumber)'] +1;

$str_sql = "insert into $pieces[0]
    (answer1, answer2, answer3, answer4, answer5,
    answer6, answer7, answer8, answer9, answer10,
    answer11,answer12,answer13,answer14,question, qsentence, imagefolder, questionnumber)
    select '$pieces[1]','$pieces[2]','$pieces[3]','$pieces[4]','$pieces[5]',
           '$pieces[6]','$pieces[7]','$pieces[8]','$pieces[9]','$pieces[10]',
           '$pieces[11]','$pieces[12]','$pieces[13]','$pieces[14]','settings','$pieces[15]','$pieces[16]','$maxQuestionNumber'
    where NOT EXISTS (select 1 from $pieces[0] where question = 'settings')";

echo $str_sql;

$result = $mysqli->query($str_sql);


$str_sql = "UPDATE $pieces[0] SET
    answer1 = '$pieces[1]',
    answer2 = '$pieces[2]',
    answer3 = '$pieces[3]',
    answer4 = '$pieces[4]',
    answer5 = '$pieces[5]',
    answer6 = '$pieces[6]',
    answer7 = '$pieces[7]',
    answer8 = '$pieces[8]',
    answer9 = '$pieces[9]',
    answer10 = '$pieces[10]',
    answer11 = '$pieces[11]',
    answer12 = '$pieces[12]',
    answer13 = '$pieces[13]',
    answer14 = '$pieces[14]',
    category1 = '$pieces[15]',
    category2 = '$pieces[16]',
    category3 = '$pieces[17]',
    setting01 = '$pieces[18]'

    where  question = 'settings'";

echo $str_sql;

$result = $mysqli->query($str_sql);


?>
