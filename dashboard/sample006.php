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

$query = "select * from `Mu-Anki` ";

$result = $mysqli->query($query);


$reply ="";

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        
       $reply = $reply ."\n". $row[$url] ;


    }
}
else {
    echo 'Run Failed';
}

print "reply は ";
print  $reply;

//print "data";

//print $_POST["data"];
?>