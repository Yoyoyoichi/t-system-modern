const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/\.button, input\[type="button"\], input\[type="submit"\] \{[\s\S]*?\}/,
`.button, input[type="button"], input[type="submit"] {
    background-color: #f4f4f5;
    color: #111 !important;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 8px 16px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
}`);

c = c.replace(/\.msc-btn-primary \{[\s\S]*?\}/,
`.msc-btn-primary {
    background: #f4f4f5 !important;
    color: #111111 !important;
    border: 1px solid #cccccc !important;
}`);

c = c.replace(/\.msc-btn-primary:hover \{[\s\S]*?\}/,
`.msc-btn-primary:hover {
    background: #e2e8f0 !important;
    transform: translateY(-1px);
}`);

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
