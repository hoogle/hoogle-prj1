<?
  session_start();
  if (!isset($_SESSION['userid']))
  {
    header("location:/login/?go_url=".$_SERVER['REQUEST_URI']);
    exit;
  }

  $userid = $_SESSION['userid'];
  $photoid = intval($_GET['pid']);

  require LIBRARY_PATH."function.php";
  $picAry = getPicInfo($photoid);
  $abs_filename = getUserPath($userid).USER_MAX_SETID."/{$photoid}.jpg"; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Hoogle</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssreset/reset-min.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssfonts/fonts-min.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.0.0pr2/build/cssgrids/grids.css">
<link rel="stylesheet" type="text/css" href="/static/css/layout.css" />
<style type="text/css"> 
/* 為了地圖 370px 而做的調整 */
.yui-gc div.first {
    width:62%;
}
.yui-gc .yui-u { 
    width:36%;
}
.nearby-info {
  margin:10px 5px 2px 5px;
  text-align:left;
  font-size:12pt;
}
#nearby {
  margin:5px;
  padding:0 20px;
  border:1px solid gray;
  background-color:#ffffee;
  text-align:center;
}
#nearby div {
  float:left;
  margin:5px;
}
#nearby img {
  /*background:white none repeat scroll 0 0;*/
  border:1px solid #CCCCCC;
  margin:2px auto;
  padding:3px;
}
#show {
  text-align:center;
}
#show img {
  border:1px solid gray;
}
#title {
  font:bold 20pt simhei;
  color:#6699cc;
  height:35px;
  width:600px;
  overflow:hidden;
}
#description {
  font:18px 標楷體;
  margin:3px 0;
}
#map {
  border:1px solid gray;
  height:360px;
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
#navi .hd {
  margin-bottom:7px;
  text-align:left;
}
#profile {
  text-align:left;
  margin-bottom:7px;
}
#profile img {
  padding:1px;
  border:1px solid gray;
  float:left;
  margin:0 7px 5px 0;
}
#author {
  font:bold 12pt Verdana;
}
#locinfo {
  margin:10px;
  padding:5px;
  border:1px solid gray;
  background-color:#eee;
}
.exif-info, .exif-item {
  text-align:left;
  font:12pt Arial;
  clear:both;
  padding:5px;
  height:20px;
}
.exif-item {
  font-weight:bold;
}
.exif-info label, .exif-item label {
  float:left;
  width:100px;
  display:block;
}
.exif-info span {
  float:left;
}
</style> 
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSm_RB7Ggyimh49Ou8AB6bIEyBpGxR8tL4tZRT4WG6q1H-qkZUKQKQ9qg" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/gmarker.js"></script>
<script type="text/javascript">
  var map;
  var jsvar = {
    userid: '<?=$userid?>'
  };

  function initialize() {
    if (GBrowserIsCompatible()) {
      $j = jQuery.noConflict();

      map = new GMap2(document.getElementById('map'));
      map.setCenter(new GLatLng('<?=$picAry[0]['lat']?>', '<?=$picAry[0]['lng']?>'), 17);
      map.addControl(new GSmallMapControl());
      map.enableContinuousZoom();
      map.addControl(new GMapTypeControl());
      map.addMapType(G_PHYSICAL_MAP);

      function getNearbyDOM(photo, i)
      {
        var id = photo.id;

        var a = document.createElement("A");
        a.href = "/album/photo.php?pid=" + id;

        var img = document.createElement("IMG");

        $j(img).attr({
          title: photo.curr_time,
            id: 'r' + id,
            src: '/static/upload/user/r/richardw/32767/thumb/t' + id + '.jpg',

            p_id: id }).hover(
              function() {
                $j(this).css("border", "1px solid #ff0000");
                $j(this).css("margin", "2px auto");
                $j(this).css("padding", "3px");
                markers.select(i);
              }, function() {
                $j(this).css("border", "1px solid gray");
                $j(this).css("margin", "2px auto");
                $j(this).css("padding", "3px");
                markers.select(markers.NONE);
              }
          );

          var div = document.createElement("DIV");
          div.appendChild(a);
          a.appendChild(img);
          return div;
      } // End of getNearbyDOM 

      var showObj = function (o) {
        $j("#nearby").html('');
        var points = [];
        var ids = [];

        for(var i=0; i<o.length; i++) {
          var photo = o[i];
          var markerPoint = new GLatLng(photo.lat, photo.lng);
          points.push(markerPoint);
          ids.push(photo.id);
          $j("#nearby").append(getNearbyDOM(o[i], i));
        }

        markers = new GCompoundMarker("", 32, 32, points, ids);
        map.addOverlay(markers);

        GEvent.addListener(markers, "mouseover", function(i) {
          markers.select(i);
          $j("#r" + o[i].id).css("backgroundColor", "orange");
        });

        GEvent.addListener(markers, "mouseout", function(i) {
          markers.select(markers.NONE);
          $j("#r" + o[i].id).css("backgroundColor", "white");
        });

        GEvent.addListener(markers, "click", function(i) {
          location.href='/album/photo.php?pid='+o[i].id;
        });

      } // End of showObj

      var getBounds = function() {
        var bounds = map.getBounds();
        var sw = bounds.getSouthWest();
        var ne = bounds.getNorthEast();
        var req_para = {
          "minx": sw.lng(),
            "miny": sw.lat(),
            "maxx": ne.lng(),
            "maxy": ne.lat()
        };
        $j.get("/maps/load_latlng.php", req_para, showObj, "json");
      } // End of getBounds

      getBounds();
    }

    GEvent.addListener(map, "moveend", function() {
      getBounds();
    });

  } // End of initial
</script> 
</head> 
<body onLoad="initialize()" onunload="GUnload()"> 

<div id="hd">
<? require WEBROOT_PATH."include/header.php"; ?>
</div>

<div id="bd">
  <div class="yui-d3 contain-main">
    <div class="yui-gc">
      <div id="show" class="yui-u first">
        <div class="hd"></div>
        <div class="bd">
          <div id="title"><?=$picAry[0]['title']?></div>
          <div class="cell">
            <img src="/static/upload/user/r/richardw/32767/<?=$photoid?>.jpg" />
          </div>
          <div id="description"><?=$picAry[0]['description']?></div>
          <div class="nearby-info">此區內的其他照片：</div>
          <div class="main-center clearfix" id="nearby"></div>
        </div>
        <div class="ft"></div>
      </div>
      <div id="navi" class="yui-u">
        <div class="hd">
          <form action="" method="post">
            <input type="text" name="qkey" style="width:236px;border:1px solid gray;" />
            <select name="type">
              <option value="0">標題</option>
              <option value="0">發表人</option>
            </select>
            <input type="submit" value="搜尋" />
          </form>
        </div>
        <div class="bd">
          <div id="profile" class="clearfix">
            <img src="<?=getUserIcon('richardw', 60)?>" />
            <div id="author">作者：<a href="#">richardw</a></div>
            <ul>
              <li>上傳時間：<?=$picAry[0]['curr_time']?></li>
            <ul>
          </div>
          <div id="map"></div>
          <div id="locinfo">
          <? include WEBROOT_PATH."include/mod_exif.php"; ?>
          </div>
        </div>
        <div class="ft"></div>
      </div>
    </div>

  </div>
</div>

<div id="ft"> 
<? require WEBROOT_PATH."include/footer.php"; ?>
</div> 

</body> 
</html>
