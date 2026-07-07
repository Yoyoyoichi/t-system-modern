const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

content = content.replace('<link rel="stylesheet" href="styles.css">', '<link rel="stylesheet" href="styles.css?v=2">');

fs.writeFileSync(file, content);
console.log("Cache busted.");
