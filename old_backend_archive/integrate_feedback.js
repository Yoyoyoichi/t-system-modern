const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const cssTarget = /\.msc-btn-secondary\.msc-btn-huge:hover \{[\s\S]*?transform: translateY\(-2px\);\s*\}/;
const cssReplacement = `.msc-btn-secondary.msc-btn-huge:hover {
    background: #f8fafc !important;
    border-color: #94a3b8 !important;
    transform: translateY(-2px);
}
.msc-feedback-row {
    padding: 16px 24px;
    background: #f1f5f9;
    flex-wrap: wrap;
    justify-content: center;
}
.msc-btn-feedback {
    flex: 1 1 calc(10% - 16px);
    min-width: 60px;
    height: 50px;
    margin: 4px;
    font-size: 16px !important;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}
.msc-btn-good { background: #10b981 !important; color: #fff !important; }
.msc-btn-good:hover { background: #059669 !important; transform: translateY(-1px); }
.msc-btn-poor { background: #ef4444 !important; color: #fff !important; }
.msc-btn-poor:hover { background: #dc2626 !important; transform: translateY(-1px); }
.msc-btn-nav { background: #64748b !important; color: #fff !important; }
.msc-btn-nav:hover { background: #475569 !important; transform: translateY(-1px); }`;

const jsTarget = /moveEl\('button02', actionArea, 'msc-btn-huge msc-btn-secondary'\);\s*studyCard\.appendChild\(actionArea\);/;
const jsReplacement = `moveEl('button02', actionArea, 'msc-btn-huge msc-btn-secondary');
    studyCard.appendChild(actionArea);

    // 7. Create Feedback Buttons Area (Good / Poor / Nav)
    const feedbackArea = document.createElement('div');
    feedbackArea.className = 'msc-actions-row msc-feedback-row';

    document.querySelectorAll('input[name="botan03"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-feedback msc-btn-good';
        feedbackArea.appendChild(btn);
    });

    document.querySelectorAll('input[name="botan04"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-feedback msc-btn-poor';
        feedbackArea.appendChild(btn);
    });

    document.querySelectorAll('input[name="botan05"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-feedback msc-btn-nav';
        feedbackArea.appendChild(btn);
    });

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
