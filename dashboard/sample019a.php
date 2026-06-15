<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
 
echo "15a"."\n";
$pieces = explode(".", $_POST["data"]);
//print $_POST["data"];
$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');

var_dump($pieces);
if( $mysql->connect_errno){
    echo 'Access Failed5';//接続失敗
    exit;
}

//$query = "select * from `MuAnki` ";
//$result = $mysqli->query($query);
//
//$row_cnt = mysqli_num_rows($result);
//printf("Result set has %d rows.\n", $row_cnt);


//$url=$_POST["data"];

//print  $url;

switch ($pieces[1]) {
    case "<":
        $query = "select * from `MuAnki` Where $pieces[2] < $pieces[3]";
        break;
    case "=":
        $query = "select * from `MuAnki` Where $pieces[2] = $pieces[3]";
        break;
    case ">":
        $query = "select * from `MuAnki` Where $pieces[2] > $pieces[3]";
        break;
}
//echo  $query;///

$result = $mysqli->query($query);

//print  $result;

//$reply ="";

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
         $reply[] = $row["1"]."\n".$row["2"]."\n".$row["3"]."\n".$row["4"]."\n".$row["5"]."\n".$row["6"]."\n".$row["7"]."\n".$row["8"]."\n".$row["9"]."\n".$row["10"]."\n".$row["11"]."\n".$row["12"]."\n".$row["13"]."\n".$row["14"]."\n".$row["15"]."\n";
//        var_dump( $replyy );

    }
}
else {
    echo 'Run Failed6';
}
//print  $url;
$l = (int)$pieces[0];
print  $reply[$l];

//print  "乱数 ".$url;
//print "reply は ";


//print "data";


?>