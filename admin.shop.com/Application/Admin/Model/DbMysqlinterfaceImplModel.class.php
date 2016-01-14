<?php
/**
 * Created by PhpStorm.
 * User: zlw
 * Date: 2016/1/14
 * Time: 13:24
 */

namespace Admin\Model;


class DbMysqlInterfaceImplModel implements DbMysqlInterfaceModel
{
    public function connect()
    {
        // TODO: Implement connect() method.
        echo "connect";
        exit;
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo "disconnect";
        exit;
    }

    public function free($result)
    {
        // TODO: Implement free() method.
        echo "free";
        exit;
    }

    public function query($sql, array $args = array())
    {
        // TODO: Implement query() method.
        $tempSQL = $this->buildSQL(func_get_args());
        return M()->execute($tempSQL);

    }

    public function insert($sql, array $args = array())
    {
        // TODO: Implement insert() method.
        //得到传来的所有参数
        $args = func_get_args();
        //得到sql模板
        $sql = array_shift($args);
        //得到数据表的名字
        $table_name = array_shift($args);
        //将sql模板中的?T替换为数据表的名字
        $sql = str_replace('?T',$table_name,$sql);
        //由于此时$args[0]才代表二维数组数据,所以再弹出一次得到要插入数据的标准二维数组
        $args = array_shift($args);
        //将这个二维数组循环后和sql一起拼成完全的sql语句
        $res = '';
        foreach($args as $k=>$v){
            $res.="$k='{$v}',";
        }
        $res = rtrim($res,',');
        $sql = str_replace('?%',$res,$sql);
        $model = M();
        $res = $model->execute($sql);
        if($res){
            return $model->getLastInsID();
        }
    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo "update";
        exit;
    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
        echo "getAll";
        exit;
    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo "getAssoc";
        exit;
    }

    public function getRow($sql, array $args = array())
    {
        // TODO: Implement getRow() method.
        $tempSQL = $this->buildSQL(func_get_args());//得到完整的sql
        $rows = M()->query($tempSQL);
        return empty($rows)?false:$rows[0];
    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo "getCol";
        exit;
    }

    public function getOne($sql, array $args = array())
    {
        // TODO: Implement getOne() method.
        echo "getOne";
        exit;
    }

    private function buildSQL($args){
        $sql = array_shift($args);//弹出获得的参数数组中的第一个元素,即为得到的sql语句
        $sqls = preg_split('/\?[FTN]/',$sql);//根据正则表达式分割字符串为数组
        $tempSQL = '';
        foreach($sqls as $k=>$v){
            $tempSQL.=$v.$args[$k];//将两个数组进行拼接得到正常的sql语句
        }
        return $tempSQL;
    }

}