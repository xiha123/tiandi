<?php
	if(!isset($nickname)){
?>
                <script type="text/javascript">
                    function refreshYZM(id){
                        var el =document.getElementById(id);
                        el.src=el.src+'?'+Math.random();//这个特别重要
                    }
                </script>
<!-- 登录窗口通用弹窗  -->
<div class="window" style="<?php if(isset($_GET['from_invite']) || $show_notice){echo 'display:block;';}?>">


	<div class="login" id="login" style="width: 305px;height: 345px;">
		<div class="regist-open">
			<a class="close-icon close" href="javascript:;"></a>
			<div class="open-top">
				<h2 class="m-b5">加入秒答</h2>
				<P>答你所问 知你所想</P>
			</div>
			<ul class="open-list">

				<li class="c">
					<p><input type="text" id="login_username" class="open-input1" placeholder="邮箱" /></p>
				</li>
				<li class="c">
					<p><input type="password" id="login_password" class="open-input2" placeholder="密码" /></p>
				</li>
				<li class="c">
					<p class="yzm-box"><input id="vcode" name="vcode" type="text" class="open-input3" placeholder="验证码" /></p>
					<P class="yzm-tips" style="float:right"><img style="cursor: pointer;" src="/Verification" id="logvcode" onclick="javascript:refreshYZM('logvcode');" width="97" height="36" /></P>
				</li>
				<li class="c regist-zh">
                    <a href="#" class="reg-btn3" id="ajax_login">登陆</a>
                    <input type="checkbox" value="1"> 记住我 *
                    <a class="reg-link" style="color: #0a001f" href="javascript:$('#forget').click();">无法登陆?</a>
				</li>
                <li class="c open-login">
                    <P class="tac m-b5">社交账号登录</P>
                    <div class="reg-link c">
                        <P><a href="#"   class="reg-link1 wx-login-btn"><span class="reg-icon2"></span>微信</a></P>
                        <P><a href="#" class="reg-link1" id="wb_connect_btn"><span class="reg-icon3"></span>微博</a></P>
                        <P><a href="#" class="reg-link1" id="qq-login-btn"><span class="reg-icon4"></span>QQ</a></P>
                    </div>
                </li>
			</ul>
		</div>

	</div>

	<div class="login forget" id="forget" >
		<div class="login-title">
			<h2>找回密码</h2>
			<a href="javascript:$('.window .close').click();$('#forget').hide();" class="close" ><i class="fa fa fa-times-circle-o"></i></a>
		</div>
		<div class="login-content">
			<ul>
				<li><input type="text" id="userEmail" placeholder="请输入您的邮箱"></li>
				<li><input type="text" id="verification" placeholder="请输入验证码"></li>
				<li class="login-click"><img src="" onclick="document.getElementById('image_id').src='./Verification'" id="image_id" alt="" width="120" height="40"></li>
				<li><input type="button" value="找回密码" id="ajax_forget"></li>
			</ul>
		</div>
	</div>

	<div class="login"  style="width:305px;height: 390px;<?php if(isset($_GET['from_invite'])){echo 'display:block;';}?>" id="reg">
		<div class="regist-open">
			<a class="close-icon close" href="javascript:;"></a>
			<div class="open-top">
				<h2 class="m-b5">加入秒答</h2>
				<P>答你所问 知你所想</P>
			</div>
			<ul class="open-list">
				<li class="c">
					<p><input type="text" id="reg_nick" class="open-input1" placeholder="昵称" /></p>
				</li>
				<li class="c">
					<p><input type="text" id="reg_email" class="open-input1" placeholder="邮箱" /></p>
				</li>
				<li class="c">
					<p><input type="password" id="reg_password_r" class="open-input2" placeholder="密码(不少于6位)" /></p>
				</li>
				<li class="c">
                    <input type="hidden" name="reg_avatar" id="reg_avatar">
                    <input type="hidden" name="reg_type" id="reg_type">
					<p><input type="password" id="reg_password" class="open-input2" placeholder="确认密码" /></p>
				</li>
				<li class="c">
					<p class="yzm-box"><input type="text" id="vcode_reg" class="open-input3" placeholder="验证码" /></p>
					<P class="yzm-tips" style="float:right"><img style="cursor: pointer;" src="/Verification"  onclick="javascript:refreshYZM('vcode1');"  id="vcode1" width="97" height="36" /></P>
				</li>
				<li class="c regist-zh">
					<a href="#" id="ajax_reg" class="reg-btn3">确认</a> <a class="reg-link" href="javascript:$('.bomb-login').click();">已有账号</a>
				</li>
				<li class="c open-login">
					<P class="tac m-b5">社交账号登录</P>
					<div class="reg-link c">
						<P><a href="javascript:;" class="reg-link1 wx-login-btn" id="wx-login-btn"><span class="reg-icon2"></span>微信</a></P>
						<P><a href="#" class="reg-link1" id="wb_connect_btn_rg"><span class="reg-icon3"></span>微博</a></P>
						<P><a href="#" class="reg-link1" id="qq-login-btn_rg"><span class="reg-icon4"></span>QQ</a></P>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<?php }else { ?>
        <div class="window" style="<?php if($show_notice || isset($_GET['editprofile'])){echo 'display:block;';}?>" >
            <div class="login" id="notice" style="<?php if($show_notice){echo 'display:block;';}else{echo 'display:none;';}?>;height: 300px;">
                <div class="login-title">
                    <h2>提醒</h2>
                    <a href="javascript:;" class="close"><i class="fa fa fa-times-circle-o"></i></a>
                </div>
                <div class="login-content cf">
                    <div style="text-align: center; position: relative; margin-top: 50px;">
                        <p style="font-size: 30px; color: #0092a4; ">全新秒答，任性壕礼</p>
                    </div>
                    <div style="margin:0 auto;width:200px; relative; margin-top: 20px;">
                        <form action="/godHelp/gift">

                            <input type="submit" value="去看看" id="ajax_login" >
                        </form>
                    </div>

                </div>
            </div>
            <?php $userinfo = ModelFactory::User()->check_login();?>
            <form method="post" action="/userset/profile" style="margin-top:45px">

                <div class="regist-box"  style="<?php if(isset($_GET['editprofile'])){echo 'display:block;';}else{echo 'display:none;';}?>">
                    <dl class="reg-top c">
                        <dt><img src="<?php echo '/static/login/images/head.png';?>" width="96" height="96" /></dt>
                        <dd>
                            <h2>感谢您加入秒答</h2>
                            <p class="m-b10">不要害羞，介绍一下自己吧...</p>
<!--                            						<P><span class="reg-icon1"></span>微博<span class="wb-add">(--><?php //echo $userinfo['email'];?><!--)</span></P>-->
                            <P><span class="wb-add"><?php echo $userinfo['email'];?></span></P>
                        </dd>
                    </dl>
                    <div class="reg-con c">
                        <div class="reg-left">
                            <P><img src="<?php if(isset($userinfo['avatar'])) {echo $userinfo['avatar'];}else{echo '/static/login/images/head1.png';} ;?>" id="header_img" width="169" height="169" /></P>
                            <p class="tac m-b5"><input type="button" href="javascript:;" id="ajax_upload_header" class="reg-btn1" value="更换头像" /></p>
                            <input type="hidden" value="" name="avatar_url" id="profile_avatar" />

                            <P class="tips" id="upload-tips">Size limit:200KB</P>
                        </div>
                        <div class="reg-rig">
                            <ul class="reg-list">
                                <li class="m-b10">
                                    <P class="txt1">昵称</P>
                                    <input class="reg-input1" name="nick_name" id="nick_name" value="<?php echo $userinfo['nickname'];?>"  type="text" id="reg_nick" placeholder="hello" />
                                </li>
                                <li class="m-b10">
                                    <P class="txt1">添加你喜欢的标签</P>
                                    <input class="reg-input1"  name="fav_tag"  id="fav_tag"  type="text" placeholder="e.g.Unity3D Cocos2d-x C# Java web" />
                                </li>
                                <li class="m-b10">
                                    <P class="txt1">你现在处于什么阶段？</P>
                                    <P class="state c">
                                        <a class="on">学生</a><a >工作中</a>
                                        <input type="hidden" value="1" name="type" id="profile_type" />
                                    </P>
                                </li>
                                <li class="m-b10">
                                    <div class="c about m-b5">
                                        <P class="about-box"><input type="text" name="professional" class="reg-input2 fl" placeholder="专业" /><span class="a-txt fl">at</span><input name="school" type="text" class="reg-input2 fl" placeholder="学校" /></P>
                                        <P class="about-box" style="display:none;"><input type="text" name="station" class="reg-input2 fl" placeholder="职位" /><span class="a-txt fl">at</span><input name="company" type="text" class="reg-input2 fl" placeholder="公司" /></P>
                                    </div>
                                    <div id="studeninfo">
                                        <P class="m-b5">天地君道培训学员？</P>
                                        <P><input type="text" id="student_date" class="reg-input2" placeholder="" />&nbsp;期</P>
                                    </div>
                                </li>
                                <li class="m-b10">
                                    <div class="reg-op">
                                        <button type="submit" class="reg-btn2">确定</button>
                                        <P><img src="/static/login/images/regist-line1.png" width="287" height="17" /></P>
                                        <a href="/home?home=index&uid=<?php echo $userinfo['id'];?>" class="reg-btn1 ">害羞嘛,还是先跳过吧</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </form>

		</div>


        <script type="text/javascript">

            $(function(){
                $('.state a').click(function(){
                    var i = $(this).index();
                    var type = $(this).text();
                    console.log(type);
                    if (type != '学生') {
                        $('#profile_type').val(2) ;
                    }else{
                        $('#profile_type').val(2) ;

                    }
                    $(this).addClass("on").siblings().removeClass("on");
                    $(".about .about-box").eq(i).show().siblings().hide();
                })

            })
        function initupload(){
            var oBtn = document.getElementById("ajax_upload_header");

            new AjaxUpload(oBtn,{
                action:"/upload/ajax",
                name:"userfile",
                onSubmit:function(file,ext){
                    console.log(ext)
                    if(ext && /^(jpg|jpeg|png|gif)$/.test(ext)){
                        //ext是后缀名
                        oBtn.value = "正在上传…";
                    }else{
                        alert('请选择图片类型的文件上传!');
                        return false;
                    }
                },
                onComplete:function(file,response){
                    oBtn.value = '更换头像';
                    obj = eval('('+response+')');
                    if (obj['status'] != 'false') {
                        $('#profile_avatar').val(obj['file_name']);
                        $('#header_img').attr('src',obj['file_name'])
                    }else{
                        alert(obj.msg)
                    }
                }
            });
        }
            initupload();
        </script>
<?php } ?>
<div class="showAlert">
	<p class="aletrContent">

	</p>
</div>
