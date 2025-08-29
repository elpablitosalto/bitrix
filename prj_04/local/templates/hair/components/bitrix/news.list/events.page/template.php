<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<section class="events">
    <div class="container">
		<?php if(empty($arResult['ITEMS'])):?>
			В данный момент активных мероприятий нет
		<?php endif; ?>
        <div class="events-wrapper" data-ajax-container>
            <?
            if(isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y'){
                $APPLICATION->RestartBuffer();
            }?>
            <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                <?
                    $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>500, 'height'=>288), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    $locationID = $arItem['DISPLAY_PROPERTIES']['LOCATION']['VALUE'][0];
                ?>
                <div class="event-item<?=(isset($arItem['DISPLAY_PROPERTIES']['STATUS'])) ? ' _active' : ''?>">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="event-item__image">
                        <div class="event-item__image-container">
                            <img src="<?= $pic['src'] ?>" alt role="presentation" class="event-item__img">
<!--                            <img src="--><?//=$pic['src']?><!--">-->
<!--                            <div class="event-item__image-date">-->
<!--                                <p>--><?//=$arItem['DISPLAY_PROPERTIES']['EVENT_TIME']['DISPLAY_VALUE']?><!--</p>-->
<!--                                <p>--><?//=FormatDate('j F Y года',strtotime($arItem['ACTIVE_FROM']))?><!--, --><?//=$arItem['DISPLAY_PROPERTIES']['LOCATION']['LINK_SECTION_VALUE'][$locationID]['NAME']?><!--</p>-->
<!--                            </div>-->
<!--                            --><?//if(isset($arItem['DISPLAY_PROPERTIES']['STATUS'])):?><!--<div class="event-item__image-tag">Завершен</div>--><?//endif;?>
                            <div class="bottom-badge">
                                <?if($arItem['PROPERTIES']["TYPE"]['VALUE']):?>
                                    <div class="type-block"
                                         <?if(mb_strtolower($arItem['PROPERTIES']["TYPE"]['VALUE']) == 'семинар'):?>style="background-color:#CE0000;"
                                         <?elseif(mb_strtolower($arItem['PROPERTIES']["TYPE"]['VALUE']) == 'мастер-класс'):?>style="background-color:#3333CC;"
                                        <?endif;?>>
                                    <span>
                                        <?=$arItem['PROPERTIES']["TYPE"]['VALUE']?>
                                    </span>
                                    </div>
                                <? endif?>
                                <?if($arItem['PROPERTIES']["COST"]['VALUE']):?>
                                    <div class="type-block"
                                         <?if(mb_strtolower($arItem['PROPERTIES']["COST"]['VALUE']) == 'платный'):?>style="background-color:#FAFF00; color:black !important;"
                                         <?else:?>style="background-color:#31A808;"
                                        <?endif;?>>
                                    <span>
                                        <?=$arItem['PROPERTIES']["COST"]['VALUE']?>
                                    </span>
                                    </div>
                                <? endif?>
                            </div>
                        </div>
                    </a>
                    <div class="event-item__description">
                        <h3><?=$arItem['NAME']?></h3>
                        <div class="event-item__description-date">
                            <p><?=$arItem['PROPERTIES']['START_DATE']['VALUE']?></p>
                            <p><?if($arItem['PROPERTIES']['EVENT_TIME']['VALUE']){echo $arItem['PROPERTIES']['EVENT_TIME']['VALUE'];}?></p>
                        </div>
                        <div class="event-item__description-text">
                            <?=$arItem['PREVIEW_TEXT']?>
                        </div>
                        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button _small">Подробнее</a>
                    </div>
                </div>
            <?endforeach;?>
            <?
            if(isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y')
                die();
            ?>
        </div>
    </div>
</div>