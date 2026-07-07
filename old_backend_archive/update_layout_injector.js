const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

const dashboardJS = `
<script>
window.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('.dashboard-layout')) return;

    const wrapper = document.createElement('div');
    wrapper.className = 'dashboard-layout fade-in';
    
    const sidebar = document.createElement('aside');
    sidebar.className = 'dashboard-sidebar glass-panel';
    
    const main = document.createElement('main');
    main.className = 'dashboard-main';
    
    const rightBar = document.createElement('aside');
    rightBar.className = 'dashboard-rightbar glass-panel';

    // Header
    const brand = document.createElement('h1');
    brand.textContent = 'T-System';
    brand.style.textAlign = 'center';
    brand.style.color = 'var(--accent-primary)';
    brand.style.marginBottom = '20px';
    sidebar.appendChild(brand);

    // --- Left Sidebar (Filters & Categories) ---
    const leftScroll = document.createElement('div');
    sidebar.appendChild(leftScroll);
    
    const catGroup = document.createElement('div');
    catGroup.className = 'control-group';
    catGroup.innerHTML = '<h3>Categories</h3>';
    for(let i=1; i<=6; i++) {
        let el = document.getElementById('ctg'+i) || document.getElementById('category'+i);
        if(el) { el.style.width='100%'; el.style.marginBottom='5px'; catGroup.appendChild(el); }
    }
    let wordSearch = document.getElementById('wordSearch');
    if(wordSearch) { wordSearch.style.width='100%'; catGroup.appendChild(wordSearch); }
    leftScroll.appendChild(catGroup);

    const levelGroup = document.createElement('div');
    levelGroup.className = 'control-group levels-grid';
    levelGroup.innerHTML = '<h3 style="grid-column:1/-1">Levels</h3>';
    ['Lv0','Lv1','Lv2','Lv3','Lv4','qlevel'].forEach(id => {
        let el = document.getElementById(id);
        if(el) { el.style.width='100%'; levelGroup.appendChild(el); }
    });
    leftScroll.appendChild(levelGroup);

    const filterGroup = document.createElement('div');
    filterGroup.className = 'control-group';
    filterGroup.innerHTML = '<h3>Filters</h3>';
    ['atLeastOne','NotYet','yesterday','noToday','U50','errToday','errLast','threeDaysAgo','aWeekAgo'].forEach(id => {
        let el = document.getElementById(id);
        if(el) { el.style.width='48%'; el.style.margin='1%'; filterGroup.appendChild(el); }
    });
    leftScroll.appendChild(filterGroup);

    // --- Main Content (Q&A and Main Buttons) ---
    let qanda = document.getElementById('QandAwindow');
    if(qanda) main.appendChild(qanda);
    
    let textareas2 = document.getElementById('textareas2');
    if(textareas2) main.appendChild(textareas2);
    
    const actionWrapper = document.createElement('div');
    actionWrapper.className = 'action-panel glass-panel';
    actionWrapper.style.flexWrap = 'wrap';
    
    // Move all major buttons
    const buttonsToMove = [
        'button01', 'button02', 'autoQuestionButton', 'buttonmodifyquestion',
        'button05', 'button06', 'button07'
    ];
    buttonsToMove.forEach(id => {
        let el = document.getElementById(id);
        if(el) actionWrapper.appendChild(el);
    });
    
    // Collect all elements named botan03 (Good) and botan04 (Poor)
    document.querySelectorAll('input[name="botan03"], input[name="botan04"]').forEach(el => {
        actionWrapper.appendChild(el);
    });
    main.appendChild(actionWrapper);

    // --- Right Sidebar (Settings & Info) ---
    let massages = document.getElementById('massages');
    if(massages) { massages.style.width='100%'; massages.style.display='block'; rightBar.appendChild(massages); }
    
    let infoText = document.getElementById('information');
    if(infoText) { infoText.style.width='100%'; infoText.style.height='150px'; }

    const settingsGroup = document.createElement('div');
    settingsGroup.className = 'control-group';
    settingsGroup.innerHTML = '<h3>Settings</h3>';
    const settingsControls = [
        'fontresize', 'autoSpeed', 'autoReading', 'jpSpeed', 'engSpeed', 
        'NOC', 'autoAnswer', 'backGround', 'fontSelect', 'poorat', 'poorat2'
    ];
    settingsControls.forEach(id => {
        let el = document.getElementById(id);
        if(el) { el.style.width='100%'; el.style.marginBottom='5px'; settingsGroup.appendChild(el); }
    });
    
    const checks = ['qachange', 'autoread', 'keyControl', 'answerByMyself', 'randomOrNot', 'chordsOrNot', 'flexButton', 'blackCheck'];
    checks.forEach(id => {
        let el = document.getElementById(id);
        if(el) {
            let label = document.createElement('label');
            label.style.display = 'flex';
            label.style.alignItems = 'center';
            label.style.marginBottom = '5px';
            label.appendChild(el);
            label.appendChild(document.createTextNode(' ' + id));
            settingsGroup.appendChild(label);
        }
    });
    rightBar.appendChild(settingsGroup);
    
    let gp1 = document.getElementById('grandParent1');
    if(gp1) rightBar.appendChild(gp1);

    // Inject into body
    let mainform = document.getElementById('mainform');
    if(mainform) {
        document.body.appendChild(wrapper);
        wrapper.appendChild(sidebar);
        wrapper.appendChild(main);
        wrapper.appendChild(rightBar);
        // Hide only the mainform remnants, keeping elements functional
        mainform.style.display = 'none';
    }
});
</script>
`;

// Regex to replace the old script block I injected
const regex = /<script>\s*window\.addEventListener\('DOMContentLoaded', \(\) => \{\s*if\(document\.querySelector\('.dashboard-layout'\)\) return;[\s\S]*?<\/script>/;
if (content.match(regex)) {
    content = content.replace(regex, dashboardJS);
} else {
    // If somehow it didn't match, just append it before </body>
    content = content.replace('</body>', dashboardJS + '\n</body>');
}

fs.writeFileSync(file, content);
console.log("Updated Layout Injector applied to sample020.php");
