<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
$chosenAddressId = ($arParams['SYNC_CONTENT_CLINIC'] == 'Y' ? intval($_COOKIE['chosenAddressId']) : 0);
?>

<?if ($chosenAddressId > 0):?>
    <?
    $GLOBALS["arFilter" . $item['ID']] = [
        'ID' => $chosenAddressId,
        '!PROPERTY_K_47_SLIDES' => false
    ];
    $iblockType = 'contacts';
    $iblockId = Indexis::getIblockId('addresses', $iblockType);
    ?>
<?else:?>
    <?
    $GLOBALS["arFilter" . $item['ID']] = [
        'ID' => $item['ID'],
        '!PROPERTY_K_47_SLIDES' => false
    ];
    $iblockType = 'constructor';
    $iblockId = Indexis::getIblockId('pages', $iblockType);
    ?>
<?endif;?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "photogallery_for_clinic",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "block" . $item['ID'],
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("", ""),
        "FILTER_NAME" => "arFilter" . $item['ID'],
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => $iblockId,
        "IBLOCK_TYPE" => $iblockType,
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
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
        "PROPERTY_CODE" => array("SLIDES"),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "NAME",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "BLOCK_AREA_ID" => $arParams['BLOCK_AREA_ID'],
        "EDIT_AREA_ID" => $arParams['EDIT_AREA_ID'],
        "CUSTOM_TITLE" => $item['NAME'],
        "SYNC_CONTENT_CLINIC" => $arParams['SYNC_CONTENT_CLINIC']
    )
);?>

<?/*if (is_array($item['PROPERTIES']['K_47_SLIDES']['VALUE']) && count($item['PROPERTIES']['K_47_SLIDES']['VALUE']) > 0) : ?>
    <section class="nb-clinic-gallery-section nb-clinic-gallery-section_light" id="<?= $arParams['BLOCK_AREA_ID'] ?>">
        <div class="nb-clinic-gallery-section__header">
            <h2 class="nb-clinic-gallery-section__title"><?= $item['NAME'] ?></h2>
        </div>
        <div class="nb-clinic-gallery-section__body" id="<?= $arParams['EDIT_AREA_ID'] ?>">
            <div class="nb-clinic-gallery">
                <div class="nb-clinic-gallery-slider">
                    <div class="nb-clinic-gallery-slider__container">
                        <div class="nb-clinic-gallery-slider__list">
                            <? foreach ($item['PROPERTIES']['K_47_SLIDES']['VALUE'] as $arItem) : ?>
                                <?
                                $arItemValues = $arItem['SUB_VALUES'];
                                ?>
                                <div class="nb-clinic-gallery-slider__col">
                                    <div class="nb-clinic-gallery-slider__item">
                                        <img src="<?= CFile::GetPath($arItemValues['K_47_PHOTO']['VALUE']) ?>" alt="">
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="nb-clinic-gallery-desc">
                        <div class="nb-clinic-gallery-desc__container">
                            <div class="nb-clinic-gallery-desc__list">
                                <? foreach ($item['PROPERTIES']['K_47_SLIDES']['VALUE'] as $arItem) : ?>
                                    <?
                                    $arItemValues = $arItem['SUB_VALUES'];
                                    ?>
                                    <div class="nb-clinic-gallery-desc__item">
                                        <p><?= $arItemValues['K_47_DESCRIPTION']['VALUE'] ?></p>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? endif; */?>