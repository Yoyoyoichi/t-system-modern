?<?php
require_once 'db_wrapper.php';
error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^", $_POST["data"]);
// var_dump ($pieces);
$questionnumber = $pieces[0];///
// $DB_name =  $pieces[1];
$db_name =  $pieces[1];
// $pieces = explode("^", $_POST["data"]);
//print $_POST["data"];
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');

// var_dump($pieces);
if( $mysqli->connect_errno){
    echo 'Access Failed5';//接続失敗
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
        //1レコードずつ読み込む
        //name列を表示する場合
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
// 　　　　echo "Level".$row["q_level"]." ";
    echo "Level：".$row["q_level"]." ";
    echo '<br>';
    echo "正解数：".$row["correct2"]." 不正解数：".$row["incorrect2"];
    echo '<br>';
    echo "前回：".substr($row['pre_qdate'],0,33);
    echo '<br>';
    echo "記録：".$row['q_record']."^^^";
             // echo $reply[1]["q_record"];

    }
}
else {
    echo '問題がありません。';
}
//print  $url;

echo  $reply;
echo $imagefolder;
// echo "\n"."ここ以降は今開発中"."\n"."テストナンバー $testnumber";///aaaaaaあああ
// print  "問題数は ".$row_cnt."\n";///あああ
//print  "乱数 ".$url;
//print "reply は ";


//print "data";





mysqli_close($mysqli);

?>

