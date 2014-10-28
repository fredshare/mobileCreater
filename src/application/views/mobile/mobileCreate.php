<?php include APPPATH . 'views/mobile/mobileHeader.php';?>
  

	<div class="container-fluid" style="margin-top:70px" >
		<div class="row-fluid" style="margin-right:auto;margin-left:auto;width:1140px">
			<div id="" class="span2" style="background-color:;height:800px;padding-top:20px;" >
				
			</div>
			<div id="" class="span8" style="background-color:;height:800px;padding-top:20px;" >
				<fieldset>
                    <legend class="">活动信息</legend>
	            </fieldset>
	            
				<form class="form-horizontal" action="/mobile/index.php/mobile/addMall" method="post">
					<fieldset>
						
						<div class="control-group">
							<label class="control-label" for="">活动名称</label>
							<div class="controls">
								<input class="input-xlarge focused" id="" name="title" type="text" required value="{%title%}">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="">开始时间</label>
								<div class="controls">
									<input type="text" id="" name="ontime" required >
									<span class="help-inline">格式：2013-06-28 00:00:00</span>
								</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="">结束时间</label>
								<div class="controls">
									<input type="text" id="" name="offtime" required>
									<span class="help-inline">格式：2013-06-28 00:00:00</span>
								</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="">业务类型</label>
							<div class="controls">
								<select id="" name="business" value="{%business%}">
									<option value="1">话费</option>
									<option value="2">网游</option>
									<option value="3">保险</option>
									<option value="4">基金</option>
									<option value="5">彩票</option>
									<option>移动</option>
								</select>
								<span class="help-inline">Woohoo!</span>
							</div>
						</div>
						<input class="" id="" name="uid" type="hidden" value="">
						<input class="" id="" name="id" type="hidden" value="{%id%}">
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">保存</button>
							<button class="btn">取消</button>
						</div>
					</fieldset>
				</form>            
			</div>			
		</div>
	</div>
	<script>		
		$("select[name='business']")[0].value = {%business%};
		$("input[name='ontime']").val("{%ontime%}").datepicker().datepicker("option", "dateFormat","yy-mm-dd 00:00:00");
		$("input[name='offtime']").val("{%offtime%}").datepicker().datepicker("option", "dateFormat","yy-mm-dd 00:00:00");
		$("input[name='ontime']").val("{%ontime%}");
		$("input[name='offtime']").val("{%offtime%}");
	</script>    	            
</body>
</html>