// 点击删除，滑出提示框
$(".operation .remove").click(function(){
    $(this).siblings(".deleConfirm").stop().animate({"left":0},"100","easeInOutBack");
});
// 取消
$(".deleConfirm span.cancel").click(function(){
    $(this).parent().stop().animate({"left":"100%"},"100","easeInOutBack");
});
// 确认
$(".deleConfirm span.confirm").click(function(){
    var id = $(this).parents('tr').attr('data-row');
    var conf = $(this).parent();
    $.post(deleUrl, {id: id}, function (data) {
        if (data.status) {
            conf.unbind("mouseleave");
            conf.animate({"left":"100%"},"100","easeInOutBack",function(){
                $(this).parents("tr").animate({"opacity":0},"800",function(){
                    $(this).remove();
                }); 
            }); 
        } else {
            alert('操作失败');
        };
    });
});