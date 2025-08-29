<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<div class="nav nav_type_buttons">
    <ul class="nav__list">
        <?foreach($arResult as $arItem):?>
            <?
                $type = !empty($arItem['PARAMS']['TYPE']) ? $arItem['PARAMS']['TYPE'] : 'DEFAULT';
            ?>
            <li class="nav__item">
                <?if($type === 'LOGOUT'):?>
                    <a href="#modalConfirmSignout" class="nav__link js-modal">
                        <span class="nav__text"><?=$arItem["TEXT"]?></span>
                    </a>
                <?else:?>
                    <a
                        class="nav__link <?if ($arItem["SELECTED"]):?>nav__link_state_active<?endif;?>"
                        href="<?=$arItem["LINK"]?>"
                    >
                        <?=$arItem["TEXT"]?>
                    </a>
                <?endif?>
            </li>
        <?endforeach?>
    </ul>
</div>
<?endif?>