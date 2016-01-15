<?php
/**
 * Created by PhpStorm.
 * User: zlw
 * Date: 2016/1/7
 * Time: 10:47
 */
header('Content-Type:text/html;charset=utf-8');
/**
 * @param $SupplierModel
 * @return string
 * 传入模型类,得到返回的错误信息,拼接后返回错误信息字符串
 */
function get_error_massage($SupplierModel)
{
    $errors = $SupplierModel->getError();//得到错误信息,返回的可能是一个数组
    if (is_array($errors)) {
        //拼接成提示的字符串信息
        $errorMsg = '<ul>';
        foreach ($errors as $error) {
            $errorMsg .= "<li>{$error}</li>";
        }
        $errorMsg .= '</ul>';
        return $errorMsg;
    } else {
        $errorMsg = $errors;
        return $errorMsg;
    }
}

/**
 * @param array $arr  传入的一个二维的关联数组
 * @param $field      传入的此数组中的某个字段值
 * @return array      返回该字段对应的一列一维数组
 */
if(!function_exists('array_column')){//做兼容性的处理
    function array_column(array $arr,$field){
        $data = array();
        foreach($arr as $v){
            $data[] = $v[$field];
        }
        return $data;
    }
}
function arrToselect($class,$data,$default='',$valField = 'id',$textField = 'name'){
    $select = "<select class='{$class}' name='{$class}'>";
    $select.='<option value="">----请选择------</option>';
    $selected = '';
    foreach($data as $v){
        if($v['id'] == $default){
            $selected = 'selected="selected"';
        }
        $select.="<option value='{$v[$valField]}' $selected>{$v[$textField]}</option>";
    }
    $select.='</select>';
    return $select;
}
