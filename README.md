## 使用须知
- 文档地址 [www.adpay.top](https://www.adpay.top/)
- 去平台注册 app_id  [https://tool.adpay.top/](https://tool.adpay.top/)

## 功能介绍
- 支付 trx,usdt
- 自动汇率转换
- 无需轮询查询支付结果,支付后自动推送通知
- 支持多语言
- 支持多种皮肤
- 支持自定义页面
- 可二次开发定制


### javascript 调用

```JavaScript
    <div id="usdt_html"></div>
    <script src="https://tool.adpay.top/prod/js"></script>
    <script>
        $(document).ready(function() {
            usdt.post({
                order_id: "201405201724111872", //订单号
                amount: "10.00", //金额保留 2 位小数
                pay_type: "usdt", //支付方式,usdt/trx
                notify_url: "https://tool.adpay.top/prod/pay/tron/notify", //回调地址
                redirect_url: "https://www.baidu.com", //支付成功后返回的地址
                app_id: "888810001", //填写网站生成的app_id
                user_id: "100012222222", //支付客户的 user_id
                sign: "5e118256b5c30dda4211575581a3d300", //签名
                callback: function(res) {
                    //获取二维码后显示的函数
                    console.log(res);
                },
                success: function(data) {
                    //支付成功后的函数
                    console.log(data);
                    alert("支付成功");
                    window.location.href = data.redirect_url;
                },
            });
        });
    </script>
```


### php 调用

> composer require xeemosion/xeepush   安装插件

```php
use Xeemosion\Xeepush\CreateUsdtOrder;

$signKey = "b4d96cff33fa3d6fd39a22f955b266ee"; //你的密钥
$data = [
    'order_id' => "20140520" . time(),
    'amount' => '10.00',
    'pay_type' => 'usdt',
    'notify_url' => 'https://tool.adpay.top/prod/pay/tron/notify',
    'redirect_url' => 'https://www.baidu.com',
    'app_id' => '888810001',
    'user_id' => '100012222222'
];
$res = CreateUsdtOrder::instance($signKey)->post($data);
if ($res['code'] == 200) {
    $pay_url = $res['data']['pay_url']; //支付地址
    $pay_img = $res['data']['pay_img']; //支付二维码
    //其他参数查看文档
    //跳转到支付也没
    echo $pay_url;
} else {
    echo $res['message'];
}

```



| 白色模式                                                          | 黑色模式                                                          |
| ----------------------------------------------------------------- | ----------------------------------------------------------------- |
| ![图 0](https://imgs3.adpay.top/doc/2024-08-28-11-40-4738963.png) | ![图 1](https://imgs3.adpay.top/doc/2024-08-28-11-44-0840877.png) |
| ![图 2](https://imgs3.adpay.top/doc/2024-08-28-11-48-2905514.png) | ![图 3](https://imgs3.adpay.top/doc/2024-08-28-11-49-0977992.png) |



