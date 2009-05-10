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
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssreset/reset-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssfonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssgrids/grids.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/tabview/assets/skins/sam/tabview.css" />
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
#nearby {
  text-align:left;
  position:relative;
  width:auto;
  *width:273px;
  padding:5px;
  font-size:12px;
  height:436px;
  overflow:auto;
}
#nearby .nearby-list {
  margin:0 3px 3px 0;
  background-color:#eee;
  border:1px solid #ddd;
}
#nearby img {
  border:1px solid #CCCCCC;
  padding:2px;
}
#nearby .n_title {
  margin-bottom:5px;
  font-size:12pt;
}
#nearby .n_desc {
  font-size:13px;
}
#tab-navi .yui-content {
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
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/yahoo-dom-event/yahoo-dom-event.js&2.7.0/build/element/element-min.js&2.7.0/build/tabview/tabview-min.js"></script>
<script type="text/javascript">
  jsvar = {
    userid: '<?=$userid?>'
  };
</script> 
</head> 
<body class="yui-skin-sam" onLoad="initialize()" onunload="GUnload()"> 
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
        <div id="map" style="border:1px solid gray; width:100%; height:750px"></div>
        <div id="comment">This powered by hoogle.</div>
      </div>
    </div>
    <div id="navi">
      <div class="hd">
      </div>
      <div class="bd">
        <div id="tab-navi" class="yui-navset">
            <ul class="yui-nav">
                <li class="selected"><a href="#nearby"><em>景點</em></a></li>
                <li><a href="#tab2"><em>美食</em></a></li>
                <li><a href="#tab3"><em>新奇</em></a></li>
            </ul>
            <div class="yui-content">
                <div id="nearby" class="clearfix"><p>景點搜尋中...</p></div>
                <div id="tab2"><p>美食搜尋中...</p></div>
                <div id="tab3"><p>新奇搜尋中...</p></div>
            </div>
        </div>
        <script>
        (function() { var tabView = new YAHOO.widget.TabView('tab-navi'); })();
        </script>
        <div style="margin:3px 0;padding:2px;text-align:center;">
          <a href="">前頁</a> &nbsp; | &nbsp; <a href="">後頁</a>
        </div>
      </div>
      <div class="ft">
  <script type="text/javascript">
  <!--
  google_ad_client = "pub-8202875917107311";
  /* 300x250, 已建立 2009/5/10 */
  google_ad_slot = "3066029557";
  google_ad_width = 300;
  google_ad_height = 250;
  //-->
  </script>
  <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
      </div>
    </div>
  </div>

  <div id="ft">
<? require WEBROOT_PATH."include/footer.php"; ?>
  </div>
</div>
<script type="text/javascript" src="/photos/js/mymap.js"></script>
</body> 
</html>
