<?php
// 引入composer 包
require __DIR__ . '/vendor/autoload.php';
// 引入 test sdk23
use Xeemosion\Xeepush\XeeClient;

//c7da6cc79fb6f1bb54ff11575e727ee1
$client = new XeeClient("c7da6cc79fb6f1bb54ff11575e727ee1");


$data = [
    'order_id' => "20140520" . time(),
    'amount' => '10.00',
    'pay_type' => 'usdt',
    'notify_url' => 'https://tool.adpay.top/prod/pay/tron/notify',
    'redirect_url' => 'https://www.baidu.com',
    'app_id' => '1bx411c7us',
    'user_id' => '100012222222'
];

$res = $client->createOrder($data)->request();
print_r($res);


// $res = $client->createOrder()
//     ->set_order_id("20140520" . time())
//     ->set_amount('10.00')
//     ->set_pay_type('usdt')
//     ->set_notify_url('https://tool.adpay.top/prod/pay/tron/notify')
//     ->set_redirect_url('https://www.baidu.com')
//     ->set_app_id('1bx411c7us')
//     ->set_user_id('100012222222')
//     ->request();
// //推送成功后返回的数据
// print_r($res);



// $res = $client->Telegram()
//     ->set_channel_id("2")
//     ->set_title("推送到Telegram2")
//     ->set_push_data('推送的内容是hello world23333222222 啦啦啦啦')
//     ->request();
// print_r($res);

//推送成功后返回的数据
