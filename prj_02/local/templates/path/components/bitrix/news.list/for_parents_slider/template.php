<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Grid\Declension;
?>
<?if(!empty($arResult["ITEMS"] )){?>
<section class="wrapper rs__gallery">
    <div class="container">
        <div class="rs__content">
            <div class="rs__content--top">
                <h3 class="rs__section--title">Как мы это делаем:</h3>
                <div class="rs__slider--control">
                    <div class="rs__slider--control-prev"></div>
                    <div class="rs__slider--control-next"></div>
                </div>
            </div>
            <div class="swiper js--gallery-slider">
                <div class="swiper-wrapper rs__gallery--block">
                    <? foreach ($arResult["ITEMS"] as $item) { ?>
                    <?
                    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="swiper-slide" id="<?=$this->GetEditAreaId($item['ID']);?>">
                        <div class="js--gallery-it rs__gallery--item is-img<?if($item["DISPLAY_PROPERTIES"]["YOUTUBE"]["DISPLAY_VALUE"]){?> is-video<?}?>"<?if($item["DISPLAY_PROPERTIES"]["YOUTUBE"]["DISPLAY_VALUE"]){?>  data-youtube="<?=$item["DISPLAY_PROPERTIES"]["YOUTUBE"]["DISPLAY_VALUE"]?>"<?} else {?>  data-img="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"<?}?>>
                            <div class="rs__gallery--pic">
                                <picture>
                                    <img src="<?=$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]?>" alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>"
                                         title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>" class="rs__gallery--img">
                                </picture>
                            </div>
                        </div>
                    </div>
                    <?}?>
                </div>
                <div class="is-hidden-tablet swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<?}?>


