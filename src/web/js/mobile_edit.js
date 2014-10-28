/**
 *  info:mobile promotion system
 *	author:sharexie
 *	time:2013-07-19
 *	version:v2.0.1
 */

/***********page init*****************/

mobile_mall.initEdit = function(id, data, templateId,businessId) {
	mobile_mall.global.id = id;
	mobile_mall.global.templateId = templateId;
	mobile_mall.global.businessId = businessId;
	mobile_mall.global.phpNamePrefix='mp_';
	mobile_mall.initComponentHash();
	mobile_mall.createTemplate(templateId);
	//mobile_mall.setTemplate(templateId);
	mobile_mall.setMenu();
	mobile_mall.initMallData(id, data);
	
	//addEvent
	mobile_mall.addEvent();
	
}

/***********page function*****************/
//create template
mobile_mall.createTemplate = function(templateId){
	$.ajax({
		url: "/mobile/index.php/template/templateList/2",
		data: "",
		type: "POST",
		dataType: "json",
		success: function(ret) {
			if(ret && ret.length > 0){
				for (var i = 0; i < ret.length; i++) {
					$("#template").append("<div class='template'><label class='radio'><input type='radio' name='template' value='"+ ret[i]['id'] +"'><p style='color:white'>"+ ret[i]['name'] +"</p></label></div>");				
				};
				mobile_mall.setTemplate(templateId);
				$("input[name='template']").change(function(){
					$(this).parent().parent().siblings().removeClass("cur");
					$(this).parent().parent().addClass("cur");

					mobile_mall.setIFrameContent();
				});
				mobile_mall.setIFrameContent();
			}else{
				alert("暂时没有模版，请先创建模版吧")
			}
		},
		error: function(ret) {
			alert("获取模版失败，联系sharexie");
		}
	});
}
//set preview area template
mobile_mall.setTemplate = function(value) {
	$("input[name=template][value=" + value + "]").attr("checked", true);
	$("input[name=template][value=" + value + "]").parent().parent().addClass("cur");
}
mobile_mall.getTemplate = function() {
	var templateId = $("input[name='template']:checked").val();
	if (templateId) {
		templateId = parseInt(templateId);
	} else {
		templateId = 1;
	}
	return mobile_mall.global.templateId = templateId;
}
//set menu
mobile_mall.setMenu = function() {
	if (mobile_mall.component.configCom && mobile_mall.component.configCom.length > 0) {
		var configCom = mobile_mall.component.configCom,className={};
		for (var i = 0; i < configCom.length; i++) {
			className[configCom[i].className]=1;
		}
		for(var j in className){
			$("#menu").append($("<div class='bu'><h2 tag='menuFold'>"+ j +"</h2><div class='bd'></div></div>"));
		}
		for (var i = 0; i < configCom.length; i++) {


			if(configCom[i].author){
				//first set class
				var name = configCom[i].name;
				var key = configCom[i].key;
				$("#menu  h2:contains('"+ configCom[i].className +"')").siblings().append($("<div class='drag menu-components' style='background-color:#94c06b;' key='" + key + "'><p>" + name + "</p></div>"));
			}else{

			}
			
		}
		$("h2[tag='menuFold']").siblings().hide();
	}
}
//init mall's data
mobile_mall.initMallData = function(id, data) {
	if (data) {
		for (var i = 0; i < data.length; i++) {
			var item = data[i];
			//filter useless data
			if (JSON.stringify(item) != '{}') {
				mobile_mall.component.data.push(item);
			}
		}
		for(var i=0;i<mobile_mall.component.data.length;i++){
			mobile_mall.showComponent(mobile_mall.component.data[i]);
		}
	}
}
//set preview's iframe url
mobile_mall.setUrl = function(turl){
	$("#previewUrl")[0].setAttribute("src",turl);
}

//component's index
mobile_mall.initComponentHash = function() {
	for (var i = 0; i < mobile_mall.component.configCom.length; i++) {
		var item = mobile_mall.component.configCom[i];
		mobile_mall.component.configComMap[item.key] = item;
	}
}
//show components
mobile_mall.showComponent = function(data) {
	if (data.data && data.data.key && mobile_mall.component.configComMap[data.data.key]) {
		var component = mobile_mall.component.configComMap[data.data.key];
		$("#componentUse").append($("<div componentId=" + data.componentId + " key='" + data.data.key + "'><div class='component'><div class='menu-com selected'  key=''><p>"+component.name+"</p><a data-provide='deleteComponent' href='#nolink' class='btn-close'>X</a></div>" + "</div></div>"));
	}

}

mobile_mall.randomComponentId = function() {
	return 'component_' + parseInt(Math.random() * 1000000);
}

//add component to componentUse area
mobile_mall.addComponent = function(key) {
	var componentId = mobile_mall.randomComponentId();
	if (mobile_mall.component.configComMap[key]) {
		var component = mobile_mall.component.configComMap[key];
		$("#componentUse").append($("<div componentId=" + componentId + " key='" + key + "'><div class='component'><div class='drag menu-com selected' key=''><p>"+component.name+"</p><a data-provide='deleteComponent' href='#nolink' class='btn-close' onclick='mobile_mall.delete(event)'>X</a></div>" + "</div></div>"));
		var data = {
			'componentId': componentId,
			'data' : {
				'key' : key,
				'data':{}
			}
		};
		mobile_mall.component.data.push(data);
		var componentData = mobile_mall.getComponentData(componentId);
		var configData = [];
		if(component.tab && component.tab.length > 1){
			for (var j = component.tab.length - 1; j >= 0; j--) {
				configData = configData.concat(component[component.tab[j].config]);
			};
		}else{
			configData = component.configHtml;
		}
		
		for (var i = 0; i < configData.length; i++) {
			componentData.data.data[configData[i].key]=configData[i].tolerate;
		};
	}
		
}

//gen config html from config object
mobile_mall.genConfigHtml = function(componentId,configObj){
	var type = ["textarea","checkbox","select","color","colorpick","url","img","text","radio","time","textEditor","empty","bar"];
	var html = "";
	//obj is a json data from mobile_mall_component_v2.js
	var componentData = mobile_mall.getComponentData(componentId);
	for (var i = 0; i < configObj.length; i++) {
		if(configObj[i].type == "text"){
			html += "<p><label class='att'>" + configObj[i].name + "：</label><input id='"+ configObj[i].key+"' type='text' data-provide='config' value='"+ componentData.data.data[configObj[i].key] +"'></p>";
		}else if(configObj[i].type == "url"){
			html += "<p><label class='att'>" + configObj[i].name + "：</label><input id='"+ configObj[i].key+"' type='url' data-provide='config' value='"+ componentData.data.data[configObj[i].key] +"'></p>";
		}else if(configObj[i].type == "img"){
			html += "<p><label class='att'>" + configObj[i].name + "：</label><input id='"+ configObj[i].key+"' type='url' data-provide='config' value='"+ componentData.data.data[configObj[i].key] +"'></p>";
		}else if(configObj[i].type == "checkbox"){
			var temp = "";
			for (var j = 0; j < configObj[i].choice.length; j++) {
				if(	$.inArray(configObj[i].choice[j],componentData.data.data[configObj[i].key])>-1){
					temp += "<input name='"+ configObj[i].key+"' type='checkbox' checked data-provide='config' value='"+ configObj[i].choice[j] +"'>"+ configObj[i].show[j] +"&nbsp;";
				}else{
					temp += "<input name='"+ configObj[i].key+"' type='checkbox' data-provide='config' value='"+ configObj[i].choice[j] +"'>"+ configObj[i].show[j] +"&nbsp;";
				}		
			};
			html += "<p><label class='att'>" + configObj[i].name + "：</label>"+ temp +"</p>";
		}else if(configObj[i].type == "radio"){
			var temp = "";
			for (var j = 0; j < configObj[i].choice.length; j++) {
				if(componentData.data.data[configObj[i].key] == configObj[i].choice[j]){
					temp += "<input name='"+ configObj[i].key+"' type='radio' checked data-provide='config' value='"+ configObj[i].choice[j] +"'>"+ configObj[i].show[j] +"&nbsp;";
				}else{
					temp += "<input name='"+ configObj[i].key+"' type='radio' data-provide='config' value='"+ configObj[i].choice[j] +"'>"+ configObj[i].show[j] +"&nbsp;";
				}

			};
			html += "<p><label class='att'>" + configObj[i].name + "：</label>"+ temp +"</p>";
		}else if(configObj[i].type == "textarea"){
			html += "<p><label class='att'>" + configObj[i].name + "：</label><textarea  style='height:200px;width:300px;' id='"+ configObj[i].key+"' data-provide='config'>"+ componentData.data.data[configObj[i].key]  +"</textarea></p>";
		}else if(configObj[i].type == "select"){
			var temp = "<select id='"+ configObj[i].key +"' data-provide='config'>";
			for (var j = 0; j < configObj[i].choice.length; j++) {
				if(componentData.data.data[configObj[i].key] == configObj[i].choice[j]){
					temp += "<option selected value ='"+ configObj[i].choice[j] +"'>"+ configObj[i].show[j] +"</option>";
				}else{
					temp += "<option value ='"+ configObj[i].choice[j] +"'>"+ configObj[i].show[j] +"</option>";
				}

			};
			temp += "</select>";
			html += "<p><label class='att'>" + configObj[i].name + "：</label>"+ temp +"</p>";
		}else if(configObj[i].type == "color"){
			html += "<p><label class='att'>" + configObj[i].name + "：</label><input id='"+ configObj[i].key+"' type='color' data-provide='config' value='"+ componentData.data.data[configObj[i].key] +"'></p>";
		}else if(configObj[i].type == "colorpick"){
			var temp = "";
			for (var j = 0; j < configObj[i].choice.length; j++) {
				if(componentData.data.data[configObj[i].key] == configObj[i].choice[j]){
					temp += "<input name='"+ configObj[i].key+"' type='radio' checked data-provide='config' value='"+ configObj[i].choice[j] +"'><span style='display:;width:10px;height:10px;background-color:"+ configObj[i].show[j] +"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
				}else{
					temp += "<input name='"+ configObj[i].key+"' type='radio'  data-provide='config' value='"+ configObj[i].choice[j] +"'><span style='display:;width:10px;height:10px;background-color:"+ configObj[i].show[j] +"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
				}

			};
			html += "<p><label class='att'>" + configObj[i].name + "：</label>"+ temp +"</p>";
		}else if(configObj[i].type == "time"){
			html += "<p><label class='att'>" + configObj[i].name + "：</label><input id='"+ configObj[i].key+"' type='text' tag='time' data-provide='config' value='"+ componentData.data.data[configObj[i].key] +"'></p>";
			
		}else if(configObj[i].type == "textEditor"){
			html += "<p><label class='att' style='float:none'>" + configObj[i].name + "：</label><textarea id='"+ configObj[i].key +"' name='"+ configObj[i].key +"' tag='textEditor' type='textEditor' data-provide='config' style:'width:300px;height:500px;'>"+ componentData.data.data[configObj[i].key] +"</textarea></p>";
		}else if(configObj[i].type == "empty"){
			html += "<p><label class='att'>"+ configObj[i].name +":</label><label class='att'>"+componentData.data.data[configObj[i].key]+"</label></p>";
		}else if(configObj[i].type == "bar"){
			html += "<br /><hr style='height:5px;border:none;border-top:2px solid #555555;'/><br />";
		}
		
	};
	return html;
}

//open config window
mobile_mall.openPop = function(componentId,key,html){
	$("#popup").css("display","block");
	$("#popup").attr("componentId",componentId);
	$("#popup").attr("key",key);
	$("#configContent").html(html);
	$(".cover-zhezhao").css("display","block");
	$("#closePop")[0].onclick = function(){
		$("#popup").css("display","none");
		$(".cover-zhezhao").css("display","none");
		var comConfig = mobile_mall.component.configComMap[$("#popup").attr("key")];
		for (var i = 0; i < comConfig.configHtml.length; i++) {
			if(comConfig.configHtml[i].type == "textEditor"){
				UE.getEditor(comConfig.configHtml[i].key).destroy();
			}
		};
	};
	$("#cancelConfig")[0].onclick = function(){
		$("#popup").css("display","none");
		$(".cover-zhezhao").css("display","none");
		var comConfig = mobile_mall.component.configComMap[$("#popup").attr("key")];
		for (var i = 0; i < comConfig.configHtml.length; i++) {
			if(comConfig.configHtml[i].type == "textEditor"){
				UE.getEditor(comConfig.configHtml[i].key).destroy();
			}
		};
	};
}
//删除组件
mobile_mall.deleteComponent = function(componentId) {
	if (componentId) {
		for (var i = 0; i < mobile_mall.component.data.length; i++) {
			if (mobile_mall.component.data[i].componentId == componentId) {
				mobile_mall.component.data.splice(i, 1);
				return true;
			}
		};
	}
}

//get component obj from data througth componentId
mobile_mall.getComponentData = function(componentId) {
	for (var i = 0; i < mobile_mall.component.data.length; i++) {
		if (mobile_mall.component.data[i]["componentId"] == componentId) {
			mobile_mall.component.currentCom = mobile_mall.component.data[i];
			return mobile_mall.component.data[i];
		}
	}
	return false;
}
//pack mall data
mobile_mall.packMallData = function() {
	var useComponents = $("#componentUse > div");
	var componentIds = [];
	for (var i = 0; i < useComponents.length; i++) {
		componentIds.push(useComponents[i].getAttribute("componentId"));
	};
	var data = {
		component : []
	};
	for (var i = 0; i < componentIds.length; i++) {
		var componentData = mobile_mall.getComponentData(componentIds[i]);
		data.component.push(componentData);
	};
	return JSON.stringify(data);
}

mobile_mall.getPreHtml = function(){
	var useComponents = $("#componentUse > div");
	var componentIds = [],componentKeys = [];
	for (var i = 0; i < useComponents.length; i++) {
		componentIds.push(useComponents[i].getAttribute("componentId"));
		componentKeys.push(useComponents[i].getAttribute("key"));
	};
	var html="",keys={},css="",js="",cssFile="",jsFile="",funcs="",php=[];
	var mallId=mobile_mall.global.id;

	for (var k = 0; k < componentIds.length; k++) {
		var componentData = mobile_mall.getComponentData(componentIds[k]); 
		
		var key = componentData.data.key;
		keys[key]=1;
		var data = componentData.data.data;
		var comConfig = mobile_mall.component.configComMap[key];
		var tempHtml = comConfig.preHtml(componentData.data.data,componentIds[k],mallId);
		var tempData=mobile_mall.getComponentData(componentIds[k])['data']['data'];
		var tempConfig = comConfig.configHtml;
		//如果该组件会生成php接口，则接口名称按这个规则生成，并作为组件运行时参数
		var tempPhpCGIPrefix=mobile_mall.global.phpNamePrefix+mobile_mall.global.id;
		//html
		for (var j = 0; j < tempConfig.length; j++) {
			var reg=new RegExp("{{"+tempConfig[j].key+"}}","g");
			tempHtml = tempHtml.replace(reg,data[tempConfig[j].key]);
			
		};
		html += tempHtml;
		//funcs
		if(!comConfig.js){
			funcs += "";
		}else if(typeof comConfig.js == "function"){
			funcs += componentKeys[k]+"_func(mobile_mall.data['"+ componentIds[k] +"']['data'],'"+ componentIds[k] +"','"+mallId+"','"+tempPhpCGIPrefix+"');\r\n";
		}else{
			funcs += "";
		}
			
		//css
		if(!comConfig.css){
			css += '';
		}else if(typeof comConfig.css == "function"){
			css += comConfig.css(tempData,componentIds[k],mallId);
		}else{
			css += comConfig.css;
		}

		//php
		if(comConfig.php){
			//php为一个数组，数组元素必须为
			//{
			//	action:'guajiang',//必填，自动模板类型
			//	其余字段为按各模板要求选填
			//}
			var phpItem;
			if((typeof comConfig.php).toLowerCase()=='function'){
				phpItem=comConfig.php(tempData,componentIds[k],mallId);
			}else if((typeof comConfig.php).toLowerCase()=='object'){
				phpItem=comConfig.php;
			}
			if(phpItem){
				//设置php生成时controller的接口名称
				phpItem.activeId=tempPhpCGIPrefix+'_'+componentIds[k];
				php.push(phpItem);
			}
		}
	};
	
	for(key in keys){
		var comConfig = mobile_mall.component.configComMap[key]; 
		
		var comFuncName=comConfig.key+'_func';
		if(!comConfig.js){
			js += '';
		}else if(typeof comConfig.js == "function"){
			js += 'var '+comFuncName+'='+comConfig.js.toString() + ";\r\n";
		}else{
			js += '';
		}

		var cssFileArr = comConfig.cssFile ? comConfig.cssFile : [];
		var jsFileArr  = comConfig.jsFile  ? comConfig.jsFile  : [];
		for (var i = 0; i < cssFileArr.length; i++) {
			cssFile += "<link href='"+ cssFileArr[i] +"' type='text/css' rel='stylesheet' media='screen' />";
		};
		for (var i = 0; i < jsFileArr.length; i++) {
			var jsFileItem=jsFileArr[i];
			var jsUrl=(typeof jsFileItem=='string')?jsFileItem:jsFileItem.url;
			var fileCharset=(typeof jsFileItem=='string')?'gbk':jsFileItem.charset;
			jsFile += "<script src='"+ jsUrl +"' type=\"text/javascript\"  charset=\""+fileCharset+"\"/></script>";
		};
	}

	return {
		css:cssFile +"<style>"+ css +"</style>",
		js:jsFile +"\r\n<script>\r\n"+ js + "\r\n" + funcs +"</script>",
		html:html,
		php:php
	};
}

//get template html from mobile_mall.global.templateId
mobile_mall.getTemplateHtml = function(){
	mobile_mall.data = {};
	for (var i = 0; i < mobile_mall.component.data.length; i++) {
		mobile_mall.data[mobile_mall.component.data[i].componentId] = mobile_mall.component.data[i];
	};
	var templateId = mobile_mall.getTemplate();
	$.ajax({
		url: "/mobile/index.php/template/getTemplateHtml",
		data: "templateId=" + templateId,
		type: "POST",
		dataType: "text",
		success: function(ret) {
			if(ret){
				//mobile_mall.global.templateHtml = ;
				var html = ret;
				var year = (new Date()).getFullYear();
				var addJs = "<script type='text/javascript'>window.mobile_mall="+ JSON.stringify(mobile_mall) +"</script>";
				var reg1 = new RegExp("{{modDiv}}","g");
				var reg2 = new RegExp("{{modCss}}","g");
				var reg3 = new RegExp("{{modJs}}","g");
				var tempObj = mobile_mall.getPreHtml();
				var finalHtml = html.replace(reg1,tempObj.html).replace(reg2,tempObj.css).replace(reg3,addJs+tempObj.js);
				//use iframe to insinsulate the edited page from the system
				//why set iframe's content to preview the page ,not the url is because protect the data in database;
				//to execute the javacritpt code in the iframe;
				//$("#previewUrl")[0].contentWindow.document.body.innerHTML = finalHtml; 
				//$("#previewUrl")[0].contentWindow.document.getElementsByTagName('html')[0].innerHTML = finalHtml;
				//$($("#previewUrl")[0].contentWindow.document.getElementsByTagName('html')[0]).html(finalHtml);
				//$("#previewUrl")[0].contentWindow.document.getElementsByTagName('html')[0].innerHTML = "";
				$("#previewUrl")[0].contentWindow.document.body.innerHTML = "";
				window.frames["previewUrl"].document.write(finalHtml);
			}
		},
		error: function(ret) {
			alert("获取模版内容失败，联系sharexie");
		}
	});
}

mobile_mall.setIFrameContent = function(){
	mobile_mall.getTemplateHtml();
}

//generate shtml
mobile_mall.genHtml = function() {
	var body = mobile_mall.getPreHtml();
	var html = body.html;
	var css = body.css;
	var js = body.js;
	var php = body.php;

	var data = mobile_mall.packMallData();

	$.ajax({
		url: "/mobile/index.php/mobile/genHtml",
		data: "id=" + mobile_mall.global.id + "&html=" + encodeURIComponent(html) + "&js="+ encodeURIComponent(js) +"&css="+ encodeURIComponent(css) +"&templateId=" + mobile_mall.global.templateId + "&data=" + encodeURIComponent(data) +"&businessId=" + mobile_mall.global.businessId,
		type: "POST",
		dataType: "json",
		success: function(ret) {
			if(ret.ret == 1){
				alert("发布DEV成功");
			}
		},
		error: function(ret) {
			alert("发布DEV失败，请重新进入页面操作");
		}
	});
	if(php&&php.length>0){
		var packData={
			promoteId:mobile_mall.global.phpNamePrefix+mobile_mall.global.id,
			actPromoteId:mobile_mall.global.id,
			data:php
		}
		packData=JSON.stringify(packData);
		$.ajax({
		   type: "POST",
		   url: "http://ppms.paipaioa.com/php/promote_moban.php",
		   dataType:"json",
		   data:packData,
		   success: function(data){
				 if(data.code == 1){
				 }else if(data.code == 2){
				 }else{
				 	alert("php文件生成失败，如需帮助，请维持现场联系brianliu，sharexie");
				 }
		   },
		   error:function(data){
		   		alert("后台php文件生成失败，如需帮助，请维持现场联系brianliu，sharexie");
		   }
		});
	}
}
mobile_mall.pubMall = function(){
	$.ajax({
		url: "/mobile/index.php/mobileV2/pubFile",
		data: "id=" + mobile_mall.global.id,
		type: "POST",
		dataType: "text",
		success: function(ret) {
			if(ret){
				alert("发布IDC成功,请稍后在IDC下验证");
			}
		},
		error: function(ret) {
			alert("发布IDC失败，请重新进入页面操作");
		}
	});

	$.ajax({
		url: "/mobile/index.php/publish/publish/publish_php",
		data: "fn=" +mobile_mall.global.phpNamePrefix+mobile_mall.global.id+"&fType=base",
		type: "POST",
		dataType: "text",
		success: function(ret) {
			if(ret=='-1'){
				alert('请转到VTMS（chong.cm.com）系统登录再发布。')
			}
		},
		error: function(ret) {
		}
	});
}
mobile_mall.openWin = function(url) {
	var a = document.createElement("a");
	a.setAttribute("href", url);
	a.setAttribute("target", "_blank");
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

mobile_mall.delete = function(e){
	var componentId = $(e.target).closest('.component').parent().attr("componentId");
		mobile_mall.deleteComponent(componentId);
		$(e.target).closest('.component').parent().remove();
		mobile_mall.setIFrameContent();
}

//add Event Listener
mobile_mall.addEvent = function(e){
	$("input[name='template']").change(function(){
		mobile_mall.setIFrameContent();
		alert(this);
	})
	$(".drag").draggable({
		revert: "invalid",
		helper: "clone",
		snap: "#drop"
	});

	$("#drop").droppable({
		accept: '.drag',
		drop: function(event, ui) {
			//console.log(ui.draggable.context);
			var key = ui.draggable.context.getAttribute("key");
			if (ui.draggable.attr("class").indexOf("sortable") > 0) {
				return;
			} else {
				mobile_mall.addComponent(key);
			}
			mobile_mall.setIFrameContent();
		}
	});
	$( "#componentUse" ).sortable({
    	placeholder: "ui-state-highlight2",
    	stop: function(){
    		mobile_mall.setIFrameContent()	
    	}
    });
    $( "#componentUse" ).disableSelection();
	$("#drop").delegate(".component", "dblclick", function(e) {
		var componentId = $(e.target).closest('.component').parent().attr("componentId");
		var key = $(e.target).closest('.component').parent().attr("key");
		var comConfig = mobile_mall.component.configComMap[key];
		var componentData = mobile_mall.getComponentData(componentId);
		//var html = mobile_mall.genConfigHtml(componentId,comConfig.configHtml);
		if(comConfig.tab && comConfig.tab.length>0){
			var html = '<ul id="myTab" class="nav nav-tabs">'
            for (var j = 0; j < comConfig.tab.length; j++) {
            	html += '<li class=""><a href="#'+comConfig.tab[j].key+'" data-toggle="tab">'+comConfig.tab[j].name+'</a></li>';
            };
            html += '</ul><div id="myTabContent" class="tab-content">';
            for (var k = 0; k < comConfig.tab.length; k++) {
            	html += '<div class="tab-pane" id="'+ comConfig.tab[k].key +'">';
            	html += mobile_mall.genConfigHtml(componentId,comConfig[comConfig.tab[k].config],comConfig.tab[k].key);
            	html += '</div>';
            };
            html += '</div>';
		}else{
			var html = '<ul class="nav nav-tabs" id="myTab">\
							<li class="">\
								<a href="#pro"  data-toggle="tab">配置信息框</a>\
							</li>\
						</ul>\
						<div id="myTabContent" class="tab-content">\
							<div class="tab-pane" id="pro">';
			html += mobile_mall.genConfigHtml(componentId,comConfig.configHtml);
			html += '</div>';
		}





		mobile_mall.openPop(componentId,key,html);
		//$("input[tag=time]").val($("input[tag=time]").attr("value"));
		//UE.getEditor("textEditor");
		for (var i = 0; i < comConfig.configHtml.length; i++) {
			if(comConfig.configHtml[i].type == "textEditor"){
				UE.getEditor(comConfig.configHtml[i].key,{
					initialFrameWidth:540,
       				initialFrameHeight:300

				});
			}
		};
		$("input[tag=time]").datepicker();
		$("input[tag=time]").datepicker("option", "dateFormat","yy-mm-dd 00:00:00");
		for (var i = 0; i < $("input[tag=time]").length; i++) {
			$("input[tag=time]")[i].value = $("input[tag=time]")[i].getAttribute("value");
		};
		//处理子菜单
		if(componentData.data.data._business){
			$("#myTab a[href='#"+ componentData.data.data._business +"']").tab("show");
		}else{
			$("#myTab a:first").tab("show");
		}
	})
	$("#saveConfig").click(function(){
		var componentId = $("#popup").attr("componentid");
		var key = $("#popup").attr("key");
		var comConfig = mobile_mall.component.configComMap[key];
		var componentData = mobile_mall.getComponentData(componentId);
		componentData.data.data._business = $("#myTab li[class='active'] a").attr("href").split("#")[1];
		if(componentData.data.data._business == "common"){
			componentData.data.data._business = "mobile";
		}
		var configDom = $("[data-provide='config']");
		for (var i = 0; i < configDom.length; i++) {
			var dataKey = $("[data-provide='config']")[i].getAttribute("id");
			var dataTag = $("[data-provide='config']")[i].getAttribute("tag");
			if(dataKey && dataTag !== "textEditor"){				
				componentData.data.data[dataKey] = $("[data-provide='config']")[i].value;				
			}else{
				dataKey = $("[data-provide='config']")[i].getAttribute("name");
				var dataType = $("[data-provide='config']")[i].getAttribute("type");
				if(dataType == "colorpick" || dataType == "radio"){
					componentData.data.data[dataKey] = $("#popup input[name="+ dataKey +"][type=radio]:checked").attr("value");
				}else if(dataType == "radio"){
					componentData.data.data[dataKey] = $("#popup input[name="+ dataKey +"][type=radio]:checked").attr("value");
				}else if(dataType == "checkbox"){
					componentData.data.data[dataKey]=[];
					var dom = $("#popup input[type=checkbox][name="+ dataKey +"]:checked");
					for (var j = 0; j < dom.length; j++) {
						componentData.data.data[dataKey].push(dom[j].value);
					};
				}else if(dataType == "textEditor"){
					componentData.data.data[dataKey] = UE.getEditor(dataKey).getContent();
					UE.getEditor(dataKey).destroy();
				}
			}			
		};
		//check config data
		var result = comConfig.checkData ? comConfig.checkData(componentData.data.data) :{ret:0,msg:''};
		if(result.ret == 0){
			$("#popup").css("display","none");
			$(".cover-zhezhao").css("display","none");
			mobile_mall.setIFrameContent();
		}else if(result.ret == 1){
			alert(result.msg);
			return false;
		}		
	})

	//prevew mall
	$("#preMall").click(function(){
		mobile_mall.genHtml();
	})
	//publish mall
	$("#pubMall").click(function(){
		mobile_mall.pubMall();

	})
	$("#queryMall").click(function() {
		//获取业务id信息
		
		/*if (mobile_mall.global.businessId == 5) {
			var url = "http://518.qq.com/sinclude/page/mobile/2013/index_" + mobile_mall.global.id + ".shtml";
		} else {
			var url = "http://chong.qq.com/promote/mobile/2013/index_" + mobile_mall.global.id + ".shtml";
		}
		mobile_mall.openWin(url);*/
	});
	//delete component
	$("a[data-provide='deleteComponent']").click(function(e){
		var componentId = $(e.target).closest('.component').parent().attr("componentId");
		mobile_mall.deleteComponent(componentId);
		$(e.target).closest('.component').parent().remove();
		mobile_mall.setIFrameContent();
	})
	$("h2[tag='menuFold']").click(function(e){
		
		$(e.target).parent().toggleClass("show","");
		$(e.target).siblings().toggle(1000);
	})
}

