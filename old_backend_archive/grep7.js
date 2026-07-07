const fs = require('fs');
let c = require('child_process').execSync('git show b5f0272:sample020.php').toString();
const autoReadIdx = c.indexOf('id = "autoread"');
console.log(c.substring(autoReadIdx - 50, autoReadIdx + 50));
