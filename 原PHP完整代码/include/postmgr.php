<?php

class PostMgr
{

//帖子操作

    //显示题目
    public function gettitle($pid)
    {
        global $db;
        $sql = "select title from post where pid=:pid";
        $result = $db->prepare($sql);
        $result->bindParam(':pid', $pid);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $title = $result->fetch();
        return $title['title'];
    }

    //显示内容
    public function getcontent($pid)
    {
        global $db;
        $sql = "select content from post where pid=:pid";
        $result = $db->prepare($sql);
        $result->bindParam(':pid', $pid);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $content = $result->fetch();
        return $content['content'];
    }
    //获取uid
    public function getuid($pid)
    {
        global $db;
        $sql = "select uid from post where pid=:pid";
        $result = $db->prepare($sql);
        $result->bindParam(':pid', $pid);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $uid = $result->fetch();
        return $uid['uid'];
    }
    //显示作者
    public function getuser($pid)
    {
        global $db;
        $uid=$this->getuid($pid);
        $sql = "select uname from userinf where uid=:uid";
        $result = $db->prepare($sql);
        $result->bindParam(':uid', $uid);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $uname = $result->fetch();
        return $uname['uname'];
    }
    //删除帖子
    public function delpost($pid){
        global $db;
        $sql="delete from post where pid=:pid";
        $result = $db->prepare($sql);
        $result->bindParam(':pid', $pid);
        $result->execute();
        $sql="delete from comment where pid=:pid";
        $result = $db->prepare($sql);
        $result->bindParam(':pid', $pid);
        $result->execute();
    }
}
?>