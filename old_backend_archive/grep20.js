const fs = require('fs');
const lines = fs.readFileSync('sample020.php', 'utf8').split('\n');
for(let i=0; i<lines.length; i++) {
    if(lines[i].includes('qlevel')) {
        console.log(lines.slice(i, i+15).join('\n'));
        break;
    }
}
