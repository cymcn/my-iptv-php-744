<?php
namespace LiveUrls;

class Douyu {
    private $Rid;
    private $Stream_type;
    private $Cdn_type;

    public function __construct($Rid, $Stream_type, $Cdn_type) {
        $this->Rid = $Rid;
        $this->Stream_type = $Stream_type;
        $this->Cdn_type = $Cdn_type;
    }

    private function md5V3($str) {
        return md5($str);
    }

    private function getDid() {
        $client = new \GuzzleHttp\Client();
        $timeStamp = round(microtime(true) * 1000);
        $url = "https://passport.douyu.com/lapi/did/api/get?client_id=25&_=" . $timeStamp . "&callback=axiosJsonpCallback1";
        $response = $client->get($url, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Mobile/15E148 Safari/604.1',
                'Referer' => 'https://m.douyu.com/'
            ]
        ]);
        $body = $response->getBody();
        $match = [];
        preg_match('/axiosJsonpCallback1\((.*)\)/', $body, $match);
        $result = json_decode($match[1], true);
        return $result['data']['did'];
    }

    public function getRealUrl() {
        $did = $this->getDid();
        $timestamp = time();
        $liveurl = "https://m.douyu.com/" . $this->Rid;
        $client = new \GuzzleHttp\Client();
        $response = $client->get($liveurl, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Mobile/15E148 Safari/604.1',
                'Upgrade-Insecure-Requests' => '1'
            ]
        ]);
        $body = $response->getBody();
        $roomidreg = '/(?i)rid":(\d{1,8}),"vipId/';
        preg_match($roomidreg, $body, $roomidres);
        if (empty($roomidres)) {
            return null;
        }
        $realroomid = $roomidres[1];
        $reg = '/(?i)(function ub98484234.*)\s(var.*)/';
        preg_match($reg, $body, $res);
        $nreg = '/(?i)eval.*;}/';
        $strfn = preg_replace($nreg, 'strc;}', $res[0]);
        $vm = new \V8Js();
        $vm->executeString($strfn);
        $jsfn = $vm->executeString('ub98484234');
        if (!is_callable($jsfn)) {
            throw new \Exception("这不是一个函数");
        }
        $result = $jsfn("ub98484234");
        $nres = sprintf("%s", $result);
        $nnreg = '/(?i)v=(\d+)/';
        preg_match($nnreg, $nres, $nnres);
        $unrb = $realroomid . $did . $timestamp . $nnres[1];
        $rb = $this->md5V3($unrb);
        $nnnreg = '/(?i)return rt;}\);?/';
        $strfn2 = preg_replace($nnnreg, 'return rt;}', $nres);
        $strfn3 = str_replace('(function (', 'function sign(', $strfn2);
        $strfn4 = str_replace('CryptoJS.MD5(cb).toString()', '"' . $rb . '"', $strfn3);
        $vm2 = new \V8Js();
        $vm2->executeString($strfn4);
        $jsfn2 = $vm2->executeString('sign');
        if (!is_callable($jsfn2)) {
            throw new \Exception("这不是一个函数");
        }
        $result2 = $jsfn2($realroomid, $did, $timestamp);
        $param = sprintf("%s", $result2);
        $realparam = $param . "&ver=22107261&rid=" . $realroomid . "&rate=-1";
        $r1 = $client->post("https://m.douyu.com/api/room/ratestream", [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.3 Mobile/15E148 Safari/604.1'
            ],
            'form_params' => $realparam
        ]);
        $body1 = $r1->getBody();
        $s1 = json_decode($body1, true);
        $hls_url = "";
        foreach ($s1 as $k => $v) {
            if ($k === "code") {
                if ($s1[$k] !== 0) {
                    return null;
                }
            }
            if (is_array($v)) {
                foreach ($v as $k => $v) {
                    if ($k === "url") {
                        if (is_string($v)) {
                            $hls_url = $v;
                        }
                    }
                }
            }
        }
        $n4reg = '/(?i)(\d{1,8}[0-9a-zA-Z]+)_?\d{0,4}(.m3u8|\/playlist)/';
        preg_match($n4reg, $hls_url, $houzhui);
        $real_url = "";
        $flv_url = "http://" . $this->Cdn_type
