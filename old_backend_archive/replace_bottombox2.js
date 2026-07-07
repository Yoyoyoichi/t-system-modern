const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const regex = /(qBoxes\.forEach\(b => b\.style\.display = 'none'\);)/;
const replacement = `$1\n\n    const bottomBox = document.getElementById('bottomButtonBox');\n    if (bottomBox) bottomBox.style.display = 'none';`;

if (regex.test(c)) {
    c = c.replace(regex, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS: Replaced.");
} else {
    console.log("FAILED: Target regex not found.");
}
