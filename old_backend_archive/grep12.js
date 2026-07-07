const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const setStart = c.indexOf('<div class="msc-settings-panel">');
console.log('setStart:', setStart);
