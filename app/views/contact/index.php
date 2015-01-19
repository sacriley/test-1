<?=$temp['header_up']?>
<!-- Facebook Conversion Code for 聯繫我們 -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6020797556140', {'value':'0.00','currency':'TWD'}]);
</script>
<noscript style="display:none;"><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6020797556140&amp;cd[value]=0.00&amp;cd[currency]=TWD&amp;noscript=1" /></noscript>
<script>
$(function(){
	
	//聯繫頁變更
	$(document).on('mouseenter', '.textContactForm', function(){
		$('.textContactForm').addClass('hover');
		$('.textContact').addClass('hidden');
	});
	$(document).on('click', '.textContactFormClose', function(){
		$('.textContactForm').removeClass('hover');
		$('.textContact').removeClass('hidden');
	});
	
	//聯繫頁預算欄位
	$(document).on('focus', '.textContactForm.hover .money', function(){
		$('.textContactFormMoneyFixed').addClass('hover');
	});
	$(document).on('blur', '.textContactForm.hover .money', function(){
		$('.textContactFormMoneyFixed').removeClass('hover');
	});
	$(document).on('change', '.textContactForm.hover .money', function(){
		$('.textContactForm.hover .money').blur();
	});
	
	//
	$(document).on('focus', '.textContactForm.hover .need, .textContactForm.hover .need_child, .textContactForm.hover .money', function(){
		$(this).find("option[value='']").remove();
	});
	
	$(document).on('focus', '.textContactForm.hover .need', function(){
		$('.textContactForm.hover .need').change();
	});
		
	$(document).on('change', '.textContactForm.hover .need', function(){
		var selected = $(this).val();
		$('.need_child').css('display', 'none');
		$('.need_child').addClass('displaynone');
		$('.need_child[data-selected=' + selected + ']').css('display', 'block');
		$('.need_child option').removeAttr('selected');
		$('.need_child[data-selected=' + selected + '] option:first').attr('selected', true);
	});
});
</script>
<?=$temp['header_down']?>
	<div class="pencil">fansWoo</div>
	<div class="plane">fansWoo</div>
	<div class="bg1">fansWoo</div>
	<div class="bg2">fansWoo</div>
<?=$temp['topheader']?>
	<div class="textContact">
		<div class="textContactContent">
			<h2>聯繫 <b>C</b>ontact</h2>
			<p style="margin-bottom:10px;"><b>立即聯繫我們，讓我們為客戶打造一流品牌形象</b></p>
			<div class="stage">
				<img class="pic" src="app/img/time.png">
				<p>早上 09:00 - 12:30</p>
				<p>下午 13:30 - 18:20</p>
			</div>
			<div class="stage">
				<img class="pic" src="app/img/tel.png">
				<p>業務部 (02)2816-4533 #333</p>
				<p>設計部 (02)2816-4533 #331</p>
				<p>傳真機 (02)2816-4538</p>
			</div>
			<div class="stage">
				<img class="pic" src="app/img/email.png">
				<p><a href="mailto:service@fanswoo.com">service@fanswoo.com</a></p>
				<p><a href="mailto:yi@fanswoo.com">yi@fanswoo.com</a></p>
			</div>
			<div class="stage">
				<img class="pic" src="app/img/add.png">
				 <p>台北市重慶北路四段 248 號 3 樓</p>
				 <p>3F., No.248, Sec. 4, Chongqing N. Rd., Shilin Dist., Taipei City 111, Taiwan (R.O.C.)</p>
			</div>
		</div>
	</div>
	<div class="textContactForm">
		<div class="textContactFormContent">
			<div class="textContactFormClose"></div>
			<?php echo form_open('contact/index') ?>
			<div class="rightBox">
				<?=validation_errors()?>
				<p>您的姓名：<input type="text" class="name" name="name" placeholder="請填寫您的姓名"></p>
				<p>公司名稱：<input type="text" class="company" name="company" placeholder="請填寫公司名稱"></p>
				<p>聯繫電話：<input type="text" class="telphone" name="telphone" placeholder="請填寫聯繫電話"></p>
				<p>電子郵件：<input type="text" class="email" name="email" placeholder="請填寫電子郵件"></p>
				<p>公司地址：<input type="text" class="address" name="address" placeholder="請填寫公司地址"></p>
				<textarea name="text"></textarea>
				<p>本公司設計案件較多，為盡早處理您的專案，請提前詢問及索取報價資訊。</p>
				<input type="submit" value="送出" class="contactSubmit" name="contactSubmit">
			</div>
			<div class="leftBox">
				<h2>線上諮詢 / 索取報價</h2>
				<div class="area">
					<span>詢問項目：</span>
					<select class="need" name="need">
						<option value="">請選擇詢問項目</option>
						<option value="網站開發">網站開發</option>
						<option value="程式系統開發">程式系統開發</option>
						<option value="美術設計">美術設計</option>
						<option value="網路行銷">網路行銷</option>
						<option value="伺服器租賃">伺服器租賃</option>
						<option value="其它問題">其它問題</option>
					</select>
				</div>
				<div class="area">
					<span>項目細節：</span>
					<select class="need_child" name="need_child">
						<option value="先選擇主要項目">先選擇主要項目</option>
					</select>
					<select class="need_child" name="need_child" data-selected="網站開發" style="display:none;">
						<option value="形象網站設計">形象網站設計</option>
						<option value="0元套版網站">0元套版網站</option>
						<option value="購物網站開發">購物網站開發</option>
						<option value="網路平台開發">網路平台開發</option>
					</select>
					<select class="need_child" name="need_child" data-selected="程式系統開發" style="display:none;">
						<option value="程式系統開發">程式系統開發</option>
						<option value="手機App開發">手機App開發</option>
					</select>
					<select class="need_child" name="need_child" data-selected="美術設計" style="display:none;">
						<option value="LOGO/CIS 設計">LOGO/CIS 設計</option>
						<option value="平面設計">平面設計</option>
						<option value="產品包裝設計">產品包裝設計</option>
					</select>
					<select class="need_child" name="need_child" data-selected="網路行銷" style="display:none;">
						<option value="facebook 粉絲團">facebook 粉絲團</option>
						<option value="Google Adwords">Google Adwords</option>
						<option value="網路行銷企劃">網路行銷企劃</option>
					</select>
					<select class="need_child" name="need_child" data-selected="伺服器租賃" style="display:none;">
						<option value="虛擬伺服器租賃">虛擬伺服器租賃</option>
						<option value="雲端主機租賃">雲端主機租賃</option>
						<option value="電子信箱主機租賃">電子信箱主機租賃</option>
						<option value="Google Apps設定">Google Apps設定</option>
					</select>
					<select class="need_child" name="need_child" data-selected="其它問題" style="display:none;">
						<option value="其它問題">其它問題</option>
					</select>
				</div>
				<div class="area">
					<div class="textContactFormMoneyFixed">
						預算欄位僅供參考，每個客製化專案皆可依客戶需求給予報價
					</div>
					<span>您的預算：</span>
					<select class="money" name="money">
						<option value="">請選擇預算</option>
						<option value="10萬元以下">10萬元以下</option>
						<option value="10萬元~20萬元">10萬元~20萬元</option>
						<option value="20萬元~30萬元">20萬元~30萬元</option>
						<option value="30萬元~50萬元">30萬元~50萬元</option>
						<option value="50萬元~100萬元">50萬元~100萬元</option>
						<option value="100萬元~200萬元">100萬元~200萬元</option>
						<option value="200萬元以上">200萬元以上</option>
					</select>
				</div>
			</div>
			</form>
		</div>
		<!-- Google Code for &#33287;&#25105;&#20497;&#32879;&#32097; Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1037100439;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "54GrCKiolVYQl8vD7gM";
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
		<noscript style="display:none;"><img style="display:none;" height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1037100439/?label=54GrCKiolVYQl8vD7gM&amp;guid=ON&amp;script=0"/></noscript>
	</div>
</div>
<?=$temp['footer']?>