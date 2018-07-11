<?php
return array(
    
    //支付宝配置文件
	'alipay_config' => array (	
		//应用ID,您的APPID。
		'app_id' => "2016082000294938",

		//商户私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAwdh705+eep4E9J+RByJr8KLtXd4TGydIKiaSDzh8qaysQ+pPwxRfIhyPV3va+SzxXzieIUIeDe6tkuG7H/tJ3PPy0tJA/oZ3qfhINxEs0TAhXHiYFWFFn/tE+ZkCTQazkWeTAXun+wLQg4kcb+AqvTS2VVTDE+JjoiFmogQ3j/NIVbYuyuCHbhqqjXeNIl4IGp2sw/VNAAaQE/w75rq+ET1SprrvaHk6PgMq/6DKbpYH2Pz2Oo8+qLxXKE5d/A7eVP6yJ0cMNId4hWAPUZNuGGyvjZgOi8rd/FUKvKZHMq1ct50SYlYM16UN+UwYeKhkG/AXMiY0vBeg3vQ5yVdvyQIDAQABAoIBAFxIk6rL8satM+7BiGm9GWYWKqrlbnMe4FwwwJg+bBra+afbhN16dU/oCNW9QSIfI0oRyjZLI8O+PSQQEuXG3AM0oAV90zNZEN76NGcC5jMwlrFPOBf1lw/yr4OkNFQ3PIWcqX+rPu1hCaOVQtSAA9jPn35APB7bSFOHUzUOjOUaN/QkgG/KB3aDJSEUfNDM6x3FT6a3C74oLeveJX/a5O3ECCG5sCk9UWix9K5wYvX4YKQVKErnY8iNqtgT2KG0WZ+0anAS+SpoVPD7nr3/Vromay+JXmP2nuLscdrkD1BkR2640b0ngHGKMR8sJtpjTaXxEy1oMunlv3pXj1wdsAECgYEA9EBTWnnw+MSlq42tPJ5ZLUStbYkzd6OvY8UbEvsqRGAljPHovtKgGLn20PGbrf6CsI9obLvser9aB0rH3C3NxnEtx2cWRxLvf4B7cJqXOf2NVQ6hfYkfj7A8ie/Q8KoZ/HPOP6a9Cx29ZKMm63edQnqpd2SH1H7HhesWxVqHYPECgYEAyyt4dA0bvWTXOxd5MxCsZ3t7S7viPWy39cr5LFmTUwYXEUcN6FsvjvSpH8MlyfDFLIS9qHoLJTEu8+u28b5k1yJ0Jg2rDJH1c23IZYc22Qx0cjWKA2EFFFLUVBqilFSwlnWxaYbgtNoc8K1WwD+2hRDgR9tPV20o6AOxQ7JyfFkCgYAaFbCRLgqtFps2ygehPKv7aKU42Hk1orZ9ajRs/4PRD4+TENaxYl8UpO+V+ueMWmzsnDQjwKINrdfYhYT4n6+lLLsd24WGi6AmNrt4GBpkaA6q8cgPVxCW0NR2SrU+rnvd+SQiqhTwVfm/AKmMZhbWXbExffv/lpaKV8PzyapBkQKBgQC3j9MIpz9E4vNDRHYQmSPrazl+t4Y1ESE0RerTEyt0e7AjwBrksF5Lvul+9QYTaiH7kwL4USv4snNFltZ3nBnn9g0SxI6ikM0/ORUyBfScLhCXj5/eZa39KskEI/x4H/xcNIHSYjZrsBUtrq8Oi4IQv6qjwZXx24J1/cAO9g9SIQKBgFG26z6T8L7Q7ulFbeMhVOuMbu99wXE2UrIcPkeZCVLY4wHp+OLSb4+WqLhOofxRqET23jCshrO/dhjvDZVm5dXhEVbOBksrVlCD0TpPPcEna4+7T2aVglxHO2pIEdKMkkQOPVkfyi1oL7O28GjStO7DGrjcd6AOTB1Vlj5bwcva",
		
		//异步通知地址
		'notify_url' => "http://haozi.com.cn/alipay.php/home/pay/notify_url",
		
		//同步跳转
		'return_url' => "http://haozi.com.cn/alipay.php/home/pay/return_url",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		//'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwdh705+eep4E9J+RByJr8KLtXd4TGydIKiaSDzh8qaysQ+pPwxRfIhyPV3va+SzxXzieIUIeDe6tkuG7H/tJ3PPy0tJA/oZ3qfhINxEs0TAhXHiYFWFFn/tE+ZkCTQazkWeTAXun+wLQg4kcb+AqvTS2VVTDE+JjoiFmogQ3j/NIVbYuyuCHbhqqjXeNIl4IGp2sw/VNAAaQE/w75rq+ET1SprrvaHk6PgMq/6DKbpYH2Pz2Oo8+qLxXKE5d/A7eVP6yJ0cMNId4hWAPUZNuGGyvjZgOi8rd/FUKvKZHMq1ct50SYlYM16UN+UwYeKhkG/AXMiY0vBeg3vQ5yVdvyQIDAQAB",
        'alipay_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsJpDhqRvxXMwklSOp+TlQU9PKrNRFQGmp6a45sxmTMC31lRtOFNeTDLshbTyERiKt2cvaeVlihRm32NHQNH+qpScl6NzcuUMYUqrwL5oqC+X103d//tkKLAAscgpOKgetBz/miHvWO/xrG7FzYUwnCGzF9yvS4V82GQ7Z8y7RCr/bRozeLMxjYBEWEHYDQWvGgupSVk0dESWFhn+bEzbGW/fGH29DFodt0F9UVtOMJ4rCfvhgouteS5EzwoR4nqune5GwaikDcUH/oi0WIfz7r7U9p83Fb/JHMULdF6J35JZVfQWveqLAYjsmQHk7Z1GiARo7evMpIHUS0K6k0SsnwIDAQAB',
	),
);