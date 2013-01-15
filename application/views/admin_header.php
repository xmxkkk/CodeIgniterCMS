<?php
$query=$this->db->query("select * from sc_option where t_name='site_name'");
$rows=$query->result();
$site_name=$rows[0]->t_value;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$site_name?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/datetimepicker/datetimepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/datetimepicker/jquery-ui.css">
	
	<script type="text/javascript" charset="utf-8" src="<?=base_url()?>js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?=base_url()?>js/javascript.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?=base_url()?>js/datetimepicker/jquery-ui.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?=base_url()?>js/datetimepicker/datetimepicker.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?=base_url()?>js/datetimepicker/caret.js"></script>
	<script>
		var URL='<?=base_url()?>js/ueditor/';
	</script>
	<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/ueditor/editor_config.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/ueditor/editor_all.js"></script>
</head>
<body>
<div class="textaligncenter">
	<div class="a14">
		<div id="header">
			<div class="a13 left">
				<a href="<?=site_url()?>"><?=$site_name?></a>
			</div>
			<div class="right">
				<div class="a12">
					<a href="<?=site_url()?>/admin/manager" class="left"><div class="rightmenucommon <?php echo $menu==1?"rightmenuchecked":"rightmenunochecked";?>"><?=$this->lang->line("article")?></div></a>
					<a href="<?=site_url()?>/admin/page" class="left"><div class="rightmenucommon <?php echo $menu==2?"rightmenuchecked":"rightmenunochecked";?>"><?=$this->lang->line("page")?></div></a>
					<a href="<?=site_url()?>/admin/setting" class="left"><div class="rightmenucommon <?php echo $menu==3?"rightmenuchecked":"rightmenunochecked";?>"><?=$this->lang->line("setting")?></div></a>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div style="clear:both;"></div>
		</div>
		