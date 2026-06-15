<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>UpdateSql</title>
<style type="text/css">
    body {background-color: #F0FFF0; }
    div.top{
      width:97%;
      color:"#000000";
    }
    select{
      vertical-align:middle !important;
    }
    .textlines {
      font-family: "SimHei";
	    border: 2px solid #0a0;  /* 枠線 */
	    border-radius: 0.67em;   /* 角丸 */
	    padding: 0.5em;          /* 内側の余白量 */
	    background-color: snow;  /* 背景色 */
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.25);
	    /*width: 20em;             /* 横幅 */*/
	    /*height: 120px;           /* 高さ */*/
	    /*font-size: 1em;          /* 文字サイズ */*/
	    line-height: 1.2;        /* 行の高さ */
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
     table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
</style>

</head>
<body>
  <form name ="mainform" action="" method="post">
    <input type="text"  class='textlines' class="textlines" id="DB_name" name = "DB_name"
      value = "<?php if (isset($_POST["DB_name"])) {echo $_POST["DB_name"];}?>" placeholder = "id"
      style='width: 40%; height :5vh; font-size: 24px;'/>
    <input type="submit" value="送信" class="textlines" style='background-color:#99FFFF;font-size: 22px;width: 20%; height: 70px'>
    <a id="previous" href="sample020.php">
      <font size="6" color="#FF0000" style=''>学習画面</font>
    </a>
    <br>
    <pre style='height:1vh;'>
    問題検索
    </pre>
<?php
// error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // echo "Test02";
  if (!empty($_POST["DB_name"])) {

       // echo $_POST["DB_name"].",\n"."\n";//
    $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    // $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
    /////
    //    echo "";
    if( $mysqli->connect_errno){
        echo 'Access Failed';//接続失敗
        exit;
    }

    $result0 = $mysqli->query("set names utf8");
    $db_name = $_POST["DB_name"];//$_GET["DB_name"];///////////////////////////////////

    $db_column = "category1";


    //デフォルト文字セットを設定
    $mysqli->set_charset("utf8");
    $row = "";
    // echo "1".",\n"."\n";


    //データベース取得
    $str_sql = "select $db_column from $db_name where question != 'settings'";
    //     echo $str_sql.",\n"."\n";//
    $result = $mysqli->query($str_sql);
    if (is_array($result)) {
    $row_cnt =count($result);
    }

//     echo $row_cnt.",\n"."\n";//////////////////////////
    $response[0] ="";
    if (!$result) {error_log($mysqli->error);exit;}
    // $response[] = array();
    while($dat = $result->fetch_assoc()){
        $response[] = $dat['category1'];
    }

    $response = array_values(array_unique($response));
    // var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"category1\" id='ctg1' class='textlines' onChange='listChange(this);listChanged();OLDlistChange()'
    style='width:31%;height:10vh; font-size: 22px;margin:1px'>\n";
    // $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >カテゴリー1</option>\n";

    for ( $i = 0; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";
    echo "{$sampleSelectBox}";

    //データベース取得
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

    $sampleSelectBox = "<select name=\"category2\" id='ctg2' class='textlines' onChange='listChange(this);listChanged();OLDlistChange()'
    style='width:31%;height:10vh; font-size: 22px;margin:1px'>\n";
    // $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >カテゴリー2</option>\n";

    // $sampleSelectBox .="\t<option value=""></option>\n";
    for ( $i = 0; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }//
    $sampleSelectBox .= "</select>\n";
    echo "{$sampleSelectBox}";


    //データベース取得
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
    natsort($response);
    $sampleSelectBox = "<select name=\"category3\" id='ctg3' class='textlines' onChange='listChange(this);listChanged();OLDlistChange()'
     style='width:31%;height:10vh; font-size: 22px;margin:1px'>\n";
    // $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >カテゴリー3</option>\n";

    for ( $i = 0; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";//
    echo "{$sampleSelectBox}";

    //データベース取得
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

    $sampleSelectBox = "<select name=\"category4\" id='ctg4' class='textlines' onChange='listChange(this);listChanged();OLDlistChange()'
    style='width:31%;height:10vh; font-size: 22px;margin:1px'>\n";
    // $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >カテゴリー2</option>\n";

    // $sampleSelectBox .="\t<option value=""></option>\n";
    for ( $i = 0; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }//
    $sampleSelectBox .= "</select>\n";
    echo "{$sampleSelectBox}";

    //データベース取得
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

    $sampleSelectBox = "<select name=\"category5\" id='ctg5' class='textlines' onChange='listChange(this);listChanged();OLDlistChange()'
    style='width:31%;height:10vh; font-size: 22px;margin:1px'>\n";
    // $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >カテゴリー2</option>\n";

    // $sampleSelectBox .="\t<option value=""></option>\n";
    for ( $i = 0; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }//
    $sampleSelectBox .= "</select>\n";
    echo "{$sampleSelectBox}";


    // //データベース取得 イメージフォルダ
    // $str_sql = "select imagefolder from $db_name where question != 'settings'";
    // $result = $mysqli->query($str_sql);

    // if (!$result) {error_log($mysqli->error);exit;}
    // unset($response);
    // $response[0] ="";
    // while($dat = $result->fetch_assoc()){
    //     $response[] = $dat['imagefolder'];
    // }

    // $response = array_values(array_unique($response));
    // // var_dump($response);
    // $row_cnt = count($response);

    // $sampleSelectBox = "<select name=\"imagefolder\" id='imgfolder' class='textlines' onChange='listChange(this);listChanged();OLDlistChange()'
    // style='width:31%;height:10vh; font-size: 22px;margin:1px'>\n";
    // // $sampleSelectBox .= "\t<option value='' disabled selected style='display:none;' >カテゴリー2</option>\n";

    // // $sampleSelectBox .="\t<option value=""></option>\n";
    // for ( $i = 0; $i < $row_cnt; $i++ ) {
    //     $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    // }//
    // $sampleSelectBox .= "</select>\n";
    // echo "{$sampleSelectBox}";

    mysqli_close($mysqli);


  } else {
    $err = "入力されていない項目があります。";
  }
}
global $testnumber;
$testnumber = 0;
?>


<br>
<select name='questionList' id='questionList' class='textlines' onChange = 'qestionListChange()' style='width: 63%;height:70px; font-size: 27px;'>
</select>
<input type="text"  class='textlines' name="wordSearch" id="wordSearch" class='textlines' onChange='OLDlistChange()' value = "" placeholder = "文字で検索"
  style='width: 31%;height:70px ;font-size: 29px;box-sizing:border-box;vertical-align:middle; '
>


<br>
<br>
<pre>
  入力用フォーム  ※新しい問題の入力をするには問題番号を空にしてください。  ※この下のカテゴリーに必ず入力すること。
</pre>
<input type="text"  class='textlines' name="questionnumberTextArea" id="questionnumberTextArea"  value = "" placeholder = "番号"
  style='width: 7%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text" list="testList1" class='textlines' name="modifyCategory1" id="modifyCategory1"  value = "" placeholder = "カテゴリー1"
  style='width: 29.5%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<datalist id="testList1">
</datalist>
<input type="text" list="testList2"  class='textlines' name="modifyCategory2" id="modifyCategory2"  value = "" placeholder = "カテゴリー2"
  style='width: 29.5%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<datalist id="testList2">
</datalist>
<input type="text" list="testList3" class='textlines' name="modifyCategory3" id="modifyCategory3"  value = "" placeholder = "カテゴリー3"
  style='width: 29.5%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<datalist id="testList3">
</datalist>
<input type="text" list="testList4" class='textlines' name="modifyCategory4" id="modifyCategory4"  value = "" placeholder = "カテゴリー4"
  style='width: 29.5%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<datalist id="testList4">
</datalist>
<input type="text" list="testList5" class='textlines' name="modifyCategory5" id="modifyCategory5"  value = "" placeholder = "カテゴリー5"
  style='width: 29.5%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<datalist id="testList5">
</datalist>

<input type="text" list="testList6" class='textlines' name="imgfolder" id="imgfolder"  value = "" placeholder = "画像フォルダ"
  style='width: 29.5%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<datalist id="testList6">
</datalist>


<script type="text/javascript">
  // select要素を取得
  var element = document.getElementById( "ctg1" ) ;
  // 全てのoption要素を取得
  var elements = element.options ;
  // console.log('elements is ' + elements.length);
  for (let i = 0; i < elements.length; i++) {
    let op = document.createElement("option");
    op.value = elements[i].value;  //value値
    document.getElementById("testList1").appendChild(op);
  }

  element = document.getElementById( "ctg2" ) ;
  // 全てのoption要素を取得
  elements = element.options ;
  // console.log('elements is ' + elements.length);
  for (let i = 0; i < elements.length; i++) {
    let op = document.createElement("option");
    op.value = elements[i].value;  //value値
    document.getElementById("testList2").appendChild(op);
  }

  element = document.getElementById( "ctg3" ) ;
  // 全てのoption要素を取得
  elements = element.options ;
  // console.log('elements is ' + elements.length);
  for (let i = 0; i < elements.length; i++) {
    let op = document.createElement("option");
    op.value = elements[i].value;  //value値
    document.getElementById("testList3").appendChild(op);
  }

  element = document.getElementById( "ctg4" ) ;
  // 全てのoption要素を取得
  elements = element.options ;
  // console.log('elements is ' + elements.length);
  for (let i = 0; i < elements.length; i++) {
    let op = document.createElement("option");
    op.value = elements[i].value;  //value値
    document.getElementById("testList4").appendChild(op);
  }

  element = document.getElementById( "ctg5" ) ;
  // 全てのoption要素を取得
  elements = element.options ;
  // console.log('elements is ' + elements.length);
  for (let i = 0; i < elements.length; i++) {
    let op = document.createElement("option");
    op.value = elements[i].value;  //value値
    document.getElementById("testList5").appendChild(op);
  }

  // element = document.getElementById( "imgfolder" ) ;
  // // 全てのoption要素を取得
  // elements = element.options ;
  // // console.log('elements is ' + elements.length);
  // for (let i = 0; i < elements.length; i++) {
  //   let op = document.createElement("option");
  //   op.value = elements[i].value;  //value値
  //   document.getElementById("testList6").appendChild(op);
  // }

</script>


<br>
<input type="text"   class='textlines' name="qsentenceTextArea" id="qsentenceTextArea"  value = "" placeholder = "設問"
  style='width: 96.5%; font-size: 15px;box-sizing:border-box;vertical-align:middle;margin:0px 0px 10px 0px; '
>
<input type="text"   class='textlines' name="tagTextArea" id="tagTextArea"  value = "" placeholder = "タグ"
  style='width: 96.5%; font-size: 15px;box-sizing:border-box;vertical-align:middle;margin:0px 0px 10px 0px; '
>
<select name='fontresize' class='textlines' id='fontresize' onChange="textareafontresize()" tabindex="-1"
    style='width: 10%; font-size: 10px;height: 5vh;line-height: 3vh;vertical-align:top;margin:0px 0px 10px 0px;'>
    <option value='' >文字サイズ</option>
    <option value='5px'>5</option>
    <option value='10px'>10</option>
    <option value='15px'>15</option>
    <option value='20px'>20</option>
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
<select class='textlines' name="imageSize1" id = "imageSize1" value="1" min="-10" max="10" step="0.1" onChange="imageSizeChange1()"
style="width:4%;font-size: 10px;height: 5vh;margin:0px 0px 10px 0px;">
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
<select class='textlines'  name="imageSize2" id = "imageSize2" value="1" min="-10" max="10" step="0.1" onChange="imageSizeChange2()"
style="width:4%;font-size: 10px;height: 5vh;margin:0px 0px 10px 0px;">
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
<input type="button" class='textlines' name="nextQ" id="nextQ" onClick="nextQu()" value="次"
style=" width:10%;height: 40px; font-size: 22px;margin:10px 0px 10px 0px;background-color:#99FFFF">
<input type="button" class='textlines' name="preQ" id="preQ" onClick="preQu()" value="前"
style=" width:10%;height: 40px; font-size: 22px;margin:10px 0px 10px 0px;background-color:#99FFFF">

<label id="file1_wrap" for="file1" style="display:'inline-block';width:320px;height:240px;background-color:#cce0f0;">
  <!-- ファイルをドラッグ＆ドロップしてください。
  （複数ファイルも可） -->
  <input type="file" id="file1" multiple />
</label>
<label id="file2_wrap" for="file2" style="display:'inline-block';width:320px;height:240px;background-color:#cce0f0;">
  <!-- ファイルをドラッグ＆ドロップしてください。
  （複数ファイルも可） -->
  <input type="file" id="file2" multiple />
</label><br>
<input type="button" class='textlines' name="update" id="update" onClick="updateQuestion()" value="更新"
style=" width:40%;height: 70px; font-size: 22px;margin:10px 0px 10px 0px;background-color:#99FFFF">
<input type="button" class='textlines' name="update" id="update" onClick="nextNewQuestion()" value="新規"
style=" width:40%;height: 70px; font-size: 22px;margin:10px 0px 10px 0px;background-color:#99FFFF">
<br>
<progress id="prog1" value="0" max="100" hidden></progress>
<div id="res1" class="text-success"></div>
<div id="err" class="text-danger" ></div>

<div>
  <TEXTAREA id="questionTxtArea" class='textlines' name="questionTxtArea" value = "" placeholder = "question"
  style=' width: 45%; height :20vh; font-size: 25px;float: left;'></TEXTAREA>
  <div id ="div1" class="img-container--precedo" style="width:45%;height: 23vh;">
      <img id="mypic1" src="" style="width:45%;height: 28vh;">
  </div>
</div>
<br>
<div>
  <TEXTAREA id="answer1TxtArea" class='textlines' name="answer1TxtArea" value = "" placeholder = "answer1"
  style=' width: 45%; height :20vh; font-size: 25px;float: left;'></TEXTAREA>

  <div id ="div2" class="img-container--precedo" style="width:45%;height: 23vh;">
      <img id="mypic2" src=""　style="width:45%;height: 50vh;">
  </div>
</div>
<br>
<TEXTAREA id="hintTxtArea" class="textlines" name="hintTxtArea" value = "" placeholder = "hint"
style=' width: 95%; height :5vh; font-size: 18px;'></TEXTAREA>


<br>
<input type="text"  class='textlines' name="answer2TxtArea" id="answer2TxtArea"  value = "" placeholder = "answer2"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer3TxtArea" id="answer3TxtArea"  value = "" placeholder = "answer3"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer4TxtArea" id="answer4TxtArea"  value = "" placeholder = "answer4"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer5TxtArea" id="answer5TxtArea"  value = "" placeholder = "answer5"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer6TxtArea" id="answer6TxtArea"  value = "" placeholder = "answer6"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer7TxtArea" id="answer7TxtArea"  value = "" placeholder = "answer7"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer8TxtArea" id="answer8TxtArea"  value = "" placeholder = "answer8"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer9TxtArea" id="answer9TxtArea"  value = "" placeholder = "answer9"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer10TxtArea" id="answer10TxtArea"  value = "" placeholder = "answer10"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer11TxtArea" id="answer11TxtArea"  value = "" placeholder = "answer11"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer12TxtArea" id="answer12TxtArea"  value = "" placeholder = "answer12"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer13TxtArea" id="answer13TxtArea"  value = "" placeholder = "answer13"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer14TxtArea" id="answer14TxtArea"  value = "" placeholder = "answer14"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="answer15TxtArea" id="answer15TxtArea"  value = "" placeholder = "answer15"
  style='width: 18%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<br>


<input type="text"  class='textlines' name="q_levelTxtArea" id="q_levelTxtArea"  value = "" placeholder = "Level"
  style='width: 10%; font-size: 10px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="pooratTxtArea" id="pooratTxtArea"  value = "" placeholder = "達成度"
  style='width: 10%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="q_recordTxtArea" id="q_recordTxtArea"  value = "" placeholder = "成否記録"
  style='width: 12%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="correctTxtArea" id="correctTxtArea"  value = "" placeholder = "正解数"
  style='width: 10%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="incorrectTxtArea" id="incorrectTxtArea"  value = "" placeholder = "不正解数"
  style='width: 10%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="pcaTxtArea" id="pcaTxtArea"  value = "" placeholder = "正答率"
  style='width: 10%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="qdateTxtArea" id="qdateTxtArea"  value = "" placeholder = "日付"
  style='width: 30%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<br>
<input type="text"  class='textlines' name="pre_qdateTxtArea" id="pre_qdateTxtArea"  value = "" placeholder = "過去日付"
  style='width: 90%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>
<input type="text"  class='textlines' name="nextQdateTxtArea" id="nextQdateTxtArea"  value = "" placeholder = "次回"
  style='width: 30%; font-size: 22px;box-sizing:border-box;vertical-align:middle; '
>

<br>
<input type="button" class='textlines' name="botan08" id="button08" onClick="deleteQ();"value="問題削除"
style="width:23.8%;height:5vh;font-size: 22px;margin:100px 0px 0px 0px">
<!-- jQueryをCDNから読み込み -->
<script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>

<script type="text/javascript">
  document.getElementById("DB_name").value = location.search.substring(1);///
  document.getElementById("previous").href += "?"+ location.search.substring(1);
  // document.getElementById("div2").style.display = "none";
  // document.getElementById("div1").style.display = "none";
  var questions = new Array();
  var imageHeight1;
  var imageWidth1;
  var imageHeight2;
  var imageWidth2;
  function OLDlistChange(){
      num=0;
      flag1 = false;
      var sl = document.getElementById('questionList');
      while(sl.lastChild)
      {
          sl.removeChild(sl.lastChild);
      }
      var moji= document.mainform.DB_name.value + "^^" + document.getElementById("ctg1").value
      + "^^" + document.getElementById("ctg2").value + "^^" + document.getElementById("ctg3").value
      + "^^" + document.getElementById("wordSearch").value+ "^^" + document.getElementById("ctg4").value+ "^^" + document.getElementById("ctg5").value;
      // console.log('moji is ' + moji);
      var xmlhttp=createXmlHttpRequest();
      if(xmlhttp!=null)
      {
          xmlhttp.open("POST", "../QuestionsForUpdate.php", false);//
          xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          var data="data=" + moji;
          xmlhttp.send(data);
          var res=xmlhttp.responseText;
          questions = res.split('^^');
          // console.log('res is ' + questions);
          var qnum = questions.length;
          //連想配列をループ処理で値を取り出してセレクトボックスにセットする
          let op = document.createElement("option");
          document.getElementById("questionList").appendChild(op);
          for(var i=0;i<questions.length;i++){
            let op = document.createElement("option");
            op.value = questions[i];  //value値
            op.text = questions[i];   //テキスト値
            document.getElementById("questionList").appendChild(op);
          }

      }
  }

  function qestionListChange(){
    var moji= document.mainform.DB_name.value + "^^" + document.getElementById("questionList").value;
    var imagefolder ="";
    moji = encodeURIComponent(moji);
    // console.log('moji is ' + moji);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../getQestionForUpdate.php", false);//
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data=" + moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        questions = res.split('^^');
        // console.log('res is ' + questions);
        imagefolder = questions[20];
        document.getElementById("answer1TxtArea").value = questions[0];

        for (let i = 1; i < 14; i++) {
          var num = i + 1;
          document.getElementById("answer"+ num +"TxtArea").value = questions[i];
        }

        if (questions[0].indexOf( "jpg" ) > 0 || questions[15].indexOf( "jpeg" ) > 0 || questions[15].indexOf( "png" ) > 0  || (questions[15].indexOf( "gif" ) > -1)) {
            // document.getElementById("answer1TxtArea").style.display = "none";
            document.getElementById("div2").style.display = "block";
            var imageadress =  res.split('^');
            // console.log('imageadress is ' + imageadress);
            document.getElementById("mypic2").src='images/'+imagefolder+'/' + imageadress[0];
            // document.getElementById("mypic2").style.width = "200px"
            var el = document.getElementById("mypic2");
            var image2 = new Image();
            var width2;
            var height2;

            // document.getElementById("mypic2").style.width = "1000px";  // 横幅を400pxにリサイズ
            // document.getElementById("mypic2").style.height = height2 * (1000 / width2)+"px"; // 高さを横幅の変化割合に合わせる;
            image2.onload = function(){
                width2 = image2.width;
                height2 = image2.height;
                // if ((width2>height2)&&(width2>200)) {
                if (width2>200) {
                    document.getElementById("mypic2").style.width = "1000px";  // 横幅を400pxにリサイズ
                    document.getElementById("mypic2").style.height = height2 * (1000 / width2)+"px"; // 高さを横幅の変化割合に合わせる;
                    if (parseInt(document.getElementById("mypic2").style.height)>parseInt(document.getElementById("div2").clientHeight)) {
                      // document.getElementById("mypic2").style.height = document.getElementById("div2").clientHeight +"px";
                      // document.getElementById("mypic2").style.width = (document.getElementById("mypic2").height*width2)/height2 + "px";
                    } else {
                    }
                } else {
                  document.getElementById("mypic2").style.width = image2.width*3 + "px";
                  document.getElementById("mypic2").style.height = height2 * (image2.width * 3 / width2)+"px";
                  // document.getElementById("mypic2").style.height = document.getElementById("div2").clientHeight +"px";
                  // document.getElementById("mypic2").style.width = (document.getElementById("mypic2").height*width2)/height2 + "px";
                }
                imageWidth2 = Number(document.getElementById("mypic2").style.width.substr(0,document.getElementById("mypic2").style.width.length -2));
                imageHeight2 = Number(document.getElementById("mypic2").style.height.substr(0,document.getElementById("mypic2").style.height.length -2));
                imageSizeChange1()
                imageSizeChange2()
            //
            //
            }

            image2.src = 'images/'+imagefolder+'/' + imageadress[0];
        } else {
            // document.getElementById("div2").style.display = "none";
            document.getElementById("answer1TxtArea").style.display = "block";
        }






        document.getElementById("questionTxtArea").value = questions[15];

        if (questions[15].indexOf( "jpg" ) > 0 || questions[15].indexOf( "jpeg" ) > 0 || questions[15].indexOf( "png" ) > 0 || (questions[15].indexOf( "gif" ) > -1)) {
          // document.getElementById("questionTxtArea").style.display = "none";
          document.getElementById("div1").style.display = "block";

          question = questions[15].split('\n\n');
          if (question.length > 1) {
            document.getElementById("mypic1").src='images/'+imagefolder+'/' + question[1];
          } else {
            document.getElementById("mypic1").src='images/'+imagefolder+'/' + question[0];
          }


          var image1 = new Image();
          var width;
          var height;

          image1.onload = function(){
              width = image1.width;
              height = image1.height;
              if ((width>height)&& (width>200)){
                  document.getElementById("mypic1").style.width = "1000px";  // 横幅を400pxにリサイズ
                  document.getElementById("mypic1").style.height = height * (1000 / width)+"px"; // 高さを横幅の変化割合に合わせる;
                  // if (parseInt(document.getElementById("mypic1").style.height)>parseInt(document.getElementById("div1").clientHeight)) {
                  //   document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
                  //   document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
                  // } else {
                  // }
              } else {
                document.getElementById("mypic1").style.width = image1.width * 3 + "px";
                document.getElementById("mypic1").style.height = height * (image1.width * 3 / width)+"px";
                // document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
                // document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
              }
              imageWidth1 = Number(document.getElementById("mypic1").style.width.substr(0,document.getElementById("mypic1").style.width.length -2));
              imageHeight1 = Number(document.getElementById("mypic1").style.height.substr(0,document.getElementById("mypic1").style.height.length -2));
              imageSizeChange1()
              imageSizeChange2()
          }
          if (question.length > 1) {
            image1.src ='images/'+imagefolder+'/' + question[1];
          } else {
            image1.src ='images/'+imagefolder+'/' + question[0];
          }
          // image1.src = 'images/'+imagefolder+'/' + question;
          // document.getElementById("mypic2").src= "";

        } else {
          // document.getElementById("div1").style.display = "none";
          document.getElementById("questionTxtArea").style.display = "block";
        }

        document.getElementById("modifyCategory1").value = questions[16];
        document.getElementById("modifyCategory2").value = questions[17];
        document.getElementById("modifyCategory3").value = questions[18];
        document.getElementById("modifyCategory4").value = questions[45];
        document.getElementById("modifyCategory5").value = questions[46];
        document.getElementById("qsentenceTextArea").value = questions[19];
        document.getElementById("hintTxtArea").value = questions[24];
        document.getElementById("tagTextArea").value = questions[25];
        document.getElementById("questionnumberTextArea").value = questions[44];
        document.getElementById("q_levelTxtArea").value = questions[34];
        document.getElementById("pooratTxtArea").value = questions[36];
        document.getElementById("q_recordTxtArea").value = questions[37];
        document.getElementById("qsentenceTextArea").value = questions[19];
        document.getElementById("correctTxtArea").value = questions[40];
        document.getElementById("incorrectTxtArea").value = questions[39];
        document.getElementById("pre_qdateTxtArea").value = questions[41];
        document.getElementById("nextQdateTxtArea").value = questions[38];
        document.getElementById("pcaTxtArea").value = questions[42];
        document.getElementById("qdateTxtArea").value = questions[43];
        document.getElementById("imgfolder").value = questions[20];
    }
  }

  function updateQuestion(){

    var moji=
      document.getElementById("answer1TxtArea").value + "^^" +
      document.getElementById("answer2TxtArea").value + "^^" +
      document.getElementById("answer3TxtArea").value + "^^" +
      document.getElementById("answer4TxtArea").value + "^^" +
      document.getElementById("answer5TxtArea").value + "^^" +
      document.getElementById("answer6TxtArea").value + "^^" +
      document.getElementById("answer7TxtArea").value + "^^" +
      document.getElementById("answer8TxtArea").value + "^^" +
      document.getElementById("answer9TxtArea").value + "^^" +
      document.getElementById("answer10TxtArea").value + "^^" +
      document.getElementById("answer11TxtArea").value + "^^" +
      document.getElementById("answer12TxtArea").value + "^^" +
      document.getElementById("answer13TxtArea").value + "^^" +
      document.getElementById("answer14TxtArea").value + "^^" +
      document.getElementById("answer15TxtArea").value + "^^" +
      document.getElementById("questionTxtArea").value + "^^" +
      document.getElementById("modifyCategory1").value + "^^" +
      document.getElementById("modifyCategory2").value + "^^" +
      document.getElementById("modifyCategory3").value + "^^" +
      document.getElementById("qsentenceTextArea").value + "^^" +
      document.getElementById("imgfolder").value + "^^" +//21
      "" + "^^" +
      "" + "^^" +
      document.getElementById("hintTxtArea").value + "^^" +
      document.getElementById("tagTextArea").value + "^^" +//25
      "" + "^^" +
      "" + "^^" +
      "" + "^^" +
      "" + "^^" +
      "" + "^^" +//30
      "" + "^^" +
      "" + "^^" +
      "" + "^^" +
      "" + "^^" +
      document.getElementById("q_levelTxtArea").value + "^^" +
      "" + "^^" +//36
      document.getElementById("pooratTxtArea").value + "^^" +
      document.getElementById("q_recordTxtArea").value + "^^" +
      "" + "^^" +//39
      document.getElementById("incorrectTxtArea").value + "^^" +
      document.getElementById("correctTxtArea").value + "^^" +
      document.getElementById("pre_qdateTxtArea").value + "^^" +
      document.getElementById("pcaTxtArea").value + "^^" +
      document.getElementById("qdateTxtArea").value + "^^" +
      document.getElementById("questionnumberTextArea").value + "^^" +
      document.getElementById("DB_name").value + "^^" +
      document.getElementById("modifyCategory4").value + "^^" +
      document.getElementById("modifyCategory5").value + "^^";

    moji = encodeURIComponent(moji);


    // console.log('711 moji is '+moji);

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../modifyquestionanswer2.php", false);//不正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        // var res=xmlhttp.responseText;
        var res=xmlhttp.responseText.split('^^^^');
        document.getElementById("questionnumberTextArea").value = res[1];
        // console.log('721 res is '+res);



    }
    showImage()
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

  function deleteQ(){
    var moji=document.getElementById("questionnumberTextArea").value + "^" + document.getElementById("DB_name").value;
    // console.log('678 poorat is '+ document.mainform.poorat.value);
    // console.log('679 getpastTime is '+ getpastTime);
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../deleteQuestion.php", false);//不正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // console.log('delete is ' + res);
    }
  }
  function nextNewQuestion() {
    document.getElementById("answer1TxtArea").value = "";
    for (let i = 1; i < 14; i++) {
      var num = i + 1;
      document.getElementById("answer"+ num +"TxtArea").value = "";
    }
    document.getElementById("questionTxtArea").value = "";
    // document.getElementById("modifyCategory1").value = "";
    // document.getElementById("modifyCategory2").value = "";
    // document.getElementById("modifyCategory3").value = "";
    document.getElementById("qsentenceTextArea").value = "";
    document.getElementById("hintTxtArea").value = "";
    document.getElementById("questionnumberTextArea").value = "";
    document.getElementById("q_levelTxtArea").value = "";
    document.getElementById("pooratTxtArea").value = "";
    document.getElementById("q_recordTxtArea").value = "";
    document.getElementById("correctTxtArea").value = "";
    document.getElementById("incorrectTxtArea").value = "";
    document.getElementById("pre_qdateTxtArea").value = "";
    document.getElementById("pcaTxtArea").value = "";
    document.getElementById("qdateTxtArea").value = ""
  }
  function textareafontresize(){
      document.getElementById("questionTxtArea").style.fontSize = document.getElementById("fontresize").value;
      document.getElementById("answer1TxtArea").style.fontSize = document.getElementById("fontresize").value;
      document.getElementById("hintTxtArea").style.fontSize = document.getElementById("fontresize").value;
  }
  function pictureToTxt(){
    // document.getElementById("div2").style.display = "none";
    document.getElementById("answer1TxtArea").style.display = "block";
    // document.getElementById("div1").style.display = "none";
    document.getElementById("questionTxtArea").style.display = "block";
  }

  $(function(){
	
    var ajax_url = 'upload_demo2.php';
    
    fileuploadEx('#file1_wrap','#file1','#prog1',ajax_url,function(res){
      
      $('#res1').html(res);

    },
    {'fu_show_flg':1});
    
  });

  $(function(){
	
  var ajax_url = 'upload_demo3.php';
  
  fileuploadEx('#file2_wrap','#file2','#prog1',ajax_url,function(res){
    
    $('#res1').html(res);

  },
  {'fu_show_flg':1});
  
});

  /**
   * ファイルアップロード要素のラッパー要素にファイルドラッグ＆ドロップイベントを追加する
   * 
   * @param wrap_slt ラッパー要素のセレクタ
   * @param fu_slt ファイルアップロード要素のセレクタ
   * @param prog_slt 進捗バー要素のセレクタ
   * @param ajax_url AJAX通信先URL
   * @param callback(res) ファイルアップロード後コールバック
   * @param option
   *  - fu_show_flg ファイルアップロード要素の表示 0:非表示（デフォルト） , 1:表示
   */
  function fileuploadEx(wrap_slt,fu_slt,prog_slt,ajax_url,callback,option){
    
    if(option == null){
      option = {};
    }
    
    if(option['fu_show_flg'] == null){
      option['fu_show_flg'] = 0;
    }
    
    var fuw = $(wrap_slt);
    
    // DnDイベントをラッパー要素に追加
    fuw[0].addEventListener('drop',function(evt){
      evt.stopPropagation();
      evt.preventDefault();

      var files = evt.dataTransfer.files; 
      _uploadByAjax(files,prog_slt,ajax_url,callback,option); // AJAXによるアップロード

    },false);
    
    fuw[0].addEventListener('dragover',function(evt){
      evt.preventDefault();
    },false);
    
    // ファイルアップロード要素のイベント
    var fu = $(fu_slt);
    fu.change(function(e) {
      
      var files = e.target.files; // ファイルオブジェクト配列を取得（配列要素数は選択したファイル数を表す）
      _uploadByAjax(files,prog_slt,ajax_url,callback,option); // AJAXによるアップロード
    });
    
    // ファイルアップロード要素の表示フラグがOFFならファイルアップロード要素を隠す。
    if(option.fu_show_flg == 0){
      fu.hide();
    }
    
  }

  /**
   * AJAXによるアップロード
   * @param files ファイルオブジェクトリスト
   * @param prog_slt 進捗バー要素のセレクタ
   * @param ajax_url AJAX通信先URL
   * @param callback(res) ファイルアップロード後コールバック
   * @param option
   */
function _uploadByAjax(files,prog_slt,ajax_url,callback,option){

  var fd = new FormData();
  for(var i in files){
    fd.append(i, files[i]);
    fd.append("imagefolder", document.getElementById( "imgfolder" ).value);
    if (i === "0") {
      var str01 = files[i]["name"];
      // document.getElementById("questionTxtArea").value =document.getElementById( "questionTxtArea").value + files[i]["name"];
      if (str01.indexOf('mp3') != -1) {
        //strにhogeを含む場合の処理
        
        // document.getElementById("questionTxtArea").value ="";
        document.getElementById("answer1TxtArea").value =document.getElementById( "answer1TxtArea").value + files[i]["name"];
      } else {
        document.getElementById("questionTxtArea").value =document.getElementById( "questionTxtArea").value + files[i]["name"];
      }
    } else if (i === "1") {
      var str01 = files[i]["name"];
      if (str01.indexOf('mp3') != -1) {
        //strにhogeを含む場合の処理          
        // document.getElementById("questionTxtArea").value ="";
        document.getElementById("answer1TxtArea").value =document.getElementById( "answer1TxtArea").value + files[i]["name"];
      }
      document.getElementById("answer1TxtArea").value =document.getElementById( "answer1TxtArea").value + files[i]["name"];
    }
    // console.log(files[i]["name"]);
    
    // if (typeof str01 === "number") {
    //   if (str01.indexOf('mp3') != -1) {
    //     //strにhogeを含む場合の処理
        
    //     document.getElementById("questionTxtArea").value ="";
    //     document.getElementById("answer1TxtArea").value =document.getElementById( "answer1TxtArea").value + files[i]["name"];
    //   }
    // }
  
    
    // for (item of fd) {
    //   console.log(item);
    // }
  }

  var prog1 = $(prog_slt); // 進捗バー要素
  
  // AJAXによるファイルアップロード
  $.ajax({
    type: "POST",
    url: ajax_url,
    data: fd,
    cache: false,
    dataType: "text",
    processData : false,
    contentType : false,
    xhr : function() { // 進捗イベント
      var XHR = $.ajaxSettings.xhr();
      if (XHR.upload) {
        XHR.upload.addEventListener('progress',
            function(e) {
              var prog_value = parseInt(e.loaded / e.total * 10000) / 100;
              prog1.val(prog_value);
            }, false);
      }
      return XHR;
    },

  })
  .done(function(res, type) {

    callback(res);
    
  })
  .fail(function(jqXHR, statusText, errorThrown) {
    
    var err_res = jqXHR.responseText;
    console.log(err_res);
    jQuery('#err').html(err_res);
    alert(statusText);
  });




}

function preQu (){
  document.getElementById("questionList").selectedIndex = document.getElementById("questionList").selectedIndex -1;
  qestionListChange();
  showImage ()
  
}
function nextQu (){
  document.getElementById("questionList").selectedIndex = document.getElementById("questionList").selectedIndex +1;
  qestionListChange();
  showImage ()
}///////////////

function showImage (){
  var moji= document.mainform.DB_name.value + "^^" + document.getElementById("questionTxtArea").value + " --- " + document.getElementById("questionnumberTextArea").value;
  var imagefolder ="";
  moji = encodeURIComponent(moji);
  // console.log('moji is ' + moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
      xmlhttp.open("POST", "../getQestionForUpdate.php", false);//
      xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      var data="data=" + moji;
      xmlhttp.send(data);
      var res=xmlhttp.responseText;
      questions = res.split('^^');
  }

  imagefolder = document.getElementById( "imgfolder" ).value;  

  if (questions[0].indexOf( "jpg" ) > 0 || questions[15].indexOf( "jpeg" ) > 0 || questions[15].indexOf( "png" ) > 0  || (questions[15].indexOf( "gif" ) > -1)) {
    // document.getElementById("answer1TxtArea").style.display = "none";
    document.getElementById("div2").style.display = "block";
    var imageadress =  res.split('^');
    
    // console.log('imageadress is ' + imageadress);
    document.getElementById("mypic2").src='images/'+imagefolder+'/' + imageadress[0];
    // document.getElementById("mypic2").style.width = "200px"
    var el = document.getElementById("mypic2");
    var image2 = new Image();
    var width2;
    var height2;

    // document.getElementById("mypic2").style.width = "1000px";  // 横幅を400pxにリサイズ
    // document.getElementById("mypic2").style.height = height2 * (1000 / width2)+"px"; // 高さを横幅の変化割合に合わせる;
    image2.onload = function(){
        width2 = image2.width;
        height2 = image2.height;
        // if ((width2>height2)&&(width2>200)) {
        if (width2>200) {
            document.getElementById("mypic2").style.width = "1000px";  // 横幅を400pxにリサイズ
            document.getElementById("mypic2").style.height = height2 * (1000 / width2)+"px"; // 高さを横幅の変化割合に合わせる;
            if (parseInt(document.getElementById("mypic2").style.height)>parseInt(document.getElementById("div2").clientHeight)) {
              // document.getElementById("mypic2").style.height = document.getElementById("div2").clientHeight +"px";
              // document.getElementById("mypic2").style.width = (document.getElementById("mypic2").height*width2)/height2 + "px";
            } else {
            }
        } else {
          document.getElementById("mypic2").style.width = image2.width*3 + "px";
          document.getElementById("mypic2").style.height = height2 * (image2.width * 3 / width2)+"px";
          // document.getElementById("mypic2").style.height = document.getElementById("div2").clientHeight +"px";
          // document.getElementById("mypic2").style.width = (document.getElementById("mypic2").height*width2)/height2 + "px";
        }
        imageWidth2 = Number(document.getElementById("mypic2").style.width.substr(0,document.getElementById("mypic2").style.width.length -2));
        imageHeight2 = Number(document.getElementById("mypic2").style.height.substr(0,document.getElementById("mypic2").style.height.length -2));
        imageSizeChange1()
        imageSizeChange2()
    //
    //
    }

    image2.src = 'images/'+imagefolder+'/' + imageadress[0];
  } else {
      // document.getElementById("div2").style.display = "none";
      document.getElementById("answer1TxtArea").style.display = "block";
  }






  // document.getElementById("questionTxtArea").value = questions[15];

  if (questions[15].indexOf( "jpg" ) > 0 || questions[15].indexOf( "jpeg" ) > 0 || questions[15].indexOf( "png" ) > 0 || (questions[15].indexOf( "gif" ) > -1)) {
    // document.getElementById("questionTxtArea").style.display = "none";
    document.getElementById("div1").style.display = "block";

    question = questions[15].split('\n\n');
    if (question.length > 1) {
      document.getElementById("mypic1").src='images/'+imagefolder+'/' + question[1];
    } else {
      document.getElementById("mypic1").src='images/'+imagefolder+'/' + question[0];
    }
  

    var image1 = new Image();
    var width;
    var height;

    image1.onload = function(){
        width = image1.width;
        height = image1.height;
        if ((width>height)&& (width>200)){
            document.getElementById("mypic1").style.width = "1000px";  // 横幅を400pxにリサイズ
            document.getElementById("mypic1").style.height = height * (1000 / width)+"px"; // 高さを横幅の変化割合に合わせる;
            // if (parseInt(document.getElementById("mypic1").style.height)>parseInt(document.getElementById("div1").clientHeight)) {
            //   document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
            //   document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
            // } else {
            // }
        } else {
          document.getElementById("mypic1").style.width = image1.width * 3 + "px";
          document.getElementById("mypic1").style.height = height * (image1.width * 3 / width)+"px";
          // document.getElementById("mypic1").style.height = document.getElementById("div1").clientHeight +"px";
          // document.getElementById("mypic1").style.width = (document.getElementById("mypic1").height*width)/height + "px";
        }
        imageWidth1 = Number(document.getElementById("mypic1").style.width.substr(0,document.getElementById("mypic1").style.width.length -2));
        imageHeight1 = Number(document.getElementById("mypic1").style.height.substr(0,document.getElementById("mypic1").style.height.length -2));
        imageSizeChange1()
        imageSizeChange2()
    }
    if (question.length > 1) {
      image1.src ='images/'+imagefolder+'/' + question[1];
    } else {
      image1.src ='images/'+imagefolder+'/' + question[0];
    }
    // image1.src = 'images/'+imagefolder+'/' + question;
    // document.getElementById("mypic2").src= "";

  } else {
    // document.getElementById("div1").style.display = "none";
    document.getElementById("questionTxtArea").style.display = "block";
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
</script>
</body>
</html>
