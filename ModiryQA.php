<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>T-System</title>
    <style type="text/css">
        textarea{font-size:22px; background-color:#ffccff; padding:5px;}
        img {
         max-width: 100%;
         max-height: 100%;
         width: auto;
         height: auto;
         top: 50%;
        }
        .img-container--precedo {
         position: relative;
         width: 550px;
         height: 260px;
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
         img {
         vertical-align: middle;
         }
        }
        div.questionbuttonbox {
            width:550px; height:95px;
            margin:5px; padding:10px;
        }
        .modifyanswerbox{
            display: flex;
        }
        div.answerbuttonbox {
            width:550px; height:95px;
            margin:5px; padding:10px;
        }
        div.modifybuttonbox {
            width:550px; height:95px;
            margin:5px; padding:10px;
        }
    </style>
<body>
<form name ="mainform" action="" method="post">
  <p><input type="text" id="DB_name"  name="DB_name" value="<?php if (isset($_POST["DB_name"])) {echo $_POST["DB_name"];}?>" style='width: 400px; font-size: 50px;height:80px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://terashimayo.s1008.xrea.com//UpdateSql.php"><font size="5" color="#00aa00">問題追加</font></a></p>
require_once 'db_wrapper.php';
  <p><input type="submit" value="送信" style='font-size: 25px;width: 120px; height: 70px'></p>

<?php
// error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!empty($_POST["DB_name"])) {

//    echo $_POST["DB_name"].",\n"."\n";//
    $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    // $mysqli = new db_wrapper('localhost', 'root', 'yoichi41', 'terashimayo');
    /////
//    echo "";
     if( $mysqli->connect_errno){
        echo 'Access Failed';//接続失敗
        exit;
    }

    $db_name = $_POST["DB_name"];//$_GET["DB_name"];///////

    $db_column = "category1";


    //デフォルト文字セットを設定
    $mysqli->set_charset("utf8");
    $row = "";
    // echo "1".",\n"."\n";
    //データベースから正解不正解の合計を取得
    $str_sql = "SELECT sum(correct) FROM  $db_name";
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $test2 = $test['sum(correct)'];

    // echo "1".",\n"."\n";

    $str_sql = "SELECT sum(incorrect) FROM  $db_name";
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $test3 = $test['sum(incorrect)'];//

    $str_sql = "SELECT max(qdate) FROM  $db_name";
    $result = $mysqli->query($str_sql);
    $test  = $result->fetch_assoc();
    $test4 = $test['max(qdate)'];



    echo "<p style='font-size:30px;color:#FF0000;'> 正解の合計は $test2 です。<br>
    不正解の合計は $test3 です。 <br>
    前回は $test4 でした。</p>";////<font size="5" color="#000000">問目</font>

    $today = date("Y/m/d");
    $target_day = $test4;
    if(strtotime($today) - strtotime($target_day) > 604800){
      echo "<p> さぼってんじゃねえ！ </p>"."\n";/////aaaa
    }

    //データベース取得
    $str_sql = "select $db_column from $db_name";
//     echo $str_sql.",\n"."\n";//
    $result = $mysqli->query($str_sql);
    $row_cnt = count($result);
//     var_dump($result);
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

    $sampleSelectBox = "<select name=\"category1\" id='ctg1' onChange='listChange()' style='width: 200px; font-size: 25px;'>\n";
    for ( $i = 0; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";
    echo "{$sampleSelectBox}";

    //データベース取得
    $str_sql = "select category2 from $db_name";
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

    $sampleSelectBox = "<select name=\"category2\" id='ctg2' onChange='listChange2()' style='width: 200px; font-size: 25px;'>\n";
    // $sampleSelectBox .="\t<option value=""></option>\n";
    for ( $i = 0; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }//
    $sampleSelectBox .= "</select>\n";
    echo "{$sampleSelectBox}";


    //データベース取得
    $str_sql = "select category3 from $db_name";
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

    $sampleSelectBox = "<select name=\"category3\" id='ctg3' onChange='listChange3()' style='width: 200px; font-size: 25px;'>\n";

    for ( $i = 0; $i < $row_cnt; $i++ ) {
        $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
    }
    $sampleSelectBox .= "</select>\n";//aaaaaaあああ
    echo "{$sampleSelectBox}";




  } else {
    $err = "入力されていない項目があります。";
  }
}
global $testnumber;
$testnumber = 0;
?>
<!-- <p><?php echo $testnumber ?></p> -->




<br>
<select name='category4' onChange='listChange4()' style="width: 200px; font-size: 25px;">
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator1'  onChange='listChange4()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria1" value = "" style='width: 200px; font-size: 20px;'>
<br>
<select name='category5'  onChange='listChange4()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator2'  onChange='listChange4()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria2" value = "" style='width: 200px; font-size: 20px;'>
<br>
<select name='category6'  onChange='listChange4()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator3'  onChange='listChange4()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria3" value = "" style='width: 200px; font-size: 20px;'>
<br>


<div class="questionbuttonbox" >
    <input type="checkbox" id = "qachange" style="font-size: 30px;">
    <font size="5" color="#000000" ;>問題/解答</font>&ensp; &ensp; &ensp;
    <span style="font-size: 30px;" id="press-button">0</span>
    <font size="5" color="#000000">問目</font>
    <input type="button" name="botan" id="button01" onClick="sendRequest();"value="問題"
    style="position: absolute; left: 380px;width:200px;height:100px;font-size: 25px"><br>
</div>
<div id="div0"></div>

<TEXTAREA id="textareas" style="width:570px;height:260px;" wrap="soft" style="visibility:hidden"></TEXTAREA>
<div id ="div1" class="img-container--precedo">
    <img id="mypic1" src="">
</div>
<br>
<div class="modifyanswerbox" >
    <div class="modifybuttonbox" >
        <input type="button" name="botan" id="button03" onClick="sendRequest5();" value="修正"
        style="position: absolute; left: 10px;width:200px;height:100px; font-size: 25px">
    </div>
    <div class="answerbuttonbox" >
        <input type="button" name="botan" id="button02" onClick="sendRequest2();" value="解答"
        style="position: absolute; left: 380px;width:200px;height:100px; font-size: 25px"><br>
    </div>
</div>
<TEXTAREA id="textareas2" style="width:570px;height:260px;" wrap="soft" style="font-size:50px;"></TEXTAREA>
<div id ="div2" class="img-container--precedo">
    <img id="mypic2" src=""　>
</div>
<br>
<input type="button" name="botan" id="button01" onClick="sendRequest3();" value="正解"
style="width:280px;height:100px; font-size: 25px">
<input type="button" name="botan" id="button01" onClick="sendRequest4();" value="不正解"
style="width:280px;height:100px; font-size: 25px"><br>
<!-- ここにHTMLを書くする -->


<script type="text/javascript">
    document.getElementById("div2").style.display = "none";
    document.getElementById("div1").style.display = "none";
    // document.write('ja');
    // console.log("1");
    var num = 0;
    var flag1 = false
    var randoms = [];
    let rand = "";
    var questionnumbers = ""
    var min = 1, max = ""
    var phpfile1 = ""
    var phpfile2 = ""

    function sendRequest()
    {
        var QAChangeChecked = document.getElementById("qachange").checked;////

        if (QAChangeChecked) {
            var phpfile1 = "getonequestion2.php";
            var phpfile2 = "getanswer2.php";
        } else {
            var phpfile1 = "getonequestion1.php";
            var phpfile2 = "getanswer1.php";
        }



       var moji=rand + "." + document.mainform.category1.value + "." + document.mainform.category2.value + "." + document.mainform.category3.value + "." + document.mainform.category4.value + "." + document.mainform.category5.value + "." + document.mainform.category6.value + "." + document.mainform.operator1.value + "." + document.mainform.operator2.value + "." + document.mainform.operator3.value + "." + document.mainform.criteria1.value + "." + document.mainform.criteria2.value + "." + document.mainform.criteria3.value + "." + document.mainform.DB_name.value ;



       var xmlhttp=createXmlHttpRequest();
       if(xmlhttp!=null)
       {
           // alert(flag1);
           if (flag1 == false){
               xmlhttp.open("POST", "../getqestions.php", false);//乱数を取得
               xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
               var data="data="+moji;
               xmlhttp.send(data);
               var res=xmlhttp.responseText;
               console.log('317 res is '+res);
               questionnumbers = res.split(',');

               console.log('320 questionnumbers is '+questionnumbers);


                /** 重複チェック用配列 */

                /** 最小値と最大値 */

                max = questionnumbers.length-1;
                if (max==0) {
                max=1;
                }
             }
            console.log('328 max is '+max);


            document.getElementById("press-button").innerHTML = num+1  +"/"+max;

            if (num+1 < max ) {
            num++;
            } else {
            num=0;
            }

            // alert(flag1);///

            if (flag1 == false){
                // alert(max);
                 randoms = [];
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
                flag1 = true;
            }
            console.log('357 randoms is '+randoms);

            // var str01 = randoms + "///" + num +"///" + randoms[num] + "///" + questionnumbers[randoms[num]]
            // alert(str01);


           // document.getElementById("textareas").value = questionnumbers[2];////
        }

        if (max==1) {
        rand = questionnumbers;
        } else {
        rand = questionnumbers[randoms[num]];
        }

        console.log('376 rand is '+rand);


        // alert(num);
        /*alert(rand);*/
        // alert(questionnumbers[1]);

        
        var moji=rand + "." + document.mainform.DB_name.value;

//      doc0.innerHTML= moji;

        var xmlhttp=createXmlHttpRequest();
        if(xmlhttp!=null)
        {

            xmlhttp.open("POST", "../"+phpfile1, false);//乱数をもとに問題を取得
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var data="data="+moji;

            console.log('396 data is '+data);
    //        var dataa="data="+moji;
            xmlhttp.send(data);
            //xmlhttp.send(dataa);

            //var datata="data="+mojiji;
            //xmlhttp.send(datata);

            var res=xmlhttp.responseText;

            console.log('404 res is '+res);
            var res = res.split('^');

            var doc0= document.getElementById("div0");
            
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

            
            if (res.indexOf( "jpg" ) > 0) {
            document.getElementById("textareas").style.display = "none";
            document.getElementById("div1").style.display = "block";
            var imageadress =  res.split('\n');
            document.getElementById("mypic1").src='images/HS-MATH2B/' + imageadress[0];
            document.getElementById("mypic1").style.width = "700px";


            } else {
            document.getElementById("div1").style.display = "none";
            document.getElementById("textareas").style.display = "block";
            document.getElementById( "textareas" ).value = "";
            document.getElementById( "textareas" ).value = question ;////////
            document.getElementById( "textareas2" ).value = "";;
            }



        }　
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


function sendRequest2()
{
    var QAChangeChecked = document.getElementById("qachange").checked;////

    if (QAChangeChecked) {
        var phpfile1 = "getonequestion2.php";
        var phpfile2 = "getanswer2.php";
    } else {
        var phpfile1 = "getonequestion1.php";
        var phpfile2 = "getanswer1.php";
    }
    var moji=rand + "." + document.mainform.DB_name.value;
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        // alert(phpfile2);
        xmlhttp.open("POST", "../"　+ phpfile2 , false);//乱数をもとに解答を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        console.log('502 res is '+ res);
        document.getElementById( "textareas2" ).value = "";
        document.getElementById( "textareas2" ).value = res;
        if (res.indexOf( "jpg" ) > 0) {
            document.getElementById("textareas2").style.display = "none";
            document.getElementById("div2").style.display = "block";
            var imageadress =  res.split('\n');
            document.getElementById("mypic2").src='images/HS-MATH2B/' + imageadress[0];
            // alert('images/HS-MATH2B/' + imageadress[0]);
            // alert(document.getElementById("mypic").src);
        } else {
            document.getElementById("div2").style.display = "none";
            document.getElementById("textareas2").style.display = "block";
            document.getElementById( "textareas2" ).value = "";
            document.getElementById( "textareas2" ).value = res ;////////
        }
    }
}

function sendRequest3()
{

    var moji=rand + "." + document.mainform.DB_name.value;
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../addcorrect.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        console.log('534 addcorrectres is '+res);
        document.getElementById( "textareas2" ).value = "";
        document.getElementById( "textareas2" ).value = res;
        document.getElementById("div2").style.display = "none";
        document.getElementById("textareas2").style.display = "block";
    }
}

function sendRequest4()
{

    var moji=rand + "." + document.mainform.DB_name.value;
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../addincorrect.php", false);//不正解ボタンを押す
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
function sendRequest5()
{

    var QAChangeChecked = document.getElementById("qachange").checked;////

    if (QAChangeChecked) {
        var moji=rand + "." + document.mainform.DB_name.value + "." + document.getElementById( "textareas2" ).value + "." + document.getElementById( "textareas" ).value;
    } else {
        var moji=rand + "." + document.mainform.DB_name.value + "." + document.getElementById( "textareas" ).value + "." + document.getElementById( "textareas2" ).value;
    }

    console.log('565 moji is '+moji);
    
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../modifyquestionanswer.php", false);//不正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        console.log('565 res is '+res);


    }
}

function createXmlHttpRequest2()
{
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

/** min以上max以下の整数値の乱数を返す */
function intRandom(min, max){
  return Math.floor( Math.random() * (max - min + 1)) + min;
}

function listChange(){
    // console.log("1");
    // console.log(flag1);

    num=0;
    // document.getElementById("press-button").innerHTML = num +"/"+ max;
    flag1 = false;

    var moji= document.mainform.DB_name.value + "." + document.getElementById("ctg1").value 
    + "." + "category1" + "." + "category2";
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
        var res=xmlhttp.responseText;
        // console.log("2.2"+" "+res);
        // console.log("2.2"+res);
        var selectedcategory2 = res.split(',');
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
        // console.log(document.getElementById('ctg2').value);
        // $("#ctg2").val(ctg2selectedindex);
    }

    var moji= document.mainform.DB_name.value + "." + document.getElementById("ctg1").value 
    + "." + "category1" + "." + "category3";
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
        var res=xmlhttp.responseText;
        // console.log("2.2"+" "+res);
        // console.log("627 "+ res);
        var selectedcategory3 = res.split(',');
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





}


function listChange2(){
    num=0;
    flag1 = false;
    var moji= document.mainform.DB_name.value + "." + document.getElementById("ctg2").value 
    + "." + "category2" + "." + "category1";
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
        var res=xmlhttp.responseText;
        // console.log("2.2"+" "+res);
        console.log("4.2"+res);
        var selectedcategory1 = res.split(',');
        // console.log(selectedcategory2);
        // console.log(selectedcategory2[1]);
        var ctg1selectedindex = document.getElementById('ctg1').value;
        // console.log(ctg2selectedindex);
        var sl = document.getElementById('ctg1');
        while(sl.lastChild)
        {
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

    var moji= document.mainform.DB_name.value + "." + document.getElementById("ctg2").value 
    + "." + "category2" + "." + "category3";
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
        var res=xmlhttp.responseText;
        // console.log("2.2"+" "+res);
        // console.log("3.2"+res);
        var selectedcategory3 = res.split(',');
        // console.log(selectedcategory3);
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
        // console.log(ctg2selectedindex);
        document.getElementById('ctg3').value = ctg3selectedindex;
        // console.log(document.getElementById('ctg3').value);
        // $("#ctg2").val(ctg2selectedindex);

    }


    }
function listChange3(){
    num=0;
    flag1 = false;
    var moji= document.mainform.DB_name.value + "." + document.getElementById("ctg3").value 
    + "." + "category3" + "." + "category1";
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
        var res=xmlhttp.responseText;
        // console.log("2.2"+" "+res);
        // console.log("4.2"+res);
        var selectedcategory1 = res.split(',');
        // console.log(selectedcategory2);
        // console.log(selectedcategory2[1]);
        var ctg1selectedindex = document.getElementById('ctg1').value;
        // console.log(ctg2selectedindex);
        var sl = document.getElementById('ctg1');
        while(sl.lastChild)
        {
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

    var moji= document.mainform.DB_name.value + "." + document.getElementById("ctg3").value 
    + "." + "category3" + "." + "category2";
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
        var res=xmlhttp.responseText;
        // console.log("2.2"+" "+res);
        // console.log("3.2"+res);
        var selectedcategory2 = res.split(',');
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
    



}
function listChange4(){
    // alert(flag1);
    num=0;
    // document.getElementById("press-button").innerHTML = num +"/"+ max;
    flag1 = false;
    // alert(flag1);



}
</script>

</body>
</html>
