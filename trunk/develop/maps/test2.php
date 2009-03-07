<?
  session_start();
  if (!isset($_SESSION['userid']))
  {
    header("location:/login/?go_url=".$_SERVER['REQUEST_URI']);
    exit;
  }
?>
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
</style> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/fonts/fonts-min.css" /> 
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/button/assets/skins/sam/button.css" /> 
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&amp;2.6.0/build/element/element-beta-min.js&amp;2.6.0/build/button/button-min.js&amp;2.6.0/build/uploader/uploader-experimental.js"></script> 
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSfuyCR8UQqND6_MVZSTCrXFOoSJhRFXxV9YDnWBxuCXkBsNPiWSF6FeQ"></script> 
<script type="text/javascript" src="/photos/js/upload_single.js"></script>
</head> 
<body onunload="GUnload()"> 
<div id="container">
  <div id="outline">
    點選工具：<a class="marker" href="javascript:follow()"><img src="http://maps.google.com/mapfiles/marker.png" alt="" title="click me" class="pushpin"/></a> 
  </div>
  <div id="msgArea">
    <span id="msg">這裡放座標</span>
    <span id="cordination"></span>
  </div>
  <div id="map" style="border:1px solid gray;width: 900px; height: 600px"></div>
</div>

<script type="text/javascript"> 
  var map;
  function initialize() {
    if (GBrowserIsCompatible()) {
      var flagHtml = '<div class="showWindow">';
      flagHtml+= '<div class="windowCaption">TRC! 精采寫真</div>';
      flagHtml+= '<div class="windowContent"><img src="http://www.trc.club.tw/images/home_goodphotos_01.jpg" alt="" align="left" class="windowPic" /><div class="windowTitle">夢幻蒸機</div>2008.05.23 3923次 菁桐平溪間</div>';
      flagHtml+= '</div>';
      flagHtml = '';

      map = new GMap2(document.getElementById('map'));
      map.setCenter(new GLatLng(25.0266, 121.5223), 17);
      map.addControl(new GLargeMapControl());
      map.addControl(new GOverviewMapControl());
      map.addControl(new GScaleControl());
      map.enableGoogleBar();
      map.enableScrollWheelZoom();
      map.enableContinuousZoom();
      map.addControl(new GMapTypeControl());
      map.addMapType(G_PHYSICAL_MAP);
      //map.addOverlay(new GLayer("com.panoramio.all"));
      var mgr = new GMarkerManager(map);
   
  var $j = jQuery.noConflict();
      var drawMarker = function(point) {
        // 自訂圖標
        var MyIcon = new GIcon(G_DEFAULT_ICON);
        //MyIcon.image = "http://www.trc.club.tw/images/firework.png";
        // 自訂圖標大小
        MyIcon.iconSize = new GSize(32, 32); 
        markerOptions = { icon:MyIcon };

        //var marker = new GMarker(point, {icon:MyIcon,draggable:true,bouncy:false});//可在這之前定義markerOptions自訂你的marker
        var minMarker = [];
        var marker = new GMarker(point, {draggable:true});
        minMarker.push(marker);
        mgr.addMarkers(minMarker, 16);
        mgr.refresh();

        GEvent.addListener(marker, "drag", function() {
          var newPoint = new GLatLng(marker.getPoint().lat(), marker.getPoint().lng());
          document.getElementById('cordination').innerHTML = newPoint.toString();
          $j('#msg').fadeIn("fast");
          $j('#msg').html('您可移動至您想放的位置...');
        });

        GEvent.addListener(marker, "dragend", function() {
          var newPoint = new GLatLng(marker.getPoint().lat(), marker.getPoint().lng());
          if (confirm('是否要將此位置存檔？')) {
            $j.post("save_latlng.php", {title: 'maptest', lat: marker.getPoint().lat(), lng: marker.getPoint().lng()}, function(data) {
              alert(marker.getPoint().lat() + ' & ' + marker.getPoint().lng() + ' 已存檔!');
            });
          }
          $j('#msg').html('定位於' + newPoint);
          setTimeout(function() {
            $j('#msg').fadeOut(function() {
              $j('#msg').fadeIn("slow");
              $j('#msg').html('請繼續下一個動作');
            });
          }, 1000);
        });

        GEvent.addListener(marker, "click", function() {
          $j('#msg').fadeIn("fast");
          setTimeout(function() {
            $j('#msg').fadeOut("slow");
          }, 1000);
          $j('#msg').html('請選擇上傳檔案！');
          var maxContentDiv = document.createElement('div');
          maxContentDiv.innerHTML = '載入中...';
          marker.openInfoWindowHtml("<div style='padding:5px'>Click maximize button for more info about the Google Bar!</div>", {maxContent: maxContentDiv, maxTitle: "More info"});
          var iw = map.getInfoWindow();
          GEvent.addListener(iw, "maximizeclick", function() {
            GDownloadUrl("/maps/uploader.php", function(data) {
              maxContentDiv.innerHTML = data;
            });
          });
        });
      } // End of drawMarker

      var showObj = function (o) {
        for(var x in o) {
          markerPoint = new GLatLng(o[x].lat, o[x].lng);
          drawMarker(markerPoint);
        }
      }

      $j.get("load_latlng.php", "", showObj, "json");

      /*
      GEvent.addListener(map, "click", function(overlay, latlng) {
        if (confirm('要在這裡加據點嗎？')) {
          if (latlng) {
            var markerPoint = new GLatLng(latlng.y, latlng.x);
            alert('markerPoint = ' + markerPoint);
            drawMarker(markerPoint);
          }
        }
      });
       */
    }
  }

  function follow() {
    var marker;
    var dog = true;
    var noMore = false;
   
    var mouseMove = GEvent.addListener(map, 'mousemove', function(cursorPoint){
      if(!noMore){
        marker = new GMarker(cursorPoint,{draggable:true, autoPan:false});
        map.addOverlay(marker);
        marker.setImage("http://maps.google.com/mapfiles/marker.png");
        noMore = true;
      // This function deletes the marker when dragged outside map
      GEvent.addListener(marker, 'drag', function(markerPoint){
        if(!map.getBounds().containsLatLng(markerPoint)){
            map.removeOverlay(marker);
          }
        }); 
      }
      if(dog){
        marker.setLatLng(cursorPoint);
      }
    });
    var mapClick = GEvent.addListener(map, 'click', function(){
      dog = false;
      // 'mousemove' event listener is deleted to save resources
      GEvent.removeListener(mouseMove);
      GEvent.removeListener(mapClick);
    });
  }
   
  google.load("maps", "2.x", {"callback" : initialize, "locale" : "zh_TW"});
  google.load("jquery", "1.2.6");
</script> 
</body> 
</html>
