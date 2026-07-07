const fs = require('fs');
const c = fs.readFileSync('sample020.php', 'utf8');
const start = c.indexOf('<div id ="setting" class="setting"');
if (start !== -1) {
    const end = c.indexOf('</div>', start);
    fs.writeFileSync('settings_dump.txt', c.substring(start, end + 6));
}
