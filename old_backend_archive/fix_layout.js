const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// Update CSS
c = c.replace('grid-template-columns: 1fr 1fr;', 'grid-template-columns: repeat(3, 1fr);');

// Add button05 CSS
c = c.replace('.msc-btn-next {', '.msc-btn-prev {\n    height: 64px;\n    font-size: 20px !important;\n    border-radius: 12px;\n    background: #64748b;\n    color: white;\n    border: none;\n    cursor: pointer;\n    font-weight: bold;\n}\n.msc-btn-prev:active { transform: translateY(2px); }\n.msc-btn-next {');

// Inject moveEl for button05
c = c.replace("moveEl('button01', actionsMain, 'msc-btn-next');", "moveEl('button05', actionsMain, 'msc-btn-prev');\n    moveEl('button01', actionsMain, 'msc-btn-next');");

fs.writeFileSync('sample020.php', c);
console.log("Done");
