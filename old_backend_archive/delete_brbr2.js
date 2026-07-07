const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/<br><br>/g, '');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS: Deleted ALL <br><br> tags directly from the HTML.");
