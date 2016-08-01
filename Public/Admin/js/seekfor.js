/* 筛选 */
var objForm = $("#seek");
objForm.find('select').change(function () {
	objForm.find('input[type="text"]').val('');
	objForm.submit();
});
objForm.find('input').siblings('span').click(function () {
	var val = objForm.find('input[type="text"]');
	if (val.val() === '') {
		val.focus();
		return false;
	};
	objForm.submit();
});

/* 全选 */
$('.checkall').click(function() {
    var this_ = $(this);
    if (this_.prop('checked')) {
        this_.parents('tr').siblings('tr').find('td:eq(0)>input[type="checkbox"]').prop("checked", true);
    } else {
        this_.parents('tr').siblings('tr').find('td:eq(0)>input[type="checkbox"]').prop("checked", false);
    }
});

