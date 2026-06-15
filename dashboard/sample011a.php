<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
 

$url=$_POST["data"];
//print $_POST["data"];
$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');


if( $mysql->connect_errno){
    echo 'Access Failed';//接続失敗
    exit;
}

$query = "select * from `MuAnki` ";
$result = $mysqli->query($query);

$row_cnt = mysqli_num_rows($result);
//printf("Result set has %d rows.\n", $row_cnt);


$url=$_POST["data"];

$query = "select * from `MuAnki` Where `questionnumber` = $url";

$result = $mysqli->query($query);

//print  $result;

$reply ="";

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
         $reply = $row["1"]."\n". $row["2"]."\n". $row["3"]."\n". $row["4"]."\n". $row["5"]."\n". $row["6"]."\n".$row["7"]."\n". $row["8"]."\n". $row["9"];

    }
}
else {
    echo 'Run Failed';
}
print  $reply;

//print  "乱数 ".$url;
//print "reply は ";


//print "data";


?>