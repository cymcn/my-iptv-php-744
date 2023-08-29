<?php
$id = $_GET['id'];
douyu($id);

function douyu($id)
{
    $ym = 'tc-tc2-interact.douyucdn2.cn';

    if (empty($_GET['type'])) {
        $type = 'flv';
    } else {
        $type = $_GET['type'];
    }

    if (strlen($id) > 14) {
        $wasu = 'https://' . $ym . '/live/' . $id . '.' . $type;
    } else {
        $url = 'https://wxapp.douyucdn.cn/Livenc/Getplayer/newRoomPlayer';
        $postData = 'room_id=' . $id . '&token=wxapp&rate=&did=10000000000000000000000000001501&big_ct=cpn-androidmpro&is_Mix=false';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $data = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($data, true); // 将JSON字符串转换为关联数组
        if (isset($json['data']['hls_url'])) {
            $wasu = $json['data']['hls_url'];
            if ($type != 'flv') {
                $idn = basename(parse_url($wasu, PHP_URL_PATH));
                $idns = explode('_', $idn);
                $wasu = 'https://' . $ym . '/live/' . $idns[0] . '.' . $type;
            }
        } else {
            // 处理无法获取hls_url的情况
            // 可以给出默认的错误处理或重定向到其他页面
            // 例如：header('location: error.php');
            // 注意确保在发送header之前没有任何输出
            exit('Error: Unable to get hls_url');
        }
    }
    header('location: ' . $wasu);
    exit;
}
?>
