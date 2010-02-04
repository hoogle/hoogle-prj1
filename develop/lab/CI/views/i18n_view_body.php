<body>
使用語言: <b><?=$now_lang?></b><br/>
其他語言: 
<ul class="i18n_other_lang">
  <li><a href="/i18n/index/en">English</a> <a href="/i18n/gen/en">[重組]</a></li>
  <li><a href="/i18n/index/tw">正體中文</a> <a href="/i18n/gen/tw">[重組]</a></li>
  <li><a href="/i18n/index/cn">簡体中文</a> <a href="/i18n/gen/cn">[重組]</a></li>
  <li><a href="/i18n/index/jp">日本語</a> <a href="/i18n/gen/jp">[重組]</a></li>
</ul> 
<? include ($show_data) ? "i18n_view_body_list.php" : "i18n_view_body_index.php"; ?>
</body>
</html>
