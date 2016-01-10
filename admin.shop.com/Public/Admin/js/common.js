/**
 * Created by zlw on 2016/1/8.
 */
/**
 * 完成通过get方式提交数据的操作的ajax动态操作
 */
$(function(){
    //完成选中ID的复选框的时候能够选中当前页面里面的所有的复选框
    $('.button').click(function(){
        $('.ids').prop('checked',$(this).prop('checked'));
    });
    //完成当每页的数据复选框全部选中之后,ID的复选框全部选中
    $('.ids').click(function(){
        $('.button').prop('checked',$('.ids:not(:checked)').length == 0);
    });
    $('.ajax-get').click(function(e){
        e.preventDefault();//阻止表单的提交
        var url = $(this).attr('href');//得到传递的url
        $.get(url,showAjaxLayer);
    });
    /**
     * edit视图的表单提交post的处理
     */
    //>>2 通用ajax的post请求
    $('.ajax-post').click(function(e){
        //发送ajax的post请求
        //通过当前按钮向上找到form
        e.preventDefault();
        var form = $(this).closest('form');
        var length  =  $(this).closest('form').length;
        if(length != 0){
            console.debug(form);
            form.ajaxSubmit({success:showAjaxLayer});  //使用jquery.form.js插件实现的.
        }else{
            var url = $(this).prop('src');
            var param =$('.ids').serialize();
            $.post(url,param,showAjaxLayer);
        }
    });
});
/**
 * 展示出操作后的动态效果，数据处理
 * @param data
 */
function showAjaxLayer(data){
    //console.debug(data);
    var icon;
    if(data.status){
        icon = 1;
    }else{
        icon = 2;
    }
    //显示一个提示框
    layer.msg(data.info, {
        time:1000,  //等待时间后关闭
        offset: 0,  //设置位置
        icon:icon,  //设置提示框中的图标
    },function(){         //提示框隐藏之后该函数执行
        //如果data中有url地址才转向
        if(data.url){
            location.href = data.url;
        }
    });
}