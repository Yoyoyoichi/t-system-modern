
const supabaseUrl = 'https://eqtxzxqvkprnmkiyczvv.supabase.co';
const supabaseKey = 'sb_publishable_L9iiPiRICnSt60jLa_xT9A_dgTphJ2e';
const supabaseClient = supabase.createClient(supabaseUrl, supabaseKey);

async function myFetch(url, dataStr) {
    try {
        let response = await fetch(url, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: dataStr
        });
        return await response.text();
    } catch (e) {
        console.error("Fetch error:", e);
        return "";
    }
}


var sendbackDBName = location.search.substring(1);
// console.log('sendbackDBName is '+sendbackDBName);
if (sendbackDBName) {
    document.getElementById("DB_name").value = sendbackDBName;
}
document.getElementById("div2").style.display = "none";
document.getElementById("div2").style.display = "none";
document.getElementById("div1").style.display = "none";
var num = 0;
var flag1 = false;
var oneByOneflag = false;
var twoByTwoflag = false;
var threeByThreeflag = false;
var answertextareaflag = false;
var autoflag = false;
var randoms = [];
let rand = "";
var questionnumbers = "";
var min = 0, max = "";
var phpfile1 = "";
var phpfile2 = "";
var databasename = document.mainform.DB_name.value;
document.getElementById("reminder").href += "?"+databasename;
document.getElementById("resultgraph").href += "?"+databasename;
document.getElementById("UpdateSql").href += "?"+databasename;
document.getElementById("review2").href += "?"+databasename;
document.getElementById("TerashimaSheets").href += "?"+databasename;

// console.log('databasename is '+databasename);
var getQstartTime = 0;
var getQendTime = 0;
var getpastTime =0;
var now = 0;
var answertext="";
var questiontext="";
var imagefolder ="";
var speech;
var speech2;
var correctQuestions = new Array();
var incorrectQuestions = new Array();
var overlapCorrectQuestions = new Array();
var overlapIncorrectQuestions = new Array();
var minimumCorrect ;
var MaxQuestionNumber;
var AnswerShown = false;
var AnswerTypedFlag = false;
var AnswerShown2 = false;//自動回答表示の解除用
// var AnswerWaitingFlag = false;//自動解答表示を待っているかどうか
var sleepId = "";//sleepのタイマーのID
var mp3PlayFlag = false;
var imageHeight1;
var imageWidth1;
var imageHeight2;
var imageWidth2;
var yesterdayIncorrect =false;
var QnAareaFlexFlug = false;
var slashKakko = "\\\(";
var musicStartFlug = false;

const text1 = document.getElementById('textareas');



for (let i = 1; i < 500; i++) {//Mp3開始地点セレクト要素追加
    // selectタグを取得する
  var select = document.getElementById("mp3StartPoint");
  // optionタグを作成する
  var option = document.createElement("option");
  // optionタグのテキストを4に設定する
  option.text = i * 0.01 ;
  // optionタグのvalueを4に設定する
  option.value = i * 0.01;
  // selectタグの子要素にoptionタグを追加する
  select.appendChild(option);
}




async function fetchQuestionsFromSupabase() {
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
                    return q.like('pre_qdate', `%${formattedDate}%`);
                }
            }
            if (op === "=") return q.eq(cat, crit);
            if (op === ">") return q.gt(cat, crit);
            if (op === "<") return q.lt(cat, crit);
            if (op === ">=") return q.gte(cat, crit);
            if (op === "<=") return q.lte(cat, crit);
            if (op === "like") return q.like(cat, `%${crit}%`);
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
            query = query.or(`question.ilike.%${ws}%,answer1.ilike.%${ws}%,hint.ilike.%${ws}%,tag.ilike.%${ws}%,category1.ilike.%${ws}%,category2.ilike.%${ws}%,category3.ilike.%${ws}%,category4.ilike.%${ws}%,category5.ilike.%${ws}%`);
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

async function updateAndDisplayDailyTotal(isCorrect = null) {
    try {
        let db_name = document.mainform?.DB_name?.value || 'terashima01';
        db_name = db_name.toLowerCase();
        const today = new Date().toLocaleDateString('ja-JP').replace(/\//g, '-').split('-').map(n => n.padStart(2, '0')).join('-');
        
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
        if (elToday) elToday.innerText = `今日やった合計は ${dailyTotal} です。`;
        
        const elQ = document.getElementById('stat-total-q');
        if (elQ) elQ.innerText = `やった問題数の合計は ${totalQ} です。`;
        
        const elC = document.getElementById('stat-total-correct');
        if (elC) elC.innerText = `正解の合計は ${allCorrect} です。`;
        
        const elI = document.getElementById('stat-total-incorrect');
        if (elI) elI.innerText = `不正解の合計は ${allIncorrect} です。`;
        
        const elR = document.getElementById('stat-correct-rate');
        if (elR) elR.innerText = `正答率は ${rate} ％です。`;
        
    } catch(e) {
        console.error("Failed to update stats:", e);
    }
}

async function updateRecordSupabase(qnum, isCorrect, pastTime, pooratVal) {
    updateAndDisplayDailyTotal(isCorrect); // Fire and forget

    let db_name = document.mainform.DB_name.value || 'terashima01';
    db_name = db_name.toLowerCase();
    
    const { data: row, error } = await supabaseClient.from(db_name).select('*').eq('questionnumber', qnum).single();
    if (error || !row) {
        console.error("Supabase update error:", error);
        return;
    }

    let updates = {};
    const todayStr = new Date().toISOString().split('T')[0];
    const isToday = row.pre_qdate && String(row.pre_qdate).startsWith(todayStr);

    if (isCorrect) {
        updates.correct = (row.correct || 0) + 1;
        updates.PCA = updates.correct / (updates.correct + (row.incorrect || 0)) * 100;
    } else {
        updates.incorrect = (row.incorrect || 0) + 1;
        updates.PCA = (row.correct || 0) / ((row.correct || 0) + updates.incorrect) * 100;
    }
    updates.qdate = todayStr;
    updates.pasttime = pastTime;

    if (!isToday) {
        let q_record = row.q_record || "";
        let pre_qdate = row.pre_qdate || "";
        let q_level = row.q_level || 0;

        if (isCorrect) {
            updates.q_record = "〇" + q_record;
            updates.correct2 = (row.correct2 || 0) + 1;
            updates.pca2 = updates.correct2 / (updates.correct2 + (row.incorrect2 || 0)) * 100;
            updates.poorat = pooratVal;

            const matchRecord = (str) => q_record === str || q_record.startsWith(str + "×");
            if (!pre_qdate || q_record === "×" || matchRecord("〇") || matchRecord("〇〇") || matchRecord("〇〇〇") || matchRecord("〇〇〇〇") || matchRecord("〇〇〇〇〇") || matchRecord("〇〇〇〇〇〇")) {
                updates.q_level = q_level + 1;
            } else if (q_record.startsWith("〇〇〇〇〇〇〇〇〇〇")) {
                updates.q_level = q_level + 1;
            }
        } else {
            updates.q_record = "×" + q_record;
            updates.incorrect2 = (row.incorrect2 || 0) + 1;
            updates.pca2 = (row.correct2 || 0) / ((row.correct2 || 0) + updates.incorrect2) * 100;
            updates.q_level = q_level > 0 ? q_level - 1 : 0;
            updates.poorat = pooratVal;
        }

        let new_pre = todayStr + (pre_qdate ? "," + pre_qdate : "");
        new_pre = new_pre.replace(/,+$/, '').replace(/\s+$/, '');
        updates.pre_qdate = new_pre;
    }

    // Fire and forget, don't await to keep UI fast
    supabaseClient.from(db_name).update(updates).eq('questionnumber', qnum).then(({error}) => {
        if(error) console.error("Update fail:", error);
    });
}

async function fetchQuestionFromSupabase(qnum, mode) {
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

async function fetchAnswerFromSupabase(qnum, mode) {
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

function createXmlHttpRequest2(){
  var xmlhttp=null;
  if(window.ActiveXObject){
    try{
      xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e){
      try{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e2){
      }
    }
  }
  else if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

/** min以上max以下の整数値の乱数を返す */
function intRandom(min, max){
    return Math.floor( Math.random() * (max - min + 1)) + min;
}

async function listChange(categorySelect) {
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
    firstRemoveFlag = false;
    num = 0;
    flag1 = false;
    
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

    const updateDropdown = async (targetId, searchCategoryName, filterCriteria) => {
        const targetElement = document.getElementById(targetId);
        if(!targetElement) return;
        
        const currentSelections = getSelected(targetId);

        // Show loading state
        while (targetElement.lastChild) {
            targetElement.removeChild(targetElement.lastChild);
        }
        const loadingOption = document.createElement("option");
        loadingOption.value = "";
        loadingOption.innerText = "読込中...";
        targetElement.appendChild(loadingOption);
        try { $(`#${targetId}`).trigger("chosen:updated"); } catch(e) {}

        let query = supabaseClient.from(db_name).select(searchCategoryName).neq('question', 'settings');
        
        if (filterCriteria.ctg1 && filterCriteria.ctg1.length > 0) query = query.in('category1', filterCriteria.ctg1);
        if (filterCriteria.ctg2 && filterCriteria.ctg2.length > 0) query = query.in('category2', filterCriteria.ctg2);
        if (filterCriteria.ctg3 && filterCriteria.ctg3.length > 0) query = query.in('category3', filterCriteria.ctg3);
        if (filterCriteria.ctg4 && filterCriteria.ctg4.length > 0) query = query.in('category4', filterCriteria.ctg4);

        const { data, error } = await query;
        if (error) {
            console.error(`Error fetching ${searchCategoryName}:`, error);
            return;
        }

        let uniqueVals = [...new Set(data.map(item => item[searchCategoryName]))]
            .filter(val => val !== null && val !== undefined && String(val).trim() !== "")
            .map(val => String(val));
        
        // Remove loading state
        while (targetElement.lastChild) {
            targetElement.removeChild(targetElement.lastChild);
        }

        uniqueVals.forEach(val => {
            const option = document.createElement("option");
            option.value = val;
            option.innerText = val;
            if (currentSelections.includes(val)) {
                option.selected = true;
            }
            targetElement.appendChild(option);
        });

        try { $(`#${targetId}`).trigger("chosen:updated"); } catch(e) {}
    };

    const triggerId = categorySelect.id;
    let filters = { ctg1: getSelected('ctg1') };

    if (triggerId === 'ctg1') {
        await updateDropdown('ctg2', 'category2', filters);
    }
    
    filters.ctg2 = getSelected('ctg2');
    if (triggerId === 'ctg1' || triggerId === 'ctg2') {
        await updateDropdown('ctg3', 'category3', filters);
    }
    
    filters.ctg3 = getSelected('ctg3');
    if (triggerId === 'ctg1' || triggerId === 'ctg2' || triggerId === 'ctg3') {
        await updateDropdown('ctg4', 'category4', filters);
    }
    
    filters.ctg4 = getSelected('ctg4');
    if (triggerId === 'ctg1' || triggerId === 'ctg2' || triggerId === 'ctg3' || triggerId === 'ctg4') {
        await updateDropdown('ctg5', 'category5', filters);
    }
}


async function listChanged(){
  firstRemoveFlag = false;
  num = -1;
  flag1 = false;
  
  const infoEl = document.getElementById("questionInfo");
  if (infoEl) infoEl.innerHTML = "DB読み込み中... (Loading DB...)";
  
  questionnumbers = await fetchQuestionsFromSupabase();
  
  if (infoEl) infoEl.innerHTML = "DB読み込み完了。該当問題数: " + (questionnumbers ? questionnumbers.length : 0);
  const totalQEl = document.getElementById("totalQuestionNumber");
  if (totalQEl) totalQEl.innerHTML = (questionnumbers ? questionnumbers.length : 0);
  
  MaxQuestionNumber = questionnumbers ? questionnumbers.length : 0;
}

async function backQuestion(){
  if ((document.getElementById("novelSelect").value) && !(document.getElementById("novelSelect").value == "なし")){
    //小説戻す
    novelRowNum = Number(novelRowNum)-1
    getNovelSentence();
  }
  now = new Date();
  getQstartTime = now.getTime();
  console.log(`backQuestion`);
  answertextareaflag = false;
  var QAChangeChecked = document.getElementById("qachange").checked;////

  if (QAChangeChecked) {
      var phpfile1 = "getonequestion2.php";
      var phpfile2 = "getanswer2.php";
  } else {
      var phpfile1 = "getonequestion1.php";
      var phpfile2 = "getanswer1.php";
  }

  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null){
    if (num>0) {
        num = num -1;
    } else {
        num=Number(max)-1;
    }
    // console.log('num is '+num);
    document.getElementById("press-button").innerHTML = num+1   +"/"+Number(max);
    rand = questionnumbers[num];
    var moji=rand + "." + document.mainform.DB_name.value;
    moji = encodeURIComponent(moji);
    
    let mode = phpfile1 === "getonequestion2.php" ? 2 : 1;
    var res = await fetchQuestionFromSupabase(rand, mode);
    {

      // console.log('1120 res is '+res);
      var res = res.split('^^^');
      var doc0= document.getElementById("questionInfo");
      var correctNum = ""
      var question = ""

      if (res[0].indexOf("正解数")<0) {
        question = res[0];
        correctNum = res[1];
      } else {
        question = res[1];
        correctNum = res[0];
      }

      doc0.innerHTML= correctNum;

      if ((question.indexOf( "jpg" ) > -1)||(question.indexOf( "png" ) > -1)||(question.indexOf( "gif" ) > -1)||(question.indexOf( "jpeg" ) > -1)) {
        document.getElementById("textareas").style.display = "none";
        document.getElementById("div1").style.display = "block";
        // var imageadress =  res.split('\n');
        // console.log('question is ' + question);
        // console.log('imagefolder is ' + res[2]);
        document.getElementById("mypic1").src='images/'+res[2]+'/' + question;
        // document.getElementById("mypic1").style.width = "700px";
      } else {
        document.getElementById("div1").style.display = "none";
        document.getElementById("textareas").style.display = "block";
        document.getElementById( "textareas" ).value = "";
        document.getElementById( "textareas" ).value = question ;
        document.getElementById( "textareas2" ).value = "";;
      }
    }　//苦手度を取得
    var moji=rand + "." + document.mainform.DB_name.value;
    moji = encodeURIComponent(moji);
    var xmlhttp=createXmlHttpRequest2();
    if(xmlhttp!=null)
    {
      
      let row = window.allQuestionsData ? window.allQuestionsData.find(r => r.questionnumber == rand) : null;
      document.getElementById("poorat").value = (row && row.poorat) ? row.poorat : "";

    }
  }
}

function forgettingcurve(){
  listChanged()
  var now = new Date();
  var yesterday = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 1);
  var aweekago = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 7);
  var amonthago = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 30);

  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "=";
  document.getElementById("criteria1").value = formatDate(yesterday, 'YYYYMMDD');
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  document.getElementById("criteria2").value = formatDate(aweekago, 'YYYYMMDD');
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = "=";
  document.getElementById("criteria3").value = formatDate(amonthago, 'YYYYMMDD');
  sendRequest()
}

function NotYetQuestion(){
  listChanged()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "<";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category4").value = "";
  document.getElementById("operator1").value = "";
  document.getElementById("criteria1").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
}

function UnderFifty(){
  listChanged()
  document.getElementById("category6").value = "pca";
  document.getElementById("operator3").value = "<";
  document.getElementById("criteria3").value = "50";
  document.getElementById("category5").value = "incorrect";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "0";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function yesterdayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  yesterdayIncorrect = true;
  getYesterdayNumberFunc();
  sendRequest()
}
function threeDaysAgoQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getThreeDaysAgoNumberFunc()
  sendRequest()
}
function noTodayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function errTodayQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "=";
  getTodayNumberFunc()
  yesterdayIncorrect = true;
  sendRequest()
}
function errLastQuestion(){
  yesterdayIncorrect = true;
  sendRequest()
}
function aWeekAgoQuestion(){
  listChanged()
 
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()  
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getAWeekAgoNumberFunc();
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = ">";
  document.getElementById("criteria3").value = "20190101";
  sendRequest()
}
function aMonthAgoQuestion(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()  
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = "=";
  getAMonthAgoNumberFunc();
  document.getElementById("category6").value = "qdate";
  document.getElementById("operator3").value = ">";
  document.getElementById("criteria3").value = "20190101";
  sendRequest()
}
function levelZero(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "0";
  sendRequest()
}
function levelOne(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "1";
  sendRequest()
}
function levelTwo(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "2";
  sendRequest()
}
function levelThree(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "3";
  sendRequest()
}
function levelFour(){
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  document.getElementById("qlevel").value = "4";
  sendRequest()
}
function ZeroPercent(){
  listChanged()
  document.getElementById("category6").value = "pca";
  document.getElementById("operator3").value = "=";
  document.getElementById("criteria3").value = "0";
  document.getElementById("category5").value = "incorrect";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "0";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}
function atLeastOneFunc(){
  listChanged()
  document.getElementById("category5").value = "qdate";
  document.getElementById("operator2").value = ">";
  document.getElementById("criteria2").value = "20190101";
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  getTodayNumberFunc()
  sendRequest()
}

function oneByOneFunc(){
  oneByOneflag = true;
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  document.getElementById("criteria1").value = "20190101";
  document.getElementById("category5").value = "";
  document.getElementById("operator2").value = "";
  document.getElementById("criteria2").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
  oneByOneflag = false;
}

function twoByTwoFunc(){
  twoByTwoflag = true;
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  document.getElementById("criteria1").value = "20190101";
  document.getElementById("category5").value = "";
  document.getElementById("operator2").value = "";
  document.getElementById("criteria2").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
  twoByTwoflag = false;
}

function threeByThreeFunc(){
  threeByThreeflag = true;
  listChanged()
  document.getElementById("category4").value = "qdate";
  document.getElementById("operator1").value = "<";
  document.getElementById("criteria1").value = "20190101";
  document.getElementById("category5").value = "";
  document.getElementById("operator2").value = "";
  document.getElementById("criteria2").value = "";
  document.getElementById("category6").value = "";
  document.getElementById("operator3").value = "";
  document.getElementById("criteria3").value = "";
  sendRequest()
  threeByThreeflag = false;
}
var formatDate = function (date, format) {
  if (!format) format = 'YYYY-MM-DD hh:mm:ss.SSS';
  format = format.replace(/YYYY/g, date.getFullYear());
  format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
  format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));
  format = format.replace(/hh/g, ('0' + date.getHours()).slice(-2));
  format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
  format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
  if (format.match(/S/g)) {
    var milliSeconds = ('00' + date.getMilliseconds()).slice(-3);
    var length = format.match(/S/g).length;
    for (var i = 0; i < length; i++) format = format.replace(/S/, milliSeconds.substring(i, i + 1));
  }
  return format;
};



const uttr2 = new SpeechSynthesisUtterance()

function readAnswer(){//
  // 発言を作成
  uttr2.text = answerText2.value;

  var isJapanese = false;  //日本語（英語以外）の場合「true」に設定
  for(var i=0; i < uttr2.text.length; i++){
      if(uttr2.text.charCodeAt(i) >= 256) {
        isJapanese = true;
        break;
      }
  }

  var lang;

  if (isJapanese){
    lang=readVoices.find(el => el.indexOf('Japanese')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Kyoko')>-1);
    }
  }else{
    lang=readVoices.find(el => el.indexOf('English')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Samantha')>-1);
    }
  }

  // 言語 (日本語:ja-JP, アメリカ英語:en-US, イギリス英語:en-GB, 中国語:zh-CN, 韓国語:ko-KR)
  var slcLang = document.getElementById("autoReading").value




  uttr2.rate = 0.7

  if (isJapanese == true) {
    uttr2.rate = document.getElementById("jpSpeed").value;
  } else {      
    uttr2.rate = document.getElementById("engSpeed").value;
  }

  // 高さ 0-2 初期値:1
  uttr2.pitch = 1

  // 音量 0-1 初期値:1
  uttr2.volume = 0.75

  
  // // ③ 選択された声を指定
  // uttr2.voice = window.speechSynthesis.getVoices()[voice];
  // alert(readVoices);
  uttr2.voice = speechSynthesis
  .getVoices()
  .filter(voice => voice.name == lang)[0]; //言語設定

  speechSynthesis.speak(uttr2)
  // alert(uttr2.voice.name);



}
const uttr = new SpeechSynthesisUtterance();

function readQuestion(){
  // const uttr = new SpeechSynthesisUtterance(questionText2.value)
  uttr.text = questionText2.value;
  var isJapanese = false;  //日本語（英語以外）の場合「true」に設定
  for(var i=0; i < uttr.text.length; i++){
      if(uttr.text.charCodeAt(i) >= 256) {
        isJapanese = true;
        break;
      }
  }

  var lang;

  if (isJapanese){
    lang=readVoices.find(el => el.indexOf('Japanese')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Kyoko')>-1);
    }
  }else{
    lang=readVoices.find(el => el.indexOf('English')>-1);
    if (!lang){
      lang=readVoices.find(el => el.indexOf('Samantha')>-1);
    }
  }

  // 言語 (日本語:ja-JP, アメリカ英語:en-US, イギリス英語:en-GB, 中国語:zh-CN, 韓国語:ko-KR)
  var slcLang = document.getElementById("autoReading").value
  

  uttr.rate = 0.7

  if (isJapanese == true) {
    uttr.rate = document.getElementById("jpSpeed").value;
  } else {      
    uttr.rate = document.getElementById("engSpeed").value;
  }

  // 高さ 0-2 初期値:1
  uttr.pitch = 1

  // 音量 0-1 初期値:1
  uttr.volume = 0.75
  // ③ 選択された声を指定
  // uttr.voice = window.speechSynthesis.getVoices()[voice];

  // alert (uttr.rate);
  uttr.voice = speechSynthesis
  .getVoices()
  .filter(voice => voice.name == lang)[0]; 
  // .filter(voice => voice.name == readVoices[0])[0];      //言語設定
  // uttr.voice = speechSynthesis
  //   .getVoices()
  //   .filter(voice => voice.name === voiceSelect.value)[0]
  // 発言を再生 (発言キュー発言に追加)
  speechSynthesis.speak(uttr)



}

function autoQuestion(){
  // console.log('document.getElementById("jpSpeed").value is ' + document.getElementById("jpSpeed").value);
  var slcLang = document.getElementById("autoReading").value;
  if (autoflag==false) {
  autoflag = true;
  } else {
  autoflag = false;
  }
  var finishReading = false;
  var finishReading2 = false;
  // console.log('autoflag is ' + autoflag);
  if (document.getElementById("autoread").checked) {
    async function main(){
      for(;;) {
        if (autoflag == false) {
            break;
        }

        sendRequest();
        if (!(slcLang == "*e") && !(slcLang == "*j")){
          uttr.onend = function (event) {
            // console.log(`3`);
            finishReading = true;
          }
          while (finishReading == false){
            // i++;    // この文が無いと無限ループになってしまう。
            // console.log(i);
            await sleep(500);
          }
        }

        sendRequest2();
        if (!(slcLang == "e*") && !(slcLang == "j*")){
              uttr2.onend = function (event) {
                // console.log(`4`);
                finishReading2 = true;
              }
              while (finishReading2 == false){
                i++;    // この文が無いと無限ループになってしまう。
                // console.log(i);
                await sleep(500);
              }
        }
        finishReading = false;
        finishReading2 = false;
      }
    }
    main();

  } else {
    var speed = document.getElementById("autoSpeed").value * 1000;
    async function main(){
      for(;;) {
        if (autoflag == false) {
            break;
        }
        sendRequest();
        await sleep(speed);
        sendRequest2();
        await sleep(speed);
      }
    }
    main();
  }
}

function sleep(time){
  return new Promise(resolve => {
    sleepId = setTimeout(resolve, time);
  });
}

function textareafontresize(){
  document.getElementById("textareas").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("textareas2").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("questionMath").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("answerMath").style.fontSize = document.getElementById("fontresize").value;
  document.getElementById("answerHint").style.fontSize = document.getElementById("fontresize").value;

    
}

var firstRemoveFlag =false;

function removeCorrects(){
  var counts = {};
  minimumCorrect = Number(document.getElementById("NOC").value);
  console.log('削除前　questionnumbers is ' + questionnumbers);
  for(var i=0;i< correctQuestions.length;i++){
    var key = correctQuestions[i];
    counts[key] = (counts[key])? counts[key] + 1 : 1 ;
  }
  for (var key in counts) {
      console.log(key + " : " + counts[key]);
  }
  if (!firstRemoveFlag) {
    for (let i = 0; i < questionnumbers.length; i++) {
      if (Number(counts[questionnumbers[i]]) == 1) {
        questionnumbers.splice(i, 1);
        i=i-1;
        
      }
      firstRemoveFlag =true;
    }
  } else {
    for (let i = 0; i < questionnumbers.length; i++) {
      if (Number(counts[questionnumbers[i]]) >= minimumCorrect) {
        questionnumbers.splice(i, 1);
        i=i-1;
      }
    }
  }
  // console.log('削除後　questionnumbers is ' + questionnumbers);
  MaxQuestionNumber = questionnumbers.length;
}



// document.onkeydown = keydown;
document.addEventListener('keydown', (ev) => {
  if(!ev.repeat)
  keydown()
})
function keydown() {
  console.log('event.keyCode is ' + event.keyCode);
  console.log('event.code is ' + event.code);
  console.log('event.shiftKey is ' + event.altKey);
  // 現在フォーカスが与えられている要素を取得する
  var active_element = document.activeElement;

  // 出力テスト
  console.log(active_element);
  if ((document.getElementById("keyControl").checked) && (AnswerShown)//キー操作にチェックがあり
  && (document.activeElement.id == "textareas2")//解答欄がアクティブであり
  && (document.getElementById("answerByMyself").checked)) {//解答入力にチェックがあるとき
    // console.log('event.keyCode is ' + event.keyCode);
    // console.log('event.key is ' + event.key);
    whichKey1()
  }else if((document.getElementById("keyControl").checked) //キー操作にチェックがあり
  && (!document.getElementById("answerByMyself").checked)//解答入力にチェックがあり
  && (document.activeElement.id != "textareas2")//解答欄がアクティブでなく
  && (document.activeElement.id != "textareas")//問題欄がアクティブでなく
  && (document.activeElement.id != "criteria1")//基準欄がアクティブでなく
  && (document.activeElement.id != "criteria2")
  && (document.activeElement.id != "criteria3")
  && (document.activeElement.id != "wordSearch")//検索欄がアクティブでなく
  && (document.activeElement.id != "information")//通信欄がアクティブでなく
  && (document.activeElement.id != "DB_name")){//データベース名欄がアクティブでないとき　⇒つまり文字入力しないでキー操作のみで学習するとき

    whichKey2()
  }
}

function whichKey1(){
  if ((event.ctrlKey)) {
    if (event.keyCode === 229){
        switch (event.code) {
          case "KeyE":
              sendRequest2();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyR":
              sendRequest2();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyQ":
              sendRequest();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyW":
              sendRequest();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyF":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyD":
              sendRequest3('good2');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyS":
              sendRequest3('good3');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyA":
              sendRequest3('good4');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          
          case "KeyJ":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyH":
              sendRequest3('good1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyV":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyB":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyN":
              sendRequest4('poor1');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyC":
              sendRequest4('poor2');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyX":
              sendRequest4('poor3');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyZ":
              sendRequest4('poor4');
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          case "KeyM":
              readQuestion();
              event.returnValue = false;
              event.keyCode = 0;
              return false;
              break;
          default:
              ;
              break;
        }
    } else {
      switch (event.keyCode) {
        case 82:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 69:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 87:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 81:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 70:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 74:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 72:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 52:
          readAnswer()
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 68:
          sendRequest3('good2');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 83:
          sendRequest3('good3');
          event.keyCode = 0;
          event.returnValue = false;
        break;
        case 65:
          sendRequest3('good4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 86:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        // case 54:
          // sendRequest4('poor1');
          // event.keyCode = 0;
          // event.returnValue = false;
          // break;
        case 73:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 67:
          sendRequest4('poor2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 88:
          sendRequest4('poor3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        case 90:
          sendRequest4('poor4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
        
        default:
          ;
          break;
      }
    }
  }else if(event.keyCode === 219){
    sendRequest3('good1');
    event.keyCode = 0;
    event.returnValue = false;
  }else if(event.keyCode === 221){
    sendRequest4('poor1');
    event.keyCode = 0;
    event.returnValue = false;
  }
}
function whichKey2(){
  if (event.keyCode === 229 && event.keyCode != "ControlLeft"){
    switch (event.code) {
      case "KeyE":
          sendRequest2();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyR":
          sendRequest2();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyQ":
          sendRequest();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyW":
          sendRequest();
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyF":
          sendRequest3('good1');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyD":
          sendRequest3('good2');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyS":
          sendRequest3('good3');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyA":
          sendRequest3('good4');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyV":
          sendRequest4('poor1');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyC":
          sendRequest4('poor2');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyX":
          sendRequest4('poor3');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;
      case "KeyZ":
          sendRequest4('poor4');
          event.returnValue = false;
          event.keyCode = 0;
          return false;
          break;

      default:
          ;
          break;
    }
  } else {
    switch (event.keyCode) {
      case 82:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 69:
          sendRequest2();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 87:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 81:
          sendRequest();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 70:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 74:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 72:
          sendRequest3('good1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 68:
          sendRequest3('good2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 83:
          sendRequest3('good3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 65:
          sendRequest3('good4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 86:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      // case 54:
      //     sendRequest4('poor1');
      //     event.keyCode = 0;
      //     event.returnValue = false;
      //     break;
      case 52:
          readAnswer()
          event.keyCode = 0;
          event.returnValue = false;
        break;
      case 73:
          sendRequest4('poor1');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 67:
          sendRequest4('poor2');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 88:
          sendRequest4('poor3');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 90:
          sendRequest4('poor4');
          event.keyCode = 0;
          event.returnValue = false;
          break;
      case 80:
          backQuestion();
          event.keyCode = 0;
          event.returnValue = false;
          break;
      
      default:
          ;
          break;
    }
  }
}

async function settingSave(){
    let settings = {
        fontresize: document.getElementById("fontresize").value,
        autoSpeed: document.getElementById("autoSpeed").value,
        qachange: document.getElementById("qachange").checked,
        autoread: document.getElementById("autoread").checked,
        keyControl: document.getElementById("keyControl").checked,
        answerByMyself: document.getElementById("answerByMyself").checked,
        randomOrNot: document.getElementById("randomOrNot").checked,
        backGround: document.getElementById("backGround").value,
        flexButton: document.getElementById("flexButton").checked,
        blackCheck: document.getElementById("blackCheck").checked
    };
    localStorage.setItem('t_system_settings', JSON.stringify(settings));
}

function parseStrToBoolean(str) {
  // 文字列を判定
  return (str == 'true') ? true : false;

}

var selectElement = document.getElementById("novelSelect");
var novels = "<?php echo isset($novelsArray) ? $novelsArray : ''; ?>";　// 変数受け渡し。
novels = novels.split(",", -1);　// bb_csvをsplit()でカンマ区切り配列に再編成。
for(var i = 1; i < novels.length; i ++){
  var option = document.createElement("option");
  option.value = novels[i];
  option.innerText = novels[i];
  selectElement.appendChild(option);
}



var response = '<?php echo isset($response) ? $response : ''; ?>';
response = response.split('^');
// console.log('response is '+response);
if (response[0]) {
  if (response[0]==="all"){
    document.getElementById("MaxQuestionNumber").value = "all"
  } else {
    document.getElementById("MaxQuestionNumber").value = Number(response[0]);
  }
}
// document.getElementById("MaxQuestionNumber").value = Number(response[0]);
if (response[1]) {
  document.getElementById("fontresize").value = response[1];
}
textareafontresize()
if (response[2]) {
  document.getElementById("autoSpeed").value =  Number(response[2]);
}
if (response[3]) {
  document.getElementById("autoReading").value = response[3];
  }
if (response[4]) {
  document.getElementById("jpSpeed").value = response[4];
}
if (response[5]) {
  document.getElementById("engSpeed").value = response[5];
}
// console.log('document.getElementById("engSpeed").value is ' + document.getElementById("engSpeed").value);
if (response[6]) {
  document.getElementById("NOC").value = Number(response[6]);
}
if (response[7]) {
  document.getElementById("autoAnswer").value = Number(response[7]);
}
document.getElementById("qachange").checked = parseStrToBoolean(response[8]);
document.getElementById("autoread").checked = parseStrToBoolean(response[9]);
document.getElementById("keyControl").checked = parseStrToBoolean(response[10]);
document.getElementById("answerByMyself").checked = parseStrToBoolean(response[11]);
document.getElementById("randomOrNot").checked = parseStrToBoolean(response[12]);
document.getElementById("flexButton").checked = parseStrToBoolean(response[18]);
if (response[13]) {  
response2 = response[13].split('@@@@');}
if (response2[0]) {
document.getElementById("backGround").value = response2[0];}
changeBG();
if (response2[1]) {
document.getElementById("fontSelect").value = response2[1];}
changeFont();
if (response[16]) {
document.getElementById("novelSelect").value = response[16];}
if (response[21]) {
  if (response[21]==='true'){
    document.getElementById("blackCheck").checked = true;
    turnBlack()
  } else{
    document.getElementById("blackCheck").checked = false;
  }
}

if (response[18]==="true") {
  QnAareaFlex();
}
if (response[20]) {
  if ((document.getElementById("novelSelect").value) && !(document.getElementById("novelSelect").value == "なし")){
    document.getElementById("novelSentenceNumber").value = response[20];
  }
}


function AnswerSent(code)
{
    //エンターキー押下なら
    if((13 === code) && (AnswerShown === false) && (document.getElementById("autoAnswer").value === "0")
    && (document.getElementById("answerByMyself").checked))
    {
        AnswerTypedFlag = true;
        sendRequest2();
    }
}
function getTodayNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate());
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m  + d;
  document.getElementById("criteria1").value = result;
}
function getYesterdayNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-1);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getThreeDaysAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-3);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getAfterNdays(n){
   var dt = new Date();
   dt.setDate(dt.getDate()+n);
   return formatDate(dt);
}
function getAWeekAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-7);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
}
function getAMonthAgoNumberFunc()
{
  var dt = new Date();

  dt.setDate(dt.getDate()-31);
  var y = dt.getFullYear();
  var m = ("00" + (dt.getMonth()+1)).slice(-2);
  var d = ("00" + dt.getDate()).slice(-2);
  var result = y  + m +  d;
  document.getElementById("criteria2").value = result;
  // var objDate = new Date();

  // objDate.setDate(objDate.getDate() - 1);
  // var result = String(objDate.getFullYear())+String(objDate.getMonth())+String(objDate.getDate())
  // console.log(objDate.getFullYear())
  // console.log(objDate.getMonth())
  // console.log(objDate.getDate())
  document.getElementById("criteria2").value = result;
}
function getFirstDayFunc()
{
  document.getElementById("criteria2").value ="20010101";
}

var base = 60;

var key =  ["C","C#","D","E♭","E","F","F#","G","A♭","A","B♭","B"];

var chordname={"△":"100010010000",
"maj":"100010010000",
"m":"100100010000",
"dim":"100100100000",
"aug":"100010001000",
"△7":"100010010001",
"maj7":"100010010001",
"m7":"100100010010",
"7":"100010010010",
"dim7":"100100100100",
"m7♭5":"100100100010",
"minmaj7":"100100010001",
"6":"100010010100",
"m6":"100100010100",
"9":"100010010010001",
"maj9":"101010010001",
"m9":"101100010010",
"sus2":"101000010000",
"sus4":"100001010000",
"7b9":"10001001001001",
"7s9":"100110010010",
"7s11":"100010110010",
"7b13":"100010011010",
"7sus4":"100001010010",
"aug7":"100010001010",
"maj7s11":"100010110001",
"7#5":"100010001010",
"m#5":"100100001000",
"7b5":"100010100010"};

function getNote(_chordname){
  j=0;
  note=[];
  for(i=0;i<12;i++){
    j = chordname[_chordname].indexOf("1",j);
    if(j == -1){break;}
    note[note.length]=j;
    j=j+1;
  }
  return note;
};

function getMIDI(chord){
  if (chord.substr(1,3) === "sus") {
    _key=chord.substr(0,1);
    _chordname=chord.substr(1);
  } else if (chord.substr(2,3) === "sus") {
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "s"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "#"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "b"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else if (chord.substr(1,1) === "♭"){
    _key=chord.substr(0,2);
    _chordname=chord.substr(2);
  } else {
    _key=chord.substr(0,1);
    _chordname=chord.substr(1);
  }
  if (_chordname===""){_chordname="maj"};
  if (_key==="G♭"){_key==="F#"};
  if (_key==="D♭"){_key==="C#"};
  if (_key==="A#"){_key==="B♭"};
  if (_key==="Gb"){_key==="F#"};
  if (_key==="Db"){_key==="C#"};
  if (_key==="As"){_key==="B♭"};
  if (_key==="Fs"){_key==="F#"};
  if (_key==="Cs"){_key==="C#"};

  root = base + key.indexOf(_key);
  note= getNote(_chordname);
  midi=[];
  for(i=0;i<note.length;i++){
      midi[i]=root+note[i];
  }
  return midi;
};

function playMIDI(midi){
    MIDI.loadPlugin({
        soundfontUrl: "./soundfont/",
        instrument: "acoustic_grand_piano",
        onprogress: function(state, progress) {
            console.log(state, progress);
        },
        onsuccess: function() {
            var delay = 0; // play one note every quarter second
            var velocity = 127; // how hard the note hits
            // play the note
            MIDI.setVolume(0, 127);
            for(i=0;i<midi.length;i++){
                for(j=0;j<midi[i].length;j++){
                    MIDI.noteOn(0, midi[i][j], velocity, delay);
                    MIDI.noteOff(0, midi[i][j], delay + 0.75);
                }
                delay = delay +1;
            }
        }
    });
    return "";
};

function playChords(chords){
    _chords=chords.split(/\r\n|\r|\n| |,/);//改行コードもしくは空白もしくはカンマ
    console.log(_chords);
    //_chords = chords.split(" ");
    _midi = []
    for(_c in _chords){
        if(_chords[_c].length==0){continue;}
        _midi[_midi.length]=getMIDI(_chords[_c]);
    }
    playMIDI(_midi);
}

var music = new Audio();
var music2 = new Audio();
var musicFlag = false;
var rres;
var musicDuration ="";
function init(res) {
  rres = res;
  music.preload = "auto";
  music.src = "./mp3/" + res;
  music.load();
  music2.preload = "auto";
  music2.src = "./mp3/" + res;
  music2.load();

  music.addEventListener('loadedmetadata',function(e) {
      console.log(music.duration); // 総時間の取得
      musicDuration = music.duration

  });

  music.addEventListener('pause',function(e) {
  console.log("pause!");
  music.currentTime = 0;


  var isPlaying = music.currentTime > 0 && !music.paused && !music.ended
      && music.readyState > 2;

  if (!isPlaying) {
    music.src = "./mp3/" + res + "#t=0," + String(musicDuration - Number(document.getElementById("mp3StartPoint").value));
    setTimeout(function() {
        music.playbackRate = document.getElementById("mp3Speed").value;
      music.play();
      var musicFlag = true;
    }, 0);
    }

  });

}

var timeout_id = null;

function play() {
  // music.loop = true;


  // music.currentTime = Number(document.getElementById("mp3StartPoint").value);
  music.playbackRate = document.getElementById("mp3Speed").value;
  music.play();
  var musicFlag = true;
  // timeout_id =setTimeout("play();", musicDuration- Number(document.getElementById("mp3StartPoint").value));

  // timeout_id =setTimeout("play();", 3000);
}



function stop() {
  music.pause();
  // music2.pause();
  // music.currentTime = Number(document.getElementById("mp3StartPoint").value);
  // setTimeout() メソッドの動作をキャンセルする
clearTimeout(timeout_id);
timeout_id = null;
}


function imageSizeChange1(){
  imageSize = document.getElementById("imageSize1").value;
  document.getElementById("mypic1").style.width = imageWidth1 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
  document.getElementById("mypic1").style.height = imageHeight1 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
}


function imageSizeChange2(){
  imageSize = document.getElementById("imageSize2").value;
  document.getElementById("mypic2").style.width = imageWidth2 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
  document.getElementById("mypic2").style.height = imageHeight2 * Number(imageSize) + "px";  // 横幅を400pxにリサイズ
}
async function informationChange(){
    localStorage.setItem('t_system_info', document.mainform.information.value);
}

function changeBG(wIMG) {
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + wIMG + ")";///////////////////
}

function　changeFont(){
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.fontFamily = document.getElementById("fontSelect").value;;
  }
}

function newOnesFunc(){

}
//音声読み上げ
const answerText2        = document.querySelector('#textareas2')
const questionText2        = document.querySelector('#textareas')
const voiceSelect = document.querySelector('#voice-select')
const speakBtn    = document.querySelector('#speak-btn')
var readVoices = new Array();
var readVoiceJp ="";
var readVoiceEng ="";

// selectタグの中身を声の名前が入ったoptionタグで埋める
function appendVoices() {
  // ①　使える声の配列を取得
  // 配列の中身は SpeechSynthesisVoice オブジェクト
  const voices = speechSynthesis.getVoices()
  voices.forEach(voice => { //　アロー関数 (ES6)
    // 日本語と英語以外の声は選択肢に追加しない。
    if(!voice.lang.match('ja|en-US')) return
    readVoices.push(voice.name);
  });
  // alert(readVoices);
  var voiceNum =0;
  readVoices.forEach( function( item ) {
    if (item.includes('ja') || item.includes('Ja')|| item.includes('Kyoko')) {
      if(!readVoiceJp){readVoiceJp = voiceNum};
    }
    if (item.includes('en') || item.includes('En')|| item.includes('Samantha')) {
      if(!readVoiceEng){readVoiceEng = voiceNum;}
    }
    voiceNum += 1;
  });
  // alert(readVoices);
}

appendVoices()

// // ② 使える声が追加されたときに着火するイベントハンドラ。
// // Chrome は非同期に(一個ずつ)声を読み込むため必要。
speechSynthesis.onvoiceschanged = e => {
  appendVoices();
}



    // Execute loadVoices.
    






var novelRowNum = 1;
if (document.getElementById("novelSentenceNumber").value) {
  novelRowNum = Number(document.getElementById("novelSentenceNumber").value);
}
    


async function getNovelSentence(){
    console.log("getNovelSentence called but feature is disabled in serverless.");
}

function  category1Change(){
  // var elem = document.querySelectorAll('select[name="category2"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category3"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category4"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
  // var elem = document.querySelectorAll('select[name="category5"] option');
  // for(var i=0; i<elem.length; i++) {
  //   elem[i].selected = false;
  // }
}

function QnAareaFlex(){
  var mainform = document.getElementById("mainform");
  var Qarea = document.getElementById("textareas");
  var QareaImage = document.getElementById("div1");
  var Aarea = document.getElementById("textareas2");
  var AareaImage = document.getElementById("div2");
  var PrePosision = document.getElementById("questionbuttonbox");
  var ParentElement = document.getElementById("QandAwindow");
  if (QnAareaFlexFlug === false){
    Qarea.style.width= "42%"; 
    QareaImage.style.width= "42%";
    Qarea.style.height= "60vh"; 
    QareaImage.style.height= "62.5vh";
    Aarea.style.width= "42%"; 
    AareaImage.style.width= "42%"; 
    Aarea.style.height= "60vh"; 
    AareaImage.style.height= "62.5vh"; 
    Qarea.style.float = "left";
    QareaImage.style.float = "left";
    // AareaImage.style.float = "left";
    // Aarea.style.display= "flex"; 
    // AareaImage.style.display= "flex"; 
    if (AareaImage.style.display === "none"){
      AareaImage.style.display= "none";
    }
    ParentElement.insertBefore(AareaImage,QareaImage.nextSibling);
    ParentElement.insertBefore(Aarea,QareaImage.nextSibling);
    // document.getElementById("flexButton").checked = true;
    QnAareaFlexFlug = true;
  }else{
    Qarea.style.width= "97%";
    QareaImage.style.width= "97%"; 
    Qarea.style.height= "24vh"; 
    QareaImage.style.height= "27.5vh";
    Aarea.style.width= "97%"; 
    AareaImage.style.width= "97%";
    Aarea.style.height= "24vh"; 
    AareaImage.style.height= "27.5vh"; 
    // Aarea.style.display= "block"; 
    // AareaImage.style.display= "block"; 
    if (AareaImage.style.display === "none"){
      AareaImage.style.display= "none";
    }
    ParentElement.insertBefore(Aarea,PrePosision.nextSibling);
    ParentElement.insertBefore(AareaImage,Aarea.nextSibling);
    QnAareaFlexFlug = false;
    // document.getElementById("flexButton").checked = false;
  }
}
function blackOrWhite(){
  if (document.getElementById("blackCheck").checked){
    
    turnBlack();
  } else {
    turnWhite();
  }
}

function turnBlack(){

  var elements = document.getElementsByClassName('info02');
  for(i=0;i<elements.length;i++){
    // elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('button');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('selectBox');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('setting');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#7a7a7a';
  }
  var elements = document.getElementsByClassName('checkText');
  for(i=0;i<elements.length;i++){
    elements[i].style.color = '#7a7a7a';
  }
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + "1701.png" + ")";
  document.getElementById("questionInfo").style.color = '#7a7a7a';
}
function turnWhite(){

  var elements = document.getElementsByClassName('info02');
  for(i=0;i<elements.length;i++){
    // elements[i].style.backgroundColor = '#000000'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('textlines');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#ffccff'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('button');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#EEEEEE'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('selectBox');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#EEEEEE'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('setting');
  for(i=0;i<elements.length;i++){
    elements[i].style.backgroundColor = '#e4fcff'; 
    elements[i].style.color = '#000000';
  }
  var elements = document.getElementsByClassName('checkText');
  for(i=0;i<elements.length;i++){
    elements[i].style.color = '#000000';
  }
  var wIMG = document.getElementById("backGround").value;
  document.body.style.backgroundImage = "url(./bg/" + response2[0] + ")";
  document.getElementById("questionInfo").style.color = '#000000';
}
function removeQuestion(){
  if (questionnumbers != ""){
    if (!firstRemoveFlag) {
    //  questionnumbers.splice(num, 1);
      correctQuestions.push(rand);
    } else {
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
      correctQuestions.push(rand);
    }
  }
}
function escape_html (string) {//HTMLエスケープ処理
  if(typeof string !== 'string') {
    return string;
  }
  return string.replace(/[&'`"<>]/g, function(match) {
    return {
      '&': '&amp;',
      "'": '&#x27;',
      '`': '&#x60;',
      '"': '&quot;',
      '<': '&lt;',
      '>': '&gt;',
    }[match]
  });
}


function resizeTextareas(){
  var width;
  var height;
  observer.disconnect();
  observer2.disconnect();

  if ( elementTextareas.style.width.match("%")) {//%が含まれているか
    // width=elementTextareas.style.width; 
    // height=elementTextareas.style.height; 
    width=Number(parseInt(elementTextareas.style.width))+Number(2); 
    width=width+"%"
    height=Number(parseInt(elementTextareas.style.height))+Number(2); 
    height=height+"vh"
  }else{
    width=Number(parseInt(elementTextareas.style.width))+Number(25); 
    width=width+"px"
    height=Number(parseInt(elementTextareas.style.height))+Number(25); 
    height=height+"px"
  }
  console.log("11  "+elementTextareas.style.width);
  console.log("12  "+ width);
  console.log("13  "+height);
  
  console.log("13.1  "+$('#div2').width());
  console.log("13.2  "+$('#div2').height());
  $('#textareas2').width(elementTextareas.style.width); 
  $('#textareas2').height(elementTextareas.style.height); 
  $('#div1').width(width); 
  $('#div1').height(height); 
  $('#div2').width(width); 
  $('#div2').height(height); 
  console.log("14  "+$('#div2').width());
  console.log("15  "+$('#div2').height());

  observer2.observe(elementTextareas2, options);
  observer.observe(elementTextareas, options);
}
document.addEventListener('keydown', function(event) {
    // Ctrlキーが押されているか、F12キーが押されているかを確認
    if (event.ctrlKey && event.key === 'F12') {
        readQuestion();
        event.preventDefault(); // デフォルトの動作をキャンセル
    }
});

