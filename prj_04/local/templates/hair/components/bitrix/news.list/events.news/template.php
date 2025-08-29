<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<section class="events">
    <div class="container">
        <div class="events-wrapper" data-ajax-container>
            <?
            if(isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y'){
                $APPLICATION->RestartBuffer();
            }?>
            <?
                if($arParams['DISPLAY_TOP_PAGER'] == 'Y') {
                    echo $arResult["NAV_STRING"];
                }
            ?>
            <?foreach($arResult['ITEMS'] as $k => $arItem):?>
                <?
                $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>500, 'height'=>288), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                $locationID = $arItem['DISPLAY_PROPERTIES']['LOCATION']['VALUE'][0];
                ?>
                <div class="event-item<?=(isset($arItem['DISPLAY_PROPERTIES']['STATUS'])) ? ' _active' : ''?>">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="event-item__image">
                        <div class="event-item__image-container">
                            <img src="<?= $pic['src'] ?>" alt role="presentation" class="event-item__img">
                        </div>
                    </a>
                    <div class="event-item__description">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><h3><?=$arItem['NAME']?></h3></a>
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
                if($arParams['DISPLAY_BOTTOM_PAGER'] == 'Y') {
                    echo $arResult["NAV_STRING"];
                }
            ?>
            <?
            if(isset($_REQUEST['AJAX_CALL']) && $_REQUEST['AJAX_CALL'] == 'Y')
                die();
            ?>
        </div>
    </div>
    </div>