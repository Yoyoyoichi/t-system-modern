const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const targetRegex = /<div class="questionbuttonbox" id="questionbuttonbox" style='line-height: 2vh;vertical-align:bottom' >[\s\S]*?<br>\s*<pre id="novel"/;

if (targetRegex.test(c)) {
    console.log("Matched the target section!");
    
    // We will extract the exact contents, but remove the inline styles that make them huge,
    // and wrap them in modern containers.
    
    // First, let's extract the raw HTML of the selects to preserve all options.
    const match = c.match(targetRegex)[0];
    
    function extractSelect(id) {
        const regex = new RegExp(`<select[^>]*id=['"]${id}['"][^>]*>([\\s\\S]*?)</select>`);
        const m = match.match(regex);
        return m ? m[0].replace(/style=['"][^'"]*['"]/g, "class='msc-select'") : "";
    }
    
    const selectPoorat = extractSelect('poorat');
    const selectFontresize = extractSelect('fontresize');
    const selectMp3Speed = extractSelect('mp3Speed');
    const selectMp3StartPoint = extractSelect('mp3StartPoint');
    const selectImageSize1 = extractSelect('imageSize1');
    const selectImageSize2 = extractSelect('imageSize2');
    
    // Extract the buttons
    let btnReadQ = '<input class ="msc-btn msc-btn-secondary" type="button" name="botan" id="buttonreadtxt_q" onClick="readQuestion();" value="🔊 問題読上">';
    let btnReadA = '<input class ="msc-btn msc-btn-secondary" type="button" name="botan" id="buttonreadtxt_a" onClick="readAnswer();" value="🔊 解答読上">';
    
    // Replace the block with the modern toolbar
    const modernToolbar = `
<div class="msc-settings-toolbar" id="questionbuttonbox">
    <div class="msc-setting-group">
        <span class="msc-setting-label">達成度</span>
        <div class="msc-setting-slot">${selectPoorat}</div>
    </div>
    <div class="msc-setting-group">
        <span class="msc-setting-label">📝 テキスト</span>
        <div class="msc-setting-slot">${selectFontresize}</div>
    </div>
    <div class="msc-setting-group">
        <span class="msc-setting-label">🖼️ 画像</span>
        <div class="msc-setting-slot">${selectImageSize1}</div>
        <div class="msc-setting-slot">${selectImageSize2}</div>
    </div>
    <div class="msc-setting-group" style="border-right: none;">
        <span class="msc-setting-label">🔊 音声</span>
        <div class="msc-setting-slot">${selectMp3Speed}</div>
        <div class="msc-setting-slot">${selectMp3StartPoint}</div>
        <div class="msc-setting-slot">${btnReadQ}</div>
        <div class="msc-setting-slot">${btnReadA}</div>
    </div>
</div>
<br>
<pre id="novel"`;

    c = c.replace(targetRegex, modernToolbar);
    
    // Let's add the CSS if it's not already there
    const css = `
<style>
.msc-settings-toolbar {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    background: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 12px 16px;
    margin-bottom: 24px;
    align-items: center;
    width: 100%;
    box-sizing: border-box;
}
.msc-setting-group {
    display: flex;
    align-items: center;
    gap: 8px;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    padding-right: 16px;
}
.msc-setting-label {
    font-size: 0.85rem;
    color: #94a3b8;
    font-weight: 500;
    white-space: nowrap;
}
.msc-setting-slot {
    display: flex;
    align-items: center;
    gap: 6px;
}
.msc-select {
    height: 32px;
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #fff;
    border-radius: 6px;
    padding: 0 8px;
    font-size: 0.85rem;
    cursor: pointer;
}
.msc-select option {
    background: #1e293b;
    color: #fff;
}
@media (max-width: 768px) {
    .msc-settings-toolbar {
        flex-direction: column;
        align-items: stretch;
    }
    .msc-setting-group {
        border-right: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-right: 0;
        padding-bottom: 12px;
        justify-content: space-between;
    }
}
</style>
`;
    
    if (!c.includes('.msc-settings-toolbar {')) {
        c = c.replace('</head>', css + '\n</head>');
    }
    
    fs.writeFileSync('sample020.php', c);
    console.log("Successfully refactored settings in sample020.php");
} else {
    console.log("Could not find the target section using regex.");
}
