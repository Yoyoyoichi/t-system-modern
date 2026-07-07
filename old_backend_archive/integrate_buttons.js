const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const cssTarget = /\.msc-answer \{\s*padding: 32px;\s*\}/;
const cssReplacement = `.msc-answer {
    padding: 32px;
}
.msc-actions-row {
    padding: 24px;
    display: flex;
    gap: 16px;
    border-top: 1px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 0 0 12px 12px;
}
.msc-btn-huge {
    flex: 1;
    height: 80px;
    font-size: 28px !important;
    font-weight: 700;
    border-radius: 12px;
    cursor: pointer;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
.msc-btn-primary.msc-btn-huge {
    background: #0ea5e9 !important;
    color: #fff !important;
}
.msc-btn-primary.msc-btn-huge:hover {
    background: #0284c7 !important;
    transform: translateY(-2px);
}
.msc-btn-secondary.msc-btn-huge {
    background: #fff !important;
    color: #0f172a !important;
    border: 2px solid #cbd5e1 !important;
}
.msc-btn-secondary.msc-btn-huge:hover {
    background: #f8fafc !important;
    border-color: #94a3b8 !important;
    transform: translateY(-2px);
}`;

const jsTarget = /studyCard\.appendChild\(cardAnswer\);\s*\/\/ Insert the Study Card below the unified filters/;
const jsReplacement = `studyCard.appendChild(cardAnswer);

    // 6. Create Action Buttons Area (Next Question / Answer)
    const actionArea = document.createElement('div');
    actionArea.className = 'msc-actions-row';
    moveEl('button01', actionArea, 'msc-btn-huge msc-btn-primary');
    moveEl('button02', actionArea, 'msc-btn-huge msc-btn-secondary');
    studyCard.appendChild(actionArea);

    // Insert the Study Card below the unified filters`;

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
