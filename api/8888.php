<?php
error_reporting(0);
date_default_timezone_set("Asia/Shanghai");
$id = isset($_GET['id']) ? $_GET['id'] : 'cctv1';
$n = [
    'd93cctv1' => '3221226231', // CCTV1
    'd93cctv2' => '3221226195', // CCTV2
    '90cctv3' => '3221226204', // CCTV3
    '90cctv1' => '3221225804', // CCTV1
    '93cctv2' => '3221226984', // CCTV2
    '93cctv3' => '3221226956', // CCTV3
    '88cctv1' => '3221225794', // CCTV1
    '88cctv2' => '3221225786', // CCTV2
    '88cctv3' => '3221225751', // CCTV3
];
$ipArray = [
    'dbiptv.sn.chinamobile.com',
];
$ip = $ipArray[array_rand($ipArray)];

$playurl1 = "http://{$ip}/PLTV/88888890/224/{$n[$id]}/index.m3u8";
$playurl2 = "http://{$ip}/TVOD/88888893/224/{$n[$id]}/index.m3u8";
$playurl3 = "http://{$ip}/PLTV/88888888/224/{$n[$id]}/index.m3u8";
$playurl4 = "http://{$ip}/PLTV/88888893/224/{$n[$id]}/index.m3u8";

if ($id === 'd93cctv1' || $id === 'd93cctv2') {
    $playurl = $playurl2;
} elseif ($id === '90cctv3' || $id === '90cctv1') {
    $playurl = $playurl1;
} elseif ($id === '88cctv1' || $id === '88cctv2' || $id === '88cctv3') {
    $playurl = $playurl3;
} elseif ($id === '93cctv2' || $id === '93cctv3') {
    $playurl = $playurl4;
} else {
    $playurl = $playurl4; // 默认使用 $playurl4
}

header('Location: ' . $playurl);
exit;
