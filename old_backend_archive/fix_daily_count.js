const fs = require('fs');

let content = fs.readFileSync('sample020.php', 'utf8');

// 1. Add ID to the span
const spanTarget = /<span class='stat-item'>今日やった合計は \{\$todayQuestonDone\} です。<\/span>/g;
content = content.replace(spanTarget, "<span id='todayTotalDone' class='stat-item'>今日やった合計は {$todayQuestonDone} です。</span>");

// 2. Inject the function definition before updateRecordSupabase
const funcTarget = "async function updateRecordSupabase(qnum, isCorrect, pastTime, pooratVal) {";
const newFunc = `async function updateAndDisplayDailyTotal(isCorrect = null) {
    try {
        let db_name = document.mainform.DB_name.value || 'terashima01';
        db_name = db_name.toLowerCase();
        
        // Ensure we format date as YYYY-MM-DD local
        const today = new Date().toLocaleDateString('ja-JP').replace(/\\//g, '-').split('-').map(n => n.padStart(2, '0')).join('-');
        
        const { data, error } = await supabaseClient.from('a01tsystemrecord01').select('*').eq('id', db_name).eq('qdate', today).single();
        let correct = 0; let incorrect = 0;
        if (data) {
            correct = data.correct || 0;
            incorrect = data.incorrect || 0;
        }
        
        if (isCorrect === true) correct++;
        if (isCorrect === false) incorrect++;
        
        if (isCorrect !== null) {
            if (data) {
                await supabaseClient.from('a01tsystemrecord01').update({ correct, incorrect }).eq('id', db_name).eq('qdate', today);
            } else {
                await supabaseClient.from('a01tsystemrecord01').insert({ id: db_name, qdate: today, correct, incorrect });
            }
        }
        
        const total = correct + incorrect;
        const el = document.getElementById('todayTotalDone');
        if (el) el.innerText = \`今日やった合計は \${total} です。\`;
    } catch(e) {
        console.error("Failed to update daily total:", e);
    }
}

async function updateRecordSupabase(qnum, isCorrect, pastTime, pooratVal) {
    updateAndDisplayDailyTotal(isCorrect); // Fire and forget
`;

content = content.replace(funcTarget, newFunc);

// 3. Add the initial call on page load
// The bottom of the file has: qBoxes.forEach(b => b.style.display = 'none'); }); </script>
const loadTarget = "qBoxes.forEach(b => b.style.display = 'none');\n});";
const initCall = "qBoxes.forEach(b => b.style.display = 'none');\n    updateAndDisplayDailyTotal(null);\n});";

content = content.replace(loadTarget, initCall);

fs.writeFileSync('sample020.php', content);
console.log("Fixed daily total display logic.");
