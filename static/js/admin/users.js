function editAdmin() {
    var nickname = $.trim($('#edit-profile-nickname').val());
    _td.api.editAdmin({
        nickname: nickname
    }).then(function () {
        $('.profile h2').text("" + nickname);
    }, function (res) {
        showAlert(res.error, 'danger');
    });
}

function checkAdmin(){
    var nickname_value = $("#check-profile-nickname").val();
    if(nickname_value == ""){showAlert("请输入正确的管理员昵称");return false;}
    $.ajax({
        url:"api/admin_api/check_admin",
        type:"post",
        data:{nickname:nickname_value}
    }).then(function(data){
        try{
            data = JSON.parse(data);
            console.log(data);
        }catch(e){
            showAlert("服务器异常，请尝试重新提交！");
        }
        if(data.status){
            var limit = JSON.parse(data.data) , index = 0;
            $(".check input:checkbox").each(function(){
                this.checked = false;
                console.log(limit[index])
                if(limit[index] != undefined){
                    this.checked = true;
                }
                index ++;
            });
            $("#admin_nickname").text("当前选中的管理员：" + nickname_value);
        }else{
            showAlert(data.error);
        }
    })
}
function limitAdmin(){
    var limit = new Array() , index = 0;
    $(".check input:checkbox").each(function(){
        index ++;
        if(this.checked){
            limit.push(index);
        }
    });
    limit = JSON.stringify(limit);
    var nickname_value = $("#check-profile-nickname").val();
    if(nickname_value == ""){showAlert("请输入正确的管理员昵称");return false;}
    $.ajax({
        url:"api/admin_api/set_admin_limit",
        type:"post",
        data:{nickname:nickname_value , limit : limit}
    }).then(function(data){
        try{
            data = JSON.parse(data);
            console.log(data);
        }catch(e){
            showAlert("服务器异常，请尝试重新提交！");
        }
        if(data.status){
            showAlert("修改限制成功！" , "success");
        }else{
            showAlert(data.error);
        }
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
