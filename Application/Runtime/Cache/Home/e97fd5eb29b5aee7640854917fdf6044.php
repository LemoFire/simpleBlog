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

     <table style="height:100%; width:100%;" border="0">
        <tr>
            <td align="center" valign="middle">
                <form method="post" action="<?php echo U('User/adduser');?>">
                    <p>
                      <input type="text" placeholder="用户名" name="uname" required="required">
                    </p>
                    <p>
                      <input type="password" placeholder="密码" name="upass" required="required">
                    </p>
                    <p>
                      <input type="password" placeholder="密码确认" name="repass" required="required">
                    </p>
                    <p>
                      <input type="email" placeholder="邮件" name="email" required="required">
                    </p>
                    <p>
                      <input type="text" placeholder="手机" name="phone" maxlength="11" required="required"><br>
                      <br>
                      <input type="submit" value="注册" name="sub">
                    </p>
                </form>
            </td>
        </tr>
    </table>

</body>
<footer>
    <hr />
    <h1><center><a style="color: mediumaquamarine">A Cute Footer!</a></center></h1>
</footer>