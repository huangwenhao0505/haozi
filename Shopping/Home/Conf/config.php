<?php
return array(
	//'配置项'=>'配置值'
    //'配置项'=>'配置值'
    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    
    'url_model'          => '1',            //URL模式
    'session_auto_start' => true, //是否开启session
    'URL_ROUTER_ON'   => true, //开启路由
    
    /* URL设置 */
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    
    'TMPL_CACHE_ON' => false,//禁止模板编译缓存
    'HTML_CACHE_ON' => false,//禁止静态缓存
    
    //数据库配置
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'haozi',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'lzd@#2018', // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'hwh_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 
    
    'alipay_config'=>array (
        //应用ID,您的APPID。
        'app_id' => "",
    
        //商户私钥
        //'merchant_private_key' => "MIIEpgIBAAKCAQEA3K51O4KMboeWRw4EZ39hWxf4YX73eubtO2LZmMauI+6LSVQlvnZnx2vQSjlAdt/1BnczGBXB5jupyuQ4qqCUa4I29LVEcc5MdB4rCAoT92liOvu7a+ctineSgKY15FJZ17/BEXE9xZK6Za5gw+LhQ52epimryMVn1Chbxdt3SvmjUNol8WKCWzmP9D4nW1zsgvnN0W8p6fFMTUsL0l/mk/LnelrEzoLKwposbQapcvoif6ZSUvalJJVNHryj11NcnSV29WWkcdPXbnUnxiCS99yc3EK1CjG197LQVuw5KyM0QleA+LLYaVsL77ofiErAlLsvu9UbNK77GxPH0y5rlwIDAQABAoIBAQCku+5zX/6ou7oojIQpJmNsdrZJQVhIfH326NF6REXWOMntEU2jogvSR98SqS5ADup/yxdvET7PORaEiFzssjZZErknbvEK628S9zo0JCHHfPmBAk1kPQw34w6PzoNIT1kVvuTGunvcMq3GHafKUmDJ8q1taIn9s67QJthrGGsyoUfITmIux2ddbyibOWQhQcxZqhbz7aoB9wLf8OcKobV0nfLzdoV0fM8sk01VYcKQjiOGxZQNziEGrbXk19fhXBNdI/fcrQcJoeRD1eXn7Axcr+stN3UdA1K3q36XKOLhwd3xzmKFNOWzk92sSBXKCFa5RpFRvvyfW5EglXEFyiABAoGBAP+HqApmHuUb9xiP+embjXFk1+2/XGgC2Pl1chmTtzycyA1UpkTM5DByQieWN+ATlzrbleIeXqJ+UzR1CP8QLtHpRDMcjPZB0Wn0jlZg4qebj3yKDjiynH1yRWlF9SAPPNHXFUTAFg5eJ99/wUY3uaX0HCtZWdsQyZRewaB+I+OXAoGBAN0WY7D0snct35uUcJ5wGsMnz4ygwjF6lPm2eUOmIPHvnUPHseuxRgChEBQdh2E8406uSIpPWn0tSt+/c2F/nD527npWmMy2XMyJeUEossmlmeR2UZFoMIhDoPcnXUt6C39GQs8j0f3mBIro8hZ0URea2QvFlDg59OiqbqH4+rgBAoGBAKOrR0XJ3TYQcHeKGJ+5o6Ii3m+Ip25zjHhT8o5RYAdxwG1Rb+IXfn1NYfQrMoTS54Wqilk37JOV6ENsRyPgQKzxBV7bhaphw/lizByll+eVKxWw86T7OmLbY3wnc/dh6ynY4uWTR01Sn6V3Fduc68tRDQ3zACvhl8vx2YGr6d7nAoGBALjQ25t0oq+wIGnNR+uaaTTU1dKIHG4CPAEXgf2EJaw5kyyzBc+yTIOAIJHAMYievqHqXWeJeGqF7z5lq81IQNOS1j5cn7UZiS/OiBdpLzQUBDaQlhVIlLGEX03ckUfkCTJnCLhiCEwH+aopmx4cNCHYZzJJA2ORR2Mr/fnWybgBAoGBALcy3Nd0rFj++kU6aij+PonpDaw5Iv4yZFo3O6hpiU+4XdBnkdQt+BusWeOl+u2ZNUzl7ZxacG+VqOOSXoq5bPpHQIyZ7CGxSFsNukhiIxrfzCSmTbzZIB+25rm2l19gbTvksIoscPskoXB8Sfm1gJJf9+bxF+6WJUbzAdYNiTyb",
        'merchant_private_key' => "",
        
        //异步通知地址
        //'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
        'notify_url'  => "",
    
        //同步跳转
        'return_url' => "",
    
        //编码格式
        'charset' => "UTF-8",
    
        //签名方式
        'sign_type'=>"RSA2",
    
        //支付宝网关
        //'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
        'getewayUrl'  => "https://openapi.alipaydev.com/gateway.do",
    
        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        //'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsJpDhqRvxXMwklSOp+TlQU9PKrNRFQGmp6a45sxmTMC31lRtOFNeTDLshbTyERiKt2cvaeVlihRm32NHQNH+qpScl6NzcuUMYUqrwL5oqC+X103d//tkKLAAscgpOKgetBz/miHvWO/xrG7FzYUwnCGzF9yvS4V82GQ7Z8y7RCr/bRozeLMxjYBEWEHYDQWvGgupSVk0dESWFhn+bEzbGW/fGH29DFodt0F9UVtOMJ4rCfvhgouteS5EzwoR4nqune5GwaikDcUH/oi0WIfz7r7U9p83Fb/JHMULdF6J35JZVfQWveqLAYjsmQHk7Z1GiARo7evMpIHUS0K6k0SsnwIDAQAB",
        'alipay_public_key' => "",
        
    ),
    
);