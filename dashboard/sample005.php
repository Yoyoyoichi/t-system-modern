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
$db_name =  "MuAnki";  
$db_column = "question";
$mysqli = new mysqli('mysql1.php.xdomain.ne.jp', 'terashimayo_ichi', 'yoyoyoyo', 'terashimayo_mysql01');
if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

//デフォルト文字セットを設定
$mysqli->set_charset("utf8");
$row = "";
//データベース取得
$str_sql = "select question from $db_name";
$result = $mysqli->query($str_sql);
        
$row_cnt = mysqli_num_rows($result);
print  "問題数は ".$row_cnt."<br>"; 
echo "xxx"."<br>";        
        
echo "resultは".!$result."<br>"; 
var_dump ($result);
echo "<br>";
        
if (!$result) {error_log($mysqli->error);exit;}
        
while($dat = $result->fetch_assoc()){
    $taskData[] = $dat['question'];
    
}

//$row = $result->fetch_array(MYSQLI_ASSOC);
        
//echo "row is ".$row;
echo "taskDataは  ";////      //////////
        
var_dump ($taskData);
echo "xxx"."<br>";           



echo $taskData[1]."<br>";



        //////
for($i = 0; $i < 100; $i++){
echo $taskData[$i]."<br>";
}
        
        
        
//データベース切断
mysqli_close($mysqli);

?>
    </body>
</html>

