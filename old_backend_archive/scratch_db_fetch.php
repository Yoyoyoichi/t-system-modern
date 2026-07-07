<?php
require_once __DIR__ . '/db_wrapper.php';

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Database Connected successfully.\n\n";

// 英検一級に関連しそうなテーブル（通常は問答データが入っているメインテーブル）を推定
// getqestions.phpの先頭などで定義されている可能性があるが、PostgreSQLのpg_tablesから調査
$sql_tables = "SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public'";
$result_tables = $mysqli->query($sql_tables);

$tables = [];
if ($result_tables) {
    while ($row = $result_tables->fetch_assoc()) {
        $tables[] = $row['tablename'];
    }
}

echo "Tables list:\n";
foreach ($tables as $t) {
    echo "- " . $t . "\n";
}
echo "\n";

// 各テーブルの中を検索し、英検一級の問題があるか確認
foreach ($tables as $table) {
    echo "Searching in table: $table ...\n";
    // 英検一級は "1級" や "一級" や "Grade 1" や "Eiken 1" などでcategoryに入っている可能性が高い
    $search_sql = "SELECT * FROM $table WHERE 
        category1 LIKE '%一級%' OR category1 LIKE '%1級%' OR category1 LIKE '%Eiken%'
        OR category2 LIKE '%一級%' OR category2 LIKE '%1級%'
        OR category3 LIKE '%一級%' OR category3 LIKE '%1級%'
        LIMIT 3";
    
    $res = $mysqli->query($search_sql);
    if ($res && $res->num_rows > 0) {
        echo ">>> Found matches in table '$table':\n";
        while ($item = $res->fetch_assoc()) {
            print_r($item);
            echo "--------------------------------------------------\n";
        }
    } else {
        echo "No Eiken 1 matches in '$table'.\n";
    }
}
?>
