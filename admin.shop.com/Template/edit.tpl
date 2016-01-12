<extend name="Common:edit"/>
<block name="body">
    <form method="post" action="{:U()}">
    <div class="main-div">
            <table cellspacing="1" cellpadding="3" width="100%">
                <?php foreach($fields as $v){ ?>
                    <tr>
                       <td class='label'><?php echo $v['comment'];?></td>
                        <td>
                            <?php
                            if(!empty($v['field_type'])){
                                if($v['field_type'] == 'textarea'){
                                   echo "<textarea  name=\"{$v['field']}\" cols='60' rows='4' value='' >{\${$v['field']}}</textarea>";
                                    }elseif($v['field_type'] == 'file'){
                                        echo "<input type='file' name=\"{$v['field']}\" maxlength='60' size='40' value='{\${$v['field']}}' />";
                                    }elseif($v['field_type'] == 'radio'){
                                        foreach($v['redio_val'] as $k => $r){
                                            echo "<input type='radio' name=\"{$v['field']}\" class=\"{$v['field']}\" value='{$k}' /> $r";
                                             }
                                        }
                            }else{
                                 if($v['field'] == 'sort'){
                                    echo "<input type='text' name='sort' maxlength='40' size='15' value='{\${$v['field']} | default = 20}' />";
                                        }else{
                                         echo "<input type='text' name=\"{$v['field']}\" maxlength='60' value='{\${$v['field']}}'/>";
                                         }
                                }
                            ?>
                           <span class='require-field'>*</span>
                        </td>
                    </tr>
               <?php }?>
                <tr>
                    <td colspan="2" align="center"><br />
                        <input type="hidden" name="id" value="{$id}"/>
                        <input type="submit" class="ajax-post" value=" 确定 " />
                        <input type="reset" class="button" value=" 重置 " />
                    </td>
                </tr>
            </table>
    </form>
    </div>
</block>
<block name="js">
    <script type="text/javascript" src="__JS__/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="__LAYER__"></script>
    <script type="text/javascript" src="__JS__/jquery.form.js"></script>
    <script type="text/javascript" src="__JS__/common.js"></script>
    <script type='text/javascript'>
        $(function(){
            $('.status').val([{$status | default = 1}]);
        });
    </script>
</block>