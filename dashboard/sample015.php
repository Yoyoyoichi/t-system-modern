<!DOCTYPE html>
<html lang="ja">

<form name="mainform">


<?php
$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');


if( $mysql->connect_errno){
    echo 'Access Failed';//接続失敗
    exit;
}

$query ="SHOW COLUMNS FROM MuAnki FROM terashimayo_mysql01";

$result = $mysqli->query($query);
$i = 1;
if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        //echo $row[2];//echo $row['2'];
        //echo "<br>";
        
        
        //print_r($row);
        
        $response[$i] =$row["Field"];
        //echo $i." ".$response[$i];
        //print_r($response);
        
        //echo "<br>";
        $i = $i + 1;

    }
}

$sampleSelectBox = "<select name=\"tablecolumn\">\n";
for ( $i = 40; $i < 46; $i++ ) {
    $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
}
$sampleSelectBox .= "</select>\n";
echo "{$sampleSelectBox}";
echo "<select name='operator'>
<option value='='>=</option>
<option value='>'>></option>
<option value='<'><</option>
</select>";

?>

<input type="text" name="kuraberu" value = 20>

<br>

<div id="div0"></div>

<input type="button" name="botan" id="button01" onClick="sendRequest();" value="問題" style="width:100px;height:50px"><br>
<TEXTAREA id="textareas" style="width:40%;height:200px;" wrap="soft" style="font-size:80%;"></TEXTAREA><br>
<input type="button" name="botan" id="button01" onClick="sendRequest2();" value="解答" style="width:100px;height:50px"><br>
<TEXTAREA id="textareas2" style="width:40%;height:200px;" wrap="soft" style="font-size:80%;"></TEXTAREA><br>
<input type="button" name="botan" id="button01" onClick="sendRequest3();" value="正解" style="width:100px;height:50px">
<input type="button" name="botan" id="button01" onClick="sendRequest4();" value="不正解" style="width:100px;height:50px"><br>

    <head>
        <meta charset="UTF-8">
        <title>HTML5</title>

<style type="text/css">
textarea{font-size:25px; background-color:#ffccff; padding:5px;}
</style>

    </head>
    <body>

    <script type="text/javascript">
var rand = "";
var num_rand = "";
function sendRequest()
{
    var moji=document.mainform.operator.value + "." + document.mainform.tablecolumn.value + "." + document.mainform.kuraberu.value;
    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample015b.php", false);//乱数を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        // document.getElementById( "textareas" ).value = res;//
    }　　

    //var array2 = ['リンゴ', 'バナナ', 'イチゴ'];
    
    //var mojiji=operator;
    rand = res;
    var doc0= document.getElementById("div0");  
    doc0.innerHTML= rand;   
    var moji= rand+ "." + document.mainform.operator.value + "." + document.mainform.tablecolumn.value + "." + document.mainform.kuraberu.value ;

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample015e.php", false);//乱数をもとに問題を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        var dataa="data="+moji;
        xmlhttp.send(data);
        //xmlhttp.send(dataa);

        //var datata="data="+mojiji;
        //xmlhttp.send(datata);

        var res=xmlhttp.responseText;
       document.getElementById( "textareas" ).value = res;//
    }

    var xmlhttp=createXmlHttpRequest();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample015f.php", false);//乱数をもとに問題の番号を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        var dataa="data="+moji;
        xmlhttp.send(data);
        //xmlhttp.send(dataa);

        //var datata="data="+mojiji;
        //xmlhttp.send(datata);

        var res=xmlhttp.responseText;
       // document.getElementById( "textareas" ).value = res;//
    }
    num_rand = res;

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

    var moji= rand+ "." + document.mainform.operator.value + "." + document.mainform.tablecolumn.value + "." + document.mainform.kuraberu.value ;
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample015a.php", false);//乱数をもとに解答を取得
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        document.getElementById( "textareas2" ).value = res;
    }
}

function sendRequest3()
{

    var moji=num_rand;
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample015c.php", false);//正解ボタンを押す
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var data="data="+moji;
        xmlhttp.send(data);
        var res=xmlhttp.responseText;
        document.getElementById( "textareas2" ).value = res;
    }
}            

function sendRequest4()
{

    var moji=num_rand;
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
        xmlhttp.open("POST", "../sample015d.php", false);//不正解ボタンを押す
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