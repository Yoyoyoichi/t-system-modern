const fs = require('fs');
const lines = fs.readFileSync('sample020.php', 'utf8').split('\n');

const s1 = lines.findIndex(l => l.includes('value="送信"'));
if(s1>=0) console.log('--- Send Button Neighbors ---\n' + lines.slice(s1-2, s1+10).join('\n'));

const s2 = lines.findIndex(l => l.includes('value="Auto"'));
if(s2>=0) console.log('--- Auto Button Neighbors ---\n' + lines.slice(s2-5, s2+5).join('\n'));

const s3 = lines.findIndex(l => l.includes('value="次の問題"'));
if(s3>=0) console.log('--- Next Question Button Neighbors ---\n' + lines.slice(s3-5, s3+5).join('\n'));
