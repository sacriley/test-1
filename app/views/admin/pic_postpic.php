<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>照片管理 - 新增照片</h2>
<div class="contentBox allWidth">
	<h3>新增照片</h3>
	<h4>請填寫欲新增之照片資訊</h4>
    <? echo form_open_multipart('admin/pic/postpic/post')?>
    <?=$error?>
    <?if(empty($pic)):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片上傳
            </div>
            <div class="spanLineLeft width500">
                <input type="file" name="userfile" />
		    </div>
		</div>
	</div>
    <?else:?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片預覽
            </div>
            <div class="spanLineLeft width500">
                <img src="<?=$pic['path']['w300h300']?>">
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片網址
            </div>
            <div class="spanLineLeft width500">
                <input type="text" value="<?=prep_url($_SERVER['HTTP_HOST'].base_url($pic['path']['w0h0']))?>">
                <br>
                <a href="<?=prep_url($_SERVER['HTTP_HOST'].base_url($pic['path']['w0h0']))?>" target="_blank">
                    <?=prep_url($_SERVER['HTTP_HOST'].base_url($pic['path']['w0h0']))?>
                </a>
		    </div>
		</div>
	</div>
    <?endif?>
    <?if(0):?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                照片分類標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(isset($pic['classid_array'])):?>
                <?foreach($pic['classid_array'] as $key => $value):?>
                <p class="pClassid">
                    <select name="classid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($class_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"<?if($value == $value2['classid']):?> selected<?endif?>><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <?endforeach?>
                <?else:?>
                <p class="pClassid">
                    <select name="classid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($class_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <?endif?>
                <?if(0):?>
                <p class="pClassid" style="display:none;">
                    <select name="classid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($class_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <p><span class="ahref addClassidSelect">新增分類標籤</span> | <a href="admin/pic/classlist">管理分類標籤</a></p>
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
                <input type="number" class="text width100" name="prioritynum" value="<?if(isset($pic['prioritynum'])):?><?=$pic['prioritynum']?><?endif?>">
            </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">目前文章排序方式為???，若需變更文章排序方式，請於「文章設置」後台變更</p>
            </div>
		</div>
	</div>
    <?endif?>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(isset($pic['picid'])):?><input type="hidden" name="picid" value="<?=$pic['picid']?>"><?endif?>
                <input type="submit" class="submit" value="<?if(isset($pic['picid'])):?>儲存變更<?else:?>新增照片<?endif?>">
                <?if( empty($pic['picid']) === FALSE ):?><span class="submit gray" onClick="fanScript.check_href_action('確定要刪除這張照片？', 'admin/pic/delete_pic/<?=$pic['picid']?>/<?=$this->security->get_csrf_hash()?>');">刪除照片</span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>