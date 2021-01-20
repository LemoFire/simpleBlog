<?php
/**
 * Created by PhpStorm.
 * User: LeapLu
 * Date: 2017/12/23
 * Time: 21:58
 */
require_once "header.php";
require_once 'include/postmgr.php';
require_once 'dbinfo.php';
if (empty($_GET['id']))
    echo "<script>location.href='index.php';</script>";
$id=$_GET["id"];
$psm=new PostMgr();
if(isset($_POST["del"])) {
    $psm->delpost($id);
    echo "<script>alert('已成功删除!');location.href='index.php';</script>";
}
if(isset($_POST["edit"])) {
    echo "<script>location.href='write.php?id="."$id"."&mode=edit';</script>";
}
if(empty($psm->gettitle($id)) or empty($psm->getcontent($id)) or empty($psm->getuser($id)))
    echo "<script>alert('数据有误!');location.href='index.php';</script>";
$title=$psm->gettitle($id);
$content=$psm->getcontent($id);
$user=$psm->getuser($id);
?>
    <title><?=$title?></title>

    <table width="50%" border="1" align="center" borderColor=#33B552 cellpadding="20" cellspacing="30">
        <th><a href="post.php?id=<?=$id?>" style="font-size: 30px; color: #777;"><?=$title?></a></th>
        <tr>
            <td height="48"><p><?=$content?></p></td>
        </tr>
        <tr>
            <td style="text-align: right">作者:<?=$user?></td>
        </tr>


        <?php

        if(isset($_SESSION['uid']) and ($psm->getuid($_GET['id']) == $_SESSION['uid'] or $_SESSION['uid'] == '1'))
        {?><tr>
            <td>
                <form action="" method="post">
                    <input type="submit" value="编辑" name="edit">
                    <input type="submit" value="删除" name="del" >
                </form>
            </td>
        </tr>
            <?php
        }?>
    </table>
    <p>
        <?php
        //评论开始
        $step=5;
        if(isset($_GET['page'])){
            $page=$_GET['page'];
            $top=($page-1)*$step;
        }
        else
        {
            $page='1';
            $top='0';
        }
        $pageup=$page-1;
        $pagedown=$page+1;
        $nextrow=$step+1;
        $sql="select * from comment where pid=:pid LIMIT $top,$step";
        $result=$db->prepare($sql);
        $result->bindParam(":pid",$id);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        ?>

        <br>
        <br>
    </p>
    <table width="50%" border="1" align="center" borderColor=#33B552 cellpadding="10" cellspacing="15">
        <th colspan="5">评论区</th>
        <?
        while($row=$result->fetch()){?>
            <tr>
                <td colspan="5"><?=$row['content']?></td>
            </tr>
            <tr>
                <td style="font-size: 10px">昵称:<?=$row['gname']?></td>
                <td style="font-size: 10px">email:<?=$row['gemail']?></td>
                <?php
                $cid=$row['cid'];
                if(isset($_SESSION['uid']) and ($psm->getuid($_GET['id']) == $_SESSION['uid'] or $_SESSION['uid'] == '1')) {
                    echo '<td style="font-size: 10px"><a href="delcomment.php?postid='."$id".'&id='."$cid".'">删除评论</a></td>';
                }
                ?>
            </tr>
            <?
        }
        ?>
        <tr><td colspan="5" style="text-align: center">
                <?php
                //上下页操作
                if($page==1)
                {
                    echo '上一页';
                }
                else
                {
                    echo '<a href="?id='."$id".'&page='."$pageup".'">上一页</a>';
                }
                ?>
                当前是<?=$page?>页
                <?php
                //判断是否到达最后一条
                $result=$db->query("select * from comment where pid=$id LIMIT $top,$nextrow");
                if($result->rowCount()<$nextrow)
                    echo '下一页';
                else
                    echo '<a href="?id='."$id".'&page='."$pagedown".'">下一页</a>';
                ?>
            </td></tr>
    </table>


    <table align="center" style="width: 100%;border: 0; ">
        <tr>
            <td height="173" align="center" valign="middle">
                <form action="" name="" method="post">
                    <p>提交评论</p>
                    <p>
                        <input type="text" placeholder="昵称" size="30" name="name" value="<? if (isset($_SESSION['usn'])) echo "$_SESSION[usn]"; else echo "";?>">
                    </p>
                    <p><input type="text" placeholder="email" size="30" name="email"></p>
                    <textarea cols="30" rows="3" placeholder="正文" name="content"></textarea>
                    <br>
                    <input type="submit" name="sub" value="提交">
                </form>
            </td>
        </tr>
    </table>

<?php
if (isset($_POST['sub'])){
    if(empty($_POST['name']) or empty($_POST['email']) or empty($_POST['content']))
        echo "<script>alert('请输你的信息或内容');</script>";
    else
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $content=$_POST['content'];
        $sql="insert into comment(pid,gname,gemail,content) VALUE (?,?,?,?)";
        $stmt=$db->prepare($sql);
        $stmt->execute(array("$id","$name","$email","$content"));
        echo "<script>alert('评论成功!');location.href='';</script>";
    }
}

?>