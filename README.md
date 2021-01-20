# simpleBlog

一个简单的微博/博客程序，有纯 PHP 和 ThinkPHP 两个版本。主要功能有：写文章、修改文章、删除文章、评论、添加多个作者用户等。程序全局采用 PDO 操作数据库，不存在 sql 注入问题，密码采用 sha1 与 md5 共同加密，在数据库中无法明文查看到密码。

### 运行效果

![1](https://github.com/LemoFire/simpleBlog/raw/main/doc/1.png)

![2](https://github.com/LemoFire/simpleBlog/raw/main/doc/2.png)

![3](https://github.com/LemoFire/simpleBlog/raw/main/doc/3.png)

![4](https://github.com/LemoFire/simpleBlog/raw/main/doc/4.png)

### 安装说明

1.上传文件到网站根目录

2.数据库中新建一个数据库，然后导入 blog.sql 到数据库中

3.修改 dbinfo.php 中的数据为对应数据库的信息

4.运行 install.php 注册拥有管理员权限的用户就可以正常使用了

### Demo

[https://proj.ito.fun/simpleBlog/](https://proj.ito.fun/simpleBlog/)
