<?php

function bbcode_convert($string)
{
    // 移除 HTML tags
    $string = htmlentities($string, ENT_QUOTES);
 
    $bbcode_search = array(
                '/[b](.*?)[/b]/is',
                '/[i](.*?)[/i]/is',
                '/[u](.*?)[/u]/is',
                '/[url=(.*?)](.*?)[/url]/is',
                '/[url](.*?)[/url]/is',
                '/[img](.*?)[/img]/is'
                );
 
    $bbcode_replace = array(
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<u>$1</u>',
                '<a href="$1">$2</a>',
                '<a href="$1">$1</a>',
                '<img src="$1" />'
                );
 
    return preg_replace($bbcode_search, $bbcode_replace, $string);
}

function js_console_log($data)
{
    if(is_array($data) == TRUE || is_object($data) == TRUE)
	{
		return "<script>console.log({'js_console_log': ".json_encode($data)."});</script>";
	}
    else
    {
		return "<script>console.log({'js_console_log': ".$data."});</script>";
	}
}

//文字切換
function html_code_replace($_array = array('text' => '', 'nl2br' => FALSE, 'meta_all' => FALSE, 'meta_img' => FALSE, 'meta_b' => FALSE, 'metaRed' => FALSE, 'meta_url' => FALSE, 'length' => 0, 'dot' => ' ...'))
{
	$text = $_array['text'];
	$meta_all = isset($_array['meta_all']) && $_array['meta_all'] === TRUE ? TRUE : FALSE;
	$meta_img = isset($_array['meta_img']) && $_array['meta_img'] === TRUE ? TRUE : FALSE;
	$meta_url = isset($_array['meta_url']) && $_array['meta_url'] === TRUE ? TRUE : FALSE;
	$meta_b = isset($_array['meta_b']) && $_array['meta_b'] === TRUE ? TRUE : FALSE;
	$meta_red = isset($_array['meta_red']) && $_array['meta_red'] === TRUE ? TRUE : FALSE;
	$nl2br = isset($_array['nl2br']) && $_array['nl2br'] === TRUE ? TRUE : FALSE;
	$length = isset($_array['length']) ? $_array['length'] : 0;
	$dot = isset($_array['dot']) ? $_array['dot'] : ' ...';

	if($nl2br == TRUE){
		$text = nl2br($text);
	}
	if($meta_img === TRUE || $meta_all === TRUE){
		$text = preg_replace("/\[(img)\](.+?)\[\/\\1\]/si", '<img src="\\2" \\>', $text);
	}
	if($meta_url == true || $meta_all == true){
		$text = preg_replace("/\[(url)\](.+?)\[\/\\1\]/si", '<a href="\\2" target="_blank" \\>\\2</a>', $text);
	}
	if($meta_b == true || $meta_all == true){
		$text = preg_replace('#\[b\](.*?)\[/b\]#si', '<b>\1</b>', $text);
	}
	if($meta_red == true || $meta_all == true){
		$text = preg_replace('#\[red\](.*?)\[/red\]#si', '<span style="color:red;">\1</span>', $text);
	}
	if($length) {
		$text = cutstr($text, $length, $dot);
	}
	$text = trim($text);
	return $text;
}

function print_pre($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

?>