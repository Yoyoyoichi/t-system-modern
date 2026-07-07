const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/var xmlhttp=createXmlHttpRequest\(\);\s*if\(xmlhttp!=null\)\s*\{\s*xmlhttp\.open\("POST", "\.\.\/settingSave\.php", false\);\s*xmlhttp\.setRequestHeader\("Content-Type", "application\/x-www-form-urlencoded"\);\s*var data="data="\+moji;\s*xmlhttp\.send\(data\);\s*var res=xmlhttp\.responseText;\s*\}/g, `  // Use async fetch to prevent UI freezing
  fetch("../settingSave.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "data=" + encodeURIComponent(moji)
  }).catch(e => console.error("Setting save failed:", e));`);

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
