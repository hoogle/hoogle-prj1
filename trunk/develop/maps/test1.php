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
#preview {
  float:left;
}
#preview img {
  /*background:white none repeat scroll 0 0;*/
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
<!--script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSfuyCR8UQqND6_MVZSTCrXFOoSJhRFXxV9YDnWBxuCXkBsNPiWSF6FeQ"></script--> 
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSfuyCR8UQqND6_MVZSTCrXFOoSJhRFXxV9YDnWBxuCXkBsNPiWSF6FeQ" type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="/photos/js/gmarker.js"></script>
<script type="text/javascript">
  var map;
  var jsvar = {
    userid: '<?=$userid?>'
  };
  function initialize() {
    if (GBrowserIsCompatible()) {
      $j = jQuery.noConflict();

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

      drawMarker = function(marker, point_id) {

        map.addOverlay(marker);
        /*
          var minMarker = [];
        minMarker.push(marker);
        mgr.addMarkers(minMarker, 16);
        mgr.refresh();
         */

        GEvent.addListener(marker, "drag", function() {
          var newPoint = new GLatLng(marker.getPoint().lat(), marker.getPoint().lng());
          document.getElementById('cordination').innerHTML = newPoint;
          $j('#msg').fadeIn("fast");
          $j('#msg').html('您可移動至您想放的位置...');
          console.dir(marker);
        }); 

        GEvent.addListener(marker, "dragend", function() {
          var newPoint = new GLatLng(marker.getPoint().lat(), marker.getPoint().lng());
          if (confirm('是否要更新此位置？')) {
            $j.post("save_latlng.php", {action: 'update', point_id: marker.id, lat: marker.getPoint().lat(), lng: marker.getPoint().lng()}, function(data) {
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
          marker.openInfoWindowHtml('<iframe src="/maps/uploader.php?pid='+point_id+'" style="width:220px;border:none;"></iframe>');
        });
      } // End of drawMarker

      function getPreviewDOM(photo, i)
      {
        var id = photo.id;

        var a = document.createElement("A");
        a.href = "/photo/" + id;

        var img = document.createElement("IMG");

        $j(img).attr({
          title: photo.curr_time,
            id: "r" + id,
            src: "http://122.116.58.206/photos/img/icon_openid_s.gif",
            //src: getImageUrl("thumbnail", id),

            p_id: id }).hover(
              function() {
                $j(this).css("border", "1px solid #ff0000");
                $j(this).css("margin", "2px auto");
                $j(this).css("padding", "3px");
                markers.select(i);
              }, function() {
                $j(this).css("border", "1px solid #cccccc");
                $j(this).css("margin", "2px auto");
                $j(this).css("padding", "3px");
                markers.select(markers.NONE);
              }
          );

          var div = document.createElement("DIV");
          div.appendChild(a);
          a.appendChild(img);
          return div;
      }

      var showObj = function (o) {
        /*
        var photos = [];
        var photos_desc = [];
        var mymarkers = new myMarker("/activity/123/photoconcat/?w=32&h=32", 32, 32, o, photos, photos_desc, "article");
        map.addOverlay(mymarkers);
         */

        var points = [];
        var ids = [];
        var minMarker = [];
        //for(var x in o) {
        for(var i=0; i<o.length; i++) {

          var photo = o[i];
          var markerPoint = new GLatLng(photo.lat, photo.lng);
          points.push(markerPoint);
          ids.push(photo.id);

          /*
          var marker = new GMarker(markerPoint);
          minMarker.push(marker);
          mgr.addMarkers(minMarker, 16);
          mgr.refresh();
           */

          $j("#preview").append(getPreviewDOM(o[i], i));

        }

        markers = new GCompoundMarker("http://122.116.58.206/photos/upload/r/richardw/1/Winter.jpg", 32, 32, points);
        map.addOverlay(markers);

        GEvent.addListener(markers, "mouseover", function(i) {
          markers.select(i);
          $j("#r" + o[i].id).css("background", "#ff0000");
        });

        GEvent.addListener(markers, "mouseout", function(i) {
          markers.select(markers.NONE);
          $j("#r" + o[i].id).css("background", "#ffffff");
        });

        GEvent.addListener(markers, "click", function(i) {
          console.dir(markers.select(i));
          //marker.openInfoWindowHtml('圖在這!');
        });

        /*
        // 自訂圖標
        var MyIcon = new GIcon(G_DEFAULT_ICON);
        MyIcon.image = "http://122.116.58.206/photos/upload/r/richardw/1/Winter.jpg";
        // 自訂圖標大小
        MyIcon.iconSize = new GSize(32, 32); 
        markerOptions = { icon:MyIcon, draggable:true, id:p.id};

        markerPoint = new GLatLng(o[x].lat, o[x].lng);
        var marker = new GMarker(markerPoint, markerOptions);
        //var marker = new GCompoundMarker(MyIcon.image, 32, 32, markerPoint);
        drawMarker(marker);
         */

      } //End of showObj

      var bounds = map.getBounds();
      var sw = bounds.getSouthWest();
      var ne = bounds.getNorthEast();
      var req_para = {
        "minx": sw.lng(),
          "miny": sw.lat(),
          "maxx": ne.lng(),
          "maxy": ne.lat()
      };
      $j.get("load_latlng.php", req_para, showObj, "json");
    }

    GEvent.addListener(map, "moveend", function() {
      $j.get("load_latlng.php", req_para, showObj, "json");
    });

  }

  function addMarker(map) {
    var latlngObj = map.fromContainerPixelToLatLng(new GPoint(clickedPixel.x, clickedPixel.y));
    var newPoint = new GLatLng(latlngObj.lat(), latlngObj.lng());
    var create_new = function (data) {
      new_markerid = data.new_markerid;
      alert(latlngObj.lat() + ' & ' + latlngObj.lng() + ' 已存檔!');
    };
    if (confirm('是否要在此位置建立據點？')) {
      $j.post("save_latlng.php", {action: 'create', lat: latlngObj.lat(), lng: latlngObj.lng()}, function(data) {
        new_markerid = data.new_markerid;
        console.log('new_markerid => ', new_markerid);

        // 自訂圖標
        var MyIcon = new GIcon(G_DEFAULT_ICON);
        MyIcon.image = "http://maps.google.com.tw/intl/zh-TW_tw/mapfiles/ms/micons/blue-dot.white.png";
        // 自訂圖標大小
        MyIcon.iconSize = new GSize(32, 32); 
        markerOptions = { icon:MyIcon, draggable:true, id:new_markerid};
        var newMarker = new GMarker(newPoint, {draggable:true, id:new_markerid});

        drawMarker(newMarker, new_markerid);
        alert(latlngObj.lat() + ' & ' + latlngObj.lng() + ' 已存檔!');
      }, 'json');
    }
    $j('#msg').html('定位於' + newPoint);
    setTimeout(function() {
      $j('#msg').fadeOut(function() {
        $j('#msg').fadeIn("slow");
        $j('#msg').html('請繼續下一個動作');
      });
    }, 1000);
    contextmenu.style.visibility = 'hidden';
    /*
    var polyline = new GPolyline([
      new GLatLng(latlngObj.lat(), latlngObj.lng()),
        new GLatLng(latlngObj.lat() + 0.001, latlngObj.lng() + 0.001)
        ], "#ff0000", 3);
    map.addOverlay(polyline);
     */
    /*
    var boundaries = new GLatLngBounds(new GLatLng(latlngObj.lat(), latlngObj.lng()), new GLatLng(latlngObj.lat()+0.00025, latlngObj.lng()+0.00025));
    var myimg = new GGroundOverlay("http://122.116.58.206/photos/upload/r/richardw/1/Winter.jpg", boundaries);
    map.addOverlay(myimg);
     */
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

  //google.load("maps", "2.x", {"callback" : initialize, "locale" : "zh_TW"});
  //google.load("jquery", "1.2.6");
</script> 
</head> 
<body onLoad="initialize()" onunload="GUnload()"> 
<div id="container">
  <div id="msgArea">
    <span id="msg">這裡放座標</span>
    <span id="cordination"></span>
  </div>
  <div id="preview"></div>
  <div id="map" style="border:1px solid gray;width: 900px; height: 600px"></div>
</div>

</body> 
</html>
