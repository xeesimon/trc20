<?php

namespace Xeemosion\Xeepush;

use Xeemosion\Xeepush\Guzzle;

class Request
{
    protected $client;
    protected $method;
    protected $args;

    protected $endpoint = "https://tool.adpay.top/prod/push/";


    public function __construct(XeeClient $client, $method)
    {
        $this->client = $client;
        $this->method = $method;
    }

    public function withArgs($args)
    {
        $this->args = $args;
        return $this;
    }

    public function __call($method, $args)
    {
        if (strpos($method, 'set_') === 0) {
            $paramName = mb_strcut($method, 4);
            //$paramName = $this->method == 'createOrder' ? static::snake($paramName) : static::camel($paramName);
            $this->args[$paramName] = $args[0];
            return $this;
        }
    }

    public function request()
    {
        if ($this->method == 'createOrder') {
            $this->args['sign'] = static::getSign($this->args, $this->client->appCode);
        }
        $options = [
            'json' => $this->args,
            'headers' => [
                'AppCode' => $this->client->appCode,
            ],
        ];

        $res = Guzzle::post($this->endpoint . $this->method, $this->args, $options);
        return $res;
    }

    /**
     * 下单计算签名
     *
     * @return string
     */

    public static function getSign(array $data, string $signKey)
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
