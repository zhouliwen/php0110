<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品<?php echo ($meta_title); ?> </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />

    <link href="http://admin.shop.com/Public/Admin/css/page.css" rel="stylesheet" type="text/css" />

</head>
<body>

    <h1>
        <span class="action-span"><a href="<?php echo U('add');?>">添加供货商</a></span>
        <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
        <span id="search_id" class="action-span1"> - 商品供货商 </span>
        <div style="clear:both"></div>
    </h1>
    <div class="form-div">
        <form action="<?php echo U();?>" name="searchForm">
            <img src="http://admin.shop.com/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="search" />
            <input type="text" name="keyword" size="15" value="<?php echo (urldecode($_GET['keyword'])); ?>"/>
            <input type="submit" value=" 搜索 " class="button" />
        </form>
    </div>
    <input type="button" name="id" class="deleteAll ajax-post" value="删除" src="<?php echo U('changestatus');?>"/>
    <input type="button" name="id" class="deleteAll ajax-post" value="显示" src="<?php echo U('changestatus',array('status'=>1));?>"/>
    <input type="button" name="id" class="deleteAll ajax-post" value="隐藏" src="<?php echo U('changestatus',array('status'=>0));?>"/>
        <div class="list-div" id="listDiv">
            <table cellpadding="3" cellspacing="1">
                <tr>
                    <th><input type="checkbox" name="ids" class="button"/>ID</th>
                    <th><?php echo ($meta_title); ?>名称</th>
                    <th><?php echo ($meta_title); ?>描述</th>
                    <th>排序</th>
                    <th>是否显示</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                        <td><input type="checkbox" name="id[]" class="ids" value="<?php echo ($row["id"]); ?>"/><?php echo ($row["id"]); ?></td>
                        <td class="first-cell">
                            <span><?php echo ($row["name"]); ?></span>
                        </td>
                        <td align="center"><span><?php echo ($row["intro"]); ?></span></td>
                        <td align="center">
                            <?php echo ($row["sort"]); ?>
                        </td>
                        <td align="center"><a class="ajax-get" href="<?php echo U('changestatus',array('id'=>$row['id'],'status'=>1-$row['status']));?>"><img src="http://admin.shop.com/Public/Admin/images/<?php echo ($row['status'] == 1?'yes':'no'); ?>.gif" /></a></td>

                        <td>
                            <a href="<?php echo U('edit',array('id'=>$row['id']));?>" title="编辑">编辑</a> |
                            <a class="ajax-get" href="<?php echo U('changestatus',array('id'=>$row['id']));?>" title="移除">移除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <table id="page-table" cellspacing="0">
                <tr>
                    <!--<td width="80%">&nbsp;</td>-->
                    <td align="left" nowrap="true" class="page">
                        <?php echo ($pagehtml); ?>
                    </td>
                </tr>
            </table>
        </div>


    <div id="footer">
        共执行 3 个查询，用时 0.021251 秒，Gzip 已禁用，内存占用 2.194 MB<br />
        版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
    </div>


    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery.form.js"></script>
    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>

</body>
</html>