<?php
error_reporting(0);
date_default_timezone_set("Asia/Shanghai");
$id = isset($_GET['id']) ? $_GET['id'] : 'cctv1';
$n = [
    'cctv1' => '3221225804', // CCTV1
    'cctv2' => '3221226195', // CCTV2
    'cctv3' => '3221226397', // CCTV3
    '风云足球' => '3221226984', // 风云足球
    'ystq' => '3221226956', // 风云足球
];
$ipArray = [
    'dbiptv.sn.chinamobile.com',
];
$ip = $ipArray[array_rand($ipArray)];
$playurl = "http://{$ip}/PLTV/88888893/224/{$n[$id]}/index.m3u8";
$playurl2 = "http://{$ip}/PLTV/88888890/224/{$n[$id]}/index.m3u8"; // 新增的播放地址
header('Location: ' . $playurl);
exit;
