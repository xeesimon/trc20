<?php

namespace Xeemosion\Xeepush;

use Xeemosion\Xeepush\Guzzle;

class Request
{
    protected $client;
    protected $method;
    protected $args;
    //https://api.adpay.top/prod/push/
    protected $endpoint = "https://api.adpay.top/prod/push/";


    public function __construct(XeeClient $client, $method)
    {
        $this->client = $client;
        $this->method = $method;
    }

    public function withArgs($args)
    {
        if (is_array($args) && count($args) == 1) {
            $this->args = $args[0];
        }
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

    public function request(array $option = [])
    {
        $options = [
            'json' => $this->args,
            'headers' => [
                'xeeAppCode' => $this->client->appCode,
                'xeeAppAgent'    => "XeeClient",
            ],
        ];
        $options = array_replace_recursive($options, $option);
        $res = Guzzle::post($this->endpoint . $this->method, $this->args, $options);
        return $res;
    }
}
