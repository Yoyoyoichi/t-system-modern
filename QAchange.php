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
		div.answerbuttonbox {
		width:550px; height:95px;
		margin:5px; padding:10px; 
		} 
    </style>
<body>
<form name ="mainform" action="" method="post">
  <p><input type="text" id="DB_name"  name="DB_name" value="<?php echo $_POST["DB_name"]?>" style='width: 400px; font-size: 50px;height:80px;'></p>
  <p><input type="submit" value="送信" style='font-size: 25px;width: 120px; height: 70px'></p>

<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!empty($_POST["DB_name"])) {

//    echo $_POST["DB_name"].",\n"."\n";//
    $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
    /////
//    echo "";
    if( $mysql->connect_errno){
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



    echo "<p style='font-size:30px;color:#FF0000;'> 正解の合計は $test2 です。不正解の合計は $test3 です。 <br>
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

    if (!$result) {error_log($mysqli->error);exit;}
    // $response[] = array();
    while($dat = $result->fetch_assoc()){
        $response[] = $dat['category1'];
    }

    $response = array_values(array_unique($response));
//    var_dump($response);
    $row_cnt = count($response);

    $sampleSelectBox = "<select name=\"category1\" onChange='listChange()' style='width: 200px; font-size: 25px;'>\n";
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

    $sampleSelectBox = "<select name=\"category2\" onChange='listChange()' style='width: 200px; font-size: 25px;'>\n";
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

    $sampleSelectBox = "<select name=\"category3\" onChange='listChange()' style='width: 200px; font-size: 25px;'>\n";

    for ( $i = -1; $i < $row_cnt; $i++ ) {
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
<select name='category4' onChange='listChange()' style="width: 200px; font-size: 25px;">
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator1'  onChange='listChange()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria1" value = "" style='width: 200px; font-size: 20px;'>
<br>
<select name='category5'  onChange='listChange()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator2'  onChange='listChange()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria2" value = "" style='width: 200px; font-size: 20px;'>
<br>
<select name='category6'  onChange='listChange()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='incorrect'>incorrect</option>
    <option value='correct'>correct </option>
    <option value='pca'>pca </option>
    <option value='qdate'>qdate</option>
    <option value='questionnumber'>questionnumber</option>
</select>
<select name='operator3'  onChange='listChange()' style='width: 200px; font-size: 25px;'>
    <option value='nul'> </option>
    <option value='='>=</option>
    <option value='>'>></option>
    <option value='<'><</option>
</select>
<input type="text" name="criteria3" value = "" style='width: 200px; font-size: 20px;'>
<br>
<div id="div0"></div>

<div class="questionbuttonbox" >
	<input type="checkbox" id = "qachange" style="font-size: 30px;">
	<font size="5" color="#000000" ;>問題/解答</font>&ensp; &ensp; &ensp;
	<span style="font-size: 30px;" id="press-button">0</span>
	<font size="5" color="#000000">問目</font>
	<input type="button" name="botan" id="button01" onClick="sendRequest();"value="問題" 
	style="position: absolute; left: 380px;width:200px;height:100px;font-size: 25px"><br>
</div>


<TEXTAREA id="textareas" style="width:570px;height:260px;" wrap="soft" style="visibility:hidden"></TEXTAREA>
<div id ="div1" class="img-container--precedo">
	<img id="mypic1" src="">
</div>
<br>

<div class="answerbuttonbox" >
	<input type="button" name="botan" id="button01" onClick="sendRequest2();" value="解答" 
	style="position: absolute; left: 380px;width:200px;height:100px; font-size: 25px"><br>
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
		       // alert("resは"+res);
		       questionnumbers = res.split(',');

		       //


				/** 重複チェック用配列 */

				/** 最小値と最大値 */
				max = questionnumbers.length-1;
			 }
			// alert(questionnumbers);


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

            var str01 = randoms + "///" + num +"///" + randoms[num] + "///" + questionnumbers[randoms[num]]
			// alert(str01);


	       // document.getElementById("textareas").value = questionnumbers[2];////
		}

		rand = questionnumbers[randoms[num]];


		// alert(num);
		/*alert(rand);*/
		// alert(questionnumbers[1]);

	    var doc0= document.getElementById("div0");
	    // doc0.innerHTML= rand;
	    var moji=rand + "." + document.mainform.DB_name.value;

//	    doc0.innerHTML= moji;

	    var xmlhttp=createXmlHttpRequest();
	    if(xmlhttp!=null)
	    {

	        xmlhttp.open("POST", "../"+phpfile1, false);//乱数をもとに問題を取得
	        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	        var data="data="+moji;
	//        var dataa="data="+moji;
	        xmlhttp.send(data);
	        //xmlhttp.send(dataa);

	        //var datata="data="+mojiji;
	        //xmlhttp.send(datata);

	        var res=xmlhttp.responseText;


            if (res.indexOf( "jpg" ) > 0) {
            document.getElementById("textareas").style.display = "none";
            document.getElementById("div1").style.display = "block";
            var imageadress =  res.split('\n');
            document.getElementById("mypic1").src='images/HS-MATH2B/' + imageadress[0];
            document.getElementById("mypic1").style.width = "700px";


            } else {
            document.getElementById("div1").style.display = "none";
            document.getElementById("textareas").style.display = "block";
            document.getElementById( "textareas" ).value = res ;////////
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
        document.getElementById( "textareas2" ).value = res;
        document.getElementById("div2").style.display = "none";
	    document.getElementById("textareas2").style.display = "block";
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
	// alert(flag1);
	num=0;
	// document.getElementById("press-button").innerHTML = num +"/"+ max;
	flag1 = false;
	// alert(flag1);
}
</script>

</body>
</html>
