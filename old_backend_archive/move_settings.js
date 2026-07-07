const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const regex = /topPanel\.appendChild\(unifiedContainer\);/;
const replacement = `topPanel.appendChild(unifiedContainer);\n        \n        const settingsPanel = document.querySelector('.msc-settings-panel');\n        if (settingsPanel) topPanel.appendChild(settingsPanel);`;

if (regex.test(c)) {
    c = c.replace(regex, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS: Moved msc-settings-panel inside modern-top-panel.");
} else {
    console.log("FAILED to find insertion point.");
}
