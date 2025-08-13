## 使用须知
- 文档地址 [doc.adpay.top](https://doc.adpay.top/)
- 去平台注册 app_id  [https://home.adpay.top/](https://home.adpay.top/)



## [usdt 支付 sdk 点击这里](#trc-支付功能介绍)




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

#### 使用步骤
> - 1.在平台注册,获取xeeAppCode
> - 2.安装 composer require xeemosion/xeepush 
> - 3.调用接口


#### 安装
> composer require xeemosion/xeepush 

### 调用方式一


```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("你的 appcode");

$data = [
    'channel_id' => "你的通道 id",
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
$client = new XeeClient("你的 appcode");

$res = $client->Telegram()
    ->set_channel_id("通道 id")
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




### 推送到邮件email


```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("你的 appcode");

$res = $client->email()
    ->set_channel_id("通道 id")
    ->set_title("标题")
    ->set_push_data('推送的内容是hello world')
    ->request();
if ($res['code'] != 200) {
    //返回错误信息
    return $res['message'];
} 
//推送成功后返回的数据
print_r($res['data']);
```


### 推送到钉钉dingTalk


```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("你的 appcode");

$res = $client->dingTalk()
    ->set_channel_id("通道 id")
    ->set_title("标题")
    ->set_push_data('推送的内容是hello world')
    ->request();
if ($res['code'] != 200) {
    //返回错误信息
    return $res['message'];
} 
//推送成功后返回的数据
print_r($res['data']);
```


### 推送到企业微信wechatCom


```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("你的 appcode");

$res = $client->wechatCom()
    ->set_channel_id("通道 id")
    ->set_title("标题")
    ->set_push_data('推送的内容是hello world')
    ->request();
if ($res['code'] != 200) {
    //返回错误信息
    return $res['message'];
} 
//推送成功后返回的数据
print_r($res['data']);
```

### 推送到Telegram


```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("你的 appcode");

$res = $client->Telegram()
    ->set_channel_id("通道 id")
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


| ---                                                               | --                                                                |
| ----------------------------------------------------------------- | ----------------------------------------------------------------- |
| ![图 0](https://imgs3.adpay.top/doc/2024-09-20-14-50-2002443.png) | ![图 1](https://imgs3.adpay.top/doc/2024-09-20-14-51-2580584.png) |



---


## trc 支付功能介绍
- 支付 trx,usdt
- 自动汇率转换
- 无需轮询查询支付结果,支付后自动推送通知
- 支持多语言
- 支持多种皮肤
- 支持自定义页面
- 可二次开发定制





### 后端调用
> 安装 composer require xeemosion/xeepush 

```php
use Xeemosion\Xeepush\XeeClient;
$client = new XeeClient("你的 appcode");

$res = $client->createOrder()
    ->set_order_id("20140520" . time())
    ->set_amount('10.00')
    ->set_pay_type('usdt')
    ->set_notify_url('https://api.ipv6e.com/prod/pay/tron/notify')
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


### 前端调用

```javascript
<div id="usdt_html"></div>
<script src="https://api.ipv6e.com/prod/js"></script>
<script>
    $(document).ready(function() {
        usdt.post({
            order_id: "201405201724111872", //订单号
            amount: "10.00", //金额保留 2 位小数
            pay_type: "usdt", //支付方式,usdt/trx
            notify_url: "https://api.ipv6e.com/prod/pay/tron/notify", //回调地址
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

| 白色模式                                                          | 黑色模式                                                          |
| ----------------------------------------------------------------- | ----------------------------------------------------------------- |
| ![图 0](https://imgs3.adpay.top/doc/2024-08-28-11-40-4738963.png) | ![图 1](https://imgs3.adpay.top/doc/2024-08-28-11-44-0840877.png) |
| ![图 2](https://imgs3.adpay.top/doc/2024-08-28-11-48-2905514.png) | ![图 3](https://imgs3.adpay.top/doc/2024-08-28-11-49-0977992.png) |



