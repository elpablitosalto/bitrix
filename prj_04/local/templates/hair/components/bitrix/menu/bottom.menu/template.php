<?
$column1 = $column2 = '';
$menuDefault = '<li><a class="top-footer__menu-list--link" href="%link%">%title%</a></li>';
foreach($arResult as $k => $arItem):
    if($arItem['PARAMS']['COLUMN'] == 1):
        $column1 .= str_replace(
            ['%link%','%title%'],
            [$arItem['LINK'],$arItem['TEXT']],
            $menuDefault
        );
    else:
        $column2 .= str_replace(
            ['%link%','%title%'],
            [$arItem['LINK'],$arItem['TEXT']],
            $menuDefault
        );
    endif;
endforeach;
?>

<ul class="top-footer__menu-list">
    <?=$column1?>
</ul>
<ul class="top-footer__menu-list">
    <?=$column2?>
</ul>