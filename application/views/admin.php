<?php $this->load->view("admin_header");?>
		<div id="content">
			<div class="a15">
				<div>
					<div class="fontsize24 left">管理文章</div>
					<div class="a16 left">
						<div class="link_button"><a href="<?=site_url()?>/admin/addPost">撰写文章</a></div>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div class="a17">
					<div class="<?php echo $status==1?"link_button_red":"link_button";?> left"><a href="<?=site_url()?>/admin/index/1/_/_/0">已发布</a></div>
					<div class="<?php echo $status==2?"link_button_red":"link_button";?> left"><a href="<?=site_url()?>/admin/index/2/_/_/0">草稿箱</a></div>
					<div class="<?php echo $status==3?"link_button_red":"link_button";?> left"><a href="<?=site_url()?>/admin/index/3/_/_/0">回收站</a></div>
					<div style="clear:both;"></div>
				</div>
				<div class="textalignleft">
					<div class="left">
						<select name="op">
							<option value="1">批量操作</option>
							<option value="2">回收</option>
						</select>
						<input type="button" value="应用"/>
					</div>
					<div class="left paddingleft30">
						<select name="date">
							<option value="_" <?php echo $date_=="_"?"selected":"";?>>显示所有日期</option>
							<?php foreach($date as $item):?>
							<option value="<?=$item->df_tm?>" <?php echo $date_==$item->df_tm?"selected":"";?>><?=$item->df_tm?></option>
							<?php endforeach;?>
						</select>
						<select name="tag">
							<option value="_" <?php echo $tag_=="_"?"selected":"";?>>显示所有标签</option>
							<?php foreach($tags as $item):?>
							<option value="<?=$item->tag?>" <?php echo $tag_==$item->tag?"selected":"";?>><?=$item->tag?></option>
							<?php endforeach;?>
						</select>
						<input type="button" value="筛选"/>
					</div>
					<div class="right a11">
						<div class="left lineheight25">共 1 项</div>
						<div class="left paddingleft10"><div class="link_button paddingb"><a href="">«</a></div></div>
						<div class="left paddingleft5"><div class="link_button paddingb"><a href="">‹</a></div></div>
						<div class="left lineheight25">第</div>
						<div class="left paddingleft5"><input type="text" name="page" value="1" class="a10"/></div>
						<div class="left lineheight25">页,共 1 页</div>
						<div class="left paddingleft5"><div class="link_button paddingb"><a href="">›</a></div></div>
						<div class="left paddingleft5"><div class="link_button paddingb"><a href="">»</a></div></div>
						<div style="clear:both;"></div>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div style="padding-top:5px;">
					<table colspan=0 rowspan=0 cellpadding=0 cellspacing=0 class="a1">
						<tr class="a2">
							<td class="a3 a8"><input type="checkbox" name="opids"/></td>
							<td class="a3">标题</td>
							<td class="a3" style="width:25%;">分类</td>
							<td class="a3" style="width:15%;">时间</td>
						</tr>
						<?php for($i=0;$i<count($list);$i++):
									$id=$list[$i]->id;
									$color="a7";
									if($i%2==1){
										$color="a6";
									}
						?>
						<tr class="a4 <?=$color?>">
							<td class="a8"><input type="checkbox" name="opids"/></td>
							<td style=""><a href="<?=site_url()?>/admin/addPost/<?=$id?>" class="rightmenunochecked"><?php echo $list[$i]->title;?></a></td>
							<td style="width:25%;">
								<?php for($j=0;$j<count($list[$i]->tags);$j++):
											$tags=$list[$i]->tags;
								?>
								<a href="<?=site_url()?>/admin/index/<?=$status?>/<?php echo $tags[$j]->tag;?>" class="rightmenunochecked" style="font-size:12px;"><?php echo $tags[$j]->tag;?></a><?php echo $j==count($list[$i]->tags)-1?"":",";?>
								<?php endfor;?>
							</td>
							<td style="width:15%;"><?php echo substr($list[$i]->pub_time, 0,10);?></td>
						</tr>
						<tr class="a4 a5 <?=$color?>">
							<td class="a3"></td>
							<td class="a3 a9">
								<div class="link_button left"><a href="">编辑</a></div>
								<div class="link_button left"><a href="">回收</a></div>
								<div class="link_button left"><a href="">查看</a></div>
							</td>
							<td class="a3"></td>
							<td class="a3"></td>
						</tr>
						<?php endfor;?>
						
						<tr class="a2">
							<td class="a8"><input type="checkbox" name="opids"/></td>
							<td>标题</td>
							<td style="width:25%;">分类</td>
							<td style="width:15%;">时间</td>
						</tr>
					</table>
				</div>
				<div class="textalignleft" style="padding-top:5px;">
					<div class="left">
						<select name="op">
							<option value="1">批量操作</option>
							<option value="2">回收</option>
						</select>
						<input type="button" value="应用"/>
					</div>
					<div class="left paddingleft30">
						<select name="date">
							<option value="_" <?php echo $date_=="_"?"selected":"";?>>显示所有日期</option>
							<?php foreach($date as $item):?>
							<option value="<?=$item->df_tm?>" <?php echo $date_==$item->df_tm?"selected":"";?>><?=$item->df_tm?></option>
							<?php endforeach;?>
						</select>
						<select name="tag">
							<option value="_" <?php echo $tag_=="_"?"selected":"";?>>显示所有标签</option>
							<?php foreach($tags as $item):?>
							<option value="<?=$item->tag?>" <?php echo $tag_==$item->tag?"selected":"";?>><?=$item->tag?></option>
							<?php endforeach;?>
						</select>
						<input type="button" value="筛选"/>
					</div>
					<div class="right a11">
						<div class="left lineheight25">共 1 项</div>
						<div class="left paddingleft10"><div class="link_button paddingb"><a href="">«</a></div></div>
						<div class="left paddingleft5"><div class="link_button paddingb"><a href="">‹</a></div></div>
						<div class="left lineheight25">第</div>
						<div class="left paddingleft5"><input type="text" name="page" value="1" class="a10"/></div>
						<div class="left lineheight25">页,共 1 页</div>
						<div class="left paddingleft5"><div class="link_button paddingb"><a href="">›</a></div></div>
						<div class="left paddingleft5"><div class="link_button paddingb"><a href="">»</a></div></div>
						<div style="clear:both;"></div>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
<?php $this->load->view("admin_footer");?>