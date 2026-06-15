<?php
// error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode(".", $_POST["data"]);
// var_dump ($pieces);
$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[1];
// $pieces = explode(".", $_POST["data"]);
//print $_POST["data"];
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');

// var_dump($pieces);
if( $mysqli->connect_errno){
    echo 'Access Failed5';//謗･邯壼､ｱ謨・
    exit;
}

$query = "select * from $db_name Where questionnumber = $questionnumber";//
// echo $query."\n"."\n";

$result = $mysqli->query($query);

$row_cnt = mysqli_num_rows($result);
// print "row_cnt is ".$row_cnt."\n"."\n";

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1繝ｬ繧ｳ繝ｼ繝峨★縺､隱ｭ縺ｿ霎ｼ繧
        //name蛻励ｒ陦ｨ遉ｺ縺吶ｋ蝣ｴ蜷・
        $reply = $row["poorat"];

    }
}
else {
    echo 'Run Failed6';
}
//print  $url;

print  $reply;

//print  "荵ｱ謨ｰ ".$url;
//print "reply 縺ｯ ";


//print "data";


?>
