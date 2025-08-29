<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arParentProductIds = array();
$arMaterailsIds = array();
$arProductOptionsIds = array();


foreach ($arResult['ITEMS'] as &$arItem) {

    // -->
    if (is_array($arItem["DETAIL_PICTURE"])) {
        $arFile = $arItem["DETAIL_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 1440,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['DETAIL_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];
    // <--

    // -->
    if (is_array($arItem["PREVIEW_PICTURE"])) {
        $arFile = $arItem["PREVIEW_PICTURE"];
    } else {
        $arFile = CFile::GetFileArray($arItem["PREVIEW_PICTURE"]);
    }
    $arResultLocal = getImageFormatted(array(
        'RESIZE' => 'Y',
        'FILE_VALUE' => $arFile,
        'WIDTH' => 576,
        'HEIGHT' => 5000,
        'DEFAULT_ALT_TITLE' => $arItem['NAME']
    ));
    $arItem['PREVIEW_PICTURE_SLIDER'] = $arResultLocal['PICTURE'];
    // <--

    // -->
    $arParentProductIds[] = $arItem['ID'];
    if (!empty($arItem['PROPERTIES']['INSTRUCTION']['VALUE'])) {
        if (!is_array($arItem['PROPERTIES']['INSTRUCTION']['VALUE'])) {
            $arItem['PROPERTIES']['INSTRUCTION']['VALUE'] = array($arItem['PROPERTIES']['INSTRUCTION']['VALUE']);
        }
        $arItem['MATERIALS']['IDS'] = $arItem['PROPERTIES']['INSTRUCTION']['VALUE'];
        $arMaterailsIds = array_merge($arMaterailsIds, $arItem['PROPERTIES']['INSTRUCTION']['VALUE']);
    }
    // <--

    // -->
    if (!empty($arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'])) {
        if (!is_array($arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'])) {
            $arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'] = array($arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE']);
        }
        $arProductOptionsIds = array_merge($arProductOptionsIds, $arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE']);
    }
    // <--
}


// Торговые предложения -->
$arSKU = array();
if (!empty($arParentProductIds)) {
    $arSelect = false;
    $arFilter = [
        'IBLOCK_ID' => CONCEPT_CATALOG_EN_VARS_IB_ID,
        'PROPERTY_PARENT_PRODUCT' => $arParentProductIds,
        'ACTIVE' => 'Y'
    ];
    $obj = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
    $arItem['SKU'] = [];
    while ($res = $obj->GetNextElement()) {
        $arFields = $res->GetFields();
        $arProps = $res->GetProperties();

        $arSKUItem = array();

        // Изображение -->
        if (is_array($arFields["PREVIEW_PICTURE"])) {
            $arFile = $arFields["PREVIEW_PICTURE"];
        } else {
            $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
        }
        $arResultLocal = getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arFile,
            'WIDTH' => 400,
            'HEIGHT' => 400,
            'DEFAULT_ALT_TITLE' => $arFields['NAME']
        ));
        $arSKUItem['PICTURE'] = $arResultLocal['PICTURE'];
        $arSKUItem['PICTURE_SOURCE'] = $arFile;
        // <-- Изображение

        // -->
        $arSKUItem['NAME'] = $arFields['NAME'];
        $arSKUItem['PREVIEW_TEXT'] = $arFields['PREVIEW_TEXT'];
        // <--

        $arSKU[$arProps['PARENT_PRODUCT']['VALUE']]['SKU']['ITEMS'][$arFields['ID']] = $arSKUItem;

        // Свойства -->
        foreach ($arProps as $prop) {
            if ($prop['CODE'] == 'VOLUME' || $prop['CODE'] == 'COLOR' || $prop['CODE'] == 'LINK' || $prop['CODE'] == 'MARKETPLACE_OZON' || $prop['CODE'] == 'MARKETPLACE_GOLDAPPLE') {
                $arDisplayProp = CIBlockFormatProperties::GetDisplayValue($arFields, $prop);
                if ($arDisplayProp['VALUE']) {
                    $arSKU[$arProps['PARENT_PRODUCT']['VALUE']]['SKU']['PROPS'][$arDisplayProp['CODE']][$arDisplayProp['VALUE']] = $arDisplayProp['DISPLAY_VALUE'];
                }
            }
        }
        // <-- Свойства
    }
}
foreach ($arResult['ITEMS'] as &$arItem) {
    if (!empty($arSKU[$arItem['ID']]['SKU'])) {
        $arItem['SKU'] = $arSKU[$arItem['ID']]['SKU'];
    }
}
// <-- Торговые предложения


// Product options -->
$arProductOptions = array();
if (!empty($arProductOptionsIds)) {
    $arSelect = false;
    $arFilter = [
        'IBLOCK_ID' => CONCEPT_CATALOG_EN_VARS_IB_ID,
        'ID' => $arProductOptionsIds,
        'ACTIVE' => 'Y'
    ];
    $obj = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
    $arItem['PRODUCT_OPTIONS'] = [];
    while ($res = $obj->GetNextElement()) {
        $arFields = $res->GetFields();
        $arProps = $res->GetProperties();

        $arProductOptionItem = array();

        // Изображение -->
        if (is_array($arFields["PREVIEW_PICTURE"])) {
            $arFile = $arFields["PREVIEW_PICTURE"];
        } else {
            $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
        }
        $arResultLocal = getImageFormatted(array(
            'RESIZE' => 'Y',
            'FILE_VALUE' => $arFile,
            'WIDTH' => 400,
            'HEIGHT' => 400,
            'DEFAULT_ALT_TITLE' => $arFields['NAME']
        ));
        $arProductOptionItem['PICTURE'] = $arResultLocal['PICTURE'];
        $arProductOptionItem['PICTURE_SOURCE'] = $arFile;
        // <-- Изображение

        // -->
        $arProductOptionItem['NAME'] = $arFields['NAME'];
        $arProductOptionItem['PREVIEW_TEXT'] = $arFields['PREVIEW_TEXT'];
        // <--

        $arProductOptions[$arProps['PARENT_PRODUCT']['VALUE']]['PRODUCT_OPTIONS']['ITEMS'][$arFields['ID']] = $arProductOptionItem;

        // Свойства -->
        foreach ($arProps as $prop) {
            if ($prop['CODE'] == 'VOLUME' || $prop['CODE'] == 'COLOR' || $prop['CODE'] == 'LINK' || $prop['CODE'] == 'MARKETPLACE_OZON' || $prop['CODE'] == 'MARKETPLACE_GOLDAPPLE') {
                $arDisplayProp = CIBlockFormatProperties::GetDisplayValue($arFields, $prop);
                if ($arDisplayProp['VALUE']) {
                    $arProductOptions[$arProps['PARENT_PRODUCT']['VALUE']]['PRODUCT_OPTIONS']['PROPS'][$arDisplayProp['CODE']][$arDisplayProp['VALUE']] = $arDisplayProp['DISPLAY_VALUE'];
                }
            }
        }
        // <-- Свойства
    }
}
foreach ($arResult['ITEMS'] as &$arItem) {
    if (!empty($arProductOptions[$arItem['ID']]['PRODUCT_OPTIONS'])) {
        $arItem['PRODUCT_OPTIONS'] = $arProductOptions[$arItem['ID']]['PRODUCT_OPTIONS'];
        //vardump($arItem['PRODUCT_OPTIONS']);
    }
}
// <-- Product options


// Свойства товара -->
$arPropsCodes = array(
    'PRODUCT_TYPE',
    'PRODUCT_FEATURE',
    'PRODUCT_PROPS',
    'PRODUCT_COMPOSITION',
    'PRODUCT_UNIQUE',
);
foreach ($arResult['ITEMS'] as &$arItem) {
    foreach ($arPropsCodes as $propCode) {
        $svg = '';
        $title = '';
        switch ($propCode) {
            case "PRODUCT_TYPE":
                $svg = '<svg class="icon-props__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M19.998 21.085C19.999 21.0567 20 21.0284 20 21C20 20.5752 19.8623 20.166 19.6133 19.8271C19.8652 19.4302 20 18.9721 20 18.5C20 17.1216 18.8789 16 17.5 16C17.0527 16 16.6201 16.1196 16.2393 16.3433C15.582 15.5034 14.5752 15 13.5 15C12.5605 15 11.6709 15.3818 11.0117 16.0576C9.42284 15.7065 8 16.9541 8 18.5C8 19.7075 8.86034 20.7178 10.001 20.9497C10 20.9668 10 20.9834 10 21C10 22.0239 10.7735 22.8706 11.7666 22.9863C12.1172 23.6045 12.7754 24 13.5 24C14.2236 24 14.8838 23.5991 15.2324 22.9844C15.4101 23.0044 15.584 23.0068 15.7656 22.9829C16.1143 23.5986 16.7744 24 17.5 24C17.8877 24 18.2637 23.8853 18.584 23.6753C18.8427 23.8823 19.164 24 19.5 24C20.3271 24 21 23.3272 21 22.5C21 21.8476 20.5811 21.291 19.998 21.085Z" style="fill:url(#shampoo-icon-linear-1)"></path>
                                                        <path d="M9.13772 21.9014C9.09769 21.7749 9.0098 21.6694 8.89163 21.6079C7.72463 21.0015 7.00003 19.8105 7.00003 18.5C7.00003 16.5703 8.57034 15 10.5166 15C10.6251 15 10.7315 14.9644 10.8174 14.8989C11.334 14.5093 11.9346 14.2417 12.6016 14.104C12.8331 14.0557 13.0001 13.8516 13.0001 13.6143V7.5C13.0001 6.10913 12.1782 4.91508 11.0001 4.35108V0.500016C11 0.223641 10.7764 0 10.5 0H5.49998C5.22361 0 4.99997 0.223641 4.99997 0.500016V4.35108C3.82186 4.91508 3 6.10913 3 7.5V22C3 23.103 3.89747 24 5.00002 24H9.56447C9.76758 24 9.95119 23.877 10.0274 23.6885C10.1045 23.5 10.0596 23.2842 9.91308 23.1421C9.55078 22.7881 9.28224 22.3589 9.13772 21.9014Z" style="fill:url(#shampoo--icon-linear-2)"></path>
                                                        <defs>
                                                            <linearGradient id="shampoo-icon-linear-1" x1="14.5" y1="15" x2="14.5" y2="24" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                            <linearGradient id="shampoo--icon-linear-2" x1="8.00004" y1="0" x2="8.00004" y2="24" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>';
                $title = GetMessage('NEWS_LIST_COLLECTION_DETAIL_TYPE');
                break;
            case "PRODUCT_FEATURE":
                $svg = '<svg class="icon-props__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#vegan-icon-clip-1)">
                                                            <path d="M22.9555 8.37282L16.3464 7.74787C15.9298 7.71 15.5698 7.44487 15.3995 7.04717L13.0323 1.30899C12.6535 0.362092 11.3087 0.362092 10.93 1.30899L8.58167 7.04717C8.43017 7.44487 8.05141 7.71 7.63478 7.74787L1.02545 8.37282C0.0406781 8.46751 -0.357018 9.69848 0.38156 10.3613L5.36223 14.736C5.68417 15.02 5.81674 15.4367 5.72205 15.8533L4.22595 21.989C3.9987 22.955 5.04028 23.7502 5.91143 23.2391L11.4224 20.0005C11.7822 19.7922 12.2177 19.7922 12.5776 20.0005L18.0887 23.2391C18.9598 23.7502 20.0014 22.9739 19.774 21.989L18.2968 15.8533C18.2021 15.4367 18.3347 15.02 18.6566 14.736L23.6373 10.3613C24.3569 9.69848 23.9403 8.46751 22.9555 8.37282Z" style="fill:url(#favorites-icon-linear-1)"></path>
                                                        </g>
                                                        <defs>
                                                            <linearGradient id="favorites-icon-linear-1" x1="11.9999" y1="0.598816" x2="11.9999" y2="23.401" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                            <clipPath id="vegan-icon-clip-1">
                                                                <rect width="23.9998" height="24" fill="white"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>';
                $title = GetMessage('NEWS_LIST_COLLECTION_DETAIL_FEATURE');
                break;
            case "PRODUCT_PROPS":
                $svg = '<svg class="icon-props__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7.08 9.72L5.4 11.4L10.8 16.8L22.8 4.8L21.12 3.12L10.8 13.44L7.08 9.72ZM21.6 12C21.6 17.28 17.28 21.6 12 21.6C6.72 21.6 2.4 17.28 2.4 12C2.4 6.72 6.72 2.4 12 2.4C12.96 2.4 13.8 2.52 14.64 2.76L16.56 0.84C15.12 0.36 13.56 0 12 0C5.4 0 0 5.4 0 12C0 18.6 5.4 24 12 24C18.6 24 24 18.6 24 12H21.6Z" style="fill:url(#tick-icon-linear-1)"></path>
                                                        <defs>
                                                            <linearGradient id="tick-icon-linear-1" x1="12" y1="0" x2="12" y2="24" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>';
                $title = GetMessage('NEWS_LIST_COLLECTION_DETAIL_CHARACTERISTIC');
                break;
            case "PRODUCT_COMPOSITION":
                $svg = '<svg class="icon-props__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0)">
                                                            <path d="M13.4454 4.33376C14.2438 4.33376 14.891 3.68653 14.891 2.88813C14.891 2.08973 14.2438 1.4425 13.4454 1.4425C12.647 1.4425 11.9998 2.08973 11.9998 2.88813C11.9998 3.68653 12.647 4.33376 13.4454 4.33376Z" style="fill:url(#flask-icon-linear-1)"></path>
                                                            <path d="M16.3371 2.31336C16.9759 2.31336 17.4938 1.7955 17.4938 1.15668C17.4938 0.517863 16.9759 0 16.3371 0C15.6983 0 15.1804 0.517863 15.1804 1.15668C15.1804 1.7955 15.6983 2.31336 16.3371 2.31336Z" style="fill:url(#flask-icon-linear-2)"></path>
                                                            <path d="M21.195 19.7343L15.1804 10.1172V7.22905H16.9154V5.20508H7.08404V7.22905H8.81906V10.1172L2.80441 19.7343C2.5839 20.1431 2.45776 20.6105 2.45776 21.1083C2.45776 22.7051 3.75221 24 5.34946 24H18.6504C20.2472 24 21.5421 22.7056 21.5421 21.1083C21.5421 20.6105 21.416 20.1431 21.195 19.7343ZM7.40877 16.1891L10.843 10.6977V7.2286H13.1564V10.6977L16.5906 16.1891H7.40877Z" style="fill:url(#flask-icon-linear-3)"></path>
                                                        </g>
                                                        <defs>
                                                            <linearGradient id="flask-icon-linear-1" x1="13.4454" y1="1.4425" x2="13.4454" y2="4.33376" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                            <linearGradient id="flask-icon-linear-2" x1="16.3371" y1="0" x2="16.3371" y2="2.31336" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                            <linearGradient id="flask-icon-linear-3" x1="11.9999" y1="5.20508" x2="11.9999" y2="24" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                            <clipPath id="clip0">
                                                                <rect width="24" height="24" fill="white"></rect>
                                                            </clipPath>
                                                        </defs>
                                                    </svg>';
                $title = GetMessage('NEWS_LIST_COLLECTION_DETAIL_COMPOSITION');
                break;
            case "PRODUCT_UNIQUE":
                $svg = '<svg class="icon-props__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7.99074 11.4826L14.9258 18.4176C14.9577 17.8022 14.9853 16.4442 14.752 14.817C14.3315 11.8843 13.2499 9.47476 11.6242 7.84914C9.99854 6.22347 7.58907 5.14187 4.65638 4.72136C2.47426 4.40842 0.775085 4.56475 0.703835 4.57164C0.354757 4.60501 0.0784287 4.88134 0.0450537 5.23042C0.03821 5.30167 -0.118118 7.0008 0.194772 9.18297C0.615288 12.1157 1.69683 14.5252 3.32255 16.1508C4.94823 17.7765 7.35769 18.8581 10.2904 19.2786C11.3705 19.4335 12.3319 19.4733 13.0365 19.4733C13.3933 19.4733 13.684 19.4631 13.8909 19.4523L6.95598 12.5174C6.67023 12.2317 6.67023 11.7684 6.95598 11.4826C7.24168 11.1969 7.70499 11.1969 7.99074 11.4826Z" style="fill:url(#vegan-icon-linear-1)"></path>
                                                        <path d="M23.9675 9.64715C23.9342 9.29807 23.6578 9.02175 23.3088 8.98837C23.1132 8.96972 18.4877 8.56162 15.7943 11.2552C15.6894 11.36 15.5894 11.468 15.4937 11.5784C15.809 12.5213 16.0466 13.5348 16.2006 14.6093C16.2499 14.9534 16.2883 15.2855 16.3182 15.6028L18.2301 13.691C18.5158 13.4053 18.9791 13.4053 19.2649 13.691C19.5507 13.9767 19.5506 14.44 19.2649 14.7258L16.411 17.5797C16.4103 18.3255 16.3678 18.8118 16.3585 18.9089C16.3421 19.0806 16.3056 19.2463 16.252 19.4043C17.8774 19.254 20.1212 18.7413 21.7008 17.1616C24.3942 14.4682 23.9862 9.84281 23.9675 9.64715Z" style="fill:url(#vegan-icon-linear-2)"></path>
                                                        <defs>
                                                            <linearGradient id="vegan-icon-linear-1" x1="7.47339" y1="4.52655" x2="7.47339" y2="19.4733" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                            <linearGradient id="vegan-icon-linear-2" x1="19.7469" y1="8.95587" x2="19.7469" y2="19.4043" gradientUnits="userSpaceOnUse" color="#3333FF">
                                                                <stop offset="0.619792" stop-color="currentColor" class="primary-gradient-stop"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary)"></stop>
                                                                <stop offset="1" stop-color="var(--color-secondary-dark)"></stop>
                                                            </linearGradient>
                                                        </defs>
                                                    </svg>';
                $title = GetMessage('NEWS_LIST_COLLECTION_DETAIL_UNIQUE');
                break;
        }

        if (!empty($arItem['DISPLAY_PROPERTIES'][$propCode]['DISPLAY_VALUE'])) {
            if (!is_array($arItem['DISPLAY_PROPERTIES'][$propCode]['DISPLAY_VALUE'])) {
                $arItem['DISPLAY_PROPERTIES'][$propCode]['DISPLAY_VALUE'] = array($arItem['DISPLAY_PROPERTIES'][$propCode]['DISPLAY_VALUE']);
            }
            $arItem['EXT_PROPS'][$propCode] = array(
                'SVG' => $svg,
                'TITLE' => $title,
                'VALUE' => $arItem['DISPLAY_PROPERTIES'][$propCode]['DISPLAY_VALUE']
            );
        }
    }
}
// <-- Свойства товара


// Скачиваемые файлы -->
$arMaterials = array();
if (!empty($arMaterailsIds)) {
    $arSelect = array('ID', 'NAME', 'PROPERTY_FILE');
    $arFilter = array("IBLOCK_ID" => MATERIALS, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        //$arFields['PROPERTIES'] = $ob->GetProperties();

        $arMaterials[$arFields['ID']] = array(
            'NAME' => $arFields['NAME'],
            'FILE_SRC' => CFile::GetPath($arFields['PROPERTY_FILE_VALUE'])
        );
    }
}
foreach ($arResult['ITEMS'] as &$arItem) {
    if (!empty($arItem['MATERIALS'])) {
        foreach ($arItem['MATERIALS']['IDS'] as $mId) {
            $arItem['MATERIALS']['FILES'][] = $arMaterials[$mId];
        }
    }
}
// <-- Скачиваемые файлы
