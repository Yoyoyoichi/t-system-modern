const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/\.msc-btn-primary\.msc-btn-huge \{\n\s*background: #111111 !important;\n\s*color: #fff !important;\n\}/g, 
`.msc-btn-primary.msc-btn-huge {
    background: #ffffff !important;
    color: #111111 !important;
    border: 1px solid #dddddd !important;
}`);

c = c.replace(/\.msc-btn-primary\.msc-btn-huge:hover \{\n\s*background: #333333 !important;\n\s*transform: translateY\(-2px\);\n\}/g, 
`.msc-btn-primary.msc-btn-huge:hover {
    background: #f4f4f5 !important;
    border-color: #cccccc !important;
    transform: translateY(-2px);
}`);

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
