<?php
try {
    $db = new PDO("pgsql:host=aws-1-ap-northeast-1.pooler.supabase.com;port=5432;dbname=postgres", "postgres.eqtxzxqvkprnmkiyczvv", "@/L5WG,s@xcqT%5");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h3>データ型 自動修正ツール</h3>";
    echo "Connected to Supabase successfully.<br><br>\n";

    $stmt = $db->query("SELECT table_name, column_name FROM information_schema.columns WHERE table_schema = 'public'");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = 0;

    foreach ($columns as $row) {
        $table = $row['table_name'];
        $col = $row['column_name'];

        try {
            // Integer columns
            if (in_array($col, ['correct', 'incorrect', 'recordnumber', 'questionnumber', 'songnumber', 'answer1', 'answer2', 'answer3', 'answer4'])) {
                $db->exec("ALTER TABLE \"$table\" ALTER COLUMN \"$col\" TYPE integer USING \"$col\"::integer");
                echo "Changed $table.$col to integer<br>\n";
                $count++;
            }
            // Date columns
            elseif (in_array($col, ['qdate', 'pre_qdate'])) {
                // First handle any weird date strings like empty string
                $db->exec("UPDATE \"$table\" SET \"$col\" = NULL WHERE \"$col\" = '' OR \"$col\" = '0000-00-00'");
                $db->exec("ALTER TABLE \"$table\" ALTER COLUMN \"$col\" TYPE date USING \"$col\"::date");
                echo "Changed $table.$col to date<br>\n";
                $count++;
            }
        } catch (Exception $e) {
            echo "<span style='color:red'>Failed to change $table.$col: " . $e->getMessage() . "</span><br>\n";
        }
    }

    echo "<br><b>【完了】{$count}個のカラムのデータ型を修正しました！</b><br>\n";

} catch (PDOException $e) {
    echo "<b>Error:</b> " . $e->getMessage() . "<br>\n";
}
?>
