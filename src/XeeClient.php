<?php

namespace Xeemosion\Xeepush;



class XeeClient
{
    protected $appCode;


    public function __construct($appCode)
    {
        $this->appCode = $appCode;
    }
    public function __call($method, $args)
    {
        $request = new Request($this, $method);
        return $request->withArgs($args);
    }
    public function __get($name)
    {
        return $this->appCode;
    }
}
