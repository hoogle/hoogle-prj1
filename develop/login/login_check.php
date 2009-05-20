<?php
  session_start();
  require LIBRARY_PATH."db_mysql.php";
  require LIBRARY_PATH."function.inc";
  $db = Mysql::getInstance('localhost');

  $sql = "SELECT userid, pw_opid, usernk, verify_time FROM users ";
  $sql.= "WHERE userid = '{$_POST['userid']}'";
  $res = $db->query($sql);
  list($db_userid, $db_pw, $db_nick, $db_vtime) = mysql_fetch_row($res);

  if ($db_vtime == "0000-00-00 00:00:00")
  {
    header("location:/include/oops.php?reason=NOTinit");
    exit;
  }

  if ($db_pw == $_POST['userpw'])
  {
    //-- 登入成功
    $userIP = getUserIP();

    $sql = "UPDATE users SET login_times = login_times + 1, IP = '{$userIP}', ";
    $sql.= "last_login = now() ";
    $sql.= "WHERE userid = '{$db_userid}'";
    $db->query($sql);

    $expire_time = 60 * 60 * 24 * 3;
    if (isset($_POST['remem']) && ($_POST['remem'] == "on"))
    {
      setcookie("remember_id", "on", time()+$expire_time, "/");
      setcookie("userid", $db_userid, time()+$expire_time, "/");
    }
    else
    {
      setcookie("remember_id", "", 0, "/");
    }
    $_SESSION['userid'] = $db_userid;
    $_SESSION['nick'] = $db_nick;

    $url = (isset($_POST['go_url'])) ? $_POST['go_url'] : "/index.php";
    header("location:{$url}");
    exit;
  }
?>
