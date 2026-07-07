const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

// The JS that adds the Advanced Search Panel
const advancedSearchJS = `
<script>
window.addEventListener('DOMContentLoaded', () => {
    // Prevent double execution
    if(document.querySelector('.modern-search-panel')) return;

    // We will place this new panel right after the top panel, or at the top of the form if top panel doesn't exist
    const searchPanel = document.createElement('div');
    searchPanel.className = 'modern-search-panel';
    searchPanel.innerHTML = '<div class="msp-title">Advanced Search & Criteria</div>';

    const criteriaGrid = document.createElement('div');
    criteriaGrid.className = 'msp-grid';

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

    // 1. General Settings Row (MaxQuestionNumber, poorat2, qlevel, wordSearch)
    const generalRow = document.createElement('div');
    generalRow.className = 'msp-general-row';
    moveEl('MaxQuestionNumber', generalRow, 'msp-select');
    moveEl('poorat2', generalRow, 'msp-select');
    moveEl('qlevel', generalRow, 'msp-select');
    moveEl('wordSearch', generalRow, 'msp-input msp-search');
    searchPanel.appendChild(generalRow);

    // 2. Criteria Rows (Category, Operator, Value, Action)
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

    // Insert the search panel below the top panel, or at the top of mainform
    const topPanel = document.querySelector('.modern-top-panel');
    const form = document.getElementById('mainform');
    if(topPanel) {
        topPanel.after(searchPanel);
    } else if(form) {
        form.insertBefore(searchPanel, form.firstChild);
    }
});
</script>
`;

const advancedSearchCSS = `
/* Modern Search Panel CSS */
.modern-search-panel {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px;
    margin: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid #eaeaea;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.msp-title {
    font-size: 16px;
    font-weight: 600;
    color: #111;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid #eaeaea;
}

.msp-general-row {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.msp-criteria-container {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.msp-criteria-row {
    display: flex;
    gap: 12px;
    align-items: center;
    background: #f8fafc;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.msp-select {
    height: 44px !important;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 0 12px;
    font-size: 14px !important;
    background: #fff;
    color: #334155;
    outline: none;
    transition: all 0.2s;
    min-width: 140px;
}
.msp-select:focus {
    border-color: #94a3b8;
    box-shadow: 0 0 0 2px rgba(148, 163, 184, 0.2);
}

.msp-op {
    min-width: 60px;
    width: 60px;
    text-align: center;
}

.msp-input {
    height: 44px !important;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 0 12px;
    font-size: 15px !important;
    background: #fff;
    color: #334155 !important;
    outline: none;
    flex: 1;
    transition: all 0.2s;
}
.msp-input:focus {
    border-color: #94a3b8;
    box-shadow: 0 0 0 2px rgba(148, 163, 184, 0.2);
}

.msp-search {
    border: none;
    border-bottom: 2px solid #cbd5e1;
    border-radius: 0;
    background: transparent;
    padding-left: 0;
    font-size: 18px !important;
    flex: 1;
    min-width: 200px;
}
.msp-search:focus {
    border-bottom-color: #111;
    box-shadow: none;
}

.msp-btn {
    height: 44px !important;
    background: #111;
    color: #fff !important;
    border: none;
    border-radius: 6px;
    padding: 0 20px;
    font-size: 14px !important;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}
.msp-btn:hover {
    background: #333;
    transform: translateY(-1px);
}
.msp-btn:active {
    transform: translateY(0);
}
`;

// Clean up old instances of advanced search just in case
while (true) {
    const jsRegex = /<script>\s*window\.addEventListener\('DOMContentLoaded', \(\) => \{\s*\/\/ Prevent double execution\s*if\(document\.querySelector\('\.modern-search-panel'\)\) return;[\s\S]*?<\/script>/;
    if (content.match(jsRegex)) {
        content = content.replace(jsRegex, '');
    } else {
        break;
    }
}
while (true) {
    const cssRegex = /\/\* Modern Search Panel CSS \*\/[\s\S]*?(?=<\/style>|<\/script>|<body|<div|<!--|$)/;
    if (content.match(cssRegex)) {
        content = content.replace(cssRegex, '');
    } else {
        break;
    }
}

// Inject new CSS and JS
content = content.replace('</style>', advancedSearchCSS + '\n</style>');
content = content.replace('</body>', advancedSearchJS + '\n</body>');

fs.writeFileSync(file, content);
console.log("Advanced search layout injected successfully.");
