<extend name="Common:index"/>
<block name="css">
    <link href="__CSS__/page.css" rel="stylesheet" type="text/css" />
</block>
<block name="body">
    <h1>
        <span class="action-span"><a href="{\:U('add')}">添加{$meta_title}</a></span>
        <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
        <span id="search_id" class="action-span1"> - 商品{$meta_title} </span>
        <div style="clear:both"></div>
    </h1>
    <div class="form-div">
        <form action="{\:U()}" name="searchForm">
            <img src="__IMG__/icon_search.gif" width="26" height="22" border="0" alt="search" />
            <input type="text" name="keyword" size="15" value="{$Think.get.keyword | urldecode}"/>
            <input type="submit" value=" 搜索 " class="button" />
        </form>
    </div>
    <input type="button" name="id" class="deleteAll ajax-post" value="删除" src="{\:U('changestatus')}"/>
    <input type="button" name="id" class="deleteAll ajax-post" value="显示" src="{\:U('changestatus',array('status'=>1))}"/>
    <input type="button" name="id" class="deleteAll ajax-post" value="隐藏" src="{\:U('changestatus',array('status'=>0))}"/>
        <div class="list-div" id="listDiv">
            <table cellpadding="3" cellspacing="1">
                <tr>
                    <th><input type="checkbox" name="ids" class="button"/>ID</th>
                    <!--使用注解生成表头-->
                    <?php foreach($fields as $f):?>
                    <?php echo "<th>{$f['comment']}</th>";?>
                    <?php endforeach;?>
                    <th>操作</th>
                </tr>
                <volist name="rows" id="row">
                    <tr>
                        <td><input type="checkbox" name="id[]" class="ids" value="{\$row.id}"/>{$row.id}</td>
                        <?php  foreach($fields as $field){
                        if($field['field'] == 'name'){
                            echo "<td class='first-cell'><span>{\$row.name}</span></td>";
                            }elseif($field['field'] == 'intro'){
                                echo " <td align='center'><span>{\$row.intro}</span></td>";
                            }elseif($field['field'] == 'sort'){
                                echo " <td align='center'>{\$row.sort}</td>";
                            }elseif($field['field'] == 'status'){
                                echo "<td align='center'><a class='ajax-get' href=\"{\:U('changestatus',array('id'=>\$row['id'],'status'=>1-\$row['status']))}\"><img src=\"__IMG__/{\$row['status'] == 1?'yes':'no'}.gif\" /></a></td>";
                            }elseif($field['field'] == 'url'){
                                echo "<td align='center'><image src='{\$row.url}'/></td>";
                            }
                        }
                        ?>
                        <td>
                            <a href="{\:U('edit',array('id'=>$row['id']))}" title="编辑">编辑</a> |
                            <a class="ajax-get" href="{\:U('changestatus',array('id'=>$row['id']))}" title="移除">移除</a>
                        </td>
                    </tr>
                </volist>
            </table>
            <table id="page-table" cellspacing="0">
                <tr>
                    <!--<td width="80%">&nbsp;</td>-->
                    <td align="left" nowrap="true" class="page">
                        {$pagehtml}
                    </td>
                </tr>
            </table>
        </div>
</block>
<block name="js">
    <script type="text/javascript" src="__JS__/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="__LAYER__"></script>
    <script type="text/javascript" src="__JS__/jquery.form.js"></script>
    <script type="text/javascript" src="__JS__/common.js"></script>
    <script type="text/javascript">
        function del(){
            confirm('是否放入回收站');
        }
    </script>
</block>