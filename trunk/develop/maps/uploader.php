<?
  session_start();
  $userid = $_SESSION['userid'];
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
#resultArea {
  position:absolute;
  z-index:10;
  width:200px;
  height:auto;
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
  z-index:0;
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
<script type="text/javascript">
  var jsvar = {userid: '<?=$userid?>'};
</script>
</head> 
 
<body class="yui-skin-sam"> 
<div id="postArea">
  <div>
    上傳照片:
    <select id="mybook" name="book">
      <option value="0">請選擇相簿</option>
      <option value="1">未命名相簿</option>
    </select>
  </div>
  <div id="resultArea"></div>
  <div id="uploadArea">
    <form name="F_upload" method="post">
    <div id="fileProgress">
      <div id="fileName"></div>
      <div id="progressBar"></div>
    </div>
    <div id="uploaderOverlay"></div>
    <div id="uploadButton">
      <input type="hidden" id="book" name="book" value="" />
      <input type="button" id="btn_upload" name="btn_upload" value="上傳" />
    </div>
    </form>
  </div>
</div>

<script type="text/javascript" src="/photos/js/upload_single.js"></script>
</body> 
</html> 
