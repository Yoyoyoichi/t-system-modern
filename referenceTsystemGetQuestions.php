<?php
// $testnumber = $testnumber + 1;
// echo $testnumber."\n"."\n";
// error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');
// echo "20e"."\n"."\n";

$pieces = explode(".", $_POST["data"]);


$db_name =  $pieces[0];
$questionnumbers = explode(",", $pieces[1]);

// echo $db_name."\n";
// var_dump ($questionnumbers); 

$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');

if( $mysqli->connect_errno){
    echo 'Access Failed';//謗･邯壼､ｱ謨・
    exit;
}

$result0 = $mysqli->query("set names utf8");

//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
$mysqli->set_charset("utf8");

// //繝・・繧ｿ繝吶・繧ｹ蜿門ｾ・
$str_sql = "
select answer1, question, imagefolder, questionnumber,
answer2,answer3,answer4,answer5,answer6,answer7,answer8,answer9,answer10,
qdate,pre_qdate,qsentence,nextQdate,hint,26,
category3,category4,category5,category1,category2
from $db_name 
where (questionnumber = $questionnumbers[0])
";
for($i = 1; $i < count($questionnumbers); $i++){
    $str_sql .= " OR (questionnumber = $questionnumbers[$i])";
}
    


// echo $str_sql;

$result = $mysqli->query($str_sql);
// $test  = $result->fetch_assoc();
$row = $result->fetch_all();
// var_dump ($row);
$answer[]= array();
$question[] = array();
$questionNumber[] =array();
$imageFolder[]=array();
$hint[]=array();

/** 荵ｱ謨ｰ逕ｨ驟榊・ */
$rands = [];
/** 荵ｱ謨ｰ縺ｮ遽・峇 */
$min = 0; $max = count($row)-1;
 
for($i = $min; $i <= $max; $i++){
  while(true){
    /** 荳譎ら噪縺ｪ荵ｱ謨ｰ繧剃ｽ懈・ */
    $tmp = mt_rand($min, $max);
 
    /*
     * 荵ｱ謨ｰ驟榊・縺ｫ蜷ｫ縺ｾ繧後※縺・ｋ縺ｪ繧駅hile邯夊｡後・
     * 蜷ｫ縺ｾ繧後※縺ｪ縺・↑繧蛾・蛻励↓莉｣蜈･縺励※break 
     */
    if( ! in_array( $tmp, $rands ) ){
      array_push( $rands, $tmp );
      break;
    } 
  }
}


// var_dump ($rands);


echo "^^^^";

for($i = 0; $i < count($row); $i++){
  
  $questionNumber[$i] =$row[$i][3];
  // $sql = "update $db_name
  //     set nextQdate = CURRENT_DATE()   
  //     where questionnumber = $questionnumber[$i]";
  // $result = $mysqli->query($sql);
  // $question[$i] = str_replace(array("\r\n", "\r", "\n"), '<br>', $row[$i][1]);html繧ｳ繝ｼ繝峨ｒ縺縺吶→謾ｹ陦後さ繝ｼ繝峨′譁・ｭ怜・<br>縺ｫ縺ｪ縺｣縺ｦ縺励∪縺・
  $question[$i] = $row[$i][1];
  // $question[$i] = $row[$i][1];
  $answer[$i] = $row[$i][0];
  $category3 [$i] = $row[$i][19];
  $category4 [$i] = $row[$i][20];
  $category5 [$i] = $row[$i][21];
  $category1 [$i] = $row[$i][22];
  $category2 [$i] = $row[$i][23];
  // echo "隍・焚蝗樒ｭ斐メ繧ｧ繝・け";
  // echo "<br>";
  $pre_qdate=$row[$i][14];
  // echo "<br>";
  // if(empty($row[$i][4])) echo '逵溘→隕九↑縺輔ｌ縺ｾ縺吶・;else echo '蛛ｽ縺ｨ隕九↑縺輔ｌ縺ｾ縺吶・;
  if (!empty($row[$i][4])){
    for ($j = 4; $j < 13; $j++) {          
      if(!empty($row[$i][$j])){
        $answer[$i].="<br>".$row[$i][$j];
      } 
    }
  }
  // echo "隍・焚蝗樒ｭ斐メ繧ｧ繝・け蠕・;
  $answer_json = json_encode($answer);
  $questionNumber[$i] =$row[$i][3];
  $imageFolder[$i]=$row[$i][2];
  $imageFolder_json = json_encode($imageFolder);
  $qsentence [$i] = $row[$i][15];
  
  $nextQdate = $row[$i][16];
  $hidHint = $row[$i][17];
  $hidNote = $row[$i][18];
  if (strpos($answer[$i], "jpg")>0) {
    $hidAnswer = json_encode($answer[$i]);   
  } else {
    $hidAnswer = $answer[$i];
  }
    
  
  $hidImageFolder = $imageFolder[$i];
  // echo "\"".strpos($answer[$i], 'style=')."\"";
  // echo "<br>";
  $qTxtArea = "question".$questionNumber[$i];
  $aTxtArea = "answer".$questionNumber[$i];
  $qImgId = "qImg".$questionNumber[$i];
  $aImgId = "aImg".$questionNumber[$i];
  $radio1 = "radioOK".$questionNumber[$i];
  $radio2 = "radioNG".$questionNumber[$i];
  $hidAnswerId = "hidAnswer".$questionNumber[$i];
  $hidImageFolderId = "hidImageFolder".$questionNumber[$i];
  $hidHintId = "hidHint".$questionNumber[$i];
  $hidNoteId = "hidNote".$questionNumber[$i];
  $eraseId = $questionNumber[$i];
  $category345 = $category1[$i]."/".$category2[$i]."/".$category3[$i]."/".$category4[$i]."/".$category5[$i];
  if($i != 0){
    $category3452 = $category1[$i-1]."/".$category2[$i-1]."/".$category3[$i-1]."/".$category4[$i-1]."/".$category5[$i-1];
  } else {
    $category3452 = $category345;
  }


  if (isset($qsentence[$i-1])===false){//蛟､縺悟・縺｣縺ｦ縺・↑縺・°縺ｩ縺・°
    // echo "\n"."\n"."x"."\n"."\n";
    $qsentence1 = $qsentence[$i];
    $qsentence2 = $qsentence[$i]."x"; //譁・ｭ怜・繧偵★繧峨☆
  }else{
    // echo "\n"."\n"."y"."\n"."\n";
    $qsentence1 = $qsentence[$i];
    $qsentence2 = $qsentence[$i-1]; 
  }


  if ($question[$i]===$question[$i-1]&&$qsentence1===$qsentence2){   
  }else{ 
    // echo "\n"."\n"."a"."\n"."\n";
    
    echo "
    <div class='clearfix' style ='min-height:3vh;'>";

    if (($category345!=$category3452)or($i === 0)){
      // echo "\n"."\n"."b"."\n"."\n";
      echo "
      <div class ='category345' style = 'font-size:30px;color: #ff0000;'>$category345</div> 
      ";
    }  


    echo "
      <div class='questionAnsewerBox' style ='margin: 1px;float: left;width:100%;'>";   
      
    

    echo"<div '
          id= $qTxtArea
          class = 'questionTextArea'
          style = '
            font-size:25px;
            background-color: #9fccb0;
            margin: 1px;
            white-space: pre-wrap;
          '>";
  }



  if ((substr($question[$i], -3) != 'jpg') && (substr($question[$i], -3) != 'png') && (substr($question[$i], -3) != 'gif') ){
  // if (strpos($question[$i], "jpg")=== false && strpos($question[$i], "png")=== false && strpos($question[$i], "gif")=== false){
    echo $question[$i];      
  }else{
    if (strpos($question[$i], "ttp")=== false){
      echo "<img class='images' border=2 src= 'images/$imageFolder[$i]/$question[$i]' style = 'max-height:400px;max-width:50vw;background-size: contain;'>";////////////////////////////////////////
    }else{
      echo "<img class='images' border=2 src= '$question[$i]' style = 'max-height:400px;max-width:50vw;background-size: contain;'>";////////////////////////////////////////     
     
    }      
  }                   
  if (strpos($answer[$i], '<p ')=== false){//隗｣遲斐′html隕∫ｴ縺九←縺・°
    echo "</div><div class = 'answerAndButton' style ='display: flex;' >              
          <div                          
            id= $aTxtArea
            class = 'answerTextArea'
            style = '
              font-size:25px;
              background-color: #f8dce0;
              float: left; 
              margin: 1px;
              width:99%; 
              white-space: pre-wrap;     
            '
          >";
  }else{
    echo "</div><div class = 'answerAndButton' style ='display: flex;' >              
          <div                          
            id= $aTxtArea
            class = 'answerTextArea'
            style = '
              font-size:25px;
              background-color: #f8dce0;
              float: left; 
              margin: 1px;
              width:99%;        
            '
          >";
  }
  if ((substr($answer[$i], -3) != 'jpg') && (substr($answer[$i], -3) != 'png') && (substr($answer[$i], -3) != 'gif') ){
  // if (strpos($answer[$i], "jpg")=== false && strpos($answer[$i], "png")=== false && strpos($answer[$i], "gif")=== false ){
    // echo "\n"."\n"."c"."\n"."\n";
    // echo "strpos ".strpos($answer[$i], "gif")."\n"."\n";
    echo $answer[$i];
  }elseif(strpos($answer[$i], "<p>") > 0){

    echo $answer[$i];
  }else{
    if ($question[$i]!=$answer[$i]&&$answer[$i]!=$answer[$i-1]){
      // echo "\n"."\n"."d"."\n"."\n";
      if (strpos($answer[$i], "ttp")=== false){
        // echo "\n"."\n"."e"."\n"."\n";
        echo "<img class='images' border=2 src= 'images/$imageFolder[$i]/$answer[$i]' style = 'max-height:30vh;width:auto;max-width:30vw;background-size: contain;'>";////////////////////////////////////////
      }else{
        // echo "\n"."\n".strpos($answer[$i], "<p>")."\n"."\n";
        echo "<img class='images' border=2 src= '$answer[$i]' style = 'max-height:30vh;width:auto;max-width:30vw;background-size: contain;'>";////////////////////////////////////////
      } 

    };
  };
  echo "<div id = $hidHintId>$hidHint</div></div>

      <button type='button' style = 'height:2vh' onclick='eraseQuestion(this)'></button>

      </div>

      </div>
      <div hidden id = $hidAnswerId>$hidAnswer</div>
      <div hidden id = $hidImageFolderId>$hidImageFolder</div>
      <div hidden id = $hidNoteId>$hidNote</div>

    </div>
  ";

// }
}    
echo "^^^^";
echo $question[0]; 
echo "^^^^";
echo $answer[0];

mysqli_close($mysqli);
?>
