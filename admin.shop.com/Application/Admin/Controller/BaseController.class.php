<?php
/**
 * Created by PhpStorm.
 * User: zlw
 * Date: 2016/1/7
 * Time: 23:50
 */

namespace Admin\Controller;


use Think\Controller;
header('Content-Type:text/html;charset=utf-8');
abstract class BaseController extends Controller
{
    protected $model;
    public function _initialize(){
        //避免自己定义的时候忘了引用父级的构造函数
        $this->model = D(CONTROLLER_NAME);
    }
    /**
     * 完成展示供应商列表的功能
     */
    public function index()
    {
        //展示供应商的列表,加入分页
        //通过模型里面的方法,进行分页的数据处理,返回$pageMsg
        //关键字查询的时候的符合数据列表
        $keyword=I('get.keyword');
        //if(strstr($keyword,'%')) {
            //dump($keyword);
            //$keyword = urldecode(urldecode(I('get.keyword', '')));
           // dump($keyword);
            //urlencode(I('get.keyword'));
       // }
        $wheres = array();
        if (!empty($keyword)) {
            $wheres['name'] = array('like', "%$keyword%");
        }
        $pageMsg = $this->model->getPageMsg($wheres);
        //设置cookie保存当前的url地址
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        $this->assign('meta_title',$this->meta_title);
        $this->assign($pageMsg);
        $this->display('index');
    }

    /**
     * 完成增加供货商的功能
     */
    public function add()
    {
        if (IS_GET) {
            //表示的是单纯的增加的页面
            $this->assign('meta_title',$this->meta_title);
            $this->_edit_view_before();
            $this->display('edit');
        } else {
            //表示的是添加供应商到数据库里面
            //1.自动验证
            if ($this->model->create()) {
                //表示验证成功,进行添加数据的操作
                if ($this->model->add()) {
                    $this->success('添加成功!', cookie('__forward__'));
                    return;
                }
            }
            $this->error('操作失败!<br/>' . get_error_massage($this->model));
        }
    }

    /**
     * 完成修改供货商信息的功能
     */
    public function edit()
    {
        if (IS_GET) {
            //表示是要展示一个回显了数据的表单
            //根据传入的id得到该条信息的全部内容,回显在模板里
            $row = $this->model->find(I('get.id'));
            $this->assign('meta_title',$this->meta_title);
            $this->assign($row);
            $this->_edit_view_before();
            $this->display('edit');
        } else {
            //表示此时为修改数据到数据库里面的操作
            if ($this->model->create()) {
                if ($this->model->save()) {
                    $this->success('修改成功!', cookie('__forward__'));
                    return;
                }
            }
            $this->error('亲,没有做任何文字修改哦!<br/>'.get_error_massage($this->model));
        }
    }

    /**
     * 完成放入回收站的功能,既是将状态值修改为-1
     */
    public function remove()
    {
        $id = I('get.id');
        $saves['status'] = -1;
        if ($this->model->where(array('id' => $id))->save($saves)) {
            //表示放入回收站成功
            $this->success('放入回收站成功!', cookie('__forward__'));
            return;
        }
        $this->error('放入回收站失败!'.get_error_massage($this->model));
    }

    /**
     * 完成修改状态值,将数据库中的状态值修改为传入的参数值,若没有传入则使用默认值-1完成回收站的功能
     */
    public function changestatus($id, $status = -1)
    {
        if ($this->model->changestatus($id, $status)) {
            $this->success('操作成功!', cookie('__forward__'));
            return;
        }
        $this->error('操作失败!'  .get_error_massage($this->model));
    }

    public function getlist($model)
    {
        //定义排序的原则
        $orders['sort'] = 'asc';
        //查询出status>-1的所有数据
        $wheres['status'] = array('gt', -1);
        return $model->order($orders)->where($wheres)->select();
    }
    protected function _edit_view_before(){
    }
}