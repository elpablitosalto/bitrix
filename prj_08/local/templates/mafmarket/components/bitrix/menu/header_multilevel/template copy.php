<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) { ?>
    <ul class="dp-header-menu__list">
        <?
        $previousLevel = 0;
        $previousType = '';
        foreach ($arResult as $arItem) { ?>
            <?if( $previousLevel > $arItem["DEPTH_LEVEL"] ){?>
                <?if( $arItem["DEPTH_LEVEL"] == 2 && $previousLevel == 3 ){?>
                    <?if( $previousType == 'OUTSIDE' ){?>
                            </ul>
                        </div>
                    </li>
                    <?} else {?>
                            </ul>
                        </div>
                    </div>
                    <?}?>
                <?} else if( $arItem["DEPTH_LEVEL"] == 1 && $previousLevel == 3 ){?>
                    </div>
                </li>
                <?} else if( $arItem["DEPTH_LEVEL"] == 1 && $previousLevel == 2 ){?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?}?>        
            <?}?>
            
            <? if ($arItem["IS_PARENT"]) { ?>
                <? if ($arItem["DEPTH_LEVEL"] == 1) { ?>
                    <li class="dp-header-menu__item dp-header-menu__item_dropdown <?=$arItem["PARAMS"]["CLASS"];?>">
                        <a class="dp-header-menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                        <?if( $arItem["PARAMS"]["TYPE"] == 'CATALOG' ){?>
                            <div class="dp-header-dropdown-menu">
                        <?} else {?>
                            <div class="dp-header-dropdown-menu">
                                <div class="dp-header-dropdown-menu-section">
                                    <div class="dp-header-submenu">
                                        <ul class="dp-header-submenu__list">
                        <? } ?>            
                <? } else if ($arItem["DEPTH_LEVEL"] == 2) { ?>
                    <?if( $previousType == 'OUTSIDE' ){?>
                        <li class="dp-header-submenu__item">
                            <a class="dp-header-submenu__link dp-header-submenu__link_bold" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                            <div class="dp-header-submenu">
                                <ul class="dp-header-submenu__list">    
                    <?} else {?>
                        <div class="dp-header-dropdown-menu-section">
                            <p class="dp-header-dropdown-menu-section__title"><?=$arItem["TEXT"]?></p>
                            <div class="dp-header-submenu">
                                <ul class="dp-header-submenu__list">
                    <?}?>
                <?}?>    
            <? } else { ?>
                <?if( $arItem["DEPTH_LEVEL"] == 1 ){?>
                    <li class="dp-header-menu__item">
                        <a class="dp-header-menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
                <?} else {?>
                    <li class="dp-header-submenu__item">
                        <a class="dp-header-submenu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
                <?}?>
            <? } ?>
            <?
            $previousLevel = $arItem["DEPTH_LEVEL"];
            if( strlen( $arItem["PARAMS"]["TYPE"] ) > 0 ) {
                $previousType = $arItem["PARAMS"]["TYPE"];
            }
            ?>
        <? } ?>

        <?if( $previousLevel > 1 ){?>
            <?if( $previousLevel == 3 ){?>
                </div>
            </li>
            <?} else if( $previousLevel == 2 ){?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            <?}?>        
        <?}?>
    </ul>
<? } ?>