<?php

$nick = $_POST['nick'];
$pwd = $_POST['pwd'];
$uid = $_POST['uid'];
$msg = $_POST['msg'];

function getUserID($nick)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/532.0 (KHTML, like Gecko) Chrome/3.0.195.33 Safari/532.0');
    curl_setopt($ch, CURLOPT_URL, "http://www.plurk.com/{$nick}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $contents = curl_exec($ch);
    curl_close($ch);
    preg_match('/var GLOBAL = \{.*"uid": ([\d]+),.*\}/imU', $contents, $pid);
    $uid = $pid[1];
    return $uid;
}

function post_plurk($nick_name, $pwd, $uid, $msg) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 認證
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_URL, 'http://www.plurk.com/Users/login');
    curl_setopt($ch, CURLOPT_POSTFIELDS, "nick_name={$nick_name}&password={$pwd}");
    curl_exec($ch);
    // 發文
    curl_setopt($ch, CURLOPT_URL, 'http://www.plurk.com/TimeLine/addPlurk');
    curl_setopt($ch, CURLOPT_POSTFIELDS, "qualifier=says&content=" . urlencode($msg) . "&lang=tr_ch&limited_to=[$uid]&no_comments=0&uid={$uid}");
    $rsp = curl_exec($ch);
    curl_close($ch);
    return $rsp;
}
$uid = getUserID($nick);
echo post_plurk($nick, $pwd, $uid, $msg);
?>
