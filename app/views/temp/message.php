<?=$temp['header_up']?>
<script>
	setTimeout(function(){
		location.href = '<?=base_url()?><?=$url?>';
	}, <?=$second?> * 1000);
</script>
<?=$temp['header_down']?>
<div class="gMessageBox">
	<h2>系統訊息</h2>
	<p><?=$message?></p>
	<p>將在 <?=$second?> 秒後進行下一步...</p>
</div>
<?=$temp['footer']?>