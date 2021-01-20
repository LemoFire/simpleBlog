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

 <table style="width: 100%;height: 100%;border: 0; ">
    <tr>
        <td align="center" valign="middle">
            <form action="<?php echo U('Post/editpost',array('pid'=>$pid,'mode'=>$mode));?>" name="" method="post">
                <h3 align="left">标题</h3>
                <p><input type="text" size="50" name="title" value="<?php echo ($title); ?>" required></p>
                <h3 align="left">正文</h3>
                <textarea cols="50" rows="20" name="content" required><?php echo ($content); ?></textarea>
                <p><input type="submit" name="sub" value="提交"></p>
            </form>
        </td>
    </tr>
</table>
</body>
<footer>
    <hr />
    <h1><center><a style="color: mediumaquamarine">A Cute Footer!</a></center></h1>
</footer>