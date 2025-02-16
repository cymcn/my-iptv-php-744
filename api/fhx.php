<?php
error_reporting(0);
date_default_timezone_set("PRC");
$id = $_GET['id']??'fhzw';
$from = $_GET['from']??'web';
if (preg_match('/(.*?)(?:\?.*|\$.*)/', $id, $matches_id)) $id = $matches_id[1];
$n = [
	'fhzw' => 'f7f48462-9b13-485b-8101-7b54716411ec',//凤凰中文
	'fhzx' => '7c96b084-60e1-40a9-89c5-682b994fb680',//凤凰资讯
	'fhhk' => '15e02d92-1698-416c-af2f-3e9a872b4d78',//凤凰香港
];
if (!isset($n[$id])) die(header("HTTP/1.1 403"));
switch ($from) {
	case 'app':
		$urlp = "https://m.fengshows.com/api/v3/hub/live/auth-url?live_id={$n[$id]}&live_qa=";//app
		break;
	case 'web':
		$urlp = "https://api.fengshows.cn/hub/live/auth-url?live_id={$n[$id]}&live_qa=";//web
		break;
	default:
		die(header('HTTP/1.1 403 FORBIDDEN'));
		break;
}
$playseek = $_GET['playseek']??'';
$urle = '';
if ($playseek) {
	$t_arr = explode('-',$playseek);
	$playbackbegin = strtotime($t_arr[0])*1000;
	$playbackend = strtotime($t_arr[1])*1000;
	$now = time()*1000;
	if($playbackend>$now) $playbackend = $now;
	$ps_time = dechex($playbackbegin);;
	$pe_time = dechex($playbackend);;
	$urle = "&play_type=replay&ps_time=$ps_time&pe_time=$pe_time";
}
$url = $urlp.'FHD'.$urle;
//注：APP端token每次重新打开APP就失效(故抓包获取token后，token失效前请不要再次打开APP，最长30天失效)，web端token固定30天失效
//720P清晰度需要有有效的token
$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiIwZGQ1YzljMC00NjFiLTExZWUtOTBiZi1lMTNmM2E2NTdkMzgiLCJuYW1lIjoi6KGM6LWw55qE6KmpIiwidmlwIjowLCJqdGkiOiJpQ25XTkZ3bGgiLCJyZWdpc3RyYXRpb25faWQiOiIxMzA2NWZmYTRmM2JmMzEwZTI1IiwiaWF0IjoxNzI4NzEzODYyLCJleHAiOjE3MzEzMDU4NjJ9.XkrFCkuNGGr7RPhQcwg4r-lsfcC5jXPTK4xmwlIEOPc";
$header = [
	'User-Agent: okhttp/3.14.9',
	'token: '.$token,
];
$data = get($url,$header);
//print_r($data);exit;
if (strpos($data,'http')===false) {
	$url = $urlp.'HD'.$urle;
	$data = file_get_contents($url);
}
$live = json_decode($data)->data->live_url;
header('Location:'.$live);
exit;
function get($url,$header){	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
?>


