<?php $this->load->view("admin_header");?>
		<form method="post" action="<?=site_url()?>/admin/edit/<?=$id?>">
		<div id="content2">
			<div class="a15">
				<div>
					<div class="fontsize24 left">撰写页面</div>
					<div style="clear:both;"></div>
				</div>
				<div style="padding-top:15px;">
					<input type="text" name="title" class="edit_textbox" value="<?=$title?>"/>
				</div>
				<div style="padding-top:15px;">
					<script type="text/plain" id="content" name="content" class="textalignleft"><?=$content?></script>
					<script>
					UE.getEditor("content");
					</script>
				</div>
				<div style="padding-top:15px;font-size:14px;">
					<div class="left">
						<div class="left">时间：</div>
						<div class="left">
							<script>
							var str="<?=$datetime?>";
							var date2=null;
							if(str!=""){
								var strArray = str.split(" ");  
								var strDate = strArray[0].split("-");  
								var strTime = strArray[1].split(":");  
								date2 = new Date(strDate[0],(strDate[1]-parseInt(1)),strDate[2],strTime[0],strTime[1],strTime[2]);
							}else{
								date2=new Date();
							}
								$(function(){
									$("#datetime").datetimepicker({
								    	change: function (e, dt) {
								    	},
								    	date:date2
								    });
								    $("#datetime").bind("datetimepickerchange", function (e, dt) {});
								});
							</script>
							<input id="datetime" type="text" name="datetime" value="<?=$datetime?>" style="width:200px;"/>
						</div>
						<div style="clear:both;"></div>
					</div>
					<div class="right">
						<div class="right">
							<select name="status">
								<option value="1" <?php echo $status==1?"selected":"";?>>发布</option>
								<option value="2" <?php echo $status==2?"selected":"";?>>草稿</option>
							</select>
						</div>
						<div class="right">&nbsp;&nbsp;&nbsp;状态：</div>
						<div class="right">
							<select name="enable_comment">
								<option value="1" <?php echo $enable_comment==1?"selected":"";?>>允许</option>
								<option value="2" <?php echo $enable_comment==2?"selected":"";?>>禁用</option>
							</select>
						</div>
						<div class="right">评论：</div>
					</div>
					<div style="clear:both;"></div>
				</div>
				<div style="padding-top:15px;">
					<input type="submit" value="保存" class="right"/>
					<div style="clear:both;"></div>
				</div>
				
			</div>
		</div>
		<input type="hidden" name="post_or_page" value="<?=$post_or_page?>"/>
		</form>
<?php $this->load->view("admin_footer");?>