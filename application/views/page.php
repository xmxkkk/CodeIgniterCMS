<?php $this->load->view("admin_header");?>
		<form method="post" action="<?php echo site_url()?>/admin/recycle/page">
		<div id="content">
			<div class="a15">
				<div>
					<div class="fontsize24 left"><?php echo $this->lang->line("management_page")?></div>
					<div class="a16 left">
						<div class="link_button"><a href="<?php echo site_url()?>/admin/addPage"><?php echo $this->lang->line('writing_page')?></a></div>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="a17">
					<div class="<?php echo $status==1?"link_button_red":"link_button";?> left"><a href="<?php echo site_url()?>/admin/page/1/_/_/0"><?php echo $this->lang->line("published")?></a></div>
					<div class="<?php echo $status==2?"link_button_red":"link_button";?> left"><a href="<?php echo site_url()?>/admin/page/2/_/_/0"><?php echo $this->lang->line("drafts")?></a></div>
					<div class="<?php echo $status==3?"link_button_red":"link_button";?> left"><a href="<?php echo site_url()?>/admin/page/3/_/_/0"><?php echo $this->lang->line("recycle_bin")?></a></div>
					<div style="clear:both;"></div>
				</div>
				<div class="textalignleft">
					<div class="left">
						<select name="method">
							<option value="1"><?php echo $this->lang->line("bulk_operations")?></option>
							<?php if($status==3):?>
							<option value="delete"><?php echo $this->lang->line("delete")?></option>
							<option value="publish"><?php echo $this->lang->line("revert")?></option>
							<?php else:?>
							<option value="recycle"><?php echo $this->lang->line("recycle")?></option>
							<?php endif;?>
						</select>
						<input type="submit" value="<?php echo $this->lang->line("apply")?>"/>
					</div>
					<div class="left paddingleft30">
						<select name="date" onchange="choose('<?php echo site_url()?>/admin/page/<?php echo $status?>/');">
							<option value="_" <?php echo $date_=="_"?"selected":"";?>><?php echo $this->lang->line("all_dates")?></option>
							<?php foreach($date as $item):?>
							<option value="<?php echo $item->df_tm?>" <?php echo $date_==$item->df_tm?"selected":"";?>><?php echo $item->df_tm?></option>
							<?php endforeach;?>
						</select>
						<a id="get" href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/0"><input type="button" value="<?php echo $this->lang->line("filter")?>"/></a>
					</div>
					<div class="right a11">
						<div class="left lineheight25">共 <?php echo $cnt?> 项</div>
						<div class="left paddingleft10"><a href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/<?php echo 0?>"><div class="link_button paddingb">«</div></a></div>
						<div class="left paddingleft5"><a href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/<?php echo $prevpage?>"><div class="link_button paddingb">‹</div></a></div>
						<div class="left lineheight25">第 <?php echo $currentpage?> 页,共 <?php echo $totalpage?> 页</div>
						<div class="left paddingleft5"><a href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/<?php echo $nextpage?>"><div class="link_button paddingb">›</div></a></div>
						<div class="left paddingleft5"><a href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/<?php echo $lastpage?>"><div class="link_button paddingb">»</div></a></div>
						<div style="clear:both;"></div>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div style="padding-top:5px;">
					<table id="list" colspan=0 rowspan=0 cellpadding=0 cellspacing=0 class="a1">
						<tr class="a2">
							<td class="a3 a8"><input type="checkbox" name="opids"/></td>
							<td class="a3"><?php echo $this->lang->line("title")?></td>
							<td class="a3" style="width:25%;"></td>
							<td class="a3" style="width:15%;"><?php echo $this->lang->line("time")?></td>
						</tr>
						<?php for($i=0;$i<count($list);$i++):
									$id=$list[$i]->id;
									$color="a7";
									if($i%2==1){
										$color="a6";
									}
						?>
						<tr class="a4 <?php echo $color?>">
							<td class="a8"><input type="checkbox" name="opid[]" value="<?php echo $id?>"/></td>
							<td style="">
								<a href="<?php echo site_url()?>/admin/addPage/<?php echo $id?>" class="rightmenunochecked"><?php echo $list[$i]->title;?></a>
							</td>
							<td style="width:25%;"></td>
							<td style="width:15%;"><?php echo substr($list[$i]->pub_time, 0,10);?></td>
						</tr>
						<tr class="a4 a5 <?php echo $color?>">
							<td class="a3"></td>
							<td class="a3 a9">
								<div class="link_button left" style="display:none;"><a href="<?php echo site_url()?>/admin/addPage/<?php echo $id?>"><?php echo $this->lang->line("edit")?></a></div>
								<?php if(intval($status)==3):?>
								<div class="link_button left" style="display:none;"><a href="<?php echo site_url()?>/admin/recycle/page/<?php echo $status?>/<?php echo $id?>/publish"><?php echo $this->lang->line("revert")?></a></div>
								<div class="link_button left" style="display:none;"><a href="<?php echo site_url()?>/admin/recycle/page/<?php echo $status?>/<?php echo $id?>/delete"><?php echo $this->lang->line("delete")?></a></div>
								<?php else:?>
								<div class="link_button left" style="display:none;"><a href="<?php echo site_url()?>/admin/recycle/page/<?php echo $status?>/<?php echo $id?>"><?php echo $this->lang->line("recycle")?></a></div>
								<?php endif;?>
								<div class="link_button left" style="display:none;"><a href="<?php echo site_url()?>/main/detail/<?php echo $id?>"><?php echo $this->lang->line("view")?></a></div>
							</td>
							<td class="a3"></td>
							<td class="a3"></td>
						</tr>
						<?php endfor;?>
						
						<tr class="a2">
							<td class="a8"><input type="checkbox" name="opids"/></td>
							<td><?php echo $this->lang->line("title")?></td>
							<td class="a3" style="width:25%;"></td>
							<td style="width:15%;"><?php echo $this->lang->line("time")?></td>
						</tr>
					</table>
				</div>
				<div class="textalignleft" style="padding-top:5px;">
					<div class="left">
						<select name="method">
							<option value="1"><?php echo $this->lang->line("bulk_operations")?></option>
							<?php if($status==3):?>
							<option value="delete"><?php echo $this->lang->line("delete")?></option>
							<option value="publish"><?php echo $this->lang->line("revert")?></option>
							<?php else:?>
							<option value="recycle"><?php echo $this->lang->line("recycle")?></option>
							<?php endif;?>
						</select>
						<input type="submit" value="<?php echo $this->lang->line("apply")?>"/>
					</div>
					<div class="right a11">
						<div class="left lineheight25">共 <?php echo $cnt?> 项</div>
						<div class="left paddingleft10"><a href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/<?php echo 0?>"><div class="link_button paddingb">«</div></a></div>
						<div class="left paddingleft5"><a href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/<?php echo $prevpage?>"><div class="link_button paddingb">‹</div></a></div>
						<div class="left lineheight25">第 <?php echo $currentpage?> 页,共 <?php echo $totalpage?> 页</div>
						<div class="left paddingleft5"><a href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/<?php echo $nextpage?>"><div class="link_button paddingb">›</div></a></div>
						<div class="left paddingleft5"><a href="<?php echo site_url()?>/admin/page/<?php echo $status?>/_/<?php echo $date_?>/<?php echo $lastpage?>"><div class="link_button paddingb">»</div></a></div>
						<div style="clear:both;"></div>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<input type="hidden" name="status" value="<?php echo $status?>">
		<input type="hidden" name="status" value="<?php echo $status?>">
		<input type="hidden" name="post_or_page" value="page">
		
		</form>
<?php $this->load->view("admin_footer");?>