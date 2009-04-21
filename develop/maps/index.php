<?
  session_start();
  if (!isset($_SESSION['userid']))
  {
    header("location:/login/?go_url=".$_SERVER['REQUEST_URI']);
    exit;
  }
  $userid = $_SESSION['userid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8"/> 
<title>Hoogle - main</title> 
<link rel="stylesheet" type="text/css" href="/photos/css/layout.css" />
<style type="text/css"> 
#container {
  /*position:relative;*/
}
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
  float:left;
  width:100px;
  border:1px solid gray;
  margin:0 10px;
  padding: 10px;
  font-size:12px;
}
#preview img {
  border:1px solid #CCCCCC;
  margin:2px auto;
  padding:3px;
}
#map {
  float:left;
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
<body onLoad="initialize()" onunload="GUnload()"> 
<div id="container">
  <div id="msgArea">
    <span id="msg">這裡放座標</span>
    <span id="cordination"></span>
  </div>
  <div id="preview" class="clearfix">搜尋中...</div>
  <div id="map" style="border:1px solid gray;width:900px;height:700px"></div>
</div>

<script type="text/javascript" src="/photos/js/mymap.js"></script>
</body> 
</html>
