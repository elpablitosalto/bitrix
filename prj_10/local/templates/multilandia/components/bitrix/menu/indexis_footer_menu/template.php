<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="ml-footer-menu">
        <ul class="ml-footer-menu__list">
            <?
            foreach($arResult as $arItem):
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <li class="ml-footer-menu__item"><a class="ml-footer-menu__title" href="<?=$arItem['LINK'];?>"><?=$arItem['TEXT'];?></a></li>
            <?endforeach?>
        </ul>
    </div>
<?endif?>