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
    <input type="button" id="getit" value="get it!"/> 
    <div id="show"></div> 
    <div id="nick"></div>
    <div id="karma"></div>
</div> 
</body> 
</html> 
<script type="text/javascript"> 
    $('#getit').click(function() {
        $('#show').html('haha');
        $.post('get_plurk.php', {nick:'hoogle', pwd:'qUs4obog', uid:'3982321'}, function(data) {
$('#show').html('karma:'+data['user']['karma']);
console.dir(data);
        }, 'json');
    });
</script> 
