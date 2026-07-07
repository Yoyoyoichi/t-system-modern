const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const target = `    aiHintBtn.addEventListener('click', async () => {
        aiHintBox.style.display = 'block';
        aiHintBox.innerText = '🤖 AIがヒントを考えています...';
        aiHintBtn.disabled = true;
        
        const qText = document.getElementById('textareas').value;
        const aText = document.getElementById('textareas2').value;
        
        try {
            const response = await fetch('ai_hint.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ question: qText, answer: aText })
            });
            const data = await response.json();
            if (data.hint) {
                aiHintBox.innerHTML = '<strong>🤖 AIヒント:</strong><br><br>' + data.hint.replace(/\\\\n/g, '<br>');
            } else if (data.error) {
                aiHintBox.innerText = 'エラーが発生しました: ' + data.error;
            }
        } catch (e) {
            aiHintBox.innerText = '通信エラーが発生しました。';
        }
        aiHintBtn.disabled = false;
    });`;

const replacement = `    aiHintBtn.addEventListener('click', async () => {
        aiHintBox.style.display = 'block';
        
        // Check if answer is revealed using the global variable AnswerShown2 or if textareas2 is visible
        const isRevealed = (typeof AnswerShown2 !== 'undefined' && AnswerShown2 === true);
        
        aiHintBox.innerText = isRevealed ? '🤖 AIが解説と学習状況の分析を考えています...' : '🤖 AIがヒントを考えています...';
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

if (c.includes(target)) {
    c = c.replace(target, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS");
} else {
    // try a more generic replace if formatting changed
    const regex = /aiHintBtn\.addEventListener\('click', async \(\) => \{[\s\S]*?aiHintBtn\.disabled = false;\s*\}\);/;
    if (regex.test(c)) {
        c = c.replace(regex, replacement);
        fs.writeFileSync('sample020.php', c);
        console.log("SUCCESS (REGEX)");
    } else {
        console.log("Target not found!");
    }
}
