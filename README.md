CodeIgniterCMS
==============

CodeIgniterCMS是一个基于CodeIgniter的内容管理系统。

安装：

1.安装数据库，数据库文件是database.sql文件。

2.修改数据库的配置文件/application/config/database.php
  
  $db['default']['hostname'] = '';
  
  $db['default']['username'] = '';
  
  $db['default']['password'] = '';
  
  $db['default']['database'] = '';
3.支持中文和英文,通过修改/application/config/config.php
  $config['language']  = 'english';//英文
  $config['language']  = 'chinese';//中文
  


-----------------------
