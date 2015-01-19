<!--{eval $_TPL['nosidebar']=1;}-->
<?=$temp['header_up']?>
<?=$temp['header_down']?>
<div class="showmessage">
	<h2>訊息提示</h2>
	<p>$message</p>
	<p class="op">
	<!--{if $url_forward == -1}-->
	    系統正在為您關閉視窗
	<!--{elseif isset($url_forward) and $url_forward != -1}-->
		<a href="$url_forward">系統正在為您自動翻頁</a>
	<!--{else}-->
		<a href="javascript:history.go(-1);">回上一頁</a> | 
		<a href="index.php">回到首頁</a>
	<!--{/if}-->
	</p>
</div>
<?=$temp['footer']?>
