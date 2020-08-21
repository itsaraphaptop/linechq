<?php
$access_token = 'BzhHslWQhDtU0WMuY0CDT5HTmfvarIxlganYTLGZ5iVUHcfYCqCLVj36kW4+sTk9G+EQlw2cln35pc9hOCs/0AnKyn5b551+o4tRM6SI758KmqmTGtTwDZf7uPXoC4QycYOthQN/OWmdO/kwnyT6wwdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

echo $result;