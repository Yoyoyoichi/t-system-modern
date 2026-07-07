const fs = require('fs');
let content = fs.readFileSync('sample020.php', 'utf8');

let target = `    // Fetch questions from Supabase directly in Javascript!
    yesterdayIncorrect = false;
    questionnumbers = await fetchQuestionsFromSupabase();
    
    // Fallback if empty
    if (!questionnumbers || questionnumbers.length === 0) {
        // empty or error handling
        document.getElementById("totalQuestionNumber").innerHTML = 0;
    } else {
        document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
    }`;

let replacement = `    // Fetch questions from Supabase directly in Javascript! ONLY on first load!
    if (flag1 == false) {
      yesterdayIncorrect = false;
      questionnumbers = await fetchQuestionsFromSupabase();
      
      // Fallback if empty
      if (!questionnumbers || questionnumbers.length === 0) {
          // empty or error handling
          document.getElementById("totalQuestionNumber").innerHTML = 0;
      } else {
          document.getElementById("totalQuestionNumber").innerHTML = questionnumbers.length;
      }
    }
    
    if (questionnumbers && questionnumbers.length === 0 && flag1 == true) {
        // If it's empty after the first load, it means all questions are finished!
        document.getElementById("textareas").value = "お疲れ様でした！全問終了です。";
        document.getElementById("questionInfo").innerHTML = "完了";
        document.getElementById("totalQuestionNumber").innerHTML = 0;
        return;
    }`;

content = content.replace(target, replacement);

let target2 = `      if (MaxQuestionNumber <= questionnumbers.length) {
        max = Number(MaxQuestionNumber);
      } else {
        max = questionnumbers.length;
        MaxQuestionNumber = questionnumbers.length;
      }`;

let replacement2 = `      if (MaxQuestionNumber <= (questionnumbers ? questionnumbers.length : 0)) {
        max = Number(MaxQuestionNumber);
      } else {
        max = questionnumbers ? questionnumbers.length : 0;
        MaxQuestionNumber = max;
      }`;

content = content.replace(target2, replacement2);

fs.writeFileSync('sample020.php', content);
console.log('Fixed fetch bug');
