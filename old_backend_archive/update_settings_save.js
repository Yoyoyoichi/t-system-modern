const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const regex = /async function settingSave\(\)\{\s*let settings = \{\s*fontresize: document\.getElementById\("fontresize"\)\.value,[\s\S]*?localStorage\.setItem\('t_system_settings', JSON\.stringify\(settings\)\);\s*\}/;

const originalSettingSave = `function settingSave(){
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
    xmlhttp.open("POST", "../settingSave.php", false);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
  }
}`;

if (regex.test(c)) {
    c = c.replace(regex, originalSettingSave);
    fs.writeFileSync('sample020.php', c);
    console.log('SUCCESS');
} else {
    console.log('FAILED');
}
