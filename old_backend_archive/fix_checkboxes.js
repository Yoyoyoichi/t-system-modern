const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

c = c.replace(/<input class\s*=\s*"button"\s+type="checkbox"\s+class="msc-checkbox"\s+id\s*=\s*"([^"]+)"(.*?)>/g, '<input class="msc-checkbox" type="checkbox" id="$1"$2>');

// Handle autoread specifically since it didn't have double classes in the snippet but might have style
// Wait, the snippet says: <input class="msc-checkbox" type="checkbox" id="autoread" onchange="settingSave()">
// So autoread is already perfect. Let's just strip the style="" from the remaining checkboxes.
c = c.replace(/<input class="msc-checkbox" type="checkbox" id="([^"]+)"(.*?)\s+style="[^"]*">/g, '<input class="msc-checkbox" type="checkbox" id="$1"$2>');

fs.writeFileSync('sample020.php', c);
console.log("SUCCESS");
