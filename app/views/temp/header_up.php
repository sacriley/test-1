<!DOCTYPE html>
<html lang="zh-tw" class="<?=$global['browser_agent']['browser']?><?if(isset($global['browser_agent']['browser_ie'])){echo ' '.$global['browser_agent']['browser_ie'];}?>">
<head>
	<meta charset="utf-8">
	<title><?=$global['website_title_name']?> - <?=$global['website_title_introduction']?></title>
	<?if(isset($global['website_metatag_array'])):?>
	<?foreach($global['website_metatag_array'] as $value):?>
	<meta name="keywords" content="<?=$value?>">
	<?endforeach?>
	<?endif?>
	<base href="<?=prep_url($_SERVER['HTTP_HOST'].base_url())?>" />
	<script src="app/js/jquery-1.7.1.min.js"></script>
	<script src="app/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script src="app/js/fanScript-1.3.0.js"></script>
	<script src="app/js/script_common.js"></script>
    <?if(empty($global['script_meta']) == FALSE):?>
    <?=$global['script_meta']?>
    <?endif?>
	<?if(isset($global['js'])):?>
	<?foreach($global['js'] as $value):?>
	<script src="app/js/<?=$value?>.js"></script>
	<?endforeach?>
	<?endif?>
	<?if(isset($global['website_script_plugin_ga'])):?><?=$global['website_script_plugin_ga']?><?endif?>
	<?if(isset($global['website_script_plugin_fb'])):?><?=$global['website_script_plugin_fb']?><?endif?>
	<?if(isset($global['website_script_plugin_custom'])):?><?=$global['website_script_plugin_custom']?><?endif?>
	<link rel="shortcut icon" href="app/img/favicon.ico"></link>