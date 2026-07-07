const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/\.msc-btn-primary\.msc-btn-huge\s*\{[\s\S]*?\}/g, 
`.msc-btn-primary.msc-btn-huge {
    background: #ffffff !important;
    color: #111111 !important;
    border: 1px solid #dddddd !important;
}`);

c = c.replace(/\.msc-btn-primary\.msc-btn-huge:hover\s*\{[\s\S]*?\}/g, 
`.msc-btn-primary.msc-btn-huge:hover {
    background: #f4f4f5 !important;
    border-color: #cccccc !important;
    transform: translateY(-2px);
}`);

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
