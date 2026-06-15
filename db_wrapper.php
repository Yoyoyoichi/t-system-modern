<?php
// db_wrapper.php
// MySQLiのインターフェースをエミュレートし、内部でSupabase(PostgreSQL)のPDOを利用するラッパークラス

class db_wrapper {
    private $pdo;
    public $connect_errno = 0;
    public $error = "";

    public function __construct() {
        // Supabase PostgreSQL接続情報
        $host = "db.eqtxzxqvkprnmkiyczvv.supabase.co";
        $port = "5432";
        $dbname = "postgres";
        $user = "postgres";
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
        }
    }

    public function query($sql) {
        // MySQL特有のコマンドを無視・変換する処理
        if (stripos(trim($sql), 'set names') === 0) return true;
        
        // PostgreSQL互換にするための簡易的な置換 (例: CURDATE() -> CURRENT_DATE)
        $sql = str_ireplace('CURDATE()', 'CURRENT_DATE', $sql);
        // sum(correct)などのバッククォートをダブルクォートか削除に
        $sql = str_replace('`', '"', $sql);

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
    public function __construct($stmt) {
        $this->stmt = $stmt;
    }
    public function fetch_assoc() {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function fetch_array() {
        return $this->stmt->fetch(PDO::FETCH_BOTH);
    }
    public function fetch_row() {
        return $this->stmt->fetch(PDO::FETCH_NUM);
    }
}

// 既存のmysqli_close関数をエミュレートする関数
if (!function_exists('mysqli_close')) {
    function mysqli_close($link) {
        if (is_object($link) && method_exists($link, 'close')) {
            $link->close();
        }
        return true;
    }
}
?>
