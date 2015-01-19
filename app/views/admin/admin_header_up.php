<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8">
	<title><?=$global['website_title_name']?> - <?=$global['website_title_introduction']?></title>
	<meta name="keywords" content="網頁設計、fansWoo design,網頁設計,網站設計,網頁設計公司,台北網頁設計,瘋沃網頁設計">
	<meta name="keywords" content="中小型企業形象網站網頁設計瘋沃科技網頁設計公司提供最優質的網頁設計、網站架設、多媒體網頁設計等多項服務. 我們的客戶來自於各行各業，以最全面性的服務來滿足您對於網頁設計的需求。">
	<base href="<?=base_url()?>" />
	<script src="app/js/jquery-1.7.1.min.js"></script>
	<script src="app/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script src="app/js/fanScript-1.3.0.js"></script>
	<script src="app/js/script_common.js"></script>
    <?if(empty($global['script']) == FALSE):?>
    <?=$global['script']?>
    <?endif?>
	<?if(isset($global['js'])):?>
	<?foreach($global['js'] as $value):?>
	<script src="app/js/<?=$value?>.js"></script>
	<?endforeach?>
	<?endif?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-52790599-3', 'auto');
	  ga('send', 'pageview');
	</script>
	<link rel="shortcut icon" href="app/img/favicon.ico">