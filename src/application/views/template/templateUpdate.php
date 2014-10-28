<?php include APPPATH . 'views/mobile/mobileHeader.php';?>
  

	<div class="container-fluid" style="margin-top:70px" >
		<div class="row-fluid" style="margin-right:auto;margin-left:auto;width:1140px">
			
			<div class="span8"  style="background-color:;height:800px;padding-top:20px;" >
				<fieldset>
                    <legend class="">模版信息</legend>
	            </fieldset>
	            
				<form class="form-horizontal" action="/mobile/index.php/template/updateTemplate" method="post"> 
					<fieldset>
						
						<div class="control-group">
							<label class="control-label" for="">模版名称</label>
							<div class="controls">
								<input class="input-xlarge focused" id="name" type="text" required value="{%name%}">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="">模版内容</label>
							<div class="controls">
								<textarea id="data" name="data" >{%data%}</textarea>
								
							</div>
						</div>
						<input class="" id="uid" name="uid" type="hidden" value="<?php ?>">
						<input class="" id="id" name="id" type="hidden" value="{%id%}">
						<div class="form-actions">
							<button type="button" class="btn btn-primary" id="save">保存</button>
							<button class="btn">取消</button>
						</div>
					</fieldset>
				</form>          
			</div>			
		</div>
	</div>
	

	<script>

	var editorDiv = CodeMirror.fromTextArea(document.getElementById("data"), {
        lineNumbers: true,
        matchBrackets: true,
        continueComments: "Enter",
        theme:"monokai",
        height: "500px",//设置初始化高度
        width: "700px",
        indentUnit: 4
      });

	$("#save").click(function(){
		//获取css、div、js的值
		var div = editorDiv.getValue();
		var uid = $("#uid").val();
		var id  = $("#id").val();
		var name = $("#name").val();
		//ajax异步传输到后台
		$.ajax({
			type: "post",
			url: "/mobile/index.php/template/saveTemplate",
			data:"id="+id+"&data="+encodeURIComponent(div)+"&uid="+uid+"&name="+name,
			dataType:"json",
			success:function(data){
				if(data.ret == 1){
					alert(data.msg);
				}else{
					alert(data.msg);
				}
			},
			error:function(data){
				//请求出错处理
				alert("保存失败，联系sharexie。");
			}
		});
	});
	</script>    	            
</body>
</html>