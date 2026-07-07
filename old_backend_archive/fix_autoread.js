const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');
const searchTarget = `<label class="msc-checkbox-wrapper">
            <select class="selectBox" name='autoReading' id='autoReading' onchange = "settingSave()" style='width: 23%; font-size: 20px;'>
    <option value='je' style='width: 23%' placeholder="読上音声">読上音声</option>
    <option value='je'>問題-日本語/解答‐英語</option>
    <option value='ej'>問題-英語/解答‐日本語</option>
    <option value='jj'>問題-日本語/解答‐日本語</option>
    <option value='ee'>問題-英語/解答‐英語</option>
    <option value='j*'>問題だけ-日本語</option>
    <option value='e*'>問題だけ-英語</option>
    <option value='*j'>解答だけ‐日本語</option>
    <option value='*e'>解答だけ‐英語</option>
  </select>
            <span class="msc-checkbox-label">自動読上</span>
        </label>`;
const replacement = `<label class="msc-checkbox-wrapper">
            <input class="msc-checkbox" type="checkbox" id="autoread" onchange="settingSave()">
            <span class="msc-checkbox-label">自動読上</span>
        </label>`;

if (c.includes(searchTarget)) {
    c = c.replace(searchTarget, replacement);
    fs.writeFileSync('sample020.php', c);
    console.log("SUCCESS: Replaced bad autoread block.");
} else {
    console.log("FAILED: Target not found.");
}
