<?php
// db_wrapper.php
// MySQLiのインターフェースをエミュレートし、内部でSupabase(PostgreSQL)のPDOを利用するラッパークラス

class db_wrapper {
    private $pdo;
    public $connect_errno = 0;
    public $error = "";
    public $connect_error = "";

    public function __construct() {
        // Supabase PostgreSQL接続情報 (Connection Pooler: IPv4対応)
        $host = "aws-1-ap-northeast-1.pooler.supabase.com";
        $port = "5432";
        $dbname = "postgres";
        $user = "postgres.eqtxzxqvkprnmkiyczvv";
        // ==========================================
        // 【重要】ここにパスワードを設定してください
        // ==========================================
        $password = "@/L5WG,s@xcqT%5";

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->connect_errno = 1;
            $this->error = $e->getMessage();
            $this->connect_error = $e->getMessage();
            echo "DB Connection Error: " . $this->error . "<br>";
        }
    }

    public function query($sql) {
        // MySQL特有のコマンドを無視・変換する処理
        if (stripos(trim($sql), 'set names') === 0) return true;
        
        // PostgreSQL互換にするための簡易的な置換 (例: CURDATE() -> CURRENT_DATE)
        $sql = str_ireplace('CURDATE()', 'CURRENT_DATE', $sql);
        // sum(correct)などのバッククォートを完全に削除する（PostgreSQLの小文字統一仕様に合わせるため）
        $sql = str_replace('`', '', $sql);
        
        // MySQLの fetch_assoc 互換性のため、集計関数に自動で元の文字列のエイリアスを付ける
        // 例: SELECT sum(correct) -> SELECT sum(correct) AS "sum(correct)"
        $sql = preg_replace('/(sum\([^)]+\))/i', '$1 AS "$1"', $sql);
        $sql = preg_replace('/(max\([^)]+\))/i', '$1 AS "$1"', $sql);
        $sql = preg_replace('/(min\([^)]+\))/i', '$1 AS "$1"', $sql);
        $sql = preg_replace('/(count\([^)]+\))/i', '$1 AS "$1"', $sql);

        try {
            // INSERT, UPDATE, DELETEの場合は影響行数を返すかtrueを返す
            if (preg_match('/^\s*(INSERT|UPDATE|DELETE|ALTER|DROP|CREATE)/i', $sql)) {
                $affected = $this->pdo->exec($sql);
                return $affected !== false;
            }

            // SELECT等の場合
            $stmt = $this->pdo->query($sql);
            if ($stmt === false) {
                $this->error = "Query failed";
                return false;
            }
            return new db_result_wrapper($stmt);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo "SQL Query Error: " . $this->error . " | SQL: " . $sql . "<br>";
            return false;
        }
    }

    public function set_charset($charset) {
        return true; // PDOで設定済みのため何もしない
    }

    public function close() {
        $this->pdo = null;
    }
}

class db_result_wrapper {
    private $stmt;
    public $num_rows;
    public function __construct($stmt) {
        $this->stmt = $stmt;
        $this->num_rows = $stmt->rowCount();
    }
    private function convert_to_utf8($data) {
        return $data;
    }
    public function fetch_assoc() {
        return $this->convert_to_utf8($this->stmt->fetch(PDO::FETCH_ASSOC));
    }
    public function fetch_array() {
        return $this->convert_to_utf8($this->stmt->fetch(PDO::FETCH_BOTH));
    }
    public function fetch_row() {
        return $this->convert_to_utf8($this->stmt->fetch(PDO::FETCH_NUM));
    }
}

// 既存のmysqli関数をエミュレートする関数
if (!function_exists('mysqli_num_rows')) {
    function mysqli_num_rows($result) {
        if (is_object($result) && property_exists($result, 'num_rows')) {
            return $result->num_rows;
        }
        return 0;
    }
}

if (!function_exists('mysqli_close')) {
    function mysqli_close($link) {
        if (is_object($link) && method_exists($link, 'close')) {
            $link->close();
        }
        return true;
    }
}
 = new db_wrapper();
?>
