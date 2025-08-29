<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult["ITEMS"]))
{

    foreach ($arResult["ITEMS"] as &$arItem) {
        $arItem["SPEAKERS"] = [];
        if(!empty($arItem["PROPERTIES"]["SPEAKERS"]["VALUE"])) {
            $rsAllItems = \CIBlockElement::GetList(
                [],
                [
                    "ID" => $arItem["PROPERTIES"]["SPEAKERS"]["VALUE"],
                    "ACTIVE" => "Y",
                    "IBLOCK_ID" =>  $arItem["PROPERTIES"]["SPEAKERS"]["LINK_IBLOCK_ID"]
                ],
                false,
                false,
                ["ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE"]
            );

            while ($item = $rsAllItems->GetNext()) {
                $image = !empty($item["PREVIEW_PICTURE"]) ? $item["PREVIEW_PICTURE"] : (!empty($item["DETAIL_PICTURE"]) ? $item["DETAIL_PICTURE"] : '');

                if(!empty($image)) {
                    $item["IMAGE"] = CFile::ResizeImageGet(
                        $image,
                        Array("width" => 48, "height" => 48),
                        BX_RESIZE_IMAGE_PROPORTIONAL_ALT , true
                    );
                } else {
                    $item["IMAGE"] = [];
                }

                $arItem["SPEAKERS"][$item["ID"]] = $item;
            }
        }
    }

    $arResult["TYPES"] = [];
    $rsAllItems = \CIBlockElement::GetList(
        [],
        [
            "ACTIVE" => "Y",
            "ACTIVE_DATE" => "Y",
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        ],
        false,
        false,
        ["PROPERTY_EVENT_TYPE"]
    );
    while ($item = $rsAllItems->GetNext()){
        if(!empty($item["PROPERTY_EVENT_TYPE_VALUE"])){
            $arResult["TYPES"][$item["PROPERTY_EVENT_TYPE_ENUM_ID"]] = $item["PROPERTY_EVENT_TYPE_VALUE"];
        }
    }
}
