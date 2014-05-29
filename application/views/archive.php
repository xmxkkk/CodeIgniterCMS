<?php $this->load->view("index_header");?>
			<div class="left a22 textalignleft" style="width:770px;">
				<div style="padding-top:30px;">
					<div class="left" style="width:200px;">
						<div class="a27"><?php echo $this->lang->line("month")?></div>
						<?php foreach($date as $item):?>
							<div class="navbar"><a href="<?php echo site_url("main/index/_/".$item->df_tm)?>" style="font-size:14px;"><?php echo $item->df_tm?></a></div>
						<?php endforeach;?>
					</div>
					<div class="left" style="width:200px;">
						<div class="a27"><?php echo $this->lang->line("label")?></div>
						<?php foreach($tags as $item):?>
							<div class="navbar"><a href="<?php echo site_url("/main/index/".$item->tag."/_")?>" style="font-size:14px;"><?php echo $item->tag?></a></div>
						<?php endforeach;?>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div style="clear:both;"></div>
<?php $this->load->view("index_footer");?>