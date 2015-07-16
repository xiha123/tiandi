<div class="header">
    <div class="wrapper">
        <a href="./"><img class="logo" src="static/image/logo.png" height="81" width="110" alt="天地培训logo"></a>
        <ul class="nav cf">
            <?php
                $navList = array(
                    array(
                        'name' => '在线课堂',
                        'link' => './olclass',
                        'active' => false
                    ),
                    array(
                        'name' => '实时答疑',
                        'link' => 'javascript:;',
                        'active' => false
                    ),
                    array(
                        'name' => '学习印记',
                        'link' => 'javascript:;',
                        'active' => false
                    ),
                    array(
                        'name' => '神码来了',
                        'link' => 'javascript:;',
                        'active' => false
                    ),
                    array(
                        'name' => '关于我们',
                        'link' => 'javascript:;',
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
            <img src="./static/image/test.jpg" height="25" width="25" alt="avatar">用户昵称
            <ul class="user-menu">
                <li><a href="">用户资料</a></li>
                <li><a href="">退出登录</a></li>
            </ul>
        </div>
    </div>
</div>