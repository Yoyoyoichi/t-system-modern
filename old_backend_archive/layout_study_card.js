const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

const studyCardJS = `
<script>
window.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('.modern-study-card')) return;

    // 1. Create Main Container
    const studyCard = document.createElement('div');
    studyCard.className = 'modern-study-card';

    // 2. Create Header (Counter + Action Buttons)
    const cardHeader = document.createElement('div');
    cardHeader.className = 'msc-header';

    const headerLeft = document.createElement('div');
    headerLeft.className = 'msc-header-left';
    
    // Extract counters from the first questionbuttonbox
    const pressButton = document.getElementById('press-button');
    const totalQuestionNumber = document.getElementById('totalQuestionNumber');
    
    if (pressButton && totalQuestionNumber) {
        const counterText = document.createElement('div');
        counterText.className = 'msc-counter';
        counterText.innerHTML = \`<span class="msc-current" id="msc-press-button"></span> 問目 / 全 <span id="msc-total"></span> 問\`;
        headerLeft.appendChild(counterText);
        
        // Sync original spans to the new ones (hide the originals)
        const updateCounter = () => {
            const mscPress = document.getElementById('msc-press-button');
            const mscTotal = document.getElementById('msc-total');
            if (mscPress) mscPress.innerText = pressButton.innerText;
            if (mscTotal) mscTotal.innerText = totalQuestionNumber.innerText;
        };
        updateCounter();
        const observer = new MutationObserver(updateCounter);
        observer.observe(pressButton, { childList: true, characterData: true, subtree: true });
        observer.observe(totalQuestionNumber, { childList: true, characterData: true, subtree: true });
        
        pressButton.parentElement.style.display = 'none';
    }

    const headerRight = document.createElement('div');
    headerRight.className = 'msc-header-right';

    function moveEl(id, parent, customClass) {
        const el = document.getElementById(id);
        if(el) {
            el.removeAttribute('style');
            if(customClass) el.className = customClass;
            parent.appendChild(el);
            return el;
        }
        return null;
    }
    
    moveEl('autoQuestionButton', headerRight, 'msc-btn msc-btn-primary');
    moveEl('buttonmodifyquestion', headerRight, 'msc-btn msc-btn-secondary');

    cardHeader.appendChild(headerLeft);
    cardHeader.appendChild(headerRight);
    studyCard.appendChild(cardHeader);

    // 3. Create Body (Question Text + Images)
    const cardBody = document.createElement('div');
    cardBody.className = 'msc-body';
    
    // questionInfo is actually the Metadata (Level, Correct count, etc.)
    moveEl('questionInfo', cardBody, 'msc-metadata-box');
    
    // textareas is the MAIN Question Textarea! Move it to body!
    // Do NOT add msc-hidden, let PHP script toggle its display!
    moveEl('textareas', cardBody, 'msc-textarea msc-question-textarea');
    
    const div1 = document.getElementById('div1');
    if (div1) {
        div1.removeAttribute('style');
        div1.className = 'msc-media-container';
        cardBody.appendChild(div1);
    }
    
    studyCard.appendChild(cardBody);

    // 4. Create Toolbox (Settings dropdowns)
    const cardToolbox = document.createElement('div');
    cardToolbox.className = 'msc-toolbox';
    
    const toolboxLabel = document.createElement('div');
    toolboxLabel.className = 'msc-toolbox-label';
    toolboxLabel.innerText = 'Toolbox';
    cardToolbox.appendChild(toolboxLabel);

    const toolboxItems = document.createElement('div');
    toolboxItems.className = 'msc-toolbox-items';
    
    moveEl('poorat', toolboxItems, 'msc-select');
    moveEl('fontresize', toolboxItems, 'msc-select');
    moveEl('mp3Speed', toolboxItems, 'msc-select');
    moveEl('mp3StartPoint', toolboxItems, 'msc-select');
    moveEl('imageSize1', toolboxItems, 'msc-select');
    moveEl('imageSize2', toolboxItems, 'msc-select');
    
    const readButtons = document.querySelectorAll('input[onClick*="read"]');
    readButtons.forEach(btn => {
        btn.removeAttribute('style');
        btn.className = 'msc-btn msc-btn-sm';
        toolboxItems.appendChild(btn);
    });

    cardToolbox.appendChild(toolboxItems);
    studyCard.appendChild(cardToolbox);

    // 5. Create Answer Area
    const cardAnswer = document.createElement('div');
    cardAnswer.className = 'msc-answer';
    
    moveEl('novel', cardAnswer, 'msc-hidden');
    moveEl('preQInfo', cardAnswer, 'msc-info-text');
    moveEl('textareas2', cardAnswer, 'msc-textarea msc-answer-textarea');

    studyCard.appendChild(cardAnswer);

    // Insert the Study Card below the unified filters
    const unifiedPanel = document.querySelector('.unified-panel-container');
    const form = document.getElementById('mainform');
    if (unifiedPanel) {
        unifiedPanel.after(studyCard);
    } else if (form) {
        form.appendChild(studyCard);
    }
    
    const qBoxes = document.querySelectorAll('.questionbuttonbox');
    qBoxes.forEach(b => b.style.display = 'none');
});
</script>
`;

const studyCardCSS = `
/* Modern Study Card CSS */
.modern-study-card {
    background: #ffffff;
    border-radius: 16px;
    margin: 24px 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    border: 1px solid #eaeaea;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    overflow: hidden;
}

.msc-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 32px;
    background: #fafafa;
    border-bottom: 1px solid #eaeaea;
}

.msc-counter {
    font-size: 16px;
    font-weight: 500;
    color: #64748b;
}

.msc-current {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
}

.msc-header-right {
    display: flex;
    gap: 12px;
}

.msc-btn {
    height: 40px;
    padding: 0 24px;
    border-radius: 8px;
    font-size: 15px !important;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    line-height: 1;
}

.msc-btn-primary {
    background: #0f172a !important;
    color: #fff !important;
}

.msc-btn-primary:hover {
    background: #334155 !important;
    transform: translateY(-1px);
}

.msc-btn-secondary {
    background: #fff !important;
    color: #0f172a !important;
    border: 1px solid #cbd5e1 !important;
}

.msc-btn-secondary:hover {
    background: #f8fafc !important;
    border-color: #94a3b8 !important;
}

.msc-btn-sm {
    height: 36px;
    padding: 0 16px;
    font-size: 13px !important;
    background: #f1f5f9 !important;
    color: #475569 !important;
    border: 1px solid #e2e8f0 !important;
}

.msc-btn-sm:hover {
    background: #e2e8f0 !important;
}

.msc-body {
    padding: 32px;
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.msc-metadata-box {
    font-size: 15px !important;
    line-height: 1.6 !important;
    color: #64748b;
    white-space: pre-wrap;
    word-break: break-word;
    margin: 0;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 16px;
    height: 110px;
    overflow-y: auto;
    font-family: inherit;
}


.msc-media-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
}

.msc-toolbox {
    margin: 0 32px;
    padding: 16px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 16px;
}

.msc-toolbox-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #94a3b8;
    letter-spacing: 0.05em;
}

.msc-toolbox-items {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    flex: 1;
}

.msc-select {
    height: 36px !important;
    padding: 0 12px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    font-size: 13px !important;
    background: #fff;
    color: #475569;
    outline: none;
}

.msc-select:focus {
    border-color: #94a3b8;
}

.msc-answer {
    padding: 32px;
}

.msc-textarea {
    width: 100% !important;
    height: 120px !important;
    padding: 16px;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    font-size: 20px !important;
    color: #0f172a;
    background: #fff;
    resize: vertical;
    transition: all 0.2s;
    box-sizing: border-box;
    line-height: 1.5;
}

.msc-textarea:focus {
    border-color: #3b82f6;
    outline: none;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.msc-question-textarea {
    background: #f8fafc;
    border-color: #cbd5e1;
}

.msc-answer-textarea {
    border-color: #3b82f6;
}

.msc-hidden {
    display: none !important;
}

.msc-info-text {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 12px;
}
`;

// Clean up old injection completely
while (true) {
    const jsRegex = /<script>\s*window\.addEventListener\('DOMContentLoaded', \(\) => \{\s*if\(document\.querySelector\('\.modern-study-card'\)\) return;[\s\S]*?<\/script>/;
    if (content.match(jsRegex)) {
        content = content.replace(jsRegex, '');
    } else {
        break;
    }
}
while (true) {
    const cssRegex = /\/\* Modern Study Card CSS \*\/[\s\S]*?(?=<\/style>|<\/script>|<body|<div|<!--|$)/;
    if (content.match(cssRegex)) {
        content = content.replace(cssRegex, '');
    } else {
        break;
    }
}

content = content.replace('</body>', studyCardJS + '\\n</body>');
content = content.replace('</style>', '\\n' + studyCardCSS + '\\n</style>');

fs.writeFileSync(file, content);
console.log("Study Card layout updated to fix hidden textareas.");
