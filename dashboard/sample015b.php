<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
$db_name =  "MuAnki"; 
// echo "15b","\n";

//$url=$_POST["data"];
$pieces = explode(".", $_POST["data"]);



$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');


if( $mysql->connect_errno){
    echo 'Access Failed3';//接続失敗
    exit;
}
//
//$query = "select * from `MuAnki` ";
//$result = $mysqli->query($query);
//
//$row_cnt = mysqli_num_rows($result);
//printf("Result set has %d rows.\n", $row_cnt);


//$url=$_POST["data"];
//rand ( 1 , $row_cnt );
// echo "pieces is ".$pieces[0]."\n";
switch ($pieces[0]) {
    case "<":
        $query = "select * from $db_name Where $pieces[1] < $pieces[2]";
        break;
    case "=":
        $query = "select * from $db_name Where $pieces[1] = $pieces[2]";
        break;
    case ">":
        $query = "select * from $db_name Where $pieces[1] > $pieces[2]";
        break;
}



// print  "query is ".$query."\n";
$result = $mysqli->query($query);

// var_dump( $result );
// print "result is ".$result."\n";
// echo "result is ".$result."\n";

$row_cnt = mysqli_num_rows($result);
// print  "問題数は ".$row_cnt."\n";

$randnum=rand ( 0 , $row_cnt -1);
print  $randnum."\n";

// echo "randnum is ".$randnum;

//$reply ="";
////$replyy = replyy();
//$j = 1;
////$dbArray += $result->fetch_array(MYSQLI_ASSOC);//連想配列に入れるっ   
//if( $result = $mysqli->query($query) ){
//    while($row = $result->fetch_assoc() ){
//        //1レコードずつ読み込む
//        //name列を表示する場合
//        
//       $reply = $reply ."\n". $j." ".$row["16"];
//        $replyy[] = $row["16"];
//        $j = $j + 1;
//        
//        
//
//
//
//
//
//    }
//}
//else {
//    echo 'Run Failed4';
//}
//$row = $result->fetch_assoc() ;



//print  "乱数 ".$url;
//print "reply は ";
//print "reply は ".$reply."\n";
//print "replyy は ".$replyy."\n";
////var_dump( $replyy );
echo $replyy[$randnum];
//$k = 1;
//for($k = 1; $k < 100; $k++){
//print "x ".$dbArray[i]."\n";
//}




//print  $reply;

//print "data";

//print $_POST["data"];
?>