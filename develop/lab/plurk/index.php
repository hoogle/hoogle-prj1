<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html lang="en"> 
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta http-equiv="Pragma" content="no-cache" /> 
    <title>plurk</title> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>

<body>
<div>
    nick: <input type="text" id="nick" value="hoogle"/><br/>
    pwd: <input type="password" id="pwd" value="qUs4obog"/><br/>
    msg: <input type="text" id="msg"/>
    <select id="qualifier">
        <option value="loves">loves</option>
        <option value="likes">likes</option>
        <option value="shares">shares</option>
        <option value="gives">gives</option>
        <option value="hates">hates</option>
        <option value="wants">wants</option>
        <option value="has">has</option>
        <option value="will">will</option>
        <option value="asks">asks</option>
        <option value="wishes">wishes</option>
        <option value="was">was</option>
        <option value="feels">feels</option>
        <option value="thinks">thinks</option>
        <option value="says">says</option>
        <option value="is">is</option>
        <option value=":">:</option>
        <option value="freestyle">freestyle</option>
        <option value="hopes">hopes</option>
        <option value="needs">needs</option>
        <option value="wonders">wonders</option>
    </select><br/>
    <label for="priv"><input type="checkbox" name="priv" id="priv"/>密噗</label>
    <input type="button" id="plurkit" value="噗吧!"/>
    <div id="stat"></div>
</div>
<div>
    <input type="button" id="getit" value="河道上的人"/> 
    <input type="button" id="get_who_limited_me" value="誰私噗給我"/> 
    <input type="button" id="get_new" value=" 最新噗/回應 "/> 
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
        if (nick == "" || pwd == "" | msg == "") {
            alert('未填 nick, pwd, msg');
        } else {
            var qualifier = $('#qualifier').val();
            var priv = $('#priv')[0].checked;
            $('#stat').html('發送中...');
            $.post('lib.php', {func:'plurking', nick:nick, pwd:pwd, msg:msg, qualifier:qualifier, priv:priv}, function(data) {
                console.dir(data);
                if (data['error'] == null) {
                    $('#stat').html('發送成功!!');
                }
            }, 'json');
        }
    });

    $('#getit').click(function() {
        $('#getit').attr('disabled', true);
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
            console.dir(data);
            $('#getit').attr('disabled', false);
        }, 'json');
    });

    $('#get_who_limited_me').click(function() {
        $('#get_who_limited_me').attr('disabled', true);
        var nick = $('#nick').val();
        var pwd = $('#pwd').val();
        $('#show').html('查詢中...');
        $.post('lib.php', {func:'getplurks', nick:nick, pwd:pwd}, function(data) {
            var uids = "<ul>\n";
            var li = "";
            var regex = /\|\d+\|/g;
            for(var item in data['plurks']) {
                var limited_to = data['plurks'][item]['limited_to'];
                if (limited_to != null) {
                    var owner = data['plurks'][item]['owner_id'];
                    if (limited_to.match(regex) != null) {
                        li+= '<li>' + data['plurk_users'][owner]['display_name'] + ' [' + data['plurks'][item]['qualifier_translated'] + '] ' + data['plurks'][item]['content'] + ' (' + data['plurks'][item]['posted'] + ') </li>\n';
                    }
                }
            }
            uids+= (li != "") ? li : '<li>查無我的私噗!</li>';
            uids+= '</ul>\n';
            $('#show').html(uids);
            console.dir(data);
            $('#get_who_limited_me').attr('disabled', false);
        }, 'json');
    });

    var comet_server = '';
    var getNewPlurk = function(data) {
        var new_offset = data['new_offset'];
        var url = comet_server + new_offset;
        console.log('url = ', url);
        if (data['data'] == undefined) {
            url = comet_server + data['new_offset'];
            console.log('re-getnew(no-data): ', url);
            $.post('lib.php', {func:'getnew', url:url}, function(resp) {
                var rsp = resp['data'][0]['response']['content_raw'];
                console.log('response 0 : ', rsp);
            }, 'json');
        } else if (data['new_offset'] == -3) {
            url = comet_server + '0';
            console.log('-3, re-getnew(-3): ', url);
            $.post('lib.php', {func:'getnew', url:url}, function(resp) {
                var rsp = resp['data'][0]['response']['content_raw'];
                console.log('response 1 : ', rsp);
            }, 'json');
        } else {
            var rsp = data['data'][0]['response']['content_raw'];
            console.log('response 2 : ', rsp);
        }
        $('#show').html(rsp);
        $('#get_new').attr('disabled', false);
        console.log('free');
    };

    $('#get_new').click(function() {
        $('#get_new').attr('disabled', true);
        console.log('disabled');
        var nick = $('#nick').val();
        var pwd = $('#pwd').val();
        //$('#show').html('getdata查詢中...');
        $.post('lib.php', {func:'getchannel', nick:nick, pwd:pwd}, function(data) {
            comet_server = data['comet_server'];
            console.log('url = ', comet_server);
            comet_server = comet_server.replace("offset=0", "offset=");
            $.post('lib.php', {func:'getnew', url:comet_server}, getNewPlurk, 'json');
        }, 'json');
    });
</script>
