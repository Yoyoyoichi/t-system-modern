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
$pre_qdate= "";
$imagefolder ="";
if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1���R�[�h���ǂݍ���
        //name���\������ꍇ
        $imagefolder = $row['imagefolder'];
        // echo ("pre_qdate is ").$pre_qdate."\n";
        $reply = $row["answer1"];
        for ($i = 2; $i <= 15; $i++) {
            if(!$row['answer'.$i]==""){
                $reply = $reply.","."\n".$row['answer'.$i];
            }
        }
         // $reply[] = $row["answer1"]."\n".$row["answer2"]."\n".$row["answer3"]."\n".$row["answer4"]."\n".$row["answer5"]."\n".$row["answer6"]."\n".$row["answer7"]."\n".$row["answer8"]."\n".$row["answer9"]."\n".$row["answer10"]."\n".$row["answer11"]."\n".$row["answer12"]."\n".$row["answer13"]."\n".$row["answer14"]."\n".$row["answer15"];
//        var_dump( $replyy );
// �@�@�@�@echo "Level".$row["q_level"]." ";
    echo "Level�F".$row["q_level"]." ";
    echo '<br>';
    echo "���𐔁F".$row["correct2"]." �s���𐔁F".$row["incorrect2"];
    echo '<br>';
    echo "�O��F".substr($row['pre_qdate'],0,33);
    echo '<br>';
    echo "�L�^�F".$row['q_record']."^^^";
             // echo $reply[1]["q_record"];

    }
}
else {
    echo '��肪����܂���B';
}
//print  $url;

echo  $reply;
echo $imagefolder;
// echo "\n"."�����ȍ~�͍��J����"."\n"."�e�X�g�i���o�[ $testnumber";///aaaaaa������
// print  "��萔�� ".$row_cnt."\n";///������
//print  "���� ".$url;
//print "reply �� ";


//print "data";





mysqli_close($mysqli);

?>

