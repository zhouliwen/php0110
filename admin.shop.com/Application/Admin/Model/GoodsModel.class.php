<?php 
namespace Admin\Model;
use Think\Model;
use Think\Page;

class GoodsModel extends BaseModel{
    //自动验证的属性设置
    protected $_validate=array(
        array('name','require','名称不应为空!'), 
array('sort','require','排序不应为空!'), 
array('status','require','状态,1为前后台都可以看，-1为放入回收站,后台可看，0仅后台可看不应为空!'), 
        array('name','','账号名称已经存在!',0,'unique',1),//新增的时候验证供应商名字是否唯一
    );
}
