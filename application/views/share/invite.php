<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="/static/css/invite.css" rel="stylesheet" type="text/css" />
    <script src="/static/lib/ZeroClipboard/ZeroClipboard.min.js"></script>
    <script src="/static/lib/jquery/jquery-1.11.3.min.js"></script>
</head>

<body>
<div class="main">
    <div class="top">
        <h2>邀请小伙伴，领取壕礼</h2>
        <P align="center" class="p1"><img src="/static/image/share/p1.png" width="565" height="56" /></P>
        <ul class="c list1">
            <li>把你的链接发给小伙伴</li>
            <li>小伙伴通过你的链接成为大神</li>
            <li class="last">你获得20威望点</li>
        </ul>
        <P align="center" class="p2"><img src="/static/image/share/qq_icon.png" width="565" height="79" /></P>
        <ul class="c list2">
            <li>小伙伴等级达到L3</li>
            <li class="last">你再次获得20威望点</li>
        </ul>
    </div>
    <div class="linkbox">
        <ul class="yq-box c">
            <li>您的邀请链接</li>
            <li><input type="text" id="share_text" value="<?php echo $invate_url;?>" /></li>
            <li><a class="copybotton" id="copybotton" data-clipboard-text="<?php echo $invate_url;?>">一键复制</a></li>
        </ul>
        <ul class="an-box c">
            <li>
                <a class="button button1" target="_blank" href="<?= $qqshare;?>">QQ群/好友(强烈推荐)</a>
            </li>
            <li>
                <a class="button button2" target="_blank"  href="<?= $qqzshare;?>">QQ空间(推荐)</a>
            </li>
            <li>
                <a class="button button3" target="_blank"  href="<?= $sinashare;?>">发布微博</a>
            </li>
        </ul>
    </div>
    <div class="tjzt">强烈推荐通过这三种方式分享链接，威望点上涨蹭蹭的</div>
    <ul class="c tjfs">
        <li>
            <p>发给好友或QQ群</p>
            <P><a href="#"><img src="/static/image/share/p3.png" width="280" height="280" /></a></P>
            <P>邀请成功率高，见效快，<br/>
                大家都说好使！</P>
        </li>
        <li>
            <p>分享到QQ空间</p>
            <P><a href="#"><img src="/static/image/share/p4.png" width="280" height="280" /></a></P>
            <P>这么好的消息，<br/>怎么可能忽略这块宝地！</P>
        </li>
        <li class="last">
            <p>分享到微博</p>
            <P><a href="#"><img src="/static/image/share/p5.png" width="280" height="280" /></a></P>
            <P>这么好的自媒体平台，<br/>还不赶紧占领？</P>
        </li>
    </ul>
    <P class="pub">*秒答保留所有解释权</P>
</div>
<script>
    $(document).ready(function(){
        ZeroClipboard.setDefaults({
            moviePath: '/static/lib/ZeroClipboard/ZeroClipboard.swf'
        });
        var client = new ZeroClipboard(document.getElementById("copybotton"));


        client.on( 'mouseup', function(client) {
            var copyText = $('#share_text').val();
            client.setText(copyText);
            alert("拷贝成功!");
            // alert("mouse down");
        } );


    })
</script>
</body>
</html>
