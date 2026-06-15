<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');


if( $mysql->connect_errno){
    echo 'Access Failed';//接続失敗
    exit;
}

$query = "select * from MuAnki WHERE `questionnumber` < 5  ";//条件を指定している。列1がcのもの

$result = $mysqli->query($query);

$response ="";
$row = "a";
echo $row;
echo "<br>";
$i = 1;
if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        //echo $row[2];//echo $row['2'];
        //echo "<br>";
        echo $i."x";
        echo "<br>";
        print_r($row);
        echo "<br>";
        $response[$i] =$row[1];
        echo "<br>";
        print_r($response);
        echo "<br>";
        echo "<br>";
        $i = $i + 1;

    }
}
else {
    echo 'Run Failed';
}
echo "ifの外";
echo "<br>";
echo $row;
echo "<br>";
print_r($row);
echo "<br>";
print_r($response);

?>


<p>こんにちは、<?php print_r($response); ?>さん。</p>

<select name="example">
<option value="サンプル1"><?php echo $response[0]; ?></option>
<option value="サンプル2"><?php echo $response[1]; ?></option>
<option value="サンプル3"><?php echo $response[2]; ?></option>
<option value="サンプル3"><?php echo $response[3]; ?></option>
<option value="サンプル3"><?php echo $response[4]; ?></option>
</select>
</body>
</html>

