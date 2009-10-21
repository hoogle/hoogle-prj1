<?php
if (isset($_POST['token']))
{
  $authURL = "https://rpxnow.com/api/v2/auth_info";
  $postData = array(
    "apiKey" => "707ed1543413a84ed8425ab6f44e3e5f765d34cc",
    "token" => $_POST['token']);
  $ch = curl_init($authURL);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = json_decode(curl_exec($ch), true);
  curl_close($ch);
}
$userid = (isset($result['profile']['identifier'])) ? $result['profile']['identifier'] : $_POST['userid'];
  session_start();
  require LIBRARY_PATH."function.php";
  $db = Mysql::getInstance('localhost');

  $sql = "SELECT userid, pw_opid, usernk, verify_time FROM users ";
  $sql.= "WHERE userid = '{$userid}'";
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
  else
  {
    echo "id/pw error!";
  }
?>
