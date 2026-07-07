const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8').replace(/\r\n/g, '\n');

const originalListChanged = `function listChanged(){
    firstRemoveFlag =false;
    // alert(flag1);
    num=-1;
    // document.getElementById("press-button").innerHTML = num +"/"+ max;
    flag1 = false;
    // alert(flag1);
  }`;

const newListChanged = `async function listChanged(){
    firstRemoveFlag = false;
    num = -1;
    flag1 = false;
    
    const infoEl = document.getElementById("questionInfo");
    if (infoEl) infoEl.innerHTML = "DB読み込み中... (Loading DB...)";
    
    questionnumbers = await fetchQuestionsFromSupabase();
    
    if (infoEl) infoEl.innerHTML = "DB読み込み完了。該当問題数: " + (questionnumbers ? questionnumbers.length : 0);
    const totalQEl = document.getElementById("totalQuestionNumber");
    if (totalQEl) totalQEl.innerHTML = (questionnumbers ? questionnumbers.length : 0);
    
    MaxQuestionNumber = questionnumbers ? questionnumbers.length : 0;
  }`;

if (c.includes(originalListChanged)) {
    c = c.replace(originalListChanged, newListChanged);
    fs.writeFileSync('sample020.php', c);
    console.log("listChanged rewritten successfully!");
} else {
    console.log("Could not find listChanged function to replace.");
}
