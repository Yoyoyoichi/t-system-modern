const fs = require('fs');
let c = fs.readFileSync('build_new_settings.js', 'utf8');
c = c.replace(/fs\.writeFileSync\('sample020\.php', newC\);/, 'console.log("Panel contains autoread?", panelHtml.includes("autoread"));');
fs.writeFileSync('temp.js', c);
require('child_process').execSync('node temp.js', {stdio: 'inherit'});
