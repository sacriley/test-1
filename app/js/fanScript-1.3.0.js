//jQuery $ > jQuery Start
;(function($){
	//jQuery ready
	$(function(){
	
		//載入CSS檔案
		var fanScriptVersion = "fanScript-1.3.0.js";
		var cssPath = $("script[src$='" + fanScriptVersion + "']").attr("src").split(fanScriptVersion);
		var cssPath = cssPath[0];
		$("<link>").attr({ rel: "stylesheet", href: cssPath + "fanScript.css"}).appendTo("head");
		
		//版本提示
		//if($.browser.msie && $.browser.version < 8){
		//	alert("您的瀏覽器版本過舊，無法正常支援HTML5及CSS3的最新功能，請下載Chrome、Firefox或將您的IE更新到最新版本。\n\nYour browser version is too old, can not properly support the latest features of HTML5 and CSS3, please download Chrome, Firefox or update your IE to the latest version.");
		//}
		
		// $('#my-container').imagesLoaded(myFunction)
		// or
		// $('img').imagesLoaded(myFunction)
		// execute a callback when all images have loaded.
		// needed because .load() doesn't work on cached images
		// callback function gets image collection as argument
		//  `this` is the container
		$.fn.imagesLoaded = function( callback ){
			var $this = this,
			$images = $this.find('img').add( $this.filter('img') ),
			len = $images.length,
			blank = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==',
			loaded = [];
			function triggerCallback() {
				callback.call( $this, $images );
			}
			function imgLoaded( event ) {
				var img = event.target;
				if ( img.src !== blank && $.inArray( img, loaded ) === -1 ){
					loaded.push( img );
					if ( --len <= 0 ){
						setTimeout( triggerCallback );
						$images.unbind( '.imagesLoaded', imgLoaded );
					}
				}
			}
			// if no images, trigger immediately
			if ( !len ) {
				triggerCallback();
			}
			$images.bind( 'load.imagesLoaded error.imagesLoaded',  imgLoaded ).each( function() {
				// cached images don't fire load sometimes, so we reset src.
				var src = this.src;
				// webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
				// data uri bypasses webkit log warning (thx doug jones)
				this.src = blank;
				this.src = src;
			});
			return $this;
		};
		
		//$("#clicker").previewScreen("#content");
		//#clicker填寫觸發者，#content填寫列印內容
		$.fn.previewScreen = function(jQuerySelect , callback ){
			var _this = this;
			var handler = function(){
				$(_this).on('click', _this, function(){
					var printPage = window.open("","printPage","");
					printPage.document.open();
					printPage.document.write("<HTML><head></head><BODY>");
					printPage.document.write($(jQuerySelect).html());
					printPage.document.close("</BODY></HTML>");
				});
			}
			return this.each(handler);
		};
		
		//<a href="" fanScript-href></a>
		//阻止連結動作
		$(document).on('click', '[fanScript-preDef]', function(event){
			event.preventDefault();
		});
		$(document).on('click', '[fanScript-hrefNone]', function(event){
			event.preventDefault();
		});
		
		//$.url class
		//$.url.param('val') 分析指定網址參數
		//$.url.paramAll() 會回傳所有參數集合的陣列
		$.url = {};
		$.extend($.url, {
			_params: {},
			init: function(){
				var paramsRaw = "";
				try{
					paramsRaw = (document.location.href.split("?", 2)[1] || "").split("#")[0].split("&") || [];
					for(var i = 0; i< paramsRaw.length; i++){
						var single = paramsRaw[i].split("=");
						if(single[0]){
							this._params[single[0]] = unescape(single[1]);
						}
					}
				}
				catch(e){
					alert(e);
				}
			},
			param: function(name){
				return this._params[name] || "";
			},
			paramAll: function(){
				return this._params;
			}
		});
		$.url.init();
		
		//$().heightAll()回傳height+padding-top+padding-bottom
		$.fn.heightAll = function(){
			return $(this).height() + parseInt($(this).css("padding-top")) + parseInt($(this).css("padding-bottom"));
		};
		
		//$().widthAll()回傳width+padding-left+padding-right
		$.fn.widthAll = function(){
			return $(this).width() + parseInt($(this).css("padding-left")) + parseInt($(this).css("padding-right"));
		};
		
		//$().scrollWatchOver({watchingDistance:0, watchedDistance:0, callback:function(){}});
		//偵測網頁瀏覽位置，網頁瀏覽位置由下而上出現後觸發callback
		$.fn.scrollWatchOver = function(_settings){
			var defaultSettings = {
				watchingDistance: 0,
				callback: function() {}
			};
			var settings = $.extend(defaultSettings, _settings);
			$("[fanScript-scrollWatchOver]").attr('fanScript-scrollWatchOver','none');
			var handler = function(){
				$(window).scroll(function(){
					//watching向下轉動
					var loop = true;
					while(loop){
						var x = $("[fanScript-scrollWatchOver='none']:first").offset();
						if(x !== null){
							if($(window).scrollTop() + $(window).height() - settings.watchingDistance > x.top){
								//初始直線型瀏覽
								$("[fanScript-scrollWatchOver='none']:first").attr('fanScript-scrollWatchOver','watching');
								settings.callback();
							}
							else{//結束迴圈
								var loop = false;
							}
						}
						else{//結束迴圈
							var loop = false;
						}
					}
				});
			}
			return this.each(handler);
		};
		
		//$.mousewheel(function(event, delta){});滑鼠滾輪偵測，delta若是負值為往下滾；反之則往上滾
		//var count = 0;
		//$("#mousewheel_example").mousewheel(function(event, delta){
		//	alert(delta);
		//});
		var mousewheelTypes = ['DOMMouseScroll', 'mousewheel'];
		if ($.event.fixHooks) {
			for ( var i=mousewheelTypes.length; i; ) {
				$.event.fixHooks[ mousewheelTypes[--i] ] = $.event.mouseHooks;
			}
		}
		$.event.special.mousewheel = {
			setup: function() {
				if ( this.addEventListener ) {
					for ( var i=mousewheelTypes.length; i; ) {
						this.addEventListener( mousewheelTypes[--i], mousewheelHandler, false );
					}
				} else {
					this.onmousewheel = mousewheelHandler;
				}
			},
			teardown: function() {
				if ( this.removeEventListener ) {
					for ( var i=mousewheelTypes.length; i; ) {
						this.removeEventListener( mousewheelTypes[--i], mousewheelHandler, false );
					}
				} else {
					this.onmousewheel = null;
				}
			}
		};
		$.fn.extend({
			mousewheel: function(fn) {
				return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
			},
			unmousewheel: function(fn) {
				return this.unbind("mousewheel", fn);
			}
		});
		function mousewheelHandler(event) {
			var orgEvent = event || window.event, args = [].slice.call( arguments, 1 ), delta = 0, returnValue = true, deltaX = 0, deltaY = 0;
			event = $.event.fix(orgEvent);
			event.type = "mousewheel";
			// Old school scrollwheel delta
			if ( orgEvent.wheelDelta ) { delta = orgEvent.wheelDelta/120; }
			if ( orgEvent.detail     ) { delta = -orgEvent.detail/3; }
			// New school multidimensional scroll (touchpads) deltas
			deltaY = delta;
			// Gecko
			if ( orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
				deltaY = 0;
				deltaX = -1*delta;
			}
			// Webkit
			if ( orgEvent.wheelDeltaY !== undefined ) { deltaY = orgEvent.wheelDeltaY/120; }
			if ( orgEvent.wheelDeltaX !== undefined ) { deltaX = -1*orgEvent.wheelDeltaX/120; }
			// Add event and delta to the front of the arguments
			args.unshift(event, delta, deltaX, deltaY);
			return ($.event.dispatch || $.event.handle).apply(this, args);
		}
		
		//scrollReel高級捲軸
		$.fn.scrollReel = function(_settings){
			var _this = this;
			var defaultSettings = {
			};
			var settings = $.extend(defaultSettings, _settings);
			var handler = function(){
				var $this = $(this);
				var scrollMoveHeight = 100;//box每次捲動移動的範圍
				var thisHeightAll;//box高度
				var scrollHeight;//box內容距離上方長度
				var contentHeight;//box內容高度
				var turnCount;//捲軸每次移動幅度
				$this.attr("fanScript-scrollReel","true");
				if($this.css("position") != 'fixed'){
					$this.css("position","relative");
				}
				$this.append("<div fanScript-scrollReelChild></div>");
				var $thisChild = $this.children("[fanScript-scrollReelChild]");
				$this.resize(function(){
					reSet();
				});
				$this.mouseenter(function(){
					if(scrollHeight == undefined || thisHeightAll != $this.heightAll() || contentHeight != scrollHeight + thisHeightAll){
						reSet();
					}
				});
				$this.mousewheel(function(event, delta){
					if(delta == 1 && scrollHeight > 20 && $this.scrollTop() > 10){
						$thisChild.css("top", (parseInt($thisChild.css("top")) - turnCount) + "px");
						$this.scrollTop($this.scrollTop() - scrollMoveHeight);
						if(parseInt($thisChild.css("top")) < 10){
							$thisChild.css("top", "10px");
						}
					}
					else if(delta == -1 && scrollHeight > 20 && $this.scrollTop() < scrollHeight - 10){
						$thisChild.css("top", (parseInt($thisChild.css("top")) + turnCount) + "px");
						$this.scrollTop($this.scrollTop() + scrollMoveHeight);
						if(parseInt($thisChild.css("top")) > contentHeight - $thisChild.height() - 10){
							$thisChild.css("top", (contentHeight - $thisChild.height() - 10) + "px");
						}
					}
				});
				function reSet(){
					$thisChild.css("top", "10px");
					$thisChild.height(0);
					thisHeightAll = $this.heightAll();
					$this.scrollTop(9999999999);
					scrollHeight = $this.scrollTop();
					if(scrollHeight > 20){
						contentHeight = scrollHeight + thisHeightAll;
						turnCount = scrollMoveHeight + ((thisHeightAll - 20) / Math.ceil(contentHeight / scrollMoveHeight));
						var thisChildHeight = $this.heightAll() * $this.heightAll() / contentHeight;
						$thisChild.height(thisChildHeight);
					}
					$this.scrollTop(0);
				}
			}
			return this.each(handler);
		};
		
		//jQuery resize event內容變更事件偵測
		var elems = $([]),
		jq_resize = $.resize = $.extend( $.resize, {} ),
		timeout_id,
		str_setTimeout = 'setTimeout',
		str_resize = 'resize',
		str_data = str_resize + '-special-event',
		str_delay = 'delay',
		str_throttle = 'throttleWindow';
		jq_resize[ str_delay ] = 250;
		jq_resize[ str_throttle ] = true;
		$.event.special[ str_resize ] = {
			setup: function() {
				if ( !jq_resize[ str_throttle ] && this[ str_setTimeout ] ) { return false; }
				var elem = $(this);
				elems = elems.add( elem );
				$.data( this, str_data, { w: elem.width(), h: elem.height() } );
				if ( elems.length === 1 ) {
					loopy();
				}
			},
			teardown: function() {
				if ( !jq_resize[ str_throttle ] && this[ str_setTimeout ] ) { return false; }
				var elem = $(this);
				elems = elems.not( elem );
				elem.removeData( str_data );
				if ( !elems.length ) {
					clearTimeout( timeout_id );
				}
			},
			add: function( handleObj ) {
				if ( !jq_resize[ str_throttle ] && this[ str_setTimeout ] ) { return false; }
				var old_handler;
				function new_handler( e, w, h ) {
					var elem = $(this),
					data = $.data( this, str_data );
					data.w = w !== undefined ? w : elem.width();
					data.h = h !== undefined ? h : elem.height();
					old_handler.apply( this, arguments );
				};
				if ( $.isFunction( handleObj ) ) {
					old_handler = handleObj;
					return new_handler;
				} else {
					old_handler = handleObj.handler;
					handleObj.handler = new_handler;
				}
			}
		};
		function loopy() {
			timeout_id = window[ str_setTimeout ](function(){
			elems.each(function(){
				var elem = $(this),
				width = elem.width(),
				height = elem.height(),
				data = $.data( this, str_data );
				if ( width !== data.w || height !== data.h ) {
					elem.trigger( str_resize, [ data.w = width, data.h = height ] );
				}
			});
			// Loop.
			loopy();
			}, jq_resize[ str_delay ] );
		};
		
		//$().scrollWatch({watchingDistance:0, watchedDistance:0, callback:function(){}});
		//偵測網頁瀏覽位置，網頁瀏覽位置由下而上出現後觸發callback
		$.fn.scrollWatch = function(_settings){
			this.scrollTopNow = 0;
			var _this = this;
			var defaultSettings = {
				watchingDistance: 0,
				bottomCallback: function() {},
				topCallback: function() {}
			};
			var settings = $.extend(defaultSettings, _settings);
			$("[fanScript-scrollWatch]").attr('fanScript-scrollWatch','none');
			var handler = function(){
				$(window).scroll(function(){
					if($(window).scrollTop() >= _this.scrollTopNow){
						_this.scrollTopNow = $(window).scrollTop();
						//watching向下轉動
						var loop = true;
						while(loop){
							if($("[fanScript-scrollWatch='watching']").length > 0){//watching已經存在
								var x = $("[fanScript-scrollWatch='watching']:last").nextAll("[fanScript-scrollWatch='none']:first").offset();
							}
							else{//初始直線型瀏覽
								var x = $("[fanScript-scrollWatch='none']:first").offset();
							}
							if(x !== null){
								if($(window).scrollTop() + $(window).height() - settings.watchingDistance > x.top){
									if($("[fanScript-scrollWatch='watching']").length > 0){//watching已經存在
										$("[fanScript-scrollWatch='watching']:last").nextAll("[fanScript-scrollWatch='none']:first").attr('fanScript-scrollWatch','watching');
									}
									else{//初始直線型瀏覽
										$("[fanScript-scrollWatch='none']:first").attr('fanScript-scrollWatch','watching');
									}
									settings.bottomCallback();
								}
								else{//結束迴圈
									var loop = false;
								}
							}
							else{//結束迴圈
								var loop = false;
							}
						}
						//none向下捲動
						var loop = true;
						while(loop){
							var x = $("[fanScript-scrollWatch='watching']:first").offset();
							if(x !== null){
								var objHeight = $("[fanScript-scrollWatch='watching']:first").heightAll();
								if($(window).scrollTop() - objHeight > x.top){
									$("[fanScript-scrollWatch='watching']:first").attr('fanScript-scrollWatch','none');
								}
								else{
									var loop = false;
								}
							}
							else{
								var loop = false;
							}
						}
					}
					else if($(window).scrollTop() < _this.scrollTopNow){
						_this.scrollTopNow = $(window).scrollTop();
						//watching向上轉動
						var loop = true;
						while(loop){
							var x = $("[fanScript-scrollWatch='watching']:first").prevAll("[fanScript-scrollWatch='none']:first").offset();
							if(x !== null){
								var objHeight = $("[fanScript-scrollWatch='watching']:first").prevAll("[fanScript-scrollWatch='none']:first").heightAll();
								if($(window).scrollTop() - objHeight < x.top){
									$("[fanScript-scrollWatch='watching']:first").prevAll("[fanScript-scrollWatch='none']:first").attr('fanScript-scrollWatch','watching');
									settings.topCallback();
								}
								else{//結束迴圈
									var loop = false;
								}
							}
							else{//結束迴圈
								var loop = false;
							}
						}
						//none向上捲動
						var loop = true;
						while(loop){
							var x = $("[fanScript-scrollWatch='watching']:last").offset();
							if(x !== null){
								if($(window).scrollTop() + $(window).height() < x.top){
									$("[fanScript-scrollWatch='watching']:last").attr('fanScript-scrollWatch','none');
								}
								else{
									var loop = false;
								}
							}
							else{
								var loop = false;
							}
						}
					}
				});
			}
			return this.each(handler);
		};
		
		//fanScript-textareaAutoHeight自動調整textarea高度
		//<div fanScript-textareaAutoHeight><textarea></textarea></div>
		$(document).on('focus', '[fanScript-textareaAutoHeight]', function() {
			if($(this).attr('pre') == 'true'){
			}
			else{
				$(this).attr('pre', 'true');
				var $this = $(this),
				$mirror = $("<pre><span></span><br /></pre>").appendTo($this),
				$textarea = $this.find("textarea"),
				checkCssRule = "font-size line-height border padding margin".split(" "),
				ruleIterator = 0,
				ruleLength = checkCssRule.length,
				rule;
				for (; ruleIterator < ruleLength; ruleIterator++) {
					rule = checkCssRule[ruleIterator];
					if ($textarea.css(rule)) {
						$mirror.css(rule, $textarea.css(rule));
					}
				}
				$mirror.width($textarea.width());
				$textarea.on("input", function(){
					$mirror.find("span").html($textarea.val());
					$textarea.height($mirror.height());
				}).trigger("input");
			}
		});
		
		//fanScript-promptTitleMeta提示浮動標籤
		//<a fanScript-promptTitleMeta="this is a apple">what's this?</a>
		$(document).on('ajax ready', function() {
			$("[fanScript-promptTitleMeta]:not([fanScript-promptTitleMetaChild])").each(function() {
				var $this = $(this);
				var $child = $("<span fanScript-promptTitleMetaChild></span>").appendTo($this);
				$child.css("left", $this.widthAll());
				$child.css("display", "none");
				$child.text($this.attr("fanScript-promptTitleMeta"));
			});
		});
		$(document).on('hover', '[fanScript-promptTitleMeta]', function() {
			$(this).find("[fanScript-promptTitleMetaChild]").css("display", "");
		});
		
		//fanScript-cssEvent
		//當物件發生cssEvent時，為指定物件添加該值的Class屬性，並執行該值的預設或自訂CSS動畫
		//cssEvent：cssEventClick、cssEventMouseenter、cssEventMouseleave、cssEventScrolTop、cssEventTimeOut
		//cssEvent可傳入四個JSON值{select,class,action,time}
		//select表示選擇器，select為jQuery選擇器，class為css class，action為動作(add/remove)，time為延遲時間，time留空為不延遲
		//cssEvent可以使用「/」分隔同樣動作啟用的CSS效果
		//CSS值填寫預設動畫Class有動畫效果animationDown、animationDown、animationDown、animationDown
		//
		$(document).on('click', '[fanScript-cssEventClick]', function(){
			var cssEventArray = $(this).attr('fanScript-cssEventClick').split("/");
			for(var i = 0;i < cssEventArray.length;i++){
				var value = cssEventArray[i].split(",", 4);
				cssEvent($(this), value[0], value[1], value[2], value[3]);
			}
		});
		$(document).on('mouseenter', '[fanScript-cssEventMouseenter]', function(){
			var cssEventArray = $(this).attr('fanScript-cssEventMouseenter').split("/");
			for(var i = 0;i < cssEventArray.length;i++){
				var value = cssEventArray[i].split(",", 4);
				cssEvent($(this), value[0], value[1], value[2], value[3]);
			}
		});
		$(document).on('mouseleave', '[fanScript-cssEventMouseleave]', function(){
			var cssEventArray = $(this).attr('fanScript-cssEventMouseleave').split("/");
			for(var i = 0;i < cssEventArray.length;i++){
				var value = cssEventArray[i].split(",", 4);
				cssEvent($(this), value[0], value[1], value[2], value[3]);
			}
		});
		$('[fanScript-cssEventTimeOut]').each(function(){
			var cssEventArray = $(this).attr('fanScript-cssEventTimeOut').split("/");
			for(var i = 0;i < cssEventArray.length;i++){
				var value = cssEventArray[i].split(",", 4);
				cssEvent($(this), value[0], value[1], value[2], value[3]);
			}
		});
		
		//fanScript-slideshow
		//slideshowNav為選項，由slideshowPage="0"指定slideshowPic畫布的開始選項
		//slideshowPic為畫面，由slideshowPage="0"指定開始畫面
		//slideshowLeft為向左轉觸發按鈕
		//slideshowRight為向右轉觸發按鈕
		//利用slideshowPic畫布產生的slideshowPath做出幻燈片（left、center、right、hidden）的轉場效果
		//利用slideshowNav選項產生的slideshowClick做出（true）選擇鍵效果
		//一定要放置slideshowNav才可使用
		//
		//基本模組ex：
		//<div fanScript-slideshowPic="sample1" fanScript-slideshowPage="0" fanScript-slideShowEvent="click"></div>
		//<div fanScript-slideshowPic="sample1"></div>
		//<div fanScript-slideshowPic="sample1"></div>
		//<div fanScript-slideshowNav="sample1" fanScript-slideshowPage="0"></div>
		//<div fanScript-slideshowNav="sample1"></div>
		//<div fanScript-slideshowNav="sample1"></div>
		//<div fanScript-slideshowLeft="sample1"></div>
		//<div fanScript-slideshowRight="sample1"></div>
		$("[fanScript-slideshowPic][fanScript-slideshowPage='0']").each(function(){
			var name = $(this).attr("fanScript-slideshowPic");
			if($(this).attr("fanScript-slideShowEvent") == '' || $(this).attr("fanScript-slideShowEvent") == 'click'){
				var slideShowEvent = 'click';
			}
			else if($(this).attr("fanScript-slideShowEvent") == 'mouseenter'){
				var slideShowEvent = 'mouseenter';
			}
			else if($(this).attr("fanScript-slideShowEvent") == 'click,mouseenter'){
				var slideShowEvent = 'click,mouseenter';
			}
			else{
				var slideShowEvent = 'click';
			}
			if($("[fanScript-slideshowPic='" + name + "']").size() == 2){
				$("[fanScript-slideshowPic='" + name + "']:eq(0)").clone().removeAttr("fanScript-slideshowPage").insertAfter("[fanScript-slideshowPic='" + name + "']:last");
				$("[fanScript-slideshowPic='" + name + "']:eq(1)").clone().removeAttr("fanScript-slideshowPage").insertAfter("[fanScript-slideshowPic='" + name + "']:last");
				$("[fanScript-slideshowNav='" + name + "']:eq(0)").clone().removeAttr("fanScript-slideshowPage").insertAfter("[fanScript-slideshowNav='" + name + "']:last");
				$("[fanScript-slideshowNav='" + name + "']:eq(1)").clone().removeAttr("fanScript-slideshowPage").insertAfter("[fanScript-slideshowNav='" + name + "']:last");
			}
			//為slideshowNav和slideshowPic增加對應的slideshowPage屬性
			$("[fanScript-slideshowNav='" + name + "']").each(function(key, value){
				$(this).attr("fanScript-slideshowPage", key);
				$("[fanScript-slideshowPic='" + name + "']:eq(" + key + ")").attr("fanScript-slideshowPage", key);
			});
			if($("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]").size() > 1){
				//依照slideshowNav增加slideshowPic的left、center、right屬性
				$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:eq(0)").attr("fanScript-slideshowPath","center");
				$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:eq(1)").attr("fanScript-slideshowPath","right");
				$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:last").remove().clone().attr("fanScript-slideshowPath","left").insertBefore("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:eq(0)");
				//為slideshowNav增加click屬性
				$("[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage]:eq(0)").attr("fanScript-slideshowClick", "true");
				//滑鼠選擇圖片時轉換
				$(document).on(slideShowEvent, "[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage]", function(){
					if($(this).attr("fanScript-slideshowPage") !== $("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPath='center']").attr("fanScript-slideshowPage")){
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPath='hidden']").remove();
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]").removeAttr("fanScript-slideshowPath");
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]").attr("fanScript-slideshowTurn","select");
						$("[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage][fanScript-slideshowClick='true']").removeAttr("fanScript-slideshowClick");
						$(this).attr("fanScript-slideshowClick", "true");
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]").removeAttr("fanScript-slideshowPath");
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage='" + $(this).attr("fanScript-slideshowPage") + "']").attr("fanScript-slideshowPath","center");
						//倒反center前面的dom
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='center']").prevAll().remove().clone().insertBefore("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:eq(0)");
						//增加path屬性
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='center']").prevAll().remove().clone().insertAfter("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:last");
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPath='center']").next().clone().attr("fanScript-slideshowPath", "hidden").insertBefore("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPath='center']");
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='center']").next().attr("fanScript-slideshowPath","right");
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:last").remove().clone().attr("fanScript-slideshowPath","left").insertBefore("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='center']");
						if($.browser.msie && $.browser.version < 10){
							$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='center']").css('display', 'none').fadeIn();
							$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath!='center']").css('display', 'none');
						}
					}
				});
				//滑鼠點選右轉時轉換
				$(document).on(slideShowEvent, "[fanScript-slideshowRight='" + name + "']", function(){
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPath='hidden']").remove();
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]").removeAttr("fanScript-slideshowTurn");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]").attr("fanScript-slideshowTurn","right");
					$("[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage][fanScript-slideshowClick='true']").removeAttr("fanScript-slideshowClick").next().attr("fanScript-slideshowClick", "true");
					if($("[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage][fanScript-slideshowClick='true']").size() == 0){
						$("[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage]:eq(0)").attr("fanScript-slideshowClick", "true");
					}
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='right']").removeAttr("fanScript-slideshowPath").next().attr("fanScript-slideshowPath","right");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='center']").removeAttr("fanScript-slideshowPath").next().attr("fanScript-slideshowPath","center");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='left']").removeAttr("fanScript-slideshowPath").next().attr("fanScript-slideshowPath","left");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:eq(0)").clone().insertAfter("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:last");
					$("[fanScript-slideshowPic='" + name + "']:eq(0)").attr("fanScript-slideshowPath", "hidden");
					if($("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='right']").size() == 0){
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:last").attr("fanScript-slideshowPath","right");
					}
				});
				//滑鼠點選左轉時轉換
				$(document).on(slideShowEvent, "[fanScript-slideshowLeft='" + name + "']", function(){
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPath='hidden']").remove();
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]").removeAttr("fanScript-slideshowTurn");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]").attr("fanScript-slideshowTurn","left");
					$("[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage][fanScript-slideshowClick='true']").removeAttr("fanScript-slideshowClick").prev().attr("fanScript-slideshowClick", "true");
					if($("[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage][fanScript-slideshowClick='true']").size() == 0){
						$("[fanScript-slideshowNav='" + name + "'][fanScript-slideshowPage]:last").attr("fanScript-slideshowClick", "true");
					}
					$("[fanScript-slideshowPic='" + name + "']:last").remove().clone().insertBefore("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:eq(0)");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPath='right']").clone().attr("fanScript-slideshowPath", "hidden").insertBefore("[fanScript-slideshowPic='" + name + "']:eq(0)");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='left']").removeAttr("fanScript-slideshowPath").prev().attr("fanScript-slideshowPath","left");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='center']").removeAttr("fanScript-slideshowPath").prev().attr("fanScript-slideshowPath","center");
					$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='right']").removeAttr("fanScript-slideshowPath").prev().attr("fanScript-slideshowPath","right");
					if($("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage][fanScript-slideshowPath='right']").size() == 0){
						$("[fanScript-slideshowPic='" + name + "'][fanScript-slideshowPage]:eq(3)").attr("fanScript-slideshowPath","right");
					}
				});
			}
			else{
				$("[fanScript-slideshowPic='" + name + "']").attr("fanScript-slideshowTurn", "select");
				$("[fanScript-slideshowPic='" + name + "']").attr("fanScript-slideshowPath", "select");
			}
			if($("[fanScript-slideshowPic='" + name + "']").size() == 1){
				$("[fanScript-slideshowPic='" + name + "']:eq(0)").attr("fanScript-slideshowPath","center");
				$("[fanScript-slideshowNav='" + name + "']:eq(0)").attr("fanScript-slideShowEvent","click");
			}
		});
		
		//fanScript-imgLoading
		$.fn.imgLoading = function(_settings){
			var defaultSettings = {
				obj: 'document',
				callback: function() {}
			};
			var settings = $.extend(defaultSettings, _settings);
			var _this = this;
			var handler = function(){
				$(settings.obj).append("<span class='text'>Loading</span> <span class='number' data-number='0'>0</span> <span class='percent'>%</span>");
				var imgSize = 100 / parseInt($(_this).find("img").size());
				$(_this).find("img").each(function(){
					$(this).imagesLoaded(function(){
						$(settings.obj).children(".number").data("number", $(settings.obj).children(".number").data("number") + imgSize);
						$(settings.obj).children(".number").text(Math.floor($(settings.obj).children(".number").data("number")));
						if($(settings.obj).children(".number").text() >= 99){
							settings.callback();
						}
					}); 
				});
			}
			return this.each(handler);
		};
		
	});//jQuery ready over
	
	//jQuery.cookie();
	$.cookie = function(name, value, options) {
		if (typeof value != 'undefined') { // name and value given, set cookie
			options = options || {};
			if (value === null) {
				value = '';
				options = $.extend({}, options); // clone object since it's unexpected behavior if the expired property were changed
				options.expires = -1;
			}
			var expires = '';
			if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
				var date;
				if (typeof options.expires == 'number') {
					date = new Date();
					date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
				} else {
					date = options.expires;
				}
				expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
			}
			// NOTE Needed to parenthesize options.path and options.domain
			// in the following expressions, otherwise they evaluate to undefined
			// in the packed version for some reason...
			var path = options.path ? '; path=' + (options.path) : '';
			var domain = options.domain ? '; domain=' + (options.domain) : '';
			var secure = options.secure ? '; secure' : '';
			document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
		} else { // only name given, get cookie
			var cookieValue = null;
			if (document.cookie && document.cookie != '') {
				var cookies = document.cookie.split(';');
				for (var i = 0; i < cookies.length; i++) {
					var cookie = $.trim(cookies[i]);
					// Does this cookie string begin with the name we want?
					if (cookie.substring(0, name.length + 1) == (name + '=')) {
						cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
						break;
					}
				}
			}
			return cookieValue;
		}
	}
		
	function cssEvent(_this, cssSelect, cssClass, cssAction, cssTimeOut){
			var _this;
			if(cssTimeOut == ''){
				if(cssAction == 'add'){
					if(cssSelect == 'this'){
						_this.addClass(cssClass);
					}
					else{
						$(cssSelect).addClass(cssClass);
					}
				}
				if(cssAction == 'remove'){
					if(cssSelect == 'this'){
						_this.removeClass(cssClass);
					}
					else{
						$(cssSelect).removeClass(cssClass);
					}
				}
			}
			else{
				setTimeout(function(){
					if(cssAction == 'add'){
						if(cssSelect == 'this'){
							_this.addClass(cssClass);
						}
						else{
							$(cssSelect).addClass(cssClass);
						}
					}
					if(cssAction == 'remove'){
						if(cssSelect == 'this'){
							_this.removeClass(cssClass);
						}
						else{
							$(cssSelect).removeClass(cssClass);
						}
					}
				}, cssTimeOut);
			}
			
	}
})(jQuery);//$ > jQuery over

//fanScript Class
function fanScript(){
	var $ = jQuery;//jQuery $ > jQuery Start
	
	//跑馬燈
	this.slideLine = function(box,stf,delay,speed,h,mouse){
		//box為標籤名稱、stf為內標籤類型，delay為延遲毫秒數、speed速度、h高度，mouse=1的話，滑鼠經過會停，pause=0滑鼠經過無效
		//取得id
		var box;
		var slideBox = document.getElementById(box);
		slideBox.scrollTop = h;
		//預設值 delay:幾毫秒滾動一次(1000毫秒=1秒)
		//       speed:數字越小越快，h:高度
		if(delay !== 0){
			var delay = delay||1000;
		}
		var speed = speed||20;
		var h = h||20;
		var tid = null,pause = false;
		var mouse = mouse||0;
		//setInterval跟setTimeout的用法可以咕狗研究一下~
		var s = function(){tid=setInterval(slide, speed);}
		//主要動作的地方
		var slide = function(){
			//當滑鼠移到上面的時候就會暫停
			if(pause) return;
			//滾動條往下滾動 數字越大會越快但是看起來越不連貫，所以這邊用1
			if($.browser.msie){
				slideBox.scrollTop += -10;//IE跑比較慢，所以更改
			}
			else{
				slideBox.scrollTop += -3;
			}
			//滾動到一個高度(h)的時候就停止
			if(slideBox.scrollTop%h == 0){
				//跟setInterval搭配使用的
				clearInterval(tid);
				//將剛剛滾動上去的前一項加回到整列的最後一項
				slideBox.insertBefore(slideBox.getElementsByTagName(stf)[slideBox.getElementsByTagName(stf).length-1],slideBox.getElementsByTagName(stf)[0]);
				//再重設滾動條到最上面
				slideBox.scrollTop = h;
				//延遲多久再執行一次
				setTimeout(s, delay);
			}
		}
		//滑鼠移上去會暫停 移走會繼續動
		if(mouse == 1){
			slideBox.onmouseover = function(){pause=true;}
			slideBox.onmouseout = function(){pause=false;}
		}
		//起始的地方，沒有這個就不會動囉
		setTimeout(s, delay);
	}
	
	//Mywindow視窗class
	myWindowOpenNow = false;
	this.MyWindow = function(){
		var _this = this;
		var bodyScrollTop = 0;//攝影機位置紀錄
		//開啟mywindow視窗
		this.myWindowOpen = function(_id, _myWindowMajorWidth){
			var id = _id || '';
			var myWindowMajor = '#' + id + '.myWindowMajor';
			if(myWindowOpenNow == false){
				myWindowOpenNow = true;
			}
			else{
				return false;
			}
			$("<div>").addClass("myWindowShadow").insertAfter(".myWindowMajor");
			$("<div>").addClass("myWindowBg myWindowClose").insertAfter(".myWindowMajor");
			$("body").css("overflow-y","scroll");
			if($.browser.msie){
				$(myWindowMajor).css("display","block");
				$(".myWindowShadow").css("display","block");
				$(".myWindowBg").css("display","block");
			}
			else{
				$(myWindowMajor).fadeIn(300);
				$(".myWindowShadow").fadeIn(300);
				$(".myWindowBg").fadeIn(300);
			}
			//計算主要視窗數據
			var myWindowMajorWidth = _myWindowMajorWidth || 400;
			var myWindowMajorHeight = $(myWindowMajor).height();
			var myWindowMajorMarginLeft = parseInt('-' + myWindowMajorWidth) / 2 + 'px';
			var myWindowMajorMarginTop = parseInt('-' + myWindowMajorHeight) / 2 + 'px';
			//計算背景視窗數據
			var myWindowBgWidth = (parseInt(myWindowMajorWidth) + 20 ) + 'px';
			var myWindowBgHeight = (parseInt(myWindowMajorHeight) + 20 ) + 'px';
			var myWindowBgMarginLeft = (((parseInt('-' + myWindowMajorWidth) + 20 ) / 2 ) -20) + 'px';
			var myWindowBgMarginTop = (((parseInt('-' + myWindowMajorHeight) + 20 ) / 2 ) -20) + 'px';
			//改變視窗大小位置
			$(myWindowMajor).css({"width":myWindowMajorWidth,"height":myWindowMajorHeight,"margin-left":myWindowMajorMarginLeft,"margin-top":myWindowMajorMarginTop});
			$(".myWindowShadow").css({"width":myWindowBgWidth,"height":myWindowBgHeight,"margin-left":myWindowBgMarginLeft,"margin-top":myWindowBgMarginTop});
			//改變body能見度與捲軸
			this.bodyScrollTop = $(window).scrollTop();
			var windowHeight = $(window).height();
			var windowWidth = $(window).width();
			var windowMargin = parseInt('-' + windowWidth) / 2;
			$(".body").css({"overflow-y":"hidden", "position":"fixed", "width":windowWidth, "height":windowHeight});
			$(".body").scrollTop(this.bodyScrollTop);
		}
		//mywindow關閉事件
		$(document).on('click', '.myWindowClose', function(event){
			_this.close();
		});
		//mywindow關閉事件
		$(document).on('click', '.myWindowSendSubmit', function(event){
			_this.close();
		});
		//mywindow關閉事件
		$(document).on('click', '.myWindowCancelSubmit', function(event){
			_this.close();
		});
		this.close = function(){
			myWindowOpenNow = false;
			$("body").css("overflow-y","auto");
			if($.browser.msie){
				$(".myWindowMajor").css("display","none");
				$(".myWindowShadow").css("display","none");
				$(".myWindowBg").css("display","none");
			}
			else{
				$(".myWindowMajor").fadeOut(300);
				$(".myWindowShadow").fadeOut(300);
				$(".myWindowBg").fadeOut(300);
			}
			//改變body能見度與捲軸
			$(".body").css({"overflow-y":"visible","position":"static","margin":"0","height":"auto"});
			$(window).scrollTop(_this.bodyScrollTop);
			fanScript.delayExecute(
				function() {
					return true;
				},
				function() {
					$(".myWindowMajor").remove();
					$(".myWindowShadow").remove();
					$(".myWindowBg").remove();
				}//如果已經登出就重新整理
			);
		}
	}
	
	//檢查XXX，如果XXX已經變化就執行XXX的函式
	this.delayExecute = function(check, proc, chkInterval) {
		//default interval = 500ms
		var x = chkInterval || 500;
		var hnd = window.setInterval(function (){
			//if check() return true, 
			//stop timer and execute proc()
			if (check()) {
				window.clearInterval(hnd);
				proc();
			}
		}, x);
	}
    
    
    this.check_href_action = function(message, url){
        var message;
        var url;
        var answer = confirm(message);
        if (answer){
            location.href = url;
        }
    }
	
	//判斷瀏覽器類型
	this.detectBrowser = function(){
		var sAgent = navigator.userAgent.toLowerCase();
		if(sAgent.indexOf("msie") != -1){
			return 'ie';
		}
		else if(sAgent.indexOf("firefox") != -1){
			return 'firefox';
		}
		else if(sAgent.indexOf("chrome") != -1){
			return 'chrome';
		}
		else if(sAgent.indexOf("safari") != -1){
			return 'safari';
		}
		else if(sAgent.indexOf("opera") != -1){
			return 'opera';
		}
		else if(sAgent.indexOf("netscape") != -1){
			return 'netscape';
		}
		else{
			return 'other';
		}
	}
	
	//倒數計時器
	this.countdownTimer = function(jQuerySelector, time){
		var padZero = function(a,b){//倒數計時器補零
			return a.toString().length >= b ? a : padZero("0" + a, b);
		}
		var jQuerySelector;
		if(time !== null){
			var time = time - 1;
		}
		else{
			var time = $(jQuerySelector).attr('fanScript-countdownTimer') - 1;
		}
		$(jQuerySelector).attr('fanScript-countdownTimer', time);
		if(time >= 0){
			var c = padZero(parseInt(time / 3600, 10), 2);
			var d = padZero(parseInt(time % 3600 / 60, 10), 2);
			var e = padZero(parseInt(time % 60, 10), 2);
			$(jQuerySelector).html("<b class=hour>" + c + "</b>時 <b class=minute>" + d + "</b>分 <b class=second>" + e + "</b>秒");
			setTimeout(function(){
				fanScript.countdownTimer(jQuerySelector, time);
			}, 1000);
		}
	}
	
	//取得網址參數
	var queryString = window.top.location.search.substring(1);
	function getParameter(queryString, parameterName){
		// Add "=" to the parameter name (i.e. parameterName=value)
		var parameterName = parameterName + "=";
		if(queryString.length > 0) {
			// Find the beginning of the string
			begin = queryString.indexOf(parameterName);
			// If the parameter name is not found, skip it, otherwise return the value
			if (begin != -1){
			// Add the length (integer) to the beginning
				begin += parameterName.length;
				// Multiple parameters are separated by the "&" sign
				end = queryString.indexOf("&", begin);
				if (end == -1) {
					end = queryString.length
				}
				// Return the string
				return unescape(queryString.substring(begin, end));
			}
			// Return "null" if no parameter has been found
			return "null";
		}
	}
}
fanScript = new fanScript();