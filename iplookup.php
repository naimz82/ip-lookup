<?php
$clientIp = $_POST["iplookaddr"];
filter_var($clientIp, FILTER_VALIDATE_IP) or die(json_encode(["status"=>"fail","msg"=>"Invalid IP address."]));

$url = "http://ip-api.com/json/".$clientIp;
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);
$obj = json_decode($result);

if(empty($obj)) die(json_encode(["status"=>"fail","msg"=>"No information found."]));

$country = $obj->country ?? "unknown";
$region = $obj->regionName ?? "unknown";
$city = $obj->city ?? "unknown";
$isp = $obj->isp ?? "unknown";

$msg = "<strong>Country:</strong> ".$country."<br>";
$msg .= "<strong>Region:</strong> ".$region."<br>";
$msg .= "<strong>City:</strong> ".$city."<br>";
$msg .= "<strong>ISP:</strong> ".$isp;

die(json_encode(["status"=>"success","msg"=>$msg]));
?>