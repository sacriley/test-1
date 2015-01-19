{global_title}
<?=$global_title?>

<h1>使用Parser的寫法</h1>
{sample}
<div>
    <h2>{title}</h2>
    <div id="main">
        {text}
    </div>
    <p><a href="{href}">View article</a></p>
</div>
{/sample}

<h1>使用PHP簡寫的寫法</h1>
<?foreach($sample as $value):?>
<div>
    <h2><?=$value['title']?></h2>
    <div id="main">
        <?=$value['text']?>
    </div>
    <p><a href="<?=$value['href']?>">View article</a></p>
</div>
<?endforeach?>

<h1>簡易判斷式：</h1>
<?if($global_title == 'sample1'):?>
   <h3>Hi Sally</h3>
<?elseif($global_title == 'sample2'):?>
   <h3>Hi Joe</h3>
<?else:?>
   <h3>Hi unknown user</h3>
<?endif?>