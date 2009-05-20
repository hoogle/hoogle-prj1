<?
  session_start();
  list($userid, $sid) = explode("#", base64_decode($_GET['auth']));
  require LIBRARY_PATH."db_mysql.php";
  $db = Mysql::getInstance('localhost');
  $sql = "SELECT sid FROM init_acc WHERE userid = '{$userid}'";
  $res = $db->query($sql);
  list($db_sid) = mysql_fetch_row($res);
  if ($db_sid != $sid)
  {
    $db->close();
    echo "認證失敗!";
    exit;
  }
  else
  {
    $sql = "UPDATE users SET verify_time = now() WHERE userid = '{$userid}'";
    $db->query($sql);
    $sql = "UPDATE init_acc SET verify_time = now() WHERE userid = '{$userid}'";
    $db->query($sql);
    $sql = "SELECT userid, usernk FROM users WHERE userid = '{$userid}'";
    $res = $db->query($sql);
    list($db_userid, $db_nick) = mysql_fetch_row($res);
    $db->close();
    $_SESSION['userid'] = $db_userid;
    $_SESSION['nick'] = $db_nick;
    header("location:/");
    exit;
  }
?>
