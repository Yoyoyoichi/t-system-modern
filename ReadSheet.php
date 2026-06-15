<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>
<style type="text/css">
body {
  /* line-height:clamp(0.35em, 0.55em, 0.65em); */
  margin:0;
}
span {font-size:30px;}
#div01{
  padding:0px 0px 0px 20px;
}
.textlines{
  font-size:15px;
  padding:5px 0px 0px 0px;
}
.grandGrandParentContainer{
  padding:10px 0px 200px 10px;
  height:auto;
  overflow:hidden
}
.grandParentContainer{
  display: inline-block;
  border: solid 1px black;
  height:auto;
  padding:10px 5px 5px 10px ;
}
.ParentContainer {
  padding:0px 0px 0px 0px;
  float: left;
  height:auto;
  border: 1px solid;
  
}
.container {
  padding: 0px 0px 0px 0px;
  height:auto;
  display: inline-block;
  float:left;
}
.clearfix{
	content: "";
	clear: both;
	display: block;
}
#piano-wrap * {            
  box-sizing: border-box;
  font-family: Arial;
  user-select: none;
}
#piano-wrap {
  display: flex;
  padding:0px 0px 0px 0px;
  line-height: clamp(0.35em, 0.55em, 0.65em);
}
#piano-wrap > div {
  position: relative;
}
.white-key {
  width: 1.4vw;
  height: 8vw;
  background-color: white;
  border: solid 1px black;
  z-index: 1;
  /* border-bottom: solid rgb(230, 230, 230) 10px; */
  box-shadow: 0 7px 3px 0 rgba(0, 0, 0, 0.3);
  transition: 100ms;
  color: black;
}
.black-key {
  overflow: visible;
  z-index : 2;
  background: linear-gradient(to bottom, rgb(117, 117, 117) 97%, white);
  width: 1vw;
  height: 5vw;
  border: solid 1px black;
  margin-left: calc(-1vw/2);
  margin-right: calc(-1vw/2);

}
.noteCircle{
  position: absolute;
  bottom: 10%;
  left: 50%;
  transform: translate(-50%,-50%);
}
.key-label {
  position: absolute;
  display: block;
  bottom: 10px;
  width: 100vh;
  text-align: center;
}
</style>
<body>
<?php
$mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
if( $mysqli->connect_errno){
    echo 'Access Failed';//謗･邯壼､ｱ謨・
    exit;
}

$result0 = $mysqli->query("set names utf8");
$db_name = "ChordProgressions";//$_GET["DB_name"];///////

$db_column = "name";


//繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
$mysqli->set_charset("utf8");


//繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ1繧貞叙蠕・
$str_sql = "select $db_column from $db_name";
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
    $response[] = $dat['name'];
    
}

$response = array_values($response);
//    var_dump($response);
$row_cnt = count($response);

$sampleSelectBox = "<div id = 'div01'><select class='selectBox' name=\"songNameList\" id='songNameList' onChange='songNameChange()' multiple style='width:19%;height:15vh; font-size: 25px;margin:1px'>\n";
for ( $i = 1; $i < $row_cnt; $i++ ) {
    $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
}
$sampleSelectBox .= "</select>\n";

echo "{$sampleSelectBox}";

//繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ2繧貞叙蠕・
$str_sql = "select chordProgression from $db_name ";
$result = $mysqli->query($str_sql);

if (!$result) {error_log($mysqli->error);exit;}
unset($response);
$response[0] ="";
while($dat = $result->fetch_assoc()){
    $response[] = $dat['chordProgression'];
}

$response = array_values($response);
// // var_dump($response);
// echo "<br>"."\n";
// echo $response[16];
// echo "<br>"."\n";
$row_cnt = count($response);

$sampleSelectBox = "<select class='selectBox' name=\"progressionList\" id='progressionList'  multiple style='width:19%;height:15vh; font-size: 25px;margin:1px'>\n";
// $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >荳ｭ繧ｫ繝・ざ繝ｪ繝ｼ</option>\n";

// $sampleSelectBox .="\t<option value=""></option>\n";
for ( $i = 1; $i < $row_cnt; $i++ ) {
    $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
}//
$sampleSelectBox .= "</select>\n";

echo "{$sampleSelectBox}";

//繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ2繧貞叙蠕・
$str_sql = "select pianoChordHtml from $db_name ";
$result = $mysqli->query($str_sql);

if (!$result) {error_log($mysqli->error);exit;}
unset($response);
$response[0] ="";
while($dat = $result->fetch_assoc()){
    $response[] = substr ($dat['pianoChordHtml'],2,10);
}

$response = array_values($response);
// var_dump($response);
$row_cnt = count($response);

$sampleSelectBox = "<select class='selectBox' name=\"progressionList\" id='progressionList'  multiple style='width:19%;height:15vh; font-size: 25px;margin:1px'>\n";
// $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >荳ｭ繧ｫ繝・ざ繝ｪ繝ｼ</option>\n";

// $sampleSelectBox .="\t<option value=""></option>\n";
for ( $i = 1; $i < $row_cnt; $i++ ) {
    $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
}//
$sampleSelectBox .= "</select>\n";
echo "{$sampleSelectBox}";

mysqli_close($mysqli);

global $testnumber;
$testnumber = 0;
?>
<div id = "preferrance">
  <select class="selectBox" name='' id='fontSize'   style='width:3vw;height:3vh; font-size: 20px"' onchange="fontSizeChange(this)">
    <option value=""></option>
  </select>
  <select class="selectBox" name='' id='fontSize2'   style='width:3vw;height:3vh; font-size: 20px"' onchange="fontSizeChange2(this)">
    <option value=""></option>
  </select>
  <select class="selectBox" name='' id='fontSize3'   style='width:3vw;height:3vh; font-size: 20px"' onchange="fontSizeChange3(this)">
    <option value=""></option>
  </select><br><br>
  <select class="selectBox" name='' id='borderNote1'   style='width:3vw;height:3vh; font-size: 20px"'>
    <option value=""></option>
  </select>
  <select class="selectBox" name='' id='borderNote2'   style='width:3vw;height:3vh; font-size: 20px"'>
    <option value=""></option>
  </select><br>
  <select class="selectBox" name='' id='borderNote3'   style='width:3vw;height:3vh; font-size: 20px"'>
    <option value=""></option>
  </select>
  <select class="selectBox" name='' id='borderNote4'   style='width:3vw;height:3vh; font-size: 20px"'>
    <option value=""></option>
  </select>
  <input class ="button" type="button" name="" id="scopeButton" onClick="scope()" 
  value="scope"  style=" width:3vw;height:3vh; font-size: 20px">
  <select class="selectBox" name='' id='keyChangeBox'  onchange="keyChange(this)"  style='width:3vw;height:3vh; font-size: 20px"'>
    <option value="-5">-5</option>
    <option value="-4">-4</option>
    <option value="-3">-3</option>
    <option value="-2">-2</option>
    <option value="-1">-1</option>

    <option value="1">+1</option>
    <option value="2">+2</option>
    <option value="3">+3</option>
    <option value="4">+4</option>
    <option value="5">+5</option>


    </option>
  </select>
  <div>
    
</div>

</div>
<select class="selectBox" name='key' id='key' 
  style='width: 10vw; font-size: 20px;height: 5vh;line-height: 1vh;vertical-align:top;'>
  <option value=""></option>
  <option value="0">C</option>
  <option value="1">C#</option>
  <option value="2">D</option>
  <option value="3">E笙ｭ</option>
  <option value="4">E</option>
  <option value="5">F</option>
  <option value="6">F#</option>
  <option value="7">G</option>
  <option value="8">A笙ｭ</option>
  <option value="9">A</option>
  <option value="10">B笙ｭ</option>
  <option value="11">B</option>
</select>
<select class="selectBox" name='scalesOrChords' id='scalesOrChords' 
  style='width: 10vw; font-size: 20px;height: 5vh;line-height: 1vh;vertical-align:top;'>

</select>
<input class ="button" type="button" name="showScaleButton" id="showScaleButton" onClick="addScale(this);ShowScale('','',this)" 
value="ShowScale"  style=" width:15vw;height:5vh; font-size: 15px">
<br>
<select class="selectBox" name='key2' id='key2' 
  style='width: 10vw; font-size: 20px;height: 5vh;line-height: 1vh;vertical-align:top;'>
  <option value=""></option>
  <option value="0">C</option>
  <option value="1">C#</option>
  <option value="2">D</option>
  <option value="3">E笙ｭ</option>
  <option value="4">E</option>
  <option value="5">F</option>
  <option value="6">F#</option>
  <option value="7">G</option>
  <option value="8">A笙ｭ</option>
  <option value="9">A</option>
  <option value="10">B笙ｭ</option>
  <option value="11">B</option>
</select>
<select class="selectBox" name='scalesOrChords2' id='scalesOrChords2' 
  style='width: 10vw; font-size: 20px;height: 5vh;line-height: 1vh;vertical-align:top;'>

</select>
<input class ="button" type="button" name="showScaleButton2" id="showScaleButton2" onClick="addScale(this);ShowScale('','',this)" 
value="ShowScale"  style=" width:15vw;height:5vh; font-size: 15px">
<br>
<!-- <input class ="button" type="button" name="" id="" onClick="downloadScale()" 
value="DownloadScale"  style=" width:15vw;height:5vh; font-size: 15px"> -->
<input class ="button" type="button" name="" id="" onClick="LineupScale()" 
value="LineupScale"  style=" width:15vw;height:5vh; font-size: 15px">
<input class ="button" type="button" name="" id="addSongButton" onClick="addSong()" 
value="UpdateProgression"  style=" width:15vw;height:5vh; font-size: 15px">
<!-- <input class ="button" type="button" name="" id="addHiraganaButton" onClick="addHiragana()" 
value="縺ｲ繧峨′縺ｪ"  style=" width:15vw;height:5vh; font-size: 15px"> -->
<br><br>
<input class ="button" type="button" name="" id="deleteSongButton" onClick="deleteSong()" 
value="DeleteProgression"  style=" width:15vw;height:5vh; font-size: 15px">
<br><br>
<TEXTAREA id = "songName" class='textlines' style ="width:50vw;height:4vh;padding:2px 0px 2px 0px;"></textarea>
<br>
<TEXTAREA id = "progressionNote" class='textlines' style ="width:90vw;height:20vh"></textarea>
  </div>
<div class = "grandGrandParentContainer" id="grandGrandParentContainer">
  <div class = "grandParentContainer" id="grandParentContainer">
    <div class = "ParentContainer clearfix" id="ParentContainer">  
      <div class = "container" id="container">
        <span id = "ChordOrScaleName" class = 'ChordOrScaleName' style ="font-size:15px;padding:0px 0px 0px 0px;"></span>
        <div id="piano-wrap" > 
          <!-- <div class="white-key notes octave1" noteNum = 0 name = "0"></div>
          <div class="black-key notes octave1" noteNum = 1 name = "1"></div>
          <div class="white-key notes octave1" noteNum = 2 name = "2"></div>
          <div class="black-key notes octave1" noteNum = 3 name = "3"></div>
          <div class="white-key notes octave1" noteNum = 4 name = "4"></div>
          <div class="white-key notes octave1" noteNum = 5 name = "5"></div>
          <div class="black-key notes octave1" noteNum = 6 name = "6"></div>
          <div class="white-key notes octave1" noteNum = 7 name = "7"></div>
          <div class="black-key notes octave1" noteNum = 8 name = "8"></div>
          <div class="white-key notes octave1" noteNum = 9 name = "9"></div>
          <div class="black-key notes octave1" noteNum = 10 name = "10"></div>
          <div class="white-key notes octave1" noteNum = 11 name = "11"></div>
          <div class="white-key notes octave2" noteNum = 12 name = "0"></div>
          <div class="black-key notes octave2" noteNum = 13 name = "1"></div>
          <div class="white-key notes octave2" noteNum = 14 name = "2"></div>
          <div class="black-key notes octave2" noteNum = 15 name = "3"></div>
          <div class="white-key notes octave2" noteNum = 16 name = "4"></div>
          <div class="white-key notes octave2" noteNum = 17 name = "5"></div>
          <div class="black-key notes octave2" noteNum = 18 name = "6"></div>
          <div class="white-key notes octave2" noteNum = 19 name = "7"></div>
          <div class="black-key notes octave2" noteNum = 20 name = "8"></div>
          <div class="white-key notes octave2" noteNum = 21 name = "9"></div>
          <div class="black-key notes octave2" noteNum = 22 name = "10"></div>
          <div class="white-key notes octave2" noteNum = 23 name = "11"></div>
          <div class="white-key notes octave3" noteNum = 24 name = "0"></div>
          <div class="black-key notes octave3" noteNum = 25 name = "1"></div>
          <div class="white-key notes octave3" noteNum = 26 name = "2"></div>
          <div class="black-key notes octave3" noteNum = 27 name = "3"></div>
          <div class="white-key notes octave3" noteNum = 28 name = "4"></div>
          <div class="white-key notes octave3" noteNum = 29 name = "5"></div>
          <div class="black-key notes octave3" noteNum = 30 name = "6"></div>
          <div class="white-key notes octave3" noteNum = 31 name = "7"></div>
          <div class="black-key notes octave3" noteNum = 32 name = "8"></div>
          <div class="white-key notes octave3" noteNum = 33 name = "9"></div>
          <div class="black-key notes octave3" noteNum = 34 name = "10"></div>
          <div class="white-key notes octave3" noteNum = 35 name = "11"></div>
          <div class="white-key notes octave3" noteNum = 36 name = "0"></div> -->
        </div>
      </div>
      <div class = "LineupStart" id = "LineupStart"></div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="board.js"></script>
<script type="text/javascript">



for (let i = 0; i < scales.length; i++) {//Mp3髢句ｧ句慍轤ｹ繧ｻ繝ｬ繧ｯ繝郁ｦ∫ｴ霑ｽ蜉
    // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
  var select = document.getElementById("scalesOrChords");
  // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
  var option = document.createElement("option");
  // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
  option.text = scales[i][0];
  // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
  option.value = scales[i][0];
  // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
  select.appendChild(option);
}
for (let i = 0; i < scales.length; i++) {//Mp3髢句ｧ句慍轤ｹ繧ｻ繝ｬ繧ｯ繝郁ｦ∫ｴ霑ｽ蜉
    // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
  var select = document.getElementById("scalesOrChords2");
  // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
  var option = document.createElement("option");
  // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
  option.text = scales[i][0];
  // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
  option.value = scales[i][0];
  // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
  select.appendChild(option);
}



// var elem = document.getElementsByClassName("notes");
// for(i=0;i<elem.length;i++){
//   elem[i].innerHTML = "";
//   elem[i].setAttribute('noteNum',i);
// }
// // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
// var select = document.getElementById("fontSize2");
// for (i=5;i<40;i++){
//   // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
//   var option = document.createElement("option");
//   // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
//   option.text = i;
//   // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
//   option.value = i;
//   // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
//   select.appendChild(option);
// }
// // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
// var select = document.getElementById("fontSize");
// for (i=5;i<20;i++){
//   // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
//   var option = document.createElement("option");
//   // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
//   option.text = i;
//   // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
//   option.value = i;
//   // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
//   select.appendChild(option);
// }
// // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
// var select = document.getElementById("fontSize3");
// for (i=5;i<40;i++){
//   // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
//   var option = document.createElement("option");
//   // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
//   option.text = i;
//   // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
//   option.value = i;
//   // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
//   select.appendChild(option);
// }
// // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
// var select = document.getElementById("borderNote1");
// for (i=0;i<elem.length;i++){
//   // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
//   var option = document.createElement("option");
//   // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
//   option.text = i;
//   // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
//   option.value = i;
//   // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
//   select.appendChild(option);
// }
// // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
// var select = document.getElementById("borderNote2");
// for (i=0;i<elem.length;i++){
//   // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
//   var option = document.createElement("option");
//   // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
//   option.text = i;
//   // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
//   option.value = i;
//   // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
//   select.appendChild(option);
// }
// // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
// var select = document.getElementById("borderNote3");
// for (i=0;i<elem.length;i++){
//   // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
//   var option = document.createElement("option");
//   // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
//   option.text = i;
//   // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
//   option.value = i;
//   // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
//   select.appendChild(option);
// }
// // select繧ｿ繧ｰ繧貞叙蠕励☆繧・
// var select = document.getElementById("borderNote4");
// for (i=0;i<elem.length;i++){
//   // option繧ｿ繧ｰ繧剃ｽ懈・縺吶ｋ
//   var option = document.createElement("option");
//   // option繧ｿ繧ｰ縺ｮ繝・く繧ｹ繝医ｒ4縺ｫ險ｭ螳壹☆繧・
//   option.text = i;
//   // option繧ｿ繧ｰ縺ｮvalue繧・縺ｫ險ｭ螳壹☆繧・
//   option.value = i;
//   // select繧ｿ繧ｰ縺ｮ蟄占ｦ∫ｴ縺ｫoption繧ｿ繧ｰ繧定ｿｽ蜉縺吶ｋ
//   select.appendChild(option);
// }
// select.options[18].selected = true


function keyToNumber(key){
  switch (key) {
    case "C":
      key = 0;      
      break;
    case "C#":
      key = 1;      
      break;
    case "D笙ｭ":
      key = 1;      
      break;
    case "Db":
      key = 1;      
      break;
    case "D":
      key = 2;      
      break;
    case "D#":
      key = 3;      
      break;
    case "E笙ｭ":
      key = 3;      
      break;
    case "Eb":
      key = 3;      
      break;
    case "E":
      key = 4;      
      break;
    case "E#":
      key = 5;      
      break;
    case "F":
      key = 5;      
      break;
    case "F#":
      key = 6;      
      break; 
    case "Gb":
      key = 6;      
      break;    
    case "G":
      key = 7;      
      break;
    case "G#":
      key = 8;      
      break;
    case "A笙ｭ":
      key = 8;      
      break;
    case "Ab":
      key = 8;      
      break;
    case "A":
      key = 9;      
      break;
    case "A#":
      key = 10;      
      break;
    case "B笙ｭ":
      key = 10;      
      break;
    case "Bb":
      key = 10;      
      break;
    case "B":
      key = 11;      
      break;
  }
  return key;  
}
var result;
var scaleChord = new Array();
var onChordRoot;

function getNoteNumber(key,sOrC){
  
  if (key.substr(1, 1)===":"){
    key = key.substr(2);
  }else if(key.substr(0, 1)==="/"){
    key = key.substr(1);
  }
  key = keyToNumber(key);
  var notes = new Array();
  if (typeof sOrC != "undefined") {
    if (sOrC.indexOf('/')>-1){    
      onChord = true;
      let index = sOrC.indexOf('/');
      onChordRoot = sOrC.substring(index+1);
      onChordRoot = keyToNumber(onChordRoot);
      //substring()縺ｧ謖・ｮ壹＠縺滓枚蟄励∪縺ｧ繧貞・繧雁・縺励・
      sOrC = sOrC.substring(0,index)
      
    }   
  }
  if(sOrC===""){sOrC="M"};
  if(typeof sOrC === "undefined"){sOrC="M"};
  
  result = scales.filter( e => e[0][0] === sOrC );
  
  var scaleChord0 = new Array();
  if (result.length===0){
    return;
  }
  if(typeof result[0][1] != "undefined"){
    scaleChord0 = result[0][1];
  };
  

  for(i=0;i<scaleChord0.length;i++){
    notes[i] = Number(scaleChord0[i])+Number(key);
    if(notes[i]>11){notes[i]=notes[i] % 12}
  }
  return notes;
}

function addScale(button){
  var txt;
  var txt2;
  var key = new Array();

  var key = document.getElementById("key");
  var sOrC = document.getElementById("scalesOrChords");
  // selected縺ｧ驕ｸ謚槭＆繧後※縺・ｋ蛟､縺ｮ逡ｪ蜿ｷ縺悟叙蠕励＆繧後∪縺・
  let idx = key.selectedIndex;
  txt = key.options[idx].text;


  var key2 = document.getElementById("key2");
  var sOrC2 = document.getElementById("scalesOrChords2");
  // selected縺ｧ驕ｸ謚槭＆繧後※縺・ｋ蛟､縺ｮ逡ｪ蜿ｷ縺悟叙蠕励＆繧後∪縺・
  let idx2 = key2.selectedIndex;
  txt2 = key2.options[idx2].text; 


  if (!txt2){
    txt = txt +  document.getElementById("scalesOrChords").value;
  }else{
    txt = txt2 +  document.getElementById("scalesOrChords2").value;
  }
  
  document.getElementById( "progressionNote" ).value = document.getElementById( "progressionNote" ).value + "[" + txt + ']';
}

var keyboardNumber = 0;
var number01= "";
var containerNumber =0;
var grandParentNum = "";
var KeyNumInParent = 1;
var barNum = Number($("#bar1").val())-1;
var sectionNumber = 1;





function ShowScale(key,sOrC,lyric){
  document.getElementById("container").style.display = "block";
  $("#container").find('.black-key').css('background', 'linear-gradient(to bottom, rgb(117, 117, 117) 97%, white)');
  $("#container").find('.white-key').css('background', 'white');
  var elem = $("#container").find('.notes');
  // console.log(elem[0].getAttribute('noteNum'));
  

  for(i=0;i<elem.length;i++){
    elem[i].innerHTML = "";
  }

  var idx;
  var txt;
  var idx2;
  var txt2;

  if (!key){
    key = document.getElementById("key");
    sOrC = document.getElementById("scalesOrChords").value;
    // selected縺ｧ驕ｸ謚槭＆繧後※縺・ｋ蛟､縺ｮ逡ｪ蜿ｷ縺悟叙蠕励＆繧後∪縺・
    idx = key.selectedIndex;
    txt = key.options[idx].text; 
    key = txt;
    if (document.getElementById("key2")){
      key2 = document.getElementById("key2");
      sOrC2 = document.getElementById("scalesOrChords2").value;
      // selected縺ｧ驕ｸ謚槭＆繧後※縺・ｋ蛟､縺ｮ逡ｪ蜿ｷ縺悟叙蠕励＆繧後∪縺・
      idx2 = key2.selectedIndex;
      txt2 = key2.options[idx2].text; 
      key2 = txt2;
    }
    if (key2){
      document.getElementById("ChordOrScaleName").innerHTML = key2 + " " + sOrC2;
    }else{
      document.getElementById("ChordOrScaleName").innerHTML = key + " " + sOrC;
    }
  }else{
    // document.getElementById("ChordOrScaleName").innerHTML = key + " " + sOrC;
    document.getElementById("ChordOrScaleName").innerHTML = lyric;
  }

  for (l=0;l<2;l++){
    
    if(l===1){
      if((typeof txt2 === 'undefined')||(txt2 === "")){break;}
      key = key2;
      sOrC = sOrC2;          
    }

    var noteNumbers = getNoteNumber(key,sOrC)
    if (typeof noteNumbers === "undefined"){break;}
    for (i=0;i<noteNumbers.length;i++){
      var fretElem =  $("#container").find('[name="'+noteNumbers[i]+'"]');

      if (l===0){
        var borderNote = $("#borderNote1").val();
        if (borderNote){
          borderNote = borderNote.replace('note', '');
          borderNote = Number(borderNote);
        
          fretElem = fretElem.filter(function(value,index,array){        
            return Number(index.attributes.notenum.value) < borderNote;
          });
        }
      }else {
        var borderNote2 = $("#borderNote2").val();
        var borderNote = $("#borderNote1").val();
        if (borderNote2){
          borderNote2 = borderNote2.replace('note', '');
          borderNote2 = Number(borderNote2);
        
          fretElem = fretElem.filter(function(value,index,array){        
            return Number(index.attributes.notenum.value) > borderNote2-1;
          });
        }else if (borderNote){
          borderNote = borderNote.replace('note', '');
          borderNote = Number(borderNote);
        
          fretElem = fretElem.filter(function(value,index,array){        
            return Number(index.attributes.notenum.value) > borderNote-1;
          });
        }
      }
      
      for (j=0;j<fretElem.length;j++){
        // let intarvalFromKey = noteNumbers[i] - noteNumbers[0];
        // if (intarvalFromKey < 0){intarvalFromKey = intarvalFromKey + 12};
        switch(result[0][2][i]){
          case "r":
            if ((onChordRoot===0)||(onChordRoot)){
              fretElem[j].innerHTML = "<span class='noteCircle'  style='color:#F00;'>笳・/span>";
            // fretElem[j].style.background = 'skyblue';
            }else{
              fretElem[j].innerHTML = "<span class='noteCircle'  style='color:#000;font-size:  40px '>笳・/span>";
              // fretElem[j].style.background = 'black';
            }
            break;
          case "c":
            fretElem[j].innerHTML = "<span class='noteCircle'  style='color:#F00;'>笳・/span>";
            // fretElem[j].style.background = 'skyblue';
            break;
          case "nt":
            fretElem[j].innerHTML = "<span class='noteCircle'  style='color:skyblue;'>笳・/span>";
            // fretElem[j].style.background = 'palegreen';
            break;
          case "at":
            fretElem[j].innerHTML = "<span class='noteCircle'  style='color:green;'>笳・/span>";
            // fretElem[j].style.background = 'palegreen';
            break;
          case "bn":
            fretElem[j].innerHTML = "<span class='noteCircle'  style='color:blue;'>笳・/span>";
            // fretElem[j].style.background = 'palegreen';
            break;
        }
      
      }

    }
    if ((onChordRoot===0)||(onChordRoot)){
      var fretElem =  $("#container").find('[name="'+onChordRoot+'"]');
      for (j=0;j<fretElem.length;j++){
        fretElem[j].innerHTML = "<span class='noteCircle'  style='color:#000;font-size:  40px '>笳・/span>";
      }
      onChordRoot="";
    }

  }
  // 隍・｣ｽ縺吶ｋHTML隕∫ｴ繧貞叙蠕・
  var content_area = document.getElementById("container");

  // 隍・｣ｽ
  var clone_element = content_area.cloneNode(true);

  // 隍・｣ｽ縺励◆隕∫ｴ縺ｮ螻樊ｧ繧堤ｷｨ髮・
  containerNumber = containerNumber +1
  clone_element.id = "container"+ containerNumber;

  if (key.substr(1, 1)===":"){
    // if (sectionNumber != 1 ){
      var startElem = $("#grandParentContainer"+grandParentNum);
      // div隕∫ｴ繧堤函謌・
      var grandParentDiv = document.createElement('div');
      // class繧定ｿｽ蜉
      grandParentDiv.className = 'grandParentContainer';
      grandParentNum = Number(grandParentNum)+1
      grandParentDiv.id = 'grandParentContainer'+grandParentNum;
      grandParentDiv.style.margin='10px 1px 5px 10px';
      grandParentDiv.style.border='1px solid';
      grandParentDiv.style.verticalAlign= 'top'; 
      // grandParentDiv.appendChild(parentDiv);
      // 譁ｰ縺励＞HTML隕∫ｴ繧剃ｽ懈・
      var new_el = document.createElement('br');

      startElem[0].after(grandParentDiv);
      startElem[0].after(new_el);
      
      keyboardNumber = 0;
      // div隕∫ｴ繧堤函謌・
      var parentDiv = document.createElement('div');
      // class繧定ｿｽ蜉
      parentDiv.className = 'ParentContainer clearfix';
      number01=Number(number01)+ 1;
      // barNum = Number($("#bar"+number01).val())-1;
      parentDiv.id = 'ParentContainer'+number01;
      parentDiv.style.margin='0px 0px 0px 0px';
      parentDiv.style.border='1px solid';
      var startElem = $("#grandParentContainer"+grandParentNum);
      startElem[0].appendChild(parentDiv);
      // div隕∫ｴ繧堤函謌・
      var childDiv = document.createElement('div');
      // class繧定ｿｽ蜉
      childDiv.className = 'LineupStart';
      childDiv.id = 'LineupStart'+number01;
      parentDiv.appendChild(childDiv);
    // }
    sectionNumber = sectionNumber +1
  }

  if (key.substr(0, 1)==="/"){
    if (number01 === ""){
     number01= 2;
      keyboardNumber = 0;
      // barNum = Number($("#bar"+number01).val())-1;
    }else{
      number01=Number(number01)+ 1;
      keyboardNumber = 0;
      // barNum = Number($("#bar"+number01).val())-1;
    }
    // div隕∫ｴ繧堤函謌・
    var parentDiv = document.createElement('div');
    // class繧定ｿｽ蜉
    parentDiv.className = 'ParentContainer clearfix';
    parentDiv.id = 'ParentContainer'+number01;
    parentDiv.style.margin='0px 0px 0px 0px';
    // parentDiv.style.float='left';
    parentDiv.style.border='1px solid';

    


    // div隕∫ｴ繧堤函謌・
    var childDiv = document.createElement('div');
    // class繧定ｿｽ蜉
    childDiv.className = 'LineupStart';
    childDiv.id = 'LineupStart'+number01;
    parentDiv.appendChild(childDiv);

    if (number01===2){
      var startElem = $("#grandParentContainer"+grandParentNum).find("#ParentContainer");
      startElem.after(parentDiv);
      
    }else{
      // num2= number01-1
      var startElem = $("#grandParentContainer"+grandParentNum).find("#ParentContainer"+(number01-1));
      startElem.after(parentDiv);
    }

  }


  // 隍・｣ｽ縺励◆HTML隕∫ｴ繧偵・繝ｼ繧ｸ縺ｫ謖ｿ蜈･
  var startElem = $("#ParentContainer"+number01).find('#LineupStart'+number01);
  startElem.before(clone_element);
  keyboardNumber = keyboardNumber + 1
  document.getElementById("container").style.display = "none";
  
}

function downloadScale(){
  var moji = document.getElementById("songName").value + "^^^" + document.getElementById("progressionNote").value+ "^^^" ;
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    xmlhttp.open("POST", "../getPianoHtml.php", false);//荳肴ｭ｣隗｣繝懊ち繝ｳ繧呈款縺・
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
  }

  if (res) {
    document.getElementById("grandParentContainer").remove();
    document.getElementById("grandGrandParentContainer").innerHTML = res;
    console.log(res);
    setKeyClick();
  }
  
}
// var grandParentContanerElem = document.createElement("div"); // p隕∫ｴ菴懈・
var grandParentContanerElem = document.getElementById("grandParentContainer");
var clone_element = grandParentContanerElem.cloneNode(true);
var grandGrandParentElement = document.getElementById("grandGrandParentContainer")
grandGrandParentElement.after(clone_element);
// 隍・｣ｽ縺励◆隕∫ｴ縺ｮ螻樊ｧ繧堤ｷｨ髮・
clone_element.id = "clone_GrandParent";
clone_element.style.display ="none";
var onChord = false;



function LineupScale(){
  grandParentNum = "";    
  while( grandGrandParentElement.firstChild ){
    grandGrandParentElement.removeChild(grandGrandParentElement.firstChild );
  }
  var clone_element0 = document.getElementById("clone_GrandParent");
  var clone_element = clone_element0.cloneNode(true);
  grandGrandParentElement.appendChild(clone_element);
  clone_element.style.display ="inline-block";
  clone_element.id = "grandParentContainer";
  
  var keyboardNumber = 0;
  
  var chords = document.getElementById("progressionNote").value;
  chords = chords.split('[(竊・]').join('(竊・') 
  chords = chords.split('\n');

  var chords2=Array();
  for(i=0;i<chords.length;i++){
    chords2[i] = chords[i].split('[');
    for(j=1;j<chords2[i].length;j++){      
      chords2[i][j] = '[' + chords2[i][j]
    }
    chords2[i] = chords2[i].filter(Boolean);
  }
  for(i=0;i<chords2.length;i++){
    for(j=0;j<chords2[i].length;j++){  
      if((chords2[i][j].indexOf( '[')<0)&&(typeof chords2[i][j+1]!= "undefined")){
        chords2[i][j+1] = chords2[i][j]+chords2[i][j+1]
        chords2[i][j]=''
      }
    }
    chords2[i] = chords2[i].filter(Boolean);
  };
  chords = chords2;

  var key = new Array();
  var sOrC = new Array();
  var lyric = new Array();
  var containerChangeFlag = false;
  for(i=0;i<chords.length;i++){
    if(chords[i].length===0){
      containerChangeFlag = true;//繧ｰ繝ｩ繝ｳ繝峨・繧｢繝ｬ繝ｳ繝・さ繝ｳ繝・リ蛻・ｊ譖ｿ縺医ヵ繝ｩ繧ｰ
    }
    for(j=0;j<chords[i].length;j++){
      if (chords2[i][j].indexOf( '[')<0){continue;}
      let chord = chords[i][j].match(/\[(.+)\]/)[1];//[]縺ｮ荳ｭ霄ｫ繧貞叙蠕・
      let chordRoot;
      let chordType;
      if (chord.length===1){
        chordRoot = chord
      } else if ((chord.length===2)&&((chord.substr(1,1)==='#')||(chord.substr(1,1)==='b')||(chord.substr(1,1)==='笙ｭ')||(chord.substr(1,1)==='・・))){
        chordRoot = chord
      } else if ((chord.substr(1,1)==='#')||(chord.substr(1,1)==='b')||(chord.substr(1,1)==='笙ｭ')||(chord.substr(1,1)==='・・)){
        chordRoot = chord.substr(0,2);
        chordType = chord.substr(2);        
      } else {
        chordRoot = chord.substr(0,1);
        chordType = chord.substr(1);
      }
      if (typeof chordType != "undefined") {
        // if (chordType.indexOf( '/')>-1){
          
        //   let index = chordType.indexOf('/');
        //       //substring()縺ｧ謖・ｮ壹＠縺滓枚蟄励∪縺ｧ繧貞・繧雁・縺励・
        //   chordType = chordType.substring(0,index)  
        // }      
      }
      if (i!=0){
        if (containerChangeFlag === true ){
          chordRoot = '笳・' + chordRoot;
          containerChangeFlag = false;
        } else if(j===0){
          chordRoot = '/' + chordRoot;
        }
      }
        

      // 謖・ｮ壽枚蟄励・繧､繝ｳ繝・ャ繧ｯ繧ｹ
      // let index = chords[i][j].indexOf(']');
      //       //substring()縺ｧ謖・ｮ壹＠縺滓枚蟄励∪縺ｧ繧貞・繧雁・縺励・
      // let str = chords[i][j].substring(index+1)    
      let str = chords[i][j];
      key.push(chordRoot);
      sOrC.push(chordType);
      lyric.push(str);
    }
  }

  
  var keyboardNumber = 0;
  for(k=0;k<key.length;k++){

    ShowScale(key[k],sOrC[k],lyric[k])    
    
  }  
 number01= "";
}

function songNameChange(){
  document.getElementById("songName").value = document.getElementById("songNameList").value ;

  let idx = document.getElementById("songNameList").selectedIndex;
  let txt = document.getElementById("progressionList").options[idx].value;//text繧帝∈縺ｶ縺ｨ謾ｹ陦後′蜿肴丐縺輔ｌ縺ｪ縺・・縺ｧvalue繧帝∈縺ｶ縲・
  document.getElementById("progressionNote").value = txt;
}
function addSong(){
  var elem = $(document).find("#grandGrandParentContainer");

  var elem2 = "elem[0].outerHTML";
  // console.log(elem2);
  var moji = document.getElementById("songName").value + "^^^" + document.getElementById("progressionNote").value+ "^^^" + elem2;
  console.log(moji);
  moji = encodeURIComponent(moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    xmlhttp.open("POST", "../addSongProgression.php", false);//荳肴ｭ｣隗｣繝懊ち繝ｳ繧呈款縺・
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
  }
}
function deleteSong(){
  let check = window.confirm('蜑企勁縺励∪縺吶°・・);
  if (check){
    var moji = document.getElementById("songName").value;
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
      xmlhttp.open("POST", "../deleteProgression.php", false);//荳肴ｭ｣隗｣繝懊ち繝ｳ繧呈款縺・
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data="+moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
    }
  }
}

function createXmlHttpRequest(){
  var xmlhttp=null;
  //alert("3");
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
  }else if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

function scope(){
  let scopeNum = Number($('#borderNote3').val());
  for(j=0;j<scopeNum;j++){
    var elem = $(document).find('[notenum="'+j+'"]');
    $(document).find('[notenum="'+j+'"]').hide();
    // }
  }
  if($('#borderNote4').val()){
    scopeNum =  Number($('#borderNote4').val())+1;
    for(j=scopeNum;j<37;j++){
      var elem = $(document).find('[notenum="'+j+'"]');
      $(document).find('[notenum="'+j+'"]').hide();
    }
  }
  
  
}

setKeyClick();

var e;
function keyClick(e){
  e=e.getElementsByClassName('noteCircle')
  if(e[0].style.display==''){
    e[0].style.display='none';
  }else{
    e[0].style.display='';
  }
}

function setKeyClick(){
  var elem = new Array;
  elem = document.getElementsByClassName("notes");

  for(i=0;i<elem.length;i++){
    elem[i].setAttribute('onclick', 'keyClick(this)');
  };
}
function fontSizeChange(val){
  var elem = new Array;
  elem = document.getElementsByClassName("white-key");
  for(i=0;i<elem.length;i++){
    elem[i].style.width= (1.4*0.1*Number(val.value)) +'vw';
    elem[i].style.height= (8*0.1*Number(val.value)) +'vw';
  };
  elem = document.getElementsByClassName("black-key");
  for(i=0;i<elem.length;i++){
    elem[i].style.width= (1.0*0.1*Number(val.value)) +'vw';
    elem[i].style.height= (5*0.1*Number(val.value)) +'vw';
    elem[i].style.marginleft= (1.0*0.1*Number(val.value))/2;
  };
  elem = document.getElementsByClassName("noteCircle");
  // for(i=0;i<elem.length;i++){
    // varnumber01= Number(elem[i].style.fontSize.substr(0,elem[i].style.fontSize.length -2))
    // elem[i].style.fontsize= (num*0.1*Number(val.value)) +'px';
    var fontNum = Number(val.value) * 18
    $('.noteCircle').css('font-size', fontNum + '%');
  // };
}
function fontSizeChange2(val){
  var fontNum = Number(val.value) + 3
  $('.ChordOrScaleName').css('font-size', fontNum + 'px');

}
function fontSizeChange3(val){
  var fontNum = Number(val.value) + 3
  $('.hiraganaDiv').css('font-size', fontNum + 'px');

}

function keyChange(root){
  let text = document.getElementById("progressionNote").value
  let idx = root.selectedIndex;
  let rootNum = root.options[idx].text;
  text = text.replace(/\[C#/g, '[1').replace(/\[Db/g, '[1').replace(/\[C/g, '[0').replace(/\[D/g, '[2').replace(/\[Eb/g, '[3').replace(/\[E/g, '[4').replace(/\[F#/g, '[6').replace(/\[F/g, '[5').replace(/\[Gb/g, '[6').replace(/\[G#/g, '[8').replace(/\[G/g, '[7').replace(/\[Ab/g, '[8').replace(/\[A#/g, '[x').replace(/\[A/g, '[9').replace(/\[Bb/g, '[x').replace(/\[B/g, '[y');
  text = text.replace(/\/C#]/g, '/1]').replace(/\/Db]/g, '/1]').replace(/\/C]/g, '/0]').replace(/\/D]/g, '/2]').replace(/\/Eb]/g, '/3]').replace(/\/E]/g, '/4]').replace(/\/F#]/g, '/6]').replace(/\/F]/g, '/5]').replace(/\/Gb]/g, '/6]').replace(/\/G#]/g, '/8]').replace(/\/G]/g, '/7]').replace(/\/Ab]/g, '/8]').replace(/\/A#]/g, '/x]').replace(/\/A]/g, '/9]').replace(/\/Bb]/g, '/x]').replace(/\/B]/g, '/y]');
  let newRoot = new Array()
  newRoot = ['C','C#','D','Eb','E','F','F#','G','Ab','A','Bb','B','C','C#','D','Eb','E','F','F#','G','Ab','A','Bb','B','C','C#','D','Eb','E','F','F#']
  let roots = new Array()
  roots = ['C#','C#','D','Eb','E','F','F#','G','Ab','A','Bb','B','C']
  var before = new Array()
  var after = new Array()
  for (let i = 0; i < 10; i++) {
    before[i] = "\\[" + i;
  }
  before[10] = "\\[x"
  before[11] = "\\[y"

  switch (rootNum) { 
    case '+1': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 1)
        after[i] = "\[" + newRoot[sum];
      }
      break; 
    case '+2': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 2)
        after[i] = "\[" + newRoot[sum];
      }
      break; 
    case '+3': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 3)
        after[i] = "\[" + newRoot[sum];
      } 
      break; 
    case '+4': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 4)
        after[i] = "\[" + newRoot[sum];
      } 
      break; 
    case '+5': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 5)
        after[i] = "\[" + newRoot[sum];
      } 
      break;
    case '+6': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 6)
        after[i] = "\[" + newRoot[sum];
      } 
      break;
    case '-1': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 11)
        after[i] = "\[" + newRoot[sum];
      }
      break; 
    case '-2': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 10)
        after[i] = "\[" + newRoot[sum];
      }
      break; 
    case '-3': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 9)
        after[i] = "\[" + newRoot[sum];
      } 
      break; 
    case '-4': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 8)
        after[i] = "\[" + newRoot[sum];
      } 
      break; 
    case '-5': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 7)
        after[i] = "\[" + newRoot[sum];
      } 
      break; 

    default: 
      ; 
      break; 
  }

  
  

  text = text.replace(new RegExp(before[0],'g'), after[0]).replace(new RegExp(before[1],'g'), after[1]).replace(new RegExp(before[2],'g'), after[2]).replace(new RegExp(before[3],'g'), after[3]).replace(new RegExp(before[4],'g'), after[4]).replace(new RegExp(before[5],'g'), after[5]).replace(new RegExp(before[6],'g'), after[6]).replace(new RegExp(before[7],'g'), after[7]).replace(new RegExp(before[8],'g'), after[8]).replace(new RegExp(before[9],'g'), after[9]).replace(new RegExp(before[10],'g'), after[10]).replace(new RegExp(before[11],'g'), after[11])
  console.log(text);

  

  for (let i = 0; i < 10; i++) {
    before[i] = "\/" + i + "]";
  }
  before[10] = "\/x]"
  before[11] = "\/y]"

  switch (rootNum) { 
    case '+1': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 1)
        after[i] = "\/" + newRoot[sum] + "]";
      }
      break; 
    case '+2': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 2)
        after[i] = "\/" + newRoot[sum] + "]";
      }
      break; 
    case '+3': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 3)
        after[i] = "\/" + newRoot[sum] + "]";
      } 
      break; 
    case '+4': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 4)
        after[i] = "\/" + newRoot[sum] + "]";
      } 
      break; 
    case '+5': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 5)
        after[i] = "\/" + newRoot[sum] + "]";
      } 
      break; 
    case '+6': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 6)
        after[i] = "\/" + newRoot[sum] + "]";
      } 
      break;
    case '-1': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 11)
        after[i] = "\/" + newRoot[sum] + "]";
      }
      break; 
    case '-2': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 10)
        after[i] = "\/" + newRoot[sum] + "]";
      }
      break; 
    case '-3': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 9)
        after[i] = "\/" + newRoot[sum] + "]";
      } 
      break; 
    case '-4': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 8)
        after[i] = "\/" + newRoot[sum] + "]";
      } 
      break; 
    case '-5': 
      for (let i = 0; i < 12; i++) {
        let sum = (i + 7)
        after[i] = "\/" + newRoot[sum] + "]";
      } 
      break; 
    default: 
      ; 
      break; 
  }

  
  

  text = text.replace(new RegExp(before[0],'g'), after[0]).replace(new RegExp(before[1],'g'), after[1]).replace(new RegExp(before[2],'g'), after[2]).replace(new RegExp(before[3],'g'), after[3]).replace(new RegExp(before[4],'g'), after[4]).replace(new RegExp(before[5],'g'), after[5]).replace(new RegExp(before[6],'g'), after[6]).replace(new RegExp(before[7],'g'), after[7]).replace(new RegExp(before[8],'g'), after[8]).replace(new RegExp(before[9],'g'), after[9]).replace(new RegExp(before[10],'g'), after[10]).replace(new RegExp(before[11],'g'), after[11])
  console.log(text);
  document.getElementById("progressionNote").value = text;


}
var hiraganaFrag = false;
function addHiragana(){
  
  var chord2Root;
  var chord2Type;
  var hiraganaNumber = 0;
  if (hiraganaFrag){
    $('.hiraganaDiv').remove();
    hiraganaFrag = false;
  }else{    
    var ChordOrScaleNames = document.getElementsByClassName("ChordOrScaleName");
    hiraganaFrag = true;
    for(i=0;i<ChordOrScaleNames.length;i++){
      var chord2 = ChordOrScaleNames[i].innerText.match(/\[(.+)\]/)[1];//[]縺ｮ荳ｭ霄ｫ繧貞叙蠕・
      if (chord2.length===1){
        chord2Root = chord2
      } else if (chord2.indexOf('/')>-1){     
        let index = chord2.indexOf('/');
        chord2Root = chord2.substring(index+1);
      } else if ((chord2.length===2)&&((chord2.substr(1,1)==='#')||(chord2.substr(1,1)==='b')||(chord2.substr(1,1)==='笙ｭ')||(chord2.substr(1,1)==='・・))){
        chord2Root = chord2
      } else if ((chord2.substr(1,1)==='#')||(chord2.substr(1,1)==='b')||(chord2.substr(1,1)==='笙ｭ')||(chord2.substr(1,1)==='・・)){
        chord2Root = chord2.substr(0,2);
        chord2Type = chord2.substr(2);        
      } else {
        chord2Root = chord2.substr(0,1);
        chord2Type = chord2.substr(1);
      }
      switch (chord2Root) {
        case "C":
          chord2Root = "縺ｩ";      
          break;
        case "C#":
          chord2Root = "縺ｩ・・;      
          break;
        case "Db":
          chord2Root = "縺ｩ・・;      
          break;
        case "D":
          chord2Root = "繧・;      
          break;
        case "D#":
          chord2Root = "繧鯉ｼ・;      
          break;
        case "E笙ｭ":
          chord2Root = "縺ｿ笙ｭ";      
          break;
        case "Eb":
          chord2Root = "縺ｿ笙ｭ";      
          break;
        case "E":
          chord2Root = "縺ｿ";      
          break;
        case "F":
          chord2Root = "縺ｵ縺・;      
          break;
        case "F#":
          chord2Root = "縺ｵ縺・ｼ・;      
          break;
        case "Gb":
          chord2Root = "縺ｵ縺・ｼ・;      
          break;
        case "G":
          chord2Root = "縺・;      
          break;
        case "G#":
          chord2Root = "縺晢ｼ・;      
          break;
        case "A笙ｭ":
          chord2Root = "繧俄勵";      
          break;
        case "Ab":
          chord2Root = "繧俄勵";      
          break;
        case "A":
          chord2Root = "繧・;      
          break;
        case "B笙ｭ":
          chord2Root = "縺冷勵";      
          break;
        case "Bb":
          chord2Root = "縺冷勵";      
          break;
        case "B":
          chord2Root = "縺・;      
          break;
      }

      // div隕∫ｴ繧堤函謌・
      var hiraganaDiv = document.createElement('p');
      // class繧定ｿｽ蜉
      hiraganaDiv.className = 'hiraganaDiv';
      hiraganaNumber = hiraganaNumber +1
      hiraganaDiv.id = 'hiraganaDiv'+ hiraganaNumber;
      
      // hiraganaDiv.style.margin='0px 1px 5px 0px';
      hiraganaDiv.style.fontSize='20px';
      // hiraganaDiv.style.float='left';
      hiraganaDiv.style.padding='1px';
      hiraganaDiv.style.margin='0px';
      // parentDiv.appendChild(childDiv);
      // 蜑阪↓霑ｽ蜉
      ChordOrScaleNames[i].before(hiraganaDiv);
      // ChordOrScaleNames[i].insertAdjacentHTML('beforebegin', hiraganaDiv);
      hiraganaDiv.innerText = "[" + chord2Root + "]"



      // ChordOrScaleNames[i].innerText = "[" + chord2Root + "]" + ChordOrScaleNames[i].innerText;
    };
  }
}
</script>


</body>
</html>	