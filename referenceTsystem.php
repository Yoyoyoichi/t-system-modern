<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>New T-System</title>
<!-- <script type="text/javascript" async
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=MML_SVG">
</script> -->
<!-- <script id="MathJax-script" async
  src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-svg.js">
</script> -->
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/javascript" id="MathJax-script" async
src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml.js"></script>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    TeX: { equationNumbers: { autoNumber: "AMS" }},
    tex2jax: {
      inlineMath: [ ['$','$'], ["\\(","\\)"] ],
      processEscapes: true
    },
    "HTML-CSS": { matchFontHeight: false },
    displayAlign: "left",
    displayIndent: "2em"
  });
</script>
</head>
<style type="text/css">
p {
  margin: 0em 0px;   /* 上下に0em・左右に0px */
}
span {
  /* display: inline-block; */
  margin: 0pt auto 0px;
}
body {
  background-color: #F0FFF0;
  font-family: "ヒラギノ";
}
div.top {
  width: 97%;
  color: #000000;
}
select {
  vertical-align: middle !important;
}
.clearfix::after {
  content: "";
  display: block;
  clear: both;
}
.textlines {
  font-family: 'MS ゴシック';
  border: 2px solid #0a0;  /* 枠線 */
  border-radius: 0.67em;   /* 角丸 */
  padding: 0.5em;          /* 内側の余白量 */
  background-color: snow;  /* 背景色 */
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.25);
  /* width: 20em;             /* 横幅 */
  /* height: 120px;           /* 高さ */
   font-size: 1em;          /* 文字サイズ 
  line-height: 1.2;        /* 行の高さ */
}
.img-container--precedo {
  overflow: auto;
  position: relative;
  width: 97%;
  height: 30vh;
  text-align: center;
  border: 1px solid darkgray;
}

.img-container--precedo::before {
  content: '';
  /* display: inline-block; */
  vertical-align: middle;
  height: 100%;
  width: 0;
  margin-left: -0.3em;
}
img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
table {
  border-collapse: collapse;
  width: 100%;
}
td {
  border: 1px solid black;
  padding: 8px;
  text-align: left;
}
.quill-better-table {
  border-collapse: collapse;
  width: 100%;
}
.quill-better-table th, .quill-better-table td {
  border: 1px solid black;
  padding: 8px;
  text-align: left;
}
</style>
<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
<body>



<form name ="mainform" action="" method="post">
<p>
    <input
        type="text" id="DB_name"  name="DB_name"  class='textlines'
        value="<?php
            if (isset($_POST["DB_name"])) {echo $_POST["DB_name"];
        }?>"
        style='width: 50%; font-size: 40px;height:50px;'
    >

&nbsp;&nbsp;

</p>
<p><input type="submit" value="送信" onclick ='getCategoryOptions()' style='font-size: 25px;width: 20%; height: 70px'></p>
<br><br><br>
<p><input type="button" value="リセット" onClick='listChangeCategory1();listChanged()' style='font-size: 13px;width: 14%; height: 50px'></p>

<?php
// error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!empty($_POST["DB_name"])) {
    $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    if( $mysqli->connect_errno){
        echo 'Access Failed';//接続失敗
        exit;
    }

    $result0 = $mysqli->query("set names utf8");
    $db_name = $_POST["DB_name"];//$_GET["DB_name"];///////

    $db_column = "category1";


    //デフォルト文字セットを設定
    $mysqli->set_charset("utf8");
    $row = "";


    //データベースからカテゴリー1を取得
    $str_sql = "select $db_column from $db_name where question != 'settings'";
    // echo $str_sql.",\n"."\n";//
    $result = $mysqli->query($str_sql);
    if (is_array($result)) {
    $row_cnt =count($result);
    }

//     echo $row_cnt.",\n"."\n";
    $response[0] ="";
    if (!$result) {error_log($mysqli->error);exit;}
    // $response[] = array();
    while($dat = $result->fetch_assoc()){
        $response[] = $dat['category1'];
        
    }

    $response = array_values(array_unique($response));
//    var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"category1\" id='ctg1'onChange='listChange(this);listChanged()' multiple style='width:19%;height:20vh; font-size: 15px;margin:1px'>\n";
    for ( $i = 1; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";

    echo "{$sampleSelectBox}";

    //データベースからカテゴリー2を取得
    $str_sql = "select category2 from $db_name where question != 'settings'";
    $result = $mysqli->query($str_sql);

    if (!$result) {error_log($mysqli->error);exit;}
    unset($response);
    $response[0] ="";
    while($dat = $result->fetch_assoc()){
        $response[] = $dat['category2'];
    }

    $response = array_values(array_unique($response));
    // var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"category2\" id='ctg2' onChange='listChange(this);listChanged()' multiple style='width:19%;height:20vh; font-size: 15px;margin:1px'>\n";
    // $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >中カテゴリー</option>\n";

    // $sampleSelectBox .="\t<option value=""></option>\n";
    for ( $i = 1; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }//
    $sampleSelectBox .= "</select>\n";
    echo "{$sampleSelectBox}";


    //データベースからカテゴリー3を取得
    $str_sql = "select category3 from $db_name where question != 'settings'";
    $result = $mysqli->query($str_sql);

    if (!$result) {error_log($mysqli->error);exit;}
    unset($response);
    $response[0] ="";
    while($dat = $result->fetch_assoc()){
        $response[] = $dat['category3'];
    }

    $response = array_values(array_unique($response));
    // var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"category3\" id='ctg3' onChange='listChange(this);listChanged()' multiple style='width:19%;height:20vh; font-size: 15px;margin:1px'>\n";

    for ( $i = 1; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";//
    echo "{$sampleSelectBox}";

    //データベースからカテゴリー4を取得
    $str_sql = "select category4 from $db_name where question != 'settings'";
    $result = $mysqli->query($str_sql);

    if (!$result) {error_log($mysqli->error);exit;}
    unset($response);
    $response[0] ="";
    while($dat = $result->fetch_assoc()){
        $response[] = $dat['category4'];
    }

    $response = array_values(array_unique($response));

    // ini_set('xdebug.var_display_max_children', -1);//var_dump全て書き出させる
    // ini_set('xdebug.var_display_max_data', -1);
    // ini_set('xdebug.var_display_max_depth', -1);
    // // var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"categoryFour\" id='ctg4' onChange='listChange(this);listChanged()' multiple style='width:19%;height:20vh; font-size: 15px;margin:1px'>\n";

    for ( $i = 1; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";//
    echo "{$sampleSelectBox}";

    //データベースからカテゴリー5を取得
    $str_sql = "select category5 from $db_name where question != 'settings'";
    $result = $mysqli->query($str_sql);

    if (!$result) {error_log($mysqli->error);exit;}
    unset($response);
    $response[0] ="";
    while($dat = $result->fetch_assoc()){
        $response[] = $dat['category5'];
    }
    

    $response = array_values(array_unique($response));
    // var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"categoryFive\" id='ctg5' onChange='listChange(this);listChanged()' multiple style='width:19%;height:20vh; font-size: 15px;margin:1px'>\n";

    for ( $i = 1; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";//
    echo "{$sampleSelectBox}";

    //データベースからquestionを取得

    

    $response = array_values(array_unique($response));
    // var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"categoryQ\" id='ctgQ' onChange='listChanged()' multiple style='width:19%;height:20vh; font-size: 15px;margin:1px'>\n";


    $sampleSelectBox .= "</select>\n";//
    echo "{$sampleSelectBox}";



    

    mysqli_close($mysqli);
    

  } else {
    $err = "入力されていない項目があります。";
  }
}
global $testnumber;
$testnumber = 0;
?>


<input type="text" name="wordsearch" id="wordsearch" onChange='listChange4()' placeholder = "検索"
style='width: 30%; font-size: 38px;box-sizing:border-box;vertical-align:middle; '>
<br>

</div>
<p>
  <input type="button" id="showButton" value="表示" onclick='sendRequest()' style='font-size: 25px;width: 20%; height: 200px'>
  <input type="button" id="flexButton" value="横並び" onclick='qaFlex()' style='font-size: 25px;width: 20%; height: 200px'>
</p>
<select class="selectBox" name='fontresize' id='fontsize' onChange="txtfontResize()"
    style='width: 10%; font-size: 20px;height: 5vh;line-height: 1vh;vertical-align:top;'>
    <option value='' >文字サイズ</option>
    <option value='5px'>5</option>
    <option value='6px'>6</option>
    <option value='7px'>7</option>
    <option value='8px'>8</option>
    <option value='9px'>9</option>
    <option value='10px'>10</option>
    <option value='11px'>11</option>
    <option value='12px'>12</option>
    <option value='13px'>13</option>
    <option value='14px'>14</option>
    <option value='15px'>15</option>
    <option value='15px'>16</option>
    <option value='15px'>17</option>
    <option value='15px'>18</option>
    <option value='15px'>19</option>
    <option value='20px'>20</option>
    <option value='21px'>21</option>
    <option value='22px'>22</option>
    <option value='23px'>23</option>
    <option value='24px'>24</option>
    <option value='25px'>25</option>
    <option value='30px'>30</option>
    <option value='35px'>35</option>
    <option value='40px'>40</option>
    <option value='45px'>45</option>
    <option value='50px'>50</option>
    <option value='55px'>55</option>
    <option value='60px'>60</option>
    <option value='65px'>65</option>
</select>
<select class="selectBox" name='imgresize' id='imgresize' onChange="imgResize()"
    style='width: 10%; font-size: 20px;height: 5vh;line-height: 1vh;vertical-align:top;'>
    <option value='' >画像サイズ</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    <option value='15'>15</option>
    <option value='20'>20</option>
    <option value='25'>25</option>
    <option value='30'>30</option>
    <option value='35'>35</option>
    <option value='40'>40</option>
    <option value='45'>45</option>
    <option value='50'>50</option>
    <option value='55'>55</option>
    <option value='60'>60</option>
    <option value='65'>65</option>
    <option value='70'>70</option>
    <option value='75'>75</option>
    <option value='80'>80</option>
    <option value='85'>85</option>
    <option value='90'>90</option>
    <option value='95'>95</option>
    <option value='100'>100</option>
    <option value='105'>105</option>
    <option value='110'>110</option>
    <option value='115'>115</option>
    <option value='120'>120</option>
    <option value='125'>125</option>
    <option value='130'>130</option>
    <option value='135'>135</option>
    <option value='140'>140</option>
    <option value='145'>145</option>
    <option value='150'>150</option>
    <option value='155'>155</option>
    <option value='160'>160</option>
    <option value='165'>165</option>
    <option value='170'>170</option>
    <option value='175'>175</option>
    <option value='180'>180</option>
    <option value='185'>185</option>
    <option value='190'>190</option>
    <option value='195'>195</option>
    <option value='200'>200</option>
</select>
<select class="selectBox" name='imgresize2' id='imgresize2' onChange="imgResize2()"
    style='width: 10%; font-size: 20px;height: 5vh;line-height: 1vh;vertical-align:top;'>
    <option value='' >画像サイズ</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    <option value='15'>15</option>
    <option value='20'>20</option>
    <option value='25'>25</option>
    <option value='30'>30</option>
    <option value='35'>35</option>
    <option value='40'>40</option>
    <option value='45'>45</option>
    <option value='50'>50</option>
    <option value='55'>55</option>
    <option value='60'>60</option>
    <option value='65'>65</option>
    <option value='70'>70</option>
    <option value='75'>75</option>
    <option value='80'>80</option>
    <option value='85'>85</option>
    <option value='90'>90</option>
    <option value='95'>95</option>
    <option value='100'>100</option>
    <option value='105'>105</option>
    <option value='110'>110</option>
    <option value='115'>115</option>
    <option value='120'>120</option>
    <option value='125'>125</option>
    <option value='130'>130</option>
    <option value='135'>135</option>
    <option value='140'>140</option>
    <option value='145'>145</option>
    <option value='150'>150</option>
    <option value='155'>155</option>
    <option value='160'>160</option>
    <option value='165'>165</option>
    <option value='170'>170</option>
    <option value='175'>175</option>
    <option value='180'>180</option>
    <option value='185'>185</option>
    <option value='190'>190</option>
    <option value='195'>195</option>
    <option value='200'>200</option>
</select>
<script src="Tone.js"></script>

<script type="text/javascript">
var databasename = document.mainform.DB_name.value;
document.getElementById("DB_name").value = location.search.substring(1);///
var categoryOpt1 =[];
var categoryOpt2 =[];
var categoryOpt3 =[];
var categoryOpt4 =[];
var categoryOpt5 =[];
getCategoryOptions();

MathJax.Hub.Config({
  "HTML-CSS": {
    linebreaks: { automatic: true },
    undefinedFamily: "ＭＳ 明朝", // 日本語フォント名を自由に指定
  },
});
window.onload = function() {
    var Preview = {
        buffer: document.getElementsByTagName("body")[0],

        CreatePreview: function () {
            MathJax.Hub.Queue(
              ["Typeset", MathJax.Hub, this.buffer],
              ["PreviewDone", this]
            );
        },

        PreviewDone: function () {
            var tag = document.getElementsByTagName('span');
            for(var i = 0; i < tag.length; i++) {
                if(tag[i].style.fontSize = '130%'){
                    tag[i].style.fontSize = '100%';
                }
            }
        }
    };

    Preview.CreatePreview();
};
var qaFlexFlug = false;
function qaFlex(){
  var qa = document.getElementsByClassName("questionAnsewerBox");
  var qt = document.getElementsByClassName("questionTextArea");
  if (qaFlexFlug === false){
    for(i=0;i<qa.length;i++){
      qa[i].style.display= "flex"; 
    }
    
    // for(i=0;i<qa.length;i++){
    //   qt[i].style.minWidth=  "10vw"; 
    // }
    qaFlexFlug = true;
  }else{
    for(i=0;i<qa.length;i++){
      qa[i].style.display= "block"; 
    }
    qaFlexFlug = false;
  }
  
}


var MaxQuestionNumber;
var questionnumbers = "";


function sendRequest(){


  var category1Value = new Array();
  var elemCategory1 = document.getElementById('ctg1');
  var optsCategory1 = elemCategory1.options; // select要素のoptionプロパティ
  for (var i = 0; i < optsCategory1.length; i++) {
    if (optsCategory1[i].selected) {
      category1Value[i] = optsCategory1[i].value;
    }
  }
  category1Value = category1Value.filter(Boolean);
  category1Value = category1Value.join('@');

  var category2Value = new Array();
  var elemCategory2 = document.getElementById('ctg2');
  var optsCategory2 = elemCategory2.options; // select要素のoptionプロパティ
  for (var i = 0; i < optsCategory2.length; i++) {
    if (optsCategory2[i].selected) {
      category2Value[i] = optsCategory2[i].value;
      // console.log('category1Value[i] is ' + category2Value[i]);
    }
  }
  category2Value = category2Value.filter(Boolean);
  category2Value = category2Value.join('@');

  var category3Value = new Array();
  var elemCategory3 = document.getElementById('ctg3');
  var optsCategory3 = elemCategory3.options; // select要素のoptionプロパティ
  for (var i = 0; i < optsCategory3.length; i++) {
    if (optsCategory3[i].selected) {
      category3Value[i] = optsCategory3[i].value;
    }
  }
  category3Value = category3Value.filter(Boolean);
  category3Value = category3Value.join('@');


  var category4Value = new Array();
  var elemCategory4 = document.getElementById('ctg4');
  var optsCategory4 = elemCategory4.options; // select要素のoptionプロパティ
  for (var i = 0; i < optsCategory4.length; i++) {
    if (optsCategory4[i].selected) {
      category4Value[i] = optsCategory4[i].value;
    }
  }
  category4Value = category4Value.filter(Boolean);
  category4Value = category4Value.join('@');

  var category5Value = new Array();
  var elemCategory5 = document.getElementById('ctg5');
  var optsCategory5 = elemCategory5.options; // select要素のoptionプロパティ
  for (var i = 0; i < optsCategory5.length; i++) {
    if (optsCategory5[i].selected) {
      category5Value[i] = optsCategory5[i].value;
    }
  }
  category5Value = category5Value.filter(Boolean);
  category5Value = category5Value.join('@');

  var categoryQValue = new Array();
  var elemCategoryQ = document.getElementById('ctgQ');
  var optsCategoryQ = elemCategoryQ.options; // select要素のoptionプロパティ
  for (var i = 0; i < optsCategoryQ.length; i++) {
    if (optsCategoryQ[i].selected) {
      categoryQValue[i] = optsCategoryQ[i].value;
    }
  }
  categoryQValue = categoryQValue.filter(Boolean);
  categoryQValue = categoryQValue.join('@');


  var rand;
  var moji=rand + "....." + category1Value + "....." + category2Value + "....." + category3Value  + "....." + 
    "" + "....." + "" + "....." + 
    "" + "....." + "" + "....." + 
    "" + "....." + "" + "....." + 
    "" + "....." + "" + "....." + 
    "" + "....." + document.mainform.DB_name.value + "....." + 
    "" + "....." + document.mainform.wordsearch.value + "....." + 
    "" + "....." + category4Value + "....." + category5Value + "....." + categoryQValue; 
  moji = encodeURIComponent(moji);

  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)  {
    xmlhttp.open("POST", "../referenceTsystemGetQuestions0.php", false);//乱数を取得
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText.split('^^^');
    // console.log('0817 res is '+res);
    questionnumbers = res[1];
    // document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
  } 
  if (MaxQuestionNumber <= questionnumbers.length) {
    max = Number(MaxQuestionNumber);
  } else {
    max = questionnumbers.length;
    MaxQuestionNumber = questionnumbers.length;
  }
  num=0;
  randoms = [];

  /** 重複チェックしながら乱数作成 */
  for(i = 0; i < questionnumbers.length; i++){
    while(true){
      // alert(i);
      var tmp = intRandom(0, questionnumbers.length-1);
      if(!randoms.includes(tmp)){
        randoms.push(tmp);
        break;
      }
    }
  }
  var randQNum = new Array();
  for (let i = 0; i < MaxQuestionNumber; i++) {
    randQNum[i] = questionnumbers[randoms[i]];
  }



  var moji=document.mainform.DB_name.value + "." + questionnumbers;
  moji = encodeURIComponent(moji);

  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)  {
    xmlhttp.open("POST", "../referenceTsystemGetQuestions.php", false);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    var res2=res.split('^^^^');
    res =res2[1];
    // console.log('res is ' + res);    
    console.log('question is ' + res2[2]); 
    console.log('answer is ' + res2[3]);    	

   
    document.getElementById("imgresize2").insertAdjacentHTML('afterend',res);
    MathJax.Hub.Typeset(document);//数式再読み込み
    findSameTitleImage();
  } 

  // imageResize();

}


/** min以上max以下の整数値の乱数を返す */
function intRandom(min, max){
  return Math.floor( Math.random() * (max - min + 1)) + min;
}
function listChange4(){
  
}
function createXmlHttpRequest(){
  var xmlhttp=null;
  //alert("3");
  if(window.ActiveXObject) {
    try {
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e2) {
      }
    }
  }
  else if(window.XMLHttpRequest)
  {
      xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;

}
function qClick (ansId){  
  
  var num = ansId.id.replace('answer', '');
  var quesId = "hidAnswer"+num;
  var folderID = "hidImageFolder"+num;
  var hintId = "hidHint"+num;
  var noteId = "hidNote"+num;

  
  var ans_array = document.getElementById(quesId).innerText.replace( "\"", "");
  var ans_array = ans_array.replace( "\"", "");
  var imageFolder = document.getElementById(folderID).innerText.replace( "\"", "");
  var imageFolder = imageFolder.replace( "\"", "");
  if (document.getElementById(noteId).innerHTML!=="") {
    var str = document.getElementById(noteId).innerHTML

    var ary = str.trim().split('^').map(function(item){
      return item.trim().replace(/\s+/g,',').split(',');
    });
    //「, (カンマ)」で区切って分割する
    var result = stringToArray(str);
    // for (let i = 0; i < result.length; i++) {
      play_music(ary);
    // }
  }
  if (document.getElementById(ansId.id).innerHTML===""){
    // var aImg = "aImg"+num; 
    if(ans_array.indexOf( 'jpg' )<1){     
      readQuestion(quesId); 
      document.getElementById(ansId.id).innerHTML = ans_array;
    }else{          
      readQuestion(hintId);
      var qImgId = "qImg" + num;
      document.getElementById(ansId.id).innerHTML ='<img style = "width:40vw;background-size: contain;" border="2" src= "images/'+ imageFolder + '/' + ans_array+'">';
    }    
  } else {
    document.getElementById(ansId.id).innerHTML = "";   
  }  
}
function clickOKNG(OKNG){
  if(OKNG.value === "OK"){
  // if(window.confirm('本当にいいんですね？')){
    var rand =  OKNG.id.replace( "radioOK", "" );
    var DBname = document.getElementById("DB_name").value;
    var moji=rand + "^" + DBname + "^" + "good1" + "^" +"";
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null){
      xmlhttp.open("POST", "../addcorrect.php", false);//不正解ボタンを押す
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
    }
    OKFlag = true;
    NGFlag = false;
    document.getElementById(OKNG.id).style.backgroundColor = "#09e86c";
    var radioNG = "radioNG" +OKNG.id.replace( "radioOK", "" )
    document.getElementById(radioNG).style.backgroundColor = "#e1f0dd";

    
  }else{
  // if(window.confirm('本当にいいんですね？')){
    var rand = OKNG.id.replace( "radioNG", "" );
    var DBname = document.getElementById("DB_name").value;
    var moji=rand + "^" + DBname + "^" + "poor4" + "^" + "";
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null){
      xmlhttp.open("POST", "../addincorrect.php", false);//不正解ボタンを押す
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
    }
    NGFlag = true;
    OKFlag = false;
    document.getElementById(OKNG.id).style.backgroundColor = "#09e86c";
    var radioOK = "radioOK" +OKNG.id.replace( "radioNG", "" )
    document.getElementById(radioOK).style.backgroundColor = "#e1f0dd";
    // } else{

    // }
  }
}
function readQuestion(hidHintId){

  // 読み上げます
  speech = new SpeechSynthesisUtterance();

  // 読み上げるテキストをセットする
  questiontext = document.getElementById(hidHintId).textContent;
  speech.text = questiontext;


  // ピッチを調整する（0.0 〜 2.0）＊言語によってレンジは異なる
  speech.pitch = 1.0;
  // 再生する
  speechSynthesis.speak(speech);
  speech.onend = function (event) {
    // console.log('1');
  }
}

function UnderFifty(){
  listChange4()
  document.getElementById("category4").value = "pca";
  document.getElementById("operator1").value = "<";
  document.getElementById("criteria1").value = "61";
  document.getElementById("category5").value = "incorrect";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "0";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
}

function zeroCorrect(){
  listChange4()
  document.getElementById("category4").value = "correct";
  document.getElementById("operator1").value = "=";
  document.getElementById("criteria1").value = "0";
  document.getElementById("category5").value = "";
  document.getElementById("operator2").value = "";
  document.getElementById("criteria2").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
}
function atLeastOneFunc(){
  listChange4()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = ">";
  document.getElementById("criteria1").value = "20190101";
  sendRequest()
}
function NotYetQuestion(){
  listChange4()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  document.getElementById("criteria1").value = "20190101";
  document.getElementById("category5").value = "";
  document.getElementById("operator2").value = "";
  document.getElementById("criteria2").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
}
function getTodayNumberFunc(){
  var dt = new Date();
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y +  m +  d;
  document.getElementById("criteria1").value = result;
}
function getFirstDayFunc()
{
  document.getElementById("criteria2").value ="20010101";
}
var formatDate = function (date, format) {
  if (!format) format = 'YYYY-MM-DD hh:mm:ss.SSS';
  format = format.replace(/YYYY/g, date.getFullYear());
  format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
  format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));
  format = format.replace(/hh/g, ('0' + date.getHours()).slice(-2));
  format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
  format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
  if (format.match(/S/g)) {
    var milliSeconds = ('00' + date.getMilliseconds()).slice(-3);
    var length = format.match(/S/g).length;
    for (var i = 0; i < length; i++) format = format.replace(/S/, milliSeconds.substring(i, i + 1));
  }
  return format;
};

function play_music(result) {
//メロディ
const melodyLine1 = [
  {'time': '0:0:0', 'note': 'c5', 'duration': ' 16n'},
  {'time': '0:1:0', 'note': 'c5', 'duration': ' 16n'},
  {'time': '0:2:0', 'note': 'c5', 'duration': ' 16n'},
  {'time': '0:3:0', "note": 'G4', 'duration': '16n'},
  {'time': '1:2:0', "note": 'E4', 'duration': '16n'}
];
const melodyLine0 = result;
// const melodyLine =array();
keysAfter = [ 'time', 'note','duration'];
melodyLine = melodyLine0.map(e => //キーを変更
   Object.fromEntries(                      
      Object.entries(e).map(([k, v]) => [keysAfter[k], v])
  )
);


  
//音源
const synth = new Tone.AMSynth().toMaster(); 
 
//再生設定
function setPlay(time, note) { synth.triggerAttackRelease(note.note, note.duration, time);}

//メロディをセット  
const melody = new Tone.Part(setPlay, melodyLine); 

//メロディ再生
melody.start();

//ループ（デフォルトでfalse）
melody.loop = false;
melody.loopStart = "0";
melody.loopEnd = "16";
  
//テンポ
Tone.Transport.bpm.value = 120;
  
//再生実行
Tone.Transport.start(); 



  
}



var stringToArray = function(str) {
  return str.trim().split(',').map(function(item) {
    return item.trim().replace(/\s+/g, '').split('^');
  });
};

function listChange(categorySelect){
  // console.log("1");
  console.log(categorySelect.id);
  
  firstRemoveFlag =false;
  num=0;
  // document.getElementById("press-button").innerHTML = num +"/"+ max;
  flag1 = false;
  var sampleArea = document.getElementById("textareas");
  

  var elem = document.getElementById('ctg1');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory1 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory1.push(opts[i].value);
    }
  }
  var selectedCategory1 = selectedCategory1.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory1"+selectedCategory1+"<br><br><br>");
  var elem = document.getElementById('ctg2');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory2 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory2.push(opts[i].value);
    }
  }
  var selectedCategory2 = selectedCategory2.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory2"+selectedCategory2+"<br><br><br>");
  var elem = document.getElementById('ctg3');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory3 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory3.push(opts[i].value);
    }
  }
  var selectedCategory3 = selectedCategory3.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory3"+selectedCategory3+"<br><br><br>");
  var elem = document.getElementById('ctg4');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory4 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory4.push(opts[i].value);
    }
  }
  var selectedCategory4 = selectedCategory4.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory4"+selectedCategory4+"<br><br><br>");
  var elem = document.getElementById('ctg5');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory5 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory5.push(opts[i].value);
    }
  }
  var selectedCategory5 = selectedCategory5.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory5"+selectedCategory5+"<br><br><br>");

  if(categorySelect.id != "ctg2"){
    var moji= document.mainform.DB_name.value 
    + "." + selectedCategory1
    + "." + selectedCategory2
    + "." + selectedCategory3
    + "." + selectedCategory4
    + "." + selectedCategory5
    + "." + "category2";
    var sampleArea = document.getElementById("textareas");
    //sampleArea.insertAdjacentHTML("beforebegin",moji+"<br><br><br>");
    moji = encodeURIComponent(moji);
    // console.log(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
      // console.log("2");
      xmlhttp.open("POST", "../ctgchange.php", false);//
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data=" + moji;
      // console.log("2.1");
      xmlhttp.send(data);
      var res=xmlhttp.responseText.split('^^^');
      // console.log("2.2"+" "+res);
      // console.log("2.2"+res);
      res=res[1].replace(',,,,,,', '');
      var selectedcategory2 = res.split(',,,');
      var sampleArea = document.getElementById("textareas");
      //sampleArea.insertAdjacentHTML("beforebegin",selectedcategory2+"<br><br><br>");
      // console.log(selectedcategory2);
      // console.log(selectedcategory2[1]);
      var ctg2selectedindex = document.getElementById('ctg2').value;
      // console.log(ctg2selectedindex);
      var sl = document.getElementById('ctg2');
      while(sl.lastChild)
      {
          sl.removeChild(sl.lastChild);
      }

      var selectElement = document.getElementById("ctg2");

      for(var i = 1; i < selectedcategory2.length; i ++){
          var option = document.createElement("option");
          option.value = selectedcategory2[i];
          option.innerText = selectedcategory2[i];
          selectElement.appendChild(option);
      }
      // console.log(ctg2selectedindex);
      document.getElementById('ctg2').value = ctg2selectedindex;
      // console.log(document.getElementById('ctg2').value);
      $("#ctg2").val(ctg2selectedindex);
    }
    if((categorySelect.id!="ctg1")&&(categorySelect.id!="ctgQ")){
      questionListChange()
    }    
  }


  if(categorySelect.id != "ctg3"){
    var moji= document.mainform.DB_name.value 
    + "." + selectedCategory1
    + "." + selectedCategory2
    + "." + selectedCategory3
    + "." + selectedCategory4
    + "." + selectedCategory5
    + "." + "category3";
    moji = encodeURIComponent(moji);
    // console.log(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        // console.log("3");
        xmlhttp.open("POST", "../ctgchange.php", false);//
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data=" + moji;
        // console.log("2.1");
        xmlhttp.send(data);
        var res=xmlhttp.responseText.split('^^^');
        // console.log("2.2"+" "+res);
        // console.log("627 "+ res);
        //res=res.replace(',,,,,,', '');
        var selectedcategory3 = res[1].split(',,,');
        var sampleArea = document.getElementById("textareas");
        //sampleArea.insertAdjacentHTML("beforebegin",selectedcategory3+"<br><br><br>");
        // console.log("629 "+selectedcategory3);
        // console.log(selectedcategory2[1]);
        var ctg3selectedindex = document.getElementById('ctg3').value;
        // console.log(ctg2selectedindex);
        var sl = document.getElementById('ctg3');
        while(sl.lastChild)
        {
            sl.removeChild(sl.lastChild);
        }

        var selectElement = document.getElementById("ctg3");

        for(var i = 1; i < selectedcategory3.length; i ++){
            var option = document.createElement("option");
            option.value = selectedcategory3[i];
            option.innerText = selectedcategory3[i];
            selectElement.appendChild(option);
        }

        document.getElementById('ctg3').value = ctg3selectedindex;
        // console.log(document.getElementById('ctg3').value);
        // $("#ctg2").val(ctg2selectedindex);

    }
    if((categorySelect.id!="ctg1")&&(categorySelect.id!="ctgQ")){
      questionListChange()
    }    
  }

  if(categorySelect.id != "ctg4"){
    var moji= document.mainform.DB_name.value 
    + "." + selectedCategory1
    + "." + selectedCategory2
    + "." + selectedCategory3
    + "." + selectedCategory4
    + "." + selectedCategory5
    + "." + "category4";
    moji = encodeURIComponent(moji);
    // console.log(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        // console.log("3");
        xmlhttp.open("POST", "../ctgchange.php", false);//
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data=" + moji;
        // console.log("2.1");
        xmlhttp.send(data);
        var res=xmlhttp.responseText.split('^^^');
        // console.log("2.2"+" "+res);
        // console.log("627 "+ res);
        res=res[1].replace(',,,,,,', '');
        var selectedcategory3 = res.split(',,,');
        // console.log("629 "+selectedcategory3);
        // console.log(selectedcategory2[1]);
        var ctg3selectedindex = document.getElementById('ctg4').value;
        // console.log(ctg2selectedindex);
        var sl = document.getElementById('ctg4');
        while(sl.lastChild)
        {
            sl.removeChild(sl.lastChild);
        }

        var selectElement = document.getElementById("ctg4");

        for(var i = 1; i < selectedcategory3.length; i ++){
            var option = document.createElement("option");
            option.value = selectedcategory3[i];
            option.innerText = selectedcategory3[i];
            selectElement.appendChild(option);
        }

        document.getElementById('ctg4').value = ctg3selectedindex;
        // console.log(document.getElementById('ctg3').value);
        // $("#ctg2").val(ctg2selectedindex);

    }
    if((categorySelect.id!="ctg1")&&(categorySelect.id!="ctgQ")){
      questionListChange()
    }    
  }

  if(categorySelect.id != "ctg5"){
    var moji= document.mainform.DB_name.value 
    + "." + selectedCategory1
    + "." + selectedCategory2
    + "." + selectedCategory3
    + "." + selectedCategory4
    + "." + selectedCategory5
    + "." + "category5";
    moji = encodeURIComponent(moji);
    // console.log(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        // console.log("3");
        xmlhttp.open("POST", "../ctgchange.php", false);//
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data=" + moji;
        // console.log("2.1");
        xmlhttp.send(data);
        var res=xmlhttp.responseText.split('^^^');
        // console.log("2.2"+" "+res);
        // console.log("627 "+ res);
        res=res[1].replace(',,,,,,', '');
        var selectedcategory3 = res.split(',,,');
        // console.log("629 "+selectedcategory3);
        // console.log(selectedcategory2[1]);
        var ctg3selectedindex = document.getElementById('ctg5').value;
        // console.log(ctg2selectedindex);
        var sl = document.getElementById('ctg5');
        while(sl.lastChild)
        {
            sl.removeChild(sl.lastChild);
        }

        var selectElement = document.getElementById("ctg5");

        for(var i = 1; i < selectedcategory3.length; i ++){
            var option = document.createElement("option");
            option.value = selectedcategory3[i];
            option.innerText = selectedcategory3[i];
            selectElement.appendChild(option);
        }

        document.getElementById('ctg5').value = ctg3selectedindex;
        // console.log(document.getElementById('ctg3').value);
        // $("#ctg2").val(ctg2selectedindex);

    }
  }
  if((categorySelect.id!="ctg1")&&(categorySelect.id!="ctgQ")){
      questionListChange()
    }    
}

function questionListChange(){
  
  var elem = document.getElementById('ctg1');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory1 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory1.push(opts[i].value);
    }
  }
  var selectedCategory1 = selectedCategory1.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory1"+selectedCategory1+"<br><br><br>");
  var elem = document.getElementById('ctg2');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory2 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory2.push(opts[i].value);
    }
  }
  var selectedCategory2 = selectedCategory2.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory2"+selectedCategory2+"<br><br><br>");
  var elem = document.getElementById('ctg3');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory3 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory3.push(opts[i].value);
    }
  }
  var selectedCategory3 = selectedCategory3.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory3"+selectedCategory3+"<br><br><br>");
  var elem = document.getElementById('ctg4');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory4 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory4.push(opts[i].value);
    }
  }
  var selectedCategory4 = selectedCategory4.join("^");
  //sampleArea.insertAdjacentHTML("beforebegin","selectedCategory4"+selectedCategory4+"<br><br><br>");
  var elem = document.getElementById('ctg5');
  var opts = elem.options; // select要素のoptionプロパティ
  // console.log(opts);       // HTMLOptionsCollection(3)
  var selectedCategory5 = [];
  for (var i = 0; i < opts.length; i++) {          
    if (opts[i].selected) {
      selectedCategory5.push(opts[i].value);
    }
  }
  var selectedCategory5 = selectedCategory5.join("^");
  var moji= document.mainform.DB_name.value 
    + "." + selectedCategory1
    + "." + selectedCategory2
    + "." + selectedCategory3
    + "." + selectedCategory4
    + "." + selectedCategory5
    + "." + "question";
    moji = encodeURIComponent(moji);
    // console.log(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
      // console.log("3");
      xmlhttp.open("POST", "../ctgchange.php", false);//
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data=" + moji;
      // console.log("2.1");
      xmlhttp.send(data);
      var res=xmlhttp.responseText.split('^^^');
      // console.log("2.2"+" "+res);
      // console.log("627 "+ res);
      res=res[1].replace(',,,,,,', '');
      var selectedcategoryQ = res.split(',,,');
      // console.log("629 "+selectedcategory3);
      // console.log(selectedcategory2[1]);
      // var ctgQselectedindex = document.getElementById('categoryQ').value;
      // console.log(ctg2selectedindex);
      var sl = document.getElementById('ctgQ');
      while(sl.lastChild)
      {
          sl.removeChild(sl.lastChild);
      }

      var selectElement = document.getElementById("ctgQ");

      for(var i = 1; i < selectedcategoryQ.length; i ++){
          var option = document.createElement("option");
          option.value = selectedcategoryQ[i];
          option.innerText = selectedcategoryQ[i];
          selectElement.appendChild(option);
      }

      // document.getElementById('categoryQ').value = ctgQselectedindex;
      // console.log(document.getElementById('ctg3').value);
      // $("#ctg2").val(ctg2selectedindex);

    }
}



const myEscape = function (str) {//エスケープ関数
  return str
  .replace(/\'/g, "\\'")
  .replace(/\"/g, '\\"')
  .replace(/\//g, '\\/');
};

function listChangeQ(){
  firstRemoveFlag =false;
  num=0;
  flag1 = false;
  var moji= document.mainform.DB_name.value + "." + document.getElementById("ctgQ").value
  + "." + "question" + "." + "category1";
  moji = encodeURIComponent(moji);
  // console.log(moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null) {
    // console.log("2");
    xmlhttp.open("POST", "../ctgchange.php", false);//
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data=" + moji;
    // console.log("2.1");
    xmlhttp.send(data);
    var res=xmlhttp.responseText.split('^^^');
    // console.log("2.2"+" "+res);
    // console.log("4.2"+res);
    var selectedcategory1 = res[1].split(',,,');
    // console.log(selectedcategory2);
    // console.log(selectedcategory2[1]);
    var ctg1selectedindex = document.getElementById('ctg1').value;
    // console.log(ctg2selectedindex);
    var sl = document.getElementById('ctg1');
    while(sl.lastChild) {
      sl.removeChild(sl.lastChild);
    }

    var selectElement = document.getElementById("ctg1");

    for(var i = 0; i < selectedcategory1.length; i ++){
      var option = document.createElement("option");
      option.value = selectedcategory1[i];
      option.innerText = selectedcategory1[i];
      selectElement.appendChild(option);
    }
    // console.log(ctg2selectedindex);
    document.getElementById('ctg1').value = ctg1selectedindex;
    // console.log(document.getElementById('ctg2').value);
    // $("#ctg2").val(ctg2selectedindex);
  }

  var moji= document.mainform.DB_name.value + "." + document.getElementById("ctgQ").value
  + "." + "question" + "." + "category2";
  moji = encodeURIComponent(moji);
  // console.log(moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    // console.log("5");
    xmlhttp.open("POST", "../ctgchange.php", false);//
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data=" + moji;
    // console.log("2.1");
    xmlhttp.send(data);
    var res=xmlhttp.responseText.split('^^^');
    // console.log("2.2"+" "+res);
    // console.log("3.2"+res);
    var selectedcategory2 = res[1].split(',,,');
    // console.log(selectedcategory2);
    // console.log(selectedcategory2[1]);
    var ctg2selectedindex = document.getElementById('ctg2').value;
    // console.log(ctg2selectedindex);
    var sl = document.getElementById('ctg2');
    while(sl.lastChild)
    {
        sl.removeChild(sl.lastChild);
    }

    var selectElement = document.getElementById("ctg2");

    for(var i = 0; i < selectedcategory2.length; i ++){
        var option = document.createElement("option");
        option.value = selectedcategory2[i];
        option.innerText = selectedcategory2[i];
        selectElement.appendChild(option);
    }
    // console.log(ctg2selectedindex);
    document.getElementById('ctg2').value = ctg2selectedindex;
    console.log(document.getElementById('ctg2').value);
    // $("#ctg2").val(ctg2selectedindex);

  }
  var moji= document.mainform.DB_name.value + "." + document.getElementById("ctgQ").value
  + "." + "question" + "." + "category3";
  moji = encodeURIComponent(moji);
  // console.log(moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    // console.log("3");
    xmlhttp.open("POST", "../ctgchange.php", false);//
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data=" + moji;
    // console.log("2.1");
    xmlhttp.send(data);
    var res=xmlhttp.responseText.split('^^^');
    // console.log("2.2"+" "+res);
    // console.log("627 "+ res);
    var selectedcategory3 = res[1].split(',,,');
    // console.log("629 "+selectedcategory3);
    // console.log(selectedcategory2[1]);
    var ctg3selectedindex = document.getElementById('ctg3').value;
    // console.log(ctg2selectedindex);
    var sl = document.getElementById('ctg3');
    while(sl.lastChild)
    {
        sl.removeChild(sl.lastChild);
    }

    var selectElement = document.getElementById("ctg3");

    for(var i = 0; i < selectedcategory3.length; i ++){
        var option = document.createElement("option");
        option.value = selectedcategory3[i];
        option.innerText = selectedcategory3[i];
        selectElement.appendChild(option);
    }

    document.getElementById('ctg3').value = ctg3selectedindex;
    // console.log(document.getElementById('ctg3').value);
    // $("#ctg2").val(ctg2selectedindex);

  }

  var moji= document.mainform.DB_name.value + "." + document.getElementById("ctgQ").value
  + "." + "question" + "." + "category4";
  moji = encodeURIComponent(moji);
  // console.log(moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    // console.log("3");
    xmlhttp.open("POST", "../ctgchange.php", false);//
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data=" + moji;
    // console.log("2.1");
    xmlhttp.send(data);
    var res=xmlhttp.responseText.split('^^^');
    // console.log("2.2"+" "+res);
    // console.log("627 "+ res);
    var selectedcategory3 = res[1].split(',,,');
    // console.log("629 "+selectedcategory3);
    // console.log(selectedcategory2[1]);
    var ctg3selectedindex = document.getElementById('ctg4').value;
    // console.log(ctg2selectedindex);
    var sl = document.getElementById('ctg4');
    while(sl.lastChild)
    {
        sl.removeChild(sl.lastChild);
    }

    var selectElement = document.getElementById("ctg4");

    for(var i = 0; i < selectedcategory3.length; i ++){
        var option = document.createElement("option");
        option.value = selectedcategory3[i];
        option.innerText = selectedcategory3[i];
        selectElement.appendChild(option);
    }

    document.getElementById('ctg4').value = ctg3selectedindex;
    // console.log(document.getElementById('ctg3').value);
    // $("#ctg2").val(ctg2selectedindex);

  }


}

function listChangeCategory1(){
  var selectElement = document.getElementById("ctg1");
  while(selectElement.lastChild){
    selectElement.removeChild(selectElement.lastChild);
  }
  for(var i = 0; i < categoryOpt1.length; i ++){
      var option = document.createElement("option");
      option.value = categoryOpt1[i];
      option.innerText = categoryOpt1[i];
      selectElement.appendChild(option);
  }
  var selectElement = document.getElementById("ctg2");
  while(selectElement.lastChild){
    selectElement.removeChild(selectElement.lastChild);
  }
  for(var i = 0; i < categoryOpt2.length; i ++){
      var option = document.createElement("option");
      option.value = categoryOpt2[i];
      option.innerText = categoryOpt2[i];
      selectElement.appendChild(option);
  }
  var selectElement = document.getElementById("ctg3");
  while(selectElement.lastChild){
    selectElement.removeChild(selectElement.lastChild);
  }
  for(var i = 0; i < categoryOpt3.length; i ++){
      var option = document.createElement("option");
      option.value = categoryOpt3[i];
      option.innerText = categoryOpt3[i];
      selectElement.appendChild(option);
  }
  var selectElement = document.getElementById("ctg4");
  while(selectElement.lastChild){
    selectElement.removeChild(selectElement.lastChild);
  }
  for(var i = 0; i < categoryOpt4.length; i ++){
      var option = document.createElement("option");
      option.value = categoryOpt4[i];
      option.innerText = categoryOpt4[i];
      selectElement.appendChild(option);
  }
  var selectElement = document.getElementById("ctg5");
  while(selectElement.lastChild){
    selectElement.removeChild(selectElement.lastChild);
  }
  for(var i = 0; i < categoryOpt5.length; i ++){
      var option = document.createElement("option");
      option.value = categoryOpt5[i];
      option.innerText = categoryOpt5[i];
      selectElement.appendChild(option);
  }
  var selectElement = document.getElementById("ctgQ");
  while(selectElement.lastChild){
    selectElement.removeChild(selectElement.lastChild);
  }
  
  var selectElement = document.getElementById("wordsearch").value = "";

}

function listChanged(){
  firstRemoveFlag =false;
  // alert(flag1);
  num=-1;
  // document.getElementById("press-button").innerHTML = num +"/"+ max;
  flag1 = false;
  // alert(flag1);
}
function getCategoryOptions(){
  //カテゴリーのオプションを取得しておく
  var elem = document.getElementById('ctg1');
  
  var opts= elem.options; // select要素のoptionプロパティ
  for (var i = 0; i < opts.length; i++) {          
    categoryOpt1[i] = opts[i].value
  }
  var elem = document.getElementById('ctg2');
  
  var opts= elem.options; // select要素のoptionプロパティ
  for (var i = 0; i < opts.length; i++) {          
    categoryOpt2[i] = opts[i].value
  }
  var elem = document.getElementById('ctg3');
  
  var opts= elem.options; // select要素のoptionプロパティ
  for (var i = 0; i < opts.length; i++) {          
    categoryOpt3[i] = opts[i].value
  }
  var elem = document.getElementById('ctg4');
  
  var opts= elem.options; // select要素のoptionプロパティ
  for (var i = 0; i < opts.length; i++) {          
    categoryOpt4[i] = opts[i].value
  }
  var elem = document.getElementById('ctg5');
  
  var opts= elem.options; // select要素のoptionプロパティ
  for (var i = 0; i < opts.length; i++) {          
    categoryOpt5[i] = opts[i].value
  }

}
function escape_html (string) {//HTMLエスケープ処理
  if(typeof string !== 'string') {
    return string;
  }
  return string.replace(/[&'`"<>]/g, function(match) {
    return {
      '&': '&amp;',
      "'": '&#x27;',
      '`': '&#x60;',
      '"': '&quot;',
      '<': '&lt;',
      '>': '&gt;',
    }[match]
  });
}

function txtfontResize(){
  let questionTextArea = document.getElementsByClassName("questionTextArea");
  for (let i = 0; i < questionTextArea.length; i++) {
    questionTextArea[i].style.fontSize = document.getElementById("fontsize").value;
  }
  let answerTextArea = document.getElementsByClassName("answerTextArea");
  for (let i = 0; i < answerTextArea.length; i++) {
    answerTextArea[i].style.fontSize = document.getElementById("fontsize").value;
  }
    // document.getElementsByClassName("questionTextArea").style.fontSize = document.getElementById("fontresize").value;
    // document.getElementsByClassName("answerTextArea").style.fontSize = document.getElementById("fontresize").value;
}


function imgResize(){
  //ページ内のimg要素をすべて取得
  var imgs = mainform.getElementsByClassName('images');
  //Imageオブジェクトをインスタンス化
  var image = new Image();
  var height = document.getElementById('imgresize').value +"vh"

  //img要素の数だけ繰り返し処理
  for (var img of imgs) {

      //img要素からsrc属性の値を取得
      //Imageオブジェクトのsrcプロパティに代入    
      // image.src = img.getAttribute('src');
      img.style.maxHeight = height;
      img.style.maxWidth = "150vw";
      img.style.height = height;

      // //画像の横幅をimg要素のwidth属性の値に設定
      // img.setAttribute('width', image.width);

      //画像の高さをimg要素のheight属性の値に設定
      // img.setAttribute('height', "100px");
  }
}
function imgResize2(){
  //ページ内のimg要素をすべて取得
  var imgs = mainform.getElementsByClassName('images');
  //Imageオブジェクトをインスタンス化
  var image = new Image();
  var width = document.getElementById('imgresize2').value +"vw"

  //img要素の数だけ繰り返し処理
  for (var img of imgs) {

      //img要素からsrc属性の値を取得
      //Imageオブジェクトのsrcプロパティに代入    
      // image.src = img.getAttribute('src');
      // img.style.maxHeight = "100vh";
      img.style.maxWidth = "150vw";
      img.style.width = width;

      // //画像の横幅をimg要素のwidth属性の値に設定
      // img.setAttribute('width', image.width);

      //画像の高さをimg要素のheight属性の値に設定
      // img.setAttribute('height', "100px");
  }
}
function findSameTitleImage(){
  //ページ内のimg要素をすべて取得
  var divs = mainform.getElementsByClassName('questionTextArea');
  var a = 0;
  //img要素の数だけ繰り返し処理
  for (var div of divs) {
    if (a > 0){
      if (!(divs[a].innerText === "") && divs[a].innerText === divs[a-1].innerText){
        var b = $(divs[a]).next().children('img');
        var c = $(divs[a-1]).next().children('img');
        $(b).insertAfter(c);
      }      
    }
    a = a+1;
  }
}

function eraseQuestion(title) {
  // const element = document.getElementById(title); 
  var parent = title.parentNode;
  var parent = parent.parentNode;
  var parent = parent.parentNode;
  parent.remove();
}
</script>
<?php?>
</body>
</html>