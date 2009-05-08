<?
  session_start();
  if (!isset($_SESSION['userid']))
  {
    header("location:/login/?go_url=".$_SERVER['REQUEST_URI']);
    exit;
  }
  $userid = $_SESSION['userid'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>TravelMap</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssreset/reset-min.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssfonts/fonts-min.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssgrids/grids.css"> 
<link rel="stylesheet" type="text/css" href="/photos/css/layout.css" />
<style type="text/css">
#msgArea {
  margin:10px 0;
  padding:5px;
  width:900px;
  height:20px;
  border:1px solid gray;
  background-color:#FFFFEE;
}
#msg {
  float:left;
}
#cordination {
  float:right;
}
#preview {
  text-align:left;
  border:1px solid green;
  position:relative;
  width:auto;
  *width:280px;
  padding:10px;
  font-size:12px;
}
#preview div {
  float:left;
  margin:0 3px 3px 0;
}
#preview img {
  border:1px solid #CCCCCC;
  margin:2px auto;
  padding:3px;
}
.showWindow {
  width:300px;
  height:135px;
  padding:15px;
  overflow:hidden;
}
.windowCaption {
  font-weight:bold;
  margin-bottom:3px;
}
.windowTitle {
  color:Darkgreen;
  font-weight:bold;
}
.windowPic {
  margin:5px;
  border:1px solid gray;
}
.windowContent {
  border:1px solid #99CCFF;
  background-color:#DDEEFF;
  color:#6699CC;
  padding:5px;
  width:98%;
  overflow:hidden;
}
.pushpin {
  border:none;
}
.menuitem {
  text-align:left;
  padding:3px;
  margin:0;
  display:block;
  color:#0000ff;
  cursor:pointer;
  font-size:9pt;
}
.menuitem:hover {
  background-color:#DDEEFF;
}
img {
  border:1px solid white;
}
</style> 
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSm_RB7Ggyimh49Ou8AB6bIEyBpGxR8tL4tZRT4WG6q1H-qkZUKQKQ9qg" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="/photos/js/glayer.js"></script>
<script type="text/javascript">
  jsvar = {
    userid: '<?=$userid?>'
  };
</script> 
</head> 
<body class="home yui-skin-sam" onLoad="initialize()" onunload="GUnload()"> 
<div id="doc3" class="yui-t3" style="width:auto">
  <div id="hd">
<? require WEBROOT_PATH."include/header.php"; ?>
  </div>

  <div id="bd">
    <div id="yui-main">
      <!--div id="msgArea">
        <span id="msg">這裡放座標</span>
        <span id="cordination"></span>
      </div-->
      <div class="yui-b">
        <div id="map" style="border:1px solid gray; width:100%; height:700px"></div>
        <div id="comment">This powered by hoogle.</div>
      </div>
    </div>
    <div id="navi">
      <div id="preview" class="clearfix">搜尋中...</div>
    </div>
  </div>

  <div id="ft">
<? require WEBROOT_PATH."include/footer.php"; ?>
  </div>
</div>
<script type="text/javascript" src="/photos/js/mymap.js"></script>
</body> 
</html>
