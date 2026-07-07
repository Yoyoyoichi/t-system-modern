const fs = require('fs');
let content = fs.readFileSync('sample020.php', 'utf8');

const targetStr = `async function listChange(categorySelect) {
    console.log("Triggered by:", categorySelect.id);
    firstRemoveFlag = false;`;

const newStr = `async function listChange(categorySelect) {
    console.log("Triggered by:", categorySelect?.id);
    if (categorySelect && categorySelect.id === 'ctg1') {
        const resetVal = (id, val) => { const el = document.getElementById(id); if (el) el.value = val; };
        resetVal('wordSearch', '');
        resetVal('category4', '*');
        resetVal('operator1', '=');
        resetVal('criteria1', '');
        resetVal('category5', '*');
        resetVal('operator2', '=');
        resetVal('criteria2', '');
        resetVal('category6', '*');
        resetVal('operator3', '=');
        resetVal('criteria3', '');
        
        if (typeof $ !== 'undefined' && $.fn.chosen) {
            $('#category4, #operator1, #category5, #operator2, #category6, #operator3').trigger('chosen:updated');
        }
    }
    firstRemoveFlag = false;`;

if (content.includes("async function listChange(categorySelect) {")) {
    content = content.replace(targetStr, newStr);
    fs.writeFileSync('sample020.php', content);
    console.log('Successfully injected reset logic for Advanced Search');
} else {
    console.log('Target string not found');
}
