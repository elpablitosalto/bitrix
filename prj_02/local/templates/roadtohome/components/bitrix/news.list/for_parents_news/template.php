<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//vardump($arResult["ITEMS"]);
//echo "count = ".count($arResult["ITEMS"])."<br />";
?>

<? if (!empty($arResult["ITEMS"])) { ?>

    <section class="for-parents-events">
        <div class="container">
            <h3 class="section__title">Курсы для родителей и анонсы мероприятий</h3>
            <div class="items-list events-list">
                <? foreach ($arResult["ITEMS"] as $key => $arItem) { ?>
                    <div class="list-item events-item">
                        <div class="events-item__date-time">
                            <div class="events-item__day">
                                <? echo FormatDate("j", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["EVENT_DATE"]["VALUE"])); ?>
                            </div>
                            <div class="text-size-lg events-item__month">
                                <? echo FormatDate("F", MakeTimeStamp($arItem["DISPLAY_PROPERTIES"]["EVENT_DATE"]["VALUE"])); ?>
                            </div>
                            <div class="events-item__time"><?= $arItem["DISPLAY_PROPERTIES"]["EVENT_TIME"]["VALUE"]; ?></div>
                        </div>
                        <div class="events-item__content">
                            <div class="row align-items-height">
                                <div class="col-lg-6 col-xxl-7">
                                    <div class="events-item__info">
                                        <div class="h4 events-item__title">
                                            <a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>">
                                                <?= $arItem["NAME"]; ?>
                                            </a>
                                        </div>
                                        <? if (!empty($arItem["arTags"])) { ?>
                                            <div class="events-item__tags">
                                                <div class="buttons-line">
                                                    <? foreach ($arItem["arTags"] as $k => $v) { ?>
                                                        <span class="btn btn-transparent tag"><?= $v; ?></span>
                                                    <? } ?>
                                                </div>
                                            </div>
                                        <? } ?>
                                        <div class="text-size-lg events-item__text">
                                            <?= $arItem["PREVIEW_TEXT"]; ?>
                                        </div>
                                        <div class="events-item__reg-btn">
                                            <a href="#modal-event-registration" data-modal="#modal-event-registration" class="btn" onclick="$('#PROPERTY_EVENT_NAME').val('<?= $arItem['NAME']; ?>'); $('#PROPERTY_EVENT').val('<?= $arItem['ID']; ?>');">
                                                Зарегистрироваться
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xxl-5">
                                    <? if (strlen($arItem["PREVIEW_PICTURE"]["SRC"]) > 0) { ?>
                                        <a target="_self" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="events-item__image">
                                            <picture>
                                                <img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"]; ?>" loading="lazy" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
                                            </picture>
                                        </a>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
            <div class="section__nav">
                <a target="_self" href="/news/">
                    <u>Больше новостей</u>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
                        <use xlink:href="#arrow"></use>
                    </svg>
                </a>
            </div>
        </div>
        <?/* $APPLICATION->IncludeComponent(
            "indexis:ajax.form",
            "event_reg",
            array(
                "IBLOCK_ID" => Indexis::getIblockId("event_reg", "requests", SITE_ID),
                "IBLOCK_TYPE" => "requests",
                "FIELDS" => [
                    "NAME" => ["CLEAR", "NOT_EMPTY", "TEXT"],
                    "PROPERTY_EMAIL" => ["CLEAR", "NOT_EMPTY", "TEXT", "EMAIL"],
                    "PROPERTY_PHONE" => ["CLEAR", "NOT_EMPTY", "PHONE"],
                    //"PROPERTY_EVENT" => ["CLEAR", "NOT_EMPTY", "TEXT"],
                    //"PROPERTY_EVENT_NAME" => ["CLEAR", "NOT_EMPTY", "TEXT"],
                    //"PROPERTY_TYPE" => ["NOT_EMPTY", "LIST"]
                ],
                "SEND_MESSAGE" => "REG_EVENT_CALLBACK",
                "HANDLERS" => [
                    //"PROPERTY_PROJECT" => $arResult["NAME"],
                    "AGREEMENT" => [
                        "method_name" => "check_value",
                        "method_params" => [
                            "VALUE" => "y",
                            "TO" => "MAIN",
                            "ERROR" => "Необходимо принять условия политики конфидициальности",
                        ]
                    ]
                ],
            )
        ); */?>
    </section>

<? } ?>