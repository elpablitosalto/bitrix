<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Награды");
use Bitrix\Main\Application;
use \Bitrix\Main\Page\Asset;
$request = Application::getInstance()->getContext()->getRequest();
Asset::getInstance()->addString('<script data-skip-moving="true" src="https://widget.cloudpayments.ru/bundles/cloudpayments.js"></script>');
?>

    <div class="page-head">
        <div class="container">
            <div class="section__content">
                <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", Array(),
                    false
                ); ?>
            </div>
            <h1 class="page-title"><?$APPLICATION->ShowTitle(false)?></h1>
        </div>
    </div>

    <div class="page-content awards-page">

        <?
        global $NavNum;
        $curentAjaxBlock = $NavNum+1;
        if ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_".$curentAjaxBlock)) {
            $GLOBALS['APPLICATION']->RestartBuffer();
        }
        ?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "awards",
            array(
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "AJAX_MODE" => "N",
                "AJAX_LOAD" => ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_" . $curentAjaxBlock)) ? "Y" : "",
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => Indexis::getIblockId("awards", "content", "s1"),
                "NEWS_COUNT" => "2",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER2" => "DESC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array("PREVIEW_PICTURE"),
                "PROPERTY_CODE" => array("AWARD"),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "show_more",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => "",
                "PAGER_BASE_LINK" => "",
                "PAGER_PARAMS_NAME" => "",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
            )
        ); ?>
        <?
        if ($request->get("AJAX_LOAD") == "Y" && $request->get("PAGEN_".$curentAjaxBlock)) {
            die();
        }
        ?>

        <?
        $APPLICATION->IncludeComponent(
            "indexis:ajax.form",
            "cloudpayments_pay_form_news",
            array(
                "IBLOCK_ID" => Indexis::getIblockId("pay_form", "requests", "s1"),
                "IBLOCK_TYPE" => "requests",
                "CHECK_CAPTCHA" => "Y",
                "FIELDS" => [
                    "PROPERTY_SUM" => ["CLEAR", "NOT_EMPTY", "NUMBER"],
                ],
                "RETURN_FIELDS" => ["PROPERTY_SUM","PROPERTY_TYPE"],
                "HANDLERS" => [
                    "ACTIVE" => "N",
                    "NAME" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
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
        );
        ?>

    </div>


<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>