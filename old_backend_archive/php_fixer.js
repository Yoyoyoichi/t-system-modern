const fs = require('fs');
const file = 'sample020.php';
let content = fs.readFileSync(file, 'utf8');

const targetRegex = /\$information = \$test \? \$test\['information'\] : '';\s*echo"<div  id = 'massages' style='display:inline-flex;width:100vw'> ";\s*echo "<p style='font-size:20px;color:#FF0000;width:60vw;padding : 0px 0px 0px 0px;'> やった問題数の合計は\$testo です。<br><br>\s*今日やった合計は \$todayQuestonDone です。<br><br>\s*正解の合計は \$test2 です。<br><br>\s*不正解の合計は \$test3 です。 <br><br>\s*正答率は \$seitoritu ％です。<br><br>\s*前回は \$test4 でした。 <br><br>\s*<\/p>"."\\n"."\\n";\/\/\/\/.*?<font size="5" color="#000000">問目<\/fsont>\s*\/\/ if \(!\(\$db_name==="AOI0501"\)\) \{\s*echo "\s*<div style='height:10vh;width:30vw;'>\s*<TEXTAREA id = 'information' ;\s*class ='textlines'\s*style ='font-size:25px;height:100%;width:30vw;'        \s*onchange = informationChange\(\)\s*>\$information<\/textarea>\s*<\/div>\s*";\s*\/\/ \}\s*echo "<\/div><br>";/s;

const replacement = `$information = $test ? $test['information'] : '';
    echo "<div id='massages' class='modern-stats' style='display:inline-flex;width:100vw;margin-bottom:16px;'>\\n";
    echo "<p class='compact-stats-text'>\\n";
    echo "<span class='stat-item'>やった問題数の合計は {$testo} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span class='stat-item'>今日やった合計は {$todayQuestonDone} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span class='stat-item'>正解の合計は {$test2} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span class='stat-item'>不正解の合計は {$test3} です。</span> <span class='stat-sep'></span>\\n";
    echo "<span class='stat-item'>正答率は {$seitoritu} ％です。</span> <span class='stat-sep'></span>\\n";
    echo "<span class='stat-item'>前回は {$test4} でした。</span>\\n";
    echo "</p>\\n";
    echo "</div>\\n<br>";`;

if (content.match(targetRegex)) {
    content = content.replace(targetRegex, replacement);
    fs.writeFileSync(file, content);
    console.log("PHP fix applied successfully.");
} else {
    console.log("Could not match the PHP block.");
}
