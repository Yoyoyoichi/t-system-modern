const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// 1. Fix .button / submit hover (change #111 to #f4f4f5)
c = c.replace(/\.button:hover,\s*input\[type="button"\]:hover,\s*input\[type="submit"\]:hover\s*\{\s*background-color: #111;\s*color: #fff !important;\s*border-color: #111;\s*\}/, 
`.button:hover, input[type="button"]:hover, input[type="submit"]:hover {
    background-color: #f4f4f5;
    color: #111 !important;
    border-color: #ccc;
}`);

// 2. Fix .msc-btn-primary.msc-btn-huge (Change #111111 background to white with black text, hover to gray)
c = c.replace(/\.msc-btn-primary\.msc-btn-huge\s*\{\s*background: #111111 !important;\s*color: #fff !important;\s*border: 1px solid #111111 !important;\s*\}/, 
`.msc-btn-primary.msc-btn-huge {
    background: #ffffff !important;
    color: #111111 !important;
    border: 1px solid #dddddd !important;
}`);

c = c.replace(/\.msc-btn-primary\.msc-btn-huge:hover\s*\{\s*background: #333333 !important;\s*border-color: #333333 !important;\s*transform: translateY\(-2px\);\s*\}/, 
`.msc-btn-primary.msc-btn-huge:hover {
    background: #f4f4f5 !important;
    border-color: #cccccc !important;
    transform: translateY(-2px);
}`);

// Also fix msc-btn-nav and msc-btn-undo hover if they are pitch black
c = c.replace(/\.msc-btn-nav:hover \{ background: #111111 !important; color: #ffffff !important; transform: translateY\(-1px\); \}/, 
'.msc-btn-nav:hover { background: #f4f4f5 !important; color: #111111 !important; border-color: #cccccc !important; transform: translateY(-1px); }');

c = c.replace(/\.msc-btn-undo:hover \{ background: #111111 !important; color: #ffffff !important; transform: translateY\(-1px\); \}/, 
'.msc-btn-undo:hover { background: #f4f4f5 !important; color: #111111 !important; border-color: #cccccc !important; transform: translateY(-1px); }');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
