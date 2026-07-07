const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8').replace(/\r\n/g, '\n');

// 1. Fisher-Yates Shuffle
const target1 = `        for(i = min; i < questionnumbers.length; i++){\n          while(true){\n            // alert(i);\n            var tmp = intRandom(min, questionnumbers.length-1);\n            if(!randoms.includes(tmp)){\n              randoms.push(tmp);\n              break;\n            }\n          }\n        }`;
const replacement1 = `        for(i = min; i < questionnumbers.length; i++){ randoms.push(i); }\n        for(let j = randoms.length - 1; j > 0; j--) { const k = Math.floor(Math.random() * (j + 1)); [randoms[j], randoms[k]] = [randoms[k], randoms[j]]; }`;

const target2 = `          for(i = min; i < questionnumbers.length; i++){\n            while(true){\n              // alert(i);\n              var tmp = intRandom(min, questionnumbers.length-1);\n              if(!randoms.includes(tmp)){\n                randoms.push(tmp);\n                break;\n              }\n            }\n          }`;
const replacement2 = `          for(i = min; i < questionnumbers.length; i++){ randoms.push(i); }\n          for(let j = randoms.length - 1; j > 0; j--) { const k = Math.floor(Math.random() * (j + 1)); [randoms[j], randoms[k]] = [randoms[k], randoms[j]]; }`;

const target3 = `    for(i = min; i < max+1; i++){\n      while(true){\n        // alert(i);\n        var tmp = intRandom(min, max);\n        if(!randoms.includes(tmp)){\n          randoms.push(tmp);\n          break;\n        }\n      }\n    }`;
const replacement3 = `    for(i = min; i < max+1; i++){ randoms.push(i); }\n    for(let j = randoms.length - 1; j > 0; j--) { const k = Math.floor(Math.random() * (j + 1)); [randoms[j], randoms[k]] = [randoms[k], randoms[j]]; }`;

c = c.replace(target1, replacement1);
c = c.replace(target2, replacement2);
c = c.replace(target3, replacement3);


// 2. On-demand fetch (avoiding Japanese string literals via unicode escapes)
// "DB読み込み中... (Loading DB...)" -> \u0044\u0042\u8aad\u307f\u8fbc\u307f\u4e2d\u002e\u002e\u002e\u0020\u0028\u004c\u006f\u0061\u0064\u0069\u006e\u0067\u0020\u0044\u0042\u002e\u002e\u002e\u0029
// "DB読み込み完了。該当問題数: " -> \u0044\u0042\u8aad\u307f\u8fbc\u307f\u5b8c\u4e86\u3002\u8a72\u5f53\u554f\u984c\u6570\u003a\u0020
c = c.replace(/function\s*listChanged\(\)\{[\s\S]*?firstRemoveFlag\s*=\s*false;\s*\/\/\s*alert\(flag1\);\s*num=-1;\s*\/\/\s*document\.getElementById\("press-button"\)\.innerHTML\s*=\s*num\s*\+"\/"\+\s*max;\s*flag1\s*=\s*false;\s*\/\/\s*alert\(flag1\);\s*\}/,
  `async function listChanged(){
  firstRemoveFlag = false;
  num = -1;
  flag1 = false;
  
  const infoEl = document.getElementById("questionInfo");
  if (infoEl) infoEl.innerHTML = "\\u0044\\u0042\\u8aad\\u307f\\u8fbc\\u307f\\u4e2d\\u002e\\u002e\\u002e\\u0020\\u0028\\u004c\\u006f\\u0061\\u0064\\u0069\\u006e\\u0067\\u0020\\u0044\\u0042\\u002e\\u002e\\u002e\\u0029";
  
  questionnumbers = await fetchQuestionsFromSupabase();
  
  if (infoEl) infoEl.innerHTML = "\\u0044\\u0042\\u8aad\\u307f\\u8fbc\\u307f\\u5b8c\\u4e86\\u3002\\u8a72\\u5f53\\u554f\\u984c\\u6570\\u003a\\u0020" + (questionnumbers ? questionnumbers.length : 0);
  const totalQEl = document.getElementById("totalQuestionNumber");
  if (totalQEl) totalQEl.innerHTML = (questionnumbers ? questionnumbers.length : 0);
  
  MaxQuestionNumber = questionnumbers ? questionnumbers.length : 0;
}`);


// 3. Set Defaults for dropdowns safely (using Regex to avoid full Japanese matching if possible)
// Match "<option value=20 >...<\/option>"
c = c.replace(/<option value=20\s*>[^<]*<\/option>/, '<option value="" disabled>\\u554f\\u984c\\u6570</option><option value="20" selected>20</option>');
c = c.replace(/<option value="all">all<\/option>[\s\S]*?<option value=20>20<\/option>/, '<option value="all">all</option>'); // remove the duplicate 20

// Match "<option value=3 ...>...<\/option>" for NOC
c = c.replace(/<option value=3 style='width: 23%' placeholder="[^"]*">[^<]*<\/option>/, '<option value="" disabled>\\u6700\\u4f4e\\u6b63\\u89e3\\u6570</option><option value="3" selected>3</option>');
c = c.replace(/<option value=2>2<\/option>[\s\S]*?<option value=3>3<\/option>/, '<option value=2>2</option>'); // remove duplicate 3

// Add meta charset
c = c.replace('<head>', '<head>\\n<meta charset="UTF-8">');

fs.writeFileSync('sample020.php', c);
console.log("Done");
