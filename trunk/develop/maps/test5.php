<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
  <title>Dog Marker</title> 
 
  <style type="text/css"> 
    body{font-family: Arial; font-size: small; background-color: #CCCCFF;}
    #outline {margin:20px; float:left; -moz-outline-radius:20px;  -moz-outline-style:solid;
      -moz-outline-color:#9FB6CD; -moz-outline-width:10px;}
    #map{width:512px; height:440px; float:left;}
    #head{text-align:left; margin-left:20px; font-size:150%;}
    #novel{width:400px; margin:20px;float:right;}
    #AdSense{margin:20px;}
    a:hover {color: red; text-decoration: underline overline;}
    td{vertical-align:top;}
    .pushpin{width:20px; height:34px; border:none;}
  </style> 
 
  <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAACgMwIzz1hxRWf8JW8JfV_xSfuyCR8UQqND6_MVZSTCrXFOoSJhRFXxV9YDnWBxuCXkBsNPiWSF6FeQ" type="text/javascript"> 
  </script> 
 
</head> 
<body onload="init()" onunload="GUnload()" > 
 
  <div id="outline"> <!-- These image links trigger the follow() function --> 
    <a class="marker" href="javascript:follow(0)"><img src="http://maps.google.com/mapfiles/marker.png" alt="" title="click me" class="pushpin"/></a> 
    <a class="marker" href="javascript:follow(1)"><img src="http://maps.google.com/mapfiles/dd-start.png" alt="" title="click me" class="pushpin"/></a> 
    <a class="marker" href="javascript:follow(2)"><img src="http://maps.google.com/mapfiles/dd-end.png" alt="" title="click me" class="pushpin"/></a> 

    <div id="map"> 
      <noscript>You should turn on JavaScript</noscript> 
    </div> 
  </div> 
 
<script type="text/javascript"> 
 
function init() {
  /**
   * DOM operations
   * 'Map coming...' visible only with JavaScript on.
   */
  document.getElementById("map").innerHTML = "Map coming...";
  if (!GBrowserIsCompatible()) {
    alert('Sorry. Your browser is not Google Maps compatible.');
  }

  /**
   * map
   */
  map = new GMap2(document.getElementById("map"));
  map.setCenter(new GLatLng(25.0266, 121.5223), 17);

}

  function follow(imageInd){
    /**
     * follow() function
     * @author: Esa 2008
     */

    var images = [
      "http://maps.google.com/mapfiles/marker.png",
      "http://maps.google.com/mapfiles/dd-start.png",
      "http://maps.google.com/mapfiles/dd-end.png"
      ];

    var marker;
    var dog = true;
    var noMore = false;

    var mouseMove = GEvent.addListener(map, 'mousemove', function(cursorPoint){
      if(!noMore){
        marker = new GMarker(cursorPoint,{draggable:true, autoPan:false});
        map.addOverlay(marker);
        marker.setImage(images[imageInd]);
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
 
</script> 
</body> 
</html>
