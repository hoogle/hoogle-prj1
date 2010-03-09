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
    list-style-type:square;
    border:1px solid #aaccff;
    background-color:#ddeeff;
    margin:10px;
    padding:5px;
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
                <li><input type="button" id="get_version" value=" GET Version "/></li>
                <li><input type="button" id="get_router" value=" GET Router "/></li>
                <li><input type="button" id="get_devices" value=" GET Devices "/></li>
                <li><input type="button" id="get_filelist" value=" GET Filelist "/></li>
                <li>
                    <input type="text" id="dirname" class="input_text" value="new_<?php echo date("mdHi"); ?>"/>
                    <input type="button" id="create_dir" value=" CREATE Directory "/>
                </li>
                <li>
                    <form name="upform" method="post" enctype="multipart/form-data">
                        <input type="file" id="browse_file" name="browse_file" class="input_text"/><br/>
                        <input type="button" id="upfile" value=" UPLOAD File "/> 
                    </form>
                </li>
                <li>
                    <form id="delF" name="delF" method="post" action="http://122.116.58.213:8080/api/deleteFiles">
                        <input type="text" name="files[]" value="one"/><br/>
                        <input type="text" name="files[]" value="two"/><br/>
                        <input type="text" name="files[]" value="three"/><br/>
                        <input type="text" name="files[]" value="four"/><br/>
                        <input type="text" name="path" value="./"/>
                        <input type="button" id="del_files" value=" DELETE Files "/>
                    </form>
                </li>
                <li>
                    <input type="button" id="rename_file" value=" RENAME Files "/>
                </li>
                <li>
                    <form id="cpF" name="cpF" method="post" action="http://122.116.58.213:8080/api/copyFilesTo">
                        <input type="text" name="files[]" value="file1"/><br/>
                        <input type="text" name="files[]" value="file2"/><br/>
                        <input type="text" name="files[]" value="file3"/><br/>
                        <input type="text" name="files[]" value="file4"/><br/>
                        <input type="text" name="src_path" value="./"/><br/>
                        <input type="text" name="dst_path" value="./YKK/"/>
                        <input type="button" id="copy_files" value=" COPY Files "/>
                    </form>
                </li>
                <li>
                    <form id="mvF" name="mvF" method="post" action="http://122.116.58.213:8080/api/moveFilesTo">
                        <input type="text" name="files[]" value="file1"/><br/>
                        <input type="text" name="files[]" value="file2"/><br/>
                        <input type="text" name="files[]" value="file3"/><br/>
                        <input type="text" name="files[]" value="file4"/><br/>
                        <input type="text" name="src_path" value="./"/><br/>
                        <input type="text" name="dst_path" value="./YKK/"/>
                        <input type="button" id="move_files" value=" MOVE Files "/>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
var $ = YAHOO.util.Dom.get;
var PB0 = new YAHOO.widget.Button("get_version");
var PB1 = new YAHOO.widget.Button("get_router");
var PB2 = new YAHOO.widget.Button("get_devices");
var PB3 = new YAHOO.widget.Button("get_filelist");
var PB4 = new YAHOO.widget.Button("create_dir");
var PB5 = new YAHOO.widget.Button("upfile");
var PB6 = new YAHOO.widget.Button("del_files");
var PB7 = new YAHOO.widget.Button("rename_file");
var PB8 = new YAHOO.widget.Button("copy_files");
var PB9 = new YAHOO.widget.Button("move_files");

PB0.on('click', function() {
    var url = 'http://122.116.58.213:8080/api/getVersion?sig=6t2eUYr23R&expires=123234235&routerAccessKeyId=WE32w4hjk3er46&t=' + new Date().valueOf();
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

PB1.on('click', function() {
    var url = 'http://122.116.58.213:8080/api/getRouter?sig=6t2eUYr23R&expires=123234235&routerAccessKeyId=WE32w4hjk3er46&t=' + new Date().valueOf();
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

PB2.on('click', function() {
    var url = 'http://122.116.58.213:8080/api/listShareDevices?sig=6t2eUYr23R&expires=123234235&routerAccessKeyId=WE32w4hjk3er46&t=' + new Date().valueOf();
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

PB3.on('click', function() {
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

PB4.on('click', function() {
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

PB5.on('click', function() {
    if ($('browse_file').value == "") {
        alert('browse upload file, please');
    } else {
        var url = 'http://122.116.58.213:8080/api/uploadFile?';
        var dataStr = [
            'path=./',
            'browse_file='+$('browse_file').value,
            't='+new Date().valueOf()
        ].join('&');
        YAHOO.util.Connect.asyncRequest(
            'POST',
            url,
            {
                success: function(o) {
                    $('result').innerHTML = o.responseText;
                },
                failure: function(o) {
                    $('result').innerHTML = o.statusText;
                }
            },
            dataStr
        );
    }
});

PB6.on('click', function() {
    $('delF').submit();
});

PB7.on('click', function() {
    YAHOO.util.Connect.asyncRequest(
        'GET',
        'http://122.116.58.213:8080/api/renameFile?src_fullfilename=./log-2010-03-05.php&dst_filename=log-20100305.php&t=' + new Date().valueOf(),
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

PB8.on('click', function() {
    $('cpF').submit();
});

PB9.on('click', function() {
    $('mvF').submit();
});
</script>
