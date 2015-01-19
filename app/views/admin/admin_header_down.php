<?if(isset($global[ 'style'])):?>
    <?foreach($global[ 'style'] as $value):?>
        <link rel="stylesheet" type="text/css" href="app/css/<?=$value?>.css"></link>
    <?endforeach?>
<?endif?>
<script>
    $(function () {
        $(document).on('click', '.sidebox h2', function () {
            if ($(this).parent('.sidebox').hasClass('hover')) {
                $(this).parent('.sidebox').removeClass('hover');
            } else {
                $(this).parent('.sidebox').addClass('hover');
            }
        });
        $(document).on('click', '.acHref', function () {
            if ($(this).hasClass('hover') == false) {
                $('.acHref').removeClass('hover');
                $(this).addClass('hover');
            }
        });
        $(document).on('mouseleave', '.sidebar', function () {
            $('.acHref').removeClass('hover');
            $('.sidebox.select').addClass('hover');
            $('.acHref.select').addClass('hover');
            $('.acHref acHrefSmall.select').addClass('hover');
        });
    });
</script>
</head>
<body>
    <div class="body">
        <div class="header">
            <a href="" class="logo"></a>
            <div class="logStatus">
                <span class="username"><?=$user['email']?></span>
                <a href="user/logout">登出</a>
            </div>
        </div>
        <div class="wrap">
            <div class="sidebar">
                <?foreach($admin_sidebox as $key => $value):?>
                <div class="sidebox<?if(isset($value['select']) && $value['select'] === TRUE):?> hover<?endif?>">
                    <h2><?=$value['title']?></h2>
                    <?foreach($value['ac_father'] as $key2=>$ac_father):?>
                    <div class="acHref<?if(isset($ac_father['select']) && $ac_father['select'] === TRUE):?> select hover<?endif?><?if(isset($ac_father['display']) && $ac_father['display'] === TRUE):?> hidden<?endif?>">
                        <div class="acHrefBig">
                            <?=$ac_father['title']?>
                        </div>
                        <div class="acHrefSmallBar">
                        <?foreach($ac_father['ac_child'] as $key3=>$ac_child):?>
                            <a href="admin/<?=$ac_father['name']?>/<?=$ac_child['name']?>" class="acHrefSmall<?if(isset($ac_child['select']) && $ac_child['select'] === TRUE):?> select hover<?endif?><?if(isset($ac_child['display']) && $ac_child['display'] === TRUE):?> hidden<?endif?>">
                                <?=$ac_child['title']?>
                            </a>
                        <?endforeach?>
                        </div>
                    </div>
                    <?endforeach?>
                </div>
                <?endforeach?>
            </div>
            <div class="content">