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