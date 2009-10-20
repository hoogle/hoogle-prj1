<?
$authURL = "https://rpxnow.com/api/v2/auth_info/?apiKey=707ed1543413a84ed8425ab6f44e3e5f765d34cc&token=99d17d84636c18ed9fb559e0a4d99aa4c31d9a8f";
//$authURL = "http://122.116.58.213/index.php";
echo "url : $authURL<br />";
$ch = curl_init($authURL);
//curl_setopt($ch, CURLOPT_URL, $authURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_TIMEOUT, 300);
$buffer=curl_exec($ch);
echo "BUFFER: $buffer";
?>

