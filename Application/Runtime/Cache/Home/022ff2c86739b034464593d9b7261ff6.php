<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<head>
<title><?php echo ($tit); ?></title>
<style type="text/css">
a:link {
	color: #323232;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #323232;
}
a:hover {
	text-decoration: underline;
	color: #03620E;
}
a:active {
	text-decoration: none;
	color: #03620E;
}
</style>
</head>
<body>
<table width="100%" align="center" style="background-image: url(/Public/images/bg.png); font-size: 48px;">

	<tr>
    <td height="100" colspan="5">简单博客</td>
    </tr>
	<tr style="font-size: 14px;">
		<td width="76%"><a href="/">首页</a></td>
		<?php if(session(uid)): ?><td width="6%"><?php echo session(usn); ?></td>
			<td width="6%"><a href="<?php echo U('User/logout');?>">注销</a></td>
			<td width="6%"><a href="<?php echo U('User/reg');?>">添加作者</a></td>
			<td width="6%"><a href="<?php echo U('Post/write');?>">写文</a></td>
		<?php else: ?>
			<td style="text-align: right" width="24%"><a href="<?php echo U('User/login');?>">登陆</a></td><?php endif; ?>
  </tr>
</table>

 <table width="80%" border="1" align="center" borderColor=#33B552 cellpadding="20" cellspacing="30">
    <th><a href="<?php echo U('Post/topic',array('pid'=>I('get.pid')));?>" style="font-size: 30px; color: #777;"><?php echo ($tit); ?></a></th>
    <tr>
        <td height="48"><p><?php echo ($content); ?></p></td>
    </tr>
    <tr>
        <td style="text-align: right">作者:<?php echo (id2name($uid)); ?></td>
    </tr>

<?php if((session(uid) == 1) OR (session(uid) == $uid)): ?><tr>
        <td>
            <form action="<?php echo U('Post/write',array('pid'=>I('get.pid')));?>" method="post">
                <input type="submit" value="编辑" name="edit">
                <input type="submit" value="删除" name="del" >
            </form>
        </td>
    </tr><?php endif; ?>
</table>
<p>



    <br>
    <br>
</p>
<table width="50%" border="1" align="center" borderColor=#33B552 cellpadding="10" cellspacing="15">
    <th colspan="5">评论区</th>
    <?php if(!$list): ?><tr><td><center>暂无评论</center></td></tr><?php endif; ?>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td colspan="5"><?php echo ($vo["content"]); ?></td>
        </tr>
        <tr>
            <td style="font-size: 10px">昵称:<?php echo ($vo["gname"]); ?></td>
            <td style="font-size: 10px">email:<?php echo ($vo["gemail"]); ?></td>
            <?php if((session(uid) == 1) OR (session(uid) == $uid)): ?><td style="font-size: 10px"><a href="<?php echo U('Post/delcomment',array('cid'=>$vo['cid']));?>">删除评论</a></td><?php endif; ?>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

<?php if(strlen($page) > 15): ?><tr>
            <td colspan="5" style="text-align: center">
                <?php echo ($page); ?>
            </td>
    </tr><?php endif; ?> 
</table>

<table align="center" style="width: 100%;border: 0; ">
    <tr>
        <td height="173" align="center" valign="middle">
            <form action="<?php echo U('Post/writecomment',array('pid'=>I('get.pid')));?>" name="" method="post">
                <p>提交评论</p>
                <p>
                    <input type="text" placeholder="昵称" size="30" name="gname" value="<?php if(session('usn')) echo session('usn'); else echo "";?>">
                </p>
                <p><input type="text" placeholder="email" size="30" name="gemail"></p>
                <textarea cols="30" rows="3" placeholder="正文" name="content"></textarea>
                <br>
                <input type="submit" name="sub" value="提交">
            </form>
        </td>
    </tr>
</table>
</body>
<footer>
    <hr />
    <h1><center><a style="color: mediumaquamarine">A Cute Footer!</a></center></h1>
</footer>