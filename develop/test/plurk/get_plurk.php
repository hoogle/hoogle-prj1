<?php
define('API_KEY', 'gmgTvNs50xWhK0eN6IVFuhTzkZsyDHJ4');

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
?>
