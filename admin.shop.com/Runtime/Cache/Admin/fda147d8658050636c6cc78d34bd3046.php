<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加<?php echo ($meta_title); ?> </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />

    <!--为以后添加css样式做准备-->

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>">商品<?php echo ($meta_title); ?></a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加<?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>

<div class="main-div">
    <form method="post" action="<?php echo U();?>"><!--enctype="multipart/form-data" -->
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label"><?php echo ($meta_title); ?>名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label"><?php echo ($meta_title); ?>网址</td>
                <td>
                    <input type="text" name="url" maxlength="60" size="40" value="<?php echo ($url); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label"><?php echo ($meta_title); ?>LOGO</td>
                <td>
                    <input type="file" name="logo" id="logo" size="45" disabled="false"><br/>
                    <span class="notice-span" style="display:block"  id="warn_brandlogo">请上传图片，做为<?php echo ($meta_title); ?>的LOGO！</span>
                </td>
            </tr>
            <tr>
                <td class="label"><?php echo ($meta_title); ?>描述</td>
                <td>
                    <textarea  name="intro" cols="60" rows="4" value="" ><?php echo ($intro); ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="40" size="15" value="<?php echo ((isset($sort ) && ($sort !== ""))?($sort ): 20); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="status" class="status" value="1" /> 是
                    <input type="radio" name="status"  class="status" value="0"  /> 否
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>


    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.3.js"></script>
    <script type='text/javascript'>
        $(function(){
             $('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 1); ?>]);
        });
    </script>


    <!--为子模板添加js做准备-->

</body>
</html>