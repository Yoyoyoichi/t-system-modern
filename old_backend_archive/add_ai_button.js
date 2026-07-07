const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const regex = /    actionArea\.className = 'msc-actions-row';\s*moveEl\('button01', actionArea, 'msc-btn-huge msc-btn-primary'\);\s*moveEl\('button02', actionArea, 'msc-btn-huge msc-btn-secondary'\);\s*studyCard\.appendChild\(actionArea\);/;

const replacement = `    actionArea.className = 'msc-actions-row';
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
    studyCard.appendChild(aiHintBox);
    
    aiHintBtn.addEventListener('click', async () => {
        aiHintBox.style.display = 'block';
        
        // Check if answer is revealed using the global variable AnswerShown2 or if textareas2 is visible
        const isRevealed = (typeof AnswerShown2 !== 'undefined' && AnswerShown2 === true);
        
        aiHintBox.innerHTML = isRevealed 
            ? '🤖 <strong>AIが解説と学習状況の分析を考えています...</strong>' 
            : '🤖 <strong>AIがヒントを考えています...</strong>';
        aiHintBtn.disabled = true;
        
        const qText = document.getElementById('textareas').value;
        const aText = document.getElementById('textareas2').value;
        
        // Extract question history
        let historyText = "";
        if (typeof window.allQuestionsData !== 'undefined' && typeof rand !== 'undefined') {
            const qInfo = window.allQuestionsData.find(r => r.questionnumber == rand);
            if (qInfo) {
                const qDate = qInfo.qdate && qInfo.qdate !== '0000-00-00 00:00:00' ? qInfo.qdate : '記録なし';
                historyText = \`正解数: \${qInfo.correct}回, 不正解数: \${qInfo.incorrect}回, 最終回答日: \${qDate}\`;
                if (qInfo.poorat) historyText += \`, 最近の傾向データ: \${qInfo.poorat}\`;
            }
        }
        
        try {
            const response = await fetch('ai_hint.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    question: qText, 
                    answer: aText,
                    is_answer_revealed: isRevealed,
                    history_text: historyText
                })
            });
            const data = await response.json();
            if (data.hint) {
                const title = isRevealed ? '<strong>🤖 AI解説＆分析:</strong><br><br>' : '<strong>🤖 AIヒント:</strong><br><br>';
                aiHintBox.innerHTML = title + data.hint.replace(/\\n/g, '<br>');
            } else if (data.error) {
                aiHintBox.innerText = 'エラーが発生しました: ' + data.error;
            }
        } catch (e) {
            aiHintBox.innerText = '通信エラーが発生しました。';
        }
        aiHintBtn.disabled = false;
    });`;

if (regex.test(c)) {
    c = c.replace(regex, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS");
} else {
    console.log("Target not found!");
}
