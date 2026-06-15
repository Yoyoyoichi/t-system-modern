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

$query = "DESCRIBE $db_name pasttime";
$result = $mysqli->query($query);

$row_cnt = mysqli_num_rows($result);
// echo ("addcorrect42 row_cnt is ".$row_cnt)."\n";
// var_dump ($result);
if( $row_cnt==0){
    $sql = "ALTER TABLE $db_name CHANGE `36` `pasttime` float(10) DEFAULT '0'";
    $res = $mysqli->query($sql);
    // echo $sql."\n"."\n";
}




$query = "DESCRIBE $db_name poorat";
$result = $mysqli->query($query);

$row_cnt = mysqli_num_rows($result);
// echo ("addcorrect42 row_cnt is ".$row_cnt)."\n";
// var_dump ($result);
if( $row_cnt==0){
    $sql = "ALTER TABLE $db_name CHANGE `37` `poorat` VARCHAR(10) DEFAULT ''";
    $res = $mysqli->query($sql);
    // echo $sql."\n"."\n";
}



//繝・・繧ｿ譖ｴ譁ｰ
$sql = "UPDATE $db_name SET
    incorrect = incorrect -1,
    PCA = correct / (correct + incorrect) * 100,
    qdate = current_date
    WHERE questionnumber = $questionnumber";
// echo "sql is ".$sql."\n"."\n";
// SQL螳溯｡・
$res = $mysqli->query($sql);


// $query = "DESCRIBE $db_name q_record";
// $result = $mysqli->query($query);
//
// $row_cnt = mysqli_num_rows($result);
// // echo ("addcorrect42 result is ")."\n";
// // var_dump ($result);
// if( $row_cnt==0){
//     $sql = "ALTER TABLE $db_name CHANGE `38` `q_record` VARCHAR(10) DEFAULT ''";
//     $res = $mysqli->query($sql);
//     // echo $sql."\n"."\n";
// }
//
// $query = "DESCRIBE $db_name pre_qdate";
// $result = $mysqli->query($query);
//
// $row_cnt = mysqli_num_rows($result);
// // echo "addcorrect54 row_cnt is ".$row_cnt."\n";
//
// if( $row_cnt==0){
//     $sql = "ALTER TABLE $db_name CHANGE `42` `pre_qdate` VARCHAR(33) DEFAULT ''";
//     $res = $mysqli->query($sql);
//     // echo $sql."\n"."\n";
// }

//繝・・繧ｿ譖ｴ譁ｰ
// $sql = "UPDATE $db_name SET
//     q_record = CONCAT('笳・, q_record)
//     WHERE questionnumber = $questionnumber";
// // echo $sql."\n"."\n";

// SQL螳溯｡・
// $res = $mysqli->query($sql);
// $current_date = current_date;

// $sql = "update $db_name
//     set
//     q_record = (
//     CASE WHEN  pre_qdate not like CONCAT(current_date,'%')
//     THEN CONCAT('笳・, q_record)
//     ELSE q_record
//     END)
//     where questionnumber = $questionnumber";
// // echo $sql."\n"."\n";
// $res = $mysqli->query($sql);
//
// $sql = "update $db_name
//     set
//     pre_qdate = (
//     CASE WHEN  pre_qdate not like CONCAT(current_date,'%')
//     THEN CONCAT(current_date, ',' ,pre_qdate)
//     ELSE pre_qdate
//     END)
//     where questionnumber = $questionnumber";
// // echo $sql."\n"."\n";//
// $res = $mysqli->query($sql);
//




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
      incorrect = incorrect - 1
      WHERE qdate = current_date and id = '$db_name'";
  // echo "sql is ".$sql."\n"."\n";
  // SQL螳溯｡・
  $res = $mysqli->query($sql);
} else {
  $sql = "INSERT INTO A01tsystemrecord01 (id, correct, qdate,recordnumber) VALUES ('$db_name',1, current_date,$maxrecordnumber )";
  // echo "sql is ".$sql."\n"."\n";
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

