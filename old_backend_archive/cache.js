const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const meta = `
<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
`;

if (c.includes('<head>')) {
    c = c.replace('<head>', '<head>\n' + meta);
} else {
    c = meta + '\n' + c;
}

fs.writeFileSync('sample020.php', c);
console.log('Added no-cache headers');
