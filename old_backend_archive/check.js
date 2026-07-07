const fs = require('fs');
const c = fs.readFileSync('sample020.php', 'utf8');
console.log(c.match(/<input[^>]*type=["']checkbox["'][^>]*>/gi));
