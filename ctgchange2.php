?<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// print $_POST["data"]."\n"."\n";
$pieces = explode("^", $_POST["data"]);
// var_dump ($pieces);
// print $pieces[0]."\n"."\n";
// print $pieces[1]."\n"."\n";;
$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[0];
$db_column = $pieces[1];
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');

// var_dump($pieces);
if( $mysql->connect_errno){
  echo 'Access Failed5';//接続失敗
  exit;
}

$query = "select category3 from $db_name Where category2 = '$db_column'";//
// echo $query."\n"."\n";

$result = $mysqli->query($query);
//

// // print "row_cnt is ".$row_cnt."\n"."\n";
//
if( $result = $mysqli->query($query) ){
  while($row = $result->fetch_assoc() ){
      //1レコードずつ読み込む
      //name列を表示する場合
        $reply[] = $row["category3"];
//        var_dump( $replyy );

  }
}
else {
    echo 'Run Failed6';
}

$reply = array_values(array_unique($reply));
// print_r("reply is ".$reply)."\n"."\n";
$row_cnt = count($reply);
// print  "row_cnt is ".$row_cnt."\n"."\n";
// //
// echo "1"."\n"."\n";
for($i = 0; $i < $row_cnt; $i++){
// echo "2"."\n"."\n";
$reply2 = $reply2.",".$reply[$i];
}
// print_r($reply2);
// $reply2 = json_encode($reply);
// print  "問題数は ".$row_cnt."\n";
echo $reply2;
//print "data";


?>

