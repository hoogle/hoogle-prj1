<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8"/> 
<title>Localization</title> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css"/>
<link rel="stylesheet" type="text/css" href="/static/style.css"/> 
</head>

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
