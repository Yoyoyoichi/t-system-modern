<?php
try {
    \ = new PDO("pgsql:host=aws-1-ap-northeast-1.pooler.supabase.com;port=5432;dbname=postgres", "postgres.eqtxzxqvkprnmkiyczvv", "@/L5WG,s@xcqT%5");
    \->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h3>データベースの大文字・小文字 自動修正ツール</h3>";
    echo "Connected to Supabase successfully.<br><br>\n";

    // Rename columns first
    \ = \->query("SELECT table_name, column_name FROM information_schema.columns WHERE table_schema = 'public'");
    \ = \->fetchAll(PDO::FETCH_ASSOC);
    \ = 0;
    foreach (\ as \) {
        \ = \['table_name'];
        \ = \['column_name'];
        \ = strtolower(\);
        if (\ !== \) {
            echo "Renaming column in table '{\}': '{\}' -> '{\}'...<br>\n";
            \->exec('ALTER TABLE "' . \ . '" RENAME COLUMN "' . \ . '" TO "' . \ . '"');
            \++;
        }
    }

    // Rename tables
    \ = \->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
    \ = \->fetchAll(PDO::FETCH_ASSOC);
    \ = 0;
    foreach (\ as \) {
        \ = \['table_name'];
        \ = strtolower(\);

        if (\ !== \) {
            echo "Renaming table: '{\}' -> '{\}'...<br>\n";
            \->exec('ALTER TABLE "' . \ . '" RENAME TO "' . \ . '"');
            \++;
        }
    }

    echo "<br><b>【完了】{\}個のテーブルと、{\}個のカラムをすべて小文字に修正しました！</b><br>\n";
    echo "このページを閉じて、もう一度 sample020.php を開いてみてください。";

} catch (PDOException \) {
    echo "<b>Error:</b> " . \->getMessage() . "<br>\n";
}
?>

