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
    nick: <input type="text" id="nick"/><br/>
    pwd: <input type="password" id="pwd"/><br/>
    msg: <input type="text" id="msg"/><br/>
    <input type="button" id="plurkit" value="噗吧!"/>
    <div id="stat"></div>
</div>
<div>
    <input type="button" id="getit" value="取得噗"/> 
    <div id="show"></div> 
    <div id="nick"></div>
    <div id="karma"></div>
</div>
</body>
</html>
<script type="text/javascript">
    $('#plurkit').click(function() {
        var nick = $('#nick').val();
        var pwd = $('#pwd').val();
        var msg = $('#msg').val();
        $('#stat').html('發送中...');
        $.post('lib.php', {func:'plurking', nick:nick, pwd:pwd, msg:msg}, function(data) {
            console.dir(data);
            if (data['error'] == null) {
                $('#stat').html('發送成功!!');
            }
        }, 'json');
    });

    $('#getit').click(function() {
        var nick = $('#nick').val();
        var pwd = $('#pwd').val();
        $('#show').html('geting...');
        $.post('lib.php', {func:'getplurks', nick:nick, pwd:pwd}, function(data) {
            var uids = "<ul>\n";
            for(var item in data['plurk_users']) {
                uids+= '<li>' + data['plurk_users'][item]['display_name'] + ' (' + data['plurk_users'][item]['karma'] + ')</li>\n';
            }
            uids+= '</ul>\n';
            $('#show').html('users: '+uids);
        }, 'json');
    });
</script>
