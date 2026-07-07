const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const shortcuts = [
    'yesterdayQuestion',
    'threeDaysAgoQuestion',
    'noTodayQuestion',
    'errTodayQuestion',
    'errLastQuestion',
    'aWeekAgoQuestion',
    'aMonthAgoQuestion'
];

shortcuts.forEach(s => {
    const regex = new RegExp(`async function ${s}\\(\\)\\{[\\s\\S]*?flag1 = false;`, 'g');
    c = c.replace(regex, `async function ${s}(){\n  num = -1;\n  flag1 = false;`);
});

fs.writeFileSync('sample020.php', c);
console.log('SUCCESS');
