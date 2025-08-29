<?if(!empty($arResult['ITEMS'])):?>
    <div class="icon-panel-group">
        <ul class="icon-panel-group__list">
            <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                <li class="icon-panel-group__item">
                    <!-- begin .icon-panel-->
                    <div class="icon-panel">
                        <div class="icon-panel__wrapper">
                            <div class="icon-panel__illustration">
                                <picture class="icon-panel__picture">
                                    <img
                                        src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                        alt="<?=$arItem["NAME"]?>"
                                        class="icon-panel__image"
                                        title=""
                                    />
                                </picture>
                            </div>
                            <div class="icon-panel__info">
                                <div class="icon-panel__title">
                                    <!-- begin .title-->
                                    <div class="title title_size_h5 title_style_dependent">
                                        <?=$arItem["NAME"]?>
                                    </div>
                                    <!-- end .title-->
                                </div>
                                <div class="icon-panel__text">
                                    <?=htmlspecialchars_decode($arItem["PREVIEW_TEXT"])?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .icon-panel-->
                </li>
            <?endforeach;?>
        </ul>
    </div>
<?endif;?>