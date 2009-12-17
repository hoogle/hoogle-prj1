<?php

$nick = $_POST['nick'];
$pwd = $_POST['pwd'];
$uid = $_POST['uid'];
$msg = $_POST['msg'];

// 發文到plurk
// 2008/07/19 改
// $nick_name 是顯示名稱，如 klcintw
// $uid 是使用者代號，藏在網頁原始碼裡，如："user_id": 30140
function post_plurk($nick_name, $pwd, $uid, $msg) {
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    // 認證
    curl_setopt($curl_handle, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($curl_handle, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($curl_handle, CURLOPT_URL, 'http://www.plurk.com/Users/login');
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "nick_name=$nick_name&password=$pwd");
    curl_exec($curl_handle);
    // 發文
    curl_setopt($curl_handle, CURLOPT_URL, 'http://www.plurk.com/TimeLine/addPlurk');
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, 'qualifier=%3A&content=' . urlencode($msg) . '&lang=en&no_comments=0&uid='.$uid);
    curl_exec($curl_handle);
    curl_close($curl_handle);
    return;
}
post_plurk($nick, $pwd, $uid, $msg);
?>
