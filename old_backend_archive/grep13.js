const fs = require('fs');
const lines = fs.readFileSync('sample020.php', 'utf8').split('\n');
for (let i = 0; i < lines.length; i++) {
    if (lines[i].includes('id="qachange"') || lines[i].includes('id = "qachange"')) {
        console.log(i + ': ' + lines[i]);
    }
}
