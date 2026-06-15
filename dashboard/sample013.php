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
    echo 'Access Failed1';//接続失敗
    exit;
}

$mysqli->set_charset('utf8');        
        
$query = "select * from Test05 WHERE `3`= 'c' ";//条件を指定している。列3がcのもの

$result = $mysqli->query($query);

if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        echo $row['2'];
        echo "<br>";
    }
}
else {
    echo 'Run Failed2';
}        
                
echo "check1";        
echo "<br>";  
        
$sql = 'SELECT * FROM Test05';
$res = $mysqli->query($sql);

if( $res ) {
	while( $data = $res->fetch_assoc() ) {
	var_dump( $data );
    echo "<br>";
}
}
//$mysqli->close();
        
echo "check2";        
echo "<br>";         
        
// UPDATEのSQL作成
$sql = "UPDATE Test05 SET
    d = CONCAT(d,'dsd'),
    c = c+1
    WHERE a = 1";
//d = 'asdfaf'
// SQL実行
$res = $mysqli->query($sql);
var_dump($res);
echo "<br>";
$mysqli->close();
        
        

?>
    </body>
</html>

