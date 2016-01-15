<?php
/**
 * Created by PhpStorm.
 * User: zlw
 * Date: 2016/1/8
 * Time: 9:19
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

abstract class BaseModel extends Model
{
    //必须开启批量验证
    protected $patchValidate = true;
    public function getPageMsg($wheres = array())
    {
        if(array_key_exists('name',$wheres)){
            $wheres['name'][1] = urldecode($wheres['name'][1]);
        }
        //得到status>-1的所有数据的总条数
        if(in_array('status',$this->getDbFields())){
            $wheres['status'] = array('gt', -1);
        }
        $count = $this->where($wheres)->count();
        //实例化分页类
        $pagesize = C('PAGE_SIZE') or 5;
        $Page = new Page($count, $pagesize);
        //设置分页条的格式,若总数据条数小于每页的条数,则不需要该工具条
        if ($Page->totalRows > $Page->listRows) {
            //$Page->setConfig('header', '<span>共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</span>');
            $Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        }
        foreach($Page->parameter as $key=>$val) {
            $Page->parameter[$key]   = urldecode($val);//如果你要模糊查询中文的话，要把urlencode()去掉
        }
        $pagehtml = $Page->show();
        //为了删除数据的时候,那一页没有数据,应该跳回前一页
        if($Page->firstRow >= $Page->totalRows){
            $_GET['p'] =$Page->totalPages;
            $Page = new Page($count, $pagesize,array('p',$_GET['p']));
            $pagehtml = $Page->show();
        }
        //定义排序的原则
        $orders = array();
        if(in_array('sort',$this->getDbFields())){
            $orders['sort'] = 'asc';
        }

        //得到要展示到列表的数据
        $pagelist = $this->where($wheres)->order($orders)->limit($Page->firstRow, $Page->listRows)->select();
        //将$pagehtml 和 $pagelist放入一个数组中,返回
        return $pageMsg = array('pagehtml' => $pagehtml, 'rows' => $pagelist);
    }
    public function changestatus($id, $status)
    {
        $data = array( 'status' => $status);
        $data['id'] = array('in',$id);
        if ($status == -1) {
            //表示的是此时是放入回收站,给供货商的名字加一个后缀
            $data['name'] = array('exp', "concat(name,'_del')");
        }
        return parent::save($data);
    }
}