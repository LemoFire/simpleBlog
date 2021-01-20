<?php
require_once "header.php";
require_once "include/usermgr.php";
?>
    <body>

    <table style="height:100%; width:100%;" border="0">
        <tr>
            <td align="center" valign="middle">
                <script>
                    function changing(){
                        document.getElementById('checkpic').src="ch.php?"+Math.random();
                    }
                </script>
                <form method="post" action="" name="log">
                    <p>
                        <input type="text" placeholder="用户名" name="loginname" required>
                        <br>
                        <br/>
                        <input type="password" placeholder="密码" name="loginpwd" required>
                        <br>
                        <br/>
                        <input type="text" placeholder="验证码" name="check"  />
                        <br>
                        <img id="checkpic" onclick="changing();" src='ch.php'/>
                        <br>
                        <input type="submit" value="登录" name="login">
                    </p>
                </form>
            </td>
        </tr>
    </table>
    </body>
<?php
//此处支持给出判断验证码正确与否的代码
if(isset($_POST["login"])){
    $str = $_POST["check"];
    if( $str==$_SESSION['checkkey'] ){
        require_once 'dbinfo.php';
        if(isset($_SESSION['usn'])){
            echo "<script>alert('您已经登陆！');location.href='index.php';</script>";
        }
        else {
            if (isset($_POST['login'])) {
                $uname = $_POST['loginname'];
                $loginemail = $_POST['loginname'];
                $upass = $_POST['loginpwd'];
                //密码加密
                require_once 'crptpw.php';
                $sql = 'Select uname,upass from userinf WHERE (uname=:name OR email=:email) AND upass=:pwd';
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':name', $uname);
                $stmt->bindParam(':email', $loginname);
                $stmt->bindParam(':pwd', $crptpw);
                $stmt->execute();
                if (empty($stmt->rowCount()))
                    echo "<script>alert('登录失败');location.href='';</script>";
                else {
                    echo "<script>alert('登陆成功！欢迎回来"."$uname"."');location.href='index.php';</script>";
                    $umgr=new UserMgr();
                    $uid=$umgr->getuidbyname($uname);
                    $_SESSION['usn'] = "$uname";
                    $_SESSION['uid']="$uid";
                }
            }
        }
    }
    else{
        echo "<script language=\"JavaScript\"> alert(\"验证码错误！\");location.href=\"\";</script>";
    }
}
?>