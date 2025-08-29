<?
$column1 = $column2 = '';
$menuDefault = '<li class="nav__item">
                    <a class="nav__link" href="%link%" data-text="%title%">
                        <span class="nav__link-text">%title%</span>
                    </a>
                </li>';
foreach($arResult as $k => $arItem):
    if($arItem['PARAMS']['COLUMN'] == 1 && !empty($arItem['TEXT'])):
        $column1 .= str_replace(
            ['%link%','%title%'],
            [$arItem['LINK'],$arItem['TEXT']],
            $menuDefault
        );
    elseif(!empty($arItem['TEXT'])):
        $column2 .= str_replace(
            ['%link%','%title%'],
            [$arItem['LINK'],$arItem['TEXT']],
            $menuDefault
        );
    endif;
endforeach;
?>
<div class="footer__list">
    <nav class="nav">
        <ul class="nav__list">
            <?=$column1?>
        </ul>
    </nav>
</div>
<div class="footer__list">
    <nav class="nav">
        <ul class="nav__list">
            <?=$column2?>
        </ul>
    </nav>
</div>