<ul class="nav__list">
    <?foreach($arResult['MENU'] as $k => $arItem):?>
        <?
        if(empty($arItem['TEXT'])){
            continue;
        }
        ?>
        <li class="nav__item">
            <a class="nav__link<?if(isset($arItem['ITEMS']) && !empty($arItem['ITEMS'])):?> nav__link_type_parent js-nav-parent-link<?endif;?>" <?if(!empty($arItem['LINK'])):?>href="<?=$arItem['LINK']?>"<?else:?>style="cursor:pointer;"<?endif;?> data-text="<?=$arItem['TEXT']?>">
                <span class="nav__link-text"><?=$arItem['TEXT']?></span>
            </a>
            <?if(isset($arItem['ITEMS']) && !empty($arItem['ITEMS'])):?>
                <div class="nav__submenu">
                    <ul class="nav__list">
                        <?foreach($arItem['ITEMS'] as $j => $ddItem):?>
                            <li class="nav__item"><a class="nav__link" href="<?=$ddItem['LINK']?>"><?=$ddItem['TEXT']?></a></li>
                        <?endforeach;?>
                    </ul>
                </div>
            <?endif;?>
        </li>
    <?endforeach;?>
</ul>