const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/\\n<meta charset="UTF-8">/g, '<meta charset="UTF-8">');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
