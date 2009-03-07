<?
$authURL = "https://rpxnow.com/api/v2/auth_info/?apiKey=aae60f77db9f1e62ba26ad8d18b3cac0d80922b5&token=99d17d84636c18ed9fb559e0a4d99aa4c31d9a8f";
//$authURL = "http://122.116.58.206/index.php";
echo "url : $authURL<br />";
$ch = curl_init($authURL);
//curl_setopt($ch, CURLOPT_URL, $authURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_TIMEOUT, 300);
$buffer=curl_exec($ch);
echo "BUFFER: $buffer";
?>

