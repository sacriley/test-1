<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>廣告管理 - 廣告列表</h2>
<div class="contentBox allWidth">
	<h3>廣告列表</h3>
	<h4>請填寫欲新增或更改之廣告</h4>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
			<a href="admin/ad/postad" class="button">新增廣告</a>
        </div>
        <div class="spanLineRight width300">
            <input type="text" class="floatright text" id="search" name="search" placeholder="請輸入想要搜尋的廣告名稱" style="display:none;">
        </div>
	</div>
	<div class="spanLine tableTitle">
        <div class="spanLineLeft text width100">
			廣告ID
        </div>
        <div class="spanLineLeft text width500">
			廣告名稱
        </div>
	</div>
    <?foreach($ad_list as $key => $value):?>
    <div class="spanLine">
        <div class="spanLineLeft text width100">
            <?=$value['adid']?>
        </div>
        <div class="spanLineLeft text width500">
            <a href="admin/ad/postad/edit/<?=$value['adid']?>"><?=$value['title']?></a>
        </div>
        <div class="spanLineLeft width300 hoverHidden">
            <a href="admin/ad/postad/edit/<?=$value['adid']?>">編輯</a> | 
            <span class="ahref" onClick="fanScript.check_href_action('確定要刪除這篇文章？', 'admin/ad/delete_ad/<?=$value['adid']?>/<?=$this->security->get_csrf_hash()?>');">刪除</span>
        </div>
	</div>
    <?endforeach?>
</div>
<?=$temp['admin_footer']?>