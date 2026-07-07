const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8').replace(/\r\n/g, '\n');

// Rewrite fetchQuestionFromSupabase
const startIndex2 = c.indexOf('async function fetchQuestionFromSupabase(qnum, mode) {');
const endIndex2 = c.indexOf('async function fetchAnswerFromSupabase(qnum, mode) {');
if (startIndex2 !== -1 && endIndex2 !== -1) {
    const originalFunc = c.substring(startIndex2, endIndex2);
    const newFunc = `async function fetchQuestionFromSupabase(qnum, mode) {
    let db_name = document.mainform.DB_name.value || 'terashima01';
    db_name = db_name.toLowerCase();
    
    const { data: row } = await supabaseClient.from(db_name).select('*').eq('questionnumber', qnum).single();
    let data = row;
    if (!data) return "Error fetching question^^^Error^^^";

    let questionText = mode === 2 ? data.answer1 : data.question;
    
    let info = "";
    if (mode === 2) {
        info += "Level：" + (data.q_level || "") + " <br>";
        info += "正解数：" + (data.correct2 || 0) + " 不正解数：" + (data.incorrect2 || 0) + "<br>";
        info += "前回：" + (data.pre_qdate ? data.pre_qdate.substring(0, 33) : "") + "<br>";
        info += "記録：" + (data.q_record || "");
    } else {
        info += (data.category1 || "");
        if (data.category2) info += " - " + data.category2;
        if (data.category3) info += " - " + data.category3;
        if (data.category4) info += " - " + data.category4;
        if (data.category5) info += " - " + data.category5;
        info += "    <br>Level：" + (data.q_level || "") + "   ";
        info += "正解数：" + (data.correct2 || 0) + " 不正解数：" + (data.incorrect2 || 0) + "   ";
        info += "前回：" + (data.pre_qdate ? data.pre_qdate.substring(0, 33) : "") + "<br>";
        info += "記録：" + (data.q_record || "");
        if (data.qsentence) info += "<br>" + data.qsentence;
        if (data.tag) info += "<br>" + data.tag;
        info += "<br>問題番号：" + (data.questionnumber || "");
    }
    
    return questionText + "^^^" + info + "^^^" + (data.q_record || "") + "^^^" + (data.q_level || "") + "^^^" + (data.poorat || "");
}

`;
    c = c.replace(originalFunc, newFunc);
}

// Rewrite fetchAnswerFromSupabase
const startIndex3 = c.indexOf('async function fetchAnswerFromSupabase(qnum, mode) {');
const endIndex3 = c.indexOf('function createXmlHttpRequest2(){');
if (startIndex3 !== -1 && endIndex3 !== -1) {
    const originalFunc = c.substring(startIndex3, endIndex3);
    const newFunc = `async function fetchAnswerFromSupabase(qnum, mode) {
    let db_name = document.mainform?.DB_name?.value || 'terashima01';
    db_name = db_name.toLowerCase();
    
    const { data: row } = await supabaseClient.from(db_name).select('*').eq('questionnumber', qnum).single();
    let data = row;
    if (!data) return "Error fetching answer";

    let reply = "";
    if (mode === 2) {
        reply = data.question || "";
    } else {
        reply = data.answer1 || "";
    }
    
    if (reply === "NULL") return "";
    return reply;
}

`;
    c = c.replace(originalFunc, newFunc);
}

fs.writeFileSync('sample020.php', c);
console.log("Rewrite 2 and 3 Complete");
