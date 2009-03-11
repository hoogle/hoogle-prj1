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
</style> 
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSfuyCR8UQqND6_MVZSTCrXFOoSJhRFXxV9YDnWBxuCXkBsNPiWSF6FeQ"></script> 
</head> 
<body onunload="GUnload()"> 
<div id="container">
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
      $j = jQuery.noConflict();
      var flagHtml = '<div class="showWindow">';
      flagHtml+= '<div class="windowCaption">TRC! 精采寫真</div>';
      flagHtml+= '<div class="windowContent"><img src="http://www.trc.club.tw/images/home_goodphotos_01.jpg" alt="" align="left" class="windowPic" /><div class="windowTitle">夢幻蒸機</div>2008.05.23 3923次 菁桐平溪間</div>';
      flagHtml+= '</div>';
      flagHtml = '';

      map = new GMap2(document.getElementById('map'));
      //map.setCenter(new GLatLng(25.0266, 121.5223), 17);
      map.setCenter(new GLatLng(35.62819, 139.73631), 17);
      map.addControl(new GLargeMapControl());
      map.addControl(new GOverviewMapControl());
      map.addControl(new GScaleControl());
      map.enableGoogleBar();
      map.enableScrollWheelZoom();
      map.enableContinuousZoom();
      map.addControl(new GMapTypeControl());
      createContextMenu(map);
      map.addMapType(G_PHYSICAL_MAP);
      //map.addOverlay(new GLayer("com.panoramio.all"));
      var mgr = new GMarkerManager(map);
   
      drawMarker = function(point) {
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

        var dragit = function() {
          var newPoint = new GLatLng(marker.getPoint().lat(), marker.getPoint().lng());
          document.getElementById('cordination').innerHTML = newPoint.toString();
          $j('#msg').fadeIn("fast");
          $j('#msg').html('您可移動至您想放的位置...');
        };

        GEvent.addListener(marker, "drag", dragit); 

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
          marker.openInfoWindowHtml('<iframe src="/maps/uploader.php" style="width:220px;border:none;"></iframe>');
        });
      } // End of drawMarker

      var showObj = function (o) {
        for(var x in o) {
          markerPoint = new GLatLng(o[x].lat, o[x].lng);
          drawMarker(markerPoint);
        }
      }

      $j.get("load_latlng.php", "", showObj, "json");
    }

  }

  function addMarker(map) {
    var latlngObj = map.fromContainerPixelToLatLng(new GPoint(clickedPixel.x, clickedPixel.y));
    var newPoint = new GLatLng(latlngObj.lat(), latlngObj.lng());
    if (confirm('是否要將此位置存檔？')) {
      $j.post("save_latlng.php", {title: 'maptest', lat: latlngObj.lat(), lng: latlngObj.lng()}, function(data) {
        alert(latlngObj.lat() + ' & ' + latlngObj.lng() + ' 已存檔!');
      });
      drawMarker(newPoint);
    }
    $j('#msg').html('定位於' + newPoint);
    setTimeout(function() {
      $j('#msg').fadeOut(function() {
        $j('#msg').fadeIn("slow");
        $j('#msg').html('請繼續下一個動作');
      });
    }, 1000);
    contextmenu.style.visibility = 'hidden';
  }

  function createContextMenu(map)
  {
    contextmenu = document.createElement('div');
    contextmenu.id = 'funcmenu';
    contextmenu.style.padding = '0px';
    contextmenu.style.visibility = 'hidden';
    contextmenu.style.background = '#ffffff';
    contextmenu.style.border = '1px solid #8888FF';

    contextmenu.innerHTML = '<div class="menuitem" onclick="zoomInHere()">放大</div>'
    + '<div class="menuitem" onclick="javascript:zoomOutHere()">縮小</div>'
    + '<div class="menuitem" onclick="javascript:addMarker(map)">在此新增據點</div>'
    + '<div class="menuitem" onclick="javascript:centreMapHere()">將此置於地圖中心</div>'

    map.getContainer().appendChild(contextmenu);
    GEvent.addListener(map, 'singlerightclick', function(pixel, tile) {
      clickedPixel = pixel;
      var x = pixel.x;
      var y = pixel.y;
      if (x > map.getSize().width - 120) { 
        x = map.getSize().width - 120 
      }
      if (y > map.getSize().height - 100) { 
        y = map.getSize().height - 100 
      }
      var pos = new GControlPosition(G_ANCHOR_TOP_LEFT, new GSize(x, y));  
      pos.apply(contextmenu);
      contextmenu.style.visibility = 'visible';
    });
    GEvent.addListener(map, "click", function() {
      contextmenu.style.visibility = 'hidden';
    });
  }

  function zoomInHere() {
    var point = map.fromContainerPixelToLatLng(clickedPixel)
      map.zoomIn(point, true);
    contextmenu.style.visibility = 'hidden';
  }      
  function zoomOutHere() {
    var point = map.fromContainerPixelToLatLng(clickedPixel)
      map.setCenter(point,map.getZoom()-1); 
    contextmenu.style.visibility = 'hidden';
  }      
  function centreMapHere() {
    var point = map.fromContainerPixelToLatLng(clickedPixel)
      map.setCenter(point);
    contextmenu.style.visibility = 'hidden';
  }

  /*
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
   */
   
  google.load("maps", "2.x", {"callback" : initialize, "locale" : "zh_TW"});
  google.load("jquery", "1.2.6");
</script> 
</body> 
</html>
