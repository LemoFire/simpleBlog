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

 <p>
<table width="70%" border="1" align="center" borderColor=#33B552 cellpadding="20" cellspacing="30">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><a href="<?php echo U('Post/topic',array('pid'=>$vo['pid']));?>" style="font-size: 30px; color: #777;"><?php echo ($vo["title"]); ?></a></th>
                <tr>
                    <td height="48"><p><?php echo ($vo["content"]); ?></p></td>
        </tr>
        <tr>
            <td style="text-align: right">作者:<?php echo (id2name($vo["uid"])); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
<?php if(!$list): ?><tr><td><center><h1>暂无文章,首次使用请先<a style="color: darkred" href="<?php echo U('User/reg');?>">添加管理员</a></br>若已添加,请<a style="color: darkred" href="<?php echo U('User/login');?>">登录</a>或<a style="color: darkred" href="<?php echo U('Post/write');?>">写文</a></h1></center></td></tr><?php endif; ?>
</table>
</p>
<table align="center">
    <tr><td style="text-align: center"><?php echo ($page); ?></td></tr>
</table>
</body>
<footer>
    <hr />
    <h1><center><a style="color: mediumaquamarine">A Cute Footer!</a></center></h1>
</footer>