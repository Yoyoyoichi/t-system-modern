const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8').replace(/\r\n/g, '\n');

const target1 = `        for(i = min; i < questionnumbers.length; i++){
          while(true){
            // alert(i);
            var tmp = intRandom(min, questionnumbers.length-1);
            if(!randoms.includes(tmp)){
              randoms.push(tmp);
              break;
            }
          }
        }`;
const replacement1 = `        for(i = min; i < questionnumbers.length; i++){ randoms.push(i); }
        for(let j = randoms.length - 1; j > 0; j--) { const k = Math.floor(Math.random() * (j + 1)); [randoms[j], randoms[k]] = [randoms[k], randoms[j]]; }`;

const target2 = `          for(i = min; i < questionnumbers.length; i++){
            while(true){
              // alert(i);
              var tmp = intRandom(min, questionnumbers.length-1);
              if(!randoms.includes(tmp)){
                randoms.push(tmp);
                break;
              }
            }
          }`;
const replacement2 = `          for(i = min; i < questionnumbers.length; i++){ randoms.push(i); }
          for(let j = randoms.length - 1; j > 0; j--) { const k = Math.floor(Math.random() * (j + 1)); [randoms[j], randoms[k]] = [randoms[k], randoms[j]]; }`;

const target3 = `    for(i = min; i < max+1; i++){
      while(true){
        // alert(i);
        var tmp = intRandom(min, max);
        if(!randoms.includes(tmp)){
          randoms.push(tmp);
          break;
        }
      }
    }`;
const replacement3 = `    for(i = min; i < max+1; i++){ randoms.push(i); }
    for(let j = randoms.length - 1; j > 0; j--) { const k = Math.floor(Math.random() * (j + 1)); [randoms[j], randoms[k]] = [randoms[k], randoms[j]]; }`;

console.log("Replacing 1:", c.includes(target1)); c = c.replace(target1, replacement1);
console.log("Replacing 2:", c.includes(target2)); c = c.replace(target2, replacement2);
console.log("Replacing 3:", c.includes(target3)); c = c.replace(target3, replacement3);

fs.writeFileSync('sample020.php', c);
