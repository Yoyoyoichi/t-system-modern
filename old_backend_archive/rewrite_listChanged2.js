const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/function\s*listChanged\(\)\{\s*firstRemoveFlag\s*=\s*false;\s*\/\/\s*alert\(flag1\);\s*num=-1;\s*\/\/\s*document\.getElementById\("press-button"\)\.innerHTML\s*=\s*num\s*\+"\/"\+\s*max;\s*flag1\s*=\s*false;\s*\/\/\s*alert\(flag1\);\s*\}/,
  `async function listChanged(){
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
}`);

fs.writeFileSync('sample020.php', c);
console.log("Done");
