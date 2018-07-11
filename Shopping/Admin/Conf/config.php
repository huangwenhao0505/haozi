<?php
return array(
	//'配置项'=>'配置值'
    //'配置项'=>'配置值'
    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
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
    
);