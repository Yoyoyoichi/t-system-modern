<?php
// error_reporting(0);
mb_language("ja");
mb_internal_encoding('UTF-8');

$pieces = explode("^", $_POST["data"]);
var_dump ($pieces);

$DB_name =  $pieces[0];
$progression = $pieces[2];
$song =  $pieces[1];

require_once __DIR__ . '/db_wrapper.php';
		$mysqli = new db_wrapper();

$song = $mysqli->real_escape_string($song);

if( $mysql->connect_errno){
    echo 'Access Failed7';//謗･邯壼､ｱ謨・
    exit;
}

$query = "select * from $DB_name where songs = '$song'";
echo $query;
$result = $mysqli->query($query);
$row_cnt = mysqli_num_rows($result);
echo $row_cnt;

if ($row_cnt==0) {
  $str_sql = "SELECT max(songnumber) FROM  $DB_name";
  // echo "<pre>  $str_sql  </pre>";
  $result = $mysqli->query($str_sql);
  $result2  = $result->fetch_assoc();

  $maxSongNumber = $result2['max(songnumber)'] +1;

  $str_sql = "insert into $DB_name (songs, progression,songnumber)
          select '$song','$progression','$maxSongNumber'
          where NOT EXISTS (select 1 from $DB_name where songs = '$song')";
  echo $str_sql  ;
  $res = $mysqli->query($str_sql);
} else {
  //繝・・繧ｿ譖ｴ譁ｰ
  $sql = "UPDATE $DB_name SET
      progression = '$progression'
      WHERE songs = '$song'";
  echo "sql is ".$sql."\n"."\n";

  // SQL螳溯｡・
  $res = $mysqli->query($sql);
}




?>

