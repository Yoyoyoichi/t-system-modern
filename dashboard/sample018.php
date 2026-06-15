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
            $url = 'mysql1.php.xdomain.ne.jp'; //mysqlサーバー名
            $user = 'terashimayo_ichi'; //ユーザーID
            $pass = 'yoyoyoyo';	//パスワード
            $db = 'terashimayo_mysql01'; //データベース名

            $link = mysqli_connect($url,$user,$pass) or die("MySQL接続失敗");
            $sdb = mysqli_select_db($link,$db) or die("データベース選択失敗");
            echo "good ";
        ?>
    </body>
</html>