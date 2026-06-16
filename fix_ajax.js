var fs=require('fs'); var c=fs.readFileSync('sample020.php', 'utf8'); c=c.replace(/xmlhttp\.open\("POST", "\.\.\//g, 'xmlhttp.open("POST", "./'); fs.writeFileSync('sample020.php', c);
