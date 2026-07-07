const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

const updatedJS = `
    // 4. Filters Row (Split Layout)
    const filtersContainer = document.createElement('div');
    filtersContainer.className = 'mtp-filters-container split-layout';
    
    // LEFT COLUMN
    const leftCol = document.createElement('div');
    leftCol.className = 'mtp-left-col';

    // 4a. Level Filters (Top Left)
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
    leftCol.appendChild(levelGroup);

    // 4b. Status Filters (Bottom Left)
    const statusGroup = document.createElement('div');
    statusGroup.className = 'mtp-filter-group';
    statusGroup.innerHTML = '<div class="mtp-group-title">Status Filters</div>';
    const statusButtons = document.createElement('div');
    statusButtons.className = 'mtp-button-grid';
    ['atLeastOne','NotYet','U50','errToday','errLast'].forEach(id => {
        let el = document.getElementById(id);
        if(el) { el.removeAttribute('style'); el.className = 'mtp-filter-btn mtp-status-btn'; statusButtons.appendChild(el); }
    });
    statusGroup.appendChild(statusButtons);
    leftCol.appendChild(statusGroup);

    filtersContainer.appendChild(leftCol);

    // RIGHT COLUMN
    const rightCol = document.createElement('div');
    rightCol.className = 'mtp-right-col';

    // 4c. Time Filters (Right)
    const timeGroup = document.createElement('div');
    timeGroup.className = 'mtp-filter-group h-100';
    timeGroup.innerHTML = '<div class="mtp-group-title">Time Filters</div>';
    const timeButtons = document.createElement('div');
    timeButtons.className = 'mtp-button-grid mtp-time-grid';
    ['noToday','yesterday','threeDaysAgo','aWeekAgo','aMonthAgo'].forEach(id => {
        let el = document.getElementById(id);
        if(el) { el.removeAttribute('style'); el.className = 'mtp-filter-btn mtp-time-btn'; timeButtons.appendChild(el); }
    });
    timeGroup.appendChild(timeButtons);
    rightCol.appendChild(timeGroup);

    filtersContainer.appendChild(rightCol);

    topPanel.appendChild(filtersContainer);
`;

const newCSS = `
/* Filter Split Layout CSS */
.split-layout {
    display: flex;
    gap: 24px;
    align-items: stretch;
}
.mtp-left-col {
    flex: 3;
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.mtp-right-col {
    flex: 1;
    display: flex;
    flex-direction: column;
}
.h-100 {
    height: 100%;
    display: flex;
    flex-direction: column;
}
.mtp-time-grid {
    display: flex !important;
    flex-direction: column;
    gap: 8px;
    flex: 1;
}
.mtp-time-grid .mtp-filter-btn {
    flex: 1; /* Stretch vertically to match left column height */
    display: flex;
    align-items: center;
    justify-content: center;
}
.mtp-status-btn {
    background: #fdf2f8 !important;
    border-color: #fbcfe8 !important;
    color: #be185d !important;
}
.mtp-status-btn:hover {
    background: #fbcfe8 !important;
    border-color: #f9a8d4 !important;
}
.mtp-time-btn {
    background: #f0fdf4 !important;
    border-color: #bbf7d0 !important;
    color: #15803d !important;
}
.mtp-time-btn:hover {
    background: #bbf7d0 !important;
    border-color: #86efac !important;
}
`;

// Replace the old JS logic
const oldJSRegex = /\/\/ 4\. Filters Row \(Level 0 to One Month Ago\)[\s\S]*?topPanel\.appendChild\(filtersContainer\);/;
if (content.match(oldJSRegex)) {
    content = content.replace(oldJSRegex, updatedJS);
}

// Add the new CSS
content = content.replace('</style>', newCSS + '\\n</style>');

fs.writeFileSync(file, content);
console.log("Filter layout split successfully.");
