<?
if (isset($_GET['token']))
{
  $authURL = "https://rpxnow.com/api/v2/auth_info";
  $postData = array(
    "apiKey" => "707ed1543413a84ed8425ab6f44e3e5f765d34cc",
    "token" => $_GET['token']);
  $ch = curl_init($authURL);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = json_decode(curl_exec($ch), true);
  curl_close($ch);
//  echo "<pre>";
//  print_r($result);
//  echo "</pre>";

  if ("ok" != $result['stat'])
  {
    //header("location: https://travelmap.rpxnow.com/openid/v2/signin?token_url=http://122.116.58.213/signup/signup.php");
    //exit;
  }
}
$userid = (isset($_POST['userid'])) ? $_POST['userid'] : $result['profile']['identifier'];
$userpw = (isset($_POST['userpw'])) ? $_POST['userpw'] : "";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>我的旅行地圖 - 註冊2</title>
<link rel="stylesheet" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/photos/css/layout.css" />
</head>

<body>
<div class="yui-t7" style="width:100%;">
  <div id="hd">
<? require WEBROOT_PATH."include/header.php"; ?>
  </div>

  <div id="bd">
    <div class="yui-g">
      <div class="signup">
        <div class="signup-title float_left">
          註冊
        </div>
        <form name="sign_form" class="signup-form" method="post" action="/signup/do_sign.php">
        <ul style="font-size:14pt;padding:20px 15px 0 0;">
          <li>
            <strong>帳號</strong>
            <input class="form-input" type="text" name="userid" value="<?=$userid?>" />
            <span class="checking"><img src="/photos/img/icon_spinner.gif" /></span>
          </li>
          <li>
            <strong>email信箱</strong>
            <input class="form-input" type="text" name="email" value="<?=$result['profile']['email']?>" />
            <span class="checking"><img src="/photos/img/icon_spinner.gif" /></span>
          </li>
          <li>
            <strong>暱稱</strong>
            <input class="form-input" type="text" name="usernk" value="<?=$result['profile']['displayName']?>" />
            <span class="checking"><img src="/photos/img/icon_spinner.gif" /></span>
          </li>
          <li>
            <strong>生日</strong>
            <label>
            <select name="birth_y">
<? for ($y=1900; $y<date("Y"); $y++) : ?>
              <option value="<?=$y?>"<?=($y==1980)?' selected="selected"':''?>><?=$y?></option>
<? endfor ?>
            </select>
            年
            <select name="birth_m">
<? for ($m=1; $m<=12; $m++) : ?>
              <option value="<?=$m?>"><?=$m?></option>
<? endfor ?>
            </select>
            月
            <select name="birth_d">
<? for ($d=1; $d<=31; $d++) : ?>
              <option value="<?=$d?>"><?=$d?></option>
<? endfor ?>
            </select>
            日
            </label>
            <span class="checking"><img src="/photos/img/icon_spinner.gif" /></span>
          </li>
          <li>
            <strong>居住地</strong>
            <input class="form-input" type="text" name="livearea" />
            <span class="checking"><img src="/photos/img/icon_spinner.gif" /></span>
          </li>
          <li>
            <strong>地標設定</strong>
            <input class="form-input" type="text" name="lnglat" />
            <span class="checking"><img src="/photos/img/icon_spinner.gif" /></span>
          </li>
          <li id="captcha">
<?
require_once('recaptchalib.php');
$publickey = "6Lf_cwQAAAAAAApvLd9Il6gQeK9yZ8o4X4mUj-_h";
echo recaptcha_get_html($publickey);
?>
          </li>
          <li style="padding-right:120px;">
            <input type="hidden" name="userid" value="<?=$userid?>" />
            <input type="hidden" name="userpw" value="<?=$userpw?>" />
            <input type="image" src="/photos/img/btn_signup.gif" style="vertical-align:middle;" onclick="return true" />
          </li>
        </ul>
        </form>
      </div>
    </div>
  </div>

  <div id="ft">
<? require WEBROOT_PATH."include/footer.php"; ?>
  </div>
</div>

</body>
</html>
