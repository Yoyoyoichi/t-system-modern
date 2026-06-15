<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
$db_name ="MuAnki";
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
        $query = "select * from $db_name Where $pieces[2] < $pieces[3]";
        break;
    case "=":
        $query = "select * from $db_name Where $pieces[2] = $pieces[3]";
        break;
    case ">":
        $query = "select * from $db_name Where $pieces[2] > $pieces[3]";
        break;
}
echo  $query."\n";///

$result = $mysqli->query($query);
$row_cnt = mysqli_num_rows($result);
print "row_cnt is ".$row_cnt."\n";

//$reply ="";

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
         $reply[] = $row["answer1"]."\n".$row["answer2"]."\n".$row["answer3"]."\n".$row["answer4"]."\n".$row["answer5"]."\n".$row["answer6"]."\n".$row["answer7"]."\n".$row["answer8"]."\n".$row["answer9"]."\n".$row["answer10"]."\n".$row["answer11"]."\n".$row["answer12"]."\n".$row["answer13"]."\n".$row["answer14"]."\n".$row["answer15"]."\n";
//   var_dump( $reply );
//   echo "\n";    

    }
}
else {
    echo 'Run Failed6';
}
//print  $url;
$l = (int)$pieces[0];
print  "解答 ".$reply[$l];

//print  "乱数 ".$url;
//print "reply は ";


//print "data";


?>