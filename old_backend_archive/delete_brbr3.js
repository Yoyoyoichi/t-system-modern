const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const start = c.indexOf('<div id = "bottomButtonBox" class="bottomButtonBox">');
const end = c.indexOf('</div>', start);

if (start !== -1 && end !== -1) {
    let boxHTML = c.substring(start, end);
    boxHTML = boxHTML.replace(/<br><br>/g, '');
    c = c.substring(0, start) + boxHTML + c.substring(end);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS: Deleted the <br><br> tags directly from the HTML inside bottomButtonBox.");
} else {
    console.log("FAILED.");
}
