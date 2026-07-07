const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const cssToAdd = `
.msc-actions-container {
    padding: 24px 32px;
    background: #f8fafc;
    border-top: 1px solid #eaeaea;
}
.msc-actions-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}
.msc-actions-eval {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    margin-bottom: 8px;
}
.msc-btn-next {
    height: 64px;
    font-size: 24px !important;
    border-radius: 12px;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    box-shadow: 0 4px 12px rgba(15,23,42,0.2);
    transition: transform 0.1s, box-shadow 0.1s;
}
.msc-btn-next:active { transform: translateY(2px); box-shadow: 0 2px 6px rgba(15,23,42,0.2); }

.msc-btn-ans {
    height: 64px;
    font-size: 24px !important;
    border-radius: 12px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    box-shadow: 0 4px 12px rgba(59,130,246,0.3);
    transition: transform 0.1s, box-shadow 0.1s;
}
.msc-btn-ans:active { transform: translateY(2px); box-shadow: 0 2px 6px rgba(59,130,246,0.3); }

.msc-btn-correct {
    height: 48px;
    font-size: 20px !important;
    border-radius: 8px;
    background: #ecfdf5;
    color: #059669;
    border: 2px solid #34d399;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.2s;
}
.msc-btn-correct:hover { background: #d1fae5; }
.msc-btn-correct:active { transform: scale(0.96); }

.msc-btn-incorrect {
    height: 48px;
    font-size: 20px !important;
    border-radius: 8px;
    background: #fef2f2;
    color: #dc2626;
    border: 2px solid #f87171;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.2s;
}
.msc-btn-incorrect:hover { background: #fee2e2; }
.msc-btn-incorrect:active { transform: scale(0.96); }
`;

c = c.replace('</style>', cssToAdd + '\n</style>');

const jsToAdd = `
    // 6. Action Buttons (Next, Answer, Correct/Incorrect)
    const cardActions = document.createElement('div');
    cardActions.className = 'msc-actions-container';
    
    const actionsMain = document.createElement('div');
    actionsMain.className = 'msc-actions-main';
    moveEl('button01', actionsMain, 'msc-btn-next');
    moveEl('button02', actionsMain, 'msc-btn-ans');
    cardActions.appendChild(actionsMain);
    
    const correctGrid = document.createElement('div');
    correctGrid.className = 'msc-actions-eval';
    document.querySelectorAll('input[name="botan03"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-correct';
        correctGrid.appendChild(btn);
    });
    cardActions.appendChild(correctGrid);
    
    const incorrectGrid = document.createElement('div');
    incorrectGrid.className = 'msc-actions-eval';
    document.querySelectorAll('input[name="botan04"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-incorrect';
        incorrectGrid.appendChild(btn);
    });
    cardActions.appendChild(incorrectGrid);
    
    studyCard.appendChild(cardActions);
`;

// Insert the JS logic right before studyCard.appendChild(cardAnswer); or similar
c = c.replace("studyCard.appendChild(cardAnswer);", "studyCard.appendChild(cardAnswer);\n" + jsToAdd);

// Make sure the bottomButtonBox is hidden
c = c.replace("const qBoxes = document.querySelectorAll('.questionbuttonbox');", "const bbb = document.getElementById('bottomButtonBox'); if(bbb) bbb.style.display = 'none';\n    const qBoxes = document.querySelectorAll('.questionbuttonbox');");

fs.writeFileSync('sample020.php', c);
console.log("Done");
