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

        $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');


        if( $mysql->connect_errno){
            echo 'Access Failed';//接続失敗
            exit;///
        }/////

        //デフォルト文字セットを設定///
        $mysqli->set_charset("utf8");////


        $data = array();
        //データベース取得
        $str_sql = "show full tables;";
        $res = $mysqli->query($str_sql);
        $row_cnt = mysqli_num_rows($res);
        if (!$res) {error_log($mysqli->error);exit;}
        while($dat = $res->fetch_assoc()){
          //echo "---print_r---\n";
          // var_dump($dat);
          $data[] = $dat['Tables_in_terashimayo'];

          // echo $dat;

        }
        // var_dump($data)."\n";




        // for 文/////
        for($i = 1; $i < $row_cnt; $i++){          
          $str_sql = "SELECT min(questionnumber) FROM terashimayo.$data[$i]";
          $result = $mysqli->query($str_sql);
          $test  = $result->fetch_assoc();
          $minimum = $test['min(questionnumber)'];

          $sql = "SELECT information FROM terashimayo.$data[$i] WHERE questionnumber = $minimum";
          $res = $mysqli->query($sql);
          $test  = $res->fetch_assoc();
          $test2 = $test['information'];
          print_r($data[$i]." : ".$test2)."\n";
          echo "\n";
          echo "<br>";
          echo "\n";
          echo "<br>";
;        }






        //データベース切断
        mysqli_close($mysqli);
      ?>
    </body>
</html>
