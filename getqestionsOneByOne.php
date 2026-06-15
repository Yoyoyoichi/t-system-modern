<?php
// error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

// echo "19bb"."\n"."\n";
$pieces = explode(".", $_POST["data"]);
// var_dump($pieces);
//echo "\n"."\n";


// echo $DB."\n"."\n";

//
$rand = $pieces[0];
$category1 = $pieces[1];//
$category1= explode("@", $category1);

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
// echo "category2 is ";
// print_r($category2)."\n";

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
var_dump($pieces);
// echo "category1 is ".$category1."\n"."\n";

$categoryFlag = false;

  $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
  if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

  //デフォルト文字セットを設定
  $mysqli->set_charset("utf8");


if (is_array($category1)) {
//   $str_sql = "select questionnumber from $db_name where (category1 = '$category1[0]'";
  // for 文
  // echo "count(category1) is ";
  // print_r(count($category1));
  // echo "\n"."\n";

  
  for($i = 0; $i < count($category1); $i++){
    // echo $i."\n"."\n";
    // echo "i is ";
    // echo $i."\n"."\n";
    $str_sql = "select questionnumber from $db_name where (category1 = '$category1[$i]')
                And ($category4 $operator1 $criteria1) LIMIT 1";
    $row = "";

    $result = $mysqli->query($str_sql);
    // var_dump($result);
    $row_cnt = mysqli_num_rows($result);
    // echo "row_cnt is ".$row_cnt."\n"."\n";
    // $reply[] = "";
    // echo "\n"."\n";
    // echo $str_sql;/////
    // echo "\n"."\n";
    if( $result = $mysqli->query($str_sql) ){
        while($row = $result->fetch_assoc() ){
            $reply[] = $row['questionnumber'];/////
        }
    } else {
        echo '問題がありません。';
    }
    // echo "\n"."\n";
    // echo "reply"."\n"."\n";
    // // var_dump($reply);
    // print_r($reply)."\n";
    // echo "\n"."\n";
  }
//   $str_sql = $str_sql.")";
//   $categoryFlag = true;
} else {

  switch ($category1 == "" or !$category1) {
      case true:
         // echo "1"."\n"."\n";
        //   $str_sql = "select questionnumber from $db_name";
          break;
      case !true:
         // echo "2"."\n"."\n";
        //   $str_sql = "select questionnumber from $db_name where category1 = '$category1'";
        //   $categoryFlag = true;
          break;
  }
}


switch ($category2 == "" or $category2 == 'nul') {
    case true:
        // if($category2 == 'nul'){echo "3.11"."\n"."\n";}  //
        break;
    case false:

      if (is_array($category2)) {
        for($i = 0; $i < count($category2); $i++){
          // echo $i."\n"."\n";
          // echo "i is ";
          // echo $i."\n"."\n";
          $str_sql = "select questionnumber from $db_name where (category2 = '$category2[$i]')
                      And ($category4 $operator1 $criteria1) LIMIT 1";
          $row = "";
      
          $result = $mysqli->query($str_sql);
          // var_dump($result);
          $row_cnt = mysqli_num_rows($result);
          // echo "row_cnt is ".$row_cnt."\n"."\n";
          // $reply[] = "";
          // echo "\n"."\n";
          // echo $str_sql;/////
          // echo "\n"."\n";
          if( $result = $mysqli->query($str_sql) ){
              while($row = $result->fetch_assoc() ){
                  $reply[] = $row['questionnumber'];/////
              }
          } else {
              echo '問題がありません。';
          }
          // echo "\n"."\n";
          // echo "reply"."\n"."\n";
          // // var_dump($reply);
          // print_r($reply)."\n";
          // echo "\n"."\n";
        }
      } else {
  	    if ($categoryFlag) {
  		    // $str_sql = $str_sql." And category2 = '$pieces[2]'";//
          	// $categoryFlag = true;
    		} else {
    		    // $str_sql = $str_sql." Where category2 = '$pieces[2]'";//
            	// $categoryFlag = true;
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
    //   $str_sql = "select questionnumber from $db_name where (category3 = '$category3[0]'";
      for($i = 0; $i < count($category3); $i++){
        // echo $i."\n"."\n";
        // echo "i is ";
        // echo $i."\n"."\n";
        $str_sql = "select questionnumber from $db_name where (category3 = '$category3[$i]')
                    And ($category4 $operator1 $criteria1) LIMIT 1";
        $row = "";
    
        $result = $mysqli->query($str_sql);
        // var_dump($result);
        $row_cnt = mysqli_num_rows($result);
        // echo "row_cnt is ".$row_cnt."\n"."\n";
        // $reply[] = "";
        // echo "\n"."\n";
        // echo $str_sql;/////
        // echo "\n"."\n";
        if( $result = $mysqli->query($str_sql) ){
            while($row = $result->fetch_assoc() ){
                $reply[] = $row['questionnumber'];/////
            }
        } else {
            echo '問題がありません。';
        }
        // echo "\n"."\n";
        // echo "reply"."\n"."\n";
        // // var_dump($reply);
        // print_r($reply)."\n";
        // echo "\n"."\n";
      }
    //   $str_sql = $str_sql.")";
    //   $categoryFlag = true;
    } else {
  		if ($categoryFlag) {
  		    // $str_sql = $str_sql." And category3 = '$pieces[3]'";//
          	// $categoryFlag = true;
  		} else {
  		    // $str_sql = $str_sql." Where category3 = '$pieces[3]'";//
          	// $categoryFlag = true;
  		}
    }
}
switch ($category7 == "" or $category7 == 'nul') {
    case true:
        break;
    case !true:
		//if else
    if (is_array($category7)) {
    //   $str_sql = "select questionnumber from $db_name where (category4 = '$category7[0]'";
      // for 文
      for($i = 1; $i < count($category7); $i++){
        // $str_sql = $str_sql." OR category4 = '$category7[$i]'";
      }
    //   $str_sql = $str_sql.")";
    //   $categoryFlag = true;
    } else {
  		if ($categoryFlag) {
  		    // $str_sql = $str_sql." And category4 = '$pieces[17]'";//
          	// $categoryFlag = true;
  		} else {
  		    // $str_sql = $str_sql." Where category4 = '$pieces[17]'";//
          	// $categoryFlag = true;
  		}
    }
}

switch ($category8 == "" or $category8 == 'nul') {
  case true:
      break;
  case !true:
  //if else
  if (is_array($category8)) {
    // $str_sql = "select questionnumber from $db_name where (category5 = '$category8[0]'";
    // for 文
    for($i = 1; $i < count($category8); $i++){
    //   $str_sql = $str_sql." OR category5 = '$category8[$i]'";
    }
    // $str_sql = $str_sql.")";
    // $categoryFlag = true;
  } else {
    if ($categoryFlag) {
        // $str_sql = $str_sql." And category5 = '$pieces[18]'";//
        //   $categoryFlag = true;
    } else {
        // $str_sql = $str_sql." Where category5 = '$pieces[18]'";//
        //   $categoryFlag = true;
    }
  }
}
switch ($category4 == "" or $category4 == 'nul') {
    case true:
        break;
    case !true:
		if ($categoryFlag) {
		    // $str_sql = $str_sql." And $category4 $operator1 $criteria1";//
        	// $categoryFlag = true;
		} else {
		    // $str_sql = $str_sql." Where $category4 $operator1 $criteria1";//
        	// $categoryFlag = true;
		}

}
switch ($category5 == "" or $category5 == 'nul') {
    case true:
        break;
    case !true:
		if ($categoryFlag) {
		    // $str_sql = $str_sql." And $category5 $operator2 $criteria2";//
        	// $categoryFlag = true;
		} else {
		    // $str_sql = $str_sql." Where $category5 $operator2 $criteria2";//
        	// $categoryFlag = true;
		}

}
switch ($category6 == "" or $category6 == 'nul') {
    case true:
        break;
    case !true:
		if ($categoryFlag) {
		    // $str_sql = $str_sql." And $category6 $operator3 $criteria3";//
        	// $categoryFlag = true;
		} else {
		    // $str_sql = $str_sql." Where $category6 $operator3 $criteria3";//
        	// $categoryFlag = true;
		}

}

switch ($poorat2 == "") {
    case true:
        break;
    case !true:
        if ($categoryFlag) {
            // $str_sql = $str_sql." And poorat = '$poorat2'";//
            // $categoryFlag = true;
        } else {
            // $str_sql = $str_sql." Where poorat = '$poorat2'";//
            // $categoryFlag = true;
        }

}
switch ($wordsearch == "") {
    case true:
        break;
    case !true:
        if ($categoryFlag) {
            // $str_sql = $str_sql." And (question like '%$wordsearch%' or answer1 like '%$wordsearch%')";//
            // $categoryFlag = true;
        } else {
            // $str_sql = $str_sql." Where (question like '%$wordsearch%' or answer1 like '%$wordsearch%')";//
            // $categoryFlag = true;
        }

}

switch ($qlevel == "") {
    case true:
        break;
    case !true:
        if ($categoryFlag) {
            // $str_sql = $str_sql." And q_level = '$qlevel'";//
            // $categoryFlag = true;
        } else {
            // $str_sql = $str_sql." Where q_level = '$qlevel'";//
            // $categoryFlag = true;
        }

}

// $halfanyearago = date('Ymd', strtotime('-6 month'));
// if ($category4 == "qdate" and $category5 == "qdate" and $category6 == "qdate" and $operator1 == "=" and $operator2 == "=" and $operator3 == "=") {
//   $str_sql = "select questionnumber from $db_name where (REPLACE(pre_qdate,'-','') like '%$pieces[10]')
//   OR (REPLACE(pre_qdate,'-','') like '%$pieces[11]') or (REPLACE(pre_qdate,'-','') like '%$pieces[12]')
//   OR (REPLACE(pre_qdate,'-','') = '%$halfanyearago')" ;//最初にやった日が忘却曲線の問題

//   $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
//   if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//   //デフォルト文字セットを設定
//   $mysqli->set_charset("utf8");
//   $row = "";



//   $result = $mysqli->query($str_sql);
//   // //var_dump($result);
//   $row_cnt = mysqli_num_rows($result);

//   $reply[] = "";

//   if( $result = $mysqli->query($str_sql) ){
//       while($row = $result->fetch_assoc() ){
//           $reply[] = $row['questionnumber'];/////
//       }
//   }
//   else {
//       echo '問題がありません。';
//   }

//   // echo "reply"."\n";
//   // var_dump($reply);
//   // echo "\n"."\n";

//   $str_sql = "select questionnumber from $db_name where qdate = current_date" ;

//   $result = $mysqli->query($str_sql);
//   $row_cnt = mysqli_num_rows($result);
//   // echo "row_cnt".$row_cnt."\n";
//   $reply3[] = "";

//   if( $result = $mysqli->query($str_sql) ){
//       while($row = $result->fetch_assoc() ){
//           $reply3[] = $row['questionnumber'];/////
//       }
//   }
//   else {
//       echo '問題がありません。';
//   }

//   // echo "reply3"."\n";
//   // var_dump($reply3);
//   // echo "\n"."\n";

//   if (!count($reply3)==0){

//     $reply2 ="";
//     //削除実行
//     $reply2 = array_diff($reply, $reply3);
//     // //indexを詰める
//     $reply2 = array_values($reply2);
//     // array_unshift($reply2, "");
//     // echo "reply2"."\n";
//     // var_dump($reply2);
//     // echo "\n"."\n";

//     $reply4 ="";

//     for($i = 0; $i < count($reply2); $i++){
//         if ($i == 0) {
//             $reply4= $reply2[$i];
//         } else {
//             $reply4 = $reply4.",".$reply2[$i];
//         }
//     }

//     if (count($reply2) == 1) {
//       echo $reply4[0];
//     } else {
//       echo $reply4;
//     }
//       mysqli_close($mysqli);

//   } elseif (!count($reply)==0) {

//     $reply4 ="";

//     for($i = 0; $i < count($reply); $i++){
//         if ($i == 0) {
//             $reply4= $reply[$i];
//         } else {
//             $reply4 = $reply.",".$reply[$i];
//         }
//     }

//     if (count($reply) == 1) {
//       echo $reply4[0];
//     } else {
//       echo $reply4;
//     }
//     mysqli_close($mysqli);

//   }else{

//   }

// }else{
//   // echo "elseにきた"."\n";
//   echo $str_sql."\n";
  // $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
  // if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

  // //デフォルト文字セットを設定
  // $mysqli->set_charset("utf8");
  // $row = "";

  // $result = $mysqli->query($str_sql);
  // // //var_dump($result);
  // $row_cnt = mysqli_num_rows($result);
  // // echo "row_cnt is ".$row_cnt."\n"."\n";
  // $reply[] = "";
  // // echo $str_sql;/////
  // if( $result = $mysqli->query($str_sql) ){
  //     while($row = $result->fetch_assoc() ){
  //         $reply[] = $row['questionnumber'];/////
  //     }
  // }
  // else {
  //     echo '問題がありません。';
  // }
  // echo "reply"."\n";
  // var_dump($reply);
  // echo "\n"."\n";
  // echo "\n"."\n";
  // echo "reply"."\n"."\n";
  // print_r($reply)."\n";
  // echo "\n"."\n";
  $reply2 ="";

  for($i = 0; $i < count($reply); $i++){
    // echo "\n"."\n";
    // echo $i;
    // echo "\n"."\n";
    if ($i == 0) {
      $reply2= $reply[$i];
      // echo "reply2"."\n";
      // print_r($reply2);
      // echo "\n"."\n";
    } else {
      $reply2 = $reply2.",".$reply[$i];
      // echo "reply2"."\n";
      // print_r($reply2);
      // echo "\n"."\n";
    }
  }

  // echo "reply2"."\n";
  // var_dump($reply2);
  // echo "\n"."\n";
  echo "^^^";
  if (count($reply) == 1) {
    echo $reply[1];
  } else {
    echo $reply2;
  }
  mysqli_close($mysqli);

// }



function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
?>
