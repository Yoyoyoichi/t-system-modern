const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// 1. Remove literal "\n" strings that are showing up in the UI
c = c.replace(/^\\n$/gm, '');

// 2. Fix pitch black hover buttons
c = c.replace(/\.msc-btn-good:hover \{ background: #111111 !important; transform: translateY\(-1px\); \}/, '.msc-btn-good:hover { background: #f4f4f5 !important; border-color: #cccccc !important; transform: translateY(-1px); }');
c = c.replace(/\.msc-btn-poor:hover \{ background: #111111 !important; transform: translateY\(-1px\); \}/, '.msc-btn-poor:hover { background: #f4f4f5 !important; border-color: #cccccc !important; transform: translateY(-1px); }');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
