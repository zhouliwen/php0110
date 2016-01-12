<?php 
namespace Admin\Controller;
class GoodsController extends BaseController{
    //put your code here
    protected $meta_title = '商品';
    public function index()
    {
        $this->display('edit');
        //phpinfo();
    }
}
