	<link rel="stylesheet" type="text/css" href="app/css/style.css"></link>
	<?if(isset($global['style'])):?>
	<?foreach($global['style'] as $value):?>
	<link rel="stylesheet" type="text/css" href="app/css/<?=$value?>.css"></link>
	<?endforeach?>
	<?endif?>
</head>
<body>
	<div class="header">
	  <div class="logoarea">
		<a href="page/index"><img src="app/img/logoBig.png"  class="logo"></a>
	  </div> 
	  <div class="nav">
		   <div class="in_nav">
			<a href="page/about"><div>About</div></a>
			<a href="news"><div>News</div></a>
			<a href="page/portfolio"><div>Portfolio</div></a>
			<a href="contact"><div>Contact</div></a>
		   </div> 
	  </div>   
	</div>