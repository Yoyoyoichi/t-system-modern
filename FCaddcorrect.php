<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^", $_POST["data"]);
// var_dump ($pieces);
$questionnumber = $pieces[0];///
$DB_name =  $pieces[1];
$db_name =  $pieces[1];
$poorat = $pieces[2];
$getPastTime = $pieces[3];
// echo "getPastTime is ".$getPastTime."\n";


// echo "addcorrect poorat is ".$poorat."\n"."\n";
$pieces = explode(".", $_POST["data"]);

require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();


if( $mysql->connect_errno){
    echo 'Access Failed7';//謗･邯壼､ｱ謨・
    exit;
}





//繝・・繧ｿ譖ｴ譁ｰ
$sql = "UPDATE $db_name SET
    correct = correct +1,
    PCA = correct / (correct + incorrect) * 100,
    qdate = current_date,
    forgetingCurveLevel = forgetingCurveLevel + 1,
    pasttime = '$getPastTime'
    WHERE questionnumber = $questionnumber";
echo "sql is ".$sql."\n"."\n";
//////////////////////
// SQL螳溯｡・
$res = $mysqli->query($sql);


$sql = "update $db_name
    set
    q_record = (
    CASE WHEN  pre_qdate not like CONCAT(current_date,'%')
    THEN CONCAT('笳・, q_record)
    ELSE q_record
    END)
    where questionnumber = $questionnumber";
$res = $mysqli->query($sql);

$sql = "update $db_name
    set
    poorat = (
    CASE WHEN  pre_qdate not like CONCAT(current_date,'%')
    THEN '$poorat'
    ELSE poorat
    END)
    where questionnumber = $questionnumber";
// echo $sql."\n"."\n";
$res = $mysqli->query($sql);

$sql = "update $db_name
    set
    nextQdate = (
    CASE 
        WHEN  forgetingCurveLevel = 1  THEN DATE_ADD(CURRENT_DATE(), INTERVAL 7 DAY)
        WHEN  forgetingCurveLevel = 2  THEN DATE_ADD(CURRENT_DATE(), INTERVAL 30 DAY)
        WHEN  forgetingCurveLevel = 3  THEN DATE_ADD(CURRENT_DATE(), INTERVAL 60 DAY)
        WHEN  forgetingCurveLevel = 4  THEN DATE_ADD(CURRENT_DATE(), INTERVAL 90 DAY)
        WHEN  forgetingCurveLevel = 5  THEN DATE_ADD(CURRENT_DATE(), INTERVAL 180 DAY)
        WHEN  forgetingCurveLevel = 6  THEN DATE_ADD(CURRENT_DATE(), INTERVAL 365 DAY)
    END)
    where questionnumber = $questionnumber";
echo $sql."\n"."\n";
$res = $mysqli->query($sql);


$query = "DESCRIBE $db_name q_level";
$result = $mysqli->query($query);

$row_cnt = mysqli_num_rows($result);

if( $row_cnt==0){
    $sql = "ALTER TABLE $db_name CHANGE `35` q_level int(10) DEFAULT 0";
    $res = $mysqli->query($sql);
}

$sql = "update $db_name
    set
    q_level =
    (CASE
      WHEN pre_qdate = ''
        OR pre_qdate = null
        OR (CHAR_LENGTH(q_record) = 1 AND q_record = 'ﾃ・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (CHAR_LENGTH(q_record) = 1 AND q_record = '笳・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (LEFT( q_record, 2 ) = '笳凝・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (CHAR_LENGTH(q_record) = 2 AND q_record = '笳銀雷' AND pre_qdate not like CONCAT(current_date,'%'))
        OR (LEFT( q_record, 3 ) = '笳銀雷ﾃ・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (CHAR_LENGTH(q_record) = 3 AND q_record = '笳銀雷笳・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (LEFT( q_record, 4 ) = '笳銀雷笳凝・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (CHAR_LENGTH(q_record) = 4 AND q_record = '笳銀雷笳銀雷' AND pre_qdate not like CONCAT(current_date,'%'))
        OR (LEFT( q_record, 5 ) = '笳銀雷笳銀雷ﾃ・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (CHAR_LENGTH(q_record) = 5 AND q_record = '笳銀雷笳銀雷笳・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (LEFT( q_record, 6 ) = '笳銀雷笳銀雷笳凝・ AND pre_qdate not like CONCAT(current_date,'%'))
        OR (q_record like CONCAT('笳銀雷笳銀雷笳・,'%') AND pre_qdate not like CONCAT(current_date,'%'))
      THEN q_level + 1
      ELSE q_level
    END)
    where questionnumber = $questionnumber";
// echo $sql."\n"."\n";
$res = $mysqli->query($sql);

$sql = "update $db_name
    set
    pre_qdate = (
    CASE WHEN  pre_qdate not like CONCAT(current_date,'%')
    THEN CONCAT(current_date, ',' ,pre_qdate)
    ELSE pre_qdate
    END)
    where questionnumber = $questionnumber";
// echo $sql."\n"."\n";//
$res = $mysqli->query($sql);
$sql = "UPDATE $db_name
        set
        pre_qdate = (
        CASE WHEN  RIGHT(pre_qdate,1) = ' '
        THEN left(pre_qdate,char_length(pre_qdate)-1)
        ELSE pre_qdate
        END)";
$res = $mysqli->query($sql);
$sql = "UPDATE $db_name
        set
        pre_qdate = (
        CASE WHEN  RIGHT(pre_qdate,1) = ','
        THEN left(pre_qdate,char_length(pre_qdate)-1)
        ELSE pre_qdate
        END)";
$res = $mysqli->query($sql);

// print_r($res);
$str_sql = "SELECT max(recordnumber) FROM  A01tsystemrecord01";
// echo $str_sql."\n"."\n";
$result = $mysqli->query($str_sql);
$result2  = $result->fetch_assoc();
$maxrecordnumber = $result2['max(recordnumber)'] +1;
// echo "maxrecordnumber is ".$maxrecordnumber."\n"."\n";
$sql = "select * from A01tsystemrecord01 Where qdate = current_date and id = '$db_name'";
// echo "sql is ".$sql."\n"."\n";
$res = $mysqli->query($sql);
$row_cnt = mysqli_num_rows($res);

if ($row_cnt>0) {
  $sql = "UPDATE A01tsystemrecord01 SET
      correct = correct + 1
      WHERE qdate = current_date and id = '$db_name'";
  echo "sql is ".$sql."\n"."\n";
  // SQL螳溯｡・
  $res = $mysqli->query($sql);
} else {
  $sql = "INSERT INTO A01tsystemrecord01 (id, correct, qdate,recordnumber) VALUES ('$db_name',1, current_date,$maxrecordnumber )";
  echo "sql is ".$sql."\n"."\n";
  // SQL螳溯｡・
  $res = $mysqli->query($sql);
}

$query = "select * from $db_name Where `questionnumber` = $questionnumber";

$result = $mysqli->query($query);
if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){

       $reply = $row["correct"];
       $reply2 = $row["incorrect"];
    }
}

print  "豁｣隗｣ ".$reply." : 荳肴ｭ｣隗｣ ".$reply2;
?>

