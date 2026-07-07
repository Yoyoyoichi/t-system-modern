const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const targetStr = `    const qBoxes = document.querySelectorAll('.questionbuttonbox');
    qBoxes.forEach(b => b.style.display = 'none');`;

const replacementStr = `    const qBoxes = document.querySelectorAll('.questionbuttonbox');
    qBoxes.forEach(b => b.style.display = 'none');

    const bottomBox = document.getElementById('bottomButtonBox');
    if (bottomBox) bottomBox.style.display = 'none';`;

if (c.includes(targetStr)) {
    c = c.replace(targetStr, replacementStr);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS: Replaced.");
} else {
    console.log("FAILED: Target string not found.");
}
