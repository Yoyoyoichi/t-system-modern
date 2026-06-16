const fs = require('fs');
const files = ['getqestions.php', 'getqestionsOneByOne.php', 'getqestionsTwoByTwo.php', 'getqestionsThreeByThree.php'];
files.forEach(f => {
  let c = fs.readFileSync(f, 'utf8');
  c = c.replace(/^.*echo \$category4.*/gm, '// $&');
  c = c.replace(/^.*echo \$\$operator1.*/gm, '// $&');
  c = c.replace(/^.*echo \$criteria1.*/gm, '// $&');
  c = c.replace(/^.*echo "3\.11".*/gm, '// $&');
  c = c.replace(/^.*echo "a".*/gm, '// $&');
  c = c.replace(/^.*echo "\\n"\."\\n".*/gm, '// $&');
  c = c.replace(/^.*echo \$str_sql.*/gm, '// $&');
  fs.writeFileSync(f, c);
});
console.log('API files updated.');

let db = fs.readFileSync('db_wrapper.php', 'utf8');
if (!db.includes('$mysqli = new db_wrapper();')) {
  db += '\n$mysqli = new db_wrapper();\n';
  fs.writeFileSync('db_wrapper.php', db);
  console.log('db_wrapper.php updated.');
}
