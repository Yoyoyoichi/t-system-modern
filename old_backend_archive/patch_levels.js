const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const funcs = [
  'levelZero', 'levelOne', 'levelTwo', 'levelThree', 'levelFour',
  'atLeastOneFunc', 'NotYetQuestion', 'noTodayQuestion', 'UnderFifty',
  'threeDaysAgoQuestion', 'aWeekAgoQuestion', 'aMonthAgoQuestion',
  'oneByOneFunc', 'twoByTwoFunc', 'threeByThreeFunc'
];

for (const fn of funcs) {
    const regex = new RegExp(`function \\s+${fn}\\s*\\(\\)\\s*\\{[\\s\\S]*?\\n\\}`);
    const match = c.match(regex);
    if (match) {
        let body = match[0];
        // Remove listChanged() from the top
        body = body.replace(/function\s+\w+\(\)\s*\{\s*listChanged\(\);?/m, `async function ${fn}() {`);
        // If it still has 'function', it means listChanged() wasn't at the top in exactly that format.
        if (body.startsWith('function')) {
            body = body.replace(`function ${fn}()`, `async function ${fn}()`);
            body = body.replace(/listChanged\(\);?/, '');
        }
        
        // Add await listChanged() right before sendRequest()
        body = body.replace(/sendRequest\(\);?/g, `await listChanged();\n  sendRequest();`);
        
        c = c.replace(match[0], body);
        console.log(`Patched ${fn}`);
    } else {
        console.log(`Could not find ${fn}`);
    }
}

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
