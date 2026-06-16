?<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

// echo "19bb"."\n"."\n";
$pieces = explode("^^", $_POST["data"]);
//var_dump($pieces);
//echo "\n"."\n";


// echo $DB."\n"."\n";

//
$db_name = $pieces[0];

$category1 = $pieces[1];//

$category2 = $pieces[2];

$category3 = $pieces[3];

$wordsearch = $pieces[4];

$category4 = $pieces[5];

$category5 = $pieces[6];




switch ($category1 == "" or $category1 == 'nul') {
    case true:
        $str_sql = "select question,questionnumber from $db_name ";
        break;
    case false:
  		  $str_sql = "select question,questionnumber from $db_name where category1 = '$category1'";//
        $categoryFlag = true;
    break;
}
switch ($category2 == "" or $category2 == 'nul') {
    case true:
        // なにもしない
        break;
    case false:
      if ($categoryFlag) {
        $str_sql = $str_sql." And category2 = '$category2'";//
          $categoryFlag = true;
      } else {
          $str_sql = $str_sql." Where category2 = '$category2'";//
            $categoryFlag = true;
      }
    break;
}
switch ($category3 == "" or $category3 == 'nul') {
    case true:
//        echo "4.1"."\n"."\n";
        break;
    case !true:
      if ($categoryFlag) {
        $str_sql = $str_sql." And category3 = '$category3'";//
          $categoryFlag = true;
      } else {
          $str_sql = $str_sql." Where category3 = '$category3'";//
            $categoryFlag = true;
      }
}

switch ($category4 == "" or $category4 == 'nul') {
    case true:
//        echo "4.1"."\n"."\n";
        break;
    case !true:
      if ($categoryFlag) {
        $str_sql = $str_sql." And category4 = '$category4'";//
          $categoryFlag = true;
      } else {
          $str_sql = $str_sql." Where category4 = '$category4'";//
            $categoryFlag = true;
      }
}

switch ($category5 == "" or $category5 == 'nul') {
    case true:
//        echo "4.1"."\n"."\n";
        break;
    case !true:
      if ($categoryFlag) {
        $str_sql = $str_sql." And category5 = '$category5'";//
          $categoryFlag = true;
      } else {
          $str_sql = $str_sql." Where category5 = '$category5'";//
            $categoryFlag = true;
      }
}

switch ($wordsearch == "") {
    case true:
//        echo "7.1"."\n"."\n";
        // なにもしない
        break;
    case !true:
//      echo "7.2".$category6."\/"."\/";
        if ($categoryFlag) {
            $str_sql = $str_sql."
             And (question like '%$wordsearch%' 
             or answer1 like '%$wordsearch%' 
             or hint like '%$wordsearch%' 
             or questionnumber like '%$wordsearch%' 
             or tag like '%$wordsearch%
             or category1 like '%$wordsearch%'
             or category2 like '%$wordsearch%'
             or category3 like '%$wordsearch%'
             or category4 like '%$wordsearch%'
             or category5 like '%$wordsearch%'
             ')";//
            $categoryFlag = true;
        } else {
            $str_sql = $str_sql."
             Where (question like '%$wordsearch%' 
             or answer1 like '%$wordsearch%' 
             or hint like '%$wordsearch%' 
             or questionnumber like '%$wordsearch%' 
             or tag like '%$wordsearch%'
             or category1 like '%$wordsearch%'
             or category2 like '%$wordsearch%'
             or category3 like '%$wordsearch%'
             or category4 like '%$wordsearch%'
             or category5 like '%$wordsearch%'
             )";//
            $categoryFlag = true;
        }

}

$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
// $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");
$row = "";




$result = $mysqli->query($str_sql);
// var_dump($str_sql);

$row_cnt = mysqli_num_rows($result);
$reply[] = "";

if( $result = $mysqli->query($str_sql) ){
//    echo "8.1"."\n"."\n";
    while($row = $result->fetch_assoc() ){
        $reply[] = $row['question']." --- ".$row['questionnumber'];

    }
}
else {
    echo 'Run Failed3';
}

// for 文
$reply2 ="";
for($i = 1; $i <= $row_cnt; $i++){
    if ($i == 1) {
        $reply2= $reply[$i];
    } else {
        $reply2 = $reply2."^^".$reply[$i];
    }
}

if ($row_cnt == 1) {
echo $reply[1];

} else {
echo $reply2;

}
mysqli_close($mysqli);

?>
