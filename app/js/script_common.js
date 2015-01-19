$(function(){
	$(document).on('click', '[data-hrefto]', function(){
		var href = $(this).data('hrefto');
		$('.page').addClass('opacity0');
		setTimeout(function(){
			$('.page').remove();
			location.href = href;
		}, 1000);
	});
	$(document).on('mouseenter', '.pageBox1, .pageBox2, .pageBox3, .pageBox4, .pageBox5, .pageBox6', function(){
		var $this = $(this);
		$('.pageBox1, .pageBox2, .pageBox3, .pageBox4, .pageBox5, .pageBox6').removeClass('hover');
		if($this.hasClass('pageBox1') == true){
			$('.pageBox1').addClass('hover');
			$('.pageBox4').addClass('hover2');
		}
		else if($this.hasClass('pageBox2') == true){
			$('.pageBox2').addClass('hover');
			$('.pageBox4').addClass('hover2');
		}
		else if($this.hasClass('pageBox3') == true){
			$('.pageBox3').addClass('hover');
			$('.pageBox4').addClass('hover2');
		}
		else if($this.hasClass('pageBox4') == true){
			$('.pageBox4').addClass('hover');
			$('.pageBox4').removeClass('hover2');
		}
		else if($this.hasClass('pageBox5') == true){
			$('.pageBox5').addClass('hover');
			$('.pageBox4').removeClass('hover2');
		}
		else if($this.hasClass('pageBox6') == true){
			$('.pageBox6').addClass('hover');
			$('.pageBox4').removeClass('hover2');
		}
	});
	$(document).on('change', '.showroomLeftWhite select', function(){
		var roomtype = $('.showroomLeftWhite select#roomtype').val();
		var styletype = $('.showroomLeftWhite select#styletype').val();
		var href = 'showroom/classid/' + roomtype + '/' + styletype;
		$('.page').addClass('opacity0');
		setTimeout(function(){
			$('.page').remove();
			location.href = href;
		}, 1000);
	});
	$(document).on('click', '.pictureLi', function(){
		var picid = $(this).data('picid');
		$('.picBig[data-picid=' + picid + ']').css('display','block');
		$('.picBig[data-picid=' + picid + ']').removeClass('opacity0');
	});
	$(document).on('click', '.picBig img', function(){
		var $this = $(this).parents('.picBig');
		$this.addClass('opacity0');
		setTimeout(function(){
			$this.css('display','none');
		}, 1000);
	});
	$(document).on('click', '.brandView .brandText .button.picture', function(){
		$('.brandView .brandText').addClass('opacity0');
		$('.brandView .brandPicture').addClass('opacity1');
	});
	$(document).on('click', '.brandView .brandPicture .returnButton', function(){
		$('.brandView .brandText').removeClass('opacity0');
		$('.brandView .brandPicture').removeClass('opacity1');
	});
	
	setTimeout(function(){
		$('html').addClass('forever');
	}, 3000);
});