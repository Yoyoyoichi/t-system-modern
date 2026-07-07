const fs = require('fs');
const c = require('child_process').execSync('git show b5f0272:sample020.php').toString();
const start = c.indexOf('<div id ="setting"');
console.log(c.substring(start, start + 2000));
