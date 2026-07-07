const fs = require('fs');
const c = require('child_process').execSync('git show b5f0272:sample020.php').toString();
const setStart = c.indexOf('<div id ="setting" class="setting"');
const setEnd = c.indexOf('</div>', setStart);
console.log('setStart:', setStart, 'setEnd:', setEnd);
const autoReadIdx = c.indexOf('id = "autoread"');
console.log('autoReadIdx:', autoReadIdx);
console.log('Is autoread inside?', autoReadIdx >= setStart && autoReadIdx <= setEnd);
