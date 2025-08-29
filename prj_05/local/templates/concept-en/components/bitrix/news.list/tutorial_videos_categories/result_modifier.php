<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!function_exists("sortArray")) {
    function sortArray($item1, $item2)
    {
        return intval($item1['SORT']) <=> intval($item2['SORT']);
    }
}
$arResult['TYPES'] = [];

//vardump($arResult['ITEMS']);

foreach($arResult['ITEMS'] as $k => $arItem):
    if(!empty($arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'])) {
        $type = $arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'];
        $arResult['TYPES'][$type]['NAME'] = $arItem['PROPERTIES']['TYPE']['VALUE'];
        $arResult['TYPES'][$type]['SORT'] = $arItem['PROPERTIES']['TYPE']['VALUE_SORT'];
        $arResult['TYPES'][$type]['ITEMS'][] = $arItem;
        if(!empty($arItem['PROPERTIES']['TOPIC']['VALUE_XML_ID'])) {
            $topic = $arItem['PROPERTIES']['TOPIC']['VALUE_XML_ID'];

            if(empty($arResult['TYPES'][$type]['TOPICS'][$topic])) {
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

    foreach($arResult['TYPES'] as $k => $type):
        uasort($arResult['TYPES'][$k]['TOPICS'], 'sortArray');
    endforeach;
endforeach;
?>