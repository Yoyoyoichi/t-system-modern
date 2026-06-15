<?php
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
$db_name =  "MuAnki";
// echo "19bb"."\n"."\n";
$pieces = explode(".", $_POST["data"]);
//var_dump($pieces);
//echo "\n"."\n";

$DB=$_GET["DB_name"];
echo $DB."\n"."\n";

//
$rand = $pieces[0];
$category1 = $pieces[1];//
$category2 = $pieces[2];
$category3 = $pieces[3];
$category4 = $pieces[4];
$category5 = $pieces[5];
$category6 = $pieces[6];///
$operator1 = $pieces[7];
$operator2 = $pieces[8];
$operator3 = $pieces[9];
$criteria1 = $pieces[10];
$criteria2 = $pieces[11];
$criteria3 = $pieces[12];
// $DB_name = $pieces[13];
// var_dump($pieces);
//echo "category1 is ".$pieces[1]."\n"."\n";

$categoryFlag = false;
switch ($category1 == "" or $category1 == 'nul') {
    case true:
//        //echo "1"."\n"."\n";
        $str_sql = "select questionnumber from $db_name";
        break;
    case !true:
//        //echo "2"."\n"."\n";
        $str_sql = "select questionnumber from $db_name where category1 = '$pieces[1]'";
        $categoryFlag = true;
        break;
}
// echo "str_sql is ".$str_sql."\n"."\n";//
//echo "3"."\n"."\n";
//echo "category2 is ".$category2."\n"."\n";
//if($category2 == 'nul'){echo "3.01"."\n"."\n";}  

//var_dump();
//echo"\n"."\n";
switch ($category2 == "" or $category2 == 'nul') {
    case true:
        // なにもしない
//        if($category2 == 'nul'){echo "3.01"."\n"."\n";}  
//        if($category2 == ""){echo "3.02"."\n"."\n";}
//        echo "3.1"."\n"."\n";
        // 短いif文
        if($category2 == 'nul'){echo "3.11"."\n"."\n";}  //
        break;
    case false:
//      echo "3.2"."\n"."\n";
//        if($category2 == 'nul'){echo "3.01"."\n"."\n";}  
//        if($category2 == ""){echo "3.02"."\n"."\n";}
	    if ($categoryFlag) {
		    $str_sql = $str_sql." And category2 = '$pieces[2]'";//
        	$categoryFlag = true;
  		} else {
  		    $str_sql = $str_sql." Where category2 = '$pieces[2]'";//
          	$categoryFlag = true;
  		}
//    echo "3.3"."\n"."\n";
    break;
}
//echo "4"."\n"."\n";
//echo "str_sql is ".$str_sql."\n"."\n";
//
//echo "category3 is ".$pieces[3]."\n"."\n";
switch ($category3 == "" or $category3 == 'nul') {
    case true:
//        echo "4.1"."\n"."\n";
        break;
    case !true:
		//if else
		if ($categoryFlag) {
		    $str_sql = $str_sql." And category3 = '$pieces[3]'";//
        	$categoryFlag = true;
		} else {
		    $str_sql = $str_sql." Where category3 = '$pieces[3]'";//
        	$categoryFlag = true;
		}

}
//echo "5"."\n"."\n";
//echo "str_sql is ".$str_sql."\n"."\n";
switch ($category4 == "" or $category4 == 'nul') {
    case true:
//        echo "5.1"."\n"."\n";
        // なにもしない
        break;
    case !true:
//        echo "5.2"."\n"."\n";
		//if else
		if ($categoryFlag) {
		    $str_sql = $str_sql." And $category4 $operator1 $criteria1";//
        	$categoryFlag = true;
		} else {
		    $str_sql = $str_sql." Where $category4 $operator1 $criteria1";//
        	$categoryFlag = true;
		}

}
//echo "6"."\n"."\n";
//echo "str_sql is ".$str_sql."\n"."\n";
switch ($category5 == "" or $category5 == 'nul') {
    case true:
//        echo "6.1"."\n"."\n";
        // なにもしない
        break;
    case !true:
//		echo "6.2".$category5."\/"."\/";
		if ($categoryFlag) {
		    $str_sql = $str_sql." And $category5 $operator2 $criteria2";//
        	$categoryFlag = true;
		} else {
		    $str_sql = $str_sql." Where $category5 $operator2 $criteria2";//
        	$categoryFlag = true;
		}

}
//echo "7"."\n"."\n";
//echo "str_sql is ".$str_sql."\n"."\n";
switch ($category6 == "" or $category6 == 'nul') {
    case true:
//        echo "7.1"."\n"."\n";
        // なにもしない
        break;
    case !true:
//		echo "7.2".$category6."\/"."\/";
		if ($categoryFlag) {
		    $str_sql = $str_sql." And $category6 $operator3 $criteria3";//
        	$categoryFlag = true;
		} else {
		    $str_sql = $str_sql." Where $category6 $operator3 $criteria3";//
        	$categoryFlag = true;
		}

}
//echo "8"."\n"."\n";
//echo "str_sql is ".$str_sql."\n"."\n";

$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");
$row = "";
//データベース取得



$result = $mysqli->query($str_sql);
// //var_dump($result);
$row_cnt = mysqli_num_rows($result);
// print "row_cnt is ".$row_cnt."\n"."\n";

$reply = "";

if( $result = $mysqli->query($str_sql) ){
//    echo "8.1"."\n"."\n";
    while($row = $result->fetch_assoc() ){
        $reply[] = $row;/////
        //var_dump($row);
        
    }
}
else {
    echo 'Run Failed4';
}
//echo ""."\n"."\n";
// echo $reply[3];
// //var_dump($pieces) ;
// var_dump($reply);
// echo "9"."\n"."\n";



// print  "問題数は ".$row_cnt."\n";

$randnum=rand ( 0 , $row_cnt -1);
// print  $randnum;
// echo"\n"."\n";
echo $reply[$randnum]["questionnumber"];
?>
