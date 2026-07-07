const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const funcs = [
  'levelZero', 'levelOne', 'levelTwo', 'levelThree', 'levelFour',
  'atLeastOneFunc', 'NotYetQuestion', 'noTodayQuestion', 'UnderFifty',
  'threeDaysAgoQuestion', 'aWeekAgoQuestion', 'aMonthAgoQuestion',
  'oneByOneFunc', 'twoByTwoFunc', 'threeByThreeFunc'
];

for (const fn of funcs) {
    const startRegex = new RegExp(`function\\s+${fn}\\s*\\(\\)\\s*\\{`, 'g');
    
    // Find the function start
    const match = startRegex.exec(c);
    if (match) {
        let startIndex = match.index;
        let braceCount = 0;
        let endIndex = -1;
        
        // Find matching closing brace
        let i = startIndex;
        while (i < c.length) {
            if (c[i] === '{') braceCount++;
            if (c[i] === '}') {
                braceCount--;
                if (braceCount === 0) {
                    endIndex = i;
                    break;
                }
            }
            i++;
        }
        
        if (endIndex !== -1) {
            let body = c.substring(startIndex, endIndex + 1);
            
            // Rewrite body
            body = body.replace(startRegex, `async function ${fn}() {`);
            body = body.replace(/listChanged\(\)[ \t]*(\r?\n)/, '$1');
            body = body.replace(/sendRequest\(\)/g, `await listChanged();\n  sendRequest()`);
            
            c = c.substring(0, startIndex) + body + c.substring(endIndex + 1);
            console.log(`Patched ${fn}`);
        }
    } else {
        console.log(`Could not find ${fn}`);
    }
}

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
