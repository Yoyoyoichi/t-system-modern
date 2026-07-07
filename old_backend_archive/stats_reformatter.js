const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

// The new logic for Stats & Info Row to replace the old one
const newStatsLogic = `
    // 2. Stats Row (Compact)
    const statsRow = document.createElement('div');
    statsRow.className = 'mtp-stats-row';
    const massages = document.getElementById('massages');
    if(massages) { 
        massages.className = 'modern-stats'; 
        
        // Parse the text to create a compact flex layout
        const p = massages.querySelector('p');
        if(p) {
            const text = p.innerHTML;
            // The text has <br><br> and raw strings. Let's just extract the numbers/values if possible
            // Or simpler: replace all <br><br> with a clean separator, and make it a single line
            const cleanText = text.replace(/<br>\\s*<br>/g, '<span class="stat-sep"></span>').replace(/\\n/g, '');
            p.innerHTML = cleanText;
            p.className = 'compact-stats-text';
        }
        statsRow.appendChild(massages); 
    }

    // Hide or remove the old information textarea as requested by the user
    const infoTextarea = document.getElementById('information');
    if(infoTextarea) { 
        infoTextarea.style.display = 'none'; // Hide it so it doesn't take space
    }
    const infoParent = document.querySelector('div[style*="height:10vh;width:30vw;"]');
    if(infoParent) infoParent.style.display = 'none';

    topPanel.appendChild(statsRow);
`;

const newCss = `
.compact-stats-text {
    font-size: 14px !important;
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: center;
    color: #334155 !important;
    font-weight: 500;
}
.stat-sep {
    width: 4px;
    height: 4px;
    background: #cbd5e1;
    border-radius: 50%;
    display: inline-block;
}
`;

// Replace the old Stats & Info Row block in the JS
const oldStatsRegex = /\/\/ 2\. Stats & Info Row[\s\S]*?topPanel\.appendChild\(statsRow\);/;
if (content.match(oldStatsRegex)) {
    content = content.replace(oldStatsRegex, newStatsLogic);
}

// Add the new CSS
content = content.replace('</style>', newCss + '\n</style>');

fs.writeFileSync(file, content);
console.log("Stats reformatted successfully.");
