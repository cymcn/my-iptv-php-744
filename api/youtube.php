�������ص�����
<?php
// ��ȡ URL �е� id �� q ���������������������Ĭ��ֵ
$id = $_GET["id"] ?? "9sE12tg3CmA";
$quality = $_GET["q"] ?? "hd";
// ����һ�����������ڻ�ȡָ�� URL �� HTML ����
function get_data($url){
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)");
curl_setopt($ch, CURLOPT_REFERER, "http://facebook.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}
// ��ȡ YouTube ��Ƶ�� HTML ����
$string = get_data('https://www.youtube.com/watch?v=' . $id);
// �� HTML ��������ȡ M3U8 �ļ�������
preg_match_all('/hlsManifestUrl(.*m3u8)/', $string, $matches, PREG_PATTERN_ORDER);
$rawURL = str_replace("\/", "/", substr($matches[1][0], 3));
// ������Ƶ��������ֵ���ò�ͬ��������ʽ����ƥ����Ӧ�� M3U8 ��������
$quality_regex = match ($quality) {
'720' => '/(https:\/.*\/95\/.*index.m3u8)/',
'480' => '/(https:\/.*\/94\/.*index.m3u8)/',
'hd' => '/(https:\/.*\/96\/.*index.m3u8)/',
};
// ��ȡ��Ƶ��������
preg_match_all($quality_regex, get_data($rawURL), $playURL, PREG_PATTERN_ORDER);
// ������ȷ�� HTTP ��Ӧͷ�����������ӷ��͸��ͻ���
header("Content-type: application/vnd.apple.mpegurl");
header("Location: " . $playURL[1][0]);
?>
