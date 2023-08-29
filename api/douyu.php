<?php
$id = $_GET['id'];
douyu($id);
function douyu($id)
{
$ym='tc-tc2-interact.douyucdn2.cn';
		
if(empty($_GET['type'])){$type='flv';}else{$type=$_GET['type'];}
if(strlen($id)>14){	
$wasu = 'https://'.$ym.'/live/'.$id.'.'.$type;
}else{
	
$url = 'https://wxapp.douyucdn.cn/Livenc/Getplayer/newRoomPlayer';
$postData = 'room_id='.$id.'&token=wxapp&rate=&did=10000000000000000000000000001501&big_ct=cpn-

androidmpro&is_Mix=false';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, 

CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0" );
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
$data = curl_exec($ch);
curl_close($ch);
$json = json_decode($data);
$wasu = $json->data->hls_url;
if($type!='flv'){
$idn = basename(parse_url($wasu,PHP_URL_PATH));
$idns = explode('_',$idn);
$wasu = 'https://'.$ym.'/live/'.$idns[0].'.'.

$type;
}
}
header('location:'.$wasu);exit;
}
?>