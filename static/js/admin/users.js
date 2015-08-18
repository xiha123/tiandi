function editAdmin() {
    var nickname = $.trim($('#edit-profile-nickname').val());
    _td.api.editAdmin({
        nickname: nickname
    }).then(function () {
        $('.profile h2').text(nickname);
    }, function (res) {
        showAlert(res.error, 'danger');
    });
}

function createAdmin() {
    _td.api.createAdmin({
        name: $('#create-admin-username').val(),
        pwd: $('#create-admin-pwd').val(),
        nickname: $('#create-admin-nickname').val()
    }).then(function () {
        showAlert('创建成功', 'success');
    }, function (res) {
        showAlert(res.error, 'danger');
    });
}

function removeAdmin() {
    $.ajax({
        url: './api/admin_api/remove',
        method: 'post',
        data: {
            name: $('#remove-admin-username').val()
        },
        dataType: 'json',
        success: function (res) {
            if (res.status) {
                showAlert('删除成功', 'success');
            } else {
                showAlert(res.error, 'danger');
            }
        }
    });
}

function editUser() {
	showAlert('还没开放用户注册', 'danger');
}
