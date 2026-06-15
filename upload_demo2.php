<?php
foreach($_FILES as $key=> $fileData){
    // echo '1';
    // echo $_POST["imagefolder"];
    // echo '1.1';
    if($_SERVER['SERVER_NAME']=='terashimayo.s1008.xrea.com'){
      $result =  move_uploaded_file($fileData["tmp_name"], "images/".$_POST["imagefolder"]."/".$fileData["name"]);
      // var_dump ($result);
      // echo '2';
    }
    // echo '3';
    // echo 'success';
    // echo $fileData["name"];
    // var_dump ($fileData);
    // echo $_SERVER['SERVER_NAME'];
    
}
?>