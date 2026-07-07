const fs = require('fs');
let lines = fs.readFileSync('sample020.php', 'utf8').split('\n');

let targetIdx = lines.findIndex(l => l.includes('async function listChange(categorySelect) {'));
if (targetIdx !== -1) {
    // Replace the next line (console.log) to avoid errors with null id
    lines[targetIdx + 1] = '    console.log("Triggered by:", categorySelect?.id);';
    
    // Insert the new logic
    const injection = `    if (categorySelect && categorySelect.id === 'ctg1') {
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
    }`;
    
    lines.splice(targetIdx + 2, 0, injection);
    fs.writeFileSync('sample020.php', lines.join('\n'));
    console.log('Successfully injected advanced search reset logic');
} else {
    console.log('Target function not found');
}
