<?php include APPPATH . 'views/mobile/mobileHeader.php';?>


	<div class="container-fluid" style="margin-top:70px" >
		<div class="row-fluid" style="margin-right:auto;margin-left:auto;width:1140px">
			
			<div id="menu" class="" style="background-color:;height:800px;padding-top:20px;" >
				 <fieldset>
                    <legend class="">活动列表<a id="create" href="/mobile/index.php/template/updateTemplate" style="margin-left:300px;text-decoration:none">新建</a></legend>
	            </fieldset>	 
	            <table class="table table-striped">
	            	<tr class="">
						<th >编号</th>
						<th >模版名称</th>
						<th >修改时间</th>
						<th >操作者</th>
						<th >操作</th>
					</tr>
					{%list%}		
					<tr class="info">
						<td>{%id%}</td>
						<td>{%name%}</td>
						<td>{%modtime%}</td>
						<td>{%uid%}</td>
						<td><a href="/mobile/index.php/template/updateTemplate/{%id%}">编辑</a>&nbsp;<span>删除</span></td>
					</tr>
					{%/list%}
				</table>

	            <!-- <div class="pagination">
					<ul>
						<li><a href="#">上一页</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">下一页</a></li>
					</ul>
				</div> -->
			</div>
		</div>
	</div>

	<script>
		$(".delMall").click(function(e){
			//alert(e.target);
			var id = e.target.getAttribute("tag");
			$.ajax({
				type: "post",
				url: "/mobile/index.php/mobile/delMall",
				data:"id="+id,
				dataType:"text",
				success:function(data){
					if(data.retCode = 1){
					  alert("删除成功。");
					  location.reload();
					}else{
					  alert("删除失败，联系sharexie。");
					}
				},
				error:function(data){
					//请求出错处理
					alert("删除失败，联系sharexie。");
				}
			});
		})
	</script>       	         
</body>
</html>