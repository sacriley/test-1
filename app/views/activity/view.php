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
                <h3><?=$note_array['title']?></h3>
                <?=$note_array['content_html']?>
			</div>
		</div>
	</div>
</div>
<?=$temp['footer']?>