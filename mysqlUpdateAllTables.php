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
          // $sql = "UPDATE terashimayo.$data[$i] SET pre_qdate=COALESCE(pre_qdate,'')";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "UPDATE terashimayo.$data[$i] SET q_record=COALESCE(q_record,'')";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `q_record` `q_record` VARCHAR(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          $sql = "UPDATE terashimayo.$data[$i] SET qdate= 20010101 WHERE qdate < 20190101";
          $res = $mysqli->query($sql);
          print_r("sql is ".$sql)."\n";
          echo "<br>";
          $sql = "UPDATE terashimayo.$data[$i] SET qdate=COALESCE(qdate,20010101)";
          $res = $mysqli->query($sql);
          print_r("sql is ".$sql)."\n";
          echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] DROP COLUMN correct1";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "alter table terashimayo.$data[$i] MODIFY pca2 int AFTER category5 ";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "alter table terashimayo.$data[$i] MODIFY incorrect2 int AFTER category5 ";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "alter table terashimayo.$data[$i] MODIFY correct2 int AFTER category5 ";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          $sql = "UPDATE terashimayo.$data[$i] SET correct=COALESCE(correct,0)";
          $res = $mysqli->query($sql);
          print_r("sql is ".$sql)."\n";
          echo "<br>";
          $sql = "UPDATE terashimayo.$data[$i] SET incorrect=COALESCE(incorrect,0)";
          $res = $mysqli->query($sql);
          print_r("sql is ".$sql)."\n";
          echo "<br>";
          $sql = "UPDATE terashimayo.$data[$i] SET correct2=COALESCE(correct2,0)";
          $res = $mysqli->query($sql);
          print_r("sql is ".$sql)."\n";
          echo "<br>";
          $sql = "UPDATE terashimayo.$data[$i] SET incorrect2=COALESCE(incorrect2,0)";
          $res = $mysqli->query($sql);
          print_r("sql is ".$sql)."\n";
          echo "<br>";
          $sql = "UPDATE terashimayo.$data[$i] SET pca2= correct2/(correct2 + incorrect2)*100";
          $res = $mysqli->query($sql);
          print_r("sql is ".$sql)."\n";
          echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `25` `hint` VARCHAR(1000) DEFAULT ''";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `22` `setting01` VARCHAR(1000) DEFAULT ''";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `23` `setting02` VARCHAR(1000) DEFAULT ''";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `24` `setting03` VARCHAR(1000) DEFAULT ''";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `33` `forgetingCurveLevel` int(11)  DEFAULT 0";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `26` `tag` VARCHAR(1000) DEFAULT ''";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "UPDATE terashimayo.$data[$i] SET forgetingCurveLevel=COALESCE(forgetingCurveLevel,0)";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "UPDATE terashimayo.$data[$i] SET nextQdate = null where nextQdate = '0000-00-00'";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "alter table terashimayo.$data[$i] add pca2 int after incorrect2";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `correct1` `correct2` int(11)  DEFAULT 0";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "ALTER TABLE terashimayo.$data[$i] CHANGE `inncorrect2` `incorrect2` int(11)  DEFAULT 0";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          $sql = "UPDATE terashimayo.$data[$i] SET correct2 = CHAR_LENGTH(REPLACE(q_record,'×','')), incorrect2 = CHAR_LENGTH(q_record)-correct2";
          $res = $mysqli->query($sql);
          print_r("sql is ".$sql)."\n";
          echo "<br>";
          // $sql = "alter table terashimayo.$data[$i] add category4 int after questionnumber";//alter table terashimayo.$data[$i] add category4 int after questionnumber;
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "alter table terashimayo.$data[$i] add category5 int after questionnumber";//alter table terashimayo.$data[$i] add category4 int after questionnumber;
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "alter table terashimayo.$data[$i] CHANGE `category5` `category5` VARCHAR(100) NULL DEFAULT NULL";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "alter table terashimayo.$data[$i] CHANGE `category4` `category4` VARCHAR(100) NULL DEFAULT NULL";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";

          // $sql = "UPDATE terashimayo.$data[$i]
          //         set
          //         pre_qdate = (
          //         CASE WHEN  RIGHT(pre_qdate,1) = ' '
          //         THEN left(pre_qdate,char_length(pre_qdate)-1)
          //         ELSE pre_qdate
          //         END)";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // echo "<br>";
          // $sql = "UPDATE terashimayo.$data[$i]
          //         set
          //         pre_qdate = (
          //         CASE WHEN  RIGHT(pre_qdate,1) = ','
          //         THEN left(pre_qdate,char_length(pre_qdate)-1)
          //         ELSE pre_qdate
          //         END)";
          // $res = $mysqli->query($sql);
          // print_r("sql is ".$sql)."\n";
          // $res = $mysqli->query($sql);
        }






        //データベース切断
        mysqli_close($mysqli);
      ?>
    </body>
</html>
