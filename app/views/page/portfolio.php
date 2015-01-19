<?=$temp['header_up']?>
<script>
$(function(){
	$(window).scroll(function(){
		if($("body").hasClass("portfolio") && $('.portfolioPageBg').hasClass('hover') == false){
			var window_height_half = $(window).height() / 2;
			$("body.portfolio .topHeader .navBar .nav").removeClass('hover');
			if($(window).scrollTop() < 1200 - window_height_half){
				$("body.portfolio .topHeader .navBar .nav[data-nav='website']").addClass('hover');
			}
			else if($(window).scrollTop() < 2400 - window_height_half){
				$("body.portfolio .topHeader .navBar .nav[data-nav='cis']").addClass('hover');
			}
			else if($(window).scrollTop() < 3600 - window_height_half){
				$("body.portfolio .topHeader .navBar .nav[data-nav='graphic']").addClass('hover');
			}
			else if($(window).scrollTop() < 4800 - window_height_half){
				$("body.portfolio .topHeader .navBar .nav[data-nav='marketing']").addClass('hover');
			}
		}
	});
	
	
	//作品頁變更 portfolie
	$(document).on('click', '.bodyPagePortfolio .portfolioDiv', function(){
		$this = $(this);
		var chref = $this.data('chref');
		var csrc = $this.data('csrc');
		$('.fixedPortfolioContent .content .pic').attr('href', chref);
		$('.fixedPortfolioContent .content .ahref').attr('href', chref);
		$('.fixedPortfolioContent .content .pic img').attr('src', csrc);
		if($this.parents('.portfolioPageBg').hasClass('portfolioPageWebsiteBg') == true){
			$("html,body").animate({scrollTop: 0}, 500, 'swing');
			$('.fixedPortfolioContent').css({'color':'#222', 'background-image':'url(app/img/bg14.jpg)'});
		}
		else if($this.parents('.portfolioPageBg').hasClass('portfolioPageCISBg') == true){
			$("html,body").animate({scrollTop: 1200}, 500, 'swing');
			$('.fixedPortfolioContent').css({'color':'#222', 'background-image':'url(app/img/bg14.jpg)'});
		}
		else if($this.parents('.portfolioPageBg').hasClass('portfolioPageGraphicDesignBg') == true){
			$("html,body").animate({scrollTop: 2400}, 500, 'swing');
			$('.fixedPortfolioContent').css({'color':'#222', 'background-image':'url(app/img/bg14.jpg)'});
		}
		else if($this.parents('.portfolioPageBg').hasClass('portfolioPageMarketingBg') == true){
			$("html,body").animate({scrollTop: 3600}, 500, 'swing');
			$('.fixedPortfolioContent').css({'color':'#222', 'background-image':'url(app/img/bg14.jpg)'});
		}
		setTimeout(function(){
			$('.portfolioPageBg').addClass('hover');
			$('.fixedNoClick').addClass('displayblock');
			$('.fixedPortfolioContent').addClass('opacity1');
			setTimeout(function(){
				$('.fixedNoClickLeft, .fixedNoClickRight').addClass('opacity1');
				$('.fixedNoClick').removeClass('displayblock');
				
				bodyScrollTop = $(window).scrollTop();
				var windowHeight = $(window).height();
				var windowWidth = $(window).width();
				$(".body").css({"overflow-y":"hidden", "position":"fixed", "width":windowWidth, "height":windowHeight});
				$(".body").scrollTop(bodyScrollTop);
			},2000);
		}, 500);
	});
	$(document).on('click', '.fixedNoClickLeft, .fixedNoClickRight', function(){
		if($('.portfolioPageBg').hasClass('hover') == true){
			$('.portfolioPageBg').removeClass('hover');
			$('.fixedPortfolioContent').removeClass('opacity1');
			$('.portfolioPageBg').addClass('nohover');
			$('.fixedNoClickLeft, .fixedNoClickRight').removeClass('opacity1');
			
			$(".body").css({"overflow-y":"visible","position":"static","height":"auto"});
			$(window).scrollTop(bodyScrollTop);
			
			setTimeout(function(){
				$('.portfolioPageBg').removeClass('nohover');
			},2000);
		}
	});
});
</script>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
		<div class="fixedNoClickLeft"></div>
		<div class="fixedNoClickRight"></div>
		<div class="fixedNoClick"></div>
		<div class="fixedPortfolioContent">
			<div class="content">
				<a href="" class="pic" target="_blank">
					<img src="">
				</a>
				<a href="" class="ahref" target="_blank">設計成品：http://fanswoo.com</a>
			</div>
		</div>
		<div class="bodyPagePortfolio">
			<div class="portfolioPageBg portfolioPageWebsiteBg">
				<div class="portfolioPage portfolioPageWebsite">
					<div class="portfolioLeft">
						<h2 class="portfolioTitle">Website Design <span class="zhtw">形象、購物網站設計</span></h2>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/candace" data-csrc="app/img/web_1.jpg">
							<div class="pic showOriginal">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/kantocars" data-csrc="app/img/web_2.jpg">
							<div class="pic showOriginal">
								<img src="app/img/car.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/car.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoKantocars.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/chid" data-csrc="app/img/web_4.jpg">
							<div class="pic showOriginal">
								<img src="app/img/cheng.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/cheng.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								 成浩設計 嘉義頂級室內設計
							</div>
							<div class="logo">
								<img src="app/img/chenglogo.png">
							</div>
						</div>
						<div class="portfolioDiv"  data-chref="http://web.fanswoo.com/ipix" data-csrc="app/img/web_8.jpg">
							<div class="pic showOriginal">
								<img src="app/img/ipix.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/ipix.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								IPIX 鏡花園
							</div>
							<div class="logo">
								<img src="app/img/ipix_logo.png">
							</div>
						</div>
					</div>
					<div class="portfolioContent">
					</div>
					<div class="portfolioRight">
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/evpcone" data-csrc="app/img/web_5.jpg">
							<div class="pic showOriginal">
								<img src="app/img/evp.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/evp.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								 EVP C-On 美商新能動力集團 
							</div>
							<div class="logo">
								<img src="app/img/evplogo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/eastmansion" data-csrc="app/img/web_3.jpg">
							<div class="pic showOriginal">
								<img src="app/img/east.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/east.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								 EastMansion 高級歐美家具名品
							</div>
							<div class="logo">
								<img src="app/img/eastlogo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/wantgowant" data-csrc="app/img/web_6.jpg">
							<div class="pic showOriginal">
								<img src="app/img/wantgo.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/wantgo.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								WantGo 旺旺集團購物商城
							</div>
							<div class="logo">
								<img src="app/img/wantgo.png">
							</div>
						</div>
						<div class="portfolioDiv" data-chref="http://web.fanswoo.com/yyh" data-csrc="app/img/web_7.jpg">
							<div class="pic showOriginal">
								<img src="app/img/yyh.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/yyh.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Y.Y.H 昀諭行專業空氣濾網
							</div>
							<div class="logo">
								<img src="app/img/yyh_logo.png">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="portfolioPageBg portfolioPageCISBg" style="">
				<div class="portfolioPage portfolioPageCIS">
					<div class="portfolioLeft">
						<h2 class="portfolioTitle">CIS <span class="zhtw">企業識別、LOGO設計</span></h2>
						<div class="portfolioDiv" data-csrc="app/img/logo/portfoilo_logo_cis1.jpg">
							<div class=" box">
								
								<img src="app/img/logo/portfoilo_logo1.jpg">
							</div>
							<div class="bg"></div>
							<div class="text1">
								敘園小館-四川、江浙餐館
							</div>
						</div>
						<div class="portfolioDiv"  data-csrc="app/img/logo/portfoilo_logo_cis2.jpg">
							<div class="box">
								<img src="app/img/logo/portfoilo_logo2.jpg">
							</div>
							<div class="bg"></div>
							<div class="text1">
								TOADAR CHATENET 遊戲開發
							</div>
							
						</div>
						<div class="portfolioDiv"  data-csrc="app/img/logo/portfoilo_logo_cis3.jpg">
							<div class="box">
								<img src="app/img/logo/portfoilo_logo3.jpg">
							</div>
							<div class="bg"></div>
							<div class="text1">
								MiZZo 彩妝公司
							</div>
						
						</div>
						<div class="portfolioDiv"  data-csrc="app/img/logo/portfoilo_logo_cis4.jpg">
							<div class="box">
								<img src="app/img/logo/portfoilo_logo4.jpg">
							</div>
						
							<div class="bg"></div>
							<div class="text1">
								LOOSHI'S 甜點小舖
							</div>
							
						</div>
					</div>
					<div class="portfolioContent"  >
					</div>
					<div class="portfolioRight">
						<div class="portfolioDiv" data-csrc="app/img/logo/portfoilo_logo_cis5.jpg">
							<div class="box">
								<img src="app/img/logo/portfoilo_logo5.jpg">
							</div>
							
							<div class="bg"></div>
							<div class="text1">
								beauta 網路女性服飾
							</div>
						
						</div>
						<div class="portfolioDiv"  data-csrc="app/img/logo/portfoilo_logo_cis6.jpg">
							<div class="box">
								<img src="app/img/logo/portfoilo_logo6.jpg">
							</div>
							<div class="pic showBlur">
								
							</div>
							<div class="bg"></div>
							<div class="text1">
								極鮮日式料理
							</div>
							
						</div>
						<div class="portfolioDiv"  data-csrc="app/img/logo/portfoilo_logo_cis7.jpg">
							<div class="box">
								<img src="app/img/logo/portfoilo_logo7.jpg">
							</div>
					
							<div class="bg"></div>
							<div class="text1">
								GRID MEDIA 多媒體設計公司
							</div>
							
						</div>
						<div class="portfolioDiv"  data-csrc="app/img/logo/portfoilo_logo_cis8.jpg">
							<div class="box">
								<img src="app/img/logo/portfoilo_logo8.jpg">
							</div>
							<div class="bg"></div>
							<div class="text1">
								Georgia 私立喬治亞幼兒園
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="portfolioPageBg portfolioPageGraphicDesignBg" style="display:none;">
				<div class="portfolioPage portfolioPageGraphicDesign">
					<div class="portfolioLeft">
						<h2 class="portfolioTitle">Graphic design <span class="zhtw">視覺、平面設計</span></h2>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleKantocars.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleKantocars.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoKantocars.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleKing.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleKing.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								King 曼谷家具第一品牌
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoKing.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleDeleon.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleDeleon.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Deleon 德利昂義式餐廳
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoDeleon.png">
							</div>
						</div>
					</div>
					<div class="portfolioContent">
					</div>
					<div class="portfolioRight">
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleGxxly.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleGxxly.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								新聯陽房地產品牌
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoGxxly.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleChuantin.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleChuantin.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Chuantin 川霆科技品牌
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoChuantin.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleKantocars.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleKantocars.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoKantocars.png">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="portfolioPageBg portfolioPageMarketingBg" style="display:none;">
				<div class="portfolioPage portfolioPageMarketing">
					<div class="portfolioLeft">
						<h2 class="portfolioTitle">Marketing <span class="zhtw">網路、整合行銷專案</span></h2>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleKantocars.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleKantocars.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoKantocars.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleKing.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleKing.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								King 曼谷家具第一品牌
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoKing.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleDeleon.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleDeleon.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Deleon 德利昂義式餐廳
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoDeleon.png">
							</div>
						</div>
					</div>
					<div class="portfolioContent">
					</div>
					<div class="portfolioRight">
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleGxxly.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleGxxly.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								新聯陽房地產品牌
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoGxxly.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleChuantin.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleChuantin.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Chuantin 川霆科技品牌
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoChuantin.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleCandace.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Candace 洪秀女名品服飾設計
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoCandace.png">
							</div>
						</div>
						<div class="portfolioDiv">
							<div class="pic showOriginal">
								<img src="app/img/designSampleKantocars.jpg">
							</div>
							<div class="pic showBlur">
								<img src="app/img/designSampleKantocars.jpg">
							</div>
							<div class="bg"></div>
							<div class="text">
								Kantocars 關東車材
							</div>
							<div class="logo">
								<img src="app/img/designSampleLogoKantocars.png">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?=$temp['footer']?>