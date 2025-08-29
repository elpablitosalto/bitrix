<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?
if (!is_array($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'])) {
    if (strlen($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE']) > 0) {
        $arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'] = array($arResult["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE']);
    }
}

// Изображение -->
if (!empty($arResult['DETAIL_PICTURE'])) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arResult['DETAIL_PICTURE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arResult['NAME']
    ));
    $arResult['PICTURE'] = $arResultLocal['PICTURE'];
} else if (!empty($arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE']['SRC'])) {
    $arResultLocal = Indexis::getImageFormatted(array(
        'RESIZE' => 'N',
        'FILE_VALUE' => $arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE'],
        'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
        //'WIDTH' => 205,
        //'HEIGHT' => 116,
        'DEFAULT_ALT_TITLE' => $arResult['NAME']
    ));
    $arResult['PICTURE'] = $arResultLocal['PICTURE'];
}
// <-- Изображение

// Фильтр по темам -->
//vardump($arResult["DISPLAY_PROPERTIES"]['THEME']);
foreach ($arResult["DISPLAY_PROPERTIES"]['THEME']['~VALUE'] as $key => $val) {
    $arResult['arFilterResult']['PROPERTY_THEME'][] = $val;
}
// <-- Фильтр по темам

// Текст -->
if ($arParams['USER_AUTHORIZED'] == 'N') {
    $str = $arResult['DETAIL_TEXT'];
    $str = strip_tags($str);
    $arResult['DETAIL_TEXT'] = TruncateText($str, 500);
}
// <-- Текст

$arResult["EX_ID"] = $arResult["PROPERTIES"]["EVENTSESSION_ID"]["VALUE"];

// Показывать или нет платный вебинар -->
$arResult['SHOW_PAID'] = 'Y';
//vardump($arResult["DISPLAY_PROPERTIES"]['PAID']);
if (!empty($arResult["DISPLAY_PROPERTIES"]['PAID']['VALUE']) && $arResult["DISPLAY_PROPERTIES"]['PAID']['VALUE'] == 'Y') {
    $arResult['SHOW_PAID'] = 'N';

    // Выясним, вебинар оплачен или нет -->
    if (is_array($arParams['USER_ORDERS'][$arResult["ID"]])) {
        $arResult['SHOW_PAID'] = 'Y';
    }
    // <-- Выясним, вебинар оплачен или нет
}
// <-- Показывать или нет платный вебинар

// Был ли переход на страницу вебинара после успешной оплаты -->
if ($arParams['PAYMENT'] == 'success' && $arParams['USER_AUTHORIZED'] == 'Y' && $arResult['SHOW_PAID'] == 'N') {
    $arResult['SHOW_WAIT_PAYMENT'] = 'Y';
}
// <-- Был ли переход на страницу вебинара после успешной оплаты

// Файл с видео -->
$arResult['FILE_VIDEO'] = false;
$arResult['SHOW_FULL_VIDEO'] = 'N';
if ($arParams['USER_AUTHORIZED'] == 'Y') {
    if ($arResult['SHOW_PAID'] == 'N') {
        if (!empty($arResult["DISPLAY_PROPERTIES"]['FILE_SHORT']['FILE_VALUE'])) {
            $arResult['FILE_VIDEO'] = $arResult["DISPLAY_PROPERTIES"]['FILE_SHORT']['FILE_VALUE'];
        }
    } else if (!empty($arResult["DISPLAY_PROPERTIES"]['FILE']['FILE_VALUE'])) {
        $arResult['FILE_VIDEO'] = $arResult["DISPLAY_PROPERTIES"]['FILE']['FILE_VALUE'];
        $arResult['SHOW_FULL_VIDEO'] = 'Y';
    }
} else {
    if (!empty($arResult["DISPLAY_PROPERTIES"]['FILE_SHORT']['FILE_VALUE'])) {
        $arResult['FILE_VIDEO'] = $arResult["DISPLAY_PROPERTIES"]['FILE_SHORT']['FILE_VALUE'];
    }
}
// <-- Файл с видео

// -->
$arResult['SHOW_BODY'] = 'Y';
if (empty($arResult['DETAIL_TEXT'])) {
    if ($arParams['USER_AUTHORIZED'] != 'Y') {
        if (!empty($arResult['FILE_VIDEO'])) {
        } else if (empty($arResult['PICTURE'])) {
            $arResult['SHOW_BODY'] = 'N';
        }
    } else {
        if (empty($arResult["DISPLAY_PROPERTIES"]['FILE']['FILE_VALUE'])) {
            $arResult['SHOW_BODY'] = 'N';
        }
    }
}
// <--

// -->
if ($arParams['USER_AUTHORIZED'] != 'Y' && empty($arResult['FILE_VIDEO'])) {
    $arResult['HIDE_FOR_NO_AUTHORIZED'] = 'Y';
}
// <--

// Разметка OG -->
//vardump($arParams['OG']);
if ($arParams['OG']['SET'] == 'Y') {
    $arResult['OG']['OG_TITLE'] = $arResult["NAME"];
    $arResult['OG']['OG_URL'] = $arResult["DETAIL_PAGE_URL"];
    if (!empty($arResult["PREVIEW_TEXT"])) {
        $arResult['OG']['OG_DESCRIPTION'] = $arResult["PREVIEW_TEXT"];
    } else if (!empty($arResult["DETAIL_TEXT"])) {
        $arResult['OG']['OG_DESCRIPTION'] = $arResult["DETAIL_TEXT"];
    } else {
        $arResult['OG']['OG_DESCRIPTION'] = '';
    }
    if (!empty($arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE']['SRC'])) {
        $arResult['OG']['OG_IMAGE'] = $arResult["DISPLAY_PROPERTIES"]['VIDEO_PREVIEW']['FILE_VALUE']['SRC'];
    }
}
// <-- Разметка OG
?>

<?
$this->__component->SetResultCacheKeys(array("ID", "EX_ID", "NAME", "arFilterResult", "OG", "SHOW_WAIT_PAYMENT"));
?>