<?php
// error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^^", $_POST["data"]);
// echo "modifyqa pieces is".$pieces."\n"."\n";
// var_dump ($pieces);
// for 文
for($i = 0; $i < count($pieces); $i++){
  $pieces[$i] = addslashes($pieces[$i]);
}
var_dump ($pieces);

// $questionnumber = $pieces[44];///
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
// $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");

$str_sql = "SELECT max(questionnumber) FROM  $pieces[45]";


$result = $mysqli->query($str_sql);
// var_dump ($result);

$result2  = $result->fetch_assoc();
// var_dump ($result2);
$maxQuestionNumber = $result2['max(questionnumber)'] +1;
echo $maxQuestionNumber;



if(!$pieces[44]=="")
{
  $sql = "UPDATE $pieces[45] SET
  question = '$pieces[15]',
  answer1 = '$pieces[0]',
  answer2 = '$pieces[1]',
  answer3 = '$pieces[2]',
  answer4 = '$pieces[3]',
  answer5 = '$pieces[4]',
  answer6 = '$pieces[5]',
  answer7 = '$pieces[6]',
  answer8 = '$pieces[7]',
  answer9 = '$pieces[8]',
  answer10 = '$pieces[9]',
  answer11 = '$pieces[10]',
  answer12 = '$pieces[11]',
  answer13 = '$pieces[12]',
  answer14 = '$pieces[13]',
  answer15 = '$pieces[14]',
  category1 = '$pieces[16]',
  category2 = '$pieces[17]',
  category3 = '$pieces[18]',
  qsentence = '$pieces[19]',
  imagefolder = '$pieces[20]',
  hint = '$pieces[23]',
  tag = '$pieces[24]',
  q_level = '$pieces[34]',
  poorat = '$pieces[36]',
  q_record = '$pieces[37]',
  incorrect = '$pieces[39]',
  correct = '$pieces[40]',
  pre_qdate = '$pieces[41]',
  pca = '$pieces[42]',
  qdate = '$pieces[43]',
  category4 = '$pieces[46]',
  category5 = '$pieces[47]'
  WHERE questionnumber = '$pieces[44]'";
  echo " sql is ".$sql."\n"."\n";
  var_dump ($pieces);  
  echo "\n"."\n";
  echo "^^^^".$pieces[44];  
  // SQL実行
  $res = $mysqli->query($sql);
} else {
  $str_sql = "insert into $pieces[45]
    (answer1, answer2, answer3, answer4, answer5,
    answer6, answer7, answer8, answer9, answer10,
    answer11, answer12, answer13, answer14, answer15,
    question, category1, category2, category3, qsentence,imagefolder,
    hint, q_level,  poorat, q_record,
    incorrect, correct, pre_qdate, pca, qdate,
    questionnumber,category4,category5,tag)
    select '$pieces[0]','$pieces[1]','$pieces[2]','$pieces[3]','$pieces[4]',
           '$pieces[5]','$pieces[6]','$pieces[7]','$pieces[8]','$pieces[9]',
           '$pieces[10]','$pieces[11]','$pieces[12]','$pieces[13]','$pieces[14]',
           '$pieces[15]','$pieces[16]','$pieces[17]','$pieces[18]','$pieces[19]','$pieces[20]',
           '$pieces[23]','$pieces[34]','$pieces[36]','$pieces[37]',
           '$pieces[39]','$pieces[40]','$pieces[41]','$pieces[42]','$pieces[43]',
           '$maxQuestionNumber','$pieces[46]','$pieces[47]','$pieces[24]'
    where NOT EXISTS (select 1 from $pieces[45] where question = '$pieces[15]' AND answer1 = '$pieces[0]')";
    echo "sql is ".$str_sql."\n"."\n";
    echo "^^^^".$maxQuestionNumber;    
  $res = $mysqli->query($str_sql);
}







//データ更新
// $sql = "UPDATE $db_name SET
//     question = '$modifiedquestion',
//     answer1 = '$modifiedanswer'
//     WHERE questionnumber = '$questionnumber'";

// echo "<pre>";
// var_dump($sql);
// echo "</pre>";
// echo "mdf98 sql is ".$sql."\n"."\n";




//print  $res;
//print  $url;
//$reply ="";
// $query = "select * from $db_name Where `questionnumber` = $questionnumber";

// $result = $mysqli->query($query);
// if( $result = $mysqli->query($query) ){
//     while($row = $result->fetch_assoc() ){

//        $reply = $row["correct"];
//        $reply2 = $row["incorrect"];
//     }
// }




// print  $reply.":".$reply2;
?>
