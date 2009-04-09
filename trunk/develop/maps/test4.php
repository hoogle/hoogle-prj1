<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8"/> 
<title>Google Maps JavaScript API Example</title> 
<style type="text/css"> 
#container {
  /*position:relative;*/
}
#msgArea {
  margin:10px 0;
  padding:5px;
  width:500px;
  height:20px;
  border:1px solid gray;
  background-color:#FFFFEE;
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
</style> 
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSm_RB7Ggyimh49Ou8AB6bIEyBpGxR8tL4tZRT4WG6q1H-qkZUKQKQ9qg"></script>
</head> 
<body onunload="GUnload()"> 
<div id="container">
  <div id="msgArea"><span id="msg">這裡放座標</span></div>
  <div id="map" style="border:1px solid gray;width: 1000px; height: 700px"></div>
  <div id="cordination" style="width:400px;margin:15px;padding:5px;"></div>
</div>

  <script type="text/javascript"> 
var mgr;

function initialize() {
  if (GBrowserIsCompatible()) {
    var map = new GMap2(document.getElementById("map"));
    map.addControl(new GMapTypeControl());
    map.addControl(new GLargeMapControl());
    map.setCenter(new GLatLng(35.17372061955388, 136.89807057380676), 13);

    mgr = new GMarkerManager(map);
    createMarkerToMap();
  }
}

function createMarkerToMap(){
  var minMarker = [];
  minMarker.push(new GMarker(new GLatLng(35.17299710376745, 136.89990520477295)));
  minMarker.push(new GMarker(new GLatLng(35.17325581621244, 136.89760386943817)));
  minMarker.push(new GMarker(new GLatLng(35.17411526181449, 136.89668118953705)));
  minMarker.push(new GMarker(new GLatLng(35.17588674347327, 136.89648807048798)));

  var maxMarker = [];
  maxMarker.push(new GMarker(new GLatLng(35.173404904366166, 136.89986765384674)));
  maxMarker.push(new GMarker(new GLatLng(35.17415472593521, 136.89709961414337)));
  maxMarker.push(new GMarker(new GLatLng(35.176465536044745, 136.89685821533203)));

  mgr.addMarker(new GMarker(new GLatLng(35.172861169780006, 136.89783453941345)), 10);
  mgr.addMarkers(minMarker, 15);
  mgr.addMarkers(maxMarker, 17);

  mgr.refresh();
}
    google.load("maps", "2.x", {"callback" : initialize, "locale" : "zh_TW"});
  </script> 
</body> 
</html>
