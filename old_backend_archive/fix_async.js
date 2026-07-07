const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/async async function/g, 'async function');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
