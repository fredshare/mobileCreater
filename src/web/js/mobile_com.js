/**
*   info:无线端卖场生成函数
*	author:sharexie
*	time:2013-07-19
*	version:v2.0.1
*/	

//基本测试组件
mobile_mall.component.configCom.push({
	//组件名称
	name:'基本组件',
	//关键字
	key:'base',
	//开发者
	author:"sharexie",
	//所属类别
	className:"彩票业务",
	//配置面板html
	configHtml:[{
			name:"颜色",
			key:"basecolor",
			type:"color",	
			tolerate:"red"
		},{
			name:"文本编辑框",
			key:"baseeditor",
			type:"textEditor",	
			tolerate:"123123"
		},{
			name:"文本编辑框2",
			key:"baseeditor2",
			type:"textEditor",	
			tolerate:"1sahretext3"
		},{
			name:"颜色",
			key:"basecolorpick",
			type:"colorpick",	
			tolerate:"red",
			choice:["red","blue","yellow"],
			show:["red","blue","yellow"]
		},{
			name:"下拉框",
			key:"baseselect",
			type:"select",
			tolerate:"1234",
			choice:["123","1234","12312312"],
			show:["红色","蓝色","绿色"]
		},{
			name:"单选框",
			key:"baseradio",
			type:"radio",
			tolerate:"他",
			choice:["你","我","他"],
			show:["红色","蓝色","绿色"]
		},{
			name:"多选框",
			key:"basecheckbox",
			type:"checkbox",
			tolerate:["他","你"],
			choice:["你","我","他"],
			show:["红色","蓝色","绿色"]
		},{
			name:"文本框",
			key:"basetextarea",
			type:"textarea",
			tolerate:"sdfsdfs"
		},{
			name:"时间",
			key:"basetime",
			type:"time",	
			tolerate:"2013-08-21 00:00:00"
		},{
			name:"时间2",
			key:"basetime2",
			type:"time",	
			tolerate:"2012-08-21 00:00:00"
		}],
	checkData:function(data){
		//0为校验成功，1为校验失败,校验失败必须要返回msg
		return {ret:0,msg:""}	
	},
	preHtml:function(data,componentId){
		return '<h1 tag="xx">{{basecolor}}</h1><br>{{basecolorpick}}{{baseselect}}{{baseeditor}}<br><a>sdfsd</a>';	
	},
	js:function(data,componentId){
			//alert(componentId);
			console.log(data);
	},
	jsFile:["http://code.jquery.com/jquery-1.7.0.js"],
	css:function(data,componentId){
		return 'a{color；red}';
	},
	cssFile:[]
});

mobile_mall.component.configCom.push({
	author:'brianliu',
	className:'公共组件',
	//组件名称
	name:'透明占位栏',
	//关键字
	key:'emptyBar',
	//配置面板html
	configHtml:[{
			name:"高度(px)",
			key:"height",
			type:"text",	
			tolerate:""
		}],
	preHtml:function(data,componentId){
		var height=Number(data.height);
		var hc='<div style="height:'+(height>0?height:0)+'px;"></div>';
		return hc;
	},
	jsFile:[],
	css:'',
	cssFile:[]
});

mobile_mall.component.configCom.push({
	author:'brianliu',
	className:'公共组件',
	//组件名称
	name:'网页背景色',
	//关键字
	key:'bodyBackgroundColor',
	//配置面板html
	configHtml:[{
			name:"颜色(手填如#FFFCE2)",
			key:"color",
			type:"text",	
			tolerate:""
		}
		,{
			name:"颜色(调色板)",
			key:"color1",
			type:"color",	
			tolerate:""
		}],
	preHtml:function(data,componentId){
		var hc='';
		return hc;
	},
	jsFile:[],
	css:function(data,componentId){
		var hc='';
		if(data.color){
			hc='body {background-color: '+data.color+';}';
		}else{
			hc='body {background-color: '+data.color1+';}'
		}
		return hc;
	},
	cssFile:[]
});

mobile_mall.component.configCom.push({
	author:'brianliu',
	//组件名称
	name:'文本编辑器',
	className:'公共组件',
	//关键字
	key:'simpleTextEdit',
	//配置面板html
	configHtml:[{
			name:"文本",
			key:"text",
			type:"textEditor",	
			tolerate:""
		}],
	preHtml:function(data,componentId){
		var hc='<div class="ggl-area">'+data.text+'</div>';
		return hc;
	},
	jsFile:[],
	css:'',
	cssFile:[]
});

mobile_mall.component.configCom.push({
	author:'brianliu',
	//组件名称
	name:'带标题文本',
	className:'公共组件',
	//关键字
	key:'titleText',
	//配置面板html
	configHtml:[{
			name:"标题",
			key:"title",
			type:"text",	
			tolerate:""
		}
		,{
			name:"转换“换行符”",
			key:"enterSupport",
			type:"radio",	
			tolerate:["1"],
			choice:["1","0"],
			show:["是","否"]
		}
		,{
			name:"文本",
			key:"text",
			type:"textarea",	
			tolerate:""
		}],
	preHtml:function(data,componentId){
		var hc='<div class="chong-rule">'+(data.title?'<h2>'+data.title+'</h2>':'');
		var text=data.enterSupport=='1'?data.text.replace(/\n/g,'<br/>'):data.text;
		hc=hc+'<p>'+text+'</p></div>';
		return hc;
	},
	jsFile:[],
	css:'',
	cssFile:[]
});

mobile_mall.component.configCom.push({
	author:'brianliu',
	className:'公共组件',
	//组件名称
	name:'图片',
	//关键字
	key:'pic',
	//配置面板html
	configHtml:[{
			name:"图片URL",
			key:"pic",
			type:"text",	
			tolerate:""
		},{
			name:"链接",
			key:"url",
			type:"text",	
			tolerate:""
		}],
	preHtml:function(data,componentId){
		if(data.url){
			var hc='<a href="'+data.url+'"><img src="'+data.pic+'" width="320"></a>';
		}else{
			var hc='<img src="'+data.pic+'" width="320">';
		}	
		return hc;
	},
	jsFile:[],
	css:'',
	cssFile:[]
});

mobile_mall.component.configCom.push({
	author:'brianliu',
	className:'公共组件',
	//组件名称
	name:'方块链接',
	//关键字
	key:'fLink',
	//配置面板html
	configHtml:[{
			name:"链接文字",
			key:"title",
			type:"text",	
			tolerate:""
		},{
			name:"链接",
			key:"url",
			type:"text",	
			tolerate:""
		},{
			name:"文字颜色",
			key:"color1",
			type:"color",	
			tolerate:""
		},{
			name:"底色",
			key:"color2",
			type:"color",	
			tolerate:""
		},{
			name:"边距(px)",
			key:"margin",
			type:"text",	
			tolerate:"20"
		}],
	preHtml:function(data,componentId){
		var hc='<div style="border-radius: 4px;margin: 0 '+(data.margin?data.margin:0)+'px;height: 34px;line-height: 34px;background: '+data.color2+';text-align: center;"><a style="color: '+data.color1+';" href="'+data.url+'">'+data.title+'</a></div>'
		return hc;
	},
	jsFile:[],
	css:'',
	cssFile:[]
});

// JavaScript Document