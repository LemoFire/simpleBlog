<html>
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

<table width="100%" align="center" style="background-image: url(images/bg.png); font-size: 48px;">

	<tr>
    <td height="100" colspan="5">简单博客</td>
    </tr>
	<tr style="font-size: 14px;">
	  <td width="84%" style="text-align: right"><a href="index.php">首页</a></td>
		<?php
		session_start();
		if(isset($_SESSION['usn']))
		{
			echo '<td width="4%" style="text-align: right">'."$_SESSION[usn]".'</td>';
			echo '<td width="4%" style="text-align: right"><a href="logout.php">注销</a></td>';
			echo '<td width="4%" style="text-align: right"><a href="admin.php">后台</a></td>';
			echo '<td width="4%" style="text-align: right"><a href="write.php">写文</a></td>';
		}
		else{
			echo '<td width="16%" style="text-align: center"><a href="login.php">登陆</a></td>';
		}
	  ?>
  </tr>
</table>
</html>