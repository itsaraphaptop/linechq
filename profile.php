<?php


$access_token = 'b4Mm4PJSr3Ohue4vaTsg/W39BESnwRb0FI/Q9Y8MuGyFD9+rGi7BIKgRpPIA42sDu6LXibUl3pkyvOEGq2i8vjdpupkYio0Ji8lF6jWaEDVvEtbYufmHUvJZlH9DccfvKwZoi5OKLy3p1c3YnrdHEAdB04t89/1O/w1cDnyilFU=';

$userId = 'U212662b1d1e42d440f05ca1714b6527f';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

