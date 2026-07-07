const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const regex = /if \(response\[6\]\) \{\s*document\.getElementById\("NOC"\)\.value = Number\(response\[6\]\);\s*\}/;

const replacement = `if (response[6]) {
  let savedVal = Number(response[6]);
  // 過去の保存データが何であれ、ユーザーの要望により強制的に3をセットする
  savedVal = 3; 
  document.getElementById("NOC").value = savedVal;
}`;

if (regex.test(c)) {
    c = c.replace(regex, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log('SUCCESS');
} else {
    console.log('FAILED');
}
