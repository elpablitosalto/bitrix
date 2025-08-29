<ul class="main-menu">
    <?
        $itemLimit = isset($arParams['ITEM_OVERFLOW_LIMIT']) && !empty($arParams['ITEM_OVERFLOW_LIMIT']) ? $arParams['ITEM_OVERFLOW_LIMIT'] : 999;
        $i = 0;
    ?>
    <?foreach($arResult['MENU'] as $k => $arItem):?>
        <!--<p>--><?php //d($arResult['MENU'])?><!--</p>-->
        <?if($i < $itemLimit):?>
            <li class="main-menu__item">
                <a href="<?=$arItem['LINK']?>" class="main-menu__item-link"><?=$arItem['TEXT']?></a>
                <?if(isset($arItem['ITEMS']) && !empty($arItem['ITEMS'])):?>
                    <ul class="dd-menu">
                        <?foreach($arItem['ITEMS'] as $j => $ddItem):?>
                            <!--<p>--><?php //d($ddItem)?><!--</p>-->
                            <li class="dd-menu__item"><a class="dd-menu__item-link" href="<?=$ddItem['LINK']?>"><?=$ddItem['TEXT']?></a></li>
                        <?endforeach;?>
                    </ul>
                <?endif;?>
            </li>
        <?endif?>
        <?
            $i++;
        ?>
    <?endforeach;?>
    <?if($i > $itemLimit):?>
        <li class="main-menu__item">
            <div class="main-menu__bruger">
                <button class="burger" type="button">
                    <div class="burger__bars">&nbsp;</div>
                    Показать дополнительные пункты меню
                </button>
            </div>
            <?
                $extraIndex = 0;
            ?>
            <ul class="dd-menu">
                <?foreach($arResult['MENU'] as $k => $arItem):?>
                    <?if($extraIndex >= $itemLimit):?>
                        <li class="dd-menu__item">
                            <a href="<?=$arItem['LINK']?>" class="dd-menu__item-link"><?=$arItem['TEXT']?></a>
                            <?if(isset($arItem['ITEMS']) && !empty($arItem['ITEMS'])):?>
                                <ul class="dd-menu dd-menu_type_sub">
                                    <?foreach($arItem['ITEMS'] as $j => $ddItem):?>
                                        <li class="dd-menu__item"><a class="dd-menu__item-link" href="<?=$ddItem['LINK']?>"><?=$ddItem['TEXT']?></a></li>
                                    <?endforeach;?>
                                </ul>
                            <?endif;?>
                        </li>
                    <?endif?>
                    <?
                        $extraIndex++;
                    ?>
                <?endforeach;?>
            </ul>
        </li>
    <?endif;?>
</ul>