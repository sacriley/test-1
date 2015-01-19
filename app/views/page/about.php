<?=$temp['header_up']?>
	<script>
	$(function(){
		$(document).scroll(function(){
			if($(document).scrollTop() < 5500){
				$('.videoFixed').removeClass('displayblock');
			}
			if($(document).scrollTop() < 1000){
				line_nav_change(0);
			}
			else if($(document).scrollTop() >= 1000 && $(document).scrollTop() < 2000){
				line_nav_change(1);
			}
			else if($(document).scrollTop() >= 2000 && $(document).scrollTop() < 3000){
				line_nav_change(2);
			}
			else if($(document).scrollTop() >= 3000 && $(document).scrollTop() < 4000){
				line_nav_change(3);
				$('.wrapService').removeClass('hover');
				$('.wrapPersist').removeClass('hover');
			}
			else if($(document).scrollTop() >= 4000 && $(document).scrollTop() < 4500){
				line_nav_change(4);
				$('.wrapPersist').addClass('hover');
			}
			else if($(document).scrollTop() >= 4500 && $(document).scrollTop() < 5000){
				line_nav_change(5);
				$('.wrapService').addClass('hover');
			}
			else if($(document).scrollTop() >= 5000 && $(document).scrollTop() < 6000){
				$('.videoFixed').addClass('displayblock');
			}
			else if($(document).scrollTop() >= 6000 && $(document).scrollTop() < 6500){
				line_nav_change(6);
			}
			else if($(document).scrollTop() >= 6500){
				line_nav_change(7);
				$('.wrapMenu').removeClass('hover');
				$('.wrapMenuFixed').removeClass('hover');
			}
		});
		$(document).on('mouseenter', '.lineFixed .nav', function(event){
			var nav_eq = $(this).index();
			$('.lineRadiusFixed .nav:eq(' + nav_eq + ')').addClass('opacity1');
		});
		$(document).on('mouseleave', '.lineFixed .nav', function(event){
			$('.lineRadiusFixed .nav').removeClass('opacity1');
		});
		$(document).on('click', '.lineFixed .nav', function(event){
			var nav_eq = $(this).index();
			$('.lineRadiusShadowFixed .navShadow').removeClass('opacity1');
			$('.lineRadiusShadowFixed .navShadow:eq(' + nav_eq + ')').addClass('opacity1');
			var scroll_top = $(document).scrollTop();
			if(nav_eq == 0 && scroll_top !== 0){
				$("body").animate({scrollTop: 0}, 1300, 'swing');
			}
			else if(nav_eq == 1 && scroll_top !== 1000){
				$("body").animate({scrollTop: 1000}, 1300, 'swing');
			}
			else if(nav_eq == 2 && scroll_top !== 2000){
				$("body").animate({scrollTop: 2000}, 1300, 'swing');
			}
			else if(nav_eq == 3 && scroll_top !== 3000){
				$("body").animate({scrollTop: 3000}, 1300, 'swing');
			}
			else if(nav_eq == 4 && scroll_top !== 4000){
				$("body").animate({scrollTop: 4000}, 1300, 'swing');
			}
			else if(nav_eq == 5 && scroll_top !== 5000){
				$("body").animate({scrollTop: 5000}, 1300, 'swing');
			}
			else if(nav_eq == 6 && scroll_top !== 6000){
				$("body").animate({scrollTop: 6000}, 1300, 'swing');
			}
			else if(nav_eq == 7 && scroll_top !== 6500){
				$("body").animate({scrollTop: 6500}, 1300, 'swing');
			}
		});
	});
	animateIng = false;
	function line_nav_change(n){
		$('.lineRadiusFixed .nav').removeClass('clicked');
		$('.lineRadiusFixed .nav:eq(' + n + ')').addClass('clicked');
	}
	</script>
<?=$temp['header_down']?>
<?=$temp['topheader']?>
		<div class="lineBorderLeft"></div>
		<div class="lineFixed">
			<div class="nav">
				<span>關於我們</span>
			</div>
			<div class="nav">
				<span>網路行銷</span>
			</div>
			<div class="nav">
				<span>美術設計</span>
			</div>
			<div class="nav">
				<span>程式開發</span>
			</div>
			<div class="nav">
				<span>服務項目</span>
			</div>
			<div class="nav">
				<span>客製專案</span>
			</div>
			<div class="nav">
				<span>設計理念</span>
			</div>
			<div class="nav">
				<span>成功案例</span>
			</div>
		</div>
		<div class="lineRadiusFixed">
			<div class="nav clicked"></div>
			<div class="nav"></div>
			<div class="nav"></div>
			<div class="nav"></div>
			<div class="nav"></div>
			<div class="nav"></div>
			<div class="nav"></div>
			<div class="nav"></div>
		</div>
		<div class="lineRadiusShadowFixed">
			<div class="navShadow"></div>
			<div class="navShadow"></div>
			<div class="navShadow"></div>
			<div class="navShadow"></div>
			<div class="navShadow"></div>
			<div class="navShadow"></div>
			<div class="navShadow"></div>
			<div class="navShadow"></div>
		</div>
		<div class="videoFixed">
			<video src="app/img/video.mp4" autoplay loop muted>
			</video>
		</div>
		<div class="wrapStart">
			<div class="wrapContent">
				<div class="picDown"></div>
				<div class="bulb"></div>
				<div class="notebook"><img src="app/img/notebook.png"></div>
				<div class="h2Bg"><h2>fansWoo Design & Marketing</h2></div>
				<h3>it's time to know our story</h3>
				<h4>Desgin - Program - Marketing</h4>
			</div>
		</div>
		<div class="wrapMarketing">
			<div class="wrapContent">
				<h4>Notice</h4>
				<h2>客製網站 VS 套版網站</h2>
				<h3>MATTERS NEED ATTENTION</h3>
				<div class="leftContent">
					<div class="textArea">
						<p>預算不足的企業<span class="orange">千萬別相信數萬元的客製化網站</span>！真正的客製化網站是由美術設計師、網頁設計師、程式設計師共同設計的，一個月下來的設計成本最少十萬元以上，而幾萬元的專案連設計師的薪水都不夠付，只能拿套版軟體換幾張圖片充當客製化網站。</p>
						<p>為杜絕黑心設計公司欺騙消費者，我們不僅為企業設計<span class="blue">真正的客製化網站</span>，而且還<span class="red">免費提供擁有數十萬種版型的套版軟體</span>供小型企業使用，使用者僅需負擔主機費用，不需支付任何設計費，讓小型企業得以用最低成本擁有簡易網站。</p>
					</div>
					<div class="textArea en">
						<h3>架設網站前一定要問清楚的事項！</h3>
						<p>1.黑心公司以數萬元的設計名目出售成本不到一千元的套版軟體</p>
						<p>2.黑心公司通常不提供PHP原始碼，導致其它設計師無法補救與修改</p>
						<p>3.黑心公司鎖住FTP、MySQL帳號不讓使用者使用，網站無法搬移</p>
					</div>
				</div>
			</div>
		</div>
		<div class="wrapGraphic">
			<div class="wrapContent">
				<h4>Customized</h4>
				<h2>真正為企業客製化的網站</h2>
				<h3>TRULY CUSTOMIZED FOR THE ENTERPRISE</h3>
				<div class="leftContent">
					<div class="textArea">
						<p>依客戶預算及需求做客製化設計</p>
						<p>由心出發的UI/UX設計</p>
						<p>堅持7:2:1的黃金比例設計原則</p>
						<p>以使用者體驗為最主要的設計重點</p>
					</div>
					<div class="textArea en">
						<p>According to customer demand guest system design</p>
						<p>Starting from the heart of UI / UX Design</p>
						<p>Adhere 7: design principles golden ratio 1: 2</p>
						<p>To the user experience as the most important design focus</p>
					</div>
				</div>
			</div>
		</div>
		<div class="wrapProgram">
			<div class="wrapContent">
				<h4>Service</h4>
				<h2>為企業提供完整的服務</h2>
				<h3>IN THE CENTER OF THE SYSTEM DEVELOPMENT LIFE</h3>
				<div class="leftContent">
					<div class="textArea">
						<p>您知道嗎？全世界有78%的網站都是賠錢貨！因為設計不良的網站不只無法帶動業績提升，還會造成揮之不去的負面形象！</p>
						<p>想要透過網路贏得消費者的青睞，除了<span class="orange">高質感的網站</span>，還需要專業的<span class="red">網路行銷</span>作推廣，我們提供一條龍式的服務，舉凡網頁設計、LOGO設計、產品包裝設計、海報設計、程式設計、手機程式設計、伺服器租賃、網路行銷皆可無縫接軌，幫助企業獲得成功的品牌形象。</p>
					</div>
				</div>
			</div>
		</div>
		<div class="wrapPersist">
			<div class="wrapContent">
					<div class="persistText">
						<h2>設計堅持 Persist</h2>
						<p>我們深信只有為客戶提供最好的品質，才是企業永續經營的關鍵</p>
						<p>因此不顧設計成本，堅持使用一流的美術、程式設計師</p>
						<p>以最高的技術水準，為客戶打造最高品質的一流品牌</p>
					</div>
					<div class="stage">
						<h2>服務項目 Service</h2>
						<div class="floatleft one">
							<div class="picBicycle">
								<div class="pic"><img src="app/img/service1.png"></div>
								<div class="text">
									<h3>Design</h3>
									<p>graphic design</p>
									<p>CIS design</p>
								</div>
							</div>
							<div class="content">
								<h3 class="red">美術設計</h3>
								<p>平面設計、名片設計</p>
								<p>LOGO設計、CIS企業識別</p>
								<p>DM、大型海報輸出</p>
							</div>
						</div>
						<div class="floatleft two">
							<div class="picBicycle">
								<div class="pic"><img src="app/img/service2.png"></div>
								<div class="text">
									<h3>Program</h3>
									<p>website app</p>
									<p>Server</p>
								</div>
							</div>
							<div class="content">
								<h3 class="orange">程式開發</h3>
								<p>網頁設計、購物商城、系統開發</p>
								<p>android、iOS app</p>
								<p>虛擬主機、實體伺服器租賃</p>
							</div>
						</div>
						<div class="floatleft three">
							<div class="picBicycle">
								<div class="pic"><img src="app/img/service3.png"></div>
								<div class="text">
									<h3>Marketing</h3>
									<p>Google Adwords</p>
									<p>facebook</p>
								</div>
							</div>
							<div class="content">
								<h3 class="blue">網路行銷</h3>
								<p>市場行銷、網路活動</p>
								<p>Google Adwords關鍵字廣告</p>
								<p>facebook粉絲團</p>
							</div>
						</div>
					</div>
			</div>
		</div>
		<div class="wrapService">
			<div class="wrapContent">
					<div class="picture one">
						<img src="app/img/customPic1.jpg">
					</div>
					<div class="picture two">
						<img src="app/img/customPic2.jpg">
					</div>
					<div class="picture three">
						<img src="app/img/customPic3.jpg">
					</div>
					<div class="picture four">
						<img src="app/img/customPic4.jpg">
					</div>
					<div class="pen"></div>
					<div class="whiteBg">
						<h2>客製專案 Project</h2>
						<div class="textPic">
							<div class="floatBox">
								<div class="textTop">
									<div class="text">
										<h4 class="red">Graphic</h4>
										<p>平面設計</p>
									</div>
									<div class="pic"></div>
								</div>
								<div class="textBottom">
									<div class="pic"></div>
									<div class="text">
										<h4 class="red">Graphic</h4>
										<p>平面設計</p>
									</div>
								</div>
								<div class="picTop">
									<img src="app/img/OnyxTree S.png">
								</div>
								<div class="textBackground">
									<p>由美術設計師和繪圖師聯手打造的設計，質感超脫非一般美工可比擬</p>
								</div>
							</div>
							<div class="floatBox">
								<div class="textTop">
									<div class="text">
										<h4 class="blue">LOGO</h4>
										<p>企業形象</p>
									</div>
									<div class="pic"></div>
								</div>
								<div class="textBottom">
									<div class="pic"></div>
									<div class="text">
										<h4 class="blue">LOGO</h4>
										<p>企業形象</p>
									</div>
								</div>
								<div class="picTop">
									<img src="app/img/Pdf S.png">
								</div>
								<div class="textBackground">
									<p>包含LOGO、VI、CIS，以創意和豐富的經驗，為企業設計一流形象</p>
								</div>
							</div>
							<div class="floatBox">
								<div class="textTop">
									<div class="text">
										<h4 class="yellow">Website</h4>
										<p>網頁設計</p>
									</div>
									<div class="pic"></div>
								</div>
								<div class="textBottom">
									<div class="pic"></div>
									<div class="text">
										<h4 class="yellow">Website</h4>
										<p>網頁設計</p>
									</div>
								</div>
								<div class="picTop">
									<img src="app/img/Audacity S.png">
								</div>
								<div class="textBackground">
									<p>風格獨特的形象網站、客製化的購物網站、大型系統開發</p>
								</div>
							</div>
							<div class="floatBox">
								<div class="textTop">
									<div class="text">
										<h4 class="purple">Phone App</h4>
										<p>手機程式</p>
									</div>
									<div class="pic"></div>
								</div>
								<div class="textBottom">
									<div class="pic"></div>
									<div class="text">
										<h4 class="purple">Phone App</h4>
										<p>手機程式</p>
									</div>
								</div>
								<div class="picTop">
									<img src="app/img/Msn S.png">
								</div>
								<div class="textBackground">
									<p>手機Native App、Web App、RWD響應式網站、手機版網頁設計</p>
								</div>
							</div>
							<div class="floatBox">
								<div class="textTop">
									<div class="text">
										<h4 class="green">Server</h4>
										<p>伺服器租賃</p>
									</div>
									<div class="pic"></div>
								</div>
								<div class="textBottom">
									<div class="pic"></div>
									<div class="text">
										<h4 class="green">Server</h4>
										<p>伺服器租賃</p>
									</div>
								</div>
								<div class="picTop">
									<img src="app/img/Nokia S.png">
								</div>
								<div class="textBackground">
									<p>性價比最高的虛擬主機、VPS主機、實體主機皆是我們的服務範圍</p>
								</div>
							</div>
							<div class="floatBox">
								<div class="textTop">
									<div class="text">
										<h4 class="orange">Marketing</h4>
										<p>網路行銷</p>
									</div>
									<div class="pic"></div>
								</div>
								<div class="textBottom">
									<div class="pic"></div>
									<div class="text">
										<h4 class="orange">Marketing</h4>
										<p>網路行銷</p>
									</div>
								</div>
								<div class="picTop">
									<img src="app/img/AVS Vid Tools S.png">
								</div>
								<div class="textBackground">
									<p>最優秀的Google Adwords關鍵字廣告、facebook粉絲行銷</p>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
		<div class="wrapDesign">
			<div class="wrapContent">
				<h2>DESIGN STYLE</h2>
				<h3>設計理念</h3>
				<div class="text">
					<p>Exist in urban design elements</p>
					<p>The spirit of the designer referenced index</p>
					<p>Until we wake them in the design</p>
				</div>
			</div>
		</div>
		<div class="wrapBrand">
			<div class="wrapContent">
				<h2>BRAND</h2>
				 <h3>成功案例</h3>
                 <div class="logoArea">
                  	
                    <div class="box">
                      <img src="app/img/logo/cite.jpg" class="img">
					  <p>Cite 城邦文化集團</p>
                    </div>
					<div class="box">
                        <img src="app/img/logo/candace.jpg" class="img">
					    <p>Candace 百貨名品服飾</p>
                    </div>
                    <div class="box">
                    	<img src="app/img/logo/pro.jpg" class="img">
						 <p>GoPro 行動攝影器材</p>
                    </div>
                    <div class="box">
                    	<img src="app/img/logo/ipix.jpg" class="img">
						 <p>iPix鏡花園 - 攝影第一品牌</p>
                    </div>
                    <div class="box">
                    	<img src="app/img/logo/wantwant.jpg" class="img">
						<p>旺旺集團</p>
                    </div>
                    <div class="box">
                    	<img src="app/img/logo/poney.jpg" class="img">
						 <p>Peony 百貨公司專櫃名品</p>
                    </div>
					<div class="box">
                    	<img src="app/img/logo/lavie.jpg" class="img">
						 <p>LaVie 設計雜誌</p>
                    </div>
                    <div class="box">
                    	<img src="app/img/logo/evp.jpg" class="img">
                        <p>EVP C-On 美商新能動力集團</p>
                    </div>
					
					<div class="box">
						<img src="app/img/logo/beauty.jpg" class="img">
						<p>Beauty 網路女性服飾</p>
					</div>
					<div class="box">
						<img src="app/img/logo/car.jpg" class="img">
						<p>Kantocars 關東車材</p>
                    </div>
                    
					<div class="box">
                    	<img src="app/img/logo/fish.jpg" class="img">
						 <p>極鮮日式料理</p>
                    </div>
					 <div class="box">
                    	<img src="app/img/logo/cheng.jpg" class="img">
						 <p>成浩設計 - 頂級室內設計</p>
                    </div>
				</div>
				<p>想了解更多成功的合作案例，請與業務代表聯繫...</p>
			</div>
		</div>
		<div class="wrapMenu">
			
		
		</div>
		
		<div class="wrapMenuFixed">
			
			<div class="pic1">
				
					<img src="app/img/about_pic1.png" width="180" data-hrefto="index.php?app=page&ac=news">
				 <div class="light"></div>	
				
				<h1>最新資訊</h1>
				<p class="title">NEWS</p>
				<hr>
				<p>最新、最夯的熱門話題</p>
			</div>
			
			<div class="pic2">
			    <h1>作品集</h1>
				<p class="title">PORTFOLIO</p>
				<hr>
				<p>最完美的作品呈獻</p>
				<img src="app/img/about_pic3.png"  width="180" data-hrefto="index.php?app=page&ac=portfolio">
				 <div class="light"  style="position:absolute; left:13px; top:275px;"></div>	
					<img src="app/img/tod.png" class="tod" width="120">
			        <img src="app/img/tod.png" class="tod2" width="120">
			</div>
			<div class="pic3">
				<img src="app/img/about_pic2.png"  width="180" data-hrefto="index.php?app=page&ac=contact">
				 <div class="light"></div>	
				
				<h1>聯絡我們</h1>
				<p class="title">CONTACT</p>
				<hr>
				<p>歡迎與我們聯絡、洽詢</p>
			</div>
			
			<div class="borderRight"></div>
			<div class="borderTop"></div>
			<div class="borderBottom"></div>
		</div>
	</div>
<?=$temp['footer']?>