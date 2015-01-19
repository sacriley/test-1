<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>品牌管理 - 基本設置</h2>
<div class="contentBox allWidth">
	<h3>品牌顯示設置</h3>
	<h4>請填寫前台文章顯示設置，此設置之設置將影響網站前台之顯示</h4>
	<?php echo form_open('admin/note/set/post') ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                品牌排序方式
            </div>
            <div class="spanLineLeft">
                <select name="note_order">
                    <option value="date"<?if($setting_list_array['note_order'] == 'date'):?> selected<?endif?>>依照最新發表日期</option>
                    <option value="priority"<?if($setting_list_array['note_order'] == 'priority'):?> selected<?endif?>>依照優先排序指數</option>
                </select>
            </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">本設置為前台品牌排序之方式設定</p>
            </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                品牌顯示數量
            </div>
            <div class="spanLineLeft width100">
			    <input type="number" class="text width100" min="1" max="30" name="note_amount" value="<?if($setting_list_array['note_amount']):?><?=$setting_list_array['note_amount']?><?endif?>">
            </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
		    	<p class="gray">本設置為前台品牌每頁顯示之數量</p>
            </div>
		</div>
	</div>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
		        <input type="submit" class="submit" value="儲存變更">
            </div>
		</div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>