<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>HTML5</title>

<style type="text/css">
textarea{font-size:25px; background-color:#ffccff; padding:5px;}
</style>

</head>
<body>
<form name="mainform" action="cgi-bin/abc.cgi" method="post">
<!--  -->


<input type='text' name='DB_name' value = 'MuAnki'><br>

<!-- <input type="submit" value="送信する"> -->



<?php

$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');
/////
echo "";
if( $mysql->connect_errno){
    echo 'Access Failed';//接続失敗
    exit;
}
$DB=$_GET["DB_name"];

$db_name = 'MuAnki';///////

$db_column = "category1";
// $mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');
// if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");
$row = "";
//データベース取得
$str_sql = "select $db_column from $db_name";
// echo $str_sql."\n"."\n";//
$result = $mysqli->query($str_sql);
$row_cnt = count($result);
// echo $row_cnt."\n"."\n";

if (!$result) {error_log($mysqli->error);exit;}
// $response[] = array();
while($dat = $result->fetch_assoc()){
    $response[] = $dat['category1'];
}

$response = array_values(array_unique($response));
// var_dump($response);
$row_cnt = count($response);

$sampleSelectBox = "<select name=\"category1\">\n";
for ( $i = -1; $i < $row_cnt; $i++ ) {
    $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
}
$sampleSelectBox .= "</select>\n";
echo "{$sampleSelectBox}";

//データベース取得
$str_sql = "select category2 from $db_name";
$result = $mysqli->query($str_sql);

if (!$result) {error_log($mysqli->error);exit;}
unset($response);
while($dat = $result->fetch_assoc()){
    $response[] = $dat['category2'];
}

$response = array_values(array_unique($response));
// var_dump($response);
$row_cnt = count($response);

$sampleSelectBox = "<select name=\"category2\">\n";
// $sampleSelectBox .="\t<option value=""></option>\n";
for ( $i = -1; $i < $row_cnt; $i++ ) {
    $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
}//
$sampleSelectBox .= "</select>\n";
echo "{$sampleSelectBox}";


//データベース取得
$str_sql = "select category3 from $db_name";
$result = $mysqli->query($str_sql);

if (!$result) {error_log($mysqli->error);exit;}
unset($response);
while($dat = $result->fetch_assoc()){
    $response[] = $dat['category3'];
}

$response = array_values(array_unique($response));
// var_dump($response);
$row_cnt = count($response);

$sampleSelectBox = "<select name=\"category3\">\n";

for ( $i = 0; $i < $row_cnt; $i++ ) {
    $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
}
$sampleSelectBox .= "</select>\n";//
echo "{$sampleSelectBox}";
///

?>


<br>
<select name='category4'>
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator1'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria1" value = "">
<br>
<select name='category5'>
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator2'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria2" value = "">
<br>
<select name='category6'>
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator3'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria3" value = "">
<br>
<div id="div0"></div>

<input type="button" name="botan" id="button01" onClick="sendRequest();" value="問題" style="width:100px;height:50px"><br>
<TEXTAREA id="textareas" style="width:80%;height:200px;" wrap="soft" style="font-size:80%;"></TEXTAREA><br>
<input type="button" name="botan" id="button01" onClick="sendRequest2();" value="解答" style="width:100px;height:50px"><br>
<TEXTAREA id="textareas2" style="width:80%;height:200px;" wrap="soft" style="font-size:80%;"></TEXTAREA><br>
<input type="button" name="botan" id="button01" onClick="sendRequest3();" value="正解" style="width:100px;height:50px">
<input type="button" name="botan" id="button01" onClick="sendRequest4();" value="不正解" style="width:100px;height:50px"><br>



    <script type="text/javascript">
var rand = "";
var num_rand = "";
function sendRequest()
{
    // alert(document.mainform.DB_name.value);
    // alert(document.mainform.category1.value);
    var moji=rand + "." + document.mainform.category1.value + "." + document.mainform.category2.value + "." + document.mainform.category3.value + "." + document.mainform.category4.value + "." + document.mainform.category5.value + "." + document.mainform.category6.value + "." + document.mainform.operator1.value + "." + document.mainform.operator2.value + "." + document.mainform.operator3.value + "." + document.mainform.criteria1.value + "." + document.mainform.criteria2.value + "." + document.mainform.criteria3.value ;//+ "." + document.mainform.DB_name.value ;
    

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample020bb.php", false);//乱数を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
       document.getElementById( "textareas" ).value = res;////
    }　　

    //var array2 = ['リンゴ', 'バナナ', 'イチゴ'];

    //var mojiji=operator;
    rand = res;
    var doc0= document.getElementById("div0");
    // doc0.innerHTML= rand;
    var moji=rand + "." + document.mainform.DB_name.value;
    // doc0.innerHTML= moji;
    
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample020e.php", false);//乱数をもとに問題を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
//        var dataa="data="+moji;
        xmlhttp.send(data);
        //xmlhttp.send(dataa);

        //var datata="data="+mojiji;
        //xmlhttp.send(datata);

        var res=xmlhttp.responseText;
        // document.getElementById( "textareas" ).value = res;/////////
    }　
    // doc0.innerHTML= "2";/
    // var xmlhttp=createXmlHttpRequest();
    // if(xmlhttp!=null)
    // {
    //     xmlhttp.open("POST", "../sample019f.php", false);//乱数をもとに問題の番号を取得
    //     xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //     var data="data="+moji;
    //     var dataa="data="+moji;
    //     xmlhttp.send(data);
    //     //xmlhttp.send(dataa);

    //     //var datata="data="+mojiji;
    //     //xmlhttp.send(datata);

    //     var res=xmlhttp.responseText;
    //    // document.getElementById( "textareas" ).value = res;//
    // }
    // num_rand = res;

}

function createXmlHttpRequest()
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


function sendRequest2()
{

    var moji= rand;
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample020a.php", false);//乱数をもとに解答を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        document.getElementById( "textareas2" ).value = res;
    }
}

function sendRequest3()
{

    var moji=rand;
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample020c.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        document.getElementById( "textareas2" ).value = res;
    }
}

function sendRequest4()
{

    var moji=rand;
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample020d.php", false);//不正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        document.getElementById( "textareas2" ).value = res;
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

        </script>
    </body>
</html>
