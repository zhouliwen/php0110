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

    <form method="post" action="<?php echo U();?>">
        <div class="main-div">
                <table cellspacing="1" cellpadding="3" width="100%">
                    <tr>
                        <td class="label"><?php echo ($meta_title); ?>名称</td>
                        <td>
                            <textarea  name="name" cols="60" rows="4" value="" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><br />
                            <input type="submit"  value=" 确定 " />
                            <input type="reset" class="button" value=" 重置 " />
                        </td>
                    </tr>
                </table>
        </div>
    </form>


<div id="footer">
共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>


    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery.form.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>
    <script type='text/javascript'>
        $(function(){
            $('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 1); ?>]);
        });
    </script>

</body>
</html>