<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>API retrive</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.8.0/build/reset-fonts-grids/reset-fonts-grids.css&2.8.0/build/button/assets/skins/sam/button.css"/>
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0/build/yahoo-dom-event/yahoo-dom-event.js&2.8.0/build/connection/connection-min.js&2.8.0/build/element/element-min.js&2.8.0/build/button/button-min.js"></script>
<style type="text/css">
ul li {
    list-style-type:circle;
    margin:5px;
}
.input_text {
    width:100px;
}
.yui-g {
    margin:3px;
    padding:5px;
    border:1px solid gray;
}
</style>
</head>
<body class="yui-skin-sam">
<div id="doc2" class="yui-t3">
    <div id="bd">
        <div id="yui-main">
            <div class="yui-b">
                <div>result:</div>
                <div class="yui-g" id="result"></div>
            </div>
        </div>
        <div class="yui-b">
            <ul>
                <li><input type="button" id="get_filelist" value=" GET Filelist "/></li>
                <li>
                    <input type="text" id="dirname" class="input_text"/>
                    <input type="button" id="create_dir" value=" CREATE Directory "/>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
var $ = YAHOO.util.Dom.get;
var PB1 = new YAHOO.widget.Button("get_filelist");
var PB2 = new YAHOO.widget.Button("create_dir");
PB1.on('click', function() {
    YAHOO.util.Connect.asyncRequest(
        'GET',
        'http://122.116.58.213:8080/api/getFileList?path=./&t=' + new Date().valueOf(),
        {
            success: function(o) {
                $('result').innerHTML = o.responseText;
            },
            failure: function(o) {
                $('result').innerHTML = o.statusText;
            }
        }
    );
});

PB2.on('click', function() {
    var url = 'http://122.116.58.213:8080/api/createDirectory?path=./&dirname='+$('dirname').value+'&t=' + new Date().valueOf();
    YAHOO.util.Connect.asyncRequest(
        'GET',
        url,
        {
            success: function(o) {
                $('result').innerHTML = o.responseText;
            },
            failure: function(o) {
                $('result').innerHTML = o.statusText;
            }
        }
    );
});
</script>
