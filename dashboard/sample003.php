<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>HTML5</title>
    </head>
    <body>
        <script type="text/javascript">
        </script>
        <?php
            // 接続
            $mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');

            //接続状況の確認
            if (mysqli_connect_errno()) {
                echo "データベース接続失敗" . PHP_EOL;
                echo "errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "error: " . mysqli_connect_error() . PHP_EOL;
                exit();
            }

            echo 'データベース接続成功';

            // 切断
        ?>
    </body>
</html>