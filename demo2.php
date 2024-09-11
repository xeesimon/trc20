<?php
// 引入composer 包
require __DIR__ . '/vendor/autoload.php';
// 引入 test sdk23
use Xeemosion\Xeepush\XeeClient;

$client = new XeeClient("b4d96cff33fa3d6fd39a22f955b266ee");


$data = [
    'order_id' => "20140520" . time(),
    'amount' => '10.00',
    'pay_type' => 'usdt',
    'notify_url' => 'https://tool.adpay.top/prod/pay/tron/notify',
    'redirect_url' => 'https://www.baidu.com',
    'app_id' => '1bx411c7us',
    'user_id' => '100012222222'
];
//$result = $client->idcardIndex($data)->request();

$res = $client->createOrder()
    ->set_order_id("20140520" . time())
    ->set_amount('10.00')
    ->set_pay_type('usdt')
    ->set_notify_url('https://tool.adpay.top/prod/pay/tron/notify')
    ->set_redirect_url('https://www.baidu.com')
    ->set_app_id('1bx411c7us')
    ->set_user_id('100012222222')
    ->request();
if ($res['code'] == 200) {
    $pay_url = $res['data']['pay_url']; //支付地址
    $pay_img = $res['data']['pay_img']; //支付二维码
    //其他参数查看文档
    //跳转到支付也没
    echo $pay_url;
} else {
    echo $res['message'];
}
