	<link rel="stylesheet" type="text/css" href="app/css/style.css"></link>
	<?if(isset($global['style'])):?>
	<?foreach($global['style'] as $value):?>
	<link rel="stylesheet" type="text/css" href="app/css/<?=$value?>.css"></link>
	<?endforeach?>
	<?endif?>
</head>
<body>
	<div class="topHeader">
	<div class="topHeaderContent">
		<span data-hrefto="" class="logo">
			<img src="app/img/logo.png">
		</span>
		<div class="nav">
			<span data-hrefto="page/story" class="navLi hover">
				<div class="text">
					<span>Story</span>
				</div>
				<div class="text2">
					<span>品牌故事</span>
				</div>
			</span>
			<span data-hrefto="note" class="navLi hover">
				<div class="text">
					<span>News</span>
				</div>
				<div class="text2">
					<span>最新消息</span>
				</div>
			</span>
			<span data-hrefto="showroom" class="navLi hover">
				<div class="text">
					<span>Showroom</span>
				</div>
				<div class="text2">
					<span>展示藝廊</span>
				</div>
			</span>
			<span data-hrefto="brand" class="navLi hover">
				<div class="text">
					<span>Brand</span>
				</div>
				<div class="text2">
					<span>合作品牌</span>
				</div>
			</span>
		</div>
	</div>
</div>
<div class="topHeaderBg"></div>
<div class="page">
		
	