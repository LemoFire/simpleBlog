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
/*
 * mysqli实现方式
 * if(isset($_POST["sub"])) {
    $uname = $_POST['username'];
    $uname_safe=mysqli_real_escape_string($db,strip_tags($uname));
    //检查用户名是否有重复
    $sql="select * from userinf where uname = '$uname_safe'";
    $result =$db->query("$sql" );
    if(mysqli_fetch_row($result)==0)
    {
        //检查邮件是否有重复
        $email = $_POST['email'];
        $sql="select * from userinf WHERE email='$email'";
        $result=$db->query("$sql");
        if (mysqli_fetch_row($result)==0)
        {
            //检查手机号是否重复
            $phone = $_POST['phone'];
            $sql="select * from userinf WHERE phone='$phone'";
            $result=$db->query("$sql");
            if (mysqli_fetch_row($result)==0)
            {
                $upass = $_POST['password'];
                //确认密码
                $reupass=$_POST['repassword'];
                if($reupass!=$upass)
                    echo("两次密码输入不一致！");
                else
                {
                    //密码加密
                    $crptpw=crypt(sha1($upass),md5($uname_after));
                    $sql = "insert into userinf(uname,upass,email,phone) values ('$uname_safe','$crptpw','$email','$phone')";
                    $db->query("$sql");
                    echo "注册成功";
                }
            }
            else echo "手机号已被注册";
        }
        else echo "该邮箱已被注册";
    }
    else
        echo "该用户已被注册";
}
*/
if(isset($_SESSION['uid']) and $_SESSION['uid']=='1') {
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
                        echo "<script>alert('注册成功!');location.href='index.php';</script>";
                    }
                } else echo "<script>alert('该手机号已被注册!');location.href='';</script>";
            } else echo "<script>alert('该邮箱已被注册!');location.href='';</script>";
        } else
            echo "<script>alert('该用户已被注册!');location.href='';</script>";
    }
}else
{
    echo "<script>alert('你没有权限添加用户！');location.href='index.php';</script>";
}
?>
<title>添加作者</title>
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