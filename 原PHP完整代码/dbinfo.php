<?php
/**
 * Created by PhpStorm.
 * User: leaplu
 * Date: 2017/11/15
 * Time: 下午2:06
 */
$dbhost='localhost';
$dbuser='root';
$dbpwd='';
$dbname='blog';

/*
 *mysqli方式连接数据库
$con=new mysqli();
$con->connect("$dbhost","$dbuser","$dbpwd");
$con->query("set names as '$dbcode'");
$con->select_db(studytest);
if ($con->connect_errno)
{
    die("连接 MySQL 失败: " . $con->connect_error);
}*/
$dsn="mysql:host=$dbhost;dbname=$dbname";
$db=new PDO($dsn,"$dbuser","$dbpwd");
$db->query('set names UTF-8');
?>