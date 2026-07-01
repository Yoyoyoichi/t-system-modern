const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

const targetOld = `    // 5. Create Answer Area
    const cardAnswer = document.createElement('div');
    cardAnswer.className = 'msc-answer';
    
    moveEl('novel', cardAnswer, 'msc-hidden');
    moveEl('preQInfo', cardAnswer, 'msc-info-text');
    moveEl('textareas2', cardAnswer, 'msc-textarea msc-answer-textarea');

    studyCard.appendChild(cardAnswer);

    // 6. Create Action Buttons Area (Next Question / Answer)
    const actionArea = document.createElement('div');
    actionArea.className = 'msc-actions-row';
    moveEl('button01', actionArea, 'msc-btn-huge msc-btn-primary');
    moveEl('button02', actionArea, 'msc-btn-huge msc-btn-secondary');
    
    // Create AI Hint Button
    const aiHintBtn = document.createElement('button');
    aiHintBtn.type = 'button';
    aiHintBtn.className = 'msc-btn-huge msc-btn-secondary';
    aiHintBtn.style.cssText = 'background: #f0fdf4 !important; border-color: #bbf7d0 !important; color: #166534 !important; font-size: 20px !important; display: flex; align-items: center; justify-content: center; gap: 8px;';
    aiHintBtn.innerHTML = '🤖 <span id="msc-ai-btn-text">AI サポート</span>';
    aiHintBtn.id = 'msc-ai-hint-btn';
    actionArea.appendChild(aiHintBtn);
    
    studyCard.appendChild(actionArea);

    // Create AI Hint Display Area
    const aiHintBox = document.createElement('div');
    aiHintBox.id = 'msc-ai-hint-box';
    aiHintBox.style.cssText = 'display: none; margin: 0 24px 24px 24px; padding: 16px; background: #f8fafc; border: 2px solid #bbf7d0; border-radius: 8px; font-size: 16px; color: #334155; line-height: 1.6; white-space: pre-wrap; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);';
    studyCard.appendChild(aiHintBox);`;

const targetNew = `    // 5. Create Answer Area
    const cardAnswer = document.createElement('div');
    cardAnswer.className = 'msc-answer';
    
    moveEl('novel', cardAnswer, 'msc-hidden');
    moveEl('preQInfo', cardAnswer, 'msc-info-text');

    const answerLayout = document.createElement('div');
    answerLayout.id = 'msc-answer-layout';
    answerLayout.style.cssText = 'display: flex; gap: 16px; width: 100%; align-items: flex-start;';
    
    const txt2 = moveEl('textareas2', answerLayout, 'msc-textarea msc-answer-textarea');
    if (txt2) {
        txt2.style.flex = '1';
        txt2.style.minWidth = '0';
        txt2.style.margin = '0'; // reset margin
    }

    // Create AI Hint Display Area inside the split layout
    const aiHintBox = document.createElement('div');
    aiHintBox.id = 'msc-ai-hint-box';
    aiHintBox.style.cssText = 'display: none; flex: 1; padding: 16px; background: #f8fafc; border: 2px solid #bbf7d0; border-radius: 8px; font-size: 16px; color: #334155; line-height: 1.6; white-space: pre-wrap; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); min-width: 0;';
    answerLayout.appendChild(aiHintBox);
    
    cardAnswer.appendChild(answerLayout);
    studyCard.appendChild(cardAnswer);

    // 6. Create Action Buttons Area (Next Question / Answer)
    const actionArea = document.createElement('div');
    actionArea.className = 'msc-actions-row';
    moveEl('button01', actionArea, 'msc-btn-huge msc-btn-primary');
    moveEl('button02', actionArea, 'msc-btn-huge msc-btn-secondary');
    
    // Create AI Hint Button
    const aiHintBtn = document.createElement('button');
    aiHintBtn.type = 'button';
    aiHintBtn.className = 'msc-btn-huge msc-btn-secondary';
    aiHintBtn.style.cssText = 'background: #f0fdf4 !important; border-color: #bbf7d0 !important; color: #166534 !important; font-size: 20px !important; display: flex; align-items: center; justify-content: center; gap: 8px;';
    aiHintBtn.innerHTML = '🤖 <span id="msc-ai-btn-text">AI サポート</span>';
    aiHintBtn.id = 'msc-ai-hint-btn';
    actionArea.appendChild(aiHintBtn);
    
    studyCard.appendChild(actionArea);`;

if(content.includes(targetOld)) {
    content = content.replace(targetOld, targetNew);
    fs.writeFileSync(file, content);
    console.log("SUCCESS");
} else {
    console.log("FAILED: Target block not found");
}
