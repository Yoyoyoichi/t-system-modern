?<?php
try {
    $db = new PDO("pgsql:host=aws-1-ap-northeast-1.pooler.supabase.com;port=5432;dbname=postgres", "postgres.eqtxzxqvkprnmkiyczvv", "@/L5WG,s@xcqT%5");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h3>データベースの大文字・小文字 自動修正ツール</h3>";
    echo "Connected to Supabase successfully.<br><br>\n";

    // Rename columns first
    $stmtCols = $db->query("SELECT table_name, column_name FROM information_schema.columns WHERE table_schema = 'public'");
    $columns = $stmtCols->fetchAll(PDO::FETCH_ASSOC);
    $colCount = 0;
    foreach ($columns as $row) {
        $tableName = $row['table_name'];
        $oldCol = $row['column_name'];
        $newCol = strtolower($oldCol);
        if ($oldCol !== $newCol) {
            echo "Renaming column in table '{$tableName}': '{$oldCol}' -> '{$newCol}'...<br>\n";
            $db->exec('ALTER TABLE "' . $tableName . '" RENAME COLUMN "' . $oldCol . '" TO "' . $newCol . '"');
            $colCount++;
        }
    }

    // Rename tables
    $stmt = $db->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = 0;
    foreach ($tables as $row) {
        $oldName = $row['table_name'];
        $newName = strtolower($oldName);

        if ($oldName !== $newName) {
            echo "Renaming table: '{$oldName}' -> '{$newName}'...<br>\n";
            $db->exec('ALTER TABLE "' . $oldName . '" RENAME TO "' . $newName . '"');
            $count++;
        }
    }

    echo "<br><b>【完了】{$count}個のテーブルと、{$colCount}個のカラムをすべて小文字に修正しました！</b><br>\n";
    echo "このページを閉じて、もう一度 sample020.php を開いてみてください。";

} catch (PDOException $e) {
    echo "<b>Error:</b> " . $e->getMessage() . "<br>\n";
}
?>
