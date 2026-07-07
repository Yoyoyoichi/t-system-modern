const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// The injected script had a syntax error. We need to remove the whole cardActions block and replace it.
const regexJsToAdd = /\/\/ 6\. Action Buttons[\s\S]*?studyCard\.appendChild\(cardActions\);/g;
c = c.replace(regexJsToAdd, '');

const jsToAdd = `
    // 6. Action Buttons (Next, Answer, Correct/Incorrect, Misc)
    const cardActions = document.createElement('div');
    cardActions.className = 'msc-actions-container';
    
    const actionsMain = document.createElement('div');
    actionsMain.className = 'msc-actions-main';
    
    // botan05[0] is Previous, botan05[1] is Skip
    const botan05s = document.querySelectorAll('input[name="botan05"]');
    if(botan05s.length > 0) { 
        botan05s[0].removeAttribute('style'); 
        botan05s[0].className = 'msc-btn-prev'; 
        actionsMain.appendChild(botan05s[0]); 
    }
    
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
    
    const miscGrid = document.createElement('div');
    miscGrid.className = 'msc-actions-misc';
    
    if(botan05s.length > 1) { 
        botan05s[1].removeAttribute('style'); 
        botan05s[1].className = 'msc-btn-misc'; 
        miscGrid.appendChild(botan05s[1]); 
    }
    
    document.querySelectorAll('input[name="botan06"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-misc';
        miscGrid.appendChild(btn);
    });
    
    // Also include botan07 if Incorrect- is named botan07
    document.querySelectorAll('input[name="botan07"]').forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn-misc';
        miscGrid.appendChild(btn);
    });

    cardActions.appendChild(miscGrid);
    studyCard.appendChild(cardActions);
`;

// Insert the new JS logic right before the unified filters insertion
c = c.replace("// Insert the Study Card below the unified filters", jsToAdd + "\\n\\n    // Insert the Study Card below the unified filters");

fs.writeFileSync('sample020.php', c);
console.log("Syntax fixed");
