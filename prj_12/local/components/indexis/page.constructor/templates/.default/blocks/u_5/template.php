<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$item = $arParams['ITEM'];
?>
<section class="nb-top-b-services-section nb-top-b-services-section-quote" id="<?=$arParams['BLOCK_AREA_ID'] ?>">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "",
        Array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        )
    );
    ?>
    <div class="nb-top-b-services" id="<?=$arParams['EDIT_AREA_ID'] ?>">
        <div class="nb-top-b-services__caption">
            <?if ($item['PROPERTIES']['HIDE_BLOCK_TITLE']['VALUE_XML_ID'] != 'Y'):?>
                <h1 class="nb-top-b-services__title"><?=$item['NAME']?></h1>
            <?endif;?>
            <div class="nb-top-b-services__description">
                <div class="nb-top-b-services__image">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/quote-services.svg" alt="">
                </div>
                <div class="nb-top-b-services__text">
                    <?$APPLICATION->ShowViewContent("doctor_info_" . $item['ID'])?>
                </div>
            </div>
			<div class="nb-ftrs nb-top-b-services__features">
				<ul class="nb-ftrs__list">
					<li class="nb-ftrs__item"><span class="nb-ftrs__icon"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/licenses-white.svg" alt=""></span><span class="nb-ftrs__desc">Лицензции на&nbsp;все&nbsp;услуги</span></li>
					<li class="nb-ftrs__item"><span class="nb-ftrs__icon"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/guarantees-white.svg" alt=""></span><span class="nb-ftrs__desc">Гарантии на&nbsp;все&nbsp;виды работ</span></li>
					<li class="nb-ftrs__item"><span class="nb-ftrs__icon"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/licenses-white.svg" alt=""></span><span class="nb-ftrs__desc">Лицензции на&nbsp;все&nbsp;услуги</span></li>
				</ul>
			</div>
        </div>
    </div>
    <?
    if (!empty($arParams['SERVICE_ID'])) {

        $GLOBALS['arFilter' . $item['ID']] = [
            '!PROPERTY_SHOW_ON_BANNER' => false,
            'PROPERTY_SHOW_SERVICES' => $arParams['SERVICE_ID']
        ];

        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "doctor_banner_quote",
            Array(
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
                "DISPLAY_BOTTOM_PAGER" => "N",
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
                "PROPERTY_CODE" => array("QUOTE"),
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