<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="icon" href="./favicon.ico">
<link rel="apple-touch-icon" href="./apple-touch-icon.png" sizes="180x180">
<meta charset="UTF-8">
<title>Forgetting Curve</title>
<style type="text/css">

  


  body {background-color: #F0FFF0; }
  div.top{
    width:97%;
    color:"#000000";
  }
  select{
    vertical-align:middle !important;
  }
  .clearfix::after {
      content: "";
      display: block;
      clear: both;
    }
  .textlines {
    font-family: "SimHei";
    border: 2px solid #0a0;  /* 譫邱・*/
    border-radius: 0.67em;   /* 隗剃ｸｸ */
    padding: 0.5em;          /* 蜀・・縺ｮ菴咏區驥・*/
    background-color: snow;  /* 閭梧勹濶ｲ */
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.25);
    /*width: 20em;             /* 讓ｪ蟷・*/*/
    /*height: 120px;           /* 鬮倥＆ */*/
    /*font-size: 1em;          /* 譁・ｭ励し繧､繧ｺ */*/
    line-height: 1.2;        /* 陦後・鬮倥＆ */
  }
  .img-container--precedo {
    overflow:auto;
    position: relative;
    width:97%;
    height: 30vh;
    text-align: center;
    border: 1px solid darkgray;
    &:before {
    content: '';
    display: inline-block;
    vertical-align: middle;
    height: 100%;
    width: 0;
    margin-left: -0.3em;
  }
    
</style>

</head>
<body>
  <form name ="mainform" action="" method="post">
    <input type="text"  class='textlines' class="textlines" id="DB_name" name = "DB_name"
      value = "<?php if (isset($_POST["DB_name"])) {echo $_POST["DB_name"];}?>" placeholder = "id"
      style='width: 40%; height :5vh; font-size: 24px;'/>
    <input type="submit" value="騾∽ｿ｡" class="textlines" style='background-color:#99FFFF;font-size: 22px;width: 20%; height: 70px'>
    <a id="previous" href="sample020.php">
      <font size="6" color="#FF0000" style=''>蟄ｦ鄙堤判髱｢</font>
    </a>

<?php
// error_reporting(1);
// print_r ("1,");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // echo "1.1,";
  if (!empty($_POST["DB_name"])) {
    // echo "1.2,";
    $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');

    if( $mysqli->connect_errno){
        echo 'Access Failed';//謗･邯壼､ｱ謨・        exit;
    }

    $result0 = $mysqli->query("set names utf8");
    $db_name = $_POST["DB_name"];

    //繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
    $mysqli->set_charset("utf8");

    // //繝・・繧ｿ繝吶・繧ｹ蜿門ｾ・    $str_sql = "
    select answer1, question, imagefolder, questionnumber,
    answer2,answer3,answer4,answer5,answer6,answer7,answer8,answer9,answer10,qdate,pre_qdate,qsentence,nextQdate
    from $db_name 
    where (pre_qdate = DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY) AND qdate != DATE(NOW()))
    OR (right(pre_qdate,Instr(reverse(pre_qdate),',')-1) = DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY) 
      AND qdate != DATE(NOW()) And nextQdate IS null AND pca < 100 )
    OR (right(pre_qdate,Instr(reverse(pre_qdate),',')-1) = DATE_SUB(CURRENT_DATE(), INTERVAL  1 WEEK) 
      AND qdate != DATE(NOW()) And nextQdate IS null AND pca < 100 )
    OR (right(pre_qdate,Instr(reverse(pre_qdate),',')-1) = DATE_SUB(CURRENT_DATE(), INTERVAL  1 MONTH) 
      AND qdate != DATE(NOW()) And nextQdate IS null)   
    OR (right(pre_qdate,Instr(reverse(pre_qdate),',')-1) = DATE_SUB(CURRENT_DATE(), INTERVAL  6 MONTH) 
      AND qdate != DATE(NOW()) And nextQdate IS null) 
    OR (right(pre_qdate,Instr(reverse(pre_qdate),',')-1) = DATE_SUB(CURRENT_DATE(), INTERVAL  1 YEAR) 
      AND qdate != DATE(NOW()) And nextQdate IS null) 
    OR (nextQdate <= CURRENT_DATE() AND qdate != DATE(NOW()) AND nextQdate != '2001-01-01')
    ";
    echo "<br>";
    // echo $str_sql;
    $result = $mysqli->query($str_sql);
    // $test  = $result->fetch_assoc();
    $row = $result->fetch_all();
    $answer[]= array();
    $question[] = array();
    $questionNumber[] =array();
    $imageFolder[]=array();


    // var_dump($row);
    // echo(count($row));
    
    echo "<br>";
    // for 譁・    for($i = 0; $i < count($row); $i++){
      $questionNumber[$i] =$row[$i][3];
      $sql = "update $db_name
          set nextQdate = CURRENT_DATE()   
          where questionnumber = $questionnumber[$i]";
      $result = $mysqli->query($sql);
      $question[$i] = str_replace(array("\r\n", "\r", "\n"), '<br>', $row[$i][1]);
      // $question[$i] = $row[$i][1];
      $answer[$i] = $row[$i][0];
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
      $qsentence = $row[$i][15];
      $nextQdate = $row[$i][16];
      // echo $qsentence;
      // echo "<br>";
      $qTxtArea = "question".$i;
      $aTxtArea = "answer".$i;
      $qImgId = "qImg".$i;
      $aImgId = "aImg".$i;
      $radio1 = "radioHalfAnYear".$questionNumber[$i];
      $radio2 = "radioThreeMonths".$questionNumber[$i];
      $radio3 = "radioOneMonth".$questionNumber[$i];
      $radio4 = "radioTwoWeeks".$questionNumber[$i];
      $radio5 = "radioOneWeek".$questionNumber[$i];
      $radio6 = "radioTomorrow".$questionNumber[$i];
      $radio7 = "radioOneYear".$questionNumber[$i];

      echo "
        
        <div class='clearfix' style ='min-height:30vh;width:97vw;margin:0px 0px 50px 0px;background-color:#dcfadc'>
          
          <div style ='margin: 5px;float: left'>
            <div style='width:65vw;'>$pre_qdate<br><br>
                $qsentence<br>
            </div>
           
            <div '
              id= $qTxtArea
              class = 'questionTextArea'
              style = '
                width:65vw;
                font-size:50px;
                background-color: #9fccb0;
                margin: 5px;
              '>";

      if (strpos($question[$i], "jpg")=== false){
        // if($qsentence[$i] != ""){
        //   echo $qsentence[$i];
        //   echo "<br>";
        // }
        echo $question[$i];
        
      }else{
        // $questionSeiki = str_replace(" ","20%",$question[$i]);
        echo "<img  border=2 src= 'images/$imageFolder[$i]/$question[$i]' style = 'width:65vw;'>";////////////////////////////////////////
      }                  
      
      echo "</div>                
            <div                             
              onclick = 'qClick(this)'
              id= $aTxtArea
              class = 'answerTextArea'
              style = '
                width:65vw;
                min-height:10vh;
                font-size:50px;
                background-color: #f8dce0;
                margin: 5px
              '
            ></div>

          </div>
          <div class='cp_ipradio' style = 'float: left;margin:1em 0em 1em 2em'>
          <INPUT type='button' id = $radio7 value='An Year' 
            onclick = 'clickOKNG(this)'
            style='width:20vw;
            height:7vh;
            margin:0.5em;
            font-size: 1.4em;
            font-weight: bold;
            padding: 10px 30px;
            background-color: #e1f0dd;
            color: #1b3627f;
            // border-style: none;
            box-shadow: 2px 2px 3px 1px #666;
            -moz-box-shadow: 2px 2px 3px 1px #666;
            -webkit-box-shadow: 2px 2px 3px 1px #666;'
            >
            <br>
            <INPUT type='button' id = $radio1 value='Half An Year' 
            onclick = 'clickOKNG(this)'
            style='width:20vw;
            height:7vh;
            margin:0.5em;
            font-size: 1.4em;
            font-weight: bold;
            padding: 10px 30px;
            background-color: #e1f0dd;
            color: #1b3627f;
            // border-style: none;
            box-shadow: 2px 2px 3px 1px #666;
            -moz-box-shadow: 2px 2px 3px 1px #666;
            -webkit-box-shadow: 2px 2px 3px 1px #666;'
            >
            <br>
            <INPUT type='button' id = $radio2 value='3 Months' 
            onclick = 'clickOKNG(this)'
            style='width:20vw;
            height:7vh;
            margin:0.5em;
            font-size: 1.4em;
            font-weight: bold;
            padding: 10px 30px;
            background-color: #e1f0dd;
            color: #1b3627f;
            // border-style: none;
            box-shadow: 2px 2px 3px 1px #666;
            -moz-box-shadow: 2px 2px 3px 1px #666;
            -webkit-box-shadow: 2px 2px 3px 1px #666;'
            >
            <br>
            <INPUT type='button' id = $radio3 value='A Month' 
            onclick = 'clickOKNG(this)'
            style='width:20vw;
            height:7vh;
            margin:0.5em;
            font-size: 1.4em;
            font-weight: bold;
            padding: 10px 30px;
            background-color: #e1f0dd;
            color: #1b3627f;
            // border-style: none;
            box-shadow: 2px 2px 3px 1px #666;
            -moz-box-shadow: 2px 2px 3px 1px #666;
            -webkit-box-shadow: 2px 2px 3px 1px #666;'
            >
            <br>
            <INPUT type='button' id = $radio4 value='2 Weeks' 
            onclick = 'clickOKNG(this)'
            style='width:20vw;
            height:7vh;margin:0.5em;
            font-size: 1.4em;
            font-weight: bold;
            padding: 10px 30px;
            background-color: #e1f0dd;
            color: #1b3627f;
            // border-style: none;
            box-shadow: 2px 2px 3px 1px #666;
            -moz-box-shadow: 2px 2px 3px 1px #666;
            -webkit-box-shadow: 2px 2px 3px 1px #666;'
            >
            <br>
            <INPUT type='button' id = $radio5 
            value='A Week'   
            onclick = 'clickOKNG(this)'          
            style='width:20vw;height:7vh;margin:0.5em;
            font-size: 1.4em;
            font-weight: bold;
            padding: 10px 30px;
            background-color: #e1f0dd;
            color: #1b3627;
            // border-style: none;
            box-shadow: 2px 2px 3px 1px #666;
            -moz-box-shadow: 2px 2px 3px 1px #666;
            -webkit-box-shadow: 2px 2px 3px 1px #666;'
            >
            <br>
            <INPUT type='button' id = $radio6 
            value='Tomorrow'   
            onclick = 'clickOKNG(this)'          
            style='width:20vw;height:7vh;margin:0.5em;
            font-size: 1.4em;
            font-weight: bold;
            padding: 10px 30px;
            background-color: #e1f0dd;
            color: #1b3627;
            // border-style: none;
            box-shadow: 2px 2px 3px 1px #666;
            -moz-box-shadow: 2px 2px 3px 1px #666;
            -webkit-box-shadow: 2px 2px 3px 1px #666;'
            >
          </div>
          
        </div>
      ";

    }    
  }
}
// print_r ("3,");
?>
<script type="text/javascript">
document.getElementById("DB_name").value = location.search.substring(1);///
document.getElementById("previous").href += "?"+ location.search.substring(1);
var HalfAnYearFlag = false;
var ThreeMonthsFlag = false;
var OneMonthFlag = false;
var TwoWeeksFlag = false;
var OneWeekFlag = false;
var TomorrowFlag = false;

var imageFolder = JSON.parse('<?php echo $imageFolder_json; ?>');//php縺九ｉ驟榊・繧貞叙蠕・var answerShownFlag = false;
window.onload = function(){
  var test = document.getElementById("aImg53");
}
function qClick (ansId){  
  var ans_array = <?php echo json_encode($answer); ?>;
  var quesId = ansId.id;
  var num = ansId.id.replace('answer', '');
  if (document.getElementById(ansId.id).innerHTML===""){
    // var aImg = "aImg"+num; 
    if(ans_array[ansId.id.replace('answer', '')].indexOf( 'jpg' )<1){      
      document.getElementById(quesId).innerHTML = ans_array[num];
    }else{          
      var qImgId = "qImg" + num;
      document.getElementById(quesId).innerHTML ='<img id = '+ qImgId + '  border="2" src= "images/'+ imageFolder[num] + '/' + ans_array[num]+'">';

    }    
  } else {
    document.getElementById(quesId).innerHTML = "";   
  }  
  var img = document.getElementById(qImgId);
  if (img != null){
    img.width = document.getElementById(quesId).clientWidth;
    img.onload = function(){
      if (img.height > img.width) {
        var orgWidth  = img.width;  // 蜈・・讓ｪ蟷・ｒ菫晏ｭ・        var orgHeight = img.height; // 蜈・・鬮倥＆繧剃ｿ晏ｭ・        img.height = 500;  // 讓ｪ蟷・ｒ400px縺ｫ繝ｪ繧ｵ繧､繧ｺ
        img.width = Math.floor(orgWidth * (img.height / orgHeight)); // 鬮倥＆繧呈ｨｪ蟷・・螟牙喧蜑ｲ蜷医↓蜷医ｏ縺帙ｋ
      }  
    }
  }
  

}
function clickOKNG(OKNG){
  var rand;

  switch (OKNG.value) { 
    case 'An Year': 
      rand = OKNG.id.replace( "radioOneYear", "" ); 
      var SixMonthsID = "AnYear" + rand;
      document.getElementById("radioOneYear" + rand).style.backgroundColor = "#09e86c";
      document.getElementById("radioHalfAnYear" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioThreeMonths" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneMonth" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTwoWeeks" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneWeek" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTomorrow" + rand).style.backgroundColor = "#e1f0dd";
      break; 
    case 'Half An Year': 
      rand = OKNG.id.replace( "radioHalfAnYear", "" ); 
      var SixMonthsID = "HalfAnYear" + rand;
      document.getElementById("radioHalfAnYear" + rand).style.backgroundColor = "#09e86c";
      document.getElementById("radioThreeMonths" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneMonth" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTwoWeeks" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneWeek" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTomorrow" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneYear" + rand).style.backgroundColor = "#e1f0dd";
      break; 
    case '3 Months': 
      rand = OKNG.id.replace( "radioThreeMonths", "" ); 
      document.getElementById("radioHalfAnYear" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioThreeMonths" + rand).style.backgroundColor = "#09e86c";
      document.getElementById("radioOneMonth" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTwoWeeks" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneWeek" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTomorrow" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneYear" + rand).style.backgroundColor = "#e1f0dd";
      break; 
    case 'A Month': 
      rand = OKNG.id.replace( "radioOneMonth", "" ); 
      document.getElementById("radioHalfAnYear" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioThreeMonths" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneMonth" + rand).style.backgroundColor = "#09e86c";
      document.getElementById("radioTwoWeeks" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneWeek" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTomorrow" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneYear" + rand).style.backgroundColor = "#e1f0dd";
      break; 
    case '2 Weeks': 
      rand = OKNG.id.replace( "radioTwoWeeks", "" ); 
      document.getElementById("radioHalfAnYear" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioThreeMonths" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneMonth" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTwoWeeks" + rand).style.backgroundColor = "#09e86c";
      document.getElementById("radioOneWeek" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTomorrow" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneYear" + rand).style.backgroundColor = "#e1f0dd";
      break; 
    case 'A Week': 
      rand = OKNG.id.replace( "radioOneWeek", "" ); 
      document.getElementById("radioHalfAnYear" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioThreeMonths" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneMonth" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTwoWeeks" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneWeek" + rand).style.backgroundColor = "#09e86c";
      document.getElementById("radioTomorrow" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneYear" + rand).style.backgroundColor = "#e1f0dd";
      break; 
    case 'Tomorrow': 
      rand = OKNG.id.replace( "radioTomorrow", "" ); 
      document.getElementById("radioHalfAnYear" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioThreeMonths" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneMonth" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTwoWeeks" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioOneWeek" + rand).style.backgroundColor = "#e1f0dd";
      document.getElementById("radioTomorrow" + rand).style.backgroundColor = "#09e86c";
      document.getElementById("radioOneYear" + rand).style.backgroundColor = "#e1f0dd";
      break; 
  }


  if(OKNG.value === "Tomorrow"){
    var moji=rand + "^" + document.mainform.DB_name.value + "^" + "poor4" + "^" + "";
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null){
      xmlhttp.open("POST", "../FCaddincorrect.php", false);//荳肴ｭ｣隗｣繝懊ち繝ｳ繧呈款縺・      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
    }
 
  }else{
    var moji=rand + "^" + document.mainform.DB_name.value + "^" + "good1" + "^" +""+ "^" + OKNG.value;
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null){
      xmlhttp.open("POST", "../FCaddcorrect20200617.php", false);//荳肴ｭ｣隗｣繝懊ち繝ｳ繧呈款縺・      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
    }
  }
}

function createXmlHttpRequest() {
  var xmlhttp=null;
  if(window.ActiveXObject)
  {
      try
      {
          xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch(e)
      {
          try
          {
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          catch (e2)
          {
          }
      }
  }
  else if(window.XMLHttpRequest)
  {
      xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}
</script>
</body>

</html>
