<div class="contacts__address" id="requisites">
    <div class="requisites">
        <h2>Реквизиты</h2>
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "requisites",
            array(
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "USE_SHARE" => "N",
                "SHARE_HIDE" => "Y",
                "SHARE_TEMPLATE" => "",
                "SHARE_HANDLERS" => array("delicious"),
                "SHARE_SHORTEN_URL_LOGIN" => "",
                "SHARE_SHORTEN_URL_KEY" => "",
                "AJAX_MODE" => "N",
                "IBLOCK_TYPE" => 'content',
                "IBLOCK_ID" => Indexis::getIblockId('requisites', 'content'),
                "ELEMENT_ID" => '',
                "ELEMENT_CODE" => 'requisites',
                "CHECK_DATES" => "Y",
                "FIELD_CODE" => array("ID", 'NAME', 'DETAIL_PICTURE', 'DETAIL_TEXT'),
                "PROPERTY_CODE" => array('FULL_NAME', 'SHORT_NAME', 'INN', 'KPP', 'OGRN', 'ADDRESS_REG', 'BANK_NAME', 'BIK', 'KS', 'RS', 'CEO', 'EMAIL', 'FILE'),
                "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
                "DETAIL_URL" => "",
                "SET_TITLE" => "Y",
                "SET_CANONICAL_URL" => "Y",
                "SET_BROWSER_TITLE" => "Y",
                "BROWSER_TITLE" => "-",
                "SET_META_KEYWORDS" => "Y",
                "META_KEYWORDS" => "-",
                "SET_META_DESCRIPTION" => "Y",
                "META_DESCRIPTION" => "-",
                "SET_STATUS_404" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_ELEMENT_CHAIN" => "N",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "USE_PERMISSIONS" => "N",
                "GROUP_PERMISSIONS" => array("1"),
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_GROUPS" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Страница",
                "PAGER_TEMPLATE" => "",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "Y",
                "SHOW_404" => "N",
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
</div>
<div class="contacts__wrapper">
    <div class="contacts__questions">
        <p class="contacts__questions-title">Часто задаваемые вопросы</p>
        <p>Здесь вы найдете быстрые и исчерпывающие ответы на самые распространенные вопросы о нашей продукции, сервисах и компании.</p><a target="_blank" href="/qa/">Все вопросы</a>
    </div>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "contacts",
        array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_CONTACTS"],
            //"LIST_URL" => "result_list.php",
            "LIST_URL" => "",
            //"EDIT_URL" => "result_edit.php",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "Y",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "SEF_FOLDER" => "/",
            "VARIABLE_ALIASES" => array(),
            "AJAX_MODE" => "N",
        )
    );
    ?>
</div>