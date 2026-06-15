<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^^^^^", $_POST["data"]);
// echo "modifyqa pieces is".$pieces."\n"."\n";
var_dump ($pieces);
$questionnumber = $pieces[0];///
$db_name =  $pieces[1];
$modifiedquestion= addslashes($pieces[2]);
$modifiedanswer= addslashes($pieces[3]);
$modifiedhint = addslashes($pieces[4]);

// echo "modifiedanswer is ".$modifiedanswer."\n"."\n";

$pieces2 = explode(",\n", $pieces[3]);
$pieces2[count($pieces2)-1] = str_replace("\n", '',$pieces2[count($pieces2)-1]);
$pieces2[count($pieces2)-1] = str_replace("\r", '',$pieces2[count($pieces2)-1]);
$pieces2[count($pieces2)-1] = str_replace("\r\n", '',$pieces2[count($pieces2)-1]);
echo "pieces2.length-1 is ".$pieces2[count($pieces2)-1];
// print_r("pieces2 is ".$pieces2);
// echo "printr pieces2"."\n";
print_r($pieces2);
// echo "\n"."\n";
// echo "count pieces2"."\n";
// echo(count($pieces2))."\n";
// echo "1"."\n"."\n";

    //螟画焚繧堤｢ｺ隱・


require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();


if( $mysql->connect_errno){
    echo 'Access Failed7';//謗･邯壼､ｱ謨・
    exit;
}
$sql ="SELECT qsentence FROM `$db_name` WHERE questionnumber = '$questionnumber'";

$reply = "";
if( $result = $mysqli->query($sql) ){
    while($row = $result->fetch_assoc() ){
        $reply = $row;/////    }
    }
}else {
    echo 'Run Failed'."\n";
}
$qsentence = $reply['qsentence'];
echo "qsentence is ".$qsentence."\n"."\n";
echo "modifiedquestion is ".$modifiedquestion."\n"."\n";
if(!$qsentence==""){
  $modifiedquestion = str_replace($qsentence."\n"."\n", "", $modifiedquestion);
}
echo "modifiedquestion is ".$modifiedquestion."\n"."\n";

// echo "2"."\n"."\n";
// echo "mdfqa 45 reply is "."\n";
// print_r ($reply);

if(count($pieces2)>1){
  if(!$modifiedanswer==""){
    if(!$modifiedanswer==""){
      $sql = "UPDATE $db_name SET
      question = '$modifiedquestion',
      answer1 = '$pieces2[0]',
      answer2 = '$pieces2[1]',
      answer3 = '$pieces2[2]',
      answer4 = '$pieces2[3]',
      answer5 = '$pieces2[4]',
      answer6 = '$pieces2[5]',
      answer7 = '$pieces2[6]',
      answer8 = '$pieces2[7]',
      answer9 = '$pieces2[8]',
      answer10 = '$pieces2[9]',
      answer11 = '$pieces2[10]',
      answer12 = '$pieces2[11]',
      answer13 = '$pieces2[12]',
      answer14 = '$pieces2[13]',
      answer15 = '$pieces2[14]',
      hint = '$modifiedhint'
      WHERE questionnumber = '$questionnumber'";
    }
  } else {
    if(!$modifiedanswer==""){
      $sql = "UPDATE $db_name SET
      question = '$modifiedquestion',
      hint = '$modifiedhint'
      WHERE questionnumber = '$questionnumber'";
    }
  }
}else{
  if(!$modifiedanswer==""){
      if($modifiedquestion){
        $sql = "UPDATE $db_name SET
        question = '$modifiedquestion',
        answer1 = '$modifiedanswer',
        hint = '$modifiedhint'
        WHERE questionnumber = '$questionnumber'";
      }
  } else {
      if($modifiedquestion){
        $sql = "UPDATE $db_name SET
        question = '$modifiedquestion',
        hint = '$modifiedhint'
        WHERE questionnumber = '$questionnumber'";
      }
  }
}



//繝・・繧ｿ譖ｴ譁ｰ
// $sql = "UPDATE $db_name SET
//     question = '$modifiedquestion',
//     answer1 = '$modifiedanswer'
//     WHERE questionnumber = '$questionnumber'";

// echo "<pre>";
// var_dump($sql);
// echo "</pre>";
echo "mdf98 sql is ".$sql."\n"."\n";

// SQL螳溯｡・
$res = $mysqli->query($sql);


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

