const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

// Optimize the category fetch queries to use DISTINCT
c = c.replace(/"select\s+\$db_column\s+from\s+\$db_name\s+where\s+question\s+!=\s+'settings'"/gi, '"select DISTINCT $db_column from $db_name where question != \'settings\'"');
c = c.replace(/"select\s+category2\s+from\s+\$db_name\s+where\s+question\s+!=\s+'settings'"/gi, '"select DISTINCT category2 from $db_name where question != \'settings\'"');
c = c.replace(/"select\s+category3\s+from\s+\$db_name\s+where\s+question\s+!=\s+'settings'"/gi, '"select DISTINCT category3 from $db_name where question != \'settings\'"');
c = c.replace(/"select\s+category4\s+from\s+\$db_name\s+where\s+question\s+!=\s+'settings'"/gi, '"select DISTINCT category4 from $db_name where question != \'settings\'"');
c = c.replace(/"select\s+category5\s+from\s+\$db_name\s+where\s+question\s+!=\s+'settings'"/gi, '"select DISTINCT category5 from $db_name where question != \'settings\'"');

// Optimize the total sum queries by checking if they can be bypassed or just keep them (DISTINCT is the biggest win)

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
