/**
 * 商户端接入js库
 */
var ThirdApp = {
	os : null,
	
	/**
	 * 返回到一级菜单界面
	 * 
	 */
	toHomePage : function() {
		if (ThirdApp.os == 'android') {
			window.SysClientJs.getHome('goHome()','');
		} else if (ThirdApp.os == 'iphone') {
			_WK_DATAS["toHomePage"] = {};
			setWebitEvent("_toHomePage()", "B4");				
		}
	},
	
	/**
	 * 获取核心用户号，然后跳转到url,并在url末尾附加coreCustNo=XXX
	 * 2016/09/12 增加merFlag字段，用来判断商户，
	 * 未登录跳转登录，登录后根据merFlag获取对应token加到url后
	 *已登录根据merFlag获取对应token，加到url后
	 * @param url
	 */
	getCoreCustNo : function(url,merFlag) {
		if (ThirdApp.os == 'android') {
			if(merFlag == undefined || merFlag == null || merFlag == ""){
				window.SysClientJs.getCoreCustNo(url);
			}else{
				window.SysClientJs.getToken(url,merFlag);
			}
		} else if (ThirdApp.os == 'iphone') {
			var data = {
					'url' : url,
					'flag' : '1' ,//第三方调用登陆标示(useless)	
			};
			if(merFlag == undefined || merFlag == null || merFlag == ""){
			}else{
				data.merFlag = merFlag;
			}
			_WK_DATAS["thirdLogin"] = data;
			
			setWebitEvent('_getThirdLoginInfo()', 'A1');
		}
	},
	getUserInfo: function(cb,m){
		var url = "/common/paramGet.do?act=getUserInfo&m="+m;
		if (ThirdApp.os == 'android') {
			SysClientJs.WebReqInfo(url,cb);
		} else if (ThirdApp.os == 'iphone') {
			setWebitEvent("ThirdApp._getUserInfo('" + cb +"','" + url + "')", "JSB20");
		}
	},
	_getUserInfo: function(cb,url){
		return ThirdApp.toJsonStr({url: url,callback:cb});
	},
	/**
	 * 支付接口，上送json格式字符串
	 * @param jsonDataStr
	 */
	thirdPay : function(jsonDataStr) {
		if (ThirdApp.os == 'android') {
			window.SysClientJs.thirdPay(jsonDataStr);
		} else if (ThirdApp.os == 'iphone') {
			_WK_DATAS["thirdPay"] = jsonDataStr;
			setWebitEvent('_getThirdPayInfo()', 'A2');// 支付函数
		}
	},

	/**
	 * 打开通讯录，用户选择号码后，回调callBack(mobileNo);
	 * 
	 * @param callBack
	 *            函数的字符串名称
	 */
	getContact : function(callBack) {
		if (ThirdApp.os == 'android') {
			window.SysClientJs.getContact(callBack);
		} else if (ThirdApp.os == 'iphone') {
			_WK_DATAS["getContact"] = {
				'callback' : callBack
			};
			setWebitEvent("_getContact()", "37");
		}
	},

	/**
	 * 打开等待层
	 */
	showWaitPanel : function() {
		if (ThirdApp.os == 'android') {
			window.SysClientJs.showWaitPanel("加载中...");
		} else if (ThirdApp.os == 'iphone') {
			_WK_DATAS["wait"] = {
				'msg' : '加载中...',
				'callback' : '',
				'touchable' : 'false'
			};
			setWebitEvent('showWaitPanel()', '04');
		}
	},

	/**
	 * 隐藏等待层
	 */
	hideWaitPanel : function() {
		if (ThirdApp.os == 'android') {
			window.SysClientJs.hideWaitPanel();
		} else if (ThirdApp.os == 'iphone') {
			setWebitEvent('closeWaitPanel()', '04');
		}
	},
	
	/**
	 * 初始化标题
	 */
	initTitleInfo : function(pageId){
		if (ThirdApp.os == 'android') {
			var json = ThirdApp._getPageTitle(pageId);
			SysClientJs.updateTitleInfo(ThirdApp.toJsonStr(json));
		} else if (ThirdApp.os == 'iphone') {
			setWebitEvent("ThirdApp._getPageTitle('" + pageId + "')", "02");
		}
	},
	/**
	 * 移除原生头部标题
	 */
	removeNativeTitle: function(){
		if (ThirdApp.os == 'android') {
			var cfg = {
					title : "0",
					leftButton: {
						exist : "false",
						name : "",
						func : ""
					},
					rightButton: {
						exist : "false",
						name : "",
						func : ""
					}
				};
			SysClientJs.updateTitleInfo(ThirdApp.toJsonStr(cfg));
		} else if (ThirdApp.os == 'iphone') {
			setWebitEvent("ThirdApp._removeTitle()", "02");
		}
	},
	_removeTitle : function(){
		var cfg = {
				title : "0",
				leftButton: {
					exist : "true",
					name : "",
					func : "backHome"
				},
				rightButton: {
					exist : "false",
					name : "",
					func : ""
				}
			};
		return ThirdApp.toJsonStr(cfg);
	},
	_getPageTitle : function(pageId) {
		var page = $("#"+pageId);
		var cfg = {
			title : page.attr("title")
		};
		var leftCfg = page.attr("data-btnLeft").split("|");
		cfg.leftButton = ThirdApp._generyTitleButton(leftCfg);
		var rightCfg = page.attr("data-btnRight").split("|");
		cfg.rightButton = ThirdApp._generyTitleButton(rightCfg);
		if (ThirdApp.os == 'android') {
			return cfg;
		} else if (ThirdApp.os == 'iphone') {
			return ThirdApp.toJsonStr(cfg);
		}
		
	},
	//设置安卓原生返回键返回方法
	setBackBtn : function(func){
		if (ThirdApp.os == 'android') {
			if(!func){
				func = "history.back()";
			}
			var cfg = {
					title : "",
					leftButton: {
						exist : "true",
						name : "",
						func : func
					},
					rightButton: {
						exist : "false",
						name : "",
						func : ""
					}
				};
			SysClientJs.updateTitleInfo(ThirdApp.toJsonStr(cfg));
		}
	},
	_generyTitleButton : function(cfg) {
		if (cfg && cfg.length == 3) {
			return {
				exist : cfg[0],
				name : cfg[1],
				func : cfg[2]
			};
		}
		return { exist : false, name : "", func : "" };
	},
	//调用拨打电话
	gotoCall: function(m){
		if (ThirdApp.os == 'android') {
			window.SysClientJs.gotoCall(m);
		} else if (ThirdApp.os == 'iphone') {
			try{
            	_WK_DATAS["gotoCall"] = {
                 		'tel' : m
                    };
            	setWebitEvent("_gotoCall()", "A9");
            }catch(e){
                alert(e);
            }
		}
	},
	//获取手机号码
	getMobileNo: function(func){
		if (ThirdApp.os == 'android') {
			window.SysClientJs.getMobileNo(func);
		} else if (ThirdApp.os == 'iphone') {
			try{
            	_WK_DATAS["getMobileNo"] = { 'callback' : func };
            	setWebitEvent("_getMobileNo()", "C1");
            }catch(e){
                alert(e);
            }
		}
	},
	//下载文件
	downloadFile: function(url,name){
		if (ThirdApp.os == 'android') {
			window.SysClientJs.downloadFile(url,name);
		} else if (ThirdApp.os == 'iphone') {
            try{
                _WK_DATAS["downloadFile"] = {
                    url : url,
                    name: name
                };
                setWebitEvent("_downloadFile()", "42");
            }catch(e){
                alert(e);
            }			
		}
	},	
    //判断是否登录
    isLogin : function(callback){
		if (ThirdApp.os == 'android') {
			window.SysClientJs.isLogin(callback);
		} else if (ThirdApp.os == 'iphone') {
			try{
		        _WK_DATAS["isLogin"] = {callback:callback};
		        setWebitEvent("_getIsLogin()", "34");
            }catch(e){
                alert(e);
            }
		}
    },
    //获取客户号
    getCustNo : function(callback){
		if (ThirdApp.os == 'android') {
			window.SysClientJs.getCustNo(callback);
		} else if (ThirdApp.os == 'iphone') {
			try{
		        _WK_DATAS["getCustNo"] = {callback:callback};
		        setWebitEvent("_getCustNo()", "C2");
            }catch(e){
                alert(e);
            }
		}
    },
    //微信分享 content-分享文字内容  url-地址url imgUrl-图片Url
    wxShare : function(content,url,imgUrl){
    	if (ThirdApp.os == 'android') {
    		window.SysClientJs.shareWeb(content,url,imgUrl);
    	} else if (ThirdApp.os == 'iphone') {
    		try{
    			var data = {
						'txt' : content,
						'url' : url,
						'imgUrl' : imgUrl
				};
				
                _WK_DATAS["shareWeb"] = data;
                		
                setWebitEvent("_shareWeb()", "D20");
    		}catch(e){
    			alert(e);
    		}
    	}
    },
	/**
	 * 保持会话，直接调用无返回
	 */
	keepSession: function(){
		if (ThirdApp.os == 'android') {
			window.SysClientJs.heartbeat();
		} else if (ThirdApp.os == 'iphone') {
			setWebitEvent("{'ss':''}", 'C7');
		}
	},
	//弹框提示
	alertinfo : function(c) {
		var a = {
			title : "温馨提示",
			info : c,
			type : "4",
			imageFlag : "2",
			ok_text : "确定",
			ok_func : "",
			cancel_text : "",
			cancel_func : ""
		};
		if (ThirdApp.os == 'android') {
			window.SysClientJs.alertinfo(ThirdApp.toJsonStr(a));
		} else if (ThirdApp.os == 'iphone') {
			_WK_DATAS["thirdAlert"] = ThirdApp.toJsonStr(a);
			setWebitEvent("_getAlertInfo()", "25");
		}
	},

	/**
	 * 解析JSON，兼容不支持JSON对象的浏览器
	 * 
	 * @param str
	 * @returns
	 */
	parseJson : function(str) {
		var obj;
		try {
			obj = JSON.parse(str);
		} catch (e) {
			obj = eval("(" + str + ")");
		}
		return obj;
	},
	/**
	 * 将对象转换成json字符串
	 * 
	 * @param obj
	 */
	toJsonStr : function(obj) {
		if(JSON.stringify){
			return JSON.stringify(obj);
		}
		if (obj == null) {
			return '""';
		}
		switch (typeof (obj)) {
			default: 
			case 'number':
			case 'string':
				return '"' + obj + '"';
			case 'object': {
				if (obj instanceof Array) {
					var strArr = [];
					var len = obj.length;
					for ( var i = 0; i < len; i++) {
						strArr.push(ThirdApp.toJsonStr(obj[i]));
					}
					return '[' + strArr.join(',') + ']';
				} else {
					var arr = [];
					for ( var i in obj) {
						arr.push('"' + i + '":' + ThirdApp.toJsonStr(obj[i]));
					}
					return "{" + arr.join(',') + "}";
				}
			}
		}
		return '""';
	},

	/**
	 * App对象初始化
	 */
	init : function() {
		ThirdApp.checkOs();
		if (ThirdApp.os == 'iphone') {
			var W = window;
			// 事件队列
			W._mevents = new Array();
			W._ajaxArray = new Array();
			// push 增加入队列
			// shift 先进先出
			// 设置自定义事件
			W.setWebitEvent = function(evtName, evtCode) {
				if (evtName == "") {
					return;
				}
				_mevents.push({
					code : evtCode,
					name : evtName
				});
			};

			// 至此以下的函数全部由上层iphone调用
			// iphone调用获取EventCode
			W.getWebkitEventCode = function() {
				return _mevents.length > 0 ? ThirdApp.toJsonStr(_mevents.shift()) : "0";
			};
			// 获取自定义事件
			W.getWebkitEvent = function() {
				return "";
			};

			W._WK_DATAS = [];
			W._WK_DATAS["wait"] = {'msg':'','callback':'','touchable':'false'};
			W.showWaitPanel = function() {
				return ThirdApp.toJsonStr(_WK_DATAS["wait"]);
			};
			W.closeWaitPanel = function() {
				_WK_DATAS["wait"] = {};
			};

			W._WK_DATAS["alert"] = {
				'title' : '温馨提示',
				'msg' : '测试信息'
			};
			// 获取提示信息
			W._getAlertInfo = function() {
				//return ThirdApp.toJsonStr(_WK_DATAS["thirdAlert"]);
				return _WK_DATAS["thirdAlert"];
			};

			// 获取客户端参数
			W._WK_DATAS["payMent"] = {
				callback : ''
			};

			// 获取通讯录
			W._getContact = function() {
				return ThirdApp.toJsonStr(_WK_DATAS["getContact"]);
			};

			// 获取支付数据
			W._getThirdPayInfo = function() {
				return _WK_DATAS["thirdPay"];
			};

			// 获取登陆成功后续跳转的url
			W._getThirdLoginInfo = function() {
				return ThirdApp.toJsonStr(_WK_DATAS["thirdLogin"]);
			};
			
			W.buileFootdiv = function(ele, rootele) {
				var jianpanH = 210;
				var eleHeight = ele.scrollHeight;
				if (eleHeight < jianpanH) {
					var result = jianpanH - eleHeight;
					return result;
				} else {
					return 0;
				}
			};
		    W._toHomePage = function(){
		    	return ThirdApp.toJsonStr(_WK_DATAS["toHomePage"]);
		    };
			// 获取通讯录
		    W._gotoCall = function(){
		    	return ThirdApp.toJsonStr(_WK_DATAS["gotoCall"]);
		    };
		    //获取手机号码
		    W._getMobileNo = function(){
		    	return ThirdApp.toJsonStr(_WK_DATAS["getMobileNo"]);
		    };
		    W._downloadFile = function(){
		    	  return ThirdApp.toJsonStr(_WK_DATAS["downloadFile"]);
		    };
		    W._getIsLogin =  function(){
		    	  return ThirdApp.toJsonStr(_WK_DATAS["isLogin"]);
		    };
		    W._getCustNo =  function(){
		    	  return ThirdApp.toJsonStr(_WK_DATAS["getCustNo"]);
		    };	
		    W._shareWeb = function() {
				return ThirdApp.toJsonStr(_WK_DATAS["shareWeb"]);
			};
			W._loadThirdUrl = function(){
				return ThirdApp.toJsonStr(_WK_DATAS["loadThirdUrl"]);
			};
		}
	},
	checkOs : function() {
		var ua = navigator.userAgent;
		var p = navigator.platform;// 检测平台
		if (/Android (\d+\.\d+)/i.test(ua)) {
			ThirdApp.os = "android";
		} else if (ua.indexOf('iPhone') > -1) {
			ThirdApp.os = "iphone";
		} else {
			ThirdApp.os = "web";
		}
	},
	//权益平台
	openThirdTagUrl: function(url){
		if (ThirdApp.os == 'android') {
			window.SysClientJs.openThirdTagUrl(url);
		} else if (ThirdApp.os == 'iphone') {
            try{
            	_WK_DATAS["loadThirdUrl"] = {
             		'url' : "qypt",
             		'local' : "1",
             		'title' : "在线客服"
                };
    			setWebitEvent("_loadThirdUrl()", "C5");
            }catch(e){
                alert(e);
            }			
		}
	},
};

ThirdApp.init();
