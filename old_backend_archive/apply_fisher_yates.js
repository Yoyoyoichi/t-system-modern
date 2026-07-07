const fs = require('fs');
let c = fs.readFileSync('sample020.php');
// Read as buffer, convert to string (sample020.php was saved as UTF-8 in git? Wait, if it was Shift-JIS, reading as string is risky)
// Wait! If the file is Shift-JIS, I shouldn't touch it with string manipulation.
// But we can do a simple regex replace if we read as 'latin1' or buffer?
// Node's 'utf8' reading of Shift-JIS destroys it.
