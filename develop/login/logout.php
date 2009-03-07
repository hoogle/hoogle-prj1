<?
  session_start();
  include LIBRARY_PATH."mysql_cfg.inc";
  Connect_Mysql();

  session_unset();
  session_destroy();
  Close_Mysql();
  if (isset($_GET['go_url']))
  {
    header("location:".$_GET['go_url']);
  }
  else
  {
    header("location:/");
  }
?>
