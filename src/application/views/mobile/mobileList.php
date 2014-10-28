<?php include APPPATH . 'views/mobile/mobileHeader.php';?>
	<div class="container-fluid" style="margin-top:70px" >
		<div class="row-fluid" style="margin-right:auto;margin-left:auto;width:1140px">
			<div id="template" class="span3" style="background-color:;height:800px;padding-top:20px;" >
				<fieldset>
                    <legend class="">业务区域</legend>
	            </fieldset>
	            <ul class="nav nav-list bs-docs-sidenav affix">
					<li tag="1"><a href="/mobile/index.php/mobile/index/1"><i class="icon-chevron-right"></i> 话费</a></li>
					<li tag="2"><a href="/mobile/index.php/mobile/index/2"><i class="icon-chevron-right"></i> 网游</a></li>
					<li tag="3"><a href="/mobile/index.php/mobile/index/3"><i class="icon-chevron-right"></i> 保险</a></li>
					<li tag="4"><a href="/mobile/index.php/mobile/index/4"><i class="icon-chevron-right"></i> 基金</a></li>
					<li tag="5"><a href="/mobile/index.php/mobile/index/5"><i class="icon-chevron-right"></i> 彩票</a></li>
		        </ul>
	            
	            
			</div>
			<div id="menu" class="span9" style="background-color:;height:800px;padding-top:20px;" >
				 <fieldset>
                    <legend class="">活动列表<a id="create" href="/mobile/index.php/mobile/createMall" style="margin-left:300px;text-decoration:none">新建</a></legend>
	            </fieldset>	 
	            <table class="table table-striped">
	            	<tr class="">
						<th >编号</th>
						<th width="20%">活动名称</th>
						<th >活动链接</th>
						<th >状态</th>
						<th >修改时间</th>
						<th >操作者</th>
						<th >锁定者</th>
						<th >操作</th>
					</tr>
					{%list%}		
					<tr class="info">
						<td>{%id%}</td>
						<td>{%title%}</td>
						<td><a href="{%turl%}" target="_blank">查看</a></td>
						<td><script>if({%status%}==1){document.write("<p style='color:green'>dev</p>")}else{document.write("<p style='color:red'>idc</p>")}</script></td>
						<td>{%modtime%}</td>
						<td>{%uid%}</td>
						<td><script>if('{%locker%}'=="无人"){document.write("<span class='unlock' tag={%id%}>{%locker%}</span>")}else{document.write("<span class='lock' tag={%id%}>{%locker%}</span>")}</script></td>
						<td><a href="/mobile/index.php/mobile/showMall/{%id%}" tag="{%id%}" class='editMall' locker="{%locker%}">编辑</a>&nbsp;<a href="/mobile/index.php/mobile/createMall/{%id%}">修改</a>&nbsp;<a href="#none"><span tag="{%id%}" class="delMall">删除</span></a></td>
					</tr>
					{%/list%}
				</table>

	            <div class="pages">{%pageBar%}</div>

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
					if(data){
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
		var business=location.pathname.split("/")[6]?location.pathname.split("/")[6]:1;
		$(".nav li[tag='"+business+"']").addClass("active");

		$(".unlock").click(function(e){
			var id = e.target.getAttribute("tag");
			var locker = $(e.target).html() == "无人" ? null : $(e.target).html();
			$.ajax({
				type: "post",
				url: "/mobile/index.php/mobile/changeLockStatus",
				data:"id="+id+"&user="+encodeURIComponent($.cookie("userName"))+"&locker="+locker,
				dataType:"json",
				success:function(data){
					if(data.ret == 0){
					  alert("加锁成功。");
					  location.reload();
					}else{
					  alert(data.msg);
					}
				},
				error:function(data){
					//请求出错处理
					//alert("加锁失败，联系sharexie。");
				}
			});
		})
		$(".lock").click(function(e){
			var id = e.target.getAttribute("tag");
			var locker = $(e.target).html();
			$.ajax({
				type: "post",
				url: "/mobile/index.php/mobile/changeLockStatus",
				data:"id="+id+"&user=null&locker="+locker,
				dataType:"json",
				success:function(data){
					if(data.ret == 0){
					  alert("解锁成功。");
					  location.reload();
					}else{
					  alert(data.msg);
					}
				},
				error:function(data){
					//请求出错处理
					alert("解锁失败，联系sharexie。");
				}
			});
		})

		//点击编辑页面，进入编辑页面之前先加锁
		$(".editMall").click(function(e){
			var id = e.target.getAttribute("tag");
			var locker = e.target.getAttribute("locker") == "无人" ? null : e.target.getAttribute("locker");
			$.ajax({
				type: "post",
				url: "/mobile/index.php/mobile/changeLockStatus",
				data:"id="+id+"&user="+$.cookie("userName")+"&locker="+locker,
				dataType:"json",
				success:function(data){
					if(data.ret == 0){
					  	openwin("/mobile/index.php/mobile/showMall/"+id);
					}else{
					  	alert(data.msg);
					}
				},
				error:function(data){
					//请求出错处理
					//alert("加锁失败，联系sharexie。");
				}
			});
			
			
		})
		openWin = function(url) {
			var a = document.createElement("a");
			a.setAttribute("href", url);
			a.setAttribute("target", "_self");
			a.setAttribute("id", "openwin");
			document.body.appendChild(a);
			//模拟点击事件
			if (document.all) {
				a.click();
			} else {
				var m = document.createEvent("MouseEvents"); //FF的处理 
				m.initEvent("click", true, true);
				a.dispatchEvent(m);
			}
		}

	</script>       	         
</body>
</html>