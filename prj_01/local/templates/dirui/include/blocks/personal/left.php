<?
if ($GLOBALS['isPartner'] == true) {
    $arResultFunc = COrder::getCountInBasket(array(
        'USER_ID' => $GLOBALS['arUser']['ID'],
    ));
    $countBasketItems = $arResultFunc['countBasketItems'];
    $countBasketItemsStr = $arResultFunc['countBasketItemsStr'];
}
?>

<? $APPLICATION->IncludeComponent(
    "bitrix:menu",
    "personal",
    array(
        "ROOT_MENU_TYPE" => "left",
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => "",

        // Мои параметры -->
        "IS_PARTNER" => $GLOBALS['isPartner'],
        "countBasketItemsStr" => $countBasketItemsStr,
        // <-- Мои параметры
        )
); ?>