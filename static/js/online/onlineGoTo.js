var curId,
    defaultImg = 'static/image/slide1.jpg',
    $editForm = $('#guide-edit-form');

$('table').delegate('.fa', 'click', function () {
    var $ele = $(this),
        $parent = $ele.parent().parent();

    switch ($ele.attr('data-type')) {
        case 'edit':
            curId = $parent.attr('data-id');

            $editForm.find('input')
                .eq(0).attr('value', curId)
                .end()
                .eq(1).val($parent.children('td').eq(0).text())
                .end()
                .eq(2).val($parent.children('td').eq(2).text());

            var imgUrl = $parent.attr('data-img');
            $editForm.find('img').attr('src', imgUrl ? 'static/uploads/' + imgUrl : defaultImg);
            break;
    }
});

$('.submit-guide-edit').bind('click', editGuide);

function editGuide(e) {
    e.preventDefault();

    var curName = $editForm.find('#guide-edit-form-name').val(),
        curLink = $editForm.find('#guide-edit-form-link').val(),
        curImg = $editForm.find('img').attr('src');

    if ($.trim(curName) === "") {
        showAlert("您必须填写一个标题");
        return false
    }
    if ($.trim(curLink) === "") {
        showAlert("您必须填写一个链接");
        return false
    }
    if ($.trim(curImg) === defaultImg) {
        showAlert("您必须选择一个图片");
        return false
    }
    $editForm.ajaxSubmit({
        type: "post",
        success: function (data) {
            data = JSON.parse(data);
            if(data.status === true) {
                $('table tr[data-id="' + curId + '"]').children('td')
                    .eq(0).text(curName)
                    .end()
                    .eq(1).html('<a href="' + curImg + '">' + curImg.slice(15) + '</a>')
                    .end()
                    .eq(2).html('<a href="' + curLink + '">' + curLink + '</a>');
            } else {
                showAlert(data.error);
            }
        }
    });
}
