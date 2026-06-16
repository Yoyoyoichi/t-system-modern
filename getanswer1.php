?<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^", $_POST["data"]);
if (count($pieces) <= 1) { $pieces = explode(".", $_POST["data"]); }
// var_dump ($pieces);
$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[1];
// $pieces = explode("^", $_POST["data"]);
if (count($pieces) <= 1) { $pieces = explode(".", $_POST["data"]); }
//print $_POST["data"];
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');

// var_dump($pieces);
if( $mysqli->connect_errno){
    echo 'Access Failed5';//�ڑ����s
    exit;
}

$query = "select * from $db_name Where questionnumber = $questionnumber";//
// echo $query."\n"."\n";

$result = $mysqli->query($query);

$row_cnt = mysqli_num_rows($result);
// print "row_cnt is ".$row_cnt."\n"."\n";

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1���R�[�h���ǂݍ���
        //name���\������ꍇ
        $reply = $row["answer1"];
        for ($i = 2; $i <= 15; $i++) {
        	if(!$row['answer'.$i]==""){
        		$reply = $reply.","."\n".$row['answer'.$i];
			}
		}
        if ($row["hint"]){$reply = $reply."\n............................................................\n".$row["hint"];}

         // $reply[] = $row["answer1"]."\n".$row["answer2"]."\n".$row["answer3"]."\n".$row["answer4"]."\n".$row["answer5"]."\n".$row["answer6"]."\n".$row["answer7"]."\n".$row["answer8"]."\n".$row["answer9"]."\n".$row["answer10"]."\n".$row["answer11"]."\n".$row["answer12"]."\n".$row["answer13"]."\n".$row["answer14"]."\n".$row["answer15"]."\n";
       // var_dump( $replyy );

    }
}
else {
    echo '��肪����܂���B';
}
//print  $url;

print  $reply;

//print  "���� ".$url;
//print "reply �� ";


//print "data";


?>

