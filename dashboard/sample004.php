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
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");

//データベース取得
$str_sql = "select *  from `Test03` ";
$res = $mysqli->query($str_sql);
if (!$res) {error_log($mysqli->error);exit;}
while($dat = $res->fetch_assoc()){
//echo "---print_r---\n";
var_dump($dat);
echo "<br>";
}


//データベース切断
mysqli_close($mysqli);

?>
    </body>
</html>