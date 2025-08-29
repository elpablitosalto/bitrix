<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
//vardump($arResult);
?>

<? if (!empty($arResult)) { ?>
    <ul class="dp-header-menu__list">
        <?
        $previousLevel = 0;
        ?>
        <? foreach ($arResult as $arItem) { ?>
            <? if ($previousLevel > $arItem["DEPTH_LEVEL"]) { ?>
                    </ul>
                </div>
            </li>
            <? } ?>
            <? if ($arItem["IS_PARENT"]) { ?>
            <li class="dp-header-menu__item">
                <a class="dp-header-menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                <div class="dropdown dp-header-menu__sub">
                    <ul>
            <? } else { ?>
                <?if( $arItem["DEPTH_LEVEL"] == 1 ){?>
                    <li class="dp-header-menu__item">
                        <a class="dp-header-menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
                <?} else {?>
                    <li>
                        <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
                <?}?>
            <?}?>   
            <?
            $previousLevel = $arItem["DEPTH_LEVEL"];
            ?> 
        <? } ?>

        <?if( $previousLevel > 1 ){?>
                    </ul>
                </div>
            </li>
        <?}?>
    </ul>
<? } ?>

<?/*?>
<ul class="dp-header-menu__list">
    <li class="dp-header-menu__item">
        <a class="dp-header-menu__link" href="#">Продукция</a>
        <div class="dropdown dp-header-menu__sub">
            <ul>
                <li><a href="#">Пункт 1</a></li>
                <li><a href="#">Пункт 2</a></li>
            </ul>
        </div>
    </li>
    <li class="dp-header-menu__item"><a class="dp-header-menu__link" href="/portfolio/">Портфолио</a></li>
    <li class="dp-header-menu__item"><a class="dp-header-menu__link" href="/about/">О нас</a></li>
</ul>
<?*/ ?>