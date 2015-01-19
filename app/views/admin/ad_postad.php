<?=$temp['header_up']?>
<script>
$(function(){
//    $(document).on('change', '.fileMultiple', function(){
//        if($(".fileMultiple :file[value='']").size() == 0)
//        {
//            $(this).clone().val('').insertAfter('.fileMultiple:last');
//        }
//        else
//        {
//            $(this).remove();
//        }
//    });
    $(document).on('click', '[fanScript-picDelete]', function(){
        var picid = $(this).parent('[fanScript-picid]').attr('fanScript-picid');
        $.ajax({
            url: 'ajax/pic/delete_pic/picid/' + picid,
            error: function(xhr){},
            success: function(response){
                $('[fanScript-picid=' + picid + ']').remove();
                alert('刪除成功')
            }
        });
    });
});
</script>
<?=$temp['admin_header_down']?>
<h2>廣告管理 - 新增廣告</h2>
<div class="contentBox allWidth">
	<h3>新增廣告</h3>
	<h4>請填寫欲新增之廣告資訊</h4>
	<?php echo form_open_multipart('admin/ad/postad/post') ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                廣告名稱
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="title" placeholder="請輸入廣告名稱" value="<?if(!empty($ad['title'])):?><?=$ad['title']?><?endif?>">
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                廣告連結
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="href" placeholder="請輸入廣告連結" value="<?if(!empty($ad['href'])):?><?=$ad['href']?><?endif?>">
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片上傳
            </div>
            <div class="spanLineLeft width500">
                <div class="fileMultiple"><input type="file" name="picid_file[]" accept="image/*"></div>
                <?if($ad['piclist_array']):?>
                <div style="padding-top:10px;">
                    <?foreach($ad['piclist_array'] as $key => $value):?>
                    <div fanScript-picid="<?=$value['picid']?>" style="float:left; width:50px; height: 50px; border: 2px solid #FFF; position:relative; margin: 0 5px 5px 0;">
                        <div fanScript-picDelete style="position:absolute; top: 0; right: 0;">刪除</div>
                        <img src="<?=$value['path']['w50h50']?>">
                        <input type="hidden" name="picid_array[]" value="<?=$value['picid']?>">
                    </div>
                    <?endforeach?>
                </div>
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" value="<?if(!empty($ad['prioritynum'])):?><?=$ad['prioritynum']?><?endif?>">
            </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
            </div>
		</div>
	</div>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($ad['adid'])):?><input type="hidden" name="adid" value="<?=$ad['adid']?>"><?endif?>
                <input type="submit" class="submit" value="<?if(!empty($ad['adid'])):?>儲存變更<?else:?>新增廣告<?endif?>">
                <?if( empty($ad['adid']) === FALSE ):?><span class="submit gray" onClick="fanScript.check_href_action('確定要刪除這個廣告？', 'admin/ad/delete_ad/<?=$ad['adid']?>/<?=$this->security->get_csrf_hash()?>');">刪除廣告</span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>