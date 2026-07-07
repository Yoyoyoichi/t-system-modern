const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/value="☆"\n  style="width:24\.2%;height:10vh; font-size: 30px"><br><br>/g, 'value="☆"\n  style="width:24.2%;height:10vh; font-size: 30px">');
c = c.replace(/value="✖"\n  style="width:24\.2%;height:10vh; font-size: 30px"><br><br>/g, 'value="✖"\n  style="width:24.2%;height:10vh; font-size: 30px">');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS: Deleted the <br><br> tags directly from the HTML inside bottomButtonBox.");
