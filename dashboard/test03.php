<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>

  <script type="text/javascript" language="javascript">
var day = new Date().toLocaleString();
document.getElementById("box").innerHTML = day;
var value = "例えば";
$.ajax({
    type: "POST",
    url: "test04.php",
    data: {"item": value},
        success: function(html){
            alert(html);
        }
    });
  </script>

</head>


</body>
</html>