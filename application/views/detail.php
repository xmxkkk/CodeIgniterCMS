<?php $this->load->view("index_header");?>
			<div class="left a22" style="width:770px;">
				<div>
					<?php for($i=0;$i<count($list);$i++):?>
					<div class="index_title textalignleft">
						<a href="<?php echo site_url()?>/main/detail/<?php echo $list[$i]->id?>"><?php echo $list[$i]->title?></a>
					</div>
					<div class="a23" style="padding-bottom:10px;">
						<?php for($j=0;$j<count($list[$i]->tags);$j++):
									$tags=$list[$i]->tags;
						?>
						<div class="link_button_2 left"><a href="<?php echo site_url()?>/main/index/<?php echo $tags[$j]->tag?>/_"><?php echo $tags[$j]->tag?></a></div>
						<?php endfor;?>
						<div class="left a24">by <?php echo $site_username?> at <?php echo substr($list[$i]->pub_time,0,10);?></div>
						<div style="clear:both;"></div>
					</div>
					<div class="textalignleft" style="font-size:14px;padding-bottom:30px;">
						<?php echo $list[$i]->content?>
					</div>
					<?php
						if(intval($list[$i]->enable_comment)==1){
					?>
						<!-- UY BEGIN -->
						<div id="uyan_frame"></div>
						<script type="text/javascript" id="UYScript" src="http://v1.uyan.cc/js/iframe.js?UYUserId=1669935" async=""></script>
						<!-- UY END -->
					<?php
						}
					?>
					
					<?php endfor;?>
				</div>
				
			</div>
			<div style="clear:both;"></div>
<?php $this->load->view("index_footer");?>