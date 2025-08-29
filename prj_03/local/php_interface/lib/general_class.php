<?


// 33409 + 34146
class productColors
{
    public static function getProductColorsFromHL($arItem)
    {
        $arResult = [];
        if (\Bitrix\Main\Loader::includeModule("highloadblock") && \Bitrix\Main\Loader::includeModule("iblock")) {
            // Выясняем цвета товара и его связанных товаров
            $arColors = $arColorsExt = $arColorLinks = [];
            if (!empty($arItem["PROPERTIES"]["TSVET_OSNOVNOY"]["VALUE_XML_ID"])) {
                $arColors[$arItem["PROPERTIES"]["TSVET_OSNOVNOY"]["VALUE_XML_ID"]] = [
                    "XML_ID" => $arItem["PROPERTIES"]["TSVET_OSNOVNOY"]["VALUE_XML_ID"],
                    "URL" => ""
                ];
            }
            if (!empty($arItem["PROPERTIES"]["TSVET"]["VALUE_XML_ID"])) {
                $arColorsExt[$arItem["PROPERTIES"]["TSVET"]["VALUE_XML_ID"]] = [
                    "XML_ID" => $arItem["PROPERTIES"]["TSVET"]["VALUE_XML_ID"],
                    "URL" => ""
                ];
            }
            if (!empty($arItem['LINKED_PRODUCTS'])) {
                $arLinkedColors = [];
                foreach ($arItem['LINKED_PRODUCTS'] as $linkedProduct) {
                    if (!empty($linkedProduct["PROPERTY_TSVET_OSNOVNOY_ENUM_ID"])) {
                        $rsLinkedColorData = \Bitrix\Iblock\PropertyEnumerationTable::getlist([
                            "filter" => [
                                "ID" => $linkedProduct["PROPERTY_TSVET_OSNOVNOY_ENUM_ID"]
                            ]
                        ]);
                        if ($linkedColor = $rsLinkedColorData->fetch()) {
                            $arColors[$linkedColor["XML_ID"]] = [
                                "XML_ID" => $linkedColor["XML_ID"],
                                "URL" => is_array($linkedProduct["DETAIL_PAGE_URL"]) ? current($linkedProduct["DETAIL_PAGE_URL"]) : $linkedProduct["DETAIL_PAGE_URL"]
                            ];
                        }
                    }
                    if (!empty($linkedProduct["PROPERTY_TSVET_ENUM_ID"])) {
                        $rsLinkedColorData = \Bitrix\Iblock\PropertyEnumerationTable::getlist([
                            "filter" => [
                                "ID" => $linkedProduct["PROPERTY_TSVET_ENUM_ID"]
                            ]
                        ]);
                        if ($linkedColor = $rsLinkedColorData->fetch()) {
                            $arColorsExt[$linkedColor["XML_ID"]] = [
                                "XML_ID" => $linkedColor["XML_ID"],
                                "URL" => is_array($linkedProduct["DETAIL_PAGE_URL"]) ? current($linkedProduct["DETAIL_PAGE_URL"]) : $linkedProduct["DETAIL_PAGE_URL"]
                            ];
                        }
                    }
                }
            }
            // Выбираем цвета из HL
            if (!empty($arColors)) {
                $rsHighloadData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('=NAME' => "AsproMshopColorReference")));
                if ($arHighloadData = $rsHighloadData->fetch()) {
                    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHighloadData);
                    $entityDataClass = $entity->getDataClass();
                    $rsResultColors = $entityDataClass::getList([
                        'filter' => [
                            '=UF_XML_ID' => array_keys($arColors),
                        ],
                        'select' => ["ID", "UF_NAME", "UF_XML_ID", "UF_FILE"],
                        'order' => ["UF_SORT" => "ASC"],
                    ]);
                    while ($resultColor = $rsResultColors->fetch()) {
                        if (!empty($resultColor["UF_FILE"])) {
                            $resultColor["UF_FILE"] = \CFile::ResizeImageGet($resultColor["UF_FILE"], array('width' => 32, 'height' => 32), BX_RESIZE_IMAGE_EXACT, true);
                        }
                        $resultColor["URL"] = $arColors[$resultColor["UF_XML_ID"]]["URL"];
                        $arResult[] = $resultColor;
                    }
                }
            }
            if (!empty($arColorsExt)) {
                $rsHighloadData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('=NAME' => "TSVET")));
                if ($arHighloadData = $rsHighloadData->fetch()) {
                    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHighloadData);
                    $entityDataClass = $entity->getDataClass();
                    $rsResultColors = $entityDataClass::getList([
                        'filter' => [
                            '=UF_XML_ID' => array_keys($arColorsExt),
                        ],
                        'select' => ["ID", "UF_NAME", "UF_XML_ID", "UF_FILE"],
                        'order' => ["UF_SORT" => "ASC"],
                    ]);
                    while ($resultColor = $rsResultColors->fetch()) {
                        if (!empty($resultColor["UF_FILE"])) {
                            $resultColor["UF_FILE"] = \CFile::ResizeImageGet($resultColor["UF_FILE"], array('width' => 32, 'height' => 32), BX_RESIZE_IMAGE_EXACT, true);
                        }
                        $resultColor["URL"] = $arColorsExt[$resultColor["UF_XML_ID"]]["URL"];
                        $arResult[] = $resultColor;
                    }
                }
            }
        }
        return $arResult;
    }

    public static function getLinkedProducts($arItem)
    {
        $arResult = [];
        if (!empty($arItem["PROPERTIES"]["IMYA_KOMPLEKTA"]["VALUE_ENUM_ID"]) && !empty($arItem["PROPERTIES"]["TIP_IZDELIYA"]["VALUE_ENUM_ID"])) {
            $arLinkedProducts = CMshopCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" => "Y", "TAG" => CMshopCache::GetIBlockCacheTag($arItem["ID"]))), array(
                "!ID" => $arItem["ID"],
                "ACTIVE" => "Y",
                "IBLOCK_ID" => $arItem["IBLOCK_ID"],
                "PROPERTY_IMYA_KOMPLEKTA" => $arItem["PROPERTIES"]["IMYA_KOMPLEKTA"]["VALUE_ENUM_ID"],
                "PROPERTY_TIP_IZDELIYA" => $arItem["PROPERTIES"]["TIP_IZDELIYA"]["VALUE_ENUM_ID"],
                "PROPERTY_SEZON" => $arItem["PROPERTIES"]["SEZON"]["VALUE_ENUM_ID"]
            ), false, false, [
                "ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_TSVET_OSNOVNOY", "PROPERTY_TSVET"
            ]);
            $arResult = $arLinkedProducts;
        }
        return $arResult;
    }
}