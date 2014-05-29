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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
	<script src="<?php echo base_url();?>js/jquery-1.8.3.min.js"></script>
	<script src="<?php echo base_url();?>js/javascript.js"></script>
</head>
<body>
<div class="textaligncenter">
	<div class="a14" style="width:960px;">
		<div class="a20 textalignleft" style="font-size:28px;">
			<a href="<?php echo site_url()?>"><?=$site_name?></a>
		</div>
		<div>
			<div class="left textalignleft a21" >
				<div class="navbar"><a href="<?php echo site_url()?>"><?php echo $this->lang->line("index")?></a></div>
				<div class="navbar"><a href="<?php echo site_url("main/archive")?>"><?php echo $this->lang->line("archive")?></a></div>
				<div class="navbar"><a href="<?php echo site_url("main/rss")?>"><?php echo $this->lang->line("rss")?></a></div>
				<?php foreach($query_page_rows as $row):?>
				<div class="navbar"><a href="<?php echo site_url("main/detail/".$row->id)?>"><?php echo $row->title?></a></div>
				<?php endforeach;?>
			</div>
			
