const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

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
    font-family: inherit;
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
    c = c.replace('<div class="msc-settings-toolbar" id="questionbuttonbox">', css + '\n<div class="msc-settings-toolbar" id="questionbuttonbox">');
    fs.writeFileSync('sample020.php', c);
    console.log('Successfully injected CSS.');
} else {
    console.log('CSS already exists.');
}
