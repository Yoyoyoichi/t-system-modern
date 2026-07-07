const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// Setting panel titles and labels
c = c.replace(/⚙️?\s*/g, '');
c = c.replace(/🏆\s*/g, '');
c = c.replace(/✅\s*/g, '');
c = c.replace(/🗣️?\s*/g, '');
c = c.replace(/⏳\s*/g, '');
c = c.replace(/🎨\s*/g, '');
c = c.replace(/🔤\s*/g, '');
c = c.replace(/📖\s*/g, '');
c = c.replace(/🔢\s*/g, '');
c = c.replace(/🐇\s*/g, '');
c = c.replace(/🐢\s*/g, '');
c = c.replace(/🏃\s*/g, '');
c = c.replace(/🔊\s*/g, '');

// Replace red circle emoji with standard monochrome circle character if it exists
c = c.replace(/⭕/g, '〇'); 
// ✖ is usually monochrome, but let's make it standard '×' just in case
c = c.replace(/✖/g, '×');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
