const fs = require('fs');
let c = require('child_process').execSync('git show ddaa8b6:sample020.php').toString();
const setStart = c.indexOf('<div id ="setting" class="setting"');
const setEnd = c.indexOf('</div>', setStart);
console.log('setStart:', setStart, 'setEnd:', setEnd);

const setHtml = c.substring(setStart, setEnd + 6);
const id = 'autoread';
const inpRegex = new RegExp(`<input[^>]*id\\s*=\\s*['"]?${id}['"]?[^>]*>`, 'i');
console.log('Regex match in setHtml:', !!setHtml.match(inpRegex));

const autoReadIdx = c.indexOf('id = "autoread"');
console.log('autoReadIdx:', autoReadIdx);
console.log('Is autoread inside?', autoReadIdx >= setStart && autoReadIdx <= setEnd);
