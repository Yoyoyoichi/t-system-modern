const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// 1. Remove background image and set background to #f4f4f5 (light gray)
c = c.replace(/background: url\(RRice-colorful-wall\.jpg\);/g, 'background: #f4f4f5;');

// 2. Pink/Green legacy boxes
c = c.replace(/background-color:\s*#ffccff;/g, 'background-color: #ffffff;');
c = c.replace(/border: 2px solid #0a0;/g, 'border: 1px solid #ccc;');

// 3. Cyan midbuttonbox
c = c.replace(/color:\s*#00BCD4;/g, 'color: #333333;');
c = c.replace(/background:\s*#e4fcff;/g, 'background: #f4f4f5;');

// 4. Botan 03/04 (Legacy Green/Red inline classes)
c = c.replace(/color:\s*#0d8a4e !important;/g, 'color: #111111 !important;');
c = c.replace(/border-color:\s*#0d8a4e;/g, 'border-color: #111111;');
c = c.replace(/background-color:\s*#0d8a4e;/g, 'background-color: #f4f4f5;');
c = c.replace(/color:\s*#e53935 !important;/g, 'color: #111111 !important;');
c = c.replace(/border-color:\s*#e53935;/g, 'border-color: #111111;');
c = c.replace(/background-color:\s*#e53935;/g, 'background-color: #f4f4f5;');
c = c.replace(/border-bottom-color:\s*#0d8a4e !important;/g, 'border-bottom-color: #111111 !important;');

// 5. Modern Stats (Light blue)
c = c.replace(/background:\s*#e0f2fe;/g, 'background: #ffffff;');
c = c.replace(/border-color:\s*#bae6fd;/g, 'border-color: #e2e8f0;');
c = c.replace(/color:\s*#0369a1 !important;/g, 'color: #111111 !important;');
c = c.replace(/background:\s*#bae6fd;/g, 'background: #f1f5f9;');
c = c.replace(/border-color:\s*#7dd3fc;/g, 'border-color: #cbd5e1;');

// 6. Huge buttons (Sky blue)
c = c.replace(/background:\s*#0ea5e9 !important;/g, 'background: #111111 !important;');
c = c.replace(/background:\s*#0284c7 !important;/g, 'background: #333333 !important;');

// 7. Dark Green & Red Hover (Good / Poor)
c = c.replace(/background:\s*#059669 !important;/g, 'background: #111111 !important;');
c = c.replace(/background:\s*#dc2626 !important;/g, 'background: #111111 !important;');

// 8. Nav & Undo buttons (Slate & Orange)
c = c.replace(/\.msc-btn-nav \{ background: #64748b !important; color: #fff !important; \}/, '.msc-btn-nav { background: #ffffff !important; color: #111111 !important; border: 1px solid #dddddd !important; }');
c = c.replace(/\.msc-btn-nav:hover \{ background: #475569 !important; transform: translateY\(-1px\); \}/, '.msc-btn-nav:hover { background: #111111 !important; color: #ffffff !important; transform: translateY(-1px); }');
c = c.replace(/\.msc-btn-undo \{ background: #f59e0b !important; color: #fff !important; \}/, '.msc-btn-undo { background: #ffffff !important; color: #111111 !important; border: 1px solid #dddddd !important; }');
c = c.replace(/\.msc-btn-undo:hover \{ background: #d97706 !important; transform: translateY\(-1px\); \}/, '.msc-btn-undo:hover { background: #111111 !important; color: #ffffff !important; transform: translateY(-1px); }');

// 9. Form Focus Border and Checkboxes (Blue -> Black/Gray)
c = c.replace(/border-color:\s*#3b82f6;/g, 'border-color: #111111;');
c = c.replace(/box-shadow: 0 0 0 4px rgba\(59, 130, 246, 0\.1\);/g, 'box-shadow: 0 0 0 4px rgba(17, 17, 17, 0.1);');
c = c.replace(/background:\s*#3b82f6;/g, 'background: #111111;');

// 10. Study Card and Settings Panel Backgrounds (Slate Dark Theme -> Light/Monochrome)
// msc-settings-panel
c = c.replace(/background: rgba\(15, 23, 42, 0\.7\);/g, 'background: #ffffff;');
c = c.replace(/backdrop-filter: blur\(12px\);/g, ''); 
c = c.replace(/border: 1px solid rgba\(255, 255, 255, 0\.1\);/g, 'border: 1px solid #e2e8f0;');
c = c.replace(/box-shadow: 0 8px 32px rgba\(0, 0, 0, 0\.3\);/g, 'box-shadow: 0 4px 6px rgba(0,0,0,0.05);');
c = c.replace(/color:\s*#f1f5f9;/g, 'color: #111111;');
c = c.replace(/border-bottom: 1px solid rgba\(255, 255, 255, 0\.1\);/g, 'border-bottom: 1px solid #e2e8f0;');
c = c.replace(/color:\s*#e2e8f0;/g, 'color: #111111;');

c = c.replace(/background: rgba\(30, 41, 59, 0\.8\);/g, 'background: #ffffff;');
c = c.replace(/border: 1px solid rgba\(255, 255, 255, 0\.2\);/g, 'border: 1px solid #cbd5e1;');
c = c.replace(/border-color: rgba\(255, 255, 255, 0\.4\);/g, 'border-color: #111111;');
c = c.replace(/background: rgba\(255, 255, 255, 0\.1\);/g, 'background: #e2e8f0;');
c = c.replace(/border: 2px solid rgba\(255, 255, 255, 0\.3\);/g, 'border: 2px solid #cbd5e1;');

// For the study card buttons that were left dark/colored
c = c.replace(/\.msc-btn-good \{ background: #10b981 !important; color: #fff !important; \}/, '.msc-btn-good { background: #ffffff !important; color: #111111 !important; border: 1px solid #dddddd !important; }');
c = c.replace(/\.msc-btn-poor \{ background: #ef4444 !important; color: #fff !important; \}/, '.msc-btn-poor { background: #ffffff !important; color: #111111 !important; border: 1px solid #dddddd !important; }');

// Clean up remaining blue accents
c = c.replace(/color:\s*#34d399;/g, 'color: #111111;');
c = c.replace(/color:\s*#f87171;/g, 'color: #111111;');
c = c.replace(/color:\s*#cbd5e1;/g, 'color: #334155;'); // Make grey text legible on white background

// Let's also check for any dark theme textareas inside settings
c = c.replace(/\.msc-select option \{\n\s*background: #1e293b;\n\s*color: #fff;\n\}/g, '.msc-select option {\n    background: #ffffff;\n    color: #111111;\n}');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
