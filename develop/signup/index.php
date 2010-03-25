<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>我的旅行地圖 - 註冊</title>
<link rel="stylesheet" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
<link rel="stylesheet" type="text/css" href="/static/css/layout.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
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
        <div class="signup-title float_right">
          <div style="font:15pt Verdana, Simhei;padding-right:10px;">使用<a href="https://travelmap.rpxnow.com/openid/v2/signin?token_url=http://122.116.58.213/signup/signup.php" onclick="return false;" class="rpxnow" style="color:#ff6200"><img src="/static/img/icon_openid_s.gif" style="vertical-align:middle" />OpenID</a>?</div>
          <div style="text-align:right;padding-right:10px;"><a href="http://openid.net/" style="font:9pt Verdana;">什麼是 OpenID?</a></div>
        </div>
        <form name="sign_form" class="signup-form" method="post" action="/signup/signup.php">
        <ul class="ul-login-form" style="font-size:14pt;padding:20px 15px 0 0;">
          <li>
            <strong>帳號</strong>
            <input class="form-input" type="text" name="userid" />
            <span class="checking"><img src="/static/img/icon_spinner.gif" /></span>
          </li>
          <li>
            <strong>密碼</strong>
            <input class="form-input" type="password" name="userpw" />
            <span class="checking"><img src="/static/img/icon_spinner.gif" /></span>
          </li>
          <li>
            <strong>密碼確認</strong>
            <input class="form-input" type="password" name="userpw2" />
            <span class="checking"><img src="/static/img/icon_spinner.gif" /></span>
          </li>
          <li style="padding-right:100px;">
            <input type="image" src="/static/img/btn_signup.gif" style="vertical-align:middle;" onclick="return true" />
          </li>
        </ul>
        </form>
      </div>
<? //require_once "common.php"; ?>
    </div>
  </div>

  <div id="ft">
<? require WEBROOT_PATH."include/footer.php"; ?>
  </div>
</div>
<script src="https://rpxnow.com/openid/v2/widget" type="text/javascript"></script>
<script type="text/javascript">
  RPXNOW.token_url = "http://122.116.58.213/signup/signup.php";
  RPXNOW.realm = "travelmap";
  RPXNOW.overlay = true;
  RPXNOW.language_preference = 'zh-CHT';
</script>

</body>
</html>
