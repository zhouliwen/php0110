<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '127.0.0.1', // 服务器地址
    'DB_NAME'                => 'shop', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => '123456', // 密码
    'TMPL_PARSE_STRING'=>array(
        '__CSS__'=>__URL_PATH__.'Public/Admin/css',
        '__JS__'=>__URL_PATH__.'Public/Admin/js',
        '__IMG__'=>__URL_PATH__.'Public/Admin/images',
        '__LAYER__'=>__URL_PATH__.'Public/Admin/layer/layer.js',
        '__UPLOADIFY__'=>__URL_PATH__.'Public/Admin/uploadify',
        '__UEDITOR__'=>__URL_PATH__.'Public/Admin/ueditor',
        '__TREEGRID__'=>__URL_PATH__.'Public/Admin/treegrid',
        '__ZTREE__'=>__URL_PATH__.'Public/Admin/zTree',
        //'__BRAND__'=>'http://brand-logo.b0.upaiyun.com/', //代表brand_logo空间的域名
        '__BRAND__'=>'http://hello-girl.b0.upaiyun.com/', //代表brand_logo空间的域名
    ),
    'PAGE_SIZE'=>2,
);