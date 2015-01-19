<?=$temp['header_up']?>

<script>
$(function(){
	$(".pageContentStory").height($(window).height());
	$(window).resize(function(){
		$(".pageContentStory").height($(window).height());
	});
	$(".pageContentStory").scroll(function(){
		if($(".pageContentStory").scrollTop() <= 700){
			console.log($(".pageContentStory").scrollTop());
			var position = (50 + ((parseInt($(".pageContentStory").scrollTop()) - 0) / 10));
			$('.pageContentStory .pageContent1 .pageContent').css('background-position-y', position + '%');
		}
		else if($(".pageContentStory").scrollTop() <= 1700 && $(".pageContentStory").scrollTop() > 700){
			var position = ((parseInt($(".pageContentStory").scrollTop()) - 1000) / 10);
			$('.pageContentStory .pageContent2 .pageContent').css('background-position-y', position);
		}
		else if($(".pageContentStory").scrollTop() <= 2700 && $(".pageContentStory").scrollTop() > 1700){
			var position = ((parseInt($(".pageContentStory").scrollTop()) - 2000) / 10);
			$('.pageContentStory .pageContent3 .pageContent').css('background-position-y', position + '%');
		}
		else if($(".pageContentStory").scrollTop() > 2700){
			var position = ((parseInt($(".pageContentStory").scrollTop()) - 3000) / 10);
			$('.pageContentStory .pageContent4 .pageContent').css('background-position-y', position + '%');
		}
	});
	documentMoving = false;
	$(document).mousewheel(function(event, delta){
		if(delta > 0 && documentMoving == false){
			if($(".pageContentStory").scrollTop() <= 700){
				$(".pageContentStory").animate({scrollTop: 3000}, 1200, 'swing');
			}
			else if($(".pageContentStory").scrollTop() <= 1700 && $(".pageContentStory").scrollTop() > 700){
				$(".pageContentStory").animate({scrollTop: 0}, 1200, 'swing');
			}
			else if($(".pageContentStory").scrollTop() <= 2700 && $(".pageContentStory").scrollTop() > 1700){
				$(".pageContentStory").animate({scrollTop: 1000}, 1200, 'swing');
			}
			else if($(".pageContentStory").scrollTop() > 2700){
				$(".pageContentStory").animate({scrollTop: 2000}, 1200, 'swing');
			}
		}
		else if(delta < 0 && documentMoving == false){
			if($(".pageContentStory").scrollTop() <= 700){
				$(".pageContentStory").animate({scrollTop: 1000}, 1200, 'swing');
			}
			else if($(".pageContentStory").scrollTop() <= 1700 && $(".pageContentStory").scrollTop() > 700){
				$(".pageContentStory").animate({scrollTop: 2000}, 1200, 'swing');
			}
			else if($(".pageContentStory").scrollTop() <= 2700 && $(".pageContentStory").scrollTop() > 1700){
				$(".pageContentStory").animate({scrollTop: 3000}, 1200, 'swing');
			}
			else if($(".pageContentStory").scrollTop() > 2700){
				$(".pageContentStory").animate({scrollTop: 0}, 1200, 'swing');
			}
		}
		documentMoving = true;
		setTimeout(function(){
			documentMoving = false;
		}, 1200);
	});
});
</script>
<?=$temp['header_down']?>
<div class="pageContentStory">
	<div class="pageContent1">
		<div class="pageContent">
			<div class="title">
				<h2><?=$setting_list_array['page_story_title1']?></h2>
				<h3><?=$setting_list_array['page_story_text1']?></h3>
			</div>
			<?=$setting_list_array['page_story_content1']?>
		</div>
	</div>
	<div class="pageContent2">
		<div class="pageContent">
			<div class="title">
				<h2><?=$setting_list_array['page_story_title2']?></h2>
				<h3><?=$setting_list_array['page_story_text2']?></h3>
			</div>
			<?=$setting_list_array['page_story_content2']?>
		</div>
	</div>
	<div class="pageContent3">
		<div class="pageContent">
			<div class="title">
				<h2><?=$setting_list_array['page_story_title3']?></h2>
				<h3><?=$setting_list_array['page_story_text3']?></h3>
			</div>
			<?=$setting_list_array['page_story_content3']?>
		</div>
	</div>
	<div class="pageContent4">
		<div class="pageContent">
			<div class="title">
				<h2><?=$setting_list_array['page_story_title4']?></h2>
				<h3><?=$setting_list_array['page_story_text4']?></h3>
			</div>
			<?=$setting_list_array['page_story_content4']?>
		</div>
	</div>
</div>
<?=$temp['footer']?>