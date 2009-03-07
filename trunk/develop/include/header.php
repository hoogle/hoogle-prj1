<div class="float_left"><a href="/" style="font:Bold italic 50pt Verdana;">TravelMap</a></div>
  <div class="float_right">
<? if (isset($_SESSION['userid'])) : ?>
      <span>您好，<?=$_SESSION['nick']?> 歡迎您！</span>&nbsp;&nbsp;|&nbsp;
      <span><a href="/login/logout.php">登出</a></span>
<? else : ?>
      <span>您好，訪客 歡迎您！</span>&nbsp;&nbsp;|&nbsp;
      <span><a href="/signup/">註冊</a></span>&nbsp;&nbsp;|&nbsp;
      <span><a href="/login/">登入</a></span>
<? endif ?>
      <br />
      <a href="/upload/yuiuploader.php">上傳</a>&nbsp;&nbsp;|&nbsp;
      <a href="/maps/test2.php">MAP</a>&nbsp;&nbsp;|&nbsp;
    </div>
