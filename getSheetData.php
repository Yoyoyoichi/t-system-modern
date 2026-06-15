<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

// echo "19bb"."\n"."\n";
$data = $_POST["data"];
// echo $data;
// echo "\n"."\n";
$replace = addslashes($data);
$pieces = explode(".....", $replace);
// echo $replace;
// echo "\n"."\n";


// echo $DB."\n"."\n";

//
$rand = $pieces[0];
$category1 = $pieces[1];//
$category1= explode("@", $category1);
// echo "category1 is ";
// print_r($category1)."\n";
if (count($category1)<=1) {
  $category1 = implode($category1);
}

$category2 = $pieces[2];
$category2= explode("@", $category2);
if (count($category2)<=1) {
  $category2 = implode($category2);
}

$category3 = $pieces[3];
$category3= explode("@", $category3);
if (count($category3)<=1) {
  $category3 = implode($category3);
}

$category7 = $pieces[17];
$category7= explode("@", $category7);
if (count($category7)<=1) {
  $category7 = implode($category7);
}

$category8 = $pieces[18];
$category8= explode("@", $category8);
if (count($category8)<=1) {
  $category8 = implode($category8);
}

$question = $pieces[19];
$question= explode("@", $question);
if (count($question)<=1) {
  $question = implode($question);
}
// echo "\n"."\n";
// var_dump($question);
// echo "\n"."\n";

$category4 = $pieces[4];
$category5 = $pieces[5];
$category6 = $pieces[6];///
$operator1 = $pieces[7];
$operator2 = $pieces[8];
$operator3 = $pieces[9];
$criteria1 = $pieces[10];
$criteria2 = $pieces[11];
$criteria3 = $pieces[12];
$db_name = $pieces[13];
$poorat2 = $pieces[14];
$wordsearch = $pieces[15];
$qlevel = $pieces[16];
// var_dump($pieces);
// echo "category1 is ".$category1."\n"."\n";
$categories ="answer1,question,category1,category2,category3,category4,category5,questionnumber,tag,imagefolder,qsentence";
$categoryFlag = false;
if (is_array($category1)) {
  $str_sql = "select $categories from $db_name where (category1 = '$category1[0]'";
  // for 文
  for($i = 1; $i < count($category1); $i++){
    $str_sql = $str_sql." OR category1 = '$category1[$i]'";
  }
  $str_sql = $str_sql.")";
  $categoryFlag = true;
} else {

  switch ($category1 == "" or !$category1) {
      case true:
         // echo "1"."\n"."\n";
          $str_sql = "select $categories from $db_name";
          break;
      case !true:
         // echo "2"."\n"."\n";
          $str_sql = "select $categories from $db_name where category1 = '$category1'";
          $categoryFlag = true;
          break;
  }
}


switch ($category2 == "" or $category2 == 'nul') {
    case true:
        if($category2 == 'nul'){echo "3.11"."\n"."\n";}  //
        break;
    case false:

      if (is_array($category2)) {
        $str_sql = "select $categories from $db_name where (category2 = '$category2[0]'";
        // for 文
        for($i = 1; $i < count($category2); $i++){
          $str_sql = $str_sql." OR category2 = '$category2[$i]'";
        }
        $str_sql = $str_sql.")";
        $categoryFlag = true;
      } else {
  	    if ($categoryFlag) {
  		    $str_sql = $str_sql." And category2 = '$pieces[2]'";//
          	$categoryFlag = true;
    		} else {
    		    $str_sql = $str_sql." Where category2 = '$pieces[2]'";//
            	$categoryFlag = true;
    		}
      }
    break;
}
switch ($category3 == "" or $category3 == 'nul') {
    case true:
        break;
    case !true:
		//if else
    if (is_array($category3)) {
      $str_sql = "select $categories from $db_name where (category3 = '$category3[0]'";
      // for 文
      for($i = 1; $i < count($category3); $i++){
        $str_sql = $str_sql." OR category3 = '$category3[$i]'";
      }
      $str_sql = $str_sql.")";
      $categoryFlag = true;
    } else {
  		if ($categoryFlag) {
  		    $str_sql = $str_sql." And category3 = '$pieces[3]'";//
          	$categoryFlag = true;
  		} else {
  		    $str_sql = $str_sql." Where category3 = '$pieces[3]'";//
          	$categoryFlag = true;
  		}
    }
}
switch ($category7 == "" or $category7 == 'nul') {
    case true:
        break;
    case !true:
		//if else
    if (is_array($category7)) {
      $str_sql = "select $categories from $db_name where (category4 = '$category7[0]'";
      // for 文
      for($i = 1; $i < count($category7); $i++){
        $str_sql = $str_sql." OR category4 = '$category7[$i]'";
      }
      $str_sql = $str_sql.")";
      $categoryFlag = true;
    } else {
  		if ($categoryFlag) {
  		    $str_sql = $str_sql." And category4 = '$pieces[17]'";//
          	$categoryFlag = true;
  		} else {
  		    $str_sql = $str_sql." Where category4 = '$pieces[17]'";//
          	$categoryFlag = true;
  		}
    }
}

switch ($category8 == "" or $category8 == 'nul') {
  case true:
      break;
  case !true:
  //if else
  if (is_array($category8)) {
    $str_sql = "select $categories from $db_name where (category5 = '$category8[0]'";
    // for 文
    for($i = 1; $i < count($category8); $i++){
      $str_sql = $str_sql." OR category5 = '$category8[$i]'";
    }
    $str_sql = $str_sql.")";
    $categoryFlag = true;
  } else {
    if ($categoryFlag) {
        $str_sql = $str_sql." And category5 = '$pieces[18]'";//
          $categoryFlag = true;
    } else {
        $str_sql = $str_sql." Where category5 = '$pieces[18]'";//
          $categoryFlag = true;
    }
  }
}

switch ($question == "" or $question == 'nul') {
  case true:
      break;
  case !true:
  //if else
  if (is_array($question)) {
    $str_sql = "select $categories from $db_name where (question = '$question[0]'";
    // for 文
    for($i = 1; $i < count($question); $i++){
      $str_sql = $str_sql." OR question = '$question[$i]'";
    }
    $str_sql = $str_sql.")";
    $categoryFlag = true;
  } else {
    if ($categoryFlag) {
        $str_sql = $str_sql." And question = '$pieces[19]'";//
          $categoryFlag = true;
    } else {
        $str_sql = $str_sql." Where question = '$pieces[19]'";//
          $categoryFlag = true;
    }
  }
}

switch ($category4 == "" or $category4 == 'nul') {
    case true:
        break;
    case !true:
		if ($categoryFlag) {
		    $str_sql = $str_sql." And $category4 $operator1 $criteria1";//
        	$categoryFlag = true;
		} else {
		    $str_sql = $str_sql." Where $category4 $operator1 $criteria1";//
        	$categoryFlag = true;
		}

}
switch ($category5 == "" or $category5 == 'nul') {
    case true:
        break;
    case !true:
		if ($categoryFlag) {
		    $str_sql = $str_sql." And $category5 $operator2 $criteria2";//
        	$categoryFlag = true;
		} else {
		    $str_sql = $str_sql." Where $category5 $operator2 $criteria2";//
        	$categoryFlag = true;
		}

}
switch ($category6 == "" or $category6 == 'nul') {
    case true:
        break;
    case !true:
		if ($categoryFlag) {
		    $str_sql = $str_sql." And $category6 $operator3 $criteria3";//
        	$categoryFlag = true;
		} else {
		    $str_sql = $str_sql." Where $category6 $operator3 $criteria3";//
        	$categoryFlag = true;
		}

}

switch ($poorat2 == "") {
    case true:
        break;
    case !true:
        if ($categoryFlag) {
            $str_sql = $str_sql." And poorat = '$poorat2'";//
            $categoryFlag = true;
        } else {
            $str_sql = $str_sql." Where poorat = '$poorat2'";//
            $categoryFlag = true;
        }

}
switch ($wordsearch == "") {
    case true:
        break;
    case !true:
        if ($categoryFlag) {
            $str_sql = $str_sql." And (question like '%$wordsearch%' 
            or answer1 like '%$wordsearch%' 
            or answer2 like '%$wordsearch%' 
            or answer3 like '%$wordsearch%' 
            or answer4 like '%$wordsearch%' 
            or answer5 like '%$wordsearch%' 
            or category1 like '%$wordsearch%' 
            or category2 like '%$wordsearch%' 
            or category3 like '%$wordsearch%' 
            or category4 like '%$wordsearch%' 
            or category5 like '%$wordsearch%' 
            or hint like '%$wordsearch%'
            or tag like '%$wordsearch%'
            )";//
            $categoryFlag = true;
        } else {
            $str_sql = $str_sql." Where (question like '%$wordsearch%' 
            or answer1 like '%$wordsearch%'               
            or answer2 like '%$wordsearch%' 
            or answer3 like '%$wordsearch%' 
            or answer4 like '%$wordsearch%' 
            or answer5 like '%$wordsearch%'           
            or category1 like '%$wordsearch%' 
            or category2 like '%$wordsearch%' 
            or category3 like '%$wordsearch%' 
            or category4 like '%$wordsearch%' 
            or category5 like '%$wordsearch%' 
            or hint like '%$wordsearch%'
            or tag like '%$wordsearch%')";//
            $categoryFlag = true;
        }

}

switch ($qlevel == "") {
    case true:
        break;
    case !true:
        if ($categoryFlag) {
            $str_sql = $str_sql." And q_level = '$qlevel'";//
            $categoryFlag = true;
        } else {
            $str_sql = $str_sql." Where q_level = '$qlevel'";//
            $categoryFlag = true;
        }

}



// echo "elseにきた"."\n";
echo $str_sql."\n";
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");
$row = array();

$result = $mysqli->query($str_sql);
// //var_dump($result);
$row_cnt = mysqli_num_rows($result);
// echo "row_cnt is ".$row_cnt."\n"."\n";
$reply = array();

if( $result = $mysqli->query($str_sql) ){
    while($row = $result->fetch_assoc() ){
        $reply[] =  $row["question"];
//     }
    }
}
else {
    echo '問題がありません。1';
}

// echo "reply"."\n";
// var_dump($reply);
// echo "\n"."\n";
$reply2 ="";

for($i = 0; $i < count($reply); $i++){
    if ($i == 0) {

    }elseif($i == 1){
      $reply2= $reply[$i];
    } else {
      $reply2 = $reply2.",".$reply[$i];
    }
}

// echo "reply2"."\n";
// var_dump($reply2);
// echo "^^^";

// if ($row_cnt == 1) {
//   echo $reply[1];
// } else {
//   echo $reply2;
// }
$reply = [];
$row = [];
if( $result = $mysqli->query($str_sql) ){
    while($row = $result->fetch_assoc() ){
        $reply[] =  $row["answer1"];
//     }
    }
}
else {
    echo '問題がありません。2';
}

// echo "reply"."\n";
// var_dump($reply);
// echo "\n"."\n";
$reply2 ="";

for($i = 0; $i < count($reply); $i++){
    if ($i == 0) {

    }elseif($i == 1){
      $reply2= $reply[$i];
    } else {
      $reply2 = $reply2.",".$reply[$i];
    }
}

// echo "reply2"."\n";
// var_dump($reply2);
// echo "^^^";

// if ($row_cnt == 1) {
//   echo $reply[1];
// } else {
//   echo $reply2;
// }

$reply = [];
$row = [];
if( $result = $mysqli->query($str_sql) ){
    while($row = $result->fetch_assoc() ){
        $reply[] =  $row["category1"];
//     }
    }
}
else {
    echo '問題がありません。3';
}

// echo "reply"."\n";
// var_dump($reply);
// echo "\n"."\n";
$reply2 ="";

for($i = 0; $i < count($reply); $i++){
    if ($i == 0) {

    }elseif($i == 1){
      $reply2= $reply[$i];
    } else {
      $reply2 = $reply2.",".$reply[$i];
    }
}

// echo "reply2"."\n";
// var_dump($reply2);
// echo "^^^";

// if ($row_cnt == 1) {
//   echo $reply[1];
// } else {
//   echo $reply2;
// }

require_once('jsonconfig.php');
require_once('jsonfunctions.php');

mb_language("uni");
mb_internal_encoding("utf-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("utf-8");
$dbh = connectDb();
    
$sth = $dbh->prepare($str_sql);

$sth->execute();

$userData = array();
$i = 0;
while($row = $sth->fetch(PDO::FETCH_ASSOC)){
  $userData[]=$row;

}
// echo "<br>"."<br>";
// var_dump($userData[0]);
// echo "<br>"."<br>";



$userData = json_encode($userData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
echo "^^^";
// var_dump($userData[0]);
echo ($userData);


mysqli_close($mysqli);





function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>
