const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/for\s*\(\s*i\s*=\s*min\s*;\s*i\s*<\s*questionnumbers\.length\s*;\s*i\+\+\s*\)\s*\{\s*while\s*\(\s*true\s*\)\s*\{\s*\/\/\s*alert\(i\);\s*var\s+tmp\s*=\s*intRandom\(min\s*,\s*questionnumbers\.length-1\);\s*if\s*\(!randoms\.includes\(tmp\)\)\s*\{\s*randoms\.push\(tmp\);\s*break;\s*\}\s*\}\s*\}/g,
  `for(i = min; i < questionnumbers.length; i++){ randoms.push(i); }
          for(let j = randoms.length - 1; j > 0; j--) { const k = Math.floor(Math.random() * (j + 1)); [randoms[j], randoms[k]] = [randoms[k], randoms[j]]; }`);

c = c.replace(/for\s*\(\s*i\s*=\s*min\s*;\s*i\s*<\s*max\+1\s*;\s*i\+\+\s*\)\s*\{\s*while\s*\(\s*true\s*\)\s*\{\s*\/\/\s*alert\(i\);\s*var\s+tmp\s*=\s*intRandom\(min\s*,\s*max\);\s*if\s*\(!randoms\.includes\(tmp\)\)\s*\{\s*randoms\.push\(tmp\);\s*break;\s*\}\s*\}\s*\}/g,
  `for(i = min; i < max+1; i++){ randoms.push(i); }
    for(let j = randoms.length - 1; j > 0; j--) { const k = Math.floor(Math.random() * (j + 1)); [randoms[j], randoms[k]] = [randoms[k], randoms[j]]; }`);

fs.writeFileSync('sample020.php', c);
console.log("Done");
