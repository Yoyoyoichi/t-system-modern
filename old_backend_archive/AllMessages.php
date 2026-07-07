?<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>All Messages</title>
        <style type="text/css">
        .textlines {
          font-family: 'ＭＳ Ｐゴシック';
        }
        </style>
    </head>
    <body>
      <?php
require_once 'db_wrapper.php';
        // error_reporting(-1);
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
        
        if (!$res) {error_log($mysqli->error);exit;}
        while($dat = $res->fetch_assoc()){
          //echo "---print_r---\n";
          // var_dump($dat);
          $data[] = $dat['Tables_in_terashimayo'];

          // echo $dat;

        }
        // var_dump($data)."\n";

        // $data2 =array_diff($data, array('Terashima01','Yutaka','Terashima02','Sakuya1118','yui0901'));
        $data2 =array('','miyu','nao','Terashima01','remiha0206');
        // var_dump($data2)."\n";
        $data[] = array();
        $data= array_values($data2);
        // var_dump($data)."\n";
        $row_cnt = count($data);
        echo "<div style='display:inline-flex'>";

        // for 文/////
        for($i = 1; $i < $row_cnt; $i++){
          
          // echo $i;
          // echo "<br>";
          $str_sql = "SELECT min(questionnumber) FROM terashimayo.$data[$i]";
          $result = $mysqli->query($str_sql);
          if (!$result) {continue;}
          $test  = $result->fetch_assoc();
          $minimum = $test['min(questionnumber)'];
          
          $sql = "SELECT information FROM terashimayo.$data[$i] WHERE questionnumber = $minimum";
          $res = $mysqli->query($sql);
          $test  = $res->fetch_assoc();
          $test2 = $test['information'];

          $str_sql = "SELECT COUNT('answer1') FROM terashimayo.$data[$i] WHERE (convert(RIGHT(`pre_qdate`, 10), Date) BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY) AND DATE_SUB(CURRENT_DATE, INTERVAL 0 DAY))";
          $resul = $mysqli->query($str_sql);
          $tes  = $resul->fetch_assoc();
          $newQuestion = $tes;

          $correctIncorect[] = array();
          $qdate[] = array();
          $totalTime[] = array();
          for ($j = 0; $j < 15; $j++){
          	$sql = "SELECT correct + incorrect FROM `A01tsystemrecord01` WHERE id = '$data[$i]' AND qdate = DATE_SUB(CURRENT_DATE(), INTERVAL $j DAY)";
          	$res = $mysqli->query($sql);
            $test  = $res->fetch_assoc();
            $correctIncorect[$j] = $test['correct + incorrect'];
            $qdate[$j] = date('Y/m/d', strtotime('-'.$j.' day'));
            // echo $sql;
            // echo "<br>";
            $sql = "SELECT totalTime FROM `A01tsystemrecord01` WHERE id = '$data[$i]' AND qdate = DATE_SUB(CURRENT_DATE(), INTERVAL $j DAY)";
          	$res = $mysqli->query($sql);
            $test  = $res->fetch_assoc();
            $totalTime[$j] = round ((int)$test['totalTime']/60);
            // echo $test['totalTime'];
            // echo "<br>";
            // echo $sql;
            // echo $corectIncorect[$j];
            // echo $qdate[$j];
          }

          echo "<br>";


          echo "
            <div style='display:block;margin:5px'>
            <font size= 5px>$data[$i]</font>
            <br>
          ";
          // for 文
          for($k = 0; $k < 15; $k++){
            echo $qdate[$k]; 
            echo " - "; 
            echo $correctIncorect[$k];
            echo " - ";
            echo $totalTime[$k];
            echo"<br>";
          }
          
          echo $newQuestion["COUNT('answer1')"];
          echo"<br>";
          

          echo "
            <TEXTAREA id = '$data[$i]' class='textlines'
            style ='width:200px;height:200px;font-size:15px; margin:0px 20px 0px 0px;'
            onchange = informationChange(this.id)
            >$test2</textarea>
            </div>
          ";
          if($i % 4 == 0){
            echo "</div><br><br><br>";

            echo "<div style='display:inline-flex'>";
          }

        }

        echo "</div><br><br>";




        //データベース切断
        mysqli_close($mysqli);
      ?>
      <script type="text/javascript">
        function informationChange(id){
          var id2 = id;
          var moji=  id + "^" + document.getElementById(id).value;
          moji = encodeURIComponent(moji);

          var xmlhttp=createXmlHttpRequest();
          if(xmlhttp!=null)
          {
              xmlhttp.open("POST", "../informationChange.php", false);//不正解ボタンを押す
              xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              var data="data="+moji;
              xmlhttp.send(data);
              var res=xmlhttp.responseText;

          }
        }



        function createXmlHttpRequest()
        {
            var xmlhttp=null;
            //alert("3");
            if(window.ActiveXObject)
            {
                try
                {
                    xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e)
                {
                    try
                    {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e2)
                    {
                    }
                }
            }
            else if(window.XMLHttpRequest)
            {
                xmlhttp = new XMLHttpRequest();
            }
            return xmlhttp;

        }
      </script>
    </body>
</html>
