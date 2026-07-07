
window.addEventListener('DOMContentLoaded', () => {
    // Prevent double execution
    if(document.querySelector('.unified-panel-container')) return;

    // We will build the advanced search contents first
    const searchPanel = document.createElement('div');
    searchPanel.className = 'modern-search-panel unified-right-content';
    searchPanel.innerHTML = '<div class="msp-title">Advanced Search & Criteria</div>';

    // Helper to move elements safely
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

    // 1. General Settings Row
    const generalRow = document.createElement('div');
    generalRow.className = 'msp-general-row';
    moveEl('MaxQuestionNumber', generalRow, 'msp-select');
    moveEl('poorat2', generalRow, 'msp-select');
    moveEl('qlevel', generalRow, 'msp-select');
    moveEl('wordSearch', generalRow, 'msp-input msp-search');
    searchPanel.appendChild(generalRow);

    // 2. Criteria Rows
    const criteriaRowsContainer = document.createElement('div');
    criteriaRowsContainer.className = 'msp-criteria-container';

    function buildCriteriaRow(catId, opId, critId, btnId) {
        const row = document.createElement('div');
        row.className = 'msp-criteria-row';
        moveEl(catId, row, 'msp-select');
        moveEl(opId, row, 'msp-select msp-op');
        moveEl(critId, row, 'msp-input');
        if(btnId) moveEl(btnId, row, 'msp-btn');
        if(row.children.length > 0) criteriaRowsContainer.appendChild(row);
    }

    buildCriteriaRow('category4', 'operator1', 'criteria1', 'getTodayNumber');
    buildCriteriaRow('category5', 'operator2', 'criteria2', 'getfirstDayNumber');
    buildCriteriaRow('category6', 'operator3', 'criteria3', null);
    searchPanel.appendChild(criteriaRowsContainer);

    // Clean up the old .criterias div if it's empty
    const oldCriterias = document.querySelector('.criterias');
    if(oldCriterias) {
        Array.from(oldCriterias.childNodes).forEach(n => {
            if(n.nodeName === 'BR' || (n.nodeName === '#text' && n.textContent.trim() === '')) n.remove();
        });
        if(oldCriterias.childNodes.length === 0) oldCriterias.remove();
    }

    // NOW UNIFY THEM
    const unifiedContainer = document.createElement('div');
    unifiedContainer.className = 'unified-panel-container';

    const unifiedLeft = document.createElement('div');
    unifiedLeft.className = 'unified-left-col';

    const unifiedRight = document.createElement('div');
    unifiedRight.className = 'unified-right-col';

    // Get the existing mtp-filters-container which holds Level and Condition filters
    const oldFiltersContainer = document.querySelector('.mtp-filters-container');
    if (oldFiltersContainer) {
        // Move its children (Level group, Time group) into unifiedLeft
        while(oldFiltersContainer.firstChild) {
            unifiedLeft.appendChild(oldFiltersContainer.firstChild);
        }
        // Remove the old empty container
        oldFiltersContainer.remove();
    }

    // Put advanced search in the right column
    unifiedRight.appendChild(searchPanel);

    unifiedContainer.appendChild(unifiedLeft);
    unifiedContainer.appendChild(unifiedRight);

    // Insert unified container into the top panel
    const topPanel = document.querySelector('.modern-top-panel');
    const form = document.getElementById('mainform');
    if(topPanel) {
        // We append it inside the topPanel to keep it as one unified block
        topPanel.appendChild(unifiedContainer);
    } else if(form) {
        form.insertBefore(unifiedContainer, form.firstChild);
    }
});
