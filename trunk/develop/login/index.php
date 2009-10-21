<?
  session_start();
  $go_url = (isset($_GET['go_url'])) ? $_GET['go_url'] : "/index.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>我的旅行地圖 - 登入</title>
<link rel="stylesheet" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/photos/css/layout.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>

<body>
<div class="yui-t7" style="width:100%;">
  <div id="hd">
<? require WEBROOT_PATH."include/header.php"; ?>
  </div>

  <div id="bd">
    <div id="signup" class="yui-g">
      <div class="hd clearfix">
        <div id="signword">
          登入
        </div>
        <div id="openid">
          <div style="font:15pt Verdana, Simhei;padding-right:10px;">使用<a href="https://travelmap.rpxnow.com/openid/v2/signin?token_url=http://122.116.58.213/signup/signup.php" onclick="return false;" class="rpxnow" style="color:#ff6200"><img src="/photos/img/icon_openid_s.gif" style="vertical-align:middle" />OpenID</a>?</div>
          <div style="text-align:right;padding-right:10px;"><a href="http://openid.net/" style="font:9pt Verdana;">什麼是 OpenID?</a></div>
        </div>
      </div>
      <div class="hd clearfix">
        <form name="login_form" method="post" action="/login/login_check.php">
        <ul class="ul-login-form" style="font-size:14pt;padding:20px 15px 0 0;">
          <li>
            <strong>帳號</strong>
            <input class="form-input" type="text" name="userid" />
          </li>
          <li>
            <strong>密碼</strong>
            <input class="form-input" type="password" name="userpw" />
          </li>
          <li style="padding-right:10px;">
            <label for="remem">
            <input type="checkbox" id="remem" name="remem"<? if (isset($_COOKIE['remember_id']) && $_COOKIE['remember_id'] == "on") echo " checked"; ?> />
              <strong>記住帳號</strong>
            </label>
            |&nbsp;&nbsp;<a href="#">忘記密碼</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;<a href="/signup/">註冊</a>
          </li>
          <li>
            <input type="hidden" name="go_url" value="<?=$go_url?>" />
            <input type="image" src="/photos/img/btn_signup.gif" style="vertical-align:middle;" onclick="return true" />
          </li>
        </ul>
        </form>
      </div>
      <div class="ft adsense_banner"></div>
    </div>
    <div class="adsense_banner">
<script type="text/javascript"><!--
google_ad_client = "pub-8202875917107311";
/* 728x90, 已建立 2009/5/13 */
google_ad_slot = "9738620896";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
    </div>
  </div>

  <div id="ft">
<? require WEBROOT_PATH."include/footer.php"; ?>
  </div>
</div>
</body>
</html>
<script src="https://rpxnow.com/openid/v2/widget" type="text/javascript"></script>
<script type="text/javascript">
  RPXNOW.token_url = "http://122.116.58.213/login/login_check.php";
  RPXNOW.realm = "travelmap";
  RPXNOW.overlay = true;
  RPXNOW.language_preference = 'zh-TW';
</script>
