<?php
/**
 * Created by PhpStorm
 * User: LeapLu
 * Date: 2017/12/24
 * Time: 9:24
 */
class UserMgr
{
    //获取uid
    public function getuidbyname($uname)
    {
        global $db;
        $sql = "select uid from userinf where uname=:uname";
        $result = $db->prepare($sql);
        $result->bindParam(':uname', $uname);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $uid = $result->fetch();
        return $uid['uid'];
    }
    //获取名字
    public function getnamebyuid($uid)
    {        global $db;
        $sql = "select uname from userinf where uid=:uid";
        $result = $db->prepare($sql);
        $result->bindParam(':uid', $uid);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $uname = $result->fetch();
        return $uname['uname'];

    }
}