<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
$isServiceBanner = !empty($item['PROPERTIES']['U_6_SERVICE_PICTURE']['VALUE']);
$showFeatures = (!empty($item['DISPLAY_PROPERTIES']['U_6_OFFER_PICTURE_1']['DISPLAY_VALUE']) || !empty($item['DISPLAY_PROPERTIES']['U_6_OFFER_PICTURE_2']['DISPLAY_VALUE']) || !empty($item['DISPLAY_PROPERTIES']['U_6_OFFER_PICTURE_3']['DISPLAY_VALUE']));
?>
<section class="nb-top-b-services-section<? if ($isServiceBanner) : ?> nb-top-b-services-section-image<? else : ?> nb-top-b-services-section-quote<? endif; ?><? if (!$showFeatures) : ?> nb-top-b-services-section_no-features<? endif; ?>" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "",
        array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        )
    );
    ?>
    <div class="nb-top-b-services" id="<?= $arParams['EDIT_AREA_ID'] ?>">
        <div class="nb-top-b-services__caption">
            <? if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y') : ?>
                <?
                if (strlen($item["H_FST_PART_D"]) > 0) {
                ?>
                    <h1 class="nb-top-b-services__title desktop">
                        <?
                        echo $item["H_FST_PART_D"];
                        if (strlen($item["H_SEC_PART_D"]) > 0) {
                        ?> <span class="nb-top-b-services__subtitle"><?= $item["H_SEC_PART_D"]; ?></span>
                        <?
                        }
                        ?>
                    </h1>
                <?
                }

                if (strlen($item["H_FST_PART_M"]) > 0) {
                ?>
                    <p class="nb-top-b-services__title mobile">
                        <?
                        echo $item["H_FST_PART_M"];
                        if (strlen($item["H_SEC_PART_M"]) > 0) {
                        ?> <span class="nb-top-b-services__subtitle"><?= $item["H_SEC_PART_M"]; ?></span>
                        <?
                        }
                        ?>
                    </p>
                <?
                }
                ?>
            <? endif; ?>
            <div class="nb-top-b-services__description">
                <?
                $arPicture = array();
                $NO_IMAGE_DEFAULT = SITE_TEMPLATE_PATH . '/img/icons/quote-services.svg';

                $arFile = $item['DISPLAY_PROPERTIES']['U_6_SERVICE_PICTURE']['FILE_VALUE'];
                if (!empty($arFile)) {
                    //$arFile = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
                    $arResultLocal = Indexis::getImageFormatted(array(
                        'RESIZE' => 'N',
                        'FILE_VALUE' => $arFile,
                        'NO_IMAGE_DEFAULT' => $NO_IMAGE_DEFAULT,
                        //'WIDTH' => 205,
                        //'HEIGHT' => 116,
                        'DEFAULT_ALT_TITLE' => ''
                    ));
                    $arPicture['PICTURE_1'] = $arResultLocal['PICTURE'];
                } else {
                    $arPicture['PICTURE_1']['SRC'] = $NO_IMAGE_DEFAULT;
                }

                $arFile = $item['DISPLAY_PROPERTIES']['U_6_PICTURE_480']['FILE_VALUE'];
                if (!empty($arFile)) {
                    //$arFile = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
                    $arResultLocal = Indexis::getImageFormatted(array(
                        'RESIZE' => 'N',
                        'FILE_VALUE' => $arFile,
                        'NO_IMAGE_DEFAULT' => $NO_IMAGE_DEFAULT,
                        'WIDTH' => 480,
                        'HEIGHT' => 5000,
                        'DEFAULT_ALT_TITLE' => ''
                    ));
                    $arPicture['PICTURE_2'] = $arResultLocal['PICTURE'];
                } else {
                    $arPicture['PICTURE_2']['SRC'] = $NO_IMAGE_DEFAULT;
                }

                $arFile = $item['DISPLAY_PROPERTIES']['U_6_PICTURE_991']['FILE_VALUE'];
                if (!empty($arFile)) {
                    //$arFile = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
                    $arResultLocal = Indexis::getImageFormatted(array(
                        'RESIZE' => 'N',
                        'FILE_VALUE' => $arFile,
                        'NO_IMAGE_DEFAULT' => $NO_IMAGE_DEFAULT,
                        'WIDTH' => 991,
                        'HEIGHT' => 5000,
                        'DEFAULT_ALT_TITLE' => ''
                    ));
                    $arPicture['PICTURE_3'] = $arResultLocal['PICTURE'];
                } else {
                    $arPicture['PICTURE_3']['SRC'] = $NO_IMAGE_DEFAULT;
                }
                ?>
                <div class="nb-top-b-services__image">
                    <img src="<?= $arPicture['PICTURE_1']['SRC'] ?>" alt="">
                </div>
                <div class="nb-top-b-services__text">
                    <?
                    $textDesktop = $item['PROPERTIES']['U_6_SERVICE_DESCRIPTION']['~VALUE']['TEXT'];
                    $textMobile = $item['PROPERTIES']['U_6_SERVICE_DESCRIPTION_M']['~VALUE']['TEXT'];
                    ?>
                    <? if (mb_strlen($textDesktop) > 0) { ?>
                        <div class="nb-top-b-services__note desktop">
                            <?= $textDesktop; ?>
                        </div>
                    <? } ?>
                    <? if (mb_strlen($textMobile) > 0) { ?>
                        <div class="nb-top-b-services__note mobile">
                            <?= $textMobile ?>
                        </div>
                    <? } ?>

                    <? $APPLICATION->ShowViewContent("doctor_info_" . $item['ID']) ?>
                </div>
                <?/*?>
                <? if ($isServiceBanner) : ?>
                    <div class="nb-top-b-services__image">
                        <? if (!empty($item['PROPERTIES']['U_6_SERVICE_PICTURE']['VALUE'])) : ?>
                            <?
                            $arPicture = CFile::ResizeImageGet(
                                $item['PROPERTIES']['U_6_SERVICE_PICTURE']['VALUE'],
                                array('width' => 350, 'height' => 350),
                                BX_RESIZE_IMAGE_EXACT,
                                true
                            );
                            ?>
                            <img src="<?= $arPicture['src'] ?>" alt="" />
                        <? endif; ?>
                    </div>
                    <div class="nb-top-b-services__text">
                        <?
                        $textDesktop = $item['PROPERTIES']['U_6_SERVICE_DESCRIPTION']['~VALUE']['TEXT'];
                        $textMobile = $item['PROPERTIES']['U_6_SERVICE_DESCRIPTION_M']['~VALUE']['TEXT'];
                        ?>
                        <? if (mb_strlen($textDesktop) > 0) { ?>
                            <div class="nb-top-b-services__note desktop">
                                <?= $textDesktop; ?>
                            </div>
                        <? } ?>
                        <? if (mb_strlen($textMobile) > 0) { ?>
                            <div class="nb-top-b-services__note mobile">
                                <?= $textMobile ?>
                            </div>
                        <? } ?>

                        <? $APPLICATION->ShowViewContent("doctor_info_" . $item['ID']) ?>
                    </div>
                <? else : ?>
                    <div class="nb-top-b-services__image">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/quote-services.svg" alt="">
                    </div>
                    <div class="nb-top-b-services__text">
                        <? if (mb_strlen($item['PROPERTIES']['U_6_SERVICE_DESCRIPTION']['~VALUE']['TEXT']) > 0) : ?>
                            <div class="nb-top-b-services__note desktop">
                                <?= $item['PROPERTIES']['U_6_SERVICE_DESCRIPTION']['~VALUE']['TEXT'] ?>
                            </div>
                        <? endif; ?>
                        <? if (mb_strlen($item['PROPERTIES']['U_6_SERVICE_DESCRIPTION_M']['~VALUE']['TEXT']) > 0) : ?>
                            <div class="nb-top-b-services__note mobile">
                                <?= $item['PROPERTIES']['U_6_SERVICE_DESCRIPTION_M']['~VALUE']['TEXT'] ?>
                            </div>
                        <? endif; ?>
                        <? $APPLICATION->ShowViewContent("doctor_info_" . $item['ID']) ?>
                    </div>
                <? endif; ?>
                <?*/ ?>
            </div>
            <? if (
                !empty($item['DISPLAY_PROPERTIES']['U_6_OFFER_PICTURE_1']['DISPLAY_VALUE'])
                || !empty($item['DISPLAY_PROPERTIES']['U_6_OFFER_PICTURE_2']['DISPLAY_VALUE'])
                || !empty($item['DISPLAY_PROPERTIES']['U_6_OFFER_PICTURE_3']['DISPLAY_VALUE'])
            ) : ?>
                <div class="nb-ftrs nb-top-b-services__features">
                    <ul class="nb-ftrs__list">
                        <? foreach (['U_6_OFFER_PICTURE_1', 'U_6_OFFER_PICTURE_2', 'U_6_OFFER_PICTURE_3'] as $iconCode) : ?>
                            <?
                            if (empty($item['DISPLAY_PROPERTIES'][$iconCode]['FILE_VALUE']))
                                continue;
                            ?>
                            <li class="nb-ftrs__item">
                                <span class="nb-ftrs__icon">
                                    <img src="<?= $item['DISPLAY_PROPERTIES'][$iconCode]['FILE_VALUE']['SRC'] ?>" alt="" />
                                </span>
                                <? if (mb_strlen($item['DISPLAY_PROPERTIES'][$iconCode]['~DESCRIPTION']) > 0) : ?>
                                    <span class="nb-ftrs__desc"><?= $item['DISPLAY_PROPERTIES'][$iconCode]['~DESCRIPTION'] ?></span>
                                <? endif; ?>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
            <? endif; ?>
        </div>
    </div>
    <?
    if (!empty($arParams['SERVICE_ID'])) {
        // Нужно сделать так, что бы при выделении корневой услуги, врач отображается во всех под услугах, 
        // которые содержатся в корне -->
        if (!empty($arParams['SERVICE_ID'])) {
            $ar_default_services = array();
            $default_service = $arParams['SERVICE_ID'];
            if (strlen($default_service) > 0) {
                $ar_default_services[] = $default_service;
            }
            if (strlen($default_service) > 0) {
                $nav = CIBlockSection::GetNavChain(false, $default_service);
                while ($v = $nav->GetNext()) {
                    if ($v['ID']) {
                        $ar_default_services[] = $v['ID'];
                    }
                }
            }
        }
        //vardump($ar_default_services);
        // <--

        $GLOBALS['arFilter' . $item['ID']] = [
            '!PROPERTY_SHOW_ON_BANNER' => false,
            //'PROPERTY_SHOW_SERVICES' => $arParams['SERVICE_ID']
            'PROPERTY_SHOW_SERVICES' => $ar_default_services
        ];
        if (!empty($_SESSION["NOT_DOUBLE_DOCTOR_ID"])) {
            $GLOBALS['arFilter' . $item['ID']]["!ID"] = $_SESSION["NOT_DOUBLE_DOCTOR_ID"];
        }

        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            ($isServiceBanner ? "doctor_banner_service" : "doctor_banner_quote"),
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array("PREVIEW_PICTURE", ""),
                "FILTER_NAME" => 'arFilter' . $item['ID'],
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => Indexis::getIblockId('our_doctors', 'our_doctors'),
                "IBLOCK_TYPE" => "services",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "1",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array("SPECIALIZATIONS"),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "RAND",
                "SORT_BY2" => "RAND",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "BLOCK_ID" => $item['ID']
            )
        );
    }
    ?>
</section>