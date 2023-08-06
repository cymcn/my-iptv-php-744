<?php
error_reporting(0);
header('Content-Type:text/html;charset=UTF-8');

$id=$_GET['id'];
$playseek=$_GET['playseek'];
//$user='17199741419';
//$ptoken='w14L5ppGYYzipwiIRQpgdA==';
//$pserialnumber='865372026096088';
$user='freeuser';
$ptoken='A5ZjU2OThiNjAxMzExMTBkN==';
$pserialnumber='b60131110d72d53';
$t=time();
$nonce=rand(100000,999999);
$str='sumasalt-app-portalpVW4U*FlS'.$t.$nonce.$user;
$hmac=substr(sha1($str),0,10);
$onlineip=$_SERVER['REMOTE_ADDR'];
$info='ptype=1&plocation=001&puser='.$user.'&ptoken='.$ptoken.'&pversion=030104&pserverAddress=portal.gcable.cn&pserialNumber='.$pserialnumber.'&pkv=1&ptn=Y29tLnN1bWF2aXNpb24uc2FucGluZy5ndWRvdQ&pappName=GoodTV&DRMtoken='.$ptoken.'&epgID=&authType=0&secondAuthid=&t='.$ptoken.'&pid=&cid=&u='.$user.'&p=8&l=001&d='.$pserialnumber.'&n='.$id.'&v=2&hmac='.$hmac.'&timestamp='.$t.'&nonce='.$nonce;
$url='http://portal.gcable.cn:8080/PortalServer-App/new/aaa_aut_aut002';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
curl_setopt($ch, CURLOPT_USERAGENT, "Apache-HttpClient/UNAVAILABLE (java 1.4)");
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Host: portal.gcable.cn:8080', 'Connection: Keep-Alive','Accept-Encoding: gzip','Content-Length: 440')); 页头信息备用
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.$onlineip, 'CLIENT-IP:'.$onlineip));
$res = curl_exec($ch);
curl_close($ch);
//preg_match('|aaa?(.*?)&ip|',$res, $tk);
//$live="http://gslb.gcable.cn:8070/live/".$id.".m3u8?".$tk[1];
$uas=parse_url($res);
parse_str($uas["query"]);
$token="?t=".$t."&u=".$u."&p=".$p."&pid=&cid=".$cid."&d=".$d."&sid=".$sid."&r=".$r."&e=".$e."&nc=".$nc."&a=".$a."&v=".$v;
$playurl = "http://gslb.gcable.cn:8070/live/".$id.".m3u8".$token;
if($playseek !== null){
         $t = explode('-',$playseek);
	     $st=strtotime($t[0]);
         $et=strtotime($t[1]);
         $playurl=$playurl."&starttime=".$st."&endtime=".$et."";
         }
//print_r ($playurl);
header('Location: '.$playurl);
?>