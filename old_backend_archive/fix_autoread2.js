const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const targetRegex = /<label class="msc-checkbox-wrapper">\s*<select class="selectBox" name='autoReading'[\s\S]*?<\/label>/;
const replacement = `<label class="msc-checkbox-wrapper">
            <input class="msc-checkbox" type="checkbox" id="autoread" onchange="settingSave()">
            <span class="msc-checkbox-label">自動読上</span>
        </label>`;

if (targetRegex.test(c)) {
    c = c.replace(targetRegex, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS: Regex replaced bad autoread block.");
} else {
    console.log("FAILED: Regex target not found.");
}
