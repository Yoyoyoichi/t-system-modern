const fs = require('fs');
const lines = fs.readFileSync('sample020.php', 'utf8').split('\n');
for (let i = 0; i < lines.length; i++) {
    if (lines[i].includes('bottomButtonBox')) {
        console.log('Line ' + i + ': ' + lines[i]);
    }
}
