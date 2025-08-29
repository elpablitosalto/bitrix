<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Hair\General;

if (!function_exists("sortArray")) {
    function sortArray($item1, $item2)
    {
        return intval($item1['SORT']) <=> intval($item2['SORT']);
    }
}
$arResult['TYPES'] = [];

foreach ($arResult['ITEMS'] as $k => $arItem):
    if (!empty($arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'])) {
        $type = $arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'];
        $arResult['TYPES'][$type]['NAME'] = $arItem['PROPERTIES']['TYPE']['VALUE'];
        $arResult['TYPES'][$type]['SORT'] = $arItem['PROPERTIES']['TYPE']['VALUE_SORT'];
        $arResult['TYPES'][$type]['ITEMS'][] = $arItem;
        if (!empty($arItem['PROPERTIES']['TOPIC']['VALUE_XML_ID'])) {
            $topic = $arItem['PROPERTIES']['TOPIC']['VALUE_XML_ID'];

            if (empty($arResult['TYPES'][$type]['TOPICS'][$topic])) {
                $arResult['TYPES'][$type]['TOPICS'][$topic] = [
                    'NAME' => $arItem['PROPERTIES']['TOPIC']['VALUE'],
                    'SORT' => $arItem['PROPERTIES']['TOPIC']['VALUE_SORT'],
                    'ITEMS' => []
                ];
            }

            $arResult['TYPES'][$type]['TOPICS'][$topic]['ITEMS'][] = $arItem;
        }
    }

    uasort($arResult['TYPES'], 'sortArray');

    foreach ($arResult['TYPES'] as $k => $type):
        uasort($arResult['TYPES'][$k]['TOPICS'], 'sortArray');
    endforeach;
endforeach;


// Связанные продукты -->
$arRelatedProducts = array();
$arRelatedProductsIds = array();
foreach ($arResult['ITEMS'] as $arItem) {
    $ar = $arItem['PROPERTIES']['PRODUCTS_ELS']['VALUE'];
    if (!empty($ar)) {
        if (!is_array($ar)) {
            $ar = array($ar);
        }
        if (is_array($ar)) {
            $arRelatedProductsIds = array_merge($arRelatedProductsIds, $ar);
        }
    }
    $ar = $arItem['PROPERTIES']['PRODUCTS_INFINITY_ELS']['VALUE'];
    if (!empty($ar)) {
        if (!is_array($ar)) {
            $ar = array($ar);
        }
        if (is_array($ar)) {
            $arRelatedProductsIds = array_merge($arRelatedProductsIds, $ar);
        }
    }
}
if (!empty($arRelatedProductsIds)) {
    $arSelect = array("ID", "NAME", "DETAIL_PAGE_URL");
    $arFilter = array("ID" => $arRelatedProductsIds, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arRelatedProducts[$arFields['ID']] = array(
            'NAME' => $arFields['NAME'],
            'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
        );
    }
}
// <--


foreach ($arResult['ITEMS'] as &$arItem) {
    // Изображения -->
    if (is_array($arItem["PREVIEW_PICTURE"])) {
        $arFile = $arItem["PREVIEW_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 430,
        'HEIGHT' => 260,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PREVIEW_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];
    // <-- Изображения

    // Теги -->
    if (FALSE) {
        if (!empty($arItem['PROPERTIES']['PRODUCTS']['VALUE'])) {
            $arProducts = explode(',', $arItem['PROPERTIES']['PRODUCTS']['VALUE']);

            foreach ($arProducts as $tag) {
                $tag = trim($tag);
                $arItem['TAGS_PRODUCTS_LINK_HTML'][] = '<a class="video-snippet__link" href="' . SITE_DIR . 'search/?q=' . $tag . '">' . $tag . '</a>';
            }
        }
    }
    // <-- Теги

    // Продукты -->
    $arProductsIds_1 = $arItem['PROPERTIES']['PRODUCTS_ELS']['VALUE'];
    if (!empty($arProductsIds_1)) {
        if (!is_array($arProductsIds_1)) {
            $arProductsIds_1 = array($arProductsIds_1);
        }
    }
    if (!is_array($arProductsIds_1)) {
        $arProductsIds_1 = array();
    }
    $arProductsIds_2 = $arItem['PROPERTIES']['PRODUCTS_INFINITY_ELS']['VALUE'];
    if (!empty($arProductsIds_2)) {
        if (!is_array($arProductsIds_2)) {
            $arProductsIds_2 = array($arProductsIds_2);
        }
    }
    if (!is_array($arProductsIds_2)) {
        $arProductsIds_2 = array();
    }
    $arProductsIds = array_merge($arProductsIds_1, $arProductsIds_2);
    $arProductsIds = array_unique($arProductsIds);
    if (!empty($arProductsIds)) {
        foreach ($arProductsIds as $id) {
            $arItem['TAGS_PRODUCTS_LINK_HTML'][] = '<a class="video-snippet__link" href="' . $arRelatedProducts[$id]['DETAIL_PAGE_URL'] . '">' . $arRelatedProducts[$id]['NAME'] . '</a>';
        }
    }
    // <-- Продукты

    // Ссылка на видео -->
    $arItem['VIDEO_LINK'] = $arItem['PROPERTIES']['LINK']['VALUE'];
    $arItem['VIDEO_LINK'] = General::ParseShortYouTubeLink($arItem['VIDEO_LINK']);
    // <--
}
