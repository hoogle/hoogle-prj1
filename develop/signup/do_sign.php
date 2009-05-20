<?
session_start();
require_once('recaptchalib.php');
$privatekey = "6Lf_cwQAAAAAABqzTaoIRotTig-iFvtGnC7Hd_P0";
$resp = recaptcha_check_answer ($privatekey,
  $_SERVER["REMOTE_ADDR"],
  $_POST["recaptcha_challenge_field"],
  $_POST["recaptcha_response_field"]);

/*if (!$resp->is_valid) {
  //die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .  "(reCAPTCHA said: " . $resp->error . ")");
  echo "CAPTCHA ERROR!!!";
  exit;
} else {
 */
  //echo "CAPTCHA OK!!";
  $userid = $_POST['userid'];
  $userpw = $_POST['userpw'];
  $usernk = $_POST['usernk'];
  $email = $_POST['email'];
  $birthday = sprintf("%s-%s-%s", $_POST['birth_y'], $_POST['birth_m'], $_POST['birth_d']);
  require LIBRARY_PATH."function.inc";
  $userIP = getUserIP();
  require LIBRARY_PATH."mysql_cfg.inc";
  $sql = "INSERT INTO users (userid, pw_opid, usernk, email, birthday, IP, reg_time) ";
  $sql.= "VALUES ('{$userid}', '{$userpw}', '{$usernk}', '{$email}', '{$birthday}', '{$userIP}', now())";
  $db->query($sql);

  $session_id = session_id();
  $sql = "INSERT INTO init_acc (userid, sid) ";
  $sql.= "VALUES ('{$userid}', '{$session_id}')";
  $db->query($sql);

  $authstr = base64_encode("{$userid}#{$session_id}");
//}
  $header = "From:  TravelMap<service@travelmap.com>\r\n";
  $mail_content = '
mailto '.$email.' :

請點選 http://122.116.58.213/include/initial_acc.php?auth='.$authstr.' for initialize your account.

- TravelMap -';
mail($email, "認證信 (authorization)", $mail_content, $header); 
?>

  已寄出認證信至 <?=$email?>

