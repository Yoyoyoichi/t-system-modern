const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const target = `      if (!questionnumbers || questionnumbers.length === 0) {
          // empty or error handling
          document.getElementById("totalQuestionNumber").innerHTML = 0;
      } else {
          document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }`;

const replacement = `      if (!questionnumbers || questionnumbers.length === 0) {
          // empty or error handling
          document.getElementById("totalQuestionNumber").innerHTML = "0";
          document.getElementById("textareas").value = "該当する問題がありません";
          const pressBtn = document.getElementById("press-button");
          if (pressBtn) pressBtn.innerHTML = "0/0";
          
          // update modern UI counter too
          const mscPress = document.getElementById('msc-press-button');
          const mscTotal = document.getElementById('msc-total');
          if (mscPress) mscPress.innerText = "0";
          if (mscTotal) mscTotal.innerText = "0";
          
          return; // 該当問題がない場合はここで処理を打ち切る
      } else {
          document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }`;

if (c.includes(target)) {
    c = c.replace(target, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log('SUCCESS');
} else {
    console.log('TARGET NOT FOUND');
    // Try regex
    const regex = /if \(!questionnumbers \|\| questionnumbers\.length === 0\) \{\s*\/\/ empty or error handling\s*document\.getElementById\("totalQuestionNumber"\)\.innerHTML = 0;\s*\} else \{\s*document\.getElementById\("totalQuestionNumber"\)\.innerHTML = questionnumbers\.length;\s*\}/g;
    if (regex.test(c)) {
        c = c.replace(regex, replacement);
        fs.writeFileSync('sample020.php', c);
        console.log('SUCCESS VIA REGEX');
    } else {
        console.log('STILL NOT FOUND');
    }
}
