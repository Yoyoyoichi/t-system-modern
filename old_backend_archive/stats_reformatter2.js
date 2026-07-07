const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

const updatedStatsLogic = `
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
            const cleanText = text.replace(/<br>\\s*<br>/gi, '<span class="stat-sep"></span>').replace(/\\n/g, '');
            p.innerHTML = cleanText;
            p.className = 'compact-stats-text';
        }
        statsRow.appendChild(massages); 
    }

    // Completely remove the old information textarea AND its parent div to be 100% sure it's gone
    const infoTextarea = document.getElementById('information');
    if(infoTextarea) {
        const parent = infoTextarea.parentElement;
        if(parent && parent.tagName === 'DIV') {
            parent.style.display = 'none';
            parent.remove(); // Nuke it from the DOM completely
        }
        infoTextarea.style.display = 'none';
        infoTextarea.remove();
    }

    topPanel.appendChild(statsRow);
`;

// Replace the old Stats & Info Row block in the JS
const oldStatsRegex = /\/\/ 2\. Stats Row \(Compact\)[\s\S]*?topPanel\.appendChild\(statsRow\);/;
if (content.match(oldStatsRegex)) {
    content = content.replace(oldStatsRegex, updatedStatsLogic);
}

fs.writeFileSync(file, content);
console.log("Stats reformatter updated to forcefully remove the information board.");
