const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// Replace the literal string "\u554f\u984c\u6570" that was mistakenly injected.
// In javascript, to match a backslash, we need two backslashes.
c = c.replace(/\\u554f\\u984c\\u6570/g, '&#21839;&#38988;&#25968;');
c = c.replace(/\\u6700\\u4f4e\\u6b63\\u89e3\\u6570/g, '&#26368;&#20302;&#27491;&#35299;&#25968;');

// Also fix the listChanged message which probably also has literal \u...
c = c.replace(/\\u0044\\u0042\\u8aad\\u307f\\u8fbc\\u307f\\u4e2d\\u002e\\u002e\\u002e\\u0020\\u0028\\u004c\\u006f\\u0061\\u0064\\u0069\\u006e\\u0067\\u0020\\u0044\\u0042\\u002e\\u002e\\u002e\\u0029/g, 'DB&#35501;&#12415;&#36込&#12415;&#20013;... (Loading DB...)');
c = c.replace(/\\u0044\\u0042\\u8aad\\u307f\\u8fbc\\u307f\\u5b8c\\u4e86\\u3002\\u8a72\\u5f53\\u554f\\u984c\\u6570\\u003a\\u0020/g, 'DB&#35501;&#12415;&#36込&#12415;&#23436;&#20102;&#12290;&#35442;&#24403;&#21839;&#38988;&#25968;: ');

fs.writeFileSync('sample020.php', c);
console.log("Fixed unicode literals");
