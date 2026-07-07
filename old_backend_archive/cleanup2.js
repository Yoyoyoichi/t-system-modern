const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

// Find all script blocks and delete them if they contain "modern-top-panel"
const parts = content.split('<script>');
let newContent = parts[0];
for (let i = 1; i < parts.length; i++) {
    const endIdx = parts[i].indexOf('</script>');
    if (endIdx !== -1) {
        const scriptContent = parts[i].substring(0, endIdx);
        if (scriptContent.includes('modern-top-panel')) {
            // skip this script block
            newContent += parts[i].substring(endIdx + 9);
        } else {
            // keep it
            newContent += '<script>' + parts[i];
        }
    } else {
        newContent += '<script>' + parts[i];
    }
}
content = newContent;

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

content = content.replace('</body>', partialDashboardJS + '\n</body>');
fs.writeFileSync(file, content);
console.log("Cleanup v2 and injection successful.");
