function editProfile() {
    var nickname = $.trim($('#edit-profile-nickname').val());

    $.ajax({
        url: 'admin_api/edit',
        method: 'post',
        data: {
            nickname: nickname
        },
        dataType: 'json',
        success: function (res) {
            if (res.status) {
                $('.profile h2').text(nickname);
            } else {
                showAlert(res.error, 'danger');
            }
        }
    });
}

function createAdmin() {
    $.ajax({
        url: 'admin_api/create',
        method: 'post',
        data: {
            name: $('#create-admin-username').val(),
            pwd: $('#create-admin-pwd').val(),
            nickname: $('#create-admin-nickname').val()
        },
        dataType: 'json',
        success: function (res) {
            if (res.status) {
                showAlert('创建成功', 'success');
            } else {
                showAlert(res.error, 'danger');
            }
        }
    });
}

function removeAdmin() {
    $.ajax({
        url: 'admin_api/remove',
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