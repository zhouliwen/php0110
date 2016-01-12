<?php
/**
 * Created by PhpStorm.
 * User: zlw
 * Date: 2016/1/12
 * Time: 21:36
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{
    //完成公共的上传的功能
    public function index(){
        $dir = I('post.dir');
        //echo $dir;
        $config = array(
            'rootPath'     => './Uploads/', //保存根路径
            'savePath'     => $dir."/", //保存路径
            'driver'       => '', // 文件上传驱动
            'driverConfig' => array(), // 上传驱动配置
        );
        $upload = new Upload($config);
        $result = $upload->uploadOne($_FILES['Filedata']);
        if($result){
            echo $result['savepath'].$result['savename'];
        }else{
            echo $upload->getError();
        }
    }

}