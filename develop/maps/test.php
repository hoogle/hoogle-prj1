<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>Google Maps JavaScript API Example</title>
<style type="text/css">
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
</style>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSm_RB7Ggyimh49Ou8AB6bIEyBpGxR8tL4tZRT4WG6q1H-qkZUKQKQ9qg"></script>
<script type="text/javascript">
  var map = null;
  var geocoder = null;
  var marker;

  function initialize() {
    var map = new google.maps.Map2(document.getElementById('map'));
    map.setCenter(new google.maps.LatLng(25.0266, 121.5223), 17);
    map.addControl(new GLargeMapControl());
    map.addControl(new GOverviewMapControl());
    map.addControl(new GMapTypeControl());
    map.addMapType(G_PHYSICAL_MAP);

    var flagHtml = '<div class="showWindow">';
    flagHtml+= '<div class="windowCaption">TRC! 精采寫真</div>';
    flagHtml+= '<div class="windowContent"><img src="/images/home_goodphotos_02.jpg" alt="" align="left" class="windowPic" /><div class="windowTitle">夢幻蒸機</div>2008.05.23 3923次 菁桐平溪間</div>';
    flagHtml+= '</div>';
    //map.openInfoWindow(map.getCenter(), document.createTextNode("Yahoo!奇摩"));
    map.openInfoWindowHtml(map.getCenter(), flagHtml);
  }
  google.load("maps", "2.x", {"callback" : initialize, "locale" : "zh_TW"});
</script>

</head>
<body onunload="GUnload()">
  <div id="map" style="width: 500px; height: 300px"></div>
</body>
</html>
