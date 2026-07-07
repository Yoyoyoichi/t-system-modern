const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

// Remove all injected script blocks
while (true) {
    const jsRegex = /<script>\s*window\.addEventListener\('DOMContentLoaded', \(\) => \{\s*if\(document\.querySelector\('\.modern-top-panel'\)\) return;[\s\S]*?<\/script>/;
    if (content.match(jsRegex)) {
        content = content.replace(jsRegex, '');
    } else {
        break;
    }
}

// Remove all injected CSS blocks
while (true) {
    const cssRegex = /\/\* Modern Top Panel CSS \*\/[\s\S]*?(?=<\/style>|<\/script>|<body|<div|<!--|$)/;
    if (content.match(cssRegex)) {
        content = content.replace(cssRegex, '');
    } else {
        break;
    }
}

const partialDashboardJS = `
<script>
window.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('.modern-top-panel')) return;

    const topPanel = document.createElement('div');
    topPanel.className = 'modern-top-panel';

    // 1. Header Row
    const headerRow = document.createElement('div');
    headerRow.className = 'mtp-header-row';
    const dbInput = document.getElementById('DB_name');
    if(dbInput) { dbInput.placeholder = "Enter DB Name..."; headerRow.appendChild(dbInput); }

    const gp1 = document.getElementById('grandParent1');
    if(gp1) {
        Array.from(gp1.childNodes).forEach(node => {
            if(node.nodeName === 'BR' || (node.nodeName === '#text' && node.textContent.trim() === '')) node.remove();
        });
        headerRow.appendChild(gp1);
    }
    topPanel.appendChild(headerRow);

    // 2. Stats & Info Row
    const statsRow = document.createElement('div');
    statsRow.className = 'mtp-stats-row';
    const massages = document.getElementById('massages');
    if(massages) { massages.className = 'modern-stats'; statsRow.appendChild(massages); }

    const infoDiv = document.createElement('div');
    infoDiv.className = 'mtp-info-container';
    const infoTextarea = document.getElementById('information');
    if(infoTextarea) { infoDiv.appendChild(infoTextarea); statsRow.appendChild(infoDiv); }
    topPanel.appendChild(statsRow);

    // 3. Categories Row
    const catRow = document.createElement('div');
    catRow.className = 'mtp-category-row';
    for(let i=1; i<=5; i++) {
        const ctg = document.getElementById('ctg'+i);
        if(ctg) { ctg.removeAttribute('style'); catRow.appendChild(ctg); }
    }
    topPanel.appendChild(catRow);

    // 4. Filters Row (Level 0 to One Month Ago)
    const filtersContainer = document.createElement('div');
    filtersContainer.className = 'mtp-filters-container';
    
    // Level Filters
    const levelGroup = document.createElement('div');
    levelGroup.className = 'mtp-filter-group';
    levelGroup.innerHTML = '<div class="mtp-group-title">Level Filters</div>';
    const levelButtons = document.createElement('div');
    levelButtons.className = 'mtp-button-grid';
    ['Lv0','Lv1','Lv2','Lv3','Lv4'].forEach(id => {
        let el = document.getElementById(id);
        if(el) { el.removeAttribute('style'); el.className = 'mtp-filter-btn mtp-level-btn'; levelButtons.appendChild(el); }
    });
    levelGroup.appendChild(levelButtons);
    filtersContainer.appendChild(levelGroup);

    // Time/Status Filters
    const timeGroup = document.createElement('div');
    timeGroup.className = 'mtp-filter-group';
    timeGroup.innerHTML = '<div class="mtp-group-title">Condition Filters</div>';
    const timeButtons = document.createElement('div');
    timeButtons.className = 'mtp-button-grid mtp-time-grid';
    ['atLeastOne','NotYet','yesterday','noToday','U50','errToday','errLast','threeDaysAgo','aWeekAgo','aMonthAgo'].forEach(id => {
        let el = document.getElementById(id);
        if(el) { el.removeAttribute('style'); el.className = 'mtp-filter-btn mtp-time-btn'; timeButtons.appendChild(el); }
    });
    timeGroup.appendChild(timeButtons);
    filtersContainer.appendChild(timeGroup);

    topPanel.appendChild(filtersContainer);

    // Insert the panel at the very top of the form
    const form = document.getElementById('mainform');
    if(form) { form.insertBefore(topPanel, form.firstChild); }
});
</script>
`;

const partialDashboardCSS = `
/* Modern Top Panel CSS */
.modern-top-panel {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px;
    margin: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border: 1px solid #eaeaea;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.mtp-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    gap: 20px;
    flex-wrap: wrap;
}

#DB_name {
    width: 300px !important;
    height: 48px !important;
    font-size: 24px !important;
    border: none !important;
    border-bottom: 2px solid #111 !important;
    border-radius: 0 !important;
    background: transparent;
    color: #111;
    font-weight: 600;
    transition: all 0.3s;
}
#DB_name:focus {
    outline: none;
    border-bottom-color: #0d8a4e !important;
}

#grandParent1 {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

#grandParent1 input[type="submit"] {
    background: #111;
    color: #fff !important;
    border-radius: 6px;
    padding: 10px 24px;
    font-size: 16px !important;
    height: auto !important;
    width: auto !important;
    font-weight: 600;
}

#grandParent1 a {
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 20px;
    background: #f4f4f5;
    transition: all 0.2s;
}
#grandParent1 a:hover {
    background: #e4e4e7;
    transform: translateY(-1px);
}
#grandParent1 a font {
    color: #3f3f46 !important;
    font-size: 14px !important;
    font-weight: 600;
}

.mtp-stats-row {
    display: flex;
    gap: 24px;
    margin-bottom: 24px;
}

.modern-stats {
    flex: 1;
    background: #f8fafc;
    border-radius: 8px;
    padding: 16px;
    border: 1px solid #e2e8f0;
}

.modern-stats p {
    font-size: 15px !important;
    color: #334155 !important;
    line-height: 1.6;
    margin: 0;
    width: 100% !important;
}

.mtp-info-container {
    flex: 1;
}

#information {
    width: 100% !important;
    height: 100% !important;
    min-height: 120px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px;
    font-size: 16px !important;
    background: #f8fafc;
    color: #334155;
    box-sizing: border-box;
}

.mtp-category-row {
    display: flex;
    gap: 12px;
    height: 180px;
    margin-bottom: 24px;
}

.mtp-category-row select {
    flex: 1;
    height: 100% !important;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 8px;
    font-size: 14px !important;
    background: #ffffff;
    color: #1e293b;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    outline: none;
}
.mtp-category-row select:focus {
    border-color: #94a3b8;
    box-shadow: 0 0 0 2px rgba(148, 163, 184, 0.2);
}
.mtp-category-row select option {
    padding: 8px;
    border-bottom: 1px solid #f1f5f9;
}

/* New Filters Row CSS */
.mtp-filters-container {
    display: flex;
    gap: 24px;
    background: #f8fafc;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    flex-wrap: wrap;
}

.mtp-filter-group {
    flex: 1;
    min-width: 300px;
}

.mtp-group-title {
    font-size: 14px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.mtp-button-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 8px;
}

.mtp-time-grid {
    grid-template-columns: repeat(4, 1fr);
}

.mtp-filter-btn {
    background: #fff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 12px 8px;
    font-size: 13px !important;
    color: #334155 !important;
    cursor: pointer;
    transition: all 0.2s;
    font-weight: 500;
    box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    text-align: center;
}

.mtp-filter-btn:hover {
    background: #f1f5f9;
    border-color: #94a3b8;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.mtp-filter-btn:active {
    transform: translateY(0);
}

.mtp-level-btn {
    background: #e0f2fe;
    border-color: #bae6fd;
    color: #0369a1 !important;
}
.mtp-level-btn:hover {
    background: #bae6fd;
    border-color: #7dd3fc;
}
`;

content = content.replace('</style>', partialDashboardCSS + '\n</style>');
content = content.replace('</body>', partialDashboardJS + '\n</body>');

fs.writeFileSync(file, content);
console.log("Cleanup and injection successful.");
