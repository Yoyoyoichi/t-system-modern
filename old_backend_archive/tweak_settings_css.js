const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/margin-top: 48px;\r?\n    background: rgba\(15, 23, 42, 0\.7\);/g, 'margin-top: 24px;\n    background: rgba(15, 23, 42, 0.7);');
c = c.replace(/margin: 32px auto;/g, 'margin: 24px auto 0 auto;');
c = c.replace(/width: 95%;/g, 'width: 100%;');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS: Tweaked settings panel CSS for top panel fitting.");
