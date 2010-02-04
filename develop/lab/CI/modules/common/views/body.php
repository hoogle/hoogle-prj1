<body class="yui-skin-sam">
<div id="doc3" class="yui-t5">
  <div id="hd" role="banner"><h1>Localization tool</h1></div>
  <div id="bd" role="main">
    <div id="yui-main">
      <div class="yui-b">
          <div class="yui-g">
            <?php echo modules::run("lang/lang/index", $lang); ?>
          </div>
      </div>
    </div>

    <div class="yui-b">
      <?php $this->load->view("login/login"); ?>
    </div>
  </div>
  <div id="ft" role="contentinfo"><p>Footer</p></div>
</div>
</body>
</html>
