?<?php
require_once 'db_wrapper.php';
// $testnumber = $testnumber + 1;
// echo $testnumber."\n"."\n";
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// echo "20e"."\n"."\n";

$pieces = explode("^", $_POST["data"]);
if (count($pieces) <= 1) { $pieces = explode(".", $_POST["data"]); }

// echo ("pieces is ")."\n";
// var_dump ($pieces);

$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[1];


// //�����ԍ��L�^
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}
$mysqli->set_charset("utf8");
if (!empty($pieces[2])) {
    $str = "UPDATE $db_name SET imagefolder = '" . $pieces[2] . "' WHERE question = 'settings'";
    $result = $mysqli->query($str);
}


$str_sql = "select * from $db_name where questionnumber = $questionnumber";


//�f�t�H���g�����Z�b�g��ݒ�
// $mysqli->set_charset("utf8");
$row = "";
//�f�[�^�x�[�X�擾
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
    echo '��肪����܂���B';
}



echo $reply[1]["question"]."^^^";
echo $reply[1]["category1"];
if (!empty($reply[1]["category2"]) && $reply[1]["category2"] !== "NULL") {
  echo " - ".$reply[1]["category2"];
}
if (!empty($reply[1]["category3"]) && $reply[1]["category3"] !== "NULL") {
  echo " - ".$reply[1]["category3"];
}
if (!empty($reply[1]["category4"]) && $reply[1]["category4"] !== "NULL") {
  echo " - ".$reply[1]["category4"];
}
if (!empty($reply[1]["category5"]) && $reply[1]["category5"] !== "NULL") {
  echo " - ".$reply[1]["category5"];
}
// echo '<br>';
echo '    ';
echo '<br>';
echo "Level：" . $reply[1]["q_level"] . '   ';
echo "正解数：" . $reply[1]["correct2"] . " 不正解数：" . $reply[1]["incorrect2"];
echo '   ';
echo "前回：" . substr($reply[1]["pre_qdate"],0,33);
echo '<br>';
echo "記録：" . $reply[1]["q_record"];
if (!empty($reply[1]["qsentence"]) && $reply[1]["qsentence"] !== "NULL") {
  echo '<br>' . $reply[1]["qsentence"];
}
if (!empty($reply[1]["tag"]) && $reply[1]["tag"] !== "NULL") {
  echo '<br>' . $reply[1]["tag"];
}
echo '<br>';
echo "問題番号：" . $reply[1]["questionnumber"];
echo "^^^";
echo $reply[1]["imagefolder"];





mysqli_close($mysqli);
?>

