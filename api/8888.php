<?php
error_reporting(0);
date_default_timezone_set("Asia/Shanghai");
$id = isset($_GET['id']) ? $_GET['id'] : 'cctv1';
$n = [
    'cctv1' => '3221225804', // CCTV1
    'cctv2' => '3221226195', // CCTV2
    'cctv3' => '3221226397', // CCTV3
    'fyzq' => '3221226984', // 风云足球
    'ystq' => '3221226956', // 央视台球
];
$ipArray = [
    'dbiptv.sn.chinamobile.com',
];
$ip = $ipArray[array_rand($ipArray)];

if ($id === 'cctv1' || $id === 'cctv2' || $id === 'cctv3') {
    $playurl = "http://{$ip}/PLTV/88888890/224/{$n[$id]}/index.m3u8";
} else {
    $playurl = "http://{$ip}/PLTV/88888893/224/{$n[$id]}/index.m3u8";
}

header('Location: ' . $playurl);
exit;
