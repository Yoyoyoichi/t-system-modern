
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
        counterText.innerHTML = `<span class="msc-current" id="msc-press-button"></span> 問目 / 全 <span id="msc-total"></span> 問`;
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


    // Insert the Study Card below the unified filters
    const unifiedPanel = document.querySelector('.unified-panel-container');
    const form = document.getElementById('mainform');
    if (unifiedPanel) {
        unifiedPanel.after(studyCard);
    } else if (form) {
        form.appendChild(studyCard);
    }
    
    const bbb = document.getElementById('bottomButtonBox'); if(bbb) bbb.style.display = 'none';
    const qBoxes = document.querySelectorAll('.questionbuttonbox');
    qBoxes.forEach(b => b.style.display = 'none');
});
