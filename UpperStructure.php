<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>
<style type="text/css">
</style>
<body>
<!-- <select class="selectBox" name='' id='chordKey'　 style='width:5vw;height:3vh; font-size: 20px"'>
  <option value='0' selected></option>
  <option value='0'>C</option>
  <option value='1'>C#</option>
  <option value='2'>D</option>
  <option value='3'>E♭</option>
  <option value='4'>E</option>
  <option value='5'>F</option>
  <option value='6'>F#</option>
  <option value='7'>G</option>
  <option value='8'>A♭</option>
  <option value='9'>A</option>
  <option value='10'>B♭</option>
  <option value='11'>B</option>
</select> -->
<select class="selectBox" name='' id='note1' 　 style='width:5vw;height:3vh; font-size: 20px"'>
  <option value='' selected></option>
  <option value='0'>R</option>
  <option value='1'>b9</option>
  <option value='2'>9</option>
  <option value='3'>#9/m3</option>
  <option value='4'>M3</option>
  <option value='5'>11</option>
  <option value='6'>b5/#11</option>
  <option value='7'>5</option>
  <option value='8'>#5/b13</option>
  <option value='9'>13</option>
  <option value='10'>b7</option>
  <option value='11'>M7</option>
</select>
<select class="selectBox" name='' id='note2' 　 style='width:5vw;height:3vh; font-size: 20px"'>
<option value='' selected></option>
  <option value='0'>R</option>
  <option value='1'>b9</option>
  <option value='2'>9</option>
  <option value='3'>#9/m3</option>
  <option value='4'>M3</option>
  <option value='5'>11</option>
  <option value='6'>b5/#11</option>
  <option value='7'>5</option>
  <option value='8'>#5/b13</option>
  <option value='9'>13</option>
  <option value='10'>b7</option>
  <option value='11'>M7</option>
</select>
<select class="selectBox" name='' id='note3' 　 style='width:5vw;height:3vh; font-size: 20px"'>
<option value='' selected></option>
  <option value='0'>R</option>
  <option value='1'>b9</option>
  <option value='2'>9</option>
  <option value='3'>#9/m3</option>
  <option value='4'>M3</option>
  <option value='5'>11</option>
  <option value='6'>b5/#11</option>
  <option value='7'>5</option>
  <option value='8'>#5/b13</option>
  <option value='9'>13</option>
  <option value='10'>b7</option>
  <option value='11'>M7</option>
</select>
<select class="selectBox" name='' id='note4' 　 style='width:5vw;height:3vh; font-size: 20px"'>
<option value='' selected></option>
  <option value='0'>R</option>
  <option value='1'>b9</option>
  <option value='2'>9</option>
  <option value='3'>#9/m3</option>
  <option value='4'>M3</option>
  <option value='5'>11</option>
  <option value='6'>b5/#11</option>
  <option value='7'>5</option>
  <option value='8'>#5/b13</option>
  <option value='9'>13</option>
  <option value='10'>b7</option>
  <option value='11'>M7</option>
</select>
<select class="selectBox" name='' id='note5' 　 style='width:5vw;height:3vh; font-size: 20px"'>
<option value='' selected></option>
  <option value='0'>R</option>
  <option value='1'>b9</option>
  <option value='2'>9</option>
  <option value='3'>#9/m3</option>
  <option value='4'>M3</option>
  <option value='5'>11</option>
  <option value='6'>b5/#11</option>
  <option value='7'>5</option>
  <option value='8'>#5/b13</option>
  <option value='9'>13</option>
  <option value='10'>b7</option>
  <option value='11'>M7</option>
</select>
<input class ="button" type="button" id="showResultButton" onClick="showResult()" 
value="ShowResult"  style=" width:15vw;height:5vh; font-size: 15px">
<div id ='result'></div>
<br>
<div id ='result2'></div>
<script type="text/javascript">
// const noteName = new Array('C','B','B♭','A','A♭','G','F#','F','E','E♭','D','C#','C')
// const noteName2 = new Array('C','C#','D','E♭','E','F','F#','G','A♭','A','B♭','B','C')
const noteName = new Array('R','♭9','9','#9/m3','M3','11','♭5/#11','5','#5/♭13','13','♭7','M7','R')
noteName2 = new Array('R','♭9','9','#9/m3','M3','11','♭5/#11','5','#5/♭13','13','♭7','M7','R')
noteName2 = noteName2.reverse();
const noteInterval = new Array('R','♭9','9','#9/m3','M3','11','♭5/#11','5','#5/♭13','13','♭7','M7')
function showResult(){
  document.getElementById("result").innerHTML = '';
  var notes = new Array();
  for (let i = 1; i < 6; i++) {
    notes[i-1] = document.getElementById("note"+i).value;  
  }
  notes = notes.filter(Boolean);
  // var key = Number(document.getElementById("chordKey").value)
  var key = 0;
  // for (let i = 12; i > 0; i--) {
  //   var text ='';
  //   var text2='';
  //   text = noteName[i]+' → ';
  //   console.log(noteName[i]+'→ ' )
  //   for (let j = 0; j < notes.length; j++) {
  //     let num = (Number(notes[j]) + key + i) % 12;
  //     if (!text2) {
  //       text2 = noteInterval[num];
  //     }else{
  //       text2 = text2 +', ' + noteInterval[num];
  //     }
      
  //     console.log(noteInterval[num] +' ' );
  //   }
  //   document.getElementById("result").innerHTML = document.getElementById("result").innerHTML + '<br>' + text + text2
  // }
  for (let i = 0; i < 12; i++) {
    var text ='';
    var text2='';
    // 新しいHTML要素を作成
    var new_element = document.createElement('div');
    new_element.style.width ='700px';
    new_element.className = 'rootAndChord';
    new_element.style.border = 'solid 1px black';
    new_element.style.margin = '1px';
    document.getElementById("result").appendChild(new_element)
    var new_child = document.createElement('div');
    new_child.textContent = noteName[i];
    new_child.style.display ='inline-block';
    new_child.style.width ='100px';
    new_element.appendChild(new_child)
    var new_child = document.createElement('div');
    new_child.textContent = ' → ';
    new_child.style.display ='inline-block';
    new_child.style.width ='100px';
    new_element.appendChild(new_child)
    // text = noteName[i]+' → ';
    // console.log(noteName[i]+'→ ' )
    for (let j = 0; j < notes.length; j++) {
      let num = (Number(notes[j]) + key + i) % 12;
      // if (!text2) {
      new_child = document.createElement('div');
      new_child.textContent = noteInterval[num];
      new_child.style.display ='inline-block';
      new_child.style.width ='100px';
      // text2 = noteInterval[num];
      new_element.appendChild(new_child)
      // }else{
      //   text2 = text2 +', ' + noteInterval[num];
      // }
      
      // console.log(noteInterval[num] +' ' );
    }
    // document.getElementById("result2").appendChild(new_element)
  }

  document.getElementById("result2").innerHTML = '';
  var notes = new Array();
  for (let i = 1; i < 6; i++) {
    notes[i-1] = document.getElementById("note"+i).value;  
  }
  notes = notes.filter(Boolean);
  // var key = Number(document.getElementById("chordKey").value)
  var key = 0;

  
  for (let i = 12; i > 0; i--) {
    var text ='';
    var text2='';
    // 新しいHTML要素を作成
    var new_element = document.createElement('div');
    new_element.style.width ='700px';
    new_element.className = 'rootAndChord';
    new_element.style.border = 'solid 1px black';
    new_element.style.margin = '1px';
    document.getElementById("result2").appendChild(new_element)
    var new_child = document.createElement('div');
    new_child.textContent = noteName[i];
    new_child.style.display ='inline-block';
    new_child.style.width ='100px';
    new_element.appendChild(new_child)
    var new_child = document.createElement('div');
    new_child.textContent = ' → ';
    new_child.style.display ='inline-block';
    new_child.style.width ='100px';
    new_element.appendChild(new_child)
    // text = noteName[i]+' → ';
    // console.log(noteName[i]+'→ ' )
    for (let j = 0; j < notes.length; j++) {
      let num = (Number(notes[j]) + key + i) % 12;
      // if (!text2) {
      new_child = document.createElement('div');
      new_child.textContent = noteInterval[num];
      new_child.style.display ='inline-block';
      new_child.style.width ='100px';
      // text2 = noteInterval[num];
      new_element.appendChild(new_child)
      // }else{
      //   text2 = text2 +', ' + noteInterval[num];
      // }
      
      // console.log(noteInterval[num] +' ' );
    }
    // document.getElementById("result2").appendChild(new_element)
  }
}

</script>
<?php
  
?>
</body>
</html>