const fs = require('fs');
let content = fs.readFileSync('sample020.php', 'utf8');
content = content.replace(/\\n\r?\n\/\* Unified 2-Column Layout \*\//g, '\n/* Unified 2-Column Layout */');
content = content.replace(/\\n<\/style>/g, '\n</style>');
content = content.replace(/\\n<\/body>/g, '\n</body>');
fs.writeFileSync('sample020.php', content);
console.log('Fixed literal newlines');
