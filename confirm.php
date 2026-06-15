<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <?php
      mb_language("Japanese");
      mb_internal_encoding("UTF-8");
      $to = $_POST['to'];
      $title = $_POST['title'];
      $content = $_POST['content'];
      if(mb_send_mail($to, $title, $content)){
        echo "繝｡繝ｼ繝ｫ繧帝∽ｿ｡縺励∪縺励◆";
      } else {
        echo "繝｡繝ｼ繝ｫ縺ｮ騾∽ｿ｡縺ｫ螟ｱ謨励＠縺ｾ縺励◆";
      };
    ?>
  </body>
</html>