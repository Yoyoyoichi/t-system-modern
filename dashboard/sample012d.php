<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
 

$url = $_POST["data"];

$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');


if( $mysql->connect_errno){
    echo 'Access Failed7';//接続失敗
    exit;
}

$query = "select * from `MuAnki` ";
$result = $mysqli->query($query);

$row_cnt = mysqli_num_rows($result);
//printf("Result set has %d rows.\n", $row_cnt);







//データ更新
$sql = "UPDATE MuAnki SET
    incorrect = incorrect + 1,
    PCA = correct / (correct + incorrect) * 100,
    qdate = current_date
    WHERE questionnumber = $url";

// SQL実行
$res = $mysqli->query($sql);


//print  $res;
//print  $url;
//$reply ="";
$query = "select * from `MuAnki` Where `questionnumber` = $url";

$result = $mysqli->query($query);
if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        
        //$reply = $row["1"] ."\n". $reply;
       $reply = $reply ."\n". $row["incorrect"];





    }
}
else {
    echo 'Run Failed8';
}

print  $reply;

//print "reply は ";
//print  $reply;

//print "data";

//print $_POST["data"];
?>