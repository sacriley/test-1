<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>文章管理 - <?if(isset($class['classid'])):?>編輯<?else:?>新增<?endif?>分類標籤</h2>
<div class="contentBox allWidth">
	<h3><?if(isset($class['classid'])):?>編輯<?else:?>新增<?endif?>分類標籤</h3>
	<h4>請填寫欲文章標籤資訊</h4>
	<?php echo form_open('admin/note/postclass/post') ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                標籤名稱
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" name="classname" placeholder="標籤名稱" value="<?if(isset($class['classname'])):?><?=$class['classname']?><?endif?>">
            </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">請輸入分類標籤的名稱，此標籤名稱可供文章作分類</p>
            </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                標籤代號
            </div>
            <div class="spanLineLeft width100">
                <input type="text" class="text" name="slug" placeholder="標籤代號" value="<?if(isset($class['slug'])):?><?=$class['slug']?><?endif?>">
            </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">請輸入分類標籤的代號，此標籤代號為網址的英文簡寫</p>
            </div>
		</div>
	</div>
	<div class="spanLine spanSubmit">
		<div class="spanLineLeft">
		</div>
		<div class="spanLineRight">
            <?if(isset($class['classid'])):?><input type="hidden" name="classid" value="<?=$class['classid']?>"><?endif?>
		    <input type="submit" class="submit" value="<?if(isset($class['classid'])):?>儲存變更<?else:?>新增標籤<?endif?>">
            <?if( empty($class['classid']) === FALSE ):?><span class="submit gray" onClick="fanScript.check_href_action('確定要刪除這個分類？', 'admin/note/delete_class/<?=$class['classid']?>/<?=$this->security->get_csrf_hash()?>');">刪除分類</span><?endif?>
		</div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>