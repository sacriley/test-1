<?=$temp['header_up']?>
<script>
$(function(){
});
</script>
<?=$temp['header_down']?>
<div class="bodyBg" style="background-image: url(app/img/bg9.jpg);"></div>
<div class="newsNavFixed">
	<h2 data-hrefto="note" class="hover">最新消息 News</h2>
	<h2 data-hrefto="activity">活動訊息 Activity</h2>
</div>
<div class="pageContentNews">
	<div class="pageContentBg">
		<div class="pageContent">
			<div class="pageContentWhite">
				<h2>最新消息 News</h2>
				<?foreach($note_list_array as $key => $value):?>
				<div data-hrefto="note/view/<?=$value['noteid']?>" class="blogLi"><?=$value['title']?></div>
				<?endforeach?>
                <div class="pageLink"><?=$note_links?></div>
			</div>
		</div>
	</div>
</div>
<?=$temp['footer']?>