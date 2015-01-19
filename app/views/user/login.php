<?=$temp['header_up']?>
<?=$temp['header_down']?>
<div class="userBox">
	<h2>會員登入</h2>
	<div class="userBoxContent">
		<div class="message">
			<p>請輸入您的電子郵件帳號</p>
			<?=$validation_errors?>
		</div>
		<?=form_open('user/login')?>
			<div class="paragraph">
				<p>會員電子郵件：</p>
				<p><input type="text" name="email" placeholder="請輸入您的電子郵件"></p>
			</div>
			<div class="paragraph">
				<p>會員密碼：</p>
				<p><input type="password" name="password" placeholder="請輸入您的密碼"></p>
			</div>
			<div class="paragraph">
				<label class="rememberme"><input type="checkbox" checked="true">保持登入狀態</label>
				<input type="submit" value="確認送出">
			</div>
		</form>
	</div>
</div>
<?=$temp['footer']?>