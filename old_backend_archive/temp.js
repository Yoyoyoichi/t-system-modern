const fs = require('fs');

let c = fs.readFileSync('sample020.php', 'utf8');

// The second block ONLY
const setStart = c.indexOf('<div id ="setting" class="setting"');
const setEnd = c.indexOf('</div>', setStart);

if (setStart === -1 || setEnd === -1) {
    console.error("Could not find setting block");
    process.exit(1);
}
const setHtml = c.substring(setStart, setEnd + 6);

// We want to extract ALL selects, checkboxes, and text inputs from ONLY the second block.
function extractEl(html, id) {
    const selRegex = new RegExp(`<select[^>]*id\\s*=\\s*['"]?${id}['"]?[^>]*>[\\s\\S]*?<\\/select>`, 'i');
    let m = html.match(selRegex);
    if (m) return m[0].replace(/style\\s*=\\s*['"][^'"]*['"]/ig, "class='msc-select'");

    const inpRegex = new RegExp(`<input[^>]*id\\s*=\\s*['"]?${id}['"]?[^>]*>`, 'i');
    m = html.match(inpRegex);
    if (m) {
        let tag = m[0];
        if (tag.includes('type="checkbox"')) {
            tag = tag.replace(/style\\s*=\\s*['"][^'"]*['"]/ig, "class='msc-checkbox'");
            tag = tag.replace(/class\\s*=\\s*['"][^'"]*['"]/ig, "class='msc-checkbox'");
        } else if (tag.includes('type="text"')) {
            tag = tag.replace(/style\\s*=\\s*['"][^'"]*['"]/ig, "class='msc-input'");
        }
        return tag;
    }
    return '';
}

// ONLY settings from div#setting
const config = {
    'autoSpeed': { label: '最低正解数', icon: '🏆' },
    'autoReading': { label: '読上音声', icon: '🗣️' },
    'jpSpeed': { label: '日本語速さ', icon: '🇯🇵' },
    'engSpeed': { label: '英語速さ', icon: '🇺🇸' },
    'NOC': { label: '最低正解数', icon: '✅' },
    'autoAnswer': { label: '自動解答(秒)', icon: '⏳' },
    'backGround': { label: '背景画像', icon: '🎨' },
    'fontSelect': { label: 'フォント', icon: '🔤' },
    'novelSelect': { label: '小説', icon: '📖' },
    'novelSentenceNumber': { label: '文章番号', icon: '🔢' }
};

const checkboxes = {
    'qachange': '問題/解答',
    'autoread': '自動読上',
    'keyControl': 'キー操作',
    'answerByMyself': '解答入力',
    'randomOrNot': 'ランダム',
    'chordsOrNot': 'コード音声',
    'flexButton': '横並び',
    'blackCheck': '真っ黒'
};

const combinedHtml = setHtml; // ONLY setHtml this time

let panelHtml = `
<div class="msc-settings-panel">
    <div class="msc-settings-header">
        <span class="msc-settings-title">⚙️ 詳細設定</span>
    </div>
    <div class="msc-settings-grid">
`;

for (const [id, info] of Object.entries(config)) {
    let elHtml = extractEl(combinedHtml, id);
    if (!elHtml) {
        console.warn('Could not extract ' + id);
        continue;
    }
    elHtml = elHtml.replace(/<option[^>]*disabled[^>]*>.*?<\/option>/i, '');
    elHtml = elHtml.replace(/<option[^>]*placeholder[^>]*>.*?<\/option>/i, '');
    
    let style = '';
    if (id === 'novelSelect' || id === 'novelSentenceNumber') {
        style = ' style="display:none;"';
    }

    panelHtml += `
        <div class="msc-setting-item"${style}>
            <span class="msc-setting-label">${info.icon} ${info.label}</span>
            <div class="msc-setting-control">
                ${elHtml}
            </div>
        </div>`;
}

panelHtml += `
    </div>
    <div class="msc-settings-divider"></div>
    <div class="msc-settings-checkboxes">
`;

for (const [id, label] of Object.entries(checkboxes)) {
    let elHtml = extractEl(combinedHtml, id);
    if (!elHtml) {
        console.warn('Could not extract checkbox ' + id);
        continue;
    }
    if (!elHtml.includes('class=')) {
        elHtml = elHtml.replace('type="checkbox"', 'type="checkbox" class="msc-checkbox"');
    }
    panelHtml += `
        <label class="msc-checkbox-wrapper">
            ${elHtml}
            <span class="msc-checkbox-label">${label}</span>
        </label>`;
}

panelHtml += `
    </div>
</div>
`;

const css = `
<style>
.msc-settings-panel {
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 24px;
    margin: 32px auto;
    width: 95%;
    max-width: 1200px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    font-family: 'Inter', sans-serif;
    color: #f1f5f9;
    box-sizing: border-box;
}
.msc-settings-header {
    margin-bottom: 24px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding-bottom: 12px;
}
.msc-settings-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #e2e8f0;
}
.msc-settings-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}
.msc-setting-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.msc-setting-label {
    font-size: 0.85rem;
    color: #94a3b8;
    font-weight: 500;
}
.msc-select, .msc-input {
    width: 100%;
    height: 36px;
    background: rgba(30, 41, 59, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #fff;
    border-radius: 8px;
    padding: 0 12px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}
.msc-select:hover, .msc-input:hover {
    border-color: rgba(255, 255, 255, 0.4);
}
.msc-select option {
    background: #1e293b;
    color: #fff;
}
.msc-settings-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.1);
    margin: 24px 0;
}
.msc-settings-checkboxes {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.msc-checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}
.msc-checkbox {
    appearance: none;
    width: 20px;
    height: 20px;
    background: rgba(30, 41, 59, 0.8);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    transition: all 0.2s;
}
.msc-checkbox:checked {
    background: #3b82f6;
    border-color: #3b82f6;
}
.msc-checkbox:checked::after {
    content: '';
    position: absolute;
    left: 6px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}
.msc-checkbox-label {
    font-size: 0.95rem;
    color: #cbd5e1;
    user-select: none;
}
</style>
`;

// Replace ONLY the setting block
let newC = c.replace(setHtml, css + '\n' + panelHtml);

console.log("Panel contains autoread?", panelHtml.includes("autoread"));
console.log('Successfully refactored bottom settings ONLY!');
