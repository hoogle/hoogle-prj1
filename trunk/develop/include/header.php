<div class="hd clearfix">
  <div id="logo"><a href="/">TravelMap</a></div>
  <div id="login">
<? if (isset($_SESSION['userid'])) : ?>
    <span class="info">您好，虎哥 歡迎您！</span>
    <span class="link">
      &nbsp;|&nbsp;&nbsp;<a href="/login/logout.php">登出</a>
      &nbsp;|&nbsp;&nbsp;<a href="/upload/yuiuploader.php">上傳</a>
      &nbsp;|&nbsp;&nbsp;<a href="/maps/">MAP</a>
    </span>
<? else : ?>
    <span class="info">您好，訪客 歡迎您！</span>
    <span class="link">
      &nbsp;|&nbsp;&nbsp;<a href="/login/">登入</a>
      &nbsp;|&nbsp;&nbsp;<a href="/signup/">註冊</a>
    </span>
<? endif ?>
  </div>
</div>
<div class="bd"></div>
<div class="ft"></div>
