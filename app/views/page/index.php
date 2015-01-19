<?=$temp['header_up']?>
<script src="app/js/cycle2.js"></script>
<script>
$(document).ready(function(){
    $(".pageBox1 .pageBox1Slide").cycle({
        slides  :   '> .pageBoxView',
        fx      :   "fade",
        speed   :   500,
        timeout :   4000,
        next    :   ".nextPage",
        prev    :   ".backPage"
    });
});
</script>
<?=$temp['header_down']?>
<div class="indexPageBox1">
	<div class="pageBox1 hover">
		<div class="nextPage"></div>
		<div class="backPage"></div>
        <div class="pageBox1Slide">
            <?if(!empty($ad_list)):?>
            <?foreach($ad_list as $key => $value):?>
            <div class="pageBoxView" data-hrefto="<?=$value['href']?>">
                <div class="bg" style="background-image:url(<?=$value['piclist_array'][0]['path']['w0h0']?>);"></div>
                <div class="textBox">
                    <h2><?=$value['title']?></h2>
                    <?=$value['content']?>
                    <div class="clickme">Click me</div>
                </div>
            </div>
            <?endforeach?>
            <?endif?>
		</div>
	</div>
</div>
<div class="indexPageBox2">
	<div class="pageBox2" data-hrefto="page/story">
		<div class="bg"></div>
		<div class="pic"><img src="app/img/indexBgTextStory.png"></div>
	</div>
	<div class="pageBox3" data-hrefto="page/showroom">
		<div class="bg" style="background-image: url(<?if(empty($setting_list_array['index_showroom_image'])==FALSE):?><?=$setting_list_array['index_showroom_image']?><?endif?>);"></div>
		<div class="textBox">
			<img src="app/img/indexProductLogo.png">
			<h2>Showroom</h2>
			<p>
			<?if(empty($setting_list_array['index_showroom_content'])==FALSE):?><?=$setting_list_array['index_showroom_content']?><?endif?>
            </p>
		</div>
	</div>
</div>
<div class="indexPageBox3">
	<div class="pageBox4 hover" data-hrefto="activity">
		<div class="bg" style="background-image: url(<?if(empty($setting_list_array['index_activity_image'])==FALSE):?><?=$setting_list_array['index_activity_image']?><?endif?>);"></div>
		<div class="textBox">
			<h2>Activity</h2>
            <p>
			<?if(empty($setting_list_array['index_activity_content'])==FALSE):?><?=$setting_list_array['index_activity_content']?><?endif?>
            </p>
		</div>
	</div>
	<div class="pageBox5" data-hrefto="note">
		<div class="bg" style="background-image: url(<?if(empty($setting_list_array['index_news_image'])==FALSE):?><?=$setting_list_array['index_news_image']?><?endif?>);"></div>
		<div class="textBox">
			<h2>News</h2>
            <p>
			<?if(empty($setting_list_array['index_news_content'])==FALSE):?><?=$setting_list_array['index_news_content']?><?endif?>
            </p>
		</div>
	</div>
	<div class="pageBox6" data-hrefto="page/brand">
		<div class="bg" style="background-image: url(<?if(empty($setting_list_array['index_brand_image'])==FALSE):?><?=$setting_list_array['index_brand_image']?><?endif?>);"></div>
		<div class="textBox">
			<h2>Brand</h2>
			<?if(empty($setting_list_array['index_brand_content'])==FALSE):?><?=$setting_list_array['index_brand_content']?><?endif?>
		</div>
	</div>
</div>
<?=$temp['footer']?>