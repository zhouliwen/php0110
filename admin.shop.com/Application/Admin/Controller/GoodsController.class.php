<?php 
namespace Admin\Controller;
class GoodsController extends BaseController{
    //put your code here
    protected $meta_title = '商品';
    //告诉父类中的add和edit方法要通过I方法中的post获取所有的数据,并且传递给模型类
    protected $usePostParams = true;
//    public function add()
//    {
//        if (IS_GET) {
//            //表示的是单纯的增加的页面
//            $this->assign('meta_title',$this->meta_title);
//            $this->_edit_view_before();
//            $this->display('edit');
//        } else {
//            //表示的是添加供应商到数据库里面
//            //1.自动验证
//            if ($this->model->create()) {
//                //表示验证成功,进行添加数据的操作
//                if ($this->model->add(I('post.'))) {
//                    $this->success('添加成功!', cookie('__forward__'));
//                    return;
//                }
//            }
//            $this->error('操作失败!<br/>' . get_error_massage($this->model));
//        }
//    }
//    public function edit()
//    {
//        if (IS_GET) {
//            //表示是要展示一个回显了数据的表单
//            //根据传入的id得到该条信息的全部内容,回显在模板里
//            $row = $this->model->find(I('get.id'));
//            $this->assign('meta_title',$this->meta_title);
//            $this->assign($row);
//            $this->_edit_view_before();
//            $this->display('edit');
//        } else {
//            //表示此时为修改数据到数据库里面的操作
//            if ($this->model->create()) {
//                if ($this->model->save(I('post.')) !== false) {
//                    $this->success('修改成功!', cookie('__forward__'));
//                    return;
//                }
//            }
//            $this->error('亲,没有修改正确哦!<br/>'.get_error_massage($this->model));
//        }
//    }

    protected function _edit_view_before(){
        /*************商品分类的数据展示*******************/
        //1.展示出商品分类的下拉框数据（goods_category）
        $goodsCategory = D('goods_category');
        //得到数据
        $rows = $goodsCategory->getTreeList(true,'id,name,parent_id');
        //将数据发送到前端以便生成html
        $this->assign('zNodes',$rows);
        /*************商品品牌的数据展示*******************/
        $brands = M('brand');
        $rows = $this->getlist($brands);
        //将数据发送到前端以便生成html
        $this->assign('brands',$rows);
        /*************商品供货商的数据展示*******************/
        $suppliers = M('supplier');
        $rows = $this->getlist($suppliers);
        //将数据发送到前端以便生成html
        $this->assign('suppliers',$rows);
        /*************5.判断是否为编辑时*******************/
        $id = I('get.id');
        if(!empty($id)){
            //>>5.1 编辑时从goods_intro中查询出当前商品对应的商品简介
            $goodsIntroModel = M('GoodsIntro');
            $intro = $goodsIntroModel->getFieldByGoods_id($id,'intro');
            $this->assign('intro',$intro);
        }
    }
}
