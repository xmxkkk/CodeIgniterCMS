<?php $this->load->view("admin_header");?>
		<form method="post" action="<?=site_url()?>/admin/update_admin"> 
		<div id="content" class="textalignleft">
			<div class="a15">
				<div>
					<div class="fontsize24 left"><?=$this->lang->line("site_settings")?></div>
					<div style="clear:both;"></div>
				</div>
				<div class="a18 pt15">	
					<div class="left w150"><?=$this->lang->line("site_title")?><font color=red>*</font></div>
					<div class="left w300">
						<input type="text" name="site_name" class="textbox" value="<?php echo $site_name;?>" />
					</div>
					<div class="left a19">
						<?php echo form_error('site_name',"<div>","</div>");?>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="a18 pt15">	
					<div class="left w150"><?=$this->lang->line("site_description")?></div>
					<div class="left w300">
						<input type="text" name="site_description" class="textbox" value="<?php echo $site_description;?>" />
					</div>
					<div class="left a19">
						<?php echo form_error('site_description',"<div>","</div>");?>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="a18 pt15">	
					<div class="left w150"><?=$this->lang->line("webmaster_nickname")?><font color=red>*</font></div>
					<div class="left w300">
						<input type="text" name="site_username" class="textbox" value="<?php echo $site_username;?>" />
					</div>
					<div class="left a19">
						<?php echo form_error('site_username',"<div>","</div>");?>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="a18 pt15">	
					<div class="left w150"><?=$this->lang->line("admin_account")?><font color=red>*</font></div>
					<div class="left w300">
						<input type="text" name="site_admin" class="textbox" style="background:#FAFFBD" value="<?php echo $site_admin;?>"/>
					</div>
					<div class="left a19">
						<?php echo form_error('site_admin',"<div>","</div>");?>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="a18 pt15">	
					<div class="left w150"><?=$this->lang->line("admin_password")?><font color=red>*</font></div>
					<div class="left w300">
						<input type="password" name="site_passwd" class="textbox" style="background:#FAFFBD" value="<?php echo set_value("site_passwd");?>"/>
					</div>
					<div class="left a19">
						<?php echo form_error('site_passwd',"<div>","</div>");?>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="a18 pt15">	
					<div class="left w150"><?=$this->lang->line("confirm_password")?><font color=red>*</font></div>
					<div class="left w300">
						<input type="password" name="site_passwd_conf" class="textbox" value="<?php echo set_value("site_passwd_conf");?>" />
					</div>
					<div class="left a19">
						<?php echo form_error('site_passwd_conf',"<div>","</div>");?>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="a18 pt15">	
					<div class="left w150">&nbsp;</div>
					<div class="left w300">
						<input type="submit" value="<?=$this->lang->line("save_the_settings")?>"/>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		</form>
<?php $this->load->view("admin_footer");?>