const fs = require('fs');
let content = fs.readFileSync('sample020.php', 'utf8');

// Replace using regex to ignore newline differences
let pattern1 = /^[ \t]*\/\/[ \t]*Fetch questions from Supabase directly in Javascript!\r?\n[ \t]*yesterdayIncorrect = false;\r?\n[ \t]*questionnumbers = await fetchQuestionsFromSupabase\(\);\r?\n[ \t]*\r?\n[ \t]*\/\/[ \t]*Fallback if empty\r?\n[ \t]*if \(!questionnumbers \|\| questionnumbers\.length === 0\) \{\r?\n[ \t]*\/\/[ \t]*empty or error handling\r?\n[ \t]*document\.getElementById\("totalQuestionNumber"\)\.innerHTML = 0;\r?\n[ \t]*\} else \{\r?\n[ \t]*document\.getElementById\("totalQuestionNumber"\)\.innerHTML = questionnumbers\.length;\r?\n[ \t]*\}/m;

let replacement1 = `    // Fetch questions from Supabase directly in Javascript! ONLY on first load!
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

content = content.replace(pattern1, replacement1);

let pattern2 = /^[ \t]*if \(MaxQuestionNumber <= questionnumbers\.length\) \{\r?\n[ \t]*max = Number\(MaxQuestionNumber\);\r?\n[ \t]*\} else \{\r?\n[ \t]*max = questionnumbers\.length;\r?\n[ \t]*MaxQuestionNumber = questionnumbers\.length;\r?\n[ \t]*\}/m;

let replacement2 = `      if (MaxQuestionNumber <= (questionnumbers ? questionnumbers.length : 0)) {
        max = Number(MaxQuestionNumber);
      } else {
        max = questionnumbers ? questionnumbers.length : 0;
        MaxQuestionNumber = max;
      }`;

content = content.replace(pattern2, replacement2);

fs.writeFileSync('sample020.php', content);
console.log('Fixed fetch bug with Regex!');
