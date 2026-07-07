const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// Add .msc-btn-undo to CSS
const cssTarget = /\.msc-btn-nav:hover \{ background: #475569 !important; transform: translateY\(-1px\); \}/;
const cssReplacement = `.msc-btn-nav:hover { background: #475569 !important; transform: translateY(-1px); }
.msc-btn-undo { background: #f59e0b !important; color: #fff !important; }
.msc-btn-undo:hover { background: #d97706 !important; transform: translateY(-1px); }`;

// Add button06 and button07 to JS
const jsTarget = /document\.querySelectorAll\('input\[name="botan05"\]'\)\.forEach\(btn => \{[\s\S]*?feedbackArea\.appendChild\(btn\);\s*\}\);\s*studyCard\.appendChild\(feedbackArea\);/;
const jsReplacement = `document.querySelectorAll('input[name="botan05"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-feedback msc-btn-nav';
        feedbackArea.appendChild(btn);
    });

    const b06 = document.getElementById('button06');
    if (b06) {
        b06.removeAttribute('style');
        b06.className = 'msc-btn-feedback msc-btn-undo';
        feedbackArea.appendChild(b06);
    }
    
    const b07 = document.getElementById('button07');
    if (b07) {
        b07.removeAttribute('style');
        b07.className = 'msc-btn-feedback msc-btn-undo';
        feedbackArea.appendChild(b07);
    }

    studyCard.appendChild(feedbackArea);`;

if (cssTarget.test(c) && jsTarget.test(c)) {
    c = c.replace(cssTarget, cssReplacement);
    c = c.replace(jsTarget, jsReplacement);
    fs.writeFileSync('sample020.php', c);
    console.log('SUCCESS');
} else {
    console.log('FAILED');
    if (!cssTarget.test(c)) console.log('CSS target not found');
    if (!jsTarget.test(c)) console.log('JS target not found');
}
