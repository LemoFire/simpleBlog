<?php
/**
 * Created by PhpStorm.
 * User: LeapLu
 * Date: 2017/12/24
 * Time: 11:32
 */

class CommentMgr
{

//回复操作

    //删除帖子
    public function delcomment($cid)
    {
        global $db;
        $sql = "delete from comment where cid=:cid";
        $result = $db->prepare($sql);
        $result->bindParam(':cid', $cid);
        $result->execute();
    }
}
?>