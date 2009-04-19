<?
  session_start();
  $userid = $_SESSION['userid'];
  $pid = intval($_GET['pid']);
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
#postArea {
  margin:0 auto;
  padding:0 auto;
}
#uploadArea {
  width:200px;
}
#uploadArea:after {
  clear:both;
  content:".";
  display:block;
  height:0;
  visibility:hidden;
}
#responseInfo {
  position:absolute;
  z-index:10;
  width:200px;
  height:auto;
}
#title-area, #desc-area{
  padding:3px 0;
  clear:both;
}
#desc-area {
  height:37px;
}
#desc {
  height:35px;
}
#title-area label, #desc-area label {
  float:left;
}
#title-area span, #desc-area span {
  float:right;
}
.input_frame {
  border:1px solid gray;
  font:9pt Arial;
  width:160px;
}
#fileProgress {
  border: 1px solid gray;
  width:200px;
  height:23px;
}
#progressBar {
  width:200px;
  height:4px;
  font-size:0;
  margin:0;
  padding:0;
  background-color:#CCCCCC;
}
#fileName {
  text-align:center;
  padding:2px 0;
  width:200px;
  height:15px;
  font:12px verdana;
  overflow:hidden;
}
#uploaderOverlay {
  float:left;
  margin-top:5px;
  width:70px;
  height:26px;
  cursor:pointer;
  z-index:0;
}
#uploadButton {
  float:right;
  margin-top:5px;
}
</style> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/button/assets/skins/sam/button.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&amp;2.6.0/build/element/element-beta-min.js&amp;2.6.0/build/button/button-min.js&amp;2.6.0/build/uploader/uploader-experimental.js"></script>
<script type="text/javascript">
  var jsvar = {userid: '<?=$userid?>'};
</script>
</head> 
 
<body class="yui-skin-sam"> 
<div id="postArea">
  <div id="responseInfo"></div>
  <div id="uploadArea">
    <form name="F_upload" method="post">
    <div id="title-area">
      <label>標題</label><span><input type="text" id="title" name="title" class="input_frame" /></span>
    </div>
    <div id="desc-area">
      <label>簡述</label><span><textarea id="desc" name="desc" class="input_frame"></textarea></span>
    </div>
    <div id="fileProgress">
      <div id="fileName"></div>
      <div id="progressBar"></div>
    </div>
    <div id="uploaderOverlay"></div>
    <div id="uploadButton">
      <input type="hidden" id="pid" name="pid" value="<?=$pid?>" />
      <input type="button" id="btn_upload" name="btn_upload" value="上傳" />
    </div>
    </form>
  </div>
</div>

<script type="text/javascript" src="/photos/js/upload_single.js"></script>
</body> 
</html> 
