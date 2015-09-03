var curId,
    $editForm = $('#tag-edit-form'),
    $addForm = $('#tag-add-form');

$('table').delegate('.fa', 'click', function () {
    var $ele = $(this),
        $parent = $ele.parent().parent();

    switch ($ele.attr('data-type')) {
        case 'edit':
            curId = $parent.attr('data-id');
            $editForm.find('input')
                .eq(0).val($parent.children('td').eq(0).text())
                .end()
                .eq(1).val($parent.children('td').eq(3).text());
            break;
        case 'remove':
                _td.api.removeTag({
                    id: $parent.attr('data-id')
                }).then(function (res) {
                    $parent.remove();
                }, function (res) {
                    alert('删除失败: ' + res.error);
                });
            break;
    }
});

$editForm.bind('submit', function (e) {
    e.preventDefault();
    editTag();
});
$('.submit-tag-edit').bind('click', editTag);
function editTag() {
    var curName = $editForm.find('input').eq(0).val(),
        curContent = $editForm.find('input').eq(1).val();

    _td.api.editTag({
        id: curId,
        name: curName,
        content: curContent
    }).then(function (res) {
        $('table tr[data-id="' + curId + '"]').children('td')
            .eq(0).text(curName)
            .end()
            .eq(3).text(curContent);
    }, function (res) {
        alert('编辑失败: ' + res.error)
    });
}

$addForm.bind('submit', function (e) {
    e.preventDefault();
    editTag();
});
$('.submit-tag-add').bind('click', addTag);
function addTag() {
    var curName = $addForm.find('input').eq(0).val(),
        curContent = $addForm.find('input').eq(1).val();

    _td.api.addTag({
        name: curName,
        content: curContent
    }).then(function (res) {
        location.reload();
    }, function (res) {
        alert('添加失败: ' + res)
    });
}
