<?php
/**
 * Created by PhpStorm.
 * User: LeapLu
 * Date: 2017/12/20
 * Time: 17:20
 */
require_once "header.php";
require_once "dbinfo.php";
require_once "include/usermgr.php";
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
$result=$db->query("SELECT * FROM post order by pid desc LIMIT $top,$step");
$result->setFetchMode(PDO::FETCH_ASSOC);
$uinf=new UserMgr();

?>
<title>简单博客</title>


<?
while($row=$result->fetch()){?>
    <p><table width="50%" border="1" align="center" borderColor=#33B552 cellpadding="20" cellspacing="30">
            <th><a href="post.php?id=<?=$row['pid']?>" style="font-size: 30px; color: #777;"><?=$row['title']?></a></th>
            <tr>
                <td height="48"><p><?=$row['content']?></p></td>
    </tr>
    <tr>
        <td style="text-align: right">作者:<?=$uinf->getnamebyuid($row['uid'])?></td>
    </tr>
    </table></p>
    <?
}
?>

<table align="center">
    <tr><td style="text-align: center"><?php
            //上下页操作
            if($page==1)
            {
                echo '上一页';
            }
            else
            {
                echo '<a href="?page='."$pageup".'">上一页</a>';
            }
            ?></td>
        <td style="text-align: center">当前是<?=$page?>页</td>
        <td style="text-align: center"><?php
            //判断是否到达最后一条
            $result=$db->query("SELECT * FROM post LIMIT $top,$nextrow");
            $result->setFetchMode(PDO::FETCH_ASSOC);
            if($result->rowCount()<$nextrow)
                echo '下一页';
            else
                echo '<a href="?page='."$pagedown".'">下一页</a>';
            ?></td></tr>
</table>
