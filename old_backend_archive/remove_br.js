const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const regex = /<\/div>\s*(?:<br>\s*)+<style>\s*\.msc-settings-panel\s*\{/g;
const replacement = `</div>\n\n<style>\n.msc-settings-panel {\n    margin-top: 48px;`;

if (regex.test(c)) {
    c = c.replace(regex, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS: Replaced excessive <br> tags.");
} else {
    console.log("FAILED: Regex not found.");
}
