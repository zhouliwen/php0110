<?php 
namespace Admin\Controller;
class GoodsCategoryController extends BaseController{
    //put your code here
    protected $meta_title = '商品分类';
    public function index()
    {
        $keyword=I('get.keyword');
        $wheres = array();
        if (!empty($keyword)) {
            $wheres['name'] = array('like', "%$keyword%");
        }
        $rows = $this->model->getTreeList($wheres);
        cookie('__forward__', $_SERVER['REQUEST_URI']);
        $this->assign('meta_title',$this->meta_title);
        $this->assign('rows',$rows);
        $this->display('index');
    }

    /**
     * 钩子方法,用于父级引用,或者专门用于覆盖父级同名的方法
     */
    protected function _edit_view_before(){
        $rows = $this->model->getTreeList(true,'id,name,parent_id');
        $this->assign('zNodes',$rows);
    }
}
