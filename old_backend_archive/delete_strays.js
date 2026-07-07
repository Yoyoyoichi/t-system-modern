const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// 1. Remove <p> and </p> around DB_name
c = c.replace(/<form name ="mainform" id ="mainform"　action="" method="post">\r?\n<p>/g, '<form name ="mainform" id ="mainform" action="" method="post">');
c = c.replace(/<\/p>\r?\n <div id ="grandParent1">/g, ' <div id ="grandParent1">');

// 2. Remove <br> tags inside grandParent1 after review2
c = c.replace(/<\/a>\s*<br>\s*<br>\s*<br>\s*<\/div>/g, '</a>\n  </div>');

// 3. Remove <br> after massages div
c = c.replace(/echo "<\/div>\\n<br>";/g, 'echo "</div>\\n";');

// 4. Remove <br> after Lv4
c = c.replace(/style=" width:15vw;height:150px; font-size: 20px"><br>\r?\n  <input class ="button" type="button" name="atLeastOne"/g, 'style=" width:15vw;height:150px; font-size: 20px">\n  <input class ="button" type="button" name="atLeastOne"');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS: Deleted stray <p> and <br> tags.");
