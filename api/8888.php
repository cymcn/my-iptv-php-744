<?php
error_reporting(0);
date_default_timezone_set("Asia/Shanghai");
$id = isset($_GET['id']) ? $_GET['id'] : 'cctv1';
$n = [
    '88HNWS' => '3221225799', // 湖南卫视
    '88JSWS' => '3221225800', // 江苏卫视
    '88DFWS' => '3221225797', // 东方卫视
    '88JXWS' => '3221225764', // 江西卫视
    '88JLWS' => '3221225792', // 吉林卫视
    '88SXWS' => '3221225763', // 山西卫视
    '88GZWS' => '3221225793', // 贵州卫视
    '88QHWS' => '3221225794', // 青海卫视
    '88NMGWS' => '3221225786', // 内蒙古卫视
    '88YNWS' => '3221225751', // 云南卫视
    '88HBWS' => '3221225750', // 河北卫视
    '88NXWS' => '3221225748', // 宁夏卫视
    '88XJWS' => '3221225747', // 新疆卫视
    '88GSWS' => '3221225754', // 甘肃卫视
    '88GXWS' => '3221225770', // 广西卫视
    '88SCWS' => '3221225768', // 四川卫视
    '88DNWS' => '3221225766', // 东南卫视
    '88GDWS' => '3221225803', // 广东卫视
    '88HLJWS' => '3221225802', // 黑龙江卫视
    '88SZWS' => '3221225801', // 深圳卫视
];

$ipArray = [
    'dbiptv.sn.chinamobile.com',
];
$ip = $ipArray[array_rand($ipArray)];

$playurl1 = "http://{$ip}/PLTV/88888890/224/{$n[$id]}/index.m3u8";
$playurl2 = "http://{$ip}/TVOD/88888893/224/{$n[$id]}/index.m3u8";
$playurl3 = "http://{$ip}/PLTV/88888888/224/{$n[$id]}/index.m3u8";
$playurl4 = "http://{$ip}/PLTV/88888893/224/{$n[$id]}/index.m3u8";

if (in_array($id, ['88HNWS', '88JSWS', '88DFWS', '88JXWS', '88JLWS', '88SXWS', '88GZWS', '88QHWS', '88NMGWS', '88YNWS', '88HBWS', '88NXWS', '88XJWS', '88GSWS', '88GXWS', '88HNWS', '88SCWS', '88HNWS', '88DNWS', '88GDWS', '88HLJWS', '88SZWS'])) {
    $playurl = $playurl3;
} elseif (in_array($id, ['d93cctv1', 'd93cctv2'])) {
    $playurl = $playurl2;
} elseif (in_array($id, ['90cctv3', '90cctv1'])) {
    $playurl = $playurl1;
} elseif (in_array($id, ['93cctv2', '93cctv3'])) {
    $playurl = $playurl4;
} else {
    $playurl = $playurl4; // 默认使用 $playurl4
}

header('Location: ' . $playurl);
exit;
