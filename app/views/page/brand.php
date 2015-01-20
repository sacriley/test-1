<?=$temp['header_up']?>test
<script>
$(function(){
	$(document).on('click', '.brandListBg, .brandListBg2', function(){
		if($('.brandView').hasClass('hover') == true){
			$('.brandView').removeClass('hover');
			$("html,body").animate({scrollTop: 0}, 1200, 'swing');
		}
	});
	$(document).on('click', '.brandDiv', function(){
		if($('.brandView').hasClass('hover') !== true){
			var brandid = $(this).data('brandid');
			$(".brandViewContent").css('display', 'none');
			$(".brandViewContent[data-brandid=" + brandid + "]").css('display', 'block');
			setTimeout(function(){
				$('.brandView').addClass('hover');
				$("html,body").animate({scrollTop: 300}, 1200, 'swing');
			},100);
		}
	});
});
</script>
<?=$temp['header_down']?>
<div class="brandNav">
	<select>
		<option>全部風格</option>
		<!--{loop $brandtype_list $key $value}-->
		<option>$value[classname]</option>
		<!--{/loop}-->
	</select>
</div>
<div class="brandListBg">
	<div class="brandList">
		<!--{loop $brand_list1 $key $value}-->
		<div class="brandDiv" data-brandid="$value[brandid]">
			<img src="$value[src]">
			<div class="text">$value[title]</div>
		</div>
		<!--{/loop}-->
		<!--{loop $brand_list1 $key $value}-->
		<div class="brandDiv" data-brandid="$value[brandid]">
			<img src="$value[src]">
			<div class="text">$value[title]</div>
		</div>
		<!--{/loop}-->
	</div>
</div>
<div class="brandView">
	<!--{loop $brand_list1 $key $value}-->
	<div class="brandViewContent" data-brandid="$value[brandid]" style="display:none;">
		<div class="brandText">
			<div class="pic">
				<img src="$value[src]">
			</div>
			<div class="text">
				<h2>$value[title]</h2>
				<div class="text">$value[text]</div>
				<!--{if $value[pic1]}-->
				<div class="button picture">Picture</div>
				<!--{/if}-->
				<!--{if $value[href]}-->
				<a class="button" href="$value[href]" target="_blank">Website</a>
				<!--{/if}-->
			</div>
		</div>
		<div class="brandPicture">
			<div class="pictureBar">
				<div class="nextButton" fanScript-slideshowRight="fanscriptSlide"></div>
				<div class="backButton" fanScript-slideshowLeft="fanscriptSlide"></div>
				<div class="picList">
					<!--{if $value[pic1]}-->
					<div class="pic" fanScript-slideshowPic="fanscriptSlide" fanScript-slideshowPage="0"fanScript-slideshowEvent="click">
						<img src="$value[pic1]">
					</div>
					<!--{/if}-->
					<!--{if $value[pic2]}-->
					<div class="pic" fanScript-slideshowPic="fanscriptSlide">
						<img src="$value[pic2]">
					</div>
					<!--{/if}-->
					<!--{if $value[pic3]}-->
					<div class="pic" fanScript-slideshowPic="fanscriptSlide">
						<img src="$value[pic3]">
					</div>
					<!--{/if}-->
				</div>
				<div class="picListNav" style="display:none;">
					<!--{if $value[pic1]}-->
					<div class="pic" fanScript-slideshowNav="fanscriptSlide" fanScript-slideshowPage="0"fanScript-slideshowEvent="click">
					</div>
					<!--{/if}-->
					<!--{if $value[pic2]}-->
					<div class="pic" fanScript-slideshowNav="fanscriptSlide">
					</div>
					<!--{/if}-->
					<!--{if $value[pic3]}-->
					<div class="pic" fanScript-slideshowNav="fanscriptSlide">
					</div>
					<!--{/if}-->
				</div>
			</div>
			<div class="returnButton">Return</div>
			<h2>French Heritage</h2>
		</div>
	</div>
	<!--{/loop}-->
	<!--{loop $brand_list2 $key $value}-->
	<div class="brandViewContent" data-brandid="$value[brandid]" style="display:none;">
		<div class="brandText">
			<div class="pic">
				<img src="$value[src]">
			</div>
			<div class="text">
				<h2>$value[title]</h2>
				<div class="text">$value[text]</div>
				<div class="button picture">Picture</div>
				<a class="button" href="$value[href]" target="_blank">Website</a>
			</div>
		</div>
		<div class="brandPicture">
			<div class="pictureBar">
				<div class="nextButton" fanScript-slideshowRight="fanscriptSlide"></div>
				<div class="backButton" fanScript-slideshowLeft="fanscriptSlide"></div>
				<div class="picList">
					<!--{if $value[pic1]}-->
					<div class="pic" fanScript-slideshowPic="fanscriptSlide" fanScript-slideshowPage="0"fanScript-slideshowEvent="click">
						<img src="$value[pic1]">
					</div>
					<!--{/if}-->
					<!--{if $value[pic2]}-->
					<div class="pic" fanScript-slideshowPic="fanscriptSlide">
						<img src="$value[pic2]">
					</div>
					<!--{/if}-->
					<!--{if $value[pic3]}-->
					<div class="pic" fanScript-slideshowPic="fanscriptSlide">
						<img src="$value[pic3]">
					</div>
					<!--{/if}-->
				</div>
				<div class="picListNav" style="display:none;">
					<!--{if $value[pic1]}-->
					<div class="pic" fanScript-slideshowNav="fanscriptSlide" fanScript-slideshowPage="0"fanScript-slideshowEvent="click">
					</div>
					<!--{/if}-->
					<!--{if $value[pic2]}-->
					<div class="pic" fanScript-slideshowNav="fanscriptSlide">
					</div>
					<!--{/if}-->
					<!--{if $value[pic3]}-->
					<div class="pic" fanScript-slideshowNav="fanscriptSlide">
					</div>
					<!--{/if}-->
				</div>
			</div>
			<div class="returnButton">Return</div>
			<h2>French Heritage</h2>
		</div>
	</div>
	<!--{/loop}-->
</div>
<div class="brandListBg2">
	<div class="brandList2">
		<!--{loop $brand_list1 $key $value}-->
		<div class="brandDiv" data-brandid="$value[brandid]">
			<img src="$value[src]">
			<div class="text">$value[title]</div>
		</div>
		<!--{/loop}-->
		<!--{loop $brand_list1 $key $value}-->
		<div class="brandDiv" data-brandid="$value[brandid]">
			<img src="$value[src]">
			<div class="text">$value[title]</div>
		</div>
		<!--{/loop}-->
	</div>
	<div class="multi">$multi</div>
</div>
<?=$temp['footer']?>