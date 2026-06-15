<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
$db_name =  "MuAnki";
echo "15e"."\n";
//$url=$_POST["data"];
$pieces = explode(".", $_POST["data"]);

echo "pieces is ";
var_dump($pieces);

$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');


if( $mysql->connect_errno){
    echo 'Access Failed3';//接続失敗
    exit;
}

//$query = "select * from `MuAnki` ";
//$result = $mysqli->query($query);
//
//$row_cnt = mysqli_num_rows($result);
//printf("Result set has %d rows.\n", $row_cnt);


//$url=$_POST["data"];
//rand ( 1 , $row_cnt );
// print  $pieces[1]."\n";//
switch ($pieces[1]) {
    case "<":
        $query = "select * from $db_name Where $pieces[2] < $pieces[3]";
        break;
    case "=":
        $query = "select * from $db_name Where $pieces[2] = $pieces[3]";
        break;
    case ">":
        $query = "select * from $db_name Where $pieces[2] > $pieces[3]";
        break;
}
print  $query."\n";//
// $result = $mysqli->query($query);


//
//$randnum=rand ( 1 , $row_cnt );
//print  "乱数は ".$randnum."\n";


// $reply ="";//
//$replyy = replyy();
$j = 1;
//$dbArray += $result->fetch_array(MYSQLI_ASSOC);//連想配列に入れるっ   
if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        
      
        $reply[] = $row["question"];//
        $j = $j + 1;
        
        





    }
}
else {
    echo 'Run Failed4';
}
//$row = $result->fetch_assoc() ;


$row_cnt = mysqli_num_rows($result);
print  "問題数は ".$row_cnt."\n";
echo "reply is ";
var_dump($reply);
echo "\n";
// echo "replyy is ";
// var_dump($replyy);
// echo "\n";
//print  "乱数 ".$url;
//print "reply は ";
//print "reply は ".$reply."\n";xxxx
//print "replyy は ".$replyy."\n";
////var_dump( $replyy );
//echo "乱数は ".$pieces[0]."\n";//
echo $reply[1]."\n";
echo $pieces[0]."\n";
$l = (int)$pieces[0];
echo $reply[$l]."\n";
// echo $replyy[$l];//////
//$k = 1;
//for($k = 1; $k < 100; $k++){
//print "x ".$dbArray[i]."\n";
//}




//print  $reply;

//print "data";

//print $_POST["data"];
?>