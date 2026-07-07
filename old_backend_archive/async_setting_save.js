const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const target = `  var xmlhttp=createXmlHttpRequest();
  if(xmlhttp!=null)
  {
    xmlhttp.open("POST", "../settingSave.php", false);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data="data="+moji;
    xmlhttp.send(data);
    var res=xmlhttp.responseText;
  }`;

const replacement = `  // Use async fetch to prevent UI freezing
  fetch("../settingSave.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "data=" + encodeURIComponent(moji)
  }).catch(e => console.error("Setting save failed:", e));`;

if (c.includes(target)) {
  c = c.replace(target, replacement);
  fs.writeFileSync('sample020.php', c);
  console.log("SUCCESS");
} else {
  console.log("TARGET NOT FOUND");
}
