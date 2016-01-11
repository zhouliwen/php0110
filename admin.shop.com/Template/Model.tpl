namespace Admin\Model;
use Think\Model;
use Think\Page;

class <?php echo $name?>Model extends BaseModel{
    //自动验证的属性设置
    protected $_validate=array(
        <?php
          foreach($fields as $field){
          //id和可以为空的字段不生成验证规则
            if($field['null'] == 'YES' || $field['field'] == 'id'){
            continue;
            }
            echo "array('{$field['field']}','require','{$field['comment']}不应为空!'), \r\n";//验证是否为空
          }
        ?>
        array('name','','账号名称已经存在!',0,'unique',1),//新增的时候验证供应商名字是否唯一
    );
}
