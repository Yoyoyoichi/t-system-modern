const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/;margin:30px 0px 0px 0px/g, '');
c = c.replace(/margin:30px 0px 0px 0px/g, '');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
