<?
  session_start();
  require LIBRARY_PATH."mysql_cfg.inc";
  require LIBRARY_PATH."function.inc";

  Connect_Mysql();
  $_POST['now_time'] = date("Y-m-d H:i:s");
  $sql = "INSERT INTO web3.map_point (title, userid, lat, lng) ";
  $sql.= "VALUES ('{$_POST['title']}', '{$_SESSION['userid']}', '{$_POST['lat']}', '{$_POST['lng']}')";
  Query_Mysql($sql);
  Close_Mysql();
?>
