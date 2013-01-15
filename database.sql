-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 01 月 16 日 01:12
-- 服务器版本: 5.0.41
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `simplecms`
--

-- --------------------------------------------------------

--
-- 表的结构 `sc_option`
--

CREATE TABLE `sc_option` (
  `t_name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `t_value` varchar(255) collate utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 导出表中的数据 `sc_option`
--

INSERT INTO `sc_option` VALUES('site_name', '我的网站');
INSERT INTO `sc_option` VALUES('site_description', '又一个CodeIgniterCMS网站');
INSERT INTO `sc_option` VALUES('site_username', 'CodeIgniterCMS');
INSERT INTO `sc_option` VALUES('site_admin', 'admin');
INSERT INTO `sc_option` VALUES('site_passwd', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- 表的结构 `sc_posts`
--

CREATE TABLE `sc_posts` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `pub_time` datetime NOT NULL,
  `enable_comment` int(1) NOT NULL,
  `status` varchar(20) character set latin1 NOT NULL,
  `post_or_page` varchar(10) character set latin1 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- 导出表中的数据 `sc_posts`
--

INSERT INTO `sc_posts` VALUES(52, '链接', '<p><a href="https://github.com/xmxkkk/CodeIgniterCMS" target="_blank" title="CodeIgniterCMS">CodeIgniterCMS</a></p>', '2013-01-17 16:37:55', 2, '1', 'page');
INSERT INTO `sc_posts` VALUES(53, '这是CodeIgniterCMS的介绍', '<p>CodeIgniterCMS是基于<a href="http://www.CodeIgniter.com" target="_blank" title="CodeIgniter">CodeIgniter</a>的一个内容管理系统。</p><p><span style="font-family:&#39;microsoft yahei&#39;;font-size:14px;background-color:#f9f9f9;">CodeIgniterCMS托管于Github，网址：</span><a href="https://github.com/xmxkkk/CodeIgniterCMS" target="_blank" style="text-decoration:initial;font-family:&#39;microsoft yahei&#39;;font-size:14px;background-color:#f9f9f9;">https://github.com/xmxkkk/CodeIgniterCMS</a><br /></p>', '2013-01-13 11:12:00', 1, '1', 'post');
INSERT INTO `sc_posts` VALUES(54, 'How to Install CodeIgniterCMS', '<h1 style="margin:0px 0px 10px;padding:0px;border:0px;-webkit-font-smoothing:antialiased;cursor:text;position:relative;font-size:28px;font-family:helvetica, arial, freesans, clean, sans-serif;">CodeIgniterCMS</h1><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:0px;margin-bottom:15px;">中文介绍</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">CodeIgniterCMS是一个基于CodeIgniter的内容管理系统。</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">安装：</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">1.安装数据库，数据库文件是database.sql文件。在mysql里运行这个文件。</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">2.修改数据库的配置文件/application/config/database.php</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$db[&#39;default&#39;][&#39;hostname&#39;] = &#39;&#39;;</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$db[&#39;default&#39;][&#39;username&#39;] = &#39;&#39;;</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$db[&#39;default&#39;][&#39;password&#39;] = &#39;&#39;;</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$db[&#39;default&#39;][&#39;database&#39;] = &#39;&#39;;</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">3.支持中文和英文,通过修改/application/config/config.php</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$config[&#39;language&#39;] = &#39;english&#39;;//英文</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$config[&#39;language&#39;] = &#39;chinese&#39;;//中文</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">4.管理后台地址</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">http://地址/index.php/admin</p><hr style="clear:both;margin:15px 0px;height:4px;overflow:hidden;border:0px none;background-image:url(https://a248.e.akamai.net/assets.github.com/assets/primer/markdown/dirty-shade-0e7d81b119cc9beae17b0c98093d121fa0050a74.png);color:#cccccc;padding:0px;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;background-position:0px 0px;background-repeat:repeat no-repeat;" /><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">Chinese Introduction</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">CodeIgniterCMS is Content Management System ,it&#39;s based on CodeIgniter.</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">Install：</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">1.Install database, database file is database.sql. Run it in the mysql.</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">2.Modify the database config file, /application/config/database.php</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$db[&#39;default&#39;][&#39;hostname&#39;] = &#39;&#39;;</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$db[&#39;default&#39;][&#39;username&#39;] = &#39;&#39;;</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$db[&#39;default&#39;][&#39;password&#39;] = &#39;&#39;;</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$db[&#39;default&#39;][&#39;database&#39;] = &#39;&#39;;</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">3.Support Chinese and English, modify the file, /application/config/config.php</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$config[&#39;language&#39;] = &#39;english&#39;;//English</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">$config[&#39;language&#39;] = &#39;chinese&#39;;//Chinese</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-top:15px;margin-bottom:15px;">4.the manager url</p><p style="padding:0px;border:0px;color:#333333;font-family:helvetica, arial, freesans, clean, sans-serif;font-size:14px;line-height:22px;margin-bottom:0px !important;margin-top:15px;">http://url/index.php/admin</p><p><br /></p>', '2013-01-16 00:49:00', 1, '1', 'post');

-- --------------------------------------------------------

--
-- 表的结构 `sc_tags`
--

CREATE TABLE `sc_tags` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `tag` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- 导出表中的数据 `sc_tags`
--

INSERT INTO `sc_tags` VALUES(49, 53, 'CodeIgniterCMS');
INSERT INTO `sc_tags` VALUES(50, 53, 'CodeIgniter');
