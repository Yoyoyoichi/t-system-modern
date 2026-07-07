const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8').replace(/\r\n/g, '\n');

// 1. Rewrite fetchQuestionsFromSupabase
const startIndex = c.indexOf('async function fetchQuestionsFromSupabase() {');
const endIndex = c.indexOf('async function updateAndDisplayDailyTotal(isCorrect = null) {');
if (startIndex !== -1 && endIndex !== -1) {
    const originalFunc = c.substring(startIndex, endIndex);
    const newFunc = `async function fetchQuestionsFromSupabase() {
    let db_name = document.mainform.DB_name.value || 'terashima01';
    db_name = db_name.toLowerCase();

    const getSelected = (id) => {
        const elem = document.getElementById(id);
        if(!elem) return [];
        const opts = elem.options;
        const selected = [];
        for (let i = 0; i < opts.length; i++) {
            if (opts[i].selected && opts[i].value !== "") {
                selected.push(opts[i].value);
            }
        }
        return selected;
    };

    const category1 = getSelected('ctg1');
    const category2 = getSelected('ctg2');
    const category3 = getSelected('ctg3');
    const category4List = getSelected('ctg4');
    const category5List = getSelected('ctg5');

    const cat4 = document.mainform.category4.value;
    const cat5 = document.mainform.category5.value;
    const cat6 = document.mainform.category6.value;
    const op1 = document.mainform.operator1.value;
    const op2 = document.mainform.operator2.value;
    const op3 = document.mainform.operator3.value;
    const crit1 = document.mainform.criteria1.value;
    const crit2 = document.mainform.criteria2.value;
    const crit3 = document.mainform.criteria3.value;
    const poorat2 = document.mainform.poorat2.value;
    const qlevel = document.mainform.qlevel.value;
    const wordSearch = document.mainform.wordSearch.value;

    const buildQuery = () => {
        let query = supabaseClient.from(db_name).select('questionnumber,pre_qdate,qdate');

        if (category1.length > 0) query = query.in('category1', category1);
        if (category2.length > 0) query = query.in('category2', category2);
        if (category3.length > 0) query = query.in('category3', category3);
        if (category4List.length > 0) query = query.in('category4', category4List);
        if (category5List.length > 0) query = query.in('category5', category5List);

        const applyCondition = (q, cat, op, crit) => {
            if (!cat || !op || !crit) return q;
            if (cat === "qdate" && op === "=") {
                if(crit.length >= 8) {
                    let formattedDate = crit.substring(0,4) + "-" + crit.substring(4,6) + "-" + crit.substring(6,8);
                    return q.like('pre_qdate', \`%\${formattedDate}%\`);
                }
            }
            if (op === "=") return q.eq(cat, crit);
            if (op === ">") return q.gt(cat, crit);
            if (op === "<") return q.lt(cat, crit);
            if (op === ">=") return q.gte(cat, crit);
            if (op === "<=") return q.lte(cat, crit);
            if (op === "like") return q.like(cat, \`%\${crit}%\`);
            if (op === "!=") return q.neq(cat, crit);
            return q;
        };

        query = applyCondition(query, cat4, op1, crit1);
        query = applyCondition(query, cat5, op2, crit2);
        query = applyCondition(query, cat6, op3, crit3);

        if (poorat2) query = query.eq('poorat', poorat2);
        if (qlevel) query = query.eq('q_level', qlevel);
        if (yesterdayIncorrect) query = query.like('q_record', '×%');
        
        if (wordSearch) {
            const ws = wordSearch.toLowerCase();
            query = query.or(\`question.ilike.%\${ws}%,answer1.ilike.%\${ws}%,hint.ilike.%\${ws}%,tag.ilike.%\${ws}%,category1.ilike.%\${ws}%,category2.ilike.%\${ws}%,category3.ilike.%\${ws}%,category4.ilike.%\${ws}%,category5.ilike.%\${ws}%\`);
        }

        return query;
    };

    let promises = [];
    for (let i = 0; i < 20; i++) {
        promises.push(buildQuery().range(i * 1000, (i + 1) * 1000 - 1));
    }
    
    let results = await Promise.all(promises);
    let filteredData = [];
    results.forEach(res => {
        if (res.data) {
            filteredData = filteredData.concat(res.data);
        }
    });

    if (cat4 === "qdate" && cat5 === "qdate" && cat6 === "qdate" && op1 === "=" && op2 === "=" && op3 === "=") {
        let halfYearAgo = new Date();
        halfYearAgo.setMonth(halfYearAgo.getMonth() - 6);
        const yyyymmdd = halfYearAgo.toISOString().split('T')[0].replace(/-/g, '');
        
        let resultNums = [];
        for (let row of filteredData) {
            let pq = (row.pre_qdate || "").replace(/-/g, '');
            if (pq.includes(crit1) || pq.includes(crit2) || pq.includes(crit3) || pq === yyyymmdd) {
                resultNums.push(row.questionnumber);
            }
        }
        
        const today = new Date().toISOString().split('T')[0];
        const { data: todayData } = await supabaseClient.from(db_name).select('questionnumber').eq('qdate', today);
        const todayNums = todayData ? todayData.map(d => d.questionnumber) : [];
        
        return resultNums.filter(num => !todayNums.includes(num));
    }

    return filteredData.map(row => row.questionnumber);
}

`;
    c = c.replace(originalFunc, newFunc);
}

fs.writeFileSync('sample020.php', c);
console.log("Rewrite 1 Complete");
