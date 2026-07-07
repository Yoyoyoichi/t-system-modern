const fs = require('fs');
const c = fs.readFileSync('sample020.php', 'utf8');
const start = c.indexOf('<div id="bottomButtonBox"');
console.log(c.substring(start, start + 1000));
