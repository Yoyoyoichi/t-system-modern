<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
$DB_name = "MuAnki";
// echo "19a"."\n";
$questionnumber = $_POST["data"];
// $pieces = explode(".", $_POST["data"]);
//print $_POST["data"];
$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');

// var_dump($pieces);
if( $mysql->connect_errno){
    echo 'Access Failed5';//接続失敗
    exit;
}

$query = "select * from $DB_name Where questionnumber = $questionnumber";//


$result = $mysqli->query($query);

$row_cnt = mysqli_num_rows($result);
// print "row_cnt is ".$row_cnt."\n"."\n";

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
         $reply[] = $row["answer1"]."\n".$row["answer2"]."\n".$row["answer3"]."\n".$row["answer4"]."\n".$row["answer5"]."\n".$row["answer6"]."\n".$row["answer7"]."\n".$row["answer8"]."\n".$row["answer9"]."\n".$row["answer10"]."\n".$row["answer11"]."\n".$row["answer12"]."\n".$row["answer13"]."\n".$row["answer14"]."\n".$row["answer15"]."\n";
//        var_dump( $replyy );

    }
}
else {
    echo 'Run Failed6';
}
//print  $url;

print  $reply[0];

//print  "乱数 ".$url;
//print "reply は ";


//print "data";


?>