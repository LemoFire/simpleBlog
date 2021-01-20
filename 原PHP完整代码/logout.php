<?php
/**
 * Created by PhpStorm.
 * User: LeapLu
 * Date: 2017/12/21
 * Time: 7:32
 */
session_start();
session_unset();
session_destroy();
echo "<script>alert('已注销');location.href='index.php';</script>";
?>