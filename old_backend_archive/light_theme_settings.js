const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// 1. Panel Background
c = c.replace(/background: rgba\(15, 23, 42, 0\.7\);/g, 'background: #f8fafc;');
c = c.replace(/backdrop-filter: blur\(12px\);/g, ''); // not needed for light grey
c = c.replace(/border: 1px solid rgba\(255, 255, 255, 0\.1\);/g, 'border: 1px solid #e2e8f0;');
c = c.replace(/box-shadow: 0 8px 32px rgba\(0, 0, 0, 0\.3\);/g, 'box-shadow: none;');
c = c.replace(/color: #f1f5f9;/g, 'color: #334155;');

// 2. Header and Text
c = c.replace(/border-bottom: 1px solid rgba\(255, 255, 255, 0\.1\);/g, 'border-bottom: 1px solid #e2e8f0;');
c = c.replace(/color: #e2e8f0;/g, 'color: #0f172a;');
c = c.replace(/color: #94a3b8;/g, 'color: #64748b;'); // some subtitles maybe

// 3. Select and Input
c = c.replace(/background: rgba\(30, 41, 59, 0\.8\);/g, 'background: #ffffff;');
c = c.replace(/border: 1px solid rgba\(255, 255, 255, 0\.2\);/g, 'border: 1px solid #cbd5e1;');
c = c.replace(/color: #fff;/g, 'color: #1e293b;');
c = c.replace(/border-color: rgba\(255, 255, 255, 0\.4\);/g, 'border-color: #94a3b8;');
c = c.replace(/background: #1e293b;/g, 'background: #ffffff;'); // for option tags
c = c.replace(/color: #cbd5e1;/g, 'color: #334155;'); // labels

// 4. Checkbox
c = c.replace(/border: 2px solid rgba\(255, 255, 255, 0\.3\);/g, 'border: 2px solid #cbd5e1;');
// The :checked state has background: #3b82f6; which is blue, but maybe that's fine. 
// Or I can change it to a more subdued color like #111 to match modern-top-panel buttons.
c = c.replace(/background: #3b82f6;/g, 'background: #111111;');
c = c.replace(/border-color: #3b82f6;/g, 'border-color: #111111;');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
