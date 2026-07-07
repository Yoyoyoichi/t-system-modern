const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// 1. Remove yesterdayIncorrect = false from sendRequest
c = c.replace(/if \(flag1 == false\) \{\s*yesterdayIncorrect = false;\s*/g, 'if (flag1 == false) {\n        ');

// 2. Add yesterdayIncorrect = false to listChanged
c = c.replace(/async function listChanged\(\)\{\s*firstRemoveFlag = false;\s*num = -1;\s*flag1 = false;/g, 'async function listChanged(){\n  firstRemoveFlag = false;\n  num = -1;\n  flag1 = false;\n  yesterdayIncorrect = false;');

// 3. Rewrite shortcut functions to be async and avoid race conditions with listChanged
const shortcuts = [
    { name: 'yesterdayQuestion', body: `  flag1 = false;\n  document.getElementById("category4").value = "qdate";\n  document.getElementById("operator1").value = "<";\n  getTodayNumberFunc();\n  document.getElementById("category5").value = "qdate";\n  document.getElementById("operator2").value = "=";\n  yesterdayIncorrect = true;\n  getYesterdayNumberFunc();\n  sendRequest();` },
    { name: 'threeDaysAgoQuestion', body: `  flag1 = false;\n  document.getElementById("category4").value = "qdate";\n  document.getElementById("operator1").value = "<";\n  getTodayNumberFunc();\n  document.getElementById("category5").value = "qdate";\n  document.getElementById("operator2").value = "=";\n  getThreeDaysAgoNumberFunc();\n  sendRequest();` },
    { name: 'noTodayQuestion', body: `  flag1 = false;\n  document.getElementById("category4").value = "qdate";\n  document.getElementById("operator1").value = "<";\n  getTodayNumberFunc();\n  sendRequest();` },
    { name: 'errTodayQuestion', body: `  flag1 = false;\n  document.getElementById("category4").value = "qdate";\n  document.getElementById("operator1").value = "=";\n  getTodayNumberFunc();\n  yesterdayIncorrect = true;\n  sendRequest();` },
    { name: 'errLastQuestion', body: `  flag1 = false;\n  yesterdayIncorrect = true;\n  sendRequest();` },
    { name: 'aWeekAgoQuestion', body: `  flag1 = false;\n  document.getElementById("category4").value = "qdate";\n  document.getElementById("operator1").value = "<";\n  getTodayNumberFunc();\n  document.getElementById("category5").value = "qdate";\n  document.getElementById("operator2").value = "=";\n  getAWeekAgoNumberFunc();\n  sendRequest();` },
    { name: 'aMonthAgoQuestion', body: `  flag1 = false;\n  document.getElementById("category4").value = "qdate";\n  document.getElementById("operator1").value = "<";\n  getTodayNumberFunc();\n  document.getElementById("category5").value = "qdate";\n  document.getElementById("operator2").value = "=";\n  getAMonthAgoNumberFunc();\n  sendRequest();` }
];

shortcuts.forEach(s => {
    const regex = new RegExp(`function \\s*${s.name}\\(\\)\\s*\\{[\\s\\S]*?sendRequest\\(\\)\\s*\\}`, 'g');
    c = c.replace(regex, `async function ${s.name}(){\n${s.body}\n}`);
});

fs.writeFileSync('sample020.php', c);
console.log('SUCCESS');
