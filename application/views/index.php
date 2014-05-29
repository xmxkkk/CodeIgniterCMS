<?php $this->load->view("index_header");?>
			<div class="left a22" style="width:770px;">
				<div>
					<?php
						if($tag_!="_"){
					?>
						<div style="padding-bottom:20px;"><div class="left textalignleft link_button_3"><?php echo $tag_?></div><div style="clear:both;"></div></div>
					<?php
						}
					?>
					<?php
						if($date_!="_"){
					?>
						<div style="padding-bottom:20px;"><div class="left textalignleft link_button_3"><?php echo $date_?></div><div style="clear:both;"></div></div>
					<?php
						}
					?>	
					<?php for($i=0;$i<count($list);$i++):?>
					<div class="index_title textalignleft">
						<a href="<?php echo site_url()?>/main/detail/<?php echo $list[$i]->id?>"><?php echo $list[$i]->title?></a>
					</div>
					<div class="a23">
						<?php for($j=0;$j<count($list[$i]->tags);$j++):
									$tags=$list[$i]->tags;
						?>
						<div class="link_button_2 left"><a href="<?php echo site_url()?>/main/index/<?php echo $tags[$j]->tag?>/_"><?php echo $tags[$j]->tag?></a></div>
						<?php endfor;?>
						<div class="left a24">by <?php echo $site_username?> at <?php echo substr($list[$i]->pub_time,0,10);?></div>
						<div style="clear:both;"></div>
					</div>
					<?php endfor;?>
				</div>
				<div class="a12">
					<div class="left">
						<?php
							if($page>0){
						?>
							<a href="<?php echo site_url()?>/main/index/<?php echo $tag_?>/<?php echo $date_?>/<?php echo $prevpage?>" class="a25"><?php echo $this->lang->line("newer_posts")?></a>
						<?php
							}
						?>
					</div>
					<div class="right">
						<?php
							if($page<$lastpage){
						?>
							<a href="<?php echo site_url()?>/main/index/<?php echo $tag_?>/<?php echo $date_?>/<?php echo $nextpage?>" class="a25"><?php echo $this->lang->line("older_posts")?></a>
						<?php
							}
						?>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
			<div style="clear:both;"></div>
<?php $this->load->view("index_footer");?>