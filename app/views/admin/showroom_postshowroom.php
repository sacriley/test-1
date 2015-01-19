<?=$temp['header_up']?>
<script>
$(function(){
    $(document).on('click', '.addClassidSelect', function(){
        $('.pClassid:last').clone().css('display','block').insertAfter('.pClassid:last');
    });
    $(document).on('change', '.fileMultiple', function(){
        if($(".fileMultiple :file[value='']").size() == 0)
        {
            $(this).clone().val('').insertAfter('.fileMultiple:last');
        }
        else
        {
            $(this).remove();
        }
    });
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
<h2>展示藝廊 - 新增展示藝廊</h2>
<div class="contentBox allWidth">
	<h3>新增展示藝廊</h3>
	<h4>請填寫欲新增之展示藝廊資訊</h4>
	<?php echo form_open_multipart('admin/showroom/postshowroom/post') ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                標題
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="title" placeholder="請輸入展示藝廊標題名稱" value="<?if(!empty($showroom['title'])):?><?=$showroom['title']?><?endif?>">
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                副標題
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="text" placeholder="請輸入展示藝廊副標題名稱" value="<?=$showroom['text']?>">
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片上傳
            </div>
            <div class="spanLineLeft width500">
                <div class="fileMultiple"><input type="file" name="picid_file[]" accept="image/*" multiple></div>
                <?if($showroom['piclist_array']):?>
                <div style="padding-top:10px;">
                    <?foreach($showroom['piclist_array'] as $key => $value):?>
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
                風格標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(empty($showroom['styleclassid_array']) == FALSE):?>
                <?foreach($showroom['styleclassid_array'] as $key => $value):?>
                <p class="pClassid">
                    <select name="styleclassid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($styleclass_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"<?if($value == $value2['classid']):?> selected<?endif?>><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <?endforeach?>
                <?else:?>
                <p class="pClassid">
                    <select name="styleclassid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($styleclass_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                房間標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(empty($showroom['roomclassid_array']) == FALSE):?>
                <?foreach($showroom['roomclassid_array'] as $key => $value):?>
                <p class="pClassid">
                    <select name="roomclassid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($roomclass_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"<?if($value == $value2['classid']):?> selected<?endif?>><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <?endforeach?>
                <?else:?>
                <p class="pClassid">
                    <select name="roomclassid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($roomclass_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <?endif?>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                展示藝廊內容
            </div>
            <div class="spanLineRight">
                <textarea cols="80" id="content" name="content" rows="10"><?if(isset($showroom['content'])):?><?=$showroom['content']?><?endif?></textarea>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" min="0" name="prioritynum" value="<?if(isset($showroom['prioritynum'])):?><?=$showroom['prioritynum']?><?endif?>">
            </div>
		</div>
	</div>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(isset($showroom['showroomid'])):?><input type="hidden" name="showroomid" value="<?=$showroom['showroomid']?>"><?endif?>
                <input type="submit" class="submit" value="<?if($showroom['showroomid'] == 0):?>新增項目<?else:?>儲存變更<?endif?>">
                <?if( empty($showroom['showroomid']) === FALSE ):?><span class="submit gray" onClick="fanScript.check_href_action('確定要刪除項目？', 'admin/showroom/delete_showroom/<?=$showroom['showroomid']?>/<?=$this->security->get_csrf_hash()?>');">刪除項目</span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>