const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const setStart = c.indexOf('<div id ="setting" class="setting"');
const setEnd = c.indexOf('</div>', setStart);
const setHtml = c.substring(setStart, setEnd + 6);
const id = 'autoread';
const inpRegex = new RegExp(`<input[^>]*id\\s*=\\s*['"]?${id}['"]?[^>]*>`, 'i');
console.log(setHtml.match(inpRegex));
