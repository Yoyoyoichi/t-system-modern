const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/<option value=20 >定数<\/option>/g, '<option value="" disabled>問題数</option><option value="20" selected>20</option>');
c = c.replace(/<option value=20>20<\/option>/g, ''); 

c = c.replace(/<option value=3 style='width: 23%' placeholder="最低正解数">最低正解数<\/option>/g, '<option value="" disabled>最低正解数</option><option value="3" selected>3</option>');
c = c.replace(/<option value=3>3<\/option>/g, '');

fs.writeFileSync('sample020.php', c);
console.log("Done");
