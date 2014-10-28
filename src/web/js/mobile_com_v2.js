/**
*   info:无线端卖场移动侧组件
*	author:brianliu
*	createTime:2013-07-25
*/	

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

mobile_mall.component.configCom.push({
	author:'brianliu',
	className:'公共组件',
	//组件名称
	name:'浮层登陆资源',
	//关键字
	key:'floatLogin',
	//配置面板html
	configHtml:[],
	preHtml:function(data,componentId){
		return '';
	},
	jsFile:['http://3gimg.qq.com/ptlogin/touch/js/ptlogin.js'],
	css:'',
	cssFile:['http://3gimg.qq.com/ptlogin/touch/css/ptlogin.css']
});

mobile_mall.component.configCom.push({
	author:'brianliu',
	className:'QQ充值组件',
	//组件名称
	name:'移动直降',
	//关键字
	key:'discountPromote',
	//配置面板html
	configHtml:[{
			name:"面值",
			key:"amount",
			type:"checkbox",	
			tolerate:["50"],
			choice:["50","100"],
			show:["50","100"]
		}
		,{
			name:"默认面值",
			key:"defaultAmount",
			type:"radio",	
			tolerate:"50",
			choice:["50","100"],
			show:["50","100"]
		}
		,{
			name:"样式",
			key:"color",
			type:"colorpick",	
			tolerate:"1",
			choice:['1','2','3','4','5','6','7'],
			show:["#c62d2d","#e96d1a","#77a02f","#3f9592","#438bb9","#6c2ab5","#bf295b"]
		}
		,{
			name:"无资格用户提示",
			key:"denyTips",
			type:"text",	
			tolerate:"优惠名额抢光啦"
		}
        ,{
            name:"继续充值连接",
            key:"confirmURL",
            type:"url",    
            tolerate:""
        }
		,{
			name:"vb2ctag",
			key:"vb2ctag",
			type:"text",	
			tolerate:""
		}
		,{
			name:"开始时间",
			key:"startTime",
			type:"time",	
			tolerate:""
		}
		,{
			name:"结束时间",
			key:"endTime",
			type:"time",	
			tolerate:""
		}
		,{
			name:"50元售价",
			key:"price50",
			type:"text",	
			tolerate:""
		}
		,{
			name:"50元-规则token",
			key:"token50",
			type:"text",	
			tolerate:""
		}
		,{
			name:"50元-奖品id",
			key:"prize50",
			type:"text",	
			tolerate:""
		}
		,{
			name:"100元售价",
			key:"price100",
			type:"text",	
			tolerate:""
		}
		,{
			name:"100元-规则token",
			key:"token100",
			type:"text",	
			tolerate:""
		}
		,{
			name:"100元-奖品id",
			key:"prize100",
			type:"text",	
			tolerate:""
		}],
	preHtml:function(data,componentId){
		var hc='<div class="chong-form">\
			<input class="ui-ipt" type="tel" id="mobileInput" placeholder="请输入手机号码" maxlength="11">\
			<div class="warning hide" id="errortips">请输入您正确的手机号</div>\
			<div class="ui-value value-col'+data.color+'" id="num">';
		for(var i=0;i<data.amount.length;i++){
			hc=hc+'<span class="'+(i==0?'cur':'')+'" amount="'+data.amount[i]+'" id="amount'+data.amount[i]+'">'+data.amount[i]+'元<i></i></span>';
		}
		hc=hc+'</div>\
			<div class="price">实际需付：<em id="payPrice">-</em></div>\
			<span class="ui-btn btn-cor'+data.color+'" id="mbSubmit">立即充值</span>\
		</div>\
		<form method="post" action="http://chong.qq.com/t/vb2c/buyMobile.xhtml" id="genDeal">\
            <input id="m" name="m" type="hidden" />\
            <input id="am" name="am" type="hidden" />\
            <input id="s" name="s" type="hidden" value=""/>\
            <input id="sid" name="sid" type="hidden" value=""/>\
            <input name="from" type="hidden" value="1"/>\
        </form>\
        <div id="errorShow" style="display:none;">\
	        <div class="ui-floating-mask"></div>\
			<div class="ui-floating">\
				<h2>温馨提示</h2>\
				<div class="ui-floating-info" id="errContent">\
					系统刚睡醒，再试一次吧\
				</div>\
				<div class="btn-area clear">\
					<span class="ui-btn btn-submit" id="okBtn">继续充值</span>\
					<span class="ui-btn btn-cancel" id="closeBtn">关闭</span>\
				</div>\
			</div>\
		</div>';
		return hc;
	},
	js:function(data,componentId){
		var st=data.startTime?(new Date(data.startTime.replace(/\-/g,'/'))).valueOf():0;
		var et=data.endTime?(new Date(data.endTime.replace(/\-/g,'/'))).valueOf():Number.MAX_VALUE;
		var option={
			price:data.defaultAmount,
            vb2ctag:data.vb2ctag,
            url:location.href,
            confirmURL:data.confirmURL,
            priceDomTagName:'span',
            tipWarningClass:'warning',
            timeRelateAct:true,
            timeRelateAward:false,
            userPermissionTips:data.denyTips,
            isActValid:function(time){
            	var nt=time.valueOf();
                nt=nt?nt:(new Date()).valueOf();
                return st<=nt&&et>nt;
            },
            returnAwardToken:function(price,time){
                if(price==50){
                    return {key:data.token50,id:data.prize50};
                }else if(price==100){
                    return {key:data.token100,id:data.prize100};
                }else{
                    return false;
                }
            },
            changePriceCallback:(function(price50,price100){
                var a50=$id('amount50');
                var a100=$id('amount100');
                var pay=$id('payPrice');
                return function(price){
                    if(price==50){
                        a50?a50.className='cur':'';
                        a100?a100.className='':'';
                        pay.innerHTML='&yen;'+price50;
                    }else if(price==100){
                        a50?a50.className='':'';
                        a100?a100.className='cur':'';
                        pay.innerHTML='&yen;'+price100;
                    }else{
                        a50?a50.className='':'';
                        a100?a100.className='':'';
                        pay.innerHTML='-';
                    }
                }
            })(data.price50,data.price100)
        };
		PP.chong.mobile.discountPromote.init(option);
	},
    jsFile:["http://static.paipaiimg.com/js/version/2013/08/pp.chong.mobile.discountPromote.20130828.js"],
	css:'',
	cssFile:[]
});



mobile_mall.component.configCom.push({
	author:'brianliu',
	className:'QQ充值组件',
	//组件名称
	name:'移动下单',
	//关键字
	key:'mobileForm',
	//配置面板html
	configHtml:[{
			name:"面值",
			key:"amount",
			type:"checkbox",	
			tolerate:["50"],
			choice:["50","100","300"],
			show:["50","100","300"]
		}
		,{
			name:"默认面值",
			key:"defaultAmount",
			type:"radio",	
			tolerate:"50",
			choice:["50","100","300"],
			show:["50","100","300"]
		}
		,{
			name:"样式",
			key:"color",
			type:"colorpick",	
			tolerate:"1",
			choice:['1','2','3','4','5','6','7'],
			show:["#c62d2d","#e96d1a","#77a02f","#3f9592","#438bb9","#6c2ab5","#bf295b"]
		}
		,{
			name:"vb2ctag",
			key:"vb2ctag",
			type:"text",	
			tolerate:""
		}],
	preHtml:function(data,componentId){
		var hc='<div class="chong-form">\
			<input class="ui-ipt" type="tel" id="mobileInput" placeholder="请输入手机号码" maxlength="11">\
			<div class="warning hide" id="mobileError">请输入您正确的手机号</div>\
			<div class="ui-value value-col'+data.color+'" id="num">';
		for(var i=0;i<data.amount.length;i++){
			hc=hc+'<span class="'+(i==0?'cur':'')+'" tag="price" data="'+data.amount[i]+'" id="amount'+data.amount[i]+'">'+data.amount[i]+'元<i></i></span>';
		}
		hc=hc+'</div>\
			<div class="price">售价：<em id="priceRange">-</em></div>\
			<span class="ui-btn btn-cor'+data.color+'" id="mobileSubmit">立即充值</span>\
		</div>\
		<form method="post" action="http://chong.qq.com/t/vb2c/buyMobile.xhtml" id="genDeal">\
            <input id="m" name="m" type="hidden" />\
            <input id="am" name="am" type="hidden" />\
            <input id="s" name="s" type="hidden" value=""/>\
            <input id="sid" name="sid" type="hidden" value=""/>\
            <input name="from" type="hidden" value="1"/>\
        </form>\
        <div id="formInfoShow" style="display:none;">\
	        <div class="ui-floating-mask"></div>\
			<div class="ui-floating">\
				<h2>温馨提示</h2>\
				<div class="ui-floating-info" id="formInfoContent">\
				</div>\
				<div class="btn-area clear">\
					<span class="ui-btn btn-cancel" id="formInfoCloseBtn">关闭</span>\
				</div>\
			</div>\
		</div>';
		return hc;
	},
	js:function(data,componentId){
		var priceRange=$id('priceRange');
		var opt={
			priceList:data.amount,
			price:data.defaultAmount,
			vb2ctag:data.vb2ctag,
			checkSubmitTag:true,
			priceDom:'num',
			mobileInput:'mobileInput',
			pageUrl:location.href,
			initTip:function(){
				$id('formInfoCloseBtn').addEventListener('touchend',function(){
					$id('formInfoShow').style.display='none';
				});
			},
			changePrice:function(price){
				if(price==100){
					priceRange.innerHTML='&yen;98-99.5';
				}else if(price==300){
					priceRange.innerHTML='&yen;294-298.8';
				}else if(price==50){
					priceRange.innerHTML='&yen;49-49.8';
				}
			},
			showTip:function(show,text){
				if(show){
					$id('formInfoContent').innerHTML=text;
					$id('formInfoShow').style.display='';
				}else{
					$id('formInfoShow').style.display='none';
				}
			},
			showMobileError:function(show,text){
				if(show){
					$id('mobileError').style.display='';
				}else{
					$id('mobileError').style.display='none';
				}
			},
			resetForm:function(mobile,price,vb2ctag,sid){
				$id('m').value=mobile;
				$id('am').value=price;
				$id('s').value=vb2ctag;
				$id('sid').value=sid;
				return $id('genDeal');
			}
		};
		PP.chong.mobile.form.init(opt);
		opt.changePrice(data.defaultAmount);

	},
	jsFile:["http://static.paipaiimg.com/js/version/2013/08/pp.chong.mobile.form.20130828.js?t=20130828"],
	css:'',
	cssFile:[]
});

mobile_mall.component.configCom.push({
	author:'brianliu',
	className:'QQ充值组件',
	//组件名称
	name:'QQ会员头部',
	//关键字
	key:'vipHeader',
	//配置面板html
	configHtml:[],
	preHtml:function(data,componentId){
		return '<header class="header clearfix">\
            <h1 class="mvip-logo"><a href="http://m.vip.qq.com/" title="QQ会员" target="_blank">QQ会员</a></h1>\
            <div class="login-wrap" id="vipHeadLogin">欢迎您，请先<span style="padding: 0 0 0 5px;color: #c00;">登录</span></div>\
            <div class="login-wrap" style="display:none;" id="loginStatus">欢迎您，<span id="vipHeadUser"></span><span style="padding: 0 0 0 5px;color: #c00;" id="vipHeadLogout">退出</span></div>\
        </header>';
	},
	js:function(data,componentId){
		var vipHeadLogin=$id('vipHeadLogin');
		var loginStatus=$id('loginStatus');
		var vipHeadUser=$id('vipHeadUser');
		var vipHeadLogout=$id('vipHeadLogout');
		$addEvent(vipHeadLogin,'touchend',function(){
			pt.init({
			   auto : true, ui: true, bid : "chongzhi",
			   onSuccess : function(user) {
			   		$setCookie("sid", user.sid, 263520, "/", "chong.qq.com");
			   		vipHeadLogin.style.display='none';
			   		loginStatus.style.display='';
			   		vipHeadUser.innerHTML=user.nick;
			   },
			   onFailure : function() {},
			   onCancel:function(){} 
			});
			pt.fire();
			return false;
		});
		$addEvent(vipHeadLogout,'touchend',function(){
			$setCookie("sid", '', -1, "/", "chong.qq.com");
			vipHeadLogin.style.display='';
			loginStatus.style.display='none';
			vipHeadUser.innerHTML='';
		});
		function $id(id){
			return document.getElementById(id);
		}
		function $addEvent(obj, type, handle) {
		    if(!obj || !type || !handle) {
		        return;
		    }
		    if( obj instanceof Array) {
		        for(var i = 0, l = obj.length; i < l; i++) {
		            $addEvent(obj[i], type, handle);
		        }
		        return;
		    }
		    if( type instanceof Array) {
		        for(var i = 0, l = type.length; i < l; i++) {
		            $addEvent(obj, type[i], handle);
		        }
		        return;
		    }
		    window.__allHandlers = window.__allHandlers || {};
		    window.__Hcounter = window.__Hcounter || 1;
		    function setHandler(obj, type, handler, wrapper) {
		        obj.__hids = obj.__hids || [];
		        var hid = 'h' + window.__Hcounter++;
		        obj.__hids.push(hid);
		        window.__allHandlers[hid] = {
		            type : type,
		            handler : handler,
		            wrapper : wrapper
		        }
		    }
		    function createDelegate(handle, context) {
		        return function() {
		            return handle.apply(context, arguments);
		        };
		    }
		    if(window.addEventListener) {
		        var wrapper = createDelegate(handle, obj);
		        setHandler(obj, type, handle, wrapper)
		        obj.addEventListener(type, wrapper, false);
		    }
		    else if(window.attachEvent) {
		        var wrapper = createDelegate(handle, obj);
		        setHandler(obj, type, handle, wrapper)
		        obj.attachEvent("on" + type, wrapper);
		    }
		    else {
		        obj["on" + type] = handle;
		    }
		}
		function $setCookie(name, value, expires, path, domain, secure) {
			//写入COOKIES
			var exp = new Date(), expires = arguments[2] || null, path = arguments[3] || "/", domain = arguments[4] || null, secure = arguments[5] || false;
			expires ? exp.setMinutes(exp.getMinutes() + parseInt(expires)) : "";
			document.cookie = name + '=' + escape(value) + ( expires ? ';expires=' + exp.toGMTString() : '') + ( path ? ';path=' + path : '') + ( domain ? ';domain=' + domain : '') + ( secure ? ';secure' : '');
		}
	},
	jsFile:[],
	css:'',
	cssFile:['http://imgcache.gtimg.cn/vipstyle/mobile/act/template/css/common.css']
});

// JavaScript Document