const fs = require('fs');
const lines = fs.readFileSync('sample020.php', 'utf8').split('\n');
for (let i = 0; i < lines.length; i++) {
    if (lines[i].includes('name=\'autoReading\'') || lines[i].includes('name="autoReading"')) {
        console.log(i + ': ' + lines[i]);
    }
}
