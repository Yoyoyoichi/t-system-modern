const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');
const r = /async function fetchAnswerFromSupabase[\s\S]*?return reply;\n}/;
const newF = `async function fetchAnswerFromSupabase(qnum, mode) {
    let db_name = document.mainform?.DB_name?.value || 'terashima01';
    db_name = db_name.toLowerCase();
    
    let data = window.allQuestionsData ? window.allQuestionsData.find(r => r.questionnumber == qnum) : null;
    if (!data) return "Error fetching answer";

    let reply = "";
    if (mode === 2) {
        reply = data.question || "";
        if (reply === "NULL") reply = "";
        if (data.hint && data.hint !== "NULL") reply += "\\n............................................................\\n" + data.hint;
    } else {
        reply = data.answer1 || "";
        if (reply === "NULL") reply = "";
        
        for (let i = 2; i <= 15; i++) {
            let val = data['answer'+i];
            if (val !== null && val !== undefined && val !== "NULL" && String(val).trim() !== "") {
                if (reply !== "") {
                    reply += ",\\n" + val;
                } else {
                    reply = val;
                }
            }
        }
        if (data.hint && data.hint !== "NULL") {
            reply += "\\n............................................................\\n" + data.hint;
        }
    }
    return reply;
}`;
if(c.match(r)){
    c = c.replace(r, newF);
    fs.writeFileSync('sample020.php', c);
    console.log("Replaced using RegExp script");
} else {
    console.log("Regex not found");
}
