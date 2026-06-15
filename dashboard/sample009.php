<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
 

$url=$_POST["data"];

$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');


if( $mysql->connect_errno){
    echo 'Access Failed';//接続失敗
    exit;
}

$query = "select * from `Adlib Idea` ";
$result = $mysqli->query($query);
$row_cnt = mysqli_num_rows($result);
printf("Result set has %d rows.\n", $row_cnt);


$url=rand ( 1 , $row_cnt );

$query = "select * from `Adlib Idea` Where TheNumber = $url";//条件を指定している。列TheNumberが1のもの

$result = $mysqli->query($query);



$reply ="";

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        
       $reply = $reply ."\n". $row["Idea"] ;






       //print $row[$url]  ;
       //print (\r\n);

        //echo $row['2'];
        //echo "<br>";
    }
}
else {
    echo 'Run Failed';
}


print  "乱数 ".$url;
//print "reply は ";
print  $reply;

//print "data";

//print $_POST["data"];
?>