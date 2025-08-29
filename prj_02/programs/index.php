<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
Asset::getInstance()->addString('<script data-skip-moving="true" src="https://widget.cloudpayments.ru/bundles/cloudpayments.js"></script>');
?>
    <div class="page-content projects-detail-page program-detail-page">

        <div class="page-head">
            <div class="container">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(),
                    false
                ); ?>
            </div>
        </div>

        <? $APPLICATION->IncludeComponent("bitrix:news.detail", "programs_detail", array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "USE_SHARE" => "N",
                "SHARE_HIDE" => "N",
                "SHARE_TEMPLATE" => "",
                "SHARE_HANDLERS" => array(""),
                "SHARE_SHORTEN_URL_LOGIN" => "",
                "SHARE_SHORTEN_URL_KEY" => "",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => Indexis::getIblockId("programs", "content", "s1"),
                "ELEMENT_ID" => "",
                "ELEMENT_CODE" => $_REQUEST["element"],
                "CHECK_DATES" => "Y",
                "FIELD_CODE" => array("ID", "DETAIL_TEXT"),
                "PROPERTY_CODE" => array(
                    "PROJECTS",
                    "FOR_WHOM",
                    "DOCS",
                    "PROGRAM_NUMBERS",
                    "PROGRAM_GOAL",
                    "PROGRAM_GOAL_DESCRIPTION",
                    "PROGRAM_GOAL_DESCRIPTION_2",
                    "FAMILY_PROJECTS",
                    "SPECIALIST_PROJECTS",
                    "PARTNERS",
                ),
                "IBLOCK_URL" => "",
                "DETAIL_URL" => "",
                "SET_TITLE" => "Y",
                "SET_CANONICAL_URL" => "Y",
                "SET_BROWSER_TITLE" => "Y",
                "BROWSER_TITLE" => "-",
                "SET_META_KEYWORDS" => "Y",
                "META_KEYWORDS" => "-",
                "SET_META_DESCRIPTION" => "Y",
                "META_DESCRIPTION" => "-",
                "SET_STATUS_404" => "Y",
                "SET_LAST_MODIFIED" => "Y",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_ELEMENT_CHAIN" => "Y",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "USE_PERMISSIONS" => "N",
                "GROUP_PERMISSIONS" => array(),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "",
                "PAGER_TEMPLATE" => "",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SHOW_404" => "Y",
                "MESSAGE_404" => "",
                "STRICT_SECTION_CHECK" => "Y",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "arrPager",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N"
            )
        ); ?>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>