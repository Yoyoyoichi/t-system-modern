const fs = require('fs');
let c = fs.readFileSync('sample020.php', 'utf8');

const injection = `
<script>
window.addEventListener('DOMContentLoaded', () => {
    // Fetch and display the true Supabase daily/total stats to replace the stale PHP MySQL values on load
    if (typeof updateAndDisplayDailyTotal === 'function') {
        updateAndDisplayDailyTotal(null);
    }
});
</script>
</body>`;

c = c.replace('</body>', injection);
fs.writeFileSync('sample020.php', c);
console.log("SUCCESS: Injected updateAndDisplayDailyTotal on page load.");
