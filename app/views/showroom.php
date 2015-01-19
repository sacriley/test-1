<?=$temp['header_up']?>
<?=$temp['header_down']?>
<div class="showroomListBg">
	<div class="showroomList">
		<div class="showroomLi">
			<img src="<?if(!empty($showroom['piclist_array'][0]['path']['w0h0'])):?><?=$showroom['piclist_array'][0]['path']['w0h0']?><?endif?>">
		</div>
	</div>
	<div class="showroomText">
		<h2><?=$showroom['title']?></h2>
		<div class="text"><?=$showroom['text']?></div>
	</div>
	<div class="showroomNav">
		<div class="showroomNavList">
			<?foreach($showroom_list as $key => $value):?>
			<a href="showroom/showroomid/<?=$value['showroomid']?>" class="showroomNavLi">
				<img src="<?if(!empty($value['piclist_array'][0]['path']['w0h0'])):?><?=$value['piclist_array'][0]['path']['w50h50']?><?endif?>">
			</a>
			<?endforeach?>
		</div>
	</div>
</div>
<div class="showroomLeftWhite">
	<h2>展示藝廊</h2>
	<h3>Showroom</h3>
	<p>
		<select id="roomtype">
			<option value="0">全部房間</option>
			<?foreach($roomclass_list_array as $key => $value):?>
			<option value="<?=$value['classid']?>"<?if($showroom['roomclassid'] == $value['classid']):?> selected<?endif?>><?=$value['classname']?></option>
			<?endforeach?>
		</select>
	</p>
	<p>
		<select id="styletype">
			<option value="0">全部風格</option>
			<?foreach($styleclass_list_array as $key => $value):?>
			<option value="<?=$value['classid']?>"<?if($showroom['styleclassid'] == $value['classid']):?> selected<?endif?>><?=$value['classname']?></option>
			<?endforeach?>
		</select>
	</p>
</div>
<?=$temp['footer']?>