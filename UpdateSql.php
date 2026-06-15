<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>UpdateSql</title>
    <style type="text/css">
        body {background-color: #F0FFF0; }
        div.top{
          width:97%;
          color:"#000000";
        }
    </style>
  </head>
  <body>
    <?php
require_once 'db_wrapper.php';
      $sqlhost = "localhost";
      $sqluser = "terashimayo";
      $sqlpass = "Yoyoyo444";
      $sqldtbs = "terashimayo";
      // $sqlhost = "localhost";
      // $sqluser = "root";
      // $sqlpass = "yoichi41";
      // $sqldtbs = "terashimayo";
      $anstopPos1 =13;
      $ansleftPos1 = 2;
      $ctgtopPos1 = $anstopPos1 + 29;
      $ctgleftPos1 = 2;


    ?>

        <p><font size="10" color="#00aa00" style='position: absolute; left: 10vw; top: <?php echo $anstopPos1-6;?>vh;'>問題追加</font>
          <a id="previous" href="sample020.php">
            <font size="6" color="#FF0000" style='position: absolute; left: 33vw; top: <?php echo $anstopPos1-4;?>vh;'>学習画面</font>
          </a>
        </p>
        <form name ="mainform" action="" method="post">

        <input type="text" id="database" name = "database"
          value = "<?php if (isset($_POST["DB_name"])) {echo $_POST["DB_name"];}?>" placeholder = "id"
          style='position: absolute; left: <?php echo $ansleftPos1;?>vh; top: <?php echo $anstopPos1;?>vh;
          width: 40%; height :5vh; font-size: 24px;'/>

        <input type="submit" value="送信"
          style='position: absolute;
          top: <?php echo $anstopPos1 -5;?>vh;
          left:70%;
          font-size: 25px;width: 25%; height: 10vh;'>

    <TEXTAREA id="question" name="question" value = "" placeholder = "question" style='position: absolute;   left: <?php echo $ansleftPos1;?>vh; top: <?php echo $anstopPos1+7;?>vh; width: 95%; height :20vh; font-size: 20px;'></TEXTAREA>


    <TEXTAREA id="answer1" name="answer1"  value = "" placeholder = "answer" style='position: absolute; left: <?php echo $ansleftPos1;?>vh; top: <?php echo $anstopPos1+43;?>vh; width: 95%; height :20vh;  font-size: 20px;'></TEXTAREA>




    <DIV>
      <input type="text" id="category1" name="category1" value = "" placeholder = "category1"
        style='position: absolute;
        left: <?php echo $ctgleftPos1;?>vh;
        top: <?php echo $ctgtopPos1 ;?>vh;
        width: 40%; height :5vh;
        font-size: 24px;'
      />
      <input type="text" id="category2" name="category2" value = "" placeholder = "category2"
        style='position: absolute;
        left: 47%;
        top: <?php echo $ctgtopPos1 ;?>vh;
        width: 40%; height :5vh;
        font-size: 24px;'
      />
      <input type="text" id="category3" name="category3" value = "" placeholder = "category3"
        style='position: absolute;
        left: <?php echo $ctgleftPos1;?>vh;
        top: <?php echo $ctgtopPos1 +7;?>vh;
        width: 40%; height :5vh;
        font-size: 24px;'
      />
    </DIV>



    <p>
    <br>



    </form>

    <script type="text/javascript">
      document.getElementById("database").value = location.search.substring(1);
      document.getElementById("previous").href += "?"+ location.search.substring(1);
    </script>
    <?php
      // echo "<pre>  1  </pre>";
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST["question"])) {
          // var_dump($_POST["database"])
          // echo "<pre>  2  </pre>";


          error_reporting(0);
          mb_language("ja");
          mb_internal_encoding('UTF-8');
          $database = $_POST["database"];
          $question = $_POST["question"];
          $answer1 = $_POST["answer1"];
          $category1 = $_POST["category1"];
          $category2 = $_POST["category2"];
          $category3 = $_POST["category3"];
          // echo "<pre>  2.1  </pre>";
          // $mysqli = new db_wrapper('localhost', 'terashimayo', 'Yoyoyo444', 'terashimayo');
          $mysqli = new db_wrapper($sqlhost, $sqluser, $sqlpass, $sqldtbs);
        if ($mysqli->connect_error) {error_log($mysqli->connect_error);exit;}

        // echo "<pre>  3  </pre>";
        //デフォルト文字セットを設定
        $mysqli->set_charset("utf8");


        // $str_sql = "SELECT question FROM  $database where question = '$question'";
        // $result = $mysqli->query($str_sql);
        // $result2  = $result->fetch_assoc();
        // if()
        // {

        // }



        $str_sql = "SELECT max(questionnumber) FROM  $database";
        // echo "<pre>  $str_sql  </pre>";
        $result = $mysqli->query($str_sql);
        $result2  = $result->fetch_assoc();
        // echo "<pre>";
        // print_r($result2);
        // echo "</pre>";
        $maxQuestionNumber = $result2['max(questionnumber)'] +1;
        // echo "<pre>";
        // print_r($maxQuestionNumber);
        // echo "</pre>";
        //データベース取得
        // $str_sql = "select question  from `MuAnki` ";
        //条件に該当するデータが存在しない時だけ登録するSQL

        $qdate =2000-01-01;
        $correct = 0;
        $incorrect = 0;

        $str_sql = "insert into $database (question,questionnumber,answer1,category1,category2,category3,qdate,correct,incorrect)
                select '$question','$maxQuestionNumber','$answer1','$category1','$category2','$category3',$qdate ,$correct, $incorrect
                where NOT EXISTS (select 1 from $database where question = '$question')";

        // $str_sql = "insert into $database (question,questionnumber,answer1,category1,category2,category3)
        //         select '$question','$maxQuestionNumber','$answer1','$category1','$category2','$category3'
        //         where NOT EXISTS (select 1 from $database where question = '$question')";

        // $str_sql = "INSERT INTO $database (question,questionnumber,answer1,category1,category2,category3) VALUES ('$question','$maxQuestionNumber','$answer1','$category1','$category2','$category3') SELECT question FROM $database WHERE NOT SELECT EXISTS(SELECT question FROM $database WHERE question = '$question')";

        // $str_sql = "INSERT INTO $database (question,questionnumber,answer1,category1,category2,category3)  VALUES ('$question','$maxQuestionNumber','$answer1','$category1','$category2','$category3')";
        // echo "<pre>  $str_sql  </pre>";
        $res = $mysqli->query($str_sql);
        // echo "<pre>";
        // print_r($str_sql);
        // echo "</pre>";
        // if (!$res) {error_log($mysqli->error);exit;}
        // while($dat = $res->fetch_assoc()){
        //   //echo "---print_r---\n";
        //   var_dump($dat);
        //   echo "<br>";
        // }
        //データベース切断
        $sql = "ALTER TABLE $database CHANGE `q_record` `q_record` VARCHAR(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
        $res = $mysqli->query($sql);
        // print_r("sql is ".$sql)."\n";

        $sql = "ALTER TABLE $database CHANGE `poorat` `poorat` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
        $res = $mysqli->query($sql);
        // print_r("sql is ".$sql)."\n";

        $sql = "ALTER TABLE $database CHANGE `pre_qdate` `pre_qdate` VARCHAR(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
        $res = $mysqli->query($sql);
        // print_r("sql is ".$sql)."\n";



        mysqli_close($mysqli);



        }
      }

    ?>
  </body>
</html>
