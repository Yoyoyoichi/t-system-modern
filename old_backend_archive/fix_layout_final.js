const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// 1. Add CSS for misc buttons
const miscCss = `
.msc-actions-misc {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    margin-top: 16px;
}
.msc-btn-misc {
    height: 48px;
    font-size: 18px !important;
    border-radius: 8px;
    background: #e2e8f0;
    color: #475569;
    border: none;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.2s;
}
.msc-btn-misc:hover { background: #cbd5e1; }
.msc-btn-misc:active { transform: scale(0.96); }
`;
if (!c.includes('.msc-actions-misc')) {
    c = c.replace('</style>', miscCss + '\n</style>');
}

// 2. Modify JS injection
// First remove the old jsToAdd that I injected using regex
const regexJsToAdd = /\/\/ 6\. Action Buttons[\s\S]*?studyCard\.appendChild\(cardActions\);/g;
c = c.replace(regexJsToAdd, '');

const jsToAdd = `
    // 6. Action Buttons (Next, Answer, Correct/Incorrect, Misc)
    const cardActions = document.createElement('div');
    cardActions.className = 'msc-actions-container';
    
    // Row 1: Main (Previous, Next, Answer)
    const actionsMain = document.createElement('div');
    actionsMain.className = 'msc-actions-main';
    
    const prevBtn = Array.from(document.querySelectorAll('input[name="botan05"]')).find(b => b.value === '前の問題');
    if(prevBtn) { prevBtn.removeAttribute('style'); prevBtn.className = 'msc-btn-prev'; actionsMain.appendChild(prevBtn); }
    
    moveEl('button01', actionsMain, 'msc-btn-next');
    moveEl('button02', actionsMain, 'msc-btn-ans');
    cardActions.appendChild(actionsMain);
    
    // Row 2: Eval (Good)
    const correctGrid = document.createElement('div');
    correctGrid.className = 'msc-actions-eval';
    document.querySelectorAll('input[name="botan03"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-correct';
        correctGrid.appendChild(btn);
    });
    cardActions.appendChild(correctGrid);
    
    // Row 3: Eval (Poor)
    const incorrectGrid = document.createElement('div');
    incorrectGrid.className = 'msc-actions-eval';
    document.querySelectorAll('input[name="botan04"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-incorrect';
        incorrectGrid.appendChild(btn);
    });
    cardActions.appendChild(incorrectGrid);
    
    // Row 4: Misc (Skip, Correct-, Incorrect-)
    const miscGrid = document.createElement('div');
    miscGrid.className = 'msc-actions-misc';
    const skipBtn = Array.from(document.querySelectorAll('input[name="botan05"]')).find(b => b.value === 'スキップ');
    if(skipBtn) { skipBtn.removeAttribute('style'); skipBtn.className = 'msc-btn-misc'; miscGrid.appendChild(skipBtn); }
    
    document.querySelectorAll('input[name="botan06"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-misc';
        miscGrid.appendChild(btn);
    });
    cardActions.appendChild(miscGrid);
    
    studyCard.appendChild(cardActions);
`;

c = c.replace("studyCard.appendChild(cardAnswer);", "studyCard.appendChild(cardAnswer);\n" + jsToAdd);

fs.writeFileSync('sample020.php', c);
console.log("Done layout fix.");
