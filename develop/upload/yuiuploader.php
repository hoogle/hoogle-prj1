<?
  session_start();
  if (!isset($_SESSION['userid']))
  {
    header("location:/login/?go_url=".$_SERVER['REQUEST_URI']);
    exit;
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>TravelMap</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/reset-fonts-grids/reset-fonts-grids.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/datatable/assets/skins/sam/datatable.css" /> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/button/assets/skins/sam/button.css" /> 
<link rel="stylesheet" type="text/css" href="/photos/css/layout.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&amp;2.6.0/build/element/element-beta-min.js&amp;2.6.0/build/button/button-min.js&amp;2.6.0/build/uploader/uploader-experimental.js&amp;2.6.0/build/datasource/datasource-min.js&amp;2.6.0/build/datatable/datatable-min.js"></script> 
<style type="text/css">
body {
  margin:0;
  padding:0;
}
#clearFilesLink {
  float:right;
}
#selectFilesLink {
  float:left;
}
#selectFilesLink a, #clearFilesLink a {
  color: #336699;
}
#selectFilesLink a:hover, #clearFilesLink a:hover { 
  color: #DF0077;
}
.yui-dt-col-size div {
  text-align:right;
}
#dataTableContainer {
  background-color:white;
  border:1px solid gray;
  margin:5px auto;
  padding:0 auto;
  width:650px;
  height:265px;
  overflow:hidden;
}
#uploadAction {
  width:650px;
  margin:5px auto;
  padding:0 auto;
}
#info {
  float:left;
  margin-left:10px;
  padding:1px 10px;
  background-color:red;
  color:white;
  visibility:hidden;
}
#uploaderContainer, #dataTableDiv {
  width:650px;
  margin:0 auto;
}
#uploadAction:after, #uploaderContainer:after {
  clear:both;
  content:".";
  display:block;
  height:0;
  visibility:hidden;
}
#fileNum {
  float:right;
}
</style> 
</head> 
 
<body class="yui-skin-sam"> 
<div class="yui-t7" style="width:100%;">
  <div id="hd">
<? require WEBROOT_PATH."include/header.php"; ?>
  </div>

  <div id="bd">
    <div class="yui-g" style="text-align:left;width:800px;margin:0 auto;background-color:#DDEEFF;">
      <div style="font:bold 16pt Arial;color:gray;padding:5px;">照片上傳</div>
      <div id="uiElements">
        <div id="uploaderContainer"> 
          <div id="uploaderOverlay" style="position:absolute; z-index:2"></div> 
          <div id="selectFilesLink"><a id="selectLink" href="javascript:void(0);">瀏覽檔案</a></div> 
          <div id="info"></div>
          <div id="clearFilesLink"><a href="javascript:clearUploadFiles();">清除檔案</a></div>
        </div> 
      </div> 

        <div id="dataTableContainer"></div> 
      <div id="uploadAction">
        <div style="float:left;width:80px;">
          <input type="button" id="btn_upload" name="btn_upload" value="upload" />
        </div>
        <div id="fileNum">共 0 個檔案</div>
      </div>
   
    </div>
  </div>
  <div id="ft">
<? require WEBROOT_PATH."include/footer.php"; ?>
  </div>
</div>
     

<script type="text/javascript" src="/photos/js/upload.js"></script> 
<script type="text/javascript">
  var $   = YAHOO.util.Dom.get;
  var BTN_upload = new YAHOO.widget.Button('btn_upload'); 
  BTN_upload.on('click', upload);
</script>
</body> 
</html> 
