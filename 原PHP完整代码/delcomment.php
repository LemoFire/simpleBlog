<?php
/**
 * Created by PhpStorm.
 * User: LeapLu
 * Date: 2017/12/25
 * Time: 9:53
 */
require_once "include/postmgr.php";
require_once "include/commentmgr.php";
require_once "dbinfo.php";
session_start();
$psm=new PostMgr();
$cmm=new CommentMgr();
$postid=$_GET['postid'];
if(isset($_SESSION['uid']) and ($psm->getuid($_GET['postid']) == $_SESSION['uid'] or $_SESSION['uid'] == '1')){
    $cmm->delcomment($_GET['id']);
    echo "<script>alert('删除成功！');location.href='post.php?id=" . "$postid" . "';</script>";
}
else
    echo "<script>alert('没有权限！');location.href='post.php?id=" . "$postid" . "';</script>";
?>