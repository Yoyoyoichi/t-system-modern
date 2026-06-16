?<!DOCTYPE html>
<html lang="ja">
<head>
	<link rel="icon" href="./favicon.ico">
	<link rel="apple-touch-icon" href="./apple-touch-icon.png" sizes="180x180">
  <script type="text/javascript"
    src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
  </script>
  
<title>T-System</title>
<style type="text/css">
  /* #site-box { width : 900px ; } */
  body {
    background: url(RRice-colorful-wall.jpg);
    line-height: 1vh;
  }
  span{

  }
  select{
    vertical-align:middle !important;          
    scrollbar-color: black;
  }
  textarea{
    font-size:30px; background-color:#ffccff; 
    
  }
  input {
    border-color:grey;
  }
  img {
    /* max-width: 100%; */
    /* max-height: 100%; */
    width: auto;
    height: auto;
    overflow:auto;
    top: 50%;
  }
  input[type=checkbox] {
      width: 40px;
      height: 40px;
  }
  input[type=radio] {
      width: 40px;
      height: 40px;
  }
  .img-container--precedo {
    overflow:auto;
    resize: both;
    position: relative;
    height:20vh;
    width:97%;
    text-align: center;
    border: 2px solid darkgray;
    border-radius: 0.67em;   /* 角丸 */

    &:before {
    content: '';
    /* display: inline-block; */
    vertical-align: middle;
    /* height: 100%; */
    width: 0;
    margin-left: -0.3em;

    }

  }
  .textlines {
    font-family: "SimHei";
    border: 2px solid #0a0;  /* 枠線 */
    border-radius: 0.67em;   /* 角丸 */
    background-color: #ffccff;  /* 背景色 */
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.25);
    padding:0px;
    margin:0px 0px 0px 10px

  }
  .info02{

  }
  div.questionbuttonbox {
      width:97%; height:50px;
      margin:1vh; padding:0px;
  }
  .modifyanswerbox{
      display: flex;
  }
  div.answerbuttonbox {
      width:550px; height:5px;
      margin:1vh; padding:0px;
  }
  div.modifybuttonbox {
      width:550px; height:5px;
      margin:1vh; padding:0px;
  }
  div.undermarginbox {
      width:550px; height:5px;
      margin:1vh; padding:0px;
  }
  #information{
    font-family: "ＭＳ Ｐゴシック";
    border: 2px solid #0a0;  /* 枠線 */
    border-radius: 0.67em;   /* 角丸 */
    /* padding: 0.5em;          内側の余白量 */
    background-color: #ffccff;  /* 背景色 */
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.25);
    /*width: 20em;             /* 横幅 */*/
    /*height: 120px;           /* 高さ */*/
    /*font-size: 1em;          /* 文字サイズ */*/
    line-height: 1.2;        /* 行の高さ */
  }
  div.bottomButtonBox{

    height:300px
  }
  div.setting {

    /* top:2200px; */
    padding: 0.5em 1em;
    margin: 1%;
    color: #00BCD4;
    background: #e4fcff;/*背景色*/
    border-top: solid 6px #1dc1d6;
    box-shadow: 0 3px 4px rgba(0, 0, 0, 0.32);/*影*/
  }
  table {
    border-collapse: collapse;
    width: 100%;
  }
  td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
    white-space: pre-wrap; /* 改行を維持する */
    word-wrap: break-word; /* 長い単語を折り返す */
    white-space: normal; /* デフォルトの空白処理 */
    line-height: 1.5; /* 行間を設定する */
    font-size: 10px; /* フォントサイズを設定する */
  }


</style>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
<script type="text/javascript" src="jquery-3.4.1.min.js"></script>

<script src="midiChord.js"></script>
<!-- shims -->
<script src="./Basic.files/Base64.js" type="text/javascript"></script>
<script src="./Basic.files/Base64binary.js" type="text/javascript"></script>
<script src="./Basic.files/WebAudioAPI.js" type="text/javascript"></script>
<!-- midi.js -->
<script src="./Basic.files/audioDetect.js" type="text/javascript"></script>
<script src="./Basic.files/gm.js" type="text/javascript"></script>
<script src="./Basic.files/loader.js" type="text/javascript"></script>
<script src="./Basic.files/plugin.audiotag.js" type="text/javascript"></script>
<script src="./Basic.files/plugin.webaudio.js" type="text/javascript"></script>
<script src="./Basic.files/plugin.webmidi.js" type="text/javascript"></script>
<!-- utils -->
<script src="./Basic.files/dom_request_xhr.js" type="text/javascript"></script>
<script src="./Basic.files/dom_request_script.js" type="text/javascript"></script>
<body>

<form name ="mainform" id ="mainform"　action="" method="post">
<p>
    <input
        type="text" id="DB_name"  name="DB_name"  class='textlines'
        value="<?php
require_once 'db_wrapper.php';
            if (isset($_POST["DB_name"])) {echo $_POST["DB_name"];
        }?>"
        style='width: 50%; font-size: 40px;height:50px;'
    >



</p>
 <div id ="grandParent1">
    <input class ="button" type="submit" value="送信" style='font-size: 25px;width: 20%; height: 120px'>
    &nbsp;&nbsp;&nbsp;
    <br>
    <br>
    <a id ="UpdateSql" href="UpdateSql2.php">
        <font size="4" color="#FF6633">問題追加1</font>
    </a>
    &nbsp;&nbsp;
    <a id="TerashimaSheets" href="TerashimaSheets.php" >
        <font size="4" color="#38a3ea">問題追加2</font>
    </a>
    &nbsp;&nbsp;
    <a id="resultgraph" href="testJSCharts.php">
        <font size="4" color="#38a3ea">結果グラフ</font>
    </a>
    &nbsp;&nbsp;
    <a id="ranking" href="ranking.php">
        <font size="4" color="#38a3ea">ランキング</font>
    </a>
    &nbsp;&nbsp;
    <a id="reminder" href="reminder.php">
        <font size="4" color="#38a3ea">復習</font>
    </a>
    &nbsp;&nbsp;
    <a id="review2" href="reviewT-System.php " >
        <font size="4" color="#38a3ea">一覧</font>
    </a>
    
    <br>
    <br>
    <br>
    

  </div>

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
    //データベースから正解不正解の合計を取得
    $str_sql = "SELECT sum(correct) FROM  $db_name";
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $test2 = $test['sum(correct)'];

    $str_sql = "SELECT sum(incorrect) FROM  $db_name";
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $test3 = $test['sum(incorrect)'];//

    $str_sql = "SELECT max(qdate) FROM  $db_name";
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $test4 = $test['max(qdate)'];
    $seitoritu = round((int)$test2/((int)$test2+(int)$test3),4)*100;

    $str_sql = "SELECT count(*) FROM $db_name WHERE qdate != '2001-01-01'";////
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $testo = $test['count(*)'];
    
    $today = date("Y-m-d");
    $str_sql = "SELECT correct + incorrect FROM `A01tsystemrecord01` WHERE id = '$db_name' AND qdate = CURDATE()";////
    // echo $str_sql;
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    // var_dump ($result);
    $todayQuestonDone = $test['correct + incorrect'];

    $str_sql = "SELECT min(questionnumber) FROM $db_name";
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $minimum = $test['min(questionnumber)'];

    $str_sql = "SELECT information FROM $db_name where questionnumber = $minimum";
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $information = $test['information'];
    echo"<div  id = 'massages' style='display:inline-flex;width:100vw'> ";
    echo "<p style='font-size:20px;color:#FF0000;width:60vw;padding : 0px 0px 0px 0px;'> やった問題数の合計は$testo です。<br><br>
    今日やった合計は $todayQuestonDone です。<br><br>
    正解の合計は $test2 です。<br><br>
    不正解の合計は $test3 です。 <br><br>
    正答率は $seitoritu ％です。<br><br>
    前回は $test4 でした。 <br><br>
    </p>"."\n"."\n";////<font size="5" color="#000000">問目</fsont>
    // if (!($db_name==="AOI0501")) {
      echo "
      <div style='height:10vh;width:30vw;'>
        <TEXTAREA id = 'information' ;
        class ='textlines'
        style ='font-size:25px;height:100%;width:30vw;'        
        onchange = informationChange()
        >$information</textarea>
      </div>
      ";
    
    // }
    echo "</div><br>";



    $today = date("Y/m/d");
    $target_day = $test4;
    if(strtotime($today) - strtotime($target_day) > 604800){
      // echo "<p　style='font-size:40px;'> さぼってんじゃねえ！ </p>"."\n";/////aaaa
    }

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

    $sampleSelectBox = "<select class='selectBox' name=\"category1\" id='ctg1' onChange='category1Change();listChange(this);listChanged()' multiple style='width:19%;height:22vh; font-size: 15px;margin:1px'>\n";
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

    $sampleSelectBox = "<select class='selectBox' name=\"category2\" id='ctg2' onChange='listChange(this);listChanged()' multiple style='width:19%;height:22vh; font-size: 15px;margin:1px'>\n";

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

    $sampleSelectBox = "<select class='selectBox' name=\"category3\" id='ctg3' onChange='listChange(this);listChanged()' multiple style='width:19%;height:22vh; font-size: 15px;margin:1px'>\n";

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
    // var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select class='selectBox' name=\"categoryFour\" id='ctg4' onChange='listChange(this);listChanged()' multiple style='width:19%;height:22vh; font-size: 15px;margin:1px'>\n";

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

    $sampleSelectBox = "<select class='selectBox' name=\"categoryFive\" id='ctg5' onChange='listChange(this);listChanged()' multiple style='width:19%;height:22vh; font-size: 15px;margin:1px'>\n";

    for ( $i = 1; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";//
    echo "{$sampleSelectBox}";

    mysqli_close($mysqli);

  } else {
    $err = "error";
  }
}
global $testnumber;
$testnumber = 0;
?>
</div>
  <input class ="button" type="button" name="Lv0" id="Lv0" onClick="levelZero()" value="レベルゼロ"
  style=" width:15vw;height:150px; font-size: 20px">
  <input class ="button" type="button" name="Lv1" id="Lv1" onClick="levelOne()" value="レベル1"
  style=" width:15vw;height:150px; font-size: 20px">
  <input class ="button" type="button" name="Lv2" id="Lv2" onClick="levelTwo()" value="レベル2"
  style=" width:15vw;height:150px; font-size: 20px">
  <input class ="button" type="button" name="Lv3" id="Lv3" onClick="levelThree()" value="レベル3"
  style=" width:15vw;height:150px; font-size: 20px">
  <input class ="button" type="button" name="Lv3" id="Lv4" onClick="levelFour()" value="レベル4"
  style=" width:15vw;height:150px; font-size: 20px"><br>
  <input class ="button" type="button" name="atLeastOne" id="atLeastOne" onClick="atLeastOneFunc()" value="回答済み"
  style=" width:15vw;height:150px; font-size: 20px">
  <input class ="button" type="button" name="NotYet" id="NotYet" onClick="NotYetQuestion()" value="未回答"
  style=" width:15vw;height:150px; font-size: 20px">
  <input class ="button" type="button" name="yesterday" id="yesterday" onClick="yesterdayQuestion()" value="昨日"
  style=" width:15vw;height:150px; font-size: 20px">
  <input class ="button" type="button" name="noToday" id="noToday" onClick="noTodayQuestion()" value="今日やってない"
    style=" width:15vw;height:150px; font-size: 20px;margin:5px 0px 0px 0px">
  <input class ="button"  type="button" name="U50" id="U50" onClick="UnderFifty()" value="50％以下"
  style=" width:15vw;height:150px; font-size: 20px;margin:5px 0px 0px 0px">
  <div style="display:flex">
<!--       <div style="padding:5px 5px 5px 0px;  " >
      <input type="button" class = "button" name="oneByOne" id="oneByOne" onClick="oneByOneFunc()" value="新しいの1つずつ"
      style=" width:15vw;height:50px; font-size: 15px"><br>
      <input type="button" class = "button" name="oneByOne" id="twoByTwo" onClick="twoByTwoFunc()" value="新しいの2つずつ"
      style=" width:15vw;height:50px; font-size: 15px"><br>
      <input type="button" class = "button" name="oneByOne" id="threeByThree" onClick="threeByThreeFunc()" value="新しいの3つずつ"
      style=" width:15vw;height:50px; font-size: 15px">
    </div> -->
    
    <input class ="button" type="button" name="errToday" id="errToday" onClick="errTodayQuestion()" value="今日間違えた"
    style=" width:15vw;height:150px; font-size: 20px;margin:5px 5px 0px 0px">
    <input class ="button" type="button" name="errLast" id="errLast" onClick="errLastQuestion()" value="最後不正解"
    style=" width:15vw;height:150px; font-size: 20px;margin:5px 5px 0px 0px">
    <input class ="button" type="button" name="threeDaysAgo" id="threeDaysAgo" onClick="threeDaysAgoQuestion()" value="3日前"
  	style=" width:15vw;height:150px; font-size: 20px;margin:5px 5px 0px 0px">
    <input class ="button" type="button" name="aWeekAgo" id="aWeekAgo" onClick="aWeekAgoQuestion()" value="1週間前"
    style=" width:15vw;height:150px; font-size: 20px;margin:5px 5px 0px 0px">
    <input class ="button" type="button" name="aMonthAgo" id="aMonthAgo" onClick="aMonthAgoQuestion()" value="1ヵ月前"
    style=" width:15vw;height:150px; font-size: 20px;margin:5px 5px 0px 0px">
    
  </div>
</div>

<select class="selectBox" name='MaxQuestionNumber' id='MaxQuestionNumber' onchange = "settingSave()"
  style='width: 12%; font-size: 25px;height: 5vh;line-height: 1vh;vertical-align:top;margin:5px 5px 5px 0px'>
    <option value=20 >問題数</option>
    <option value="all">all</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>
    <option value=15>15</option>
    <option value=20>20</option>
    <option value=25>25</option>
    <option value=30>30</option>
    <option value=35>35</option>
    <option value=40>40</option>
    <option value=45>45</option>
    <option value=50>50</option>
    <option value=100>100</option>
  </select>
  <br>
<br>
<div class ="criterias" style="width: 99%;line-height: 6vh;">
<select class="selectBox" name='category4' id='category4' onChange='listChanged()' style="width: 32%; font-size: 40px;">
  <option value='nul'> </option>
  <option value='incorrect'>不正解数</option>
  <option value='correct'>正解数</option>
  <option value='pca'>正答率</option>
  <option value='qdate'>日付</option>
  <option value='pasttime'>経過時間</option>
  <option value='questionnumber'>問題番号</option>
</select>
<select class="selectBox" name='operator1' id='operator1'  onChange='listChanged()' style='width: 32%; font-size: 40px;'>
  <option value='nul'> </option>
  <option value='='>=</option>
  <option value='>'>></option>
  <option value='<'><</option>
</select>
<input class ="button" type="text" name="criteria1" id="criteria1" onChange='listChanged()' value = "" style='width: 30%; font-size: 40px;box-sizing:border-box;vertical-align:middle; '>
<input class ="button" type="button" name="getTodayNumber" id="getTodayNumber" onClick="getTodayNumberFunc()" value="今">
<br>
<select class="selectBox" name='category5' id='category5' onChange='listChanged()' style='width: 32%; font-size: 40px;'>
  <option value='nul'> </option>
  <option value='incorrect'>不正解数</option>
  <option value='correct'>正解数</option>
  <option value='pca'>正答率</option>
  <option value='qdate'>日付</option>
  <option value='pasttime'>経過時間</option>
  <option value='questionnumber'>問題番号</option>
</select>
<select class="selectBox" name='operator2' id='operator2' onChange='listChanged()' style='width: 32%; font-size: 40px;'>
  <option value='nul'> </option>
  <option value='='>=</option>
  <option value='>'>></option>
  <option value='<'><</option>
</select>
<input class ="button" type="text" name="criteria2" id="criteria2" onChange='listChanged()' value = "" style='width: 30%; font-size: 40px;box-sizing:border-box;vertical-align:middle; '>
<input class ="button" type="button" name="getfirstDayNumber" id="getfirstDayNumber" onClick="getFirstDayFunc()" value="未">
<br>
<select class="selectBox" name='category6' id='category6' onChange='listChanged()' style='width: 32%; font-size: 40px;'>
  <option value='nul'> </option>
  <option value='incorrect'>不正解数</option>
  <option value='correct'>正解数</option>
  <option value='pca'>正答率</option>
  <option value='qdate'>日付</option>
  <option value='pasttime'>経過時間</option>
  <option value='questionnumber'>問題番号</option>
</select>
<select class="selectBox" name='operator3' id='operator3' onChange='listChanged()' style='width: 32%; font-size: 40px;'>
  <option value='nul'> </option>
  <option value='='>=</option>
  <option value='>'>></option>
  <option value='<'><</option>
</select>
<input class ="button" type="text" name="criteria3" id="criteria3" onChange='listChanged()' value = "" style='width: 30%; font-size: 40px;box-sizing:border-box;vertical-align:middle; '>
<br>

<select class="selectBox" name='poorat2' id='poorat2' onChange='listChanged()'　 style='width: 32%; font-size: 40px;'>
  <option value='' disabled selected style='display:none;' >達成度選択</option>
  <option value='good4'>☆☆☆☆</option>
  <option value='good3'>☆☆☆</option>
  <option value='good2'>☆☆</option>
  <option value='good1'>☆</option>
  <option value=''> </option>
  <option value='poor1'>×</option>
  <option value='poor2'>××</option>
  <option value='poor3'>×××</option>
  <option value='poor4'>××××</option>
</select>
<select class="selectBox" name='qlevel' id='qlevel' onChange='listChanged()'　 style='width: 32%; font-size: 40px;'>
  <option value='' disabled selected style='display:none;' >レベル選択</option>
  <option value='8'>8</option>
  <option value='7'>7</option>
  <option value='6'>6</option>
  <option value='5'>5</option>
  <option value='4'>4</option>
  <option value='3'>3</option>
  <option value='2'>2</option>
  <option value='1'>1</option>
  <option value='0'>0</option>
  <option value=''></option>
</select>

<input class ="button" type="text" name="wordSearch" id="wordSearch" onChange='listChanged()' placeholder = "検索"
style='width: 30%; font-size: 38px;box-sizing:border-box;vertical-align:middle; '>
<br>

</div>

<div class="questionbuttonbox" style='line-height: 2vh;vertical-align:bottom;margin:2px' >

　<div style="float: left; width:35%;margin:15px 0px 0px 0px">
    <span class = 'info02' style='font-size: 30px;vertical-align:middle' id="press-button">0</span>
    <font size="6" class = 'info02' color="#000000" style=";vertical-align:bottom">問目</font>&ensp; &ensp;
    <font size="6" class = 'info02' color="#000000" style=";vertical-align:middle">全</font>
    <span style="font-size: 30px;vertical-align:middle"class = 'info02' id="totalQuestionNumber"></span>
    <font size="6" class = 'info02' color="#000000" style=";vertical-align:middle">問</font>
  </div>
<!--   <select class="selectBox" name='MaxQuestionNumber' id='MaxQuestionNumber' onchange = "settingSave()"
  style='width: 12%; font-size: 25px;height: 5vh;line-height: 1vh;vertical-align:top;float: left;margin:0px 5px 5px 0px'>
    <option value=20 >問題数</option>
    <option value="all">all</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>
    <option value=15>15</option>
    <option value=20>20</option>
    <option value=25>25</option>
    <option value=30>30</option>
    <option value=35>35</option>
    <option value=40>40</option>
    <option value=45>45</option>
    <option value=50>50</option>
    <option value=100>100</option>
  </select> -->
  <input class ="button" type="button" name="botan" id="autoQuestionButton" onClick="autoQuestion();" value="Auto"
  style="float: left; left: 75;width:23%;height: 5vh; font-size: 40px;line-height: 1vh;margin:0px 5px 5px 0px">
  <input class ="button" type="button" name="botan" id="buttonmodifyquestion" onClick="sendRequest5();" value="修正"
  style="float: left; left: 52%;width:23%;height :5vh; font-size: 40px;line-height: 1vh;vertical-align:top">
  

</div>

</div>


<pre id="questionInfo" style=' font-size: 20px;width:100%;overflow-y: scroll; line-height:100%;height:15vh; white-space: pre-wrap;white-space:-moz-pre-wrap;
  white-space:-o-pre-wrap;
  white-space:-pre-wrap;
  word-wrap:break-word;margin:0px'>
</pre>

<div id ='QandAwindow' >

  <TEXTAREA id="textareas" style="width:97%;height: 20vh;"  wrap="soft" class='textlines' style="visibility:hidden ; font-size:20px;"></TEXTAREA>

  <div id ="div1" class="img-container--precedo" >
    <div id ="questionMath" style = "margin: 10px"></div>
    <img id="mypic1" src="" style="height: 27.5vh;">    
  </div>
  <br>

<div class="questionbuttonbox" id="questionbuttonbox" style='line-height: 2vh;vertical-align:bottom' >

<select class="selectBox" name='poorat' id='poorat' onChange='listChanged()' style='width: 5%; font-size: 25px;height: 5vh;line-height: 1vh;vertical-align:top;'>
    <option value='' disabled selected style='display:none;'>達成度</option>
    <option value='good4'>☆☆☆☆</option>
    <option value='good3'>☆☆☆</option>
    <option value='good2'>☆☆</option>
    <option value='good1'>☆</option>
    <option value=''> </option>
    <option value='poor1'>×</option>
    <option value='poor2'>××</option>
    <option value='poor3'>×××</option>
    <option value='poor4'>××××</option>
</select>
<select class="selectBox" name='fontresize' id='fontresize' onChange="textareafontresize();settingSave()"
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
<select class="selectBox" name='mp3Speed' id='mp3Speed' onChange="textareafontresize()"
  style='width: 5%; font-size: 20px;height: 5vh;line-height: 1vh;vertical-align:top;'>
  <option value=1>mp3</option>
  <option value=0.2>0.2</option>
  <option value=0.3>0.3</option>
  <option value=0.4>0.4</option>
  <option value=0.5>0.5</option>
  <option value=0.6>0.6</option>
  <option value=0.7>0.7</option>
  <option value=0.8>0.8</option>
  <option value=0.9>0.9</option>
  <option value=1>1.0</option>
</select>
<select class="selectBox"  name="mp3StartPoint" id = "mp3StartPoint" style="width:3%;font-size: 25px;height: 5vh;">
    <option value=0>0</option>
</select>

<select class="selectBox" name="imageSize1" id = "imageSize1" value="1" min="-10" max="10" step="0.1" onChange="imageSizeChange1()"
style="width:7%;font-size: 20px;height: 5vh;">
  <option value=1>画像①</option>
  <option value=0.1>0.1</option>
  <option value=0.2>0.2</option>
  <option value=0.3>0.3</option>
  <option value=0.4>0.4</option>
  <option value=0.5>0.5</option>
  <option value=0.6>0.6</option>
  <option value=0.7>0.7</option>
  <option value=0.8>0.8</option>
  <option value=0.9>0.9</option>
  <option value=1>1.0</option>
  <option value=1.1>1.1</option>
  <option value=1.2>1.2</option>
  <option value=1.3>1.3</option>
  <option value=1.4>1.4</option>
  <option value=1.5>1.5</option>
  <option value=1.6>1.6</option>
  <option value=1.7>1.7</option>
  <option value=1.8>1.8</option>
  <option value=1.9>1.9</option>
  <option value=2>2</option>
  <option value=3>3</option>
  <option value=4>4</option>
  <option value=5>5</option>
  <option value=6>6</option>
  <option value=7>7</option>
  <option value=8>8</option>
  <option value=9>9</option>
  <option value=10>10</option>
</select>
<select class="selectBox"  name="imageSize2" id = "imageSize2" value="1" min="-10" max="10" step="0.1" onChange="imageSizeChange2()"style="width:7%;font-size: 20px;height: 5vh;">
  <option value=1>画像②</option>
  <option value=0.1>0.1</option>
  <option value=0.2>0.2</option>
  <option value=0.3>0.3</option>
  <option value=0.4>0.4</option>
  <option value=0.5>0.5</option>
  <option value=0.6>0.6</option>
  <option value=0.7>0.7</option>
  <option value=0.8>0.8</option>
  <option value=0.9>0.9</option>
  <option value=1>1.0</option>
  <option value=1.1>1.1</option>
  <option value=1.2>1.2</option>
  <option value=1.3>1.3</option>
  <option value=1.4>1.4</option>
  <option value=1.5>1.5</option>
  <option value=1.6>1.6</option>
  <option value=1.7>1.7</option>
  <option value=1.8>1.8</option>
  <option value=1.9>1.9</option>
  <option value=2>2</option>
  <option value=3>3</option>
  <option value=4>4</option>
  <option value=5>5</option>
  <option value=6>6</option>
  <option value=7>7</option>
  <option value=8>8</option>
  <option value=9>9</option>
  <option value=10>10</option>
</select>

<input class ="button" type="button" name="botan" id="buttonreadtxt" onClick="readAnswer();" value="読み上げ"
style="float: right; left: 75%;width:26%;height: 5vh; font-size: 40px;line-height: 1vh;vertical-align:top">
<input class ="button" type="button" name="botan" id="buttonreadtxt" onClick="readQuestion();" value="読み上げ"
style="float: right; left: 75;width:26%;height: 5vh; font-size: 40px;vertical-align:top;margin:0px 0px 0px 5px">

</div>
<br>

<pre id="novel" hidden style=' font-size: 30px;width:90%;height:5%;margin:10px; line-height:100%; white-space: pre-wrap;white-space:-moz-pre-wrap;
white-space:-o-pre-wrap;
white-space:-pre-wrap;
word-wrap:break-word;'></pre>
<div id="preQInfo" style=' font-size: 15px;width:97%;line-height: 5vh;'></div>


  <TEXTAREA id="textareas2" style="width:97%;height: 20vh;" wrap="soft" class='textlines' style="font-size:40px;" onkeydown="AnswerSent(event.keyCode);"></TEXTAREA>
  <br>

  <div id ="div2" class="img-container--precedo">
    <div id ="answerMath" style = "margin: 10px;line-height:30px;text-align: left;white-space: pre-wrap;"></div>
    <img id="mypic2" src=""　style="height: 27.5vh;">
    <div id ="answerHint" style = "margin: 10px;line-height:30px;text-align: left"></div>
  </div>
  </div>


<br>
<div id = "bottomButtonBox" class="bottomButtonBox">
  <input class ="button" type="button" name="botan01" id="button01" onClick="sendRequest()"value="次の問題"
  style="width:49%;height :7vh;font-size: 40px;margin:0px 0px 10px 0px ">
  <input class ="button" type="button" name="botan02" id="button02" onClick="sendRequest2();" value="解答"
  style="width:49%;height :7vh;font-size: 40px;margin:0px 0px 10px 0px ">
  <input class ="button" type="button" name="botan03" id="button03" onClick="sendRequest3('good4');" value="☆☆☆☆"
  style="width:24.2%;height:10vh; font-size: 30px">
  <input class ="button" type="button" name="botan03" id="button03" onClick="sendRequest3('good3');" value="☆☆☆"
  style="width:24.2%;height:10vh; font-size: 30px">
  <input class ="button" type="button" name="botan03" id="button03" onClick="sendRequest3('good2');" value="☆☆"
  style="width:24.2%;height:10vh; font-size: 30px">
  <input class ="button" type="button" name="botan03" id="button03" onClick="sendRequest3('good1');" value="☆"
  style="width:24.2%;height:10vh; font-size: 30px"><br><br>
    <input class ="button" type="button" name="botan04" id="button04" onClick="sendRequest4('poor4');" value="????"
  style="width:24.2%;height:10vh; font-size: 30px">
  <input class ="button" type="button" name="botan04" id="button04" onClick="sendRequest4('poor3');" value="???"
  style="width:24.2%;height:10vh; font-size: 30px">
  <input class ="button" type="button" name="botan04" id="button04" onClick="sendRequest4('poor2');" value="??"
  style="width:24.2%;height:10vh; font-size: 30px">
  <input class ="button" type="button" name="botan04" id="button04" onClick="sendRequest4('poor1');" value="?"
  style="width:24.2%;height:10vh; font-size: 30px"><br><br>
  <input class ="button" type="button" name="botan05" id="button05" onClick="backQuestion();"value="前の問題"
  style="width:24.2%;height:5vh;font-size: 40px">
  <input class ="button" type="button" name="botan05" id="button05" onClick="removeQuestion();sendRequest()"value="スキップ"
  style="width:24.2%;height:5vh;font-size: 40px">
  <input class ="button" type="button"  name="botan06" id="button06" onClick="correctMinus();"value="正解-"
  style="position: absolute;left:50%;width:23.8%;height:5vh;font-size: 20px">
  <input class ="button" type="button" name="botan07" id="button07" onClick="incorrectMinus();"value="不正解-"
  style="position: absolute;left:74.5%;width:23.8%;height:5vh;font-size: 20px">

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div id ="setting" class="setting" style=" width:93%" >
  <pre style='font-size: 25px'>設定</pre>

  <select class="selectBox" name='autoSpeed' id='autoSpeed' onchange = "settingSave()" style='width: 23%; font-size: 20px;'>
    <option value=3 style='width: 23%' placeholder="Auto速さ">Auto速さ</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>
  </select>
  <select class="selectBox" name='autoReading' id='autoReading' onchange = "settingSave()" style='width: 23%; font-size: 20px;'>
    <option value='je' style='width: 23%' placeholder="読上音声">読上音声</option>
    <option value='je'>問題-日本語/解答‐英語</option>
    <option value='ej'>問題-英語/解答‐日本語</option>
    <option value='jj'>問題-日本語/解答‐日本語</option>
    <option value='ee'>問題-英語/解答‐英語</option>
    <option value='j*'>問題だけ-日本語</option>
    <option value='e*'>問題だけ-英語</option>
    <option value='*j'>解答だけ‐日本語</option>
    <option value='*e'>解答だけ‐英語</option>
  </select>

  <select class="selectBox" name='jpSpeed' id='jpSpeed' onchange = "settingSave()" style='width: 23%; font-size: 20px;'>
    <option value=1.2 style='width: 23%' placeholder="日本語読み上げ速さ">日本語読み上げ速さ</option>
    <option value=0.3>0.3</option>
    <option value=0.4>0.4</option>
    <option value=0.5>0.5</option>
    <option value=0.6>0.6</option>
    <option value=0.7>0.7</option>
    <option value=0.8>0.8</option>
    <option value=0.9>0.9</option>
    <option value=1.0>1.0</option>
    <option value=1.1>1.1</option>
    <option value=1.2>1.2</option>
    <option value=1.3>1.3</option>
    <option value=1.4>1.4</option>
    <option value=1.5>1.5</option>
    <option value=1.6>1.6</option>
    <option value=1.7>1.7</option>



  </select>
  <select class="selectBox" name='engSpeed' id='engSpeed' onchange = "settingSave()" style='width: 23%; font-size: 20px;'>
    <option value=0.7 style='width: 23%' placeholder="英語読み上げ速さ">英語読み上げ速さ</option>
    <option value=0.4>0.4</option>
    <option value=0.5>0.5</option>
    <option value=0.6>0.6</option>
    <option value=0.7>0.7</option>
    <option value=0.8>0.8</option>
    <option value=0.9>0.9</option>
    <option value=1.0>1.0</option>
    <option value=1.1>1.1</option>
    <option value=1.2>1.2</option>
    <option value=1.3>1.3</option>
    <option value=1.4>1.4</option>
    <option value=1.5>1.5</option>
  </select>
  <br>
  <select class="selectBox" name='NOC' id='NOC' onchange = "settingSave()" style='width: 23%; font-size: 20px;margin:30px 0px 0px 0px' >
    <option value=3 style='width: 23%' placeholder="最低正解数">最低正解数</option>
    <option value=0>0</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>
  </select>

  <select class="selectBox" name='autoAnswer' id='autoAnswer' onchange = "settingSave()" style='width: 23%; font-size: 20px;margin:30px 0px 0px 0px'>
    <option value=0 style='width: 23%' placeholder="自動解答秒数">自動解答秒数</option>
    <option value=0>なし</option>
    <option value=0.5>0.5</option>
    <option value=0.6>0.6</option>
    <option value=0.7>0.7</option>
    <option value=0.8>0.8</option>
    <option value=0.9>0.9</option>
    <option value=1>1</option>
    <option value=1.2>1.2</option>
    <option value=1.3>1.3</option>
    <option value=1.5>1.5</option>
    <option value=1.7>1.7</option>
    <option value=1.8>1.8</option>
    <option value=2>2</option>
    <option value=2.5>2.5</option>
    <option value=3>3</option>
    <option value=3.5>3.5</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>
    <option value=15>15</option>
    <option value=20>20</option>
    <option value=30>30</option>
    <option value=60>60</option>
    <option value=120>120</option>
    <option value=180>180</option>
    <option value=240>240</option>
    <option value=300>300</option>
  </select>
  <select class="selectBox" name='backGround' id='backGround' style='width: 23%; font-size: 20px;margin:30px 0px 0px 0px' onchange = 'changeBG();settingSave()'>
    <option value="RRice-colorful-wall.jpg" style='width: 23%' placeholder="背景画像">背景画像</option>
    <option value="colored-pencil-pattern1144.png">①</option>
    <option value="fancy-floral-pattern-384.jpg">②</option>
    <option value="mint-green-chevron-stripes-2361.png">③</option>
    <option value="RRice-colorful-wall.jpg">④</option>
    <option value="p_da0686_m_da06860.jpg">⑤</option>
    <option value="b065.gif">⑥</option>
    <option value="p_da0671_m_da06710.jpg">⑦</option>
    <option value="p_da0725_m_da07250.jpg">⑧</option>
    <option value="p_da0689_m_da06892.jpg">⑨</option>
    <option value="p_da0667_m_da06670.jpg">⑩</option>
    <option value="p_da0669_m_da06693.jpg">⑪</option>
    <option value="p_da0491_m_da04913.jpg">⑫</option>
    <option value="p_da0451_m_da04510.jpg">⑬</option>
    <option value="p_da0438_m_da04380.jpg">⑭</option>
    <option value="0341_mosaictile_s.jpg">⑮</option>
    <option value="0108_brick_s.jpg">⑯</option>
    <option value="p_da0694_l_da06940.jpg">⑰</option>
    <option value="49502.jpg">⑱</option>
    <option value="stylish-floral-pattern.png">⑲</option>
    <option value="painted-wood-planks-large-background.jpg">⑳</option>
    <option value="seamless-bamboo-pattern-842.png">?</option>
    <option value="dandelion-seeds-pattern.png">?</option>
    <option value="music-pattern-with-trumpet-1929.png">?</option>
    <option value="canadian-dollar.png">?</option>
    <option value="pixel-heart.png">?</option>
    <option value="christmas-colour.png">?</option>
    <option value="food.png">?</option>
    <option value="donuts.png">?</option>
    <option value="dinos.png">?</option>
    <option value="panda-madness.gif">?</option>
    <option value="pattern8-pattern-44a.png">?</option>
    <option value="patternhead64a-thumb.png">?</option>
    <option value="repeated-square.png">?</option>
    <option value="1702.png">?</option>
    <option value="yellow-5456111_1920.jpg">?</option>

    
  </select>
    <select class="selectBox" name='fontSelect' id='fontSelect' style='width: 23%; font-size: 20px;margin:30px 0px 0px 0px' onchange = 'settingSave()'>
    <option value="SimHei" style='width: 23%' placeholder="フォント">フォント</option>
    <option value="ＭＳ 明朝">ＭＳ 明朝</option>
    <option value="SimHei">SimHei</option>
    <option value="Times">Times</option>
    <option value="Arial">Arial</option>
    <option value="sans-serif">sans-serif</option>
    <option value="arial black">arial black</option>
    <option value="arial narrow">arial narrow</option>
    <option value="arial unicode ms">arial unicode ms</option>
    <option value="Century Gothic">Century Gothic</option>
    <option value="Franklin Gothic Medium">Franklin Gothic Medium</option>
    <option value="Gulim">Gulim</option>
    <option value="Dotum">Dotum</option>
    <option value="Haettenschweiler">Haettenschweiler</option>
    <option value="Impact">Impact</option>
    <option value="Ludica Sans Unicode">Ludica Sans Unicode</option>
    <option value="Microsoft Sans Serif">Microsoft Sans Serif</option>
    <option value="MS Sans Serif">MS Sans Serif</option>
    <option value="MV Boil">MV Boil</option>
    <option value="New Gulim">New Gulim</option>
    <option value="Tahoma">Tahoma</option>
    <option value="Trebuchet">Trebuchet</option>

  </select>
  </select>
    <select class="selectBox" name='novelSelect' id='novelSelect' style='display:none;width: 23%; font-size: 20px;margin:30px 0px 0px 0px' onchange = 'settingSave()'>
    <option value="なし" style='width: 23%' placeholder="フォント">小説</option>
    <option value="なし">なし</option>
  </select>
  <input class ="button" type="text" name="novelSentenceNumber" id="novelSentenceNumber" onChange='settingSave()' value = "" 
  style='display:none;width: 8%; font-size: 16px;box-sizing:border-box;vertical-align:middle;margin:30px 0px 0px 0px '>

  <br>
  <input class ="button" type="checkbox" id = "qachange" onchange = "settingSave()" style="font-size: 20px;margin:2vh 0px 0px 0px">
  <font size="4" color="#000000" class="checkText" ;>問題/解答</font>
  <input class ="button" type="checkbox" id = "autoread" onchange = "settingSave()" style="font-size: 20px;margin:2vh 0px 0px 2vh">
  <font size="4" color="#000000" class="checkText";>自動読み上げ</font>
  <input class ="button" type="checkbox" id = "keyControl" onchange = "settingSave()" style="font-size: 20px;margin:2vh 0px 0px 2vh">
  <font size="4" color="#000000" class="checkText";>キー操作</font>
  <br>
  <input class ="button" type="checkbox" id = "answerByMyself" onchange = "settingSave()" style="font-size: 20px;margin:2vh 0px 0px 0px">
  <font size="4" color="#000000" class="checkText";>解答入力</font>
  <input class ="button" type="checkbox" id = "randomOrNot" onchange = "settingSave()" style="font-size: 20px;margin:2vh 0px 0px 2vh">
  <font size="4" color="#000000" class="checkText";>ランダム</font>
  <input class ="button" type="checkbox" id = "chordsOrNot" onchange = "settingSave()" style="font-size: 20px;margin:2vh 0px 0px 2vh">
  <font size="4" color="#000000" class="checkText";>コード音声</font>
  <input class ="button" type="checkbox" id="flexButton" value="横並び" onchange='QnAareaFlex();settingSave()' style="font-size: 20px;margin:2vh 0px 0px 2vh">
  <font size="4" color="#000000" class="checkText";>横並び</font>
  <input class ="button" type="checkbox" id="blackCheck" value="真っ黒" onchange='blackOrWhite();settingSave()' style="font-size: 20px;margin:2vh 0px 0px 2vh">
  <font size="4" color="#000000" class="checkText";>真っ黒</font>
  <br>

</div>
<div class="undermarginbox" >
</div>

<?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    if( $mysqli->connect_errno){
        echo 'Access Failed';//接続失敗
        exit;
    }
    $result0 = $mysqli->query("set names utf8");
    //データベース取得
    $db_name = $_POST["DB_name"];
    $str_sql = "select * from $db_name where question = 'settings'";
    $result = $mysqli->query($str_sql);
    if (!$result) {error_log($mysqli->error);exit;}
    unset($response);
    while($dat = $result->fetch_assoc()){
        $response = $dat;
    }
    $response = implode("^", $response);
    mysqli_close($mysqli);
  }
?>



<script type="text/javascript">

var sendbackDBName = location.search.substring(1);
// console.log('sendbackDBName is '+sendbackDBName);
if (sendbackDBName) {
    document.getElementById("DB_name").value = sendbackDBName;
}
document.getElementById("div2").style.display = "none";
document.getElementById("div2").style.display = "none";
document.getElementById("div1").style.display = "none";
var num = 0;
var flag1 = false;
var oneByOneflag = false;
var twoByTwoflag = false;
var threeByThreeflag = false;
var answertextareaflag = false;
var autoflag = false;
var randoms = [];
let rand = "";
var questionnumbers = "";
var min = 0, max = "";
var phpfile1 = "";
var phpfile2 = "";
var databasename = document.mainform.DB_name.value;
document.getElementById("reminder").href += "?"+databasename;
document.getElementById("resultgraph").href += "?"+databasename;
document.getElementById("UpdateSql").href += "?"+databasename;
document.getElementById("review2").href += "?"+databasename;
document.getElementById("TerashimaSheets").href += "?"+databasename;

// console.log('databasename is '+databasename);
var getQstartTime = 0;
var getQendTime = 0;
var getpastTime =0;
var now = 0;
var answertext="";
var questiontext="";
var imagefolder ="";
var speech;
var speech2;
var correctQuestions = new Array();
var incorrectQuestions = new Array();
var overlapCorrectQuestions = new Array();
var overlapIncorrectQuestions = new Array();
var minimumCorrect ;
var MaxQuestionNumber;
var AnswerShown = false;
var AnswerTypedFlag = false;
var AnswerShown2 = false;//自動回答表示の解除用
// var AnswerWaitingFlag = false;//自動解答表示を待っているかどうか
var sleepId = "";//sleepのタイマーのID
var mp3PlayFlag = false;
var imageHeight1;
var imageWidth1;
var imageHeight2;
var imageWidth2;
var yesterdayIncorrect =false;
var QnAareaFlexFlug = false;
var slashKakko = "\\\(";
var musicStartFlug = false;

const text1 = document.getElementById('textareas');



for (let i = 1; i < 500; i++) {//Mp3開始地点セレクト要素追加
    // selectタグを取得する
  var select = document.getElementById("mp3StartPoint");
  // optionタグを作成する
  var option = document.createElement("option");
  // optionタグのテキストを4に設定する
  option.text = i * 0.01 ;
  // optionタグのvalueを4に設定する
  option.value = i * 0.01;
  // selectタグの子要素にoptionタグを追加する
  select.appendChild(option);
}



function sendRequest(){
    let parent = document.getElementById("answerMath");
    while(parent.lastChild){
      parent.removeChild(parent.lastChild);
    }
    if ((document.getElementById("novelSelect").value) && !(document.getElementById("novelSelect").value == "なし")){
      novelRowNum = Number(novelRowNum) +1;
      getNovelSentence();
    }

    if (!document.getElementById("mypic2")=== null) {
      if (document.getElementById("mypic2").src){
        document.getElementById("mypic2").src= "";
      }      
    }
    
    clearTimeout(sleepId);//自動解答表示のタイマーをクリア
    AnswerShown2 = false;//答えはまだ表示されていない
    if (num < MaxQuestionNumber ) {
      num++;
    } else {
      num=0;
    }
    now = new Date();
    getQstartTime = now.getTime();
    answertextareaflag = false;
    var QAChangeChecked = document.getElementById("qachange").checked;////

    if (flag1 == false){
      if (document.getElementById("MaxQuestionNumber").value == "all") {
        MaxQuestionNumber = questionnumbers.length;
      } else {
        MaxQuestionNumber = Number(document.getElementById("MaxQuestionNumber").value);
      }
      MaxQuestionNumber = Number(document.getElementById("MaxQuestionNumber").value);
    }


    if (QAChangeChecked) {
        var phpfile1 = "getonequestion2.php";
        var phpfile2 = "getanswer2.php";
    } else {
        var phpfile1 = "getonequestion1.php";
        var phpfile2 = "getanswer1.php";
    }

    if (num+1 > MaxQuestionNumber ) {
      removeCorrects();
      num=0;
      randoms = [];
      // max = questionnumbers.length-1;
        if (max==0) {
          max=1;
        }
      /** 重複チェックしながら乱数作成 */
      for(i = min; i < questionnumbers.length; i++){
        while(true){
          // alert(i);
          var tmp = intRandom(min, questionnumbers.length-1);
          if(!randoms.includes(tmp)){
            randoms.push(tmp);
            break;
          }
        }
      }
      var randQNum = new Array();
      for (let i = 0; i < questionnumbers.length; i++) {
        randQNum[i] = questionnumbers[randoms[i]];
      }
      var correctQuestionsSave = correctQuestions;
      // console.log('correctQuestions  is '+correctQuestions );
      correctQuestions = correctQuestionsSave;
      // console.log('correctQuestions  is '+correctQuestions );
      if (document.getElementById("randomOrNot").checked) {
        questionnumbers.length = 0;
        questionnumbers = randQNum;
      }
    }
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




    var moji=rand + "." + category1Value + "." + category2Value + "." + category3Value  + "." + 
        document.mainform.category4.value + "." + document.mainform.category5.value + "." + 
        document.mainform.category6.value + "." + document.mainform.operator1.value + "." + 
        document.mainform.operator2.value + "." + document.mainform.operator3.value + "." + 
        document.mainform.criteria1.value + "." + document.mainform.criteria2.value + "." + 
        document.mainform.criteria3.value + "." + document.mainform.DB_name.value + "." + 
        document.mainform.poorat2.value + "." + document.mainform.wordSearch.value + "." + 
        document.mainform.qlevel.value + "." + category4Value + "." + category5Value + "." + 
        document.mainform.novelSentenceNumber.value + "." + yesterdayIncorrect;
    moji = encodeURIComponent(moji);
    yesterdayIncorrect = false;

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {

      if (flag1 == false){
        xmlhttp.open("POST", "../getqestions.php", false);//乱数を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText.split('^^^');
        console.log('0817 res is '+res);
        questionnumbers = res[1].split(',');
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
      if (oneByOneflag == true){
        xmlhttp.open("POST", "../getqestionsOneByOne.php", false);//乱数を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText.split('^^^');
        console.log('0817 res is '+res);
        questionnumbers = res[1].split(',');
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
      if (twoByTwoflag == true){
        xmlhttp.open("POST", "../getqestionsTwoByTwo.php", false);//乱数を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText.split('^^^');
        console.log('0817 res is '+res);
        questionnumbers = res[1].split(',');
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
      if (threeByThreeflag == true){
        xmlhttp.open("POST", "../getqestionsThreeByThree.php", false);//乱数を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText.split('^^^');
        console.log('0817 res is '+res);
        questionnumbers = res[1].split(',');
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
      if (MaxQuestionNumber <= questionnumbers.length) {
        max = Number(MaxQuestionNumber);
      } else {
        max = questionnumbers.length;
        MaxQuestionNumber = questionnumbers.length;
      }


      document.getElementById("press-button").innerHTML = num+1  +"/"+　Number(max);

      if (flag1 == false){
        // alert(max);
          randoms = [];
        /** 重複チェックしながら乱数作成 */
        for(i = min; i < questionnumbers.length; i++){
          while(true){
            // alert(i);
            var tmp = intRandom(min, questionnumbers.length-1);
            if(!randoms.includes(tmp)){
              randoms.push(tmp);
              break;
            }
          }
        }
        flag1 = true;
        var randQNum = new Array();
        for (let i = 0; i < questionnumbers.length; i++) {
          randQNum[i] = questionnumbers[randoms[i]];
        }
        var correctQuestionsSave = correctQuestions;
        // console.log('correctQuestions  is '+correctQuestions );

        correctQuestions = correctQuestionsSave;
        // console.log('correctQuestions  is '+correctQuestions );
        if (document.getElementById("randomOrNot").checked) {
          questionnumbers.length = 0;
          questionnumbers = randQNum;
        }

        questionnumbers = questionnumbers.slice(0, MaxQuestionNumber);
      }

    }

    if (max==1) {
    rand = questionnumbers[0];
    } else {
    rand = questionnumbers[num];
    }
    // console.log('questionnumbers is '+questionnumbers);
    // console.log(' randoms[num]is '+randoms[num]);
    // console.log('376 rand is '+rand);


    // alert(num);
    /*alert(rand);*/
    // alert(questionnumbers[1]);


    var moji=rand + "." + document.mainform.DB_name.value + "." + 
    document.mainform.novelSentenceNumber.value;
    moji = encodeURIComponent(moji);



    var xmlhttp=createXmlHttpRequest();

    if(xmlhttp!=null)
    {

        xmlhttp.open("POST", "../"+phpfile1, false);//乱数をもとに問題を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;

        // console.log('396 data is '+data);

        xmlhttp.send(data);
        //xmlhttp.send(dataa);

        //var datata="data="+mojiji;
        //xmlhttp.send(datata);

        var res=xmlhttp.responseText;

        // console.log('558 res is '+res);
        var res = res.split('^^^');
        imagefolder = res[2];

        var doc0= document.getElementById("questionInfo");

        var correctNum = ""
        var question = ""
        if (res[0].indexOf("正解数")<0) {
            question = res[0];
            correctNum = res[1];
        } else {
            question = res[1];
            correctNum = res[0];
        }

        doc0.innerHTML= correctNum;
        questiontext = question;


        if ((question.indexOf( "jpg" ) > -1)||(question.indexOf( "png" ) > -1)||(question.indexOf( "gif" ) > -1)||(question.indexOf( "jpeg" ) > -1)) {
          document.getElementById("textareas").style.display = "none";
          document.getElementById("mypic1").style.display = "block";
          document.getElementById("div1").style.display = "block";          
          document.getElementById("questionMath").innerText ="";
          
          // var imageadress =  res.split('\n');
          // console.log('question is ' + question);
          question = question.split('\n\n');
          if (question.length > 1) {
            if (question[1].indexOf( "ttp" ) > 0){
              document.getElementById("mypic1").src=question[1];
            } else {
              document.getElementById("mypic1").src='images/'+imagefolder+'/' + question[1];
            }
          } else {
            if (question[0].indexOf( "ttp" ) > 0){
              document.getElementById("mypic1").src=question[0];
            } else {
              document.getElementById("mypic1").src='images/'+imagefolder+'/' + question[0];
            }
          }


          var image1 = new Image();
          var width;
          var height;

          image1.onload = function(){
              width = image1.width;
              height = image1.height;
              imageSize = document.getElementById("imageSize1").value * image1.width ;
              if ((imageSize>1000)){
               imageSize = 1000;
              }
              if ((width>height)){
                  document.getElementById("mypic1").style.width = imageSize + "px";  // 横幅を400pxにリサイズ
                  document.getElementById("mypic1").style.height = height * (imageSize / width)+"px"; // 高さを横幅の変化割合に合わせる;
                  if (parseInt(document.getElementById("mypic1").style.height)>parseInt(document.getElementById("div1").clientHeight)) {
                    document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
                    document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
                  } else {
                  }
              } else {
                document.getElementById("mypic1").style.width = image1.width * 1 * document.getElementById("imageSize1").value + "px";
                document.getElementById("mypic1").style.height = height * (image1.width * 1 * document.getElementById("imageSize1").value/ width)+"px";
                // document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
                // document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
              }

              imageWidth1 = Number(document.getElementById("mypic1").style.width.substr(0,document.getElementById("mypic1").style.width.length -2));
              imageHeight1 = Number(document.getElementById("mypic1").style.height.substr(0,document.getElementById("mypic1").style.height.length -2));

          }
          // if (question.length > 1) {
          //   image1.src ='images/'+imagefolder+'/' + question[1];
          // } else {
          //   image1.src ='images/'+imagefolder+'/' + question[0];
          // }
          // image1.src = 'images/'+imagefolder+'/' + question;
          if (question.length > 1) {
            if (question[1].indexOf( "ttp" ) > 0){
              image1.src=question[1];
            } else {
              image1.src='images/'+imagefolder+'/' + question[1];
            }
          } else {
            if (question[0].indexOf( "ttp" ) > 0){
              image1.src=question[0];
            } else {
              image1.src='images/'+imagefolder+'/' + question[0];
            }
          }

       

        } else if ((question.indexOf( slashKakko ) > -1)){
          document.getElementById("textareas").style.display = "none";
          document.getElementById("div1").style.display = "block";
          document.getElementById("mypic1").style.display = "none";
          document.getElementById("questionMath").innerText = question;
          if (!(document.getElementById("mypic1")=== null)) {
            if (document.getElementById("mypic1").src){
              document.getElementById("mypic1").src= "";
            }      
          }else{
            var img_element = document.createElement('img');
            img_element.id= 'mypic1';
            // 指定した要素にimg要素を挿入
            var content_area = document.getElementById("div1");
            content_area.appendChild(img_element);
          }
          
          MathJax.Hub.Typeset(document.getElementById("div1"));//数式再読み込み
        
        } else if (isHTML(question)){
          document.getElementById("textareas").style.display = "none";
          document.getElementById("div1").style.display = "block";
          document.getElementById("mypic1").style.display = "none";
          document.getElementById("questionMath").innerHTML = question;
        } else {
          document.getElementById("div1").style.display = "none";
          document.getElementById("textareas").style.display = "block";
          document.getElementById( "textareas" ).value = "";
          document.getElementById( "textareas" ).value = question ;////////
          document.getElementById( "textareas2" ).value = "";
          AnswerShown = false;
        }



    }　//苦手度を取得

    var moji=rand + "." + document.mainform.DB_name.value;
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../getpoorat.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('534 getpoorat res is '+res);
        document.getElementById( "poorat" ).value = res;

    }
    var slcLang = document.getElementById("autoReading").value;
    if (document.getElementById("autoread").checked && !(document.getElementById( "textareas" ).value == "")
    && !(slcLang == "*e") && !(slcLang == "*j")) {
      readQuestion();
    }

    var ifautoAnswer = document.getElementById("autoAnswer");

    if ((ifautoAnswer.value > 0)) { //最初だけは自動で音楽を流さない
      async function main(){
      var sec = Number(ifautoAnswer.value);
      await sleep(sec*1000);
        if (AnswerShown2 == false){
          sendRequest2();
        }
      }
      main();
    }else {
      
    }
    if ((document.getElementById("chordsOrNot").checked)&&((document.getElementById("ctg3").value ==="コード")||(document.getElementById("ctg3").value ==="音程"))) {
      playChords(document.getElementById("textareas").value);
    }


  // imageResize();
    // settingSave()
  if (mp3PlayFlag != false||music.paused===false) {
    stop();
    music.currentTime = 0;
    mp3PlayFlag=false;
  }
}

function isHTML(str) {
    // 正規表現を使用してHTMLタグをチェック
    const pattern = /<\/?[a-z][\s\S]*>/i;
    return pattern.test(str);
}


function createXmlHttpRequest()
{
    var xmlhttp=null;
    //alert("3");
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


function sendRequest2(){

 randoms = [];
  AnswerShown = true;
  AnswerShown2 = true;
  
  /** 重複チェックしながら乱数作成 */
  for(i = min; i < max+1; i++){
    while(true){
      // alert(i);
      var tmp = intRandom(min, max);
      if(!randoms.includes(tmp)){
        randoms.push(tmp);
        break;
      }
    }
  }




  // console.log('606 getpastTime is '+getpastTime);
  var QAChangeChecked = document.getElementById("qachange").checked;////

  if (QAChangeChecked) {
      var phpfile1 = "getonequestion2.php";
      var phpfile2 = "getanswer2.php";
  } else {
      var phpfile1 = "getonequestion1.php";
      var phpfile2 = "getanswer1.php";
  }
  var moji=rand + "." + document.mainform.DB_name.value;
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null){
    // alert(phpfile2);
    xmlhttp.open("POST", "../"　+ phpfile2 , false);//乱数をもとに解答を取得
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    // console.log('502 res is '+ res);
    var AnswerTyped = document.getElementById( "textareas2" ).value;
    document.getElementById( "textareas2" ).value = "";


    if ((res.indexOf( "jpg" ) > -1)||(res.indexOf( "png" ) > -1)||(res.indexOf( "gif" ) > -1)||(res.indexOf( "jpeg" ) > -1)) {
      var resArr=Array();
      if (res.indexOf( "\n.....\n" ) > -1){
        resArr = res.split('\n.....\n');
        res = resArr[0];
        document.getElementById("answerHint").innerText = resArr[1];
      }
      
      document.getElementById("textareas2").style.display = "none";
      document.getElementById("mypic2").style.display = "block";
      document.getElementById("div2").style.display = "block";
      document.getElementById("answerMath").innerText ="";
      let parent = document.getElementById("answerMath");
      while(parent.lastChild){
        parent.removeChild(parent.lastChild);
      }
      // resizeTextareas();
      if (!resArr.length){
        document.getElementById("answerHint").innerText ="";
      }
      var imageadress =  res.split('\n');
      // console.log('imageadress is ' + imageadress);
      if (res.indexOf( "ttp" ) > 0){
        document.getElementById("mypic2").src=res;
      } else {
        document.getElementById("mypic2").src='images/'+imagefolder+'/' + imageadress[0];
      }
      
      // document.getElementById("mypic2").style.width = "200px"
      var el = document.getElementById("mypic2");
      var image2 = new Image();
      var width2;
      var height2;


      image2.onload = function(){
        width2 = image2.width;//画像の幅
        height2 = image2.height;//画像の高さ
        modifiedWidth2 = document.getElementById("imageSize2").value * width2 ;//画像幅に指定値をかけたもの
        modifiedHeight2  = document.getElementById("imageSize2").value * height2 ;
        if ((imageSize2>1000)){
          imageSize2 = 1000;
        }
        console.log('div2.width is ' + $('#div2').width());
        console.log('div2.height is ' + $('#div2').height());
        var result = $('#div2').innerWidth() - $('#div2').clientWidth;
        console.log('result is ' + result);
        if ((width2>height2)){
          document.getElementById("mypic2").style.width = modifiedWidth2 + "px";  // 
          document.getElementById("mypic2").style.height = modifiedHeight2　+"px"; // 高さを横幅の変化割合に合わせる;
          // document.getElementById("mypic2").style.width = $('#div1').width() + "px";  // 
          // document.getElementById("mypic2").style.height = $('#div1').height()　+"px"; // 高さを横幅の変化割合に合わせる;
          if (parseInt(document.getElementById("mypic2").style.width) > $('#div2').width()) {
            var pic2w = parseInt(document.getElementById("mypic2").style.width);
            var pic2h = parseInt(document.getElementById("mypic2").style.height);
            document.getElementById("mypic2").style.width = $('#div2').width() + "px";  // 
            document.getElementById("mypic2").style.height =  ($('#div2').width() * pic2h)/pic2w + "px";
          }
          if (parseInt(document.getElementById("mypic2").style.height) > $('#div2').height()) {
            var pic2w = parseInt(document.getElementById("mypic2").style.width);
            var pic2h = parseInt(document.getElementById("mypic2").style.height);
            document.getElementById("mypic2").style.height = $('#div2').height() + "px";  // 
            document.getElementById("mypic2").style.width =  ($('#div2').height() * pic2w)/pic2h + "px";
          }
        } else {
          document.getElementById("mypic2").style.width = image2.width * document.getElementById("imageSize2").value + "px";
          document.getElementById("mypic2").style.height = height2 * (image2.width * document.getElementById("imageSize2").value/ width2)+"px";
          // document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
          // document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
          if (parseInt(document.getElementById("mypic2").style.height) > $('#div2').height()) {
            var pic2w = parseInt(document.getElementById("mypic2").style.width);
            var pic2h = parseInt(document.getElementById("mypic2").style.height);
            document.getElementById("mypic2").style.height = $('#div2').height() + "px";  // 
            document.getElementById("mypic2").style.width =  ($('#div2').height() * pic2w)/pic2h + "px";
          }
          if (parseInt(document.getElementById("mypic2").style.width) > $('#div2').width()) {
            var pic2w = parseInt(document.getElementById("mypic2").style.width);
            var pic2h = parseInt(document.getElementById("mypic2").style.height);
            document.getElementById("mypic2").style.width = $('#div2').width() + "px";  // 
            document.getElementById("mypic2").style.height =  ($('#div2').width() * pic2h)/pic2w + "px";
          }
        }

        imageWidth2 = Number(document.getElementById("mypic2").style.width.substr(0,document.getElementById("mypic2").style.width.length -2));
        imageHeight2 = Number(document.getElementById("mypic2").style.height.substr(0,document.getElementById("mypic2").style.height.length -2));
      }

        if (res.indexOf( "ttp" ) > 0){
          image2.src=res;
        } else {
          image2.src='images/'+imagefolder+'/' + imageadress[0];
        }
    }else if (res.indexOf( "mp3" ) > 0||music.paused===false){//答えがmp3なら
      if (musicStartFlug === false){
        musicStartFlug = true;
      }else{
        music.preload = "auto";
        music.src = "./mp3/" + res;
        music.load();
        init(res);
        if (mp3PlayFlag != true) {
          play();
          mp3PlayFlag=true;
        } else {
          stop();
          mp3PlayFlag=false;
        }
        if (res === "問題がありません。"){
          stop();
          mp3PlayFlag=false;
        }
      }      
    } else if ((res.indexOf( slashKakko ) > -1)||(res.indexOf("span") > -1)){
      document.getElementById("textareas2").style.display = "none";
      document.getElementById("div2").style.display = "block";
      document.getElementById("mypic2").style.display = "none";
      // document.getElementById("answerMath").innerText = res;
      if (res.indexOf("span") > -1){ //Html形式の解答なら
        let parent = document.getElementById("answerMath");
        while(parent.lastChild){
          parent.removeChild(parent.lastChild);
        }
        document.getElementById("answerMath").insertAdjacentHTML('afterbegin',res);
      }else{
        
        document.getElementById("answerMath").innerText = res;
      }
      if (!(document.getElementById("mypic2")=== null)) {
        if (document.getElementById("mypic2").src){
          document.getElementById("mypic2").src= "";
        }      
      }else{
        var img_element = document.createElement('img');
        img_element.id= 'mypic2';
        // 指定した要素にimg要素を挿入
        var content_area = document.getElementById("div2");
        content_area.appendChild(img_element);
      }

      MathJax.Hub.Typeset(document.getElementById("div2"));//数式再読み込み
    } else if (isHTML(res)){
          document.getElementById("textareas2").style.display = "none";
          document.getElementById("div2").style.display = "block";
          document.getElementById("mypic2").style.display = "none";
          document.getElementById("answerMath").innerHTML = res;
    } else {
      document.getElementById("answerMath").innerText ="";
      let parent = document.getElementById("answerMath");
      while(parent.lastChild){
        parent.removeChild(parent.lastChild);
      }
      
      document.getElementById("div2").style.display = "none";
      document.getElementById("textareas2").style.display = "block";
      document.getElementById( "textareas2" ).value = "";
      if (AnswerTypedFlag === true) {
  		document.getElementById( "textareas2" ).value = document.getElementById( "textareas2" ).value + res + "\n";
        document.getElementById( "textareas2" ).value = document.getElementById( "textareas2" ).value + AnswerTyped ; 

        
        event.keyCode = 0;
      } else {
        document.getElementById( "textareas2" ).value = res;
      }
      answertext = res ;

    }
  }
  if (answertextareaflag == false ) {
      answertextareaflag = true;
  }else{
      answertextareaflag = false
      document.getElementById( "textareas2" ).value = "";
      document.getElementById("mypic2").src= "";

  }
  var slcLang = document.getElementById("autoReading").value;
  if (document.getElementById("autoread").checked && !(document.getElementById( "textareas2" ).value == "")
  && !(slcLang == "e*") && !(slcLang == "j*")) {
    readAnswer();
  }

}

function sendRequest3(goodPoor)
{
  now = new Date();
  getQendTime = now.getTime();
  getpastTime = Math.round((getQendTime-getQstartTime)/100)/10;
  correctQuestions.push(rand);
  document.mainform.poorat.value = goodPoor;
  incorrectNumber = 0;
  // console.log('document.mainform.poorat.value is ' + document.mainform.poorat.value);
  var moji=rand + "^" + document.mainform.DB_name.value + "^" + document.mainform.poorat.value + "^" +getpastTime;
  moji = encodeURIComponent(moji);
  // console.log('656 poorat is '+ document.mainform.poorat.value);
  // console.log('657 getpastTime is '+ getpastTime);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
    xmlhttp.open("POST", "../addcorrect.php", false);//正解ボタンを押す
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    // console.log('534 addcorrectres is '+res);
    document.getElementById( "textareas2" ).value = "";
    // document.getElementById( "preQInfo" ).innerHTML = "前問の結果  " +res;
    document.getElementById("div2").style.display = "none";
    document.getElementById("textareas2").style.display = "block";
  }


  sendRequest();

}


var incorrectNumber = 0;


function sendRequest4(goodPoor){
  now = new Date();
  getQendTime = now.getTime();
  getpastTime = Math.round((getQendTime-getQstartTime)/100)/10;
  incorrectQuestions.push(rand);
  let arr = incorrectQuestions.filter(element => element == rand)//何回同じ問題を間違えているのか
  if (arr.length >20){return};
  incorrectNumber = incorrectNumber + 1
  if (incorrectNumber >100){
    return;
  };
  document.mainform.poorat.value = goodPoor;
  var moji=rand + "^" + document.mainform.DB_name.value + "^" + document.mainform.poorat.value + "^" +getpastTime;
  moji = encodeURIComponent(moji);
  // console.log('678 poorat is '+ document.mainform.poorat.value);
  // console.log('679 getpastTime is '+ getpastTime);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null){
    xmlhttp.open("POST", "../addincorrect.php", false);//不正解ボタンを押す
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    document.getElementById( "textareas2" ).value = "";
    // document.getElementById( "preQInfo" ).innerHTML = "前問の結果  " +res;
    document.getElementById("div2").style.display = "none";
    document.getElementById("textareas2").style.display = "block";
  }

  sendRequest();
}

function correctMinus(){
  var moji=rand + "^" + document.mainform.DB_name.value;
  moji = encodeURIComponent(moji);
  // console.log('678 poorat is '+ document.mainform.poorat.value);
  // console.log('679 getpastTime is '+ getpastTime);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
    xmlhttp.open("POST", "../correctMinus.php", false);//不正解ボタンを押す
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    document.getElementById( "textareas2" ).value = "";
    document.getElementById( "textareas2" ).value = res;
    document.getElementById("div2").style.display = "none";
    document.getElementById("textareas2").style.display = "block";
  }
}

function incorrectMinus(){
  var moji=rand + "^" + document.mainform.DB_name.value;
  moji = encodeURIComponent(moji);
  // console.log('678 poorat is '+ document.mainform.poorat.value);
  // console.log('679 getpastTime is '+ getpastTime);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
    xmlhttp.open("POST", "../incorrectMinus.php", false);//不正解ボタンを押す
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    document.getElementById( "textareas2" ).value = "";
    document.getElementById( "textareas2" ).value = res;
    document.getElementById("div2").style.display = "none";
    document.getElementById("textareas2").style.display = "block";
  }
}

function sendRequest5(){
  var QAChangeChecked = document.getElementById("qachange").checked;
  if (QAChangeChecked) {      
      var moji=rand + "^^^^^" +
      document.mainform.DB_name.value + "^^^^^" +
      document.getElementById( "textareas2" ).value + "^^^^^" +
      document.getElementById( "textareas" ).value;      
  } else {
    if (document.getElementById( "textareas2" ).value.indexOf('...............')=== -1){
      var moji=rand + "^^^^^" +
      document.mainform.DB_name.value + "^^^^^" +
      document.getElementById( "textareas" ).value + "^^^^^" +
      document.getElementById( "textareas2" ).value;
    }else{
      var split =document.getElementById( "textareas2" ).value.split('\n............................................................\n');
      var moji=rand + "^^^^^" +
      document.mainform.DB_name.value + "^^^^^" +
      document.getElementById( "textareas" ).value + "^^^^^" +
      split[0]+ "^^^^^" +split[1];
    }
  }
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest2();
  if ((xmlhttp!=null)　&& ((moji.indexOf('Your%20Answer')=== -1) && (moji.indexOf('...............')=== -1))) {//修正する問題と答えに自分の解答やヒントがなければ修正する。
    xmlhttp.open("POST", "../modifyquestionanswer.php", false);//不正解ボタンを押す
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    // console.log('721 res is '+res);
  }
}

function deleteQ(){
  var moji=rand + "^" + document.mainform.DB_name.value;
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null){
    xmlhttp.open("POST", "../deleteQuestion.php", false);//不正解ボタンを押す
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    // console.log('delete is ' + res);
    document.getElementById( "textareas" ).value = "問題を削除しました。";
    document.getElementById( "textareas2" ).value = "";
  }
}

function createXmlHttpRequest2(){
  var xmlhttp=null;
  if(window.ActiveXObject){
    try{
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e){
      try{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e2){
      }
    }
  }
  else if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

/** min以上max以下の整数値の乱数を返す */
function intRandom(min, max){
    return Math.floor( Math.random() * (max - min + 1)) + min;
}

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
}


function listChanged(){
  firstRemoveFlag =false;
  // alert(flag1);
  num=-1;
  // document.getElementById("press-button").innerHTML = num +"/"+ max;
  flag1 = false;
  // alert(flag1);
}

function backQuestion(){
  if ((document.getElementById("novelSelect").value) && !(document.getElementById("novelSelect").value == "なし")){
    //小説戻す
    novelRowNum = Number(novelRowNum)-1
    getNovelSentence();
  }
  now = new Date();
  getQstartTime = now.getTime();
  console.log(`backQuestion`);
  answertextareaflag = false;
  var QAChangeChecked = document.getElementById("qachange").checked;////

  if (QAChangeChecked) {
      var phpfile1 = "getonequestion2.php";
      var phpfile2 = "getanswer2.php";
  } else {
      var phpfile1 = "getonequestion1.php";
      var phpfile2 = "getanswer1.php";
  }

  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null){
    if (num>0) {
        num = num -1;
    } else {
        num=Number(max)-1;
    }
    // console.log('num is '+num);
    document.getElementById("press-button").innerHTML = num+1   +"/"+Number(max);
    rand = questionnumbers[num];
    var moji=rand + "." + document.mainform.DB_name.value;
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null){
      xmlhttp.open("POST", "../"+phpfile1, false);//乱数をもとに問題を取得
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      // console.log('396 data is '+data);
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
      // console.log('1120 res is '+res);
      var res = res.split('^^^');
      var doc0= document.getElementById("questionInfo");
      var correctNum = ""
      var question = ""

      if (res[0].indexOf("正解数")<0) {
        question = res[0];
        correctNum = res[1];
      } else {
        question = res[1];
        correctNum = res[0];
      }

      doc0.innerHTML= correctNum;

      if ((question.indexOf( "jpg" ) > -1)||(question.indexOf( "png" ) > -1)||(question.indexOf( "gif" ) > -1)||(question.indexOf( "jpeg" ) > -1)) {
        document.getElementById("textareas").style.display = "none";
        document.getElementById("div1").style.display = "block";
        // var imageadress =  res.split('\n');
        // console.log('question is ' + question);
        // console.log('imagefolder is ' + res[2]);
        document.getElementById("mypic1").src='images/'+res[2]+'/' + question;
        // document.getElementById("mypic1").style.width = "700px";
      } else {
        document.getElementById("div1").style.display = "none";
        document.getElementById("textareas").style.display = "block";
        document.getElementById( "textareas" ).value = "";
        document.getElementById( "textareas" ).value = question ;
        document.getElementById( "textareas2" ).value = "";;
      }
    }　//苦手度を取得
    var moji=rand + "." + document.mainform.DB_name.value;
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
      xmlhttp.open("POST", "../getpoorat.php", false);//正解ボタンを押す
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
      // console.log('534 getpoorat res is '+res);
      document.getElementById( "poorat" ).value = res;
    }
  }
}

function forgettingcurve(){
  listChanged()
  var now = new Date();
  var yesterday = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 1);
  var aweekago = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 7);
  var amonthago = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 30);

  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "=";
  document.getElementById("criteria1").value = formatDate(yesterday, 'YYYYMMDD');
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  document.getElementById("criteria2").value = formatDate(aweekago, 'YYYYMMDD');
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = "=";
  document.getElementById("criteria3").value = formatDate(amonthago, 'YYYYMMDD');
  sendRequest()
}

function NotYetQuestion(){
  listChanged()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "<";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category4").value = "";
  document.getElementById("operator1").value = "";
  document.getElementById("criteria1").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
}

function UnderFifty(){
  listChanged()
  document.getElementById("category6").value = "pca";
  document.getElementById("operator3").value = "<";
  document.getElementById("criteria3").value = "50";
  document.getElementById("category5").value = "incorrect";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "0";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function yesterdayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  yesterdayIncorrect = true;
  getYesterdayNumberFunc();
  sendRequest()
}
function threeDaysAgoQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getThreeDaysAgoNumberFunc()
  sendRequest()
}
function noTodayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function errTodayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "=";
  getTodayNumberFunc()
  yesterdayIncorrect = true;
  sendRequest()
}
function errLastQuestion(){
  yesterdayIncorrect = true;
  sendRequest()
}
function aWeekAgoQuestion(){
  listChanged()
 
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()  
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getAWeekAgoNumberFunc();
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = ">";
  document.getElementById("criteria3").value = "20190101";
  sendRequest()
}
function aMonthAgoQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()  
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getAMonthAgoNumberFunc();
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = ">";
  document.getElementById("criteria3").value = "20190101";
  sendRequest()
}
function levelZero(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "0";
  sendRequest()
}
function levelOne(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "1";
  sendRequest()
}
function levelTwo(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "2";
  sendRequest()
}
function levelThree(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "3";
  sendRequest()
}
function levelFour(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "4";
  sendRequest()
}
function ZeroPercent(){
  listChanged()
  document.getElementById("category6").value = "pca";
  document.getElementById("operator3").value = "=";
  document.getElementById("criteria3").value = "0";
  document.getElementById("category5").value = "incorrect";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "0";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function atLeastOneFunc(){
  listChanged()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}

function oneByOneFunc(){
  oneByOneflag = true;
  listChanged()
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
  oneByOneflag = false;
}

function twoByTwoFunc(){
  twoByTwoflag = true;
  listChanged()
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
  twoByTwoflag = false;
}

function threeByThreeFunc(){
  threeByThreeflag = true;
  listChanged()
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
  threeByThreeflag = false;
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



const uttr2 = new SpeechSynthesisUtterance()

function readAnswer(){//
  // 発言を作成
  uttr2.text = answerText2.value;

  var isJapanese = false;  //日本語（英語以外）の場合「true」に設定
  for(var i=0; i < uttr2.text.length; i++){
      if(uttr2.text.charCodeAt(i) >= 256) {
        isJapanese = true;
        break;
      }
  }

  var lang;

  if (isJapanese){
    lang=readVoices.find(el => el.indexOf('Japanese')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Kyoko')>-1);
    }
  }else{
    lang=readVoices.find(el => el.indexOf('English')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Samantha')>-1);
    }
  }

  // 言語 (日本語:ja-JP, アメリカ英語:en-US, イギリス英語:en-GB, 中国語:zh-CN, 韓国語:ko-KR)
  var slcLang = document.getElementById("autoReading").value




  uttr2.rate = 0.7

  if (isJapanese == true) {
    uttr2.rate = document.getElementById("jpSpeed").value;
  } else {      
    uttr2.rate = document.getElementById("engSpeed").value;
  }

  // 高さ 0-2 初期値:1
  uttr2.pitch = 1

  // 音量 0-1 初期値:1
  uttr2.volume = 0.75

  
  // // ③ 選択された声を指定
  // uttr2.voice = window.speechSynthesis.getVoices()[voice];
  // alert(readVoices);
  uttr2.voice = speechSynthesis
  .getVoices()
  .filter(voice => voice.name == lang)[0]; //言語設定

  speechSynthesis.speak(uttr2)
  // alert(uttr2.voice.name);



}
const uttr = new SpeechSynthesisUtterance();

function readQuestion(){
  // const uttr = new SpeechSynthesisUtterance(questionText2.value)
  uttr.text = questionText2.value;
  var isJapanese = false;  //日本語（英語以外）の場合「true」に設定
  for(var i=0; i < uttr.text.length; i++){
      if(uttr.text.charCodeAt(i) >= 256) {
        isJapanese = true;
        break;
      }
  }

  var lang;

  if (isJapanese){
    lang=readVoices.find(el => el.indexOf('Japanese')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Kyoko')>-1);
    }
  }else{
    lang=readVoices.find(el => el.indexOf('English')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Samantha')>-1);
    }
  }

  // 言語 (日本語:ja-JP, アメリカ英語:en-US, イギリス英語:en-GB, 中国語:zh-CN, 韓国語:ko-KR)
  var slcLang = document.getElementById("autoReading").value
  

  uttr.rate = 0.7

  if (isJapanese == true) {
    uttr.rate = document.getElementById("jpSpeed").value;
  } else {      
    uttr.rate = document.getElementById("engSpeed").value;
  }

  // 高さ 0-2 初期値:1
  uttr.pitch = 1

  // 音量 0-1 初期値:1
  uttr.volume = 0.75
  // ③ 選択された声を指定
  // uttr.voice = window.speechSynthesis.getVoices()[voice];

  // alert (uttr.rate);
  uttr.voice = speechSynthesis
  .getVoices()
  .filter(voice => voice.name == lang)[0]; 
  // .filter(voice => voice.name == readVoices[0])[0];      //言語設定
  // uttr.voice = speechSynthesis
  //   .getVoices()
  //   .filter(voice => voice.name === voiceSelect.value)[0]
  // 発言を再生 (発言キュー発言に追加)
  speechSynthesis.speak(uttr)



}

function autoQuestion(){
  // console.log('document.getElementById("jpSpeed").value is ' + document.getElementById("jpSpeed").value);
  var slcLang = document.getElementById("autoReading").value;
  if (autoflag==false) {
  autoflag = true;
  } else {
  autoflag = false;
  }
  var finishReading = false;
  var finishReading2 = false;
  // console.log('autoflag is ' + autoflag);
  if (document.getElementById("autoread").checked) {
    async function main(){
      for(;;) {
        if (autoflag == false) {
            break;
        }

        sendRequest();
        if (!(slcLang == "*e") && !(slcLang == "*j")){
          uttr.onend = function (event) {
            // console.log(`3`);
            finishReading = true;
          }
          while (finishReading == false){
            // i++;    // この文が無いと無限ループになってしまう。
            // console.log(i);
            await sleep(500);
          }
        }

        sendRequest2();
        if (!(slcLang == "e*") && !(slcLang == "j*")){
              uttr2.onend = function (event) {
                // console.log(`4`);
                finishReading2 = true;
              }
              while (finishReading2 == false){
                i++;    // この文が無いと無限ループになってしまう。
                // console.log(i);
                await sleep(500);
              }
        }
        finishReading = false;
        finishReading2 = false;
      }
    }
    main();

  } else {
    var speed = document.getElementById("autoSpeed").value * 1000;
    async function main(){
      for(;;) {
        if (autoflag == false) {
            break;
        }
        sendRequest();
        await sleep(speed);
        sendRequest2();
        await sleep(speed);
      }
    }
    main();
  }
}

function sleep(time){
  return new Promise(resolve => {
    sleepId = setTimeout(resolve, time);
  });
}

function textareafontresize(){
  document.getElementById("textareas").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("textareas2").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("questionMath").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("answerMath").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("answerHint").style.fontSize = document.getElementById("fontresize").value;

    
}

var firstRemoveFlag =false;

function removeCorrects(){
  var counts = {};
  minimumCorrect = Number(document.getElementById("NOC").value);
  console.log('削除前　questionnumbers is ' + questionnumbers);
  for(var i=0;i< correctQuestions.length;i++){
    var key = correctQuestions[i];
    counts[key] = (counts[key])? counts[key] + 1 : 1 ;
  }
  for (var key in counts) {
      console.log(key + " : " + counts[key]);
  }
  if (!firstRemoveFlag) {
    for (let i = 0; i < questionnumbers.length; i++) {
      if (Number(counts[questionnumbers[i]]) == 1) {
        questionnumbers.splice(i, 1);
        i=i-1;
        
      }
      firstRemoveFlag =true;
    }
  } else {
    for (let i = 0; i < questionnumbers.length; i++) {
      if (Number(counts[questionnumbers[i]]) >= minimumCorrect) {
        questionnumbers.splice(i, 1);
        i=i-1;
      }
    }
  }
  // console.log('削除後　questionnumbers is ' + questionnumbers);
  MaxQuestionNumber = questionnumbers.length;
}



// document.onkeydown = keydown;
document.addEventListener('keydown', (ev) => {
  if(!ev.repeat)
  keydown()
})
function keydown() {
  console.log('event.keyCode is ' + event.keyCode);
  console.log('event.code is ' + event.code);
  console.log('event.shiftKey is ' + event.altKey);
  // 現在フォーカスが与えられている要素を取得する
  var active_element = document.activeElement;

  // 出力テスト
  console.log(active_element);
  if ((document.getElementById("keyControl").checked) && (AnswerShown)//キー操作にチェックがあり
  && (document.activeElement.id == "textareas2")//解答欄がアクティブであり
  && (document.getElementById("answerByMyself").checked)) {//解答入力にチェックがあるとき
    // console.log('event.keyCode is ' + event.keyCode);
    // console.log('event.key is ' + event.key);
    whichKey1()
  }else if((document.getElementById("keyControl").checked) //キー操作にチェックがあり
  && (!document.getElementById("answerByMyself").checked)//解答入力にチェックがあり
  && (document.activeElement.id != "textareas2")//解答欄がアクティブでなく
  && (document.activeElement.id != "textareas")//問題欄がアクティブでなく
  && (document.activeElement.id != "criteria1")//基準欄がアクティブでなく
  && (document.activeElement.id != "criteria2")
  && (document.activeElement.id != "criteria3")
  && (document.activeElement.id != "wordSearch")//検索欄がアクティブでなく
  && (document.activeElement.id != "information")//通信欄がアクティブでなく
  && (document.activeElement.id != "DB_name")){//データベース名欄がアクティブでないとき　⇒つまり文字入力しないでキー操作のみで学習するとき

    whichKey2()
  }
}

function whichKey1(){
  if ((event.ctrlKey)) {
    if (event.keyCode === 229){
        switch (event.code) {
          case "KeyE":
              sendRequest2();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyR":
              sendRequest2();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyQ":
              sendRequest();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyW":
              sendRequest();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyF":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyD":
              sendRequest3('good2');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyS":
              sendRequest3('good3');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyA":
              sendRequest3('good4');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          
          case "KeyJ":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyH":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyV":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyB":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyN":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyC":
              sendRequest4('poor2');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyX":
              sendRequest4('poor3');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyZ":
              sendRequest4('poor4');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyM":
              readQuestion();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          default:
              ;
              break;
        }
    } else {
      switch (event.keyCode) {
        case 82:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 69:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 87:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 81:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 70:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 74:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 72:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 52:
          readAnswer()
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 68:
          sendRequest3('good2');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 83:
          sendRequest3('good3');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 65:
          sendRequest3('good4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 86:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        // case 54:
          // sendRequest4('poor1');
          // event.keyCode = 0;
          // event.returnValue = false;
          // break;
        case 73:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 67:
          sendRequest4('poor2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 88:
          sendRequest4('poor3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 90:
          sendRequest4('poor4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        
        default:
          ;
          break;
      }
    }
  }else if(event.keyCode === 219){
    sendRequest3('good1');
    event.keyCode = 0;
    event.returnValue = false;
  }else if(event.keyCode === 221){
    sendRequest4('poor1');
    event.keyCode = 0;
    event.returnValue = false;
  }
}
function whichKey2(){
  if (event.keyCode === 229 && event.keyCode != "ControlLeft"){
    switch (event.code) {
      case "KeyE":
          sendRequest2();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyR":
          sendRequest2();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyQ":
          sendRequest();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyW":
          sendRequest();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyF":
          sendRequest3('good1');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyD":
          sendRequest3('good2');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyS":
          sendRequest3('good3');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyA":
          sendRequest3('good4');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyV":
          sendRequest4('poor1');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyC":
          sendRequest4('poor2');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyX":
          sendRequest4('poor3');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyZ":
          sendRequest4('poor4');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;

      default:
          ;
          break;
    }
  } else {
    switch (event.keyCode) {
      case 82:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 69:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 87:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 81:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 70:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 74:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 72:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 68:
          sendRequest3('good2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 83:
          sendRequest3('good3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 65:
          sendRequest3('good4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 86:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      // case 54:
      //     sendRequest4('poor1');
      //     event.keyCode = 0;
      //     event.returnValue = false;
      //     break;
      case 52:
          readAnswer()
          event.keyCode = 0;
          event.returnValue = false;
        break;
      case 73:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 67:
          sendRequest4('poor2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 88:
          sendRequest4('poor3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 90:
          sendRequest4('poor4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 80:
          backQuestion();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      
      default:
          ;
          break;
    }
  }
}

function settingSave(){
  // console.log('document.getElementById("fontresize").value is '+document.getElementById("fontresize").value);
  moji = document.mainform.DB_name.value + "^^" + 
  document.getElementById("MaxQuestionNumber").value + "^^" +
  document.getElementById("fontresize").value + "^^" +
  document.getElementById("autoSpeed").value + "^^" +
  document.getElementById("autoReading").value + "^^" +
  document.getElementById("jpSpeed").value + "^^" +
  document.getElementById("engSpeed").value + "^^" +
  document.getElementById("NOC").value + "^^" +
  document.getElementById("autoAnswer").value + "^^" +
  document.getElementById("qachange").checked + "^^" +
  document.getElementById("autoread").checked + "^^" +
  document.getElementById("keyControl").checked + "^^" +
  document.getElementById("answerByMyself").checked + "^^" +
  document.getElementById("randomOrNot").checked + "^^" +
  document.getElementById("backGround").value + "@@@@" +
  document.getElementById("fontSelect").value + "^^" + 
  document.getElementById("novelSelect").value + "^^" + 
  document.getElementById("novelSentenceNumber").value + "^^" + 
  document.getElementById("flexButton").checked + "^^" + 
  document.getElementById("blackCheck").checked;
  novelRowNum = Number(document.getElementById("novelSentenceNumber").value);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    xmlhttp.open("POST", "../settingSave.php", false);//不正解ボタンを押す
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    // console.log('settingSave res is '+res);
  }


}
function parseStrToBoolean(str) {
  // 文字列を判定
  return (str == 'true') ? true : false;

}

var selectElement = document.getElementById("novelSelect");
var novels = "<?php echo $novelsArray; ?>";　// 変数受け渡し。
novels = novels.split(",", -1);　// bb_csvをsplit()でカンマ区切り配列に再編成。
for(var i = 1; i < novels.length; i ++){
  var option = document.createElement("option");
  option.value = novels[i];
  option.innerText = novels[i];
  selectElement.appendChild(option);
}



var response = '<?php echo $response;?>';
response = response.split('^');
// console.log('response is '+response);
if (response[0]) {
  if (response[0]==="all"){
    document.getElementById("MaxQuestionNumber").value = "all"
  } else {
    document.getElementById("MaxQuestionNumber").value = Number(response[0]);
  }
}
// document.getElementById("MaxQuestionNumber").value = Number(response[0]);
if (response[1]) {
  document.getElementById("fontresize").value = response[1];
}
textareafontresize()
if (response[2]) {
  document.getElementById("autoSpeed").value =  Number(response[2]);
}
if (response[3]) {
  document.getElementById("autoReading").value = response[3];
  }
if (response[4]) {
  document.getElementById("jpSpeed").value = response[4];
}
if (response[5]) {
  document.getElementById("engSpeed").value = response[5];
}
// console.log('document.getElementById("engSpeed").value is ' + document.getElementById("engSpeed").value);
if (response[6]) {
  document.getElementById("NOC").value = Number(response[6]);
}
if (response[7]) {
  document.getElementById("autoAnswer").value = Number(response[7]);
}
document.getElementById("qachange").checked = parseStrToBoolean(response[8]);
document.getElementById("autoread").checked = parseStrToBoolean(response[9]);
document.getElementById("keyControl").checked = parseStrToBoolean(response[10]);
document.getElementById("answerByMyself").checked = parseStrToBoolean(response[11]);
document.getElementById("randomOrNot").checked = parseStrToBoolean(response[12]);
document.getElementById("flexButton").checked = parseStrToBoolean(response[18]);
if (response[13]) {  
response2 = response[13].split('@@@@');}
if (response2[0]) {
document.getElementById("backGround").value = response2[0];}
changeBG();
if (response2[1]) {
document.getElementById("fontSelect").value = response2[1];}
changeFont();
if (response[16]) {
document.getElementById("novelSelect").value = response[16];}
if (response[21]) {
  if (response[21]==='true'){
    document.getElementById("blackCheck").checked = true;
    turnBlack()
  } else{
    document.getElementById("blackCheck").checked = false;
  }
}

if (response[18]==="true") {
  QnAareaFlex();
}
if (response[20]) {
  if ((document.getElementById("novelSelect").value) && !(document.getElementById("novelSelect").value == "なし")){
    document.getElementById("novelSentenceNumber").value = response[20];
  }
}


function AnswerSent(code)
{
    //エンターキー押下なら
    if((13 === code) && (AnswerShown === false) && (document.getElementById("autoAnswer").value === "0")
    && (document.getElementById("answerByMyself").checked))
    {
        AnswerTypedFlag = true;
        sendRequest2();
    }
}
function getTodayNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate());
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m  + d;
  document.getElementById("criteria1").value = result;
}
function getYesterdayNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-1);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getThreeDaysAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-3);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getAfterNdays(n){
   var dt = new Date();
   dt.setDate(dt.getDate()+n);
   return formatDate(dt);
}
function getAWeekAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-7);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getAMonthAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-31);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
  // var objDate = new Date();

  // objDate.setDate(objDate.getDate() - 1);
  // var result = String(objDate.getFullYear())+String(objDate.getMonth())+String(objDate.getDate())
  // console.log(objDate.getFullYear())
  // console.log(objDate.getMonth())
  // console.log(objDate.getDate())
  document.getElementById("criteria2").value = result;
}
function getFirstDayFunc()
{
  document.getElementById("criteria2").value ="20010101";
}

var base = 60;

var key =  ["C","C#","D","E♭","E","F","F#","G","A♭","A","B♭","B"];

var chordname={"△":"100010010000",
"maj":"100010010000",
"m":"100100010000",
"dim":"100100100000",
"aug":"100010001000",
"△7":"100010010001",
"maj7":"100010010001",
"m7":"100100010010",
"7":"100010010010",
"dim7":"100100100100",
"m7♭5":"100100100010",
"minmaj7":"100100010001",
"6":"100010010100",
"m6":"100100010100",
"9":"100010010010001",
"maj9":"101010010001",
"m9":"101100010010",
"sus2":"101000010000",
"sus4":"100001010000",
"7b9":"10001001001001",
"7s9":"100110010010",
"7s11":"100010110010",
"7b13":"100010011010",
"7sus4":"100001010010",
"aug7":"100010001010",
"maj7s11":"100010110001",
"7#5":"100010001010",
"m#5":"100100001000",
"7b5":"100010100010"};

function getNote(_chordname){
  j=0;
  note=[];
  for(i=0;i<12;i++){
    j = chordname[_chordname].indexOf("1",j);
    if(j == -1){break;}
    note[note.length]=j;
    j=j+1;
  }
  return note;
};

function getMIDI(chord){
  if (chord.substr(1,3) === "sus") {
    _key=chord.substr(0,1);
    _chordname=chord.substr(1);
  } else if (chord.substr(2,3) === "sus") {
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "s"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "#"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "b"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "♭"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else {
    _key=chord.substr(0,1);
    _chordname=chord.substr(1);
  }
  if (_chordname===""){_chordname="maj"};
  if (_key==="G♭"){_key==="F#"};
  if (_key==="D♭"){_key==="C#"};
  if (_key==="A#"){_key==="B♭"};
  if (_key==="Gb"){_key==="F#"};
  if (_key==="Db"){_key==="C#"};
  if (_key==="As"){_key==="B♭"};
  if (_key==="Fs"){_key==="F#"};
  if (_key==="Cs"){_key==="C#"};

  root = base + key.indexOf(_key);
  note= getNote(_chordname);
  midi=[];
  for(i=0;i<note.length;i++){
      midi[i]=root+note[i];
  }
  return midi;
};

function playMIDI(midi){
    MIDI.loadPlugin({
        soundfontUrl: "./soundfont/",
        instrument: "acoustic_grand_piano",
        onprogress: function(state, progress) {
            console.log(state, progress);
        },
        onsuccess: function() {
            var delay = 0; // play one note every quarter second
            var velocity = 127; // how hard the note hits
            // play the note
            MIDI.setVolume(0, 127);
            for(i=0;i<midi.length;i++){
                for(j=0;j<midi[i].length;j++){
                    MIDI.noteOn(0, midi[i][j], velocity, delay);
                    MIDI.noteOff(0, midi[i][j], delay + 0.75);
                }
                delay = delay +1;
            }
        }
    });
    return "";
};

function playChords(chords){
    _chords=chords.split(/\r\n|\r|\n| |,/);//改行コードもしくは空白もしくはカンマ
    console.log(_chords);
    //_chords = chords.split(" ");
    _midi = []
    for(_c in _chords){
        if(_chords[_c].length==0){continue;}
        _midi[_midi.length]=getMIDI(_chords[_c]);
    }
    playMIDI(_midi);
}

var music = new Audio();
var music2 = new Audio();
var musicFlag = false;
var rres;
var musicDuration ="";
function init(res) {
  rres = res;
  music.preload = "auto";
  music.src = "./mp3/" + res;
  music.load();
  music2.preload = "auto";
  music2.src = "./mp3/" + res;
  music2.load();

  music.addEventListener('loadedmetadata',function(e) {
      console.log(music.duration); // 総時間の取得
      musicDuration = music.duration

  });

  music.addEventListener('pause',function(e) {
  console.log("pause!");
  music.currentTime = 0;


  var isPlaying = music.currentTime > 0 && !music.paused && !music.ended
      && music.readyState > 2;

  if (!isPlaying) {
    music.src = "./mp3/" + res + "#t=0," + String(musicDuration - Number(document.getElementById("mp3StartPoint").value));
    setTimeout(function() {
        music.playbackRate = document.getElementById("mp3Speed").value;
      music.play();
      var musicFlag = true;
    }, 0);
    }

  });

}

var timeout_id = null;

function play() {
  // music.loop = true;


  // music.currentTime = Number(document.getElementById("mp3StartPoint").value);
  music.playbackRate = document.getElementById("mp3Speed").value;
  music.play();
  var musicFlag = true;
  // timeout_id =setTimeout("play();", musicDuration- Number(document.getElementById("mp3StartPoint").value));

  // timeout_id =setTimeout("play();", 3000);
}



function stop() {
  music.pause();
  // music2.pause();
  // music.currentTime = Number(document.getElementById("mp3StartPoint").value);
  // setTimeout() メソッドの動作をキャンセルする
clearTimeout(timeout_id);
timeout_id = null;
}


function imageSizeChange1(){
  imageSize = document.getElementById("imageSize1").value;
  document.getElementById("mypic1").style.width = imageWidth1 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
  document.getElementById("mypic1").style.height = imageHeight1 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
}


function imageSizeChange2(){
  imageSize = document.getElementById("imageSize2").value;
  document.getElementById("mypic2").style.width = imageWidth2 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
  document.getElementById("mypic2").style.height = imageHeight2 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
}
function informationChange(){
  var moji=  document.mainform.DB_name.value + "^" + document.mainform.information.value;
  moji = encodeURIComponent(moji);

  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
      xmlhttp.open("POST", "../informationChange.php", false);//不正解ボタンを押す
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;

  }
}

function changeBG(wIMG) {
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + wIMG + ")";///////////////////
}

function　changeFont(){
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.fontFamily = document.getElementById("fontSelect").value;;
  }
}

function newOnesFunc(){

}
//音声読み上げ
const answerText2        = document.querySelector('#textareas2')
const questionText2        = document.querySelector('#textareas')
const voiceSelect = document.querySelector('#voice-select')
const speakBtn    = document.querySelector('#speak-btn')
var readVoices = new Array();
var readVoiceJp ="";
var readVoiceEng ="";

// selectタグの中身を声の名前が入ったoptionタグで埋める
function appendVoices() {
  // ①　使える声の配列を取得
  // 配列の中身は SpeechSynthesisVoice オブジェクト
  const voices = speechSynthesis.getVoices()
  voices.forEach(voice => { //　アロー関数 (ES6)
    // 日本語と英語以外の声は選択肢に追加しない。
    if(!voice.lang.match('ja|en-US')) return
    readVoices.push(voice.name);
  });
  // alert(readVoices);
  var voiceNum =0;
  readVoices.forEach( function( item ) {
    if (item.includes('ja') || item.includes('Ja')|| item.includes('Kyoko')) {
      if(!readVoiceJp){readVoiceJp = voiceNum};
    }
    if (item.includes('en') || item.includes('En')|| item.includes('Samantha')) {
      if(!readVoiceEng){readVoiceEng = voiceNum;}
    }
    voiceNum += 1;
  });
  // alert(readVoices);
}

appendVoices()

// // ② 使える声が追加されたときに着火するイベントハンドラ。
// // Chrome は非同期に(一個ずつ)声を読み込むため必要。
speechSynthesis.onvoiceschanged = e => {
  appendVoices();
}



    // Execute loadVoices.
    






var novelRowNum = 1;
if (document.getElementById("novelSentenceNumber").value) {
  novelRowNum = Number(document.getElementById("novelSentenceNumber").value);
}
    

function getNovelSentence(){
  var moji=document.mainform.DB_name.value + "." + Number(novelRowNum) + "." + 
  document.mainform.novelSelect.value;
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest2();
  if(xmlhttp!=null)
  {
      xmlhttp.open("POST", "../getNovelSentence.php", false);//正解ボタンを押す
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
      document.getElementById("novel").innerHTML = res;
      document.getElementById("novelSentenceNumber").value = Number(novelRowNum);

  }
    
    
}
function  category1Change(){
  // var elem = document.querySelectorAll('select[name="category2"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category3"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category4"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category5"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
}

function QnAareaFlex(){
  var mainform = document.getElementById("mainform");
  var Qarea = document.getElementById("textareas");
  var QareaImage = document.getElementById("div1");
  var Aarea = document.getElementById("textareas2");
  var AareaImage = document.getElementById("div2");
  var PrePosision = document.getElementById("questionbuttonbox");
  var ParentElement = document.getElementById("QandAwindow");
  if (QnAareaFlexFlug === false){
    Qarea.style.width= "42%"; 
    QareaImage.style.width= "42%";
    Qarea.style.height= "60vh"; 
    QareaImage.style.height= "62.5vh";
    Aarea.style.width= "42%"; 
    AareaImage.style.width= "42%"; 
    Aarea.style.height= "60vh"; 
    AareaImage.style.height= "62.5vh"; 
    Qarea.style.float = "left";
    QareaImage.style.float = "left";
    // AareaImage.style.float = "left";
    // Aarea.style.display= "flex"; 
    // AareaImage.style.display= "flex"; 
    if (AareaImage.style.display === "none"){
      AareaImage.style.display= "none";
    }
    ParentElement.insertBefore(AareaImage,QareaImage.nextSibling);
    ParentElement.insertBefore(Aarea,QareaImage.nextSibling);
    // document.getElementById("flexButton").checked = true;
    QnAareaFlexFlug = true;
  }else{
    Qarea.style.width= "97%";
    QareaImage.style.width= "97%"; 
    Qarea.style.height= "24vh"; 
    QareaImage.style.height= "27.5vh";
    Aarea.style.width= "97%"; 
    AareaImage.style.width= "97%";
    Aarea.style.height= "24vh"; 
    AareaImage.style.height= "27.5vh"; 
    // Aarea.style.display= "block"; 
    // AareaImage.style.display= "block"; 
    if (AareaImage.style.display === "none"){
      AareaImage.style.display= "none";
    }
    ParentElement.insertBefore(Aarea,PrePosision.nextSibling);
    ParentElement.insertBefore(AareaImage,Aarea.nextSibling);
    QnAareaFlexFlug = false;
    // document.getElementById("flexButton").checked = false;
  }
}
function blackOrWhite(){
  if (document.getElementById("blackCheck").checked){
    
    turnBlack();
  } else {
    turnWhite();
  }
}

function turnBlack(){

  var elements = document.getElementsByClassName('info02');
  for(i=0;i<elements.length;i++){
    // elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('button');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('selectBox');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('setting');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('checkText');
  for(i=0;i<elements.length;i++){
    elements[i].style.color = '#7a7a7a';
  }
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + "1701.png" + ")";
  document.getElementById("questionInfo").style.color = '#7a7a7a';
}
function turnWhite(){

  var elements = document.getElementsByClassName('info02');
  for(i=0;i<elements.length;i++){
    // elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#ffccff'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('button');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#EEEEEE'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('selectBox');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#EEEEEE'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('setting');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#e4fcff'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('checkText');
  for(i=0;i<elements.length;i++){
    elements[i].style.color = '#000000';
  }
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + response2[0] + ")";
  document.getElementById("questionInfo").style.color = '#000000';
}
function removeQuestion(){
  if (questionnumbers != ""){
    if (!firstRemoveFlag) {
    //  questionnumbers.splice(num, 1);
      correctQuestions.push(rand);
    } else {
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
    }
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


function resizeTextareas(){
  var width;
  var height;
  observer.disconnect();
  observer2.disconnect();

  if ( elementTextareas.style.width.match("%")) {//%が含まれているか
    // width=elementTextareas.style.width; 
    // height=elementTextareas.style.height; 
    width=Number(parseInt(elementTextareas.style.width))+Number(2); 
    width=width+"%"
    height=Number(parseInt(elementTextareas.style.height))+Number(2); 
    height=height+"vh"
  }else{
    width=Number(parseInt(elementTextareas.style.width))+Number(25); 
    width=width+"px"
    height=Number(parseInt(elementTextareas.style.height))+Number(25); 
    height=height+"px"
  }
  console.log("11  "+elementTextareas.style.width);
  console.log("12  "+ width);
  console.log("13  "+height);
  
  console.log("13.1  "+$('#div2').width());
  console.log("13.2  "+$('#div2').height());
  $('#textareas2').width(elementTextareas.style.width); 
  $('#textareas2').height(elementTextareas.style.height); 
  $('#div1').width(width); 
  $('#div1').height(height); 
  $('#div2').width(width); 
  $('#div2').height(height); 
  console.log("14  "+$('#div2').width());
  console.log("15  "+$('#div2').height());

  observer2.observe(elementTextareas2, options);
  observer.observe(elementTextareas, options);
}
document.addEventListener('keydown', function(event) {
    // Ctrlキーが押されているか、F12キーが押されているかを確認
    if (event.ctrlKey && event.key === 'F12') {
        readQuestion();
        event.preventDefault(); // デフォルトの動作をキャンセル
    }
});

</script>

</body>
</html>
