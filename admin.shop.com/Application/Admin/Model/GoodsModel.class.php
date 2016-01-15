<?php 
namespace Admin\Model;
use Think\Model;
use Think\Page;

class GoodsModel extends BaseModel{
    //自动验证的属性设置
    protected $_validate=array(
        array('name','require','商品名称不应为空!'), 
        array('short_name','require','简称不应为空!'),
        array('goods_category_id','require','商品分类不应为空!'),
        array('brand_id','require','商品品牌不应为空!'),
        array('supplier_id','require','供货商不应为空!'),
        array('shop_price','require','本店价格不应为空!'),
        array('market_price','require','市场价格不应为空!'),
        //array('logo','require','商品LOGO不应为空!'),
        //array('goods_status','require','商品状态不应为空!'),
        array('status','require','是否显示不应为空!'),
        array('name','','账号名称已经存在!',0,'unique',1),//新增的时候验证供应商名字是否唯一
    );

    public function add($resource){
        //将多选框选中的值相或后保存起来(二进制办法)
        $this->startTrans();
        $this->data['goods_status'] = $this->handelGoodStatus($this->data['goods_status']);
        $id = parent::add();
        if(!$id){
            $this->error = "添加商品失败!";
            $this->rollback();
            return false;
        }
        //计算出当前的货号,修改到数据库中
        $sn = date('Ymd').str_pad($id,9,'0',STR_PAD_LEFT);
        $res = parent::save(array('id'=>$id,'sn'=>$sn));
        if(!$res){
            $this->error = "添加货号失败!";
            $this->rollback();
            return false;
        }
        $intr['intro'] = $resource['intro'];
        $intr['goods_id'] = $id;
        //将数据保存到表goods_intro里面
        $goodsintro = M('goods_intro');
        $result = $goodsintro->add($intr);
        if(!$result){
            $this->error = "添加商品简介失败!";
            $this->rollback();
            return false;
        }
        $this->commit();
        return $id;
    }

    /**
     * @param $data  传入的多选框的数组值
     * @return int  返回数组每个值相或后结果
     */
    protected function handelGoodStatus($data){
        $sum = 0;
        $checkboxes = $data;
        foreach($checkboxes as $checkbox){
            $sum = $sum | $checkbox;
        }
        return $sum;
    }
    /**
     * @param mixed|string $resource 传入的post过来的所有的值,包括其他表需要的数据
     * @return bool 返回结果为布尔值
     */
    public function save($resource){
        $this->startTrans();
        //首先要将goods表中的数据修改了
        $res = parent::save();
        if(!$res){
            $this->error = "修改商品失败!";
            $this->rollback();
            return false;
        }
        //修改goods_intro表中数据
        $intro = array('goods_id'=>$resource['id'],'intro'=>$resource['intro']);
        $goods_intro = M('goods_intro');
        $res = $goods_intro->save($intro);
        if($res === false){
            $this->error = "修改商品介绍失败!";
            $this->rollback();
            return false;
        }
        $this->commit();
        return true;
    }
}
