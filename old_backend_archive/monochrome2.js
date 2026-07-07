const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/\.msc-btn-primary\.msc-btn-huge \{[\s\S]*?\}/, `.msc-btn-primary.msc-btn-huge {
    background: #111111 !important;
    color: #ffffff !important;
    border: 1px solid #111111 !important;
}`);

c = c.replace(/\.msc-btn-primary\.msc-btn-huge:hover \{[\s\S]*?\}/, `.msc-btn-primary.msc-btn-huge:hover {
    background: #333333 !important;
    border-color: #333333 !important;
    transform: translateY(-2px);
}`);

c = c.replace(/\.msc-btn-secondary\.msc-btn-huge \{[\s\S]*?\}/, `.msc-btn-secondary.msc-btn-huge {
    background: #ffffff !important;
    color: #111111 !important;
    border: 1px solid #dddddd !important;
}`);

c = c.replace(/\.msc-btn-secondary\.msc-btn-huge:hover \{[\s\S]*?\}/, `.msc-btn-secondary.msc-btn-huge:hover {
    background: #f4f4f5 !important;
    border-color: #cccccc !important;
    transform: translateY(-2px);
}`);

c = c.replace(/\.msc-btn-nav \{ background: #64748b !important; color: #fff !important; \}/, 
    '.msc-btn-nav { background: #ffffff !important; color: #111111 !important; border: 1px solid #dddddd !important; }');
c = c.replace(/\.msc-btn-nav:hover \{ background: #475569 !important; transform: translateY\(-1px\); \}/, 
    '.msc-btn-nav:hover { background: #111111 !important; color: #ffffff !important; border-color: #111111 !important; transform: translateY(-1px); }');

c = c.replace(/\.msc-btn-undo \{ background: #f59e0b !important; color: #fff !important; \}/, 
    '.msc-btn-undo { background: #ffffff !important; color: #111111 !important; border: 1px solid #dddddd !important; }');
c = c.replace(/\.msc-btn-undo:hover \{ background: #d97706 !important; transform: translateY\(-1px\); \}/, 
    '.msc-btn-undo:hover { background: #111111 !important; color: #ffffff !important; border-color: #111111 !important; transform: translateY(-1px); }');

// Also fix the feedback row background
c = c.replace(/\.msc-feedback-row \{\n    padding: 16px 24px;\n    background: #f1f5f9;/, 
    `.msc-feedback-row {\n    padding: 16px 24px;\n    background: #ffffff;\n    border-top: 1px solid #eaeaea;`);

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
