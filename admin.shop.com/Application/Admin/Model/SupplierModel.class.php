<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Model;
use Think\Model;
use Think\Page;

/**
 * Description of SupplierModel
 *
 * @author zlw
 */
class SupplierModel extends BaseModel{
    //put your code here
    //自动验证的属性设置
    protected $_validate=array(
        array('name','require','供货商名字不应为空!'),//验证名字是否为空
        array('name','','账号名称已经存在!',0,'unique',1),//新增的时候验证供应商名字是否唯一
        array('intro','require','简介不应为空!'),//验证简介是否为空
    );
}
