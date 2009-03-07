<?
  session_start();
  list($userid, $sid) = explode("#", base64_decode($_GET['auth']));
  require LIBRARY_PATH."mysql_cfg.inc";
  Connect_Mysql();
  $sql = "SELECT sid FROM init_acc WHERE userid = '{$userid}'";
  $res = Query_Mysql($sql);
  list($db_sid) = mysql_fetch_row($res);
  if ($db_sid != $sid)
  {
    Close_Mysql();
    echo "認證失敗!";
    exit;
  }
  else
  {
    $sql = "UPDATE users SET verify_time = now() WHERE userid = '{$userid}'";
    Query_Mysql($sql);
    $sql = "UPDATE init_acc SET verify_time = now() WHERE userid = '{$userid}'";
    Query_Mysql($sql);
    $sql = "SELECT userid, usernk FROM users WHERE userid = '{$userid}'";
    $res = Query_Mysql($sql);
    list($db_userid, $db_nick) = mysql_fetch_row($res);
    Close_Mysql();
    $_SESSION['userid'] = $db_userid;
    $_SESSION['nick'] = $db_nick;
    header("location:/");
    exit;
  }
?>
