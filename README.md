CodeIgniterCMS
==============

中文介绍

CodeIgniterCMS是一个基于CodeIgniter的内容管理系统。

安装：

1.安装数据库，数据库文件是database.sql文件。在mysql里运行这个文件。

2.修改数据库的配置文件/application/config/database.php
  
  $db['default']['hostname'] = '';
  
  $db['default']['username'] = '';
  
  $db['default']['password'] = '';
  
  $db['default']['database'] = '';
  
3.支持中文和英文,通过修改/application/config/config.php
  
  $config['language']  = 'english';//英文
  
  $config['language']  = 'chinese';//中文
  
4.管理后台地址

  http://地址/index.php/admin
  

-----------------------

English Introduction

CodeIgniterCMS is Content Management System ,it's based on CodeIgniter.

Install：

1.Install database, database file is database.sql. Run it in the mysql.

2.Modify the database config file, /application/config/database.php
  
  $db['default']['hostname'] = '';
  
  $db['default']['username'] = '';
  
  $db['default']['password'] = '';
  
  $db['default']['database'] = '';
  
3.Support Chinese and English, modify the file, /application/config/config.php
  
  $config['language']  = 'english';//English
  
  $config['language']  = 'chinese';//Chinese
  
4.the manager url

  http://url/index.php/admin
