<?php
define('API_KEY', 'gmgTvNs50xWhK0eN6IVFuhTzkZsyDHJ4');

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

function do_act( $target_url, $data, $cookie_file = NULL )
{
    $ch = curl_init();

    curl_setopt( $ch , CURLOPT_URL , $target_url );
    curl_setopt( $ch , CURLOPT_POST , true );
    curl_setopt( $ch , CURLOPT_POSTFIELDS , http_build_query( $data ) );

    if( isset( $cookie_file ) )     // cookie
    {
        curl_setopt( $ch , CURLOPT_COOKIEFILE , $cookie_file );
        curl_setopt( $ch , CURLOPT_COOKIEJAR , $cookie_file );
    }

    //curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
    //curl_setopt( $ch , CURLOPT_FOLLOWLOCATION , true );
    //curl_setopt( $ch , CURLOPT_SSL_VERIFYPEER , false );

    $result = curl_exec( $ch );
    curl_close( $ch );
    return $result;
}

switch($_POST('func'))
{
    case "post":
        $nick = $_POST['nick'];
        $pwd = $_POST['pwd'];
        $uid = $_POST['uid'];
        $msg = $_POST['msg'];

        $uid = getUserID($nick);
        echo post_plurk($nick, $pwd, $uid, $msg);
        break;

    case "get":
        $cookie_file = "/tmp/plurk_cookie";
        $target_url = "http://www.plurk.com/API/Users/login";
        $data = array(
            "api_key" => API_KEY,
            "username" => $_POST['nick'],
            "password" => $_POST['pwd'] 
        );
        //do_act($target_url, $data, $cookie_file);

        $target_url = "http://www.plurk.com/API/Timeline/getPlurks";
        $data = array(
            "api_key" => API_KEY,
            "plurk_id" => 182352727 
        );
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");

        do_act($target_url, $data, $cookie_file);
        break;
}
?>
