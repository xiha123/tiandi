var curId,
    defaultImg = 'static/image/slide1.jpg',
    $editForm = $('#guide-edit-form'),
    $scheduleForm = $('#schedule-form');

$(".remove").click(function(event) {
        $parents = $(this).parents().parents().eq(0);
    confirms({
            "title" : "您确定要删除吗",
            "icon" : "icon-trash",
            "content" : "<p>您确定要删除掉这篇文章吗？</p><p>删除后将无法复原，点击确定按钮确认删除该条记录</p>",
            "success" : function(){
                $.ajax({
                    url : "api/admin_api/remove_slider",
                    type : "POST",
                    data : {"id" : $parents.data("id")},
                    dataType : "JSON",
                    success: function(data){
                        if(data.status == true) {
                            $parents.hide();
                            close();
                        } else {
                            showAlert(data.error);
                        }
                    }
                });
            }
        });

});


$('.editOnlineClassSlider').click(function (){
    $parents = $(this).parents().parents().eq(0);
    $parents_baby = $parents.find("td");

    input({
        "title" : "编辑轮播焦点图",
        "icon" : "icon-trash",
        "content" :
        '<form method="post" action="admin/eidtIndexSlider" id="edit-form" enctype="multipart/form-data">'+
        '<table class=table-form>'+
        '<input type="hidden" value="1" name="type">'+
        '<input type="hidden" value="' + $parents.data("id")+ '" name="id">'+
        '<tr><td>轮播标题：<input type="text" value="' + $parents_baby.eq(0).text()+ '" name="title">'+
        '<tr><td>轮播地址：<input type="text" value="' + $parents_baby.eq(2).text()+ '" name="link">'+
        '<tr><td>轮播背景：<input type="text" value="' + $parents_baby.eq(3).text()+ '" name="color" maxlength=7 class=slider-color><div class=color></div>'+
        '<tr><td class=updata><font>点击更换图片</font><input type="file" name="userfile" id="add_updata"><img src="./static/uploads/' + $parents.data("img")+ '" width="100%" id=preview>'+
        '<tr><td><span style="color:#ccc">建议图片尺寸：1200 * 400 ， 该图片尺寸：200 * 200</span ></table></form>',
        "success" : function(){
            $("#edit-form").unbind("submit");
            $("#edit-form").on("submit",function(){
                if($("input[name='title']").val() == ""){
                    showAlert("您必须填写一个标题");
                    return false
                }
                if($("input[name='link']").val() == ""){
                    showAlert("您必须填写一个连接");
                    return false
                }
                if($("input[name='description']").val() == ""){
                    showAlert("您必须填写一个描述");
                    return false
                }
                if($("input[name='color']").val() == ""){
                    showAlert("您必须填写一个颜色");
                    return false
                }
                var option = {
                    type : "post",
                    success:function (data) {
                        data = JSON.parse(data);
                          if(data.status == "true") {
                            location.reload();
                        } else {
                            showAlert(data.error);
                        }
                    }
                };
                $("#edit-form").ajaxSubmit(option);
                return false;
            });
            $("#edit-form").submit();
        }
    });

});


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

$scheduleForm.bind('submit', function (e) {
    e.preventDefault();

    var course = $scheduleForm.find('#schedule-form-course').val(),
        date = $scheduleForm.find('#schedule-form-date').val();

    _td.api.editSite({
        type: '001',
        content: course
    }).then(function () {
        setTimeout(function () {
            _td.api.editSite({
                type: '002',
                content: date
            }).then(function (res) {
                location.reload();
            });
        }, 0);
    });
});

$('.submit-slide-edit').bind('click', editSlide);
function editSlide(e) {
    e.preventDefault();

    $('#slide-edit-form').ajaxSubmit({
        type: "post",
        success: function (data) {
            data = JSON.parse(data);
            if(data.status === true) {
                location.reload();
            } else {
                showAlert(data.error);
            }
        }
    });
};
