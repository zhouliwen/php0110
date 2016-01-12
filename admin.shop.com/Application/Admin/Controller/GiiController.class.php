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
            //紧接着可以让他同理的生成对应的模型文件
            $sql = "show full columns from $table_name";
            $fields = $model->query($sql);
            foreach($fields as $key=>&$field){
                if($field['field'] == 'id'){
                    unset($fields[$key]);//为id代表为主键，删除这个索引就代表删除掉id的信息
                }
                //1.从注释中提取出元素的名字
                $comment = $field['comment'];
                //若原来的注释里面包含@，则从@往前截取出正确的注释放在数组里面，若无，则不发生改变
                $field['comment'] = strpos($comment,'@')?strstr($comment,'@',true):$comment;
                //2.从注释里面取出表单的类型
                preg_match("/@([a-z]+)\|?(.*)/",$comment,$res);
                if(!empty($res)){
                    $field['field_type'] = $res[1];
                    if(!empty($res[2])){
                        parse_str($res[2],$data);
                        $field['redio_val'] = $data;
                    }
                }
            }
            unset($field);
//            dump($fields);
//exit;
            //重新开启ob缓存
            ob_start();
            //自动生成模型
            require TPL_PATH.'Model.tpl';
            $model_contents = "<?php \r\n".ob_get_clean();
            $model_path = APP_PATH.'Admin/Model/'.$name.'Model.class.php';
            file_put_contents($model_path,$model_contents);
            //自动生成编辑或添加的模板
            $view_path = APP_PATH.'Admin/View/'.$name;
            if(!is_dir($view_path)){
                mkdir($view_path);
            }
            ob_start();
            require TPL_PATH.'edit.tpl';
            $edit_content = ob_get_clean();
            file_put_contents($view_path.'/edit.html',$edit_content);
            //自动生成列表模板
            $index_path = $view_path.'/index.html';
            ob_start();
            require TPL_PATH.'index.tpl';
            $index_contents = ob_get_clean();
            file_put_contents($index_path,$index_contents);

            $this->success('成功生成!',U('index'));
        }
    }

}