<?php
// db_connect.php
// Supabase (PostgreSQL) 接続用の共通ファイル

function getDbConnection() {
    // ----------------------------------------------------
    // SupabaseのConnection stringを設定してください
    // 例: postgresql://postgres.xxxxxx:[YOUR-PASSWORD]@aws-0-ap-northeast-1.pooler.supabase.com:6543/postgres
    // ----------------------------------------------------
    $connection_string = "YOUR_SUPABASE_CONNECTION_STRING_HERE";

    // PDOでパースできるように正規表現で分解
    if (preg_match('/^postgresql:\/\/(.*?):(.*?)@(.*?):(\d+)\/(.*)$/', $connection_string, $matches)) {
        $user = $matches[1];
        $password = $matches[2];
        $host = $matches[3];
        $port = $matches[4];
        $dbname = $matches[5];

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

        try {
            $pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch (PDOException $e) {
            die("データベース接続エラー: " . $e->getMessage());
        }
    } else {
        die("無効な接続文字列です。");
    }
}
?>
