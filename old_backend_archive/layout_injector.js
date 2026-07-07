const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

// The JS that will dynamically reshape the DOM into a Dashboard
const dashboardJS = `
<script>
window.addEventListener('DOMContentLoaded', () => {
    // Only run if not already restructured
    if(document.querySelector('.dashboard-layout')) return;

    const wrapper = document.createElement('div');
    wrapper.className = 'dashboard-layout fade-in';
    
    const sidebar = document.createElement('aside');
    sidebar.className = 'dashboard-sidebar glass-panel';
    
    const main = document.createElement('main');
    main.className = 'dashboard-main';
    
    const rightBar = document.createElement('aside');
    rightBar.className = 'dashboard-rightbar glass-panel';

    // Header/Brand
    const brand = document.createElement('h1');
    brand.textContent = 'T-System';
    brand.style.textAlign = 'center';
    brand.style.color = 'var(--accent-primary)';
    brand.style.marginBottom = '20px';
    sidebar.appendChild(brand);

    // --- Move Elements to Left Sidebar ---
    
    // Category Selects wrapper
    const catWrapper = document.createElement('div');
    catWrapper.className = 'control-group';
    catWrapper.innerHTML = '<h3>Categories</h3>';
    for(let i=1; i<=5; i++) {
        let el = document.getElementById('ctg'+i);
        if(el) {
            el.style.width = '100%';
            el.style.height = '120px';
            el.style.marginBottom = '10px';
            catWrapper.appendChild(el);
        }
    }
    sidebar.appendChild(catWrapper);

    // Levels wrapper
    const levelWrapper = document.createElement('div');
    levelWrapper.className = 'control-group levels-grid';
    levelWrapper.innerHTML = '<h3>Levels</h3>';
    ['Lv0','Lv1','Lv2','Lv3','Lv4'].forEach(id => {
        let el = document.getElementById(id);
        if(el) {
            el.style.width = '100%';
            el.style.margin = '2px';
            levelWrapper.appendChild(el);
        }
    });
    sidebar.appendChild(levelWrapper);

    // Filters wrapper
    const filterWrapper = document.createElement('div');
    filterWrapper.className = 'control-group';
    filterWrapper.innerHTML = '<h3>Filters</h3>';
    ['atLeastOne','NotYet','yesterday','noToday','U50','errToday','errLast','threeDaysAgo','aWeekAgo'].forEach(id => {
        let el = document.getElementById(id);
        if(el) {
            el.style.width = '48%';
            el.style.margin = '1%';
            filterWrapper.appendChild(el);
        }
    });
    sidebar.appendChild(filterWrapper);

    // --- Move Elements to Main Content ---
    let qanda = document.getElementById('QandAwindow');
    if(qanda) {
        main.appendChild(qanda);
    }
    
    // Move main control buttons to Main Area (bottom)
    const actionWrapper = document.createElement('div');
    actionWrapper.className = 'action-panel glass-panel';
    let btnStart = document.getElementById('autoQuestionButton');
    let btnMod = document.getElementById('buttonmodifyquestion');
    if(btnStart) actionWrapper.appendChild(btnStart);
    if(btnMod) actionWrapper.appendChild(btnMod);
    main.appendChild(actionWrapper);


    // --- Move Elements to Right Sidebar ---
    let massages = document.getElementById('massages');
    if(massages) {
        massages.style.width = '100%';
        massages.style.display = 'block';
        rightBar.appendChild(massages);
    }
    
    let infoText = document.getElementById('information');
    if(infoText) {
        infoText.style.width = '100%';
        infoText.style.height = '200px';
    }

    let gp1 = document.getElementById('grandParent1');
    if(gp1) {
        rightBar.appendChild(gp1);
    }

    // --- Hide the messy form leftovers ---
    let mainform = document.getElementById('mainform');
    if(mainform) {
        // Append wrapper to body
        document.body.appendChild(wrapper);
        wrapper.appendChild(sidebar);
        wrapper.appendChild(main);
        wrapper.appendChild(rightBar);
        
        // Hide remaining ugly form elements that weren't moved
        mainform.style.display = 'none';
        
        // Important: we need to ensure the form still submits if they use it.
        // Actually, they don't submit the form anymore since we moved to JS/Supabase!
    }
});
</script>
`;

// Insert the JS at the bottom of the body
if (!content.includes('dashboard-layout')) {
    content = content.replace('</body>', dashboardJS + '\n</body>');
}

fs.writeFileSync(file, content);
console.log("Layout injector JS added to sample020.php");
