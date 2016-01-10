<?php
header('Content-Type:text/html;charset=utf-8');
//检测php的版本,若是低于5.3直接退出
version_compare(PHP_VERSION,'5.3','>') or exit('版本太low');
//定义项目的根目录常量
define('ROOT_PATH',dirname($_SERVER['SCRIPT_FILENAME']).'/');
//定义框架目录(因为ROOT_PATH指的是admin.shop.com文件夹下面的,
//而ThinkPHP和admin.shop.com同级,所以要找上一级的目录,末尾没有/)
define('THINK_PATH',dirname(ROOT_PATH).'/ThinkPHP/');
//定义应用目录
define('APP_PATH',ROOT_PATH.'Application/');
//定义运行文件的生成位置目录
define('RUNTIME_PATH',ROOT_PATH.'Runtime/');
//设置是否开启调试
define('APP_DEBUG',true);
//绑定指定的模块
//define('BIND_MODULE','Admin');
//加载框架模块
require THINK_PATH.'ThinkPHP.php';