<?php
error_reporting(0);
date_default_timezone_set("Asia/Shanghai");
$id = isset($_GET['id']) ? $_GET['id'] : 'cctv1';
$n = [
    'cctv1' => '3221225726', // CCTV1
    'cctv2' => '3221225706', // CCTV2
    'cctv3' => '3221226008', // CCTV3
    'cctv4' => '3221225779', // CCTV4
    'cctv4o' => '3221226268', // CCTV4ŷ��
    'cctv4a' => '3221226300', // CCTV4����
    'cctv5' => '3221226024', // CCTV5
    'cctv5p' => '3221226171', // CCTV5+
    'cctv6' => '3221226011', // CCTV6
    'cctv7' => '3221225745', // CCTV7
    'cctv8' => '3221226005', // CCTV8
    'cctv9' => '3221226031', // CCTV9
    'cctv10' => '3221225685', // CCTV10
    'cctv11' => '3221225746', // CCTV11
    'cctv12' => '3221225747', // CCTV12
    'cctv13' => '3221225748', // CCTV13
    'cctv14' => '3221225727', // CCTV14
    'cctv15' => '3221225749', // CCTV15
    'cctv16' => '3221226302', // CCTV16
    'cctv17' => '3221226027', // CCTV17
    'sjdl' => '3221226071', // CCTV�������
    'bqkj' => '3221226111', // CCTV�����Ƽ�
    'ystq' => '3221226117', // CCTV����̨��
    'nxss' => '3221226104', // CCTVŮ��ʱ��
    'hjjc' => '3221226097', // CCTV���ɾ糡
    'whjp' => '3221226100', // CCTV�Ļ���Ʒ
    'dszn' => '3221226120', // CCTV����ָ��
    'dyjc' => '3221226124', // CCTV��һ�糡
    'fyjc' => '3221226107', // CCTV���ƾ糡
    'fyzq' => '3221226153', // CCTV��������
    'fyyy' => '3221226083', // CCTV��������
    'gefwq' => '3221226114', // CCTV�߶�������
    'cgtn' => '3221226297', // CGTN
    'cgtnr' => '3221226278', // CGTN����
    'cgtnf' => '3221226265', // CGTN����
    'cgtnjl' => '3221226271', // CGTN��¼
    'cgtne' => '3221226284', // CGTN����
    'cgtna' => '3221226281', // CGTN����
    'zgjt' => '3221226286', // �й���ͨ
    'cetv1' => '3221225723', // CETV1
    'cetv2' => '3221226332', // CETV2
    'cetv4' => '3221226338', // CETV4
    'dnws' => '3221225739', // ��������
    'dfws' => '3221225752', // ��������
    'bjws' => '3221225754', // ��������
    'jlws' => '3221225753', // ��������
    'scws' => '3221225757', // �Ĵ�����
    'tjws' => '3221225756', // �������
    'ahws' => '3221225716', // ��������
    'sdws' => '3221225728', // ɽ������
    'gdws' => '3221225720', // �㶫����
    'jsws' => '3221225751', // ��������
    'jxws' => '3221225710', // ��������
    'hnbws' => '3221225713', // �ӱ�����
    'henws' => '3221225709', // ��������
    'zjws' => '3221225780', // �㽭����
    'szws' => '3221225712', // ��������
    'hbws' => '3221225708', // ��������
    'hnws' => '3221225778', // ��������
    'gsws' => '3221225755', // ��������
    'gzws' => '3221225776', // ��������
    'lnws' => '3221225717', // ��������
    'cqws' => '3221225686', // ��������
    'hljws' => '3221225758', // ����������
    'ynws' => '3221225687', // ��������
    'nmgws' => '3221225718', // ���ɹ�����
    'nlws' => '3221225696', // ũ������
    'nxws' => '3221225719', // ��������
    'sxws' => '3221225730', // ɽ������
    'gxws' => '3221225711', // ��������
    'xjws' => '3221225759', // �½�����
    'hanws' => '3221226298', // ��������
    'xzws' => '3221225668', // ��������
    'snxws' => '3221225688', // ��������
    'qhws' => '3221226301', // �ຣ����
    'ssws' => '3221226324', // ��ɳ����
    'xmws' => '3221225761', // ��������
    'ybws' => '3221225721', // �����ӱ�����
    'kbws' => '3221225695', // ��������
    'dwqws' => '3221225738', // ����������
    'btws' => '3221225722', // ��������
    'zyws' => '3221225697', // ���ز�������
    'adws' => '3221225694', // �ຣ��������
    'jsrw' => '3221225767', // �Ϻ���ʵ����
    'jskj' => '3221226105', // ������ʵ�ƽ�
    'klcd' => '3221226190', // ���Ͽ��ִ���
    'cha' => '3221226216', // ���ϲ�
    'jykt' => '3221225731', // ���Ͻ�ӥ��ͨ
    'jyjs' => '3221225671', // ���Ͻ�ӥ��ʵ
    'ley' => '3221226214', // ����
    'dmxc' => '3221226211', // SiTV�����㳡
    'xsj' => '3221226188', // SiTV���Ӿ�
    'hxjc' => '3221226210', // SiTV��Ц�糡
    'fztd' => '3221226199', // SiTV�������
    'yxfy' => '3221226193', // SiTV��Ϸ����
    'shss' => '3221226207', // SiTV����ʱ��
    'dsjc' => '3221226243', // SiTV���о糡
    'jsxt' => '3221226327', // SiTV��ɫѧ��
    'gz2' => '3221225682', // ����2
    'gz3' => '3221225704', // ����3
    'gz4' => '3221225740', // ����4
    'gz5' => '3221225662', // ����5
    'gz6' => '3221225672', // ����6
    'gz7' => '3221225741', // ����7
    'gy1' => '3221225743', // ����1
    'lps1' => '3221225772', // ����ˮ1
    'lps2' => '3221225773', // ����ˮ2
    'kl' => '3221226062', // ����
    'asgg' => '3221226034', // ��˳����
    'asxw' => '3221226054', // ��˳�����ۺ�
    'sn' => '3221226299', // ˼��
    'bj1' => '3221226002', // �Ͻ�1
    'bj2' => '3221226021', // �Ͻ�2
    'oa' => '3221226174', // �Ͱ�
    'zygg' => '3221226028', // ���幫��
    'zyzh' => '3221226026', // �����ۺ�
    'zyds' => '3221226051', // ���嶼��
    'lszh' => '3221225998', // ��ɽ�ۺ�
    'qdxw' => '3221226033', // ǭ���������ۺ�
    'qxgg' => '3221226003', // ǭ���Ϲ���
    'qxzh' => '3221225995', // ǭ�����ۺ�
    'qxxw' => '3221225693', // ǭ������
    'lgs' => '3221225677', // ������Ӱ�Ϲ���
    'zxs' => '3221225663', // ������Ӱ��ѧ��
    'fxzl' => '3221226162', // ������Ӱ����֮��
    'kkse' => '3221225732', // �����ٶ�
    'hhxd' => '3221225689', // �����Ŷ�
    'jkt' => '3221225690', // �㶫�μѿ�ͨ
    'ymkt' => '3221225763', // ����������ͨ
    'qm' => '3221225736', // ������Ħ
    'lz' => '3221225680', // ������װ
    'cftx' => '3221226145', // ���ղƸ�����
    'sypd' => '3221225683', // ��ӰƵ��
    'gxpd' => '3221225692', // ��ѧƵ��
    'hqqg' => '3221225681', // �������
    'tz' => '3221226095', // ͩ��
    'ydds' => '3221225774', // �����ƶ�����
    'gy2' => '3221225684', // ����2
    'gy3' => '3221225705', // ����3
    'tr1' => '3221225775', // ͭ��1
    'tr2' => '3221226102', // ͭ��2
    'qn1' => '3221226022', // ǭ��1
    'qn2' => '3221226025', // ǭ��2
    'jshq' => '3221226148', // ���軷��ѡ
    'tywq' => '3221226341', // ��ԪΧ��
    'zqjy' => '3221226304', // cetv���ڽ���
    'tlds' => '3221226098', // ��·����
    'ctds' => '3221226101', // ��������
];
$ipArray = [
    '39.136.17.114',
    '39.136.17.115',
    '39.136.17.116',
    '39.136.17.117',
    '39.136.17.118',
    '39.136.17.119',
];

$ip = $ipArray[array_rand($ipArray)];
$cacheFileName = 'gzyd_cache_all.json'; // Cache file name for all URLs
$cacheDuration = 43200; // Cache duration in seconds (12 hours)

// Initialize an empty array to store cached URLs
$cachedUrls = [];

// Check if the cache file exists and isn't expired
if (file_exists($cacheFileName)) {
    // Read the cached URLs from the file
    $cachedUrls = json_decode(file_get_contents($cacheFileName), true);

    // Check and remove expired cached URLs
    foreach ($cachedUrls as $cachedId => $cachedData) {
        $timestampDiff = time() - $cachedData['timestamp'];
        if ($timestampDiff >= $cacheDuration) {
            // Remove expired cached URL
            unset($cachedUrls[$cachedId]);
        }
    }
}

// Check if the URL for the current 'id' is already cached and within the duration
if (isset($cachedUrls[$id]) && time() - $cachedUrls[$id]['timestamp'] < $cacheDuration) {
    // Use cached URL for the current 'id'
    $finalUrl = $cachedUrls[$id]['url'];
} else {
    $playurl = "http://{$ip}/cdnrrs.gz.chinamobile.com/PLTV/88888888/224/{$n[$id]}/1/index.m3u8?fmt=ts2hls";

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $playurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout in seconds

    // Execute cURL session and capture the final URL
    curl_exec($ch);

    // Get the final URL after following redirects
    $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    // Get the HTTP status code
    $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Close cURL session
    curl_close($ch);

    if ($httpStatusCode !== 403) {
        // Cache the final URL for the current 'id'
        $cachedUrls[$id] = [
            'url' => $finalUrl,
            'timestamp' => time()
        ];

        // Store all cached URLs in the cache file
        file_put_contents($cacheFileName, json_encode($cachedUrls));
    } else {
        // Use the default URL or handle the 403 case as needed
        $finalUrl = 'https://angtv.cc';
    }
}

header("Content-Type: application/vnd.apple.mpegurl");
header('Location: ' . $finalUrl);
exit;