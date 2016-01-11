<?php
/**
 * Created by PhpStorm.
 * User: zlw
 * Date: 2016/1/10
 * Time: 23:00
 */

namespace Admin\Controller;


use Think\Controller;

/**
 * 完成自动生成控制器和模型的功能
 * Class GiiController
 * @package Admin\Controller
 */
class GiiController extends Controller
{
    public function index(){
        if(IS_GET){
            $this->assign('meta_title','数据表名');
            $this->display('edit');
        }else{
            //表示此刻为提交表单,提交数据表的名字
            $table_name = I('post.name');
            //将数据表的名字转化为控制器前缀的规范样子
            $name = parse_name($table_name,1);
            //得到数据表对应的表的简介
            $sql = "SELECT TABLE_COMMENT FROM information_schema.`TABLES` WHERE TABLE_SCHEMA='".C('DB_NAME')."' AND TABLE_NAME='$table_name'";
            $model = M();
            $data = $model->query($sql);
            $meta_title = $data[0]['table_comment'];
            defined('TPL_PATH') or define('TPL_PATH',ROOT_PATH.'Template/');
            //加载控制器的模板
            require TPL_PATH.'Controller.tpl';
            $contents = "<?php \r\n".ob_get_clean();
            //将抓取到的内容生成对应的控制器文件
            $controller_path = APP_PATH.'Admin/Controller/'.$name.'Controller.class.php';
            file_put_contents($controller_path,$contents);
            //重新开启ob缓存
            ob_start();
            //紧接着可以让他同理的生成对应的模型文件
            $sql = "show full columns from $table_name";
            $fields = $model->query($sql);
            require TPL_PATH.'Model.tpl';
            $model_contents = "<?php \r\n".ob_get_clean();
            $model_path = APP_PATH.'Admin/Model/'.$name.'Model.class.php';
            file_put_contents($model_path,$model_contents);
            $this->success('成功生成!');
        }
    }

}