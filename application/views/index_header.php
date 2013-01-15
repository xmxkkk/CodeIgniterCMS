<?php
$query=$this->db->query("select * from sc_option where t_name='site_name'");
$rows=$query->result();
$site_name=$rows[0]->t_value;
$query_page=$this->db->query("select * from sc_posts where status=1 and post_or_page='page'");
$query_page_rows=$query_page->result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$site_name?></title>
	<meta name="keywords" content="<?=$keywords?>"/>
	<meta name="description" content="<?=$description?>"/>
	<link rel="stylesheet" type="text/css" href="http://127.0.0.1:8089/simplecms/css/style.css">
	<script src="http://127.0.0.1:8089/simplecms/js/jquery-1.8.3.min.js"></script>
	<script src="http://127.0.0.1:8089/simplecms/js/javascript.js"></script>
</head>
<body>
<div class="textaligncenter">
	<div class="a14" style="width:960px;">
		<div class="a20 textalignleft" style="font-size:28px;">
			<a href="<?=site_url()?>"><?=$site_name?></a>
		</div>
		<div>
			<div class="left textalignleft a21" >
				<div class="navbar"><a href="<?=site_url()?>">首页</a></div>
				<div class="navbar"><a href="<?=site_url()?>/main/archive">存档</a></div>
				<div class="navbar"><a href="<?=site_url()?>/main/rss">订阅</a></div>
				<?php foreach($query_page_rows as $row):?>
				<div class="navbar"><a href="<?=site_url()?>/main/detail/<?=$row->id?>"><?=$row->title?></a></div>
				<?php endforeach;?>
			</div>
			