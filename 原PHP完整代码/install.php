<!doctype html>
<?php
/**
 * Created by PhpStorm.
 * User: leaplu
 * Date: 2017/11/11
 * Time: 上午3:41
 */
require_once "dbinfo.php";
require_once "header.php";
if (isset($_POST["sub"])) {
    $uname = $_POST['username'];
    //检查用户名是否有重复
    $sql = "select * from userinf where uname = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $uname);
    $stmt->execute();
    if (empty($stmt->rowCount())) {
        //检查邮件是否有重复
        $email = $_POST['email'];
        $sql = "select * from userinf WHERE email= :email";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if (empty($stmt->rowCount())) {
            //检查手机号是否重复
            $phone = $_POST['phone'];
            $sql = "select * from userinf WHERE phone= :phone";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();
            if (empty($stmt->rowCount())) {
                $upass = $_POST['password'];
                //确认密码
                $reupass = $_POST['repassword'];
                if ($reupass != $upass)
                    echo("两次密码输入不一致！");
                else {
                    //密码加密
                    require_once 'crptpw.php';
                    $sql = "insert into userinf(uname,upass,email,phone) values (?,?,?,?)";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array("$uname", "$crptpw", "$email", "$phone"));
                    echo "<script>alert('管理员用户注册成功，请删除本文件!');location.href='index.php';</script>";
                }
            } else echo "<script>alert('该手机号已被注册!');location.href='';</script>";
        } else echo "<script>alert('该邮箱已被注册!');location.href='';</script>";
    } else
        echo "<script>alert('该用户已被注册!');location.href='';</script>";
}

?>
<title>安装管理员用户 安装后请删除该文件</title>
<body>
<table style="height:100%; width:100%;" border="0">
    <tr>
        <td align="center" valign="middle">
            <form method="post" action="">
                <p>
                    <input type="text" placeholder="用户名" name="username" required="required">
                </p>
                <p>
                    <input type="password" placeholder="密码" name="password" required="required">
                </p>
                <p>
                    <input type="password" placeholder="密码确认" name="repassword" required="required">
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