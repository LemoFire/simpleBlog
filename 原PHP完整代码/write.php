<!DOCTYPE html>
<html lang="en">
<head>

    <title>文章编辑器</title>
</head>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: LeapLu
 * Date: 2017/12/20
 * Time: 17:21
 */
require_once "header.php";
require_once "dbinfo.php";
require_once "include/postmgr.php";
$psm=new PostMgr();
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $title=$psm->gettitle($id);
    $content=$psm->getcontent($id);
}else
{
    $title="";
    $content="";
}
if (isset($_SESSION['usn'])) {
    ?>
    <table style="width: 100%;height: 100%;border: 0; ">
        <tr>
            <td align="center" valign="middle">
                <form action="" name="" method="post">
                    <h3 align="left">标题</h3>
                    <p><input type="text" size="50" name="title" value="<?=$title?>"></p>
                    <h3 align="left">正文</h3>
                    <textarea cols="50" rows="20" name="content"><?=$content?></textarea>
                    <p><input type="submit" name="sub" value="提交"></p>
                </form>
            </td>
        </tr>
    </table>
    <?php
}else
    echo "<script>alert('请登陆！');location.href='login.php';</script>";
?>
<?php
if (isset($_POST['sub'])) {
    if (empty($_POST['title']) or empty($_POST['content']))
        echo "<script>alert('请输入正文或标题');</script>";
    else {
        $title = $_POST['title'];
        $content = $_POST['content'];
        if ($_GET['mode'] == 'edit') {
            if ($psm->getuid($id) == $_SESSION['uid'] or $_SESSION['uid'] == '1') {
                $sql = "Update post set title=?, content=? where pid=?";
                $stmt = $db->prepare($sql);
                $pid = $id;
                $stmt->execute(array("$title", "$content", "$pid"));
                echo "<script>alert('编辑成功！');location.href='post.php?id=" . "$id" . "';</script>";
            }
            else
                echo "<script>alert('没有权限！');location.href='post.php?id=" . "$id" . "';</script>";
        }
        else if (isset($_SESSION['uid'])) {
            $sql = "insert into post(title,content,uid) VALUE (?,?,?)";
            $stmt = $db->prepare($sql);
            $uid = $_SESSION['uid'];
            $stmt->execute(array("$title", "$content", "$uid"));
            echo "<script>alert('写帖成功！');location.href='post.php?id=" . "$id" . "';</script>";
        }

    }
}

?>
</body>
</html>
