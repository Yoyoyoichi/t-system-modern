?<?php
require_once 'db_wrapper.php';
// error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// print $_POST["data"]."\n"."\n";
$data = $_POST["data"];
// echo $data;
// echo "\n"."\n";
$replace = addslashes($data);
$pieces = explode(".", $replace);
// var_dump ($pieces);
// print $pieces[0]."\n"."\n";
// print $pieces[1]."\n"."\n";;
$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[0];
$category1 = explode("^", $pieces[1]);
$category2 = explode("^", $pieces[2]);
$category3 = explode("^", $pieces[3]);
$category4 = explode("^", $pieces[4]);
$category5 = explode("^", $pieces[5]);
$searchCategory = $pieces[6];
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');

// var_dump($category1);
// var_dump($category2);
// var_dump($category3);
// var_dump($category4);
// var_dump($category5);
if( $mysql->connect_errno){
  echo 'Access Failed5';//接続失敗
  exit;
}
$queryFilledFlag = false;
// var_dump (!($category1[0]===""));
if (!($category1[0]==="")){
  $queryFilledFlag = true;
  if(!$category1[1]){
    $query = "select $searchCategory from $db_name Where category1 = '$category1[0]'";//
  } else {
    $query = "select $searchCategory from $db_name Where category1 = '$category1[0]'";
    for($i = 1; $i < count($category1); $i++){
      $query .= "OR category1 = '$category1[$i]'";//
    }    
  }
}
if (!($category2[0]==="")){
  if ($queryFilledFlag){
    if(!$category2[1]){
      $query .= "AND category2 = '$category2[0]'";//
    }else{
      $query .= "AND category2 = '$category2[0]'";
      for($i = 1; $i < count($category2); $i++){
        $query .= "OR category2 = '$category2[$i]'";//
      }   
    }
  }else{
    if(!$category2[1]){
      $query = "select $searchCategory from $db_name Where category2 = '$category2[0]'";//
    }else{
      $query = "select $searchCategory from $db_name Where category2 = '$category2[0]'";
      for($i = 1; $i < count($category2); $i++){
        $query .= "OR category2 = '$category2[$i]'";//
      }   
    }
  }
}
if (!($category3[0]==="")){
  if ($queryFilledFlag){
    if(!$category3[1]){
      $query .= "AND category3 = '$category3[0]'";//
    }else{
      $query .= "AND category3 = '$category3[0]'";
      for($i = 1; $i < count($category2); $i++){
        $query .= "OR category3 = '$category3[$i]'";//
      }   
    }
  }else{
    if(!$category3[1]){
      $query = "select $searchCategory from $db_name Where category3 = '$category3[0]'";//
    }else{
      $query = "select $searchCategory from $db_name Where category3 = '$category3[0]'";
      for($i = 1; $i < count($category3); $i++){
        $query .= "OR category3 = '$category3[$i]'";//
      }   
    }
  }
}
if (!($category4[0]==="")){
  if ($queryFilledFlag){
    if(!$category4[1]){
      $query .= "AND category4 = '$category4[0]'";//
    }else{
      $query .= "AND category4 = '$category4[0]'";
      for($i = 1; $i < count($category2); $i++){
        $query .= "OR category4 = '$category4[$i]'";//
      }   
    }
  }else{
    if(!$category4[1]){
      $query = "select $searchCategory from $db_name Where category4 = '$category4[0]'";//
    }else{
      $query = "select $searchCategory from $db_name Where category4 = '$category4[0]'";
      for($i = 1; $i < count($category4); $i++){
        $query .= "OR category4 = '$category4[$i]'";//
      }   
    }
  }
}
if (!($category5[0]==="")){
  if ($queryFilledFlag){
    if(!$category5[1]){
      $query .= "AND category5 = '$category5[0]'";//
    }else{
      $query .= "AND category5 = '$category5[0]'";
      for($i = 1; $i < count($category2); $i++){
        $query .= "OR category5 = '$category5[$i]'";//
      }   
    }
  }else{
    if(!$category5[1]){
      $query = "select $searchCategory from $db_name Where category5 = '$category5[0]'";//
    }else{
      $query = "select $searchCategory from $db_name Where category5 = '$category5[0]'";
      for($i = 1; $i < count($category5); $i++){
        $query .= "OR category5 = '$category5[$i]'";//
      }   
    }
  }
}
$query .="AND question != 'settings'";


echo $query;




$result = $mysqli->query($query);
//
// if($result->num_rows == 0) {
//   // row not found, do stuff...
//   echo"0";
// } else {
//  // do other stuff...
//   echo"not 0";
// }
if($result->num_rows != 0 ){
  while($row = $result->fetch_assoc() ){
      //1レコードずつ読み込む
      //name列を表示する場合
        $reply[] = $row[$searchCategory];
  }
  while( ($index = array_search( "", $reply, true )) !== false ) {
    unset( $reply[$index] ) ;
  }
  
  
  $reply = array_values(array_unique($reply));
  // print_r($reply)."\n"."\n";
  // print_r($reply)."\n"."\n";
  $reply = array_filter($reply);
  $reply = array_values($reply);
  // print_r($reply)."\n"."\n";
  
  $row_cnt = count($reply);
  // print  "row_cnt is ".$row_cnt."\n"."\n";
  
  // //
  // echo "1"."\n"."\n";
  for($i = 0; $i < $row_cnt; $i++){
  // echo "2"."\n"."\n";
  $reply2 = $reply2.",,,".$reply[$i];
  }
  // print_r($reply2);
  // $reply2 = json_encode($reply);
  // print  "問題数は ".$row_cnt."\n";
  echo "^^^";
  echo $reply2;
} else {
    // echo 'Run Failed6';
}



?>
