<?php
error_reporting(0);
$id = isset($_GET['id'])?$_GET['id']:'fhzx';
$fmt = isset($_GET['fmt'])?$_GET['fmt']:'hls';//hls flv
$n = [
  'fhzx' => '7c96b084-60e1-40a9-89c5-682b994fb680',  //资讯台
  'fhzw' => 'f7f48462-9b13-485b-8101-7b54716411ec',  //中文台
  'fhhk' => '15e02d92-1698-416c-af2f-3e9a872b4d78',  //香港台
  ];
$url = "https://m.fengshows.com/api/v3/hub/live/auth-url?live_id={$n[$id]}&live_qa=HD";
$flv = get_headers(json_decode(file_get_contents($url))->data->live_url,1)['Location'];
$arr = [
       '119.176.27.164',
       '153.35.100.175',
       '140.249.28.99',
       '183.201.202.143',
       '60.188.68.36',
       '150.139.157.212',
       '182.242.47.244',
       ];
$ip = $arr[array_rand($arr)];
$flv = preg_replace("/qctv.fengshows.cn/","{$ip}/qctv.fengshows.cn",$flv);
$m3u8 = preg_replace('/.flv/','.m3u8',$flv);

if($fmt == 'flv'){
   header('Location:'.$flv);
   //echo $flv;
   }
if($fmt == 'hls'){
   $burl = "http://qctv.fengshows.cn/live/";
   $cur = preg_replace("/(.*?.ts)/i", $burl."$1",file_get_contents($m3u8));
   $cur = preg_replace("/48-/","72-",$cur);
   header("Content-Type: application/vnd.apple.mpegurl");
   header("Content-Disposition: inline; filename=index.m3u8");
   echo $cur;
}
?>