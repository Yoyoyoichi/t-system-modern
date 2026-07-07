const fs = require('fs');

let content = fs.readFileSync('sample020.php', 'utf8');

// 1. Replace the PHP stat spans
const statsTarget = `    echo "<p class='compact-stats-text'>\\n";
    echo "<span class='stat-item'>やった問題数の合計は {$testo} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span id='todayTotalDone' class='stat-item'>今日やった合計は {$todayQuestonDone} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span class='stat-item'>正解の合計は {$test2} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span class='stat-item'>不正解の合計は {$test3} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span class='stat-item'>正答率は {$seitoritu} ％です。</span> <span class='stat-sep'></span>\\n";`;

const newStats = `    echo "<p class='compact-stats-text'>\\n";
    echo "<span id='stat-total-q' class='stat-item' data-val='{$testo}'>やった問題数の合計は {$testo} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span id='todayTotalDone' class='stat-item' data-val='{$todayQuestonDone}'>今日やった合計は {$todayQuestonDone} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span id='stat-total-correct' class='stat-item' data-val='{$test2}'>正解の合計は {$test2} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span id='stat-total-incorrect' class='stat-item' data-val='{$test3}'>不正解の合計は {$test3} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span id='stat-correct-rate' class='stat-item' data-val='{$seitoritu}'>正答率は {$seitoritu} ％です。</span> <span class='stat-sep'></span>\\n";`;

if (content.includes("echo \"<span class='stat-item'>やった問題数の合計は {$testo} です。</span>")) {
    content = content.replace(statsTarget, newStats);
}

// 2. Replace the broken updateAndDisplayDailyTotal function
const jsTargetStart = "async function updateAndDisplayDailyTotal(isCorrect = null) {";
const jsTargetEnd = "    updateAndDisplayDailyTotal(isCorrect); // Fire and forget";

// Extract the exact block to replace
const startIdx = content.indexOf(jsTargetStart);
if (startIdx !== -1) {
    const endIdx = content.indexOf(jsTargetEnd, startIdx) + jsTargetEnd.length;
    
    const newJs = `async function updateAndDisplayDailyTotal(isCorrect = null) {
    try {
        let db_name = document.mainform?.DB_name?.value || 'terashima01';
        db_name = db_name.toLowerCase();
        const today = new Date().toLocaleDateString('ja-JP').replace(/\\//g, '-').split('-').map(n => n.padStart(2, '0')).join('-');
        
        // Use questionnumber = -100 for DAILY, -101 for ALL_TIME
        // Fetch both
        const { data: records } = await supabaseClient.from(db_name).select('*').in('questionnumber', [-100, -101]);
        
        let dailyRow = records?.find(r => r.questionnumber === -100);
        let allRow = records?.find(r => r.questionnumber === -101);
        
        // 1. Initialize ALL_TIME if missing
        if (!allRow) {
            const fallbackTotalQ = document.getElementById('stat-total-q')?.getAttribute('data-val') || 0;
            const fallbackCorr = parseInt(document.getElementById('stat-total-correct')?.getAttribute('data-val') || 0);
            const fallbackIncorr = parseInt(document.getElementById('stat-total-incorrect')?.getAttribute('data-val') || 0);
            
            allRow = { questionnumber: -101, question: 'ALL_TIME_RECORD', correct: fallbackCorr, incorrect: fallbackIncorr, category1: fallbackTotalQ.toString() };
            await supabaseClient.from(db_name).insert(allRow);
        }
        
        // 2. Initialize DAILY if missing or stale
        if (!dailyRow || dailyRow.qdate !== today) {
            // Delete stale daily row just in case, though upsert would overwrite if pk matches
            // Actually questionnumber -100 is the pk, so upsert overwrites!
            dailyRow = { questionnumber: -100, question: 'DAILY_RECORD', qdate: today, correct: 0, incorrect: 0 };
            await supabaseClient.from(db_name).upsert(dailyRow);
        }
        
        // 3. Increment if answering
        if (isCorrect !== null) {
            if (isCorrect) {
                dailyRow.correct = (dailyRow.correct || 0) + 1;
                allRow.correct = (allRow.correct || 0) + 1;
            } else {
                dailyRow.incorrect = (dailyRow.incorrect || 0) + 1;
                allRow.incorrect = (allRow.incorrect || 0) + 1;
            }
            // Update Supabase
            await supabaseClient.from(db_name).upsert([dailyRow, allRow]);
        }
        
        // 4. Update DOM
        const dailyTotal = (dailyRow.correct || 0) + (dailyRow.incorrect || 0);
        const allCorrect = allRow.correct || 0;
        const allIncorrect = allRow.incorrect || 0;
        const totalQ = allRow.category1 || document.getElementById('stat-total-q')?.getAttribute('data-val') || 0;
        const rate = (allCorrect + allIncorrect) > 0 ? ((allCorrect / (allCorrect + allIncorrect)) * 100).toFixed(2) : 0;
        
        const elToday = document.getElementById('todayTotalDone');
        if (elToday) elToday.innerText = \`今日やった合計は \${dailyTotal} です。\`;
        
        const elQ = document.getElementById('stat-total-q');
        if (elQ) elQ.innerText = \`やった問題数の合計は \${totalQ} です。\`;
        
        const elC = document.getElementById('stat-total-correct');
        if (elC) elC.innerText = \`正解の合計は \${allCorrect} です。\`;
        
        const elI = document.getElementById('stat-total-incorrect');
        if (elI) elI.innerText = \`不正解の合計は \${allIncorrect} です。\`;
        
        const elR = document.getElementById('stat-correct-rate');
        if (elR) elR.innerText = \`正答率は \${rate} ％です。\`;
        
    } catch(e) {
        console.error("Failed to update stats:", e);
    }
}

async function updateRecordSupabase(qnum, isCorrect, pastTime, pooratVal) {
    updateAndDisplayDailyTotal(isCorrect); // Fire and forget`;

    content = content.substring(0, startIdx) + newJs + content.substring(endIdx);
}

fs.writeFileSync('sample020.php', content);
console.log("Stats migration script injected successfully!");
