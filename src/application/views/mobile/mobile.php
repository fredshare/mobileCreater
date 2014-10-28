<?php include APPPATH . 'views/mobile/mobileHeader.php';?>
	<div class="cover-zhezhao"></div>
	<div class="modal hide" id="tips">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>温馨提示</h3>
		</div>
		<div class="modal-body">
			<p>亲爱的用户，您不是此活动的拥有者，请联系页面加锁者{%locker%}解锁后再操作</p>
		</div>
		<div class="modal-footer">
			<a href="/v2/index.php/promote/mobileV2/showMallList/1" class="btn">返回到活动列表</a>
			<a href="#" class="btn btn-primary">刷新页面</a>
		</div>
	</div>
	<script type="text/javascript">
		if('{%locker%}' !== ""){
			$("#tips").css("display","block");
			$(".cover-zhezhao").css("display","block");
		}else{

		}
	</script>
	<div class="container-fluid" style="margin-top:70px;" >
		<div class="row-fluid" style="margin-right:auto;margin-left:auto;width:1240px">
			<div id="template" class="span2" style="background-color:;height:800px;padding-top:20px;" >
				<fieldset>
					<legend class="title">模版<small>Template</small></legend>
				</fieldset>
			</div>
			<div id="menu" class="span2 menu">
				<fieldset>
					<legend class="title">组件<small>Components</small></legend>
				</fieldset> 
			</div>
			<div id="drop" class="span2 menu" id="use" >
	            <fieldset>
					<legend class="title">模块<small>Module</small></legend>
				</fieldset>	 	
	            <div id="componentUse"></div>		
			</div>
			<div  class="span3 pre" style="width:380px">
				<iframe src="about:blank" name="previewUrl" id="previewUrl" class="iframe"></iframe>
			</div>
			
			<div class="span2" id="" style="padding-top:20px;line-height:0.8;display:" >
	            <fieldset>
					<legend class="title">操作<small>Panel</small></legend>
				</fieldset>	
	            <div class="oper">
					<p id="preMall">保存&amp;发布DEV</p>
				</div>
				<div class="oper">
					<p id="pubMall">发布IDC</p>
				</div>
				<div class="oper">
					<p id="queryMall">网页查看</p>
				</div>			
			</div>
		</div>
	</div>

	<!-- popup ADD NEW page start -->
	<div id="popup" class="popup">
		<!-- <ul class="nav nav-tabs" id="myTab">
			<li class="active">
				<a href="#pro"  data-toggle="tab">配置信息框</a>
			</li>
		</ul> -->
		<a id="closePop" href="#nolink" class="cls icon-remove"></a>

		<div class="tab-content">
			<!-- new project start -->
			<div class="tab-pane active" id="">
				<div id="configContent">
					<p>
						<label class="att">图片：</label>
						<input id=""  type="text" data-provide="">	
					</p>
					<p>
						<label class="att">图片：</label>
						<input id=""  type="text" data-provide="">	
					</p>
					<p>
						<label class="att">图片：</label>
						<input id=""  type="text" data-provide="">	
					</p>
				</div>
					
				<p class="submit-btn">
					<a id="saveConfig" href="#nolink" class="btn btn-success" style="margin-left:100px;">保存</a>
					<a id="cancelConfig" href="#nolink" class="btn btn-info" style="margin-left:10px;">取消</a>
				</p>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
	mobile_mall = {};
	mobile_mall.global = {
		isEdit : false,
		id:'',
		mallContent:'',
		templateId:''
	};

	mobile_mall.component = {};
	mobile_mall.component.data = [];
	mobile_mall.component.css = {};
	mobile_mall.component.js = {};
	mobile_mall.component.configComMap = {};
	mobile_mall.component.configCom = [];
	mobile_mall.component.currentCom = {};
	mobile_mall.component.currentComConfig = {};

	</script>
	<script src="/mobile/web/js/mobile_com.js"></script>
	<script src="/mobile/web/js/mobile_edit.js"></script>
	<script type="text/javascript" charset="utf-8" src="/mobile/web/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/mobile/web/ueditor/ueditor.all.js"></script>


	<script>
		(function($){
        	$(window).load(function(){
            	var data = {%data%},
            	businessId = {%business%},
            	comData = data.component,
            	templateId = {%templateId%},
            	id = {%id%};

            	mobile_mall.initEdit(id,comData,templateId,businessId);
	        });

	    })(jQuery);
	</script>
</body>
</html>