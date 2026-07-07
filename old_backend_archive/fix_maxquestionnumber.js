const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const target = 'MaxQuestionNumber = questionnumbers ? questionnumbers.length : 0;';
const replacement = `let ddl = document.getElementById('MaxQuestionNumber');
  if (ddl && ddl.value && ddl.value !== 'all' && !isNaN(Number(ddl.value))) {
    MaxQuestionNumber = Number(ddl.value);
    max = MaxQuestionNumber;
  } else {
    MaxQuestionNumber = questionnumbers ? questionnumbers.length : 0;
  }`;

c = c.replace(target, replacement);

fs.writeFileSync('sample020.php', c);
console.log('Fixed listChanged MaxQuestionNumber logic');
