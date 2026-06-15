<?php
error_reporting(0);
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
$pre_qdate= "";
$imagefolder ="";
if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1繝ｬ繧ｳ繝ｼ繝峨★縺､隱ｭ縺ｿ霎ｼ繧
        //name蛻励ｒ陦ｨ遉ｺ縺吶ｋ蝣ｴ蜷・
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
// 縲縲縲縲echo "Level".$row["q_level"]." ";
    echo "Level・・.$row["q_level"]." ";
    echo '<br>';
    echo "豁｣隗｣謨ｰ・・.$row["correct2"]." 荳肴ｭ｣隗｣謨ｰ・・.$row["incorrect2"];
    echo '<br>';
    echo "蜑榊屓・・.substr($row['pre_qdate'],0,33);
    echo '<br>';
    echo "險倬鹸・・.$row['q_record']."^^^";
             // echo $reply[1]["q_record"];

    }
}
else {
    echo '蝠城｡後′縺ゅｊ縺ｾ縺帙ｓ縲・;
}
//print  $url;

echo  $reply;
echo $imagefolder;
// echo "\n"."縺薙％莉･髯阪・莉企幕逋ｺ荳ｭ"."\n"."繝・せ繝医リ繝ｳ繝舌・ $testnumber";///aaaaaa縺ゅ≠縺・
// print  "蝠城｡梧焚縺ｯ ".$row_cnt."\n";///縺ゅ≠縺・
//print  "荵ｱ謨ｰ ".$url;
//print "reply 縺ｯ ";


//print "data";





mysqli_close($mysqli);

?>
