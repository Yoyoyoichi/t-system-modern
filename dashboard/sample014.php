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
$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');


if( $mysql->connect_errno){
    echo 'Access Failed';//接続失敗
    exit;
}

$query = "select * from MuAnki WHERE `PCA` < 5  ";//条件を指定している。列1がcのもの

$result = $mysqli->query($query);

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        echo $row[1];//echo $row['2'];
        echo "<br>";
    }
}
else {
    echo 'Run Failed';
}

?>
    </body>
</html>

