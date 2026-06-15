<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>
<style type="text/css">
</style>
<body>
	<input class ="button" type="input" name="sentencePattern" id="sentencePattern" onChange="selectPattern()" 
	value=""  style=" width:10vw;height:3vh; font-size: 20px">
	<br>
	<div id= "SentencePatternInfo" class = "SentencePatternInfo"></div>
<script type="text/javascript">
function selectPattern(){
	var moji= document.getElementById('sentencePattern').value;
  moji = encodeURIComponent(moji);
  // console.log(moji);
  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    // console.log("3");
    xmlhttp.open("POST", "../getSentencePatternInfo.php", false);//
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data=" + moji;
    // console.log("2.1");
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
    var res=res.split('^^^^^');
    document.getElementById("SentencePatternInfo").innerHTML = res[1];
  }
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

</script>
<?php?>
	
</body>
</html>