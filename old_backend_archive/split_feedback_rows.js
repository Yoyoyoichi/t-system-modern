const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const jsTarget = /document\.querySelectorAll\('input\[name="botan05"\]'\)\.forEach\([\s\S]*?studyCard\.appendChild\(feedbackArea\);/;

const jsReplacement = `studyCard.appendChild(feedbackArea);

    // 8. Create Utility Buttons Area (Back / Skip / Minus)
    const utilityArea = document.createElement('div');
    utilityArea.className = 'msc-actions-row msc-utility-row';

    document.querySelectorAll('input[name="botan05"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-feedback msc-btn-nav';
        utilityArea.appendChild(btn);
    });

    const b06 = document.getElementById('button06');
    if (b06) {
        b06.removeAttribute('style');
        b06.className = 'msc-btn-feedback msc-btn-undo';
        utilityArea.appendChild(b06);
    }
    
    const b07 = document.getElementById('button07');
    if (b07) {
        b07.removeAttribute('style');
        b07.className = 'msc-btn-feedback msc-btn-undo';
        utilityArea.appendChild(b07);
    }

    studyCard.appendChild(utilityArea);`;

const cssTarget = /\.msc-feedback-row \{[\s\S]*?justify-content: center;\s*\}/;
const cssReplacement = `.msc-feedback-row {
    padding: 16px 24px;
    background: #f1f5f9;
    flex-wrap: wrap;
    justify-content: center;
    border-radius: 0 !important;
}
.msc-utility-row {
    padding: 16px 24px;
    background: #f8fafc;
    flex-wrap: wrap;
    justify-content: center;
}`;

if (jsTarget.test(c)) {
    c = c.replace(jsTarget, jsReplacement);
    if (cssTarget.test(c)) {
        c = c.replace(cssTarget, cssReplacement);
    }
    fs.writeFileSync('sample020.php', c);
    console.log('SUCCESS');
} else {
    console.log('FAILED');
}
