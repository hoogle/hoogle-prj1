<?
  session_start();
  session_unset();
  session_destroy();
  if (isset($_GET['go_url']))
  {
    header("location:".$_GET['go_url']);
  }
  else
  {
    header("location:/");
  }
?>
