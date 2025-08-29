<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>
<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="wrapper rs__partner">
        <div class="container">
            <div class="rs__content">
                <div class="rs__content--top">
                    <div class="rs__section--title">Партнеры</div>
                    <div class="rs__slider--control">
                        <div class="rs__slider--control-prev"></div>
                        <div class="rs__slider--control-next"></div>
                    </div>
                </div>
                <div class="swiper js--slider-partner rs__partner--slider">
                    <div class="swiper-wrapper rs__partner--block">
                        <? foreach ($arResult["ITEMS"] as $item) { ?>
                            <?
                            if (!$item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"])
                                continue;
                            $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="swiper-slide rs__partner--item" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                                <div class="rs__partner--pic">
                                    <? if ($item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"]) { ?>
                                        <picture>
                                            <img src="<?= $item["PREVIEW_PICTURE"]["PREVIEW_PICTURE_RESIZED"] ?>"
                                                 alt="<?= $item["PREVIEW_PICTURE"]["ALT"] ?>"
                                                 title="<?= $item["PREVIEW_PICTURE"]["TITLE"] ?>"
                                                 class="rs__partner--img">
                                        </picture>
                                    <? } ?>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="is-hidden-desktop swiper-scrollbar"></div>
                </div>
            </div>
        </div>
    </section>

<? } ?>


