<?php

namespace Xeemosion\Xeepush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class GuzzleClient
 * @package App\Utils
 */
class Guzzle
{
    /**
     * 发送 HTTP 请求
     *
     * @param string $url 请求 URL
     * @param string $method 请求方法
     * @param array $options 请求选项
     * @return mixed|null
     * @throws RequestException
     */
    private static function sendRequest(string $url, string $method, array $options = []): mixed
    {
        $client = new Client();
        //设置请求超时时间为 3 分钟
        if (!isset($options['timeout'])) {
            $options['timeout'] = 60;
        }
        try {
            $response = $client->request($method, $url, $options);
            $val = json_decode((string) $response->getBody(), true);
            if (!$val || !is_array($val) || empty($val)) {
                $val = (string) $response->getBody();
            }
            return $val;
        } catch (RequestException $e) {
            //记录错误日志
            throw $e;
        }
    }

    /**
     * 构造请求选项
     *
     * @param array $data 数据
     * @param string $method 请求方法
     * @param array $headers HTTP 头部信息
     * @return array
     */
    private static function buildOptions(string $method, array $data = [], array $options = []): array
    {

        $options_defalut['headers']['Content-Type'] = 'application/json';
        if ($method === 'GET') {
            $options_defalut['query'] = $data;
        } else {
            $options_defalut['form_params'] = $data;
            $options_defalut['json'] = $data;
        }
        $options = array_replace_recursive($options_defalut, $options);
        return $options;
    }

    /**
     * 发送 GET 请求
     *
     * @param string $url 请求 URL
     * @param array $query_params 查询参数
     * @param array $headers HTTP 头部信息
     * @return mixed|null
     * @throws RequestException
     */
    public static function get(string $url, array $query_params = [], array $option = []): mixed
    {
        $urlParams = [];
        if (strpos($url, '?') !== false) {
            parse_str(substr($url, strpos($url, '?') + 1), $urlParams);
        }
        $mergedParams = array_merge($urlParams, $query_params);
        $options = self::buildOptions('GET', $mergedParams, $option);
        return self::sendRequest($url, 'GET', $options);
    }

    /**
     * 发送 POST 请求
     *
     * @param string $url 请求 URL
     * @param array $data POST 数据
     * @param array $headers HTTP 头部信息
     * @return mixed|null
     * @throws RequestException
     */
    public static function post(string $url, array $data = [], array $option = []): mixed
    {
        $options = self::buildOptions('POST', $data,  $option);
        return self::sendRequest($url, 'POST', $options);
    }
}
