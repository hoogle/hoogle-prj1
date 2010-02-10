<?
  session_start();
  if (!isset($_SESSION['userid']))
  {
    header("location:/login/?go_url=".$_SERVER['REQUEST_URI']);
    exit;
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8"> 
<title>Simple Uploader Example With Button UI</title> 
<style type="text/css"> 
body {
  margin:0;
  padding:0;
}
#uploadArea {
  width:200px;
  margin:10px;
  padding:5px;
  border:1px dashed gray;
}
#uploadArea:after {
  clear:both;
  content:".";
  display:block;
  height:0;
  visibility:hidden;
}
#resultArea {
  position:absolute;
  z-index:10;
}
#progressBar {
  width:200px;
  height:4px;
  background-color:#CCCCCC;
}
#fileName {
  text-align:center;
  margin:5px;
  width:190px;
  height:16px;
  font:12px verdana;
  overflow:hidden;
}
#uploaderOverlay {
  float:left;
  margin-top:5px;
  width:70px;
  height:26px;
  cursor:pointer;
}
#uploadButton {
  float:right;
  margin-top:5px;
}
#fileProgress {
  border: black 1px solid;
  width:200px;
  height:30px;
}
</style> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/fonts/fonts-min.css" /> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/button/assets/skins/sam/button.css" /> 
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&amp;2.6.0/build/element/element-beta-min.js&amp;2.6.0/build/button/button-min.js&amp;2.6.0/build/uploader/uploader-experimental.js"></script> 
</head> 
 
<body class="yui-skin-sam"> 
<div id="uploadArea">
  <div id="resultArea"></div>
  <div id="fileProgress">
    <div id="fileName"></div>
    <div id="progressBar"></div>
  </div>
  <div id="uploaderOverlay"></div>
  <div id="uploadButton">
    <input type="button" id="btn_upload" name="btn_upload" value="上傳" />
  </div>
</div>

<script type="text/javascript" src="/static/js/upload_single.js"></script> 
</body> 
</html> 
