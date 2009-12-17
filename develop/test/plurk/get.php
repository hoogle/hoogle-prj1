<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta http-equiv="Pragma" content="no-cache" /> 
    <title>plurk</title> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>

<body>
<div>
    nick: <input type="text" id="nick" value="hoogle"/><br/>
    pwd: <input type="password" id="pwd"/><br/>
    msg: <input type="text" id="msg"/><br/>
    <input type="button" id="getit" value="get it!"/>
    <div id="show"></div>
</div>
</body>
</html>
<script type="text/javascript">
    $('#getit').click(function(e) {
        var nick = $('#nick').val();
        var pwd = $('#pwd').val();
        var msg = $('#msg').val();
        $('#show').html('haha');
        alert('nick = '+nick);
        $.post('post2plurk.php', {nick:nick, pwd:pwd, uid:'3982321', msg:msg}, function(data) {
            $('#show').html(data);
        });
    });
</script>
