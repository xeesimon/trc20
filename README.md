## 使用须知
- 文档地址 [www.adpay.top](https://www.adpay.top/)
- 去平台注册 app_id  [https://tool.adpay.top/](https://tool.adpay.top/)

## 消息推送平台您只需要调用一次接口，即可将消息推送至这些应用
- 支持 微信
- 支持 钉钉
- 支持 飞书
- 支持 微信测试号
- 支持 企业微信
- 支持 邮件
- 支持 Slack
- 支持 Telegram
- 支持 Discord 
- 支持 usdt 支付回调


### 调用方式一


```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("b4d96cff33fa3d6fd39a22f955b266ee");

$data = [
    'title' => "推送到Telegram", ,
    'push_data' => "
📦 <b>新订单通知</b> 📦
📝 交易号:%s
📝 订单号:<code>%s</code> 👈 <b>点击复制</b>
💰 支付金额:%.2f CNY
📈 实际支付金额：%.2f %s
📊 钱包地址：<code>%s</code>
🕰️ 订单创建时间：%s
🕰️ 支付成功时间：%s
",];
$result = $client->Telegram($data)->request();
if ($res['code'] != 200) {
    //返回错误信息
    return $res['message'];
} 
//推送成功后返回的数据
print_r($res['data']);
```


### 调用方式二


```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("b4d96cff33fa3d6fd39a22f955b266ee");

$res = $client->Telegram()
    ->set_title("推送到Telegram")
    ->set_push_data('推送的内容是hello world')
    ->request();
if ($res['code'] != 200) {
    //返回错误信息
    return $res['message'];
} 
//推送成功后返回的数据
print_r($res['data']);

```



### usdt支付回调

```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("b4d96cff33fa3d6fd39a22f955b266ee");

$res = $client->createOrder()
    ->set_order_id("20140520" . time())
    ->set_amount('10.00')
    ->set_pay_type('usdt')
    ->set_notify_url('https://tool.adpay.top/prod/pay/tron/notify')
    ->set_redirect_url('https://www.baidu.com')
    ->set_app_id('1bx411c7us')
    ->set_user_id('100012222222')
    ->request();
if ($res['code'] != 200) {
    //返回错误信息
    return $res['message'];
} 
//推送成功后返回的数据
print_r($res['data']);


```




| 白色模式                                                          | 黑色模式                                                          |
| ----------------------------------------------------------------- | ----------------------------------------------------------------- |
| ![图 0](https://imgs3.adpay.top/doc/2024-08-28-11-40-4738963.png) | ![图 1](https://imgs3.adpay.top/doc/2024-08-28-11-44-0840877.png) |
| ![图 2](https://imgs3.adpay.top/doc/2024-08-28-11-48-2905514.png) | ![图 3](https://imgs3.adpay.top/doc/2024-08-28-11-49-0977992.png) |



