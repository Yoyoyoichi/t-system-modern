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
            echo 'Access Failed';//謗･邯壼､ｱ謨・            exit;///
        }/////

        //繝・ヵ繧ｩ繝ｫ繝域枚蟄励そ繝・ヨ繧定ｨｭ螳・//
        $mysqli->set_charset("utf8");////


        $data = array();
        //繝・・繧ｿ繝吶・繧ｹ蜿門ｾ・        $str_sql = "show full tables;";
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

        //螟画焚繧堤｢ｺ隱・        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        print_r("data[1] is ".$data[1])."\n";


        // for 譁・        for($i = 1; $i < $row_cnt; $i++){
          $sql = "UPDATE terashimayo.$data[$i] SET pre_qdate=COALESCE(pre_qdate,'')";
          $res = $mysqli->query($sql);

        }






        //繝・・繧ｿ繝吶・繧ｹ蛻・妙
        mysqli_close($mysqli);
      ?>
    </body>
</html>
