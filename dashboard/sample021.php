<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>HTML5</title>
    </head>
    <body>
    <form name="form1">
        <p><input type="text" name="DB_name"></p>
    </form>
    <input type="button" value="決定" onclick="clickBtn1()">
   

    <script>
    function clickBtn1(){
      alert(document.form1.DB_name.value);






    }

    </script>
    </body>
</html>


