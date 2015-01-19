<?=$temp['header_up']?>
<?=$temp['header_down']?>
<div class="showroomListBg">
	<div class="showroomList">
		<div class="showroomLi">
			<img src="$showroom_list[0][src]">
		</div>
	</div>
	<div class="showroomText">
		<h2>$showroom_list[0][title]</h2>
		<div class="text">$showroom_list[0][text]</div>
	</div>
	<div class="showroomNav">
		<div class="showroomNavList">
			<!--{loop $showroom_list $key $value}-->
			<div class="showroomNavLi" data-showroomid="$value[showroomid]">
				<img src="$value[src]">
			</div>
			<!--{/loop}-->
		</div>
	</div>
	<div class="showroomTextList" style="display:none;">
		<!--{loop $showroom_list $key $value}-->
		<div data-showroomid="$value[showroomid]">
			<h2>$value[title]</h2>
			<div class="text">$value[text]</div>
		</div>
		<!--{/loop}-->
	</div>
</div>
<div class="showroomLeftWhite">
	<h2>展示藝廊</h2>
	<h3>Showroom</h3>
	<p>
		<select id="roomtype">
			<option value="0">全部房間</option>
			<!--{loop $roomtype_list $key $value}-->
			<option value="$value[classid]"<!--{if $roomtype == $value[classid]}--> selected<!--{/if}-->>$value[classname]</option>
			<!--{/loop}-->
		</select>
	</p>
	<p>
		<select id="styletype">
			<option value="0">全部風格</option>
			<!--{loop $styletype_list $key $value}-->
			<option value="$value[classid]"<!--{if $styletype == $value[classid]}--> selected<!--{/if}-->>$value[classname]</option>
			<!--{/loop}-->
		</select>
	</p>
</div>
<?=$temp['footer']?>