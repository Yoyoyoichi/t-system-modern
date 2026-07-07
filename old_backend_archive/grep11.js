const fs = require('fs');
let c = require('child_process').execSync('git show ddaa8b6:sample020.php').toString();
const setStart = c.indexOf('<div id ="setting" class="setting"');
const setEnd = c.indexOf('</div>', setStart);
const combinedHtml = c.substring(setStart, setEnd + 6);

function extractEl(html, id) {
    const inpRegex = new RegExp(`<input[^>]*id\\s*=\\s*['"]?${id}['"]?[^>]*>`, 'i');
    const m = html.match(inpRegex);
    console.log(`Match for ${id}:`, m);
    return m ? m[0] : null;
}

extractEl(combinedHtml, 'autoread');
