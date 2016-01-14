<?php 
namespace Admin\Model;
use Admin\Service\NestedSetsService;
use Think\Model;
use Think\Page;

class GoodsCategoryModel extends BaseModel{
    //自动验证的属性设置
    protected $_validate=array(
        array('name','require','名称不应为空!'), 
        array('status','require','状态不应为空!'),
        array('sort','require','排序不应为空!'),
        array('name','','账号名称已经存在!',0,'unique',1),//新增的时候验证供应商名字是否唯一
    );
    public function getTreeList($is_json=false,$fields='*',$wheres = array())
    {
        //得到status>-1的所有数据的总条数
        if (in_array('status', $this->getDbFields())) {
            $wheres['status'] = array('gt', -1);
        }
        $row = $this->field($fields)->where($wheres)->order('lft')->select();
        if ($is_json && $row) {
            return json_encode($row);
        }
        return $row;
    }

    /**
     * 基础模型里面的add方法不满足要求,所以重写一个方法覆盖
     * @return false|int 失败返回false,成功则返回新添加数据的id
     */
    public function add(){
        //1.计算边界
        $DB = new DbMysqlInterfaceImplModel();//实例化可以操作sql的类
        $nestedsets = new NestedSetsService($DB,'goods_category','lft','rgt','parent_id','id','level');//通过这个插件来生成sql语句,要传入可以执行sql语句的对象
        //2.将数据保存到数据库中(添加节点到指定的父节点下,返回新插入数据生成的id)
        return $nestedsets->insert($this->data['parent_id'],$this->data,'bottom');
    }

    /**
     * @return bool 成功返回true,失败返回bool
     */
    public function save(){
        $DB = new DbMysqlInterfaceImplModel();
        $nestedsets = new NestedSetsService($DB,'goods_category','lft','rgt','parent_id','id','level');
        //将要修改的节点移动到指定的父节点下面
        $nestedsets->moveUnder($this->data['id'],$this->data['parent_id']);
        //将修改后的数据放入数据库中
        return parent::save();
    }

    public function changestatus($id, $status=-1)
    {
        $sql = "select child.id from goods_category as child,goods_category as parent where parent.id={$id} and child.lft >= parent.lft and child.rgt<=parent.rgt";
        $rows = $this->query($sql);//得到的是这个节点及其所有儿子节点的id的二维数组
        $id = array();
        $id = array_column($rows,'id');
        $data = array( 'status' => $status);
        $data['id'] = array('in',$id);
        if ($status == -1) {
            //表示的是此时是放入回收站,给供货商的名字加一个后缀
            $data['name'] = array('exp', "concat(name,'_del')");
        }
        return parent::save($data);
    }

}
