<?php


$access_token = 'BzhHslWQhDtU0WMuY0CDT5HTmfvarIxlganYTLGZ5iVUHcfYCqCLVj36kW4+sTk9G+EQlw2cln35pc9hOCs/0AnKyn5b551+o4tRM6SI758KmqmTGtTwDZf7uPXoC4QycYOthQN/OWmdO/kwnyT6wwdB04t89/1O/w1cDnyilFU=';

$userId = 'U55ebca7c282122cff90fec9bb3062f5a';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

