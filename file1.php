<?php
$up_file  = "";
$up_ok = false;
$tmp_file = isset($_FILES["up"]["tmp_name"]) ? $_FILES["up"]["tmp_name"] : "";
$org_file = isset($_FILES["up"]["name"])     ? $_FILES["up"]["name"]     : "";
$txt1 = $_POST["hiddenTxt"];
if( $tmp_file != "" &&
   is_uploaded_file($tmp_file) )
{
 $split = explode('.', $org_file); $ext = end($split);
 if( $ext != "" &&
     $ext != $org_file  )
 {
//    $up_file = "images/". date("Ymd_His.") . mt_rand(1000,9999) . ".$ext";
   $up_file = "images/".$txt1."/"."$org_file";
   $up_ok = move_uploaded_file( $tmp_file, $up_file);
 }
}
?>
