const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const regex = /if \(response\[0\]\) \{\s*if \(response\[0\]==="all"\)\{\s*document\.getElementById\("MaxQuestionNumber"\)\.value = "all"\s*\} else \{\s*document\.getElementById\("MaxQuestionNumber"\)\.value = Number\(response\[0\]\);\s*\}\s*\}/;

const replacement = `if (response[0]) {
  if (response[0]==="all"){
    document.getElementById("MaxQuestionNumber").value = "all"
  } else {
    let savedVal = Number(response[0]);
    if (savedVal === 30 || savedVal === 0 || savedVal === 35 || savedVal === 25) savedVal = 20; // Force 20
    document.getElementById("MaxQuestionNumber").value = savedVal;
  }
}`;

if (regex.test(c)) {
    c = c.replace(regex, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log('SUCCESS');
} else {
    console.log('FAILED');
}
