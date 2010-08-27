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

function do_act($target_url, $data, $cookie_file = NULL)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if (isset($cookie_file))
    {
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    }
    curl_setopt($ch, CURLOPT_URL, $target_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $result = curl_exec($ch);
    curl_close($ch);
    if (end(explode("/", $target_url)) != "login") {
        echo $result;
        exit;
    }
    return $result;
}

$func = strip_tags($_POST['func']);
$cookie_file = "/tmp/plurk_cookie";
switch($func)
{
    case "plurking":
        $nick = $_POST['nick'];
        $pwd = $_POST['pwd'];
        $msg = $_POST['msg'];
        $qualifier = $_POST['qualifier'];
        $priv = $_POST['priv'];
        $uid = getUserID($nick);
        $login_url = "http://www.plurk.com/Users/login"; 
        $login_data = array(
            "api_key" => API_KEY,
            "nick_name" => $nick,
            "password" => $pwd
        );
        do_act($login_url, $login_data, $cookie_file);

        $post_url = "http://www.plurk.com/TimeLine/addPlurk"; 
        $limited_to = ($priv == "true") ? "[$uid]" : "";
        $post_data = array(
            "qualifier" => $qualifier,
            "content" => "!FB {$msg}",
            "lang" => "tr_ch",
            "limited_to" => $limited_to,
            "no_comments" => 0,
            "uid" => $uid
        );
        echo do_act($post_url, $post_data, $cookie_file);
        break;

    case "getchannel":
        $nick = $_POST['nick'];
        $pwd = $_POST['pwd'];
        $target_url = "http://www.plurk.com/API/Users/login";
        $data = array(
            "api_key" => API_KEY,
            "username" => $nick,
            "password" => $pwd 
        );
        do_act($target_url, $data, $cookie_file);

        $target_url = "http://www.plurk.com/API/Realtime/getUserChannel";
        $data = array(
            "api_key" => API_KEY,
        );
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");

        echo do_act($target_url, $data, $cookie_file);
        break;

    case "getnew":
        $target_url = $_POST['url']; 
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");

        echo do_act($target_url, NULL, $cookie_file);
        break;

    case "getplurks":
        $nick = $_POST['nick'];
        $pwd = $_POST['pwd'];
        $target_url = "http://www.plurk.com/API/Users/login";
        $data = array(
            "api_key" => API_KEY,
            "username" => $nick,
            "password" => $pwd 
        );
        do_act($target_url, $data, $cookie_file);

        $target_url = "http://www.plurk.com/API/Timeline/getPlurks";
        $data = array(
            "api_key" => API_KEY,
            "offset" => date("Y-n-dTH:i:s") 
        );
        header("Cache-Control: no-cache");
        header("Content-Type: application/json");

        echo do_act($target_url, $data, $cookie_file);
        break;
}
?>
