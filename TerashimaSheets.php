<!DOCTYPE html>
<html lang="ja">
<script src="https://bossanova.uk/jspreadsheet/v3/jexcel.js"></script>
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
<style>
  /* 陦ｨ蜈ｨ菴・*/
  #spreadsheet{
      font-size:12px;
  }
</style>
  <form name ="mainform" action="" method="post">
    <input 
      type="text"  
      class='textlines' 
      class="textlines" 
      id="DB_name" 
      name = "DB_name"
      value = "<?php if (isset($_POST["DB_name"])) {echo $_POST["DB_name"];}?>"
      placeholder = "id"
      style='width: 40%; height :5vh; font-size: 24px;'/>
    <input type="submit" value="騾∽ｿ｡" class="textlines" style='background-color:#99FFFF;font-size: 22px;width: 20%; height: 70px'>
    <a id="previous" href="sample020.php">
      <font size="6" color="#FF0000" style=''>蟄ｦ鄙堤判髱｢</font>
    </a>
    <br>
    <pre style='height:1vh;'>
    蝠城｡梧､懃ｴ｢
    </pre>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!empty($_POST["DB_name"])) {
    $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    if( $mysqli->connect_errno){
        echo 'Access Failed';//謗･邯壼､ｱ謨・
        exit;
    }

    $result0 = $mysqli->query("set names utf8");
    $db_name = $_POST["DB_name"];//$_GET["DB_name"];///////

    $db_column = "category1";


    //繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・
    $mysqli->set_charset("utf8");
    $row = "";


    //繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ1繧貞叙蠕・
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

    //繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ2繧貞叙蠕・
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
    // $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >荳ｭ繧ｫ繝・ざ繝ｪ繝ｼ</option>\n";

    // $sampleSelectBox .="\t<option value=""></option>\n";
    for ( $i = 1; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }//
    $sampleSelectBox .= "</select>\n";
    echo "{$sampleSelectBox}";


    //繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ3繧貞叙蠕・
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

    //繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ4繧貞叙蠕・
    $str_sql = "select category4 from $db_name where question != 'settings'";
    $result = $mysqli->query($str_sql);

    if (!$result) {error_log($mysqli->error);exit;}
    unset($response);
    $response[0] ="";
    while($dat = $result->fetch_assoc()){
        $response[] = $dat['category4'];
    }

    $response = array_values(array_unique($response));

    // ini_set('xdebug.var_display_max_children', -1);//var_dump蜈ｨ縺ｦ譖ｸ縺榊・縺輔○繧・
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

    //繝・・繧ｿ繝吶・繧ｹ縺九ｉ繧ｫ繝・ざ繝ｪ繝ｼ5繧貞叙蠕・
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

    //繝・・繧ｿ繝吶・繧ｹ縺九ｉquestion繧貞叙蠕・

    

    $response = array_values(array_unique($response));
    // var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"categoryQ\" id='ctgQ' onChange='listChanged()' multiple style='width:19%;height:20vh; font-size: 25px;margin:1px'>\n";


    $sampleSelectBox .= "</select>\n";//
    // echo "{$sampleSelectBox}";



    

    mysqli_close($mysqli);
    

  } else {
    $err = "蜈･蜉帙＆繧後※縺・↑縺・・岼縺後≠繧翫∪縺吶・;
  }
}

?>
<input type="text" name="wordsearch" id="wordsearch"  placeholder = "讀懃ｴ｢"
style='width: 30%; font-size: 38px;box-sizing:border-box;vertical-align:top; '>
<br>
<input type="button" id="showButton" value="陦ｨ遉ｺ" onclick='sendRequest()' style='font-size: 20px;width: 20%; height: 50px;margin:5px'>
<br>
<div id="spreadsheet" ></div>
<br>
<input type="button" id="showButton" value="霑ｽ蜉" onclick='insertrow0()' style='font-size: 20px;width: 20%; height: 50px;margin:5px'>
<br>
 
<script type="text/javascript">
// Set the JSS spreadsheet license
// jspreadsheet.setLicense('MzczY2RmOTAzZTUzYTgxOWFhYTE3NDg0ZGNkOTRhNDQ5M2I4ZGYwNjQwODhmYzM5YjUwMWZiMWEwZDQ1ZmUwYTkzMDc0NGY3YjkzNTM3ZGUwMDUzNGE0MWI1OTI5ZDMwMWJkODk5YWQwZTUxZTEwNzg2MmQ5MzM0NTA3MDg3MWUsZXlKdVlXMWxJam9pU25Od2NtVmhaSE5vWldWMElpd2laR0YwWlNJNk1UWTJOVEk1TWpJME5pd2laRzl0WVdsdUlqcGJJbXB6Y0hKbFlXUnphR1ZsZEM1amIyMGlMQ0pqYjJSbGMyRnVaR0p2ZUM1cGJ5SXNJbXB6YUdWc2JDNXVaWFFpTENKamMySXVZWEJ3SWl3aWJHOWpZV3hvYjNOMElsMHNJbkJzWVc0aU9pSXpJaXdpYzJOdmNHVWlPbHNpZGpjaUxDSjJPQ0lzSW5ZNUlpd2lZMmhoY25Seklpd2labTl5YlhNaUxDSm1iM0p0ZFd4aElpd2ljR0Z5YzJWeUlpd2ljbVZ1WkdWeUlpd2lZMjl0YldWdWRITWlMQ0pwYlhCdmNuUWlMQ0ppWVhJaUxDSjJZV3hwWkdGMGFXOXVjeUlzSW5ObFlYSmphQ0pkTENKa1pXMXZJanAwY25WbGZRPT0=');
if (!(location.search.substring(1)==="")){
  document.getElementById("DB_name").value = location.search.substring(1);///
  document.getElementById("previous").href += "?"+ location.search.substring(1);
}


var table1;

function sendRequest(){
  var category1Value = new Array();
  var elemCategory1 = document.getElementById('ctg1');
  var optsCategory1 = elemCategory1.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
  for (var i = 0; i < optsCategory1.length; i++) {
    if (optsCategory1[i].selected) {
      category1Value[i] = optsCategory1[i].value;
    }
  }
  category1Value = category1Value.filter(Boolean);
  category1Value = category1Value.join('@');

  var category2Value = new Array();
  var elemCategory2 = document.getElementById('ctg2');
  var optsCategory2 = elemCategory2.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
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
  var optsCategory3 = elemCategory3.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
  for (var i = 0; i < optsCategory3.length; i++) {
    if (optsCategory3[i].selected) {
      category3Value[i] = optsCategory3[i].value;
    }
  }
  category3Value = category3Value.filter(Boolean);
  category3Value = category3Value.join('@');


  var category4Value = new Array();
  var elemCategory4 = document.getElementById('ctg4');
  var optsCategory4 = elemCategory4.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
  for (var i = 0; i < optsCategory4.length; i++) {
    if (optsCategory4[i].selected) {
      category4Value[i] = optsCategory4[i].value;
    }
  }
  category4Value = category4Value.filter(Boolean);
  category4Value = category4Value.join('@');

  var category5Value = new Array();
  var elemCategory5 = document.getElementById('ctg5');
  var optsCategory5 = elemCategory5.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
  for (var i = 0; i < optsCategory5.length; i++) {
    if (optsCategory5[i].selected) {
      category5Value[i] = optsCategory5[i].value;
    }
  }
  category5Value = category5Value.filter(Boolean);
  category5Value = category5Value.join('@');

  var categoryQValue = new Array();



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
    xmlhttp.open("POST", "../getSheetData.php", false);//荵ｱ謨ｰ繧貞叙蠕・
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText.split('^^^');
    // console.log('0817 res is '+res);

    var givenData  = [];
    for (let i = 1; i < res.length; i++) {
      //驟榊・縺ｮ隕∫ｴ謨ｰ繧呈欠螳壹☆繧・
縲縲縲givenData[i-1] = [];
      res2 = res[i].split(',');
      for (let j = 0; j < res2.length; j++) {
        givenData[i-1][j] =  res2[j];
      }
    }
    // document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
  } 

  // let data = '<?php echo addslashes($userData); ?>'//.replace(/[\u0000-\u0019]+/g, "");

  // data = JSON.parse(data);

  console.log(givenData);

  var Data2 = res[1];
  Data2 = JSON.parse(Data2);




  $('#spreadsheet').empty();
  table1 = jexcel(document.getElementById('spreadsheet'), {

      data:Data2,
      columns:[
          { title:'answer1', width:300, wordWrap:true},
          { title:'question', width:150, wordWrap:true},        
          { title:'category1', width:100},
          { title:'category2', width:100},
          { title:'category3', width:100},
          { title:'category4', width:100},
          { title:'category5', width:100},
          { title:'questionnumber', width:50},          
          { title:'tag', width:100},
          { title:'imagefolder', width:100},
          { title:'qsentence', width:500},
      ],

      // tableOverflow:true,
      // lazyLoading:true,
      loadingSpin:true,
      allowManualInsertColumn:true,
      allowInsertRow:true,
      allowManualInsertRow:true,
      allowInsertColumn:true,
      allowManualInsertColumn:true,
      allowDeleteRow:true,
      allowDeleteColumn:true,
      allowRenameColumn:true,
      allowComments:true,
      defaultColAlign:'left',

      editable:true,
      rowResize: true,
      columnDrag: true,
      onchange: changed,
      oninsertrow:insertrow,
      onbeforedeleterow:deleterow,



      
  });
  console.log(table1);
}
  function changed(instance, cell, x, y, value) {
    var columnName = table1.getHeader(x);
    var questionNumber = table1.getValueFromCoords([7], [ Number(y)]);
    var db_name = '<?php echo ($db_name); ?>'
    var moji="update" + "^^^^^" +  db_name + "^^^^^" + columnName + "^^^^^" + myEscape(value) + "^^^^^" +  Number(questionNumber)  ;

    moji = encodeURIComponent(moji);


    // console.log('711 moji is '+moji);

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../fromSheetUpdateDatabase.php", false);//荳肴ｭ｣隗｣繝懊ち繝ｳ繧呈款縺・
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
    }

  }

	const myEscape = function (str) {
	  return str
	          .replace(/\'/g, "\\'")
	          .replace(/\"/g, '\\"')
	          .replace(/\//g, '\\/');
	};

  function insertrow0(){
    var insert = table1.insertRow();
  }

  function insertrow(instance, rowNumber, numOfRows, insertBefore){
    var rowNumber = rowNumber +1

    var db_name = '<?php echo ($db_name); ?>'
    var moji="insertrow" + "^^^^^" +  db_name ;

    moji = encodeURIComponent(moji);


    // console.log('711 moji is '+moji);

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../fromSheetUpdateDatabase.php", false);//荳肴ｭ｣隗｣繝懊ち繝ｳ繧呈款縺・
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText.split('^^^^^');
    }
    // sendRequest();
    if (table1.getValueFromCoords(7,rowNumber,res[1])===""){
      table1.setValueFromCoords(7,rowNumber,res[1]);
    }else if (table1.getValueFromCoords(7,rowNumber-1,res[1])===""){
      table1.setValueFromCoords(7,rowNumber-1,res[1]);
    }
    


  }
  function deleterow(instance, rowNumber){
    var questionNumber = table1.getValueFromCoords([7], [rowNumber]);
    var db_name = '<?php echo ($db_name); ?>'
    var moji="deleterow" + "^^^^^" +  db_name + "^^^^^" + " " + "^^^^^" + " " + "^^^^^" + questionNumber;

    moji = encodeURIComponent(moji);


    // console.log('711 moji is '+moji);

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../fromSheetUpdateDatabase.php", false);//荳肴ｭ｣隗｣繝懊ち繝ｳ繧呈款縺・
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
    }
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
  var opts = elem.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
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
  var opts = elem.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
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
  var opts = elem.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
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
  var opts = elem.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
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
  var opts = elem.options; // select隕∫ｴ縺ｮoption繝励Ο繝代ユ繧｣
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
      // questionListChange()
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
      // questionListChange()
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
      // questionListChange()
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
      // questionListChange()
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



//20221221縲
//question, answer1, category1 縺ｪ縺ｩ縲繧ｫ繝ｩ繝縺斐→縺ｫmysql縺九ｉ諠・ｱ繧貞叙蠕励☆繧九ｈ縺・↓縺励◆縲・
//諠・ｱ蜿門ｾ励→謾ｹ螟峨′縺ｧ縺阪ｋ繧医≧縺ｫ縺ｪ縺｣縺溘′縲∬ｿｽ蜉縺ｯ縺ｾ縺縺ｧ縺阪↑縺・・


</script>
</html>
