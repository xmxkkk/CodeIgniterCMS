-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 01 月 15 日 21:33
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
  `t_name` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  `t_value` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 导出表中的数据 `sc_option`
--

INSERT INTO `sc_option` VALUES('site_name', '我的网站');
INSERT INTO `sc_option` VALUES('site_description', '又一个SimpleCMS网站');
INSERT INTO `sc_option` VALUES('site_username', 'SimpleCMS');
INSERT INTO `sc_option` VALUES('site_admin', 'admin');
INSERT INTO `sc_option` VALUES('site_passwd', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- 表的结构 `sc_posts`
--

CREATE TABLE `sc_posts` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `pub_time` datetime NOT NULL,
  `enable_comment` int(1) NOT NULL,
  `status` varchar(20) NOT NULL,
  `post_or_page` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- 导出表中的数据 `sc_posts`
--

INSERT INTO `sc_posts` VALUES(52, '链接', '<p><a href="https://github.com/xmxkkk/CodeIgniterCMS" target="_blank" title="CodeIgniterCMS">CodeIgniterCMS</a></p>', '2013-01-17 08:37:55', 1, '1', 'page');
INSERT INTO `sc_posts` VALUES(53, '这是CodeIgniterCMS的介绍', '<p>CodeIgniterCMS是基于<a href="http://www.CodeIgniter.com" target="_blank" title="CodeIgniter">CodeIgniter</a>的一个内容管理系统。</p><p><span style="font-family:&#39;microsoft yahei&#39;;font-size:14px;background-color:#f9f9f9;">CodeIgniterCMS托管于Github，网址：</span><a href="https://github.com/xmxkkk/CodeIgniterCMS" target="_blank" style="text-decoration:initial;font-family:&#39;microsoft yahei&#39;;font-size:14px;background-color:#f9f9f9;">https://github.com/xmxkkk/CodeIgniterCMS</a><br /></p>', '2013-01-15 11:12:00', 1, '1', 'post');

-- --------------------------------------------------------

--
-- 表的结构 `sc_tags`
--

CREATE TABLE `sc_tags` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `tag` varchar(50) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- 导出表中的数据 `sc_tags`
--

INSERT INTO `sc_tags` VALUES(43, 53, 'CodeIgniterCMS');
INSERT INTO `sc_tags` VALUES(44, 53, 'CodeIgniter');
