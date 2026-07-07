?<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>HTML5</title>
    </head>
    <body>
      <script type="text/javascript">
      </script>
      <?php
require_once 'db_wrapper.php';

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
        echo "row_cnt is ".$row_cnt."\n"."\n";
        if (!$res) {error_log($mysqli->error);exit;}
        while($dat = $res->fetch_assoc()){
          //echo "---print_r---\n";
          // var_dump($dat);
          $data[] = $dat['Tables_in_terashimayo'];

          // echo $dat;

        }
        // var_dump($data)."\n";

        //変数を確認
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        print_r("data[1] is ".$data[1])."\n";


        // for 文
        for($i = 1; $i < $row_cnt; $i++){
          $sql = "UPDATE terashimayo.$data[$i] SET pre_qdate=COALESCE(pre_qdate,'')";
          $res = $mysqli->query($sql);

        }






        //データベース切断
        mysqli_close($mysqli);
      ?>
    </body>
</html>
