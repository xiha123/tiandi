<div class="header">
    <div class="wrapper cf">
        <a href="./"><img class="logo" src="static/image/tiandijundaoLogo.png" height="81" width="110" alt="天地培训logo"></a>
        <ul class="nav cf">
            <?php
                $navList = array(
                    array(
                        'name' => '秒答',
                        'link' => 'miaoda',
                        'active' => false
                    ),

                    array(
                        'name' => '大神',
                        'link' => 'god',
                        'active' => false
                    ),

                    array(
                        'name' => '学习印记',
                        'link' => 'javascript:showAlert(false, \'页面暂未开放，敬请期待\');',
                        'active' => false
                    ),

                    array(
                        'name' => '在线课堂',
                        'link' => 'olclass',
                        'active' => false
                    ),

                    array(
                        'name' => '精英汇',
                        'link' => '/about/recruit',
                        'active' => false
                    )
                );

                if (isset($activeNav)) $navList[$activeNav]['active'] = true;
                for ($i = 0; $i < count($navList); $i++) {
                    $cls = $navList[$i]['active'] === true ? ' class="active"' : '';
                    echo '<li><a href="', $navList[$i]['link'], '"', $cls, '>', $navList[$i]['name'], '</a></li>';
                }
            ?>
        </ul>


        <div class="user">

            <?php
                if(isset($nickname)){
            ?>
                    <img src="<?=$avatar?>" height="25" width="25" alt="avatar">
                    <span><?=$nickname?><font class="news-number"><?=$news_nuw <= 0 ? "" : "($news_nuw)"?></font></span>
                    <ul class="user-menu seconds">
                        <li><a href="./home?uid=<?=$id?>&home=index">个人中心</a></li>
                        <?php
                            echo  $type == 1 ? '<li><a href="./home?uid='.$id.'">大神主页</a></li>' : "";
                        ?>
                        <li><a href="./notice">通知<?= $news_nuw <= 0 ? "" : " ($news_nuw)" ?></a></li>
                        <li><a href="./userset">设置</a></li>
                        <li><a href="javascript:;">充值</a></li>
                        <li><a href="./help">帮助</a></li>
                        <li><a href="javascript:" id="ajax_outlogin">退出</a></li>
                    </ul>
            <?php
                }else{
                    echo '
                        <div class="notLogin">
                            <a href="javascript:;" class="bomb-login"><i class="fa fa-user"></i>登录</a>
                            <a href="javascript:;" class="bomb-reg"><i class="fa fa-user-plus"></i>注册</a>
                        </div>';
                }
            ?>


            <!--  -->
        </div>
    </div>

</div>
<?php $this->load->view('widgets/windows.php' ); ?>
