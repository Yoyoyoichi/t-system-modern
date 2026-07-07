
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

    
    
    // 2. Stats Row (Compact)
    const statsRow = document.createElement('div');
    statsRow.className = 'mtp-stats-row';
    const massages = document.getElementById('massages');
    if(massages) { 
        massages.className = 'modern-stats'; 
        
        // Parse the text to create a compact flex layout
        const p = massages.querySelector('p');
        if(p) {
            const text = p.innerHTML;
            const cleanText = text.replace(/<br>\s*<br>/gi, '<span class="stat-sep"></span>').replace(/\n/g, '');
            p.innerHTML = cleanText;
            p.className = 'compact-stats-text';
        }
        statsRow.appendChild(massages); 
    }

    // Completely remove the old information textarea AND its parent div to be 100% sure it's gone
    const infoTextarea = document.getElementById('information');
    if(infoTextarea) {
        const parent = infoTextarea.parentElement;
        if(parent && parent.tagName === 'DIV') {
            parent.style.display = 'none';
            parent.remove(); // Nuke it from the DOM completely
        }
        infoTextarea.style.display = 'none';
        infoTextarea.remove();
    }

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
