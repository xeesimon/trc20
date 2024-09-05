<?php

namespace Xeemosion\Xeepush;

use Xeemosion\Xeepush\Guzzle;

/**
 * Class GuzzleClient
 * @package App\Utils
 */
class CreateUsdtOrder
{


    const DEFAULT_CREATE_URL = 'https://tool.adpay.top/prod/pay/tron/create';
    public $signKey;
    public $url = '';
    public function __construct($signKey, $url = self::DEFAULT_CREATE_URL)
    {
        if (!empty($url)) {
            $this->url = $url;
        }
        $this->signKey = $signKey;
    }

    public static function instance(string $signKey, string $url = self::DEFAULT_CREATE_URL): self
    {
        return new self($signKey, $url);
    }


    public  function post(array $data = [])
    {
        $data['sign'] = $this->getSign($data, $this->signKey);
        $res = Guzzle::post($this->url, $data);
        return $res;
    }

    public  function getSign(array $data, string $signKey)
    {
        $signFields = ['order_id', 'amount', 'app_id', 'user_id', 'pay_type', 'notify_url'];
        $signData = array_intersect_key($data, array_flip($signFields));
        ksort($signData);
        $str = '';
        foreach ($signData as $key => $value) {
            $str .= $key . '=' . $value . '&';
        }
        $str = $str . $key;
        $str = $str . "&key=" . $signKey;
        //echo $str;
        return strtolower(md5($str));
    }
}
