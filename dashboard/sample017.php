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

$query ="SHOW COLUMNS FROM MuAnki FROM terashimayo_mysql01";

$result = $mysqli->query($query);
$i = 1;
if( $result = $mysqli->query($query) ){
    while($row = $result->fetch_assoc() ){
        //1レコードずつ読み込む
        //name列を表示する場合
        //echo $row[2];//echo $row['2'];
        //echo "<br>";
        
        
        //print_r($row);
        
        $response[$i] =$row["Field"];
        echo $i." ".$response[$i];
        //print_r($response);
        
        echo "<br>";
        $i = $i + 1;

    }
}

$sampleSelectBox = "<select name=\"selectBoxName\">\n";
for ( $i = 0; $i < count( $response ); $i++ ) {
    $sampleSelectBox .= "\t<option value=\"{$response[$i]}\">{$response[$i]}</option>\n";
}
$sampleSelectBox .= "</select>\n";
echo "{$sampleSelectBox}";
echo "<select name='example2'>
<option value='サンプル6'>=</option>
<option value='サンプル7'>></option>
<option value='サンプル8'><</option>
</select>";

?>


<p>カラムは、<?php print_r($response); ?>です。</p>

<select name="example">
<option value="サンプル1"><?php echo $response[40]; ?></option>
<option value="サンプル2"><?php echo $response[41]; ?></option>
<option value="サンプル3"><?php echo $response[42]; ?></option>
<option value="サンプル4"><?php echo $response[43]; ?></option>
<option value="サンプル5"><?php echo $response[44]; ?></option>
</select>
<select name="example2">
<option value="サンプル6">=</option>
<option value="サンプル7">></option>
<option value="サンプル8"><</option>
</select>
</body>
</html>

