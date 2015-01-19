<?=$temp['header_up']?>
<script src="app/js/cycle2.js"></script>
<script>
$(function(){
    $(".picList").cycle({
        slides  :   '> .pic',
        fx      :   "fade",
        speed   :   500,
        paused  :   true,
        next    :   ".nextButton",
        prev    :   ".backButton"
    });
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
		<?foreach($class_list as $key => $value):?>
		<option value="<?=$value['classid']?>"><?=$value['classname']?></option>
		<?endforeach?>
	</select>
</div>
<div class="brandListBg">
	<div class="brandList">
		<?foreach($brand_list1 as $key => $value):?>
		<div class="brandDiv" data-brandid="<?=$value['brandid']?>">
			<img src="<?if(!empty($value['toppiclist_array'][0]['path']['w300h300'])):?><?=$value['toppiclist_array'][0]['path']['w300h300']?><?endif?>">
			<div class="text"><?=$value['title']?></div>
		</div>
		<?endforeach?>
		<?foreach($brand_list1 as $key => $value):?>
		<div class="brandDiv" data-brandid="<?=$value['brandid']?>">
			<img src="<?if(!empty($value['toppiclist_array'][0]['path']['w300h300'])):?><?=$value['toppiclist_array'][0]['path']['w300h300']?><?endif?>">
			<div class="text"><?=$value['title']?></div>
		</div>
		<?endforeach?>
	</div>
</div>
<div class="brandView">
    <?foreach($brand_list1 as $key => $value):?>
	<div class="brandViewContent" data-brandid="<?=$value['brandid']?>" style="display:none;">
		<div class="brandText">
			<div class="pic">
				<img src="<?=$value['toppiclist_array'][0]['path']['w0h0']?>">
			</div>
			<div class="text">
				<h2><?=$value['title']?></h2>
				<div class="text"><?=$value['content']?></div>
                <?if(!empty($value['piclist_array'][0]['path']['w0h0'])):?>
				<div class="button picture">Picture</div>
				<?endif?>
                <?if(!empty($value['href'])):?>
				<a class="button" href="$value['href']" target="_blank">Website</a>
				<?endif?>
			</div>
		</div>
		<div class="brandPicture">
			<div class="pictureBar">
				<div class="nextButton"></div>
				<div class="backButton"></div>
				<div class="picList">
                    <?foreach($value['piclist_array'] as $key2 => $value2):?>
					<div class="pic">
						<img src="<?=$value2['path']['w0h0']?>">
					</div>
                    <?endforeach?>
				</div>
			</div>
			<div class="returnButton">Return</div>
			<h2>French Heritage</h2>
		</div>
	</div>
    <?endforeach?>
    <?foreach($brand_list2 as $key => $value):?>
	<div class="brandViewContent" data-brandid="<?=$value['brandid']?>" style="display:none;">
		<div class="brandText">
			<div class="pic">
				<img src="<?=$value['toppiclist_array'][0]['path']['w0h0']?>">
			</div>
			<div class="text">
				<h2><?=$value['title']?></h2>
				<div class="text"><?=$value['content']?></div>
                <?if(!empty($value['piclist_array'][0]['path']['w0h0'])):?>
				<div class="button picture">Picture</div>
				<?endif?>
                <?if(!empty($value['href'])):?>
				<a class="button" href="$value['href']" target="_blank">Website</a>
				<?endif?>
			</div>
		</div>
		<div class="brandPicture">
			<div class="pictureBar">
				<div class="nextButton"></div>
				<div class="backButton"></div>
				<div class="picList">
                    <?foreach($value['piclist_array'] as $key2 => $value2):?>
					<div class="pic">
						<img src="<?=$value2['path']['w0h0']?>">
					</div>
                    <?endforeach?>
				</div>
			</div>
			<div class="returnButton">Return</div>
			<h2>French Heritage</h2>
		</div>
	</div>
    <?endforeach?>
</div>
<div class="brandListBg2">
	<div class="brandList2">
        <?foreach($brand_list2 as $key => $value):?>
		<div class="brandDiv" data-brandid="<?=$value['brandid']?>">
			<img src="<?if(!empty($value['toppiclist_array'][0]['path']['w300h300'])):?><?=$value['toppiclist_array'][0]['path']['w300h300']?><?endif?>">
			<div class="text"><?=$value['title']?></div>
		</div>
        <?endforeach?>
        <?foreach($brand_list2 as $key => $value):?>
		<div class="brandDiv" data-brandid="<?=$value['brandid']?>">
			<img src="<?if(!empty($value['toppiclist_array'][0]['path']['w300h300'])):?><?=$value['toppiclist_array'][0]['path']['w300h300']?><?endif?>">
			<div class="text"><?=$value['title']?></div>
		</div>
        <?endforeach?>
	</div>
	<div class="multi"></div>
</div>
<?=$temp['footer']?>