<?

use Hair\General;

if (!empty($arResult['ITEMS'])) {
    $arProductOptionsIds = array();

    // -->
    $arMaterials = array();
    $arSelect = array("ID", "NAME", "PROPERTY_FILE");
    $arFilter = array("IBLOCK_ID" => MATERIALS, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        //$arFields['PROPERTIES'] = $ob->GetProperties();

        $arMaterials[$arFields['ID']] = array(
            'NAME' => $arFields['NAME'],
            'LINK' => CFile::GetPath($arFields['PROPERTY_FILE_VALUE']),
        );
    }
    // <--

    // -->
    $arProductSections = [
        "PRODUCT_TYPE" => array(
            "TITLE" => GetMessage('NEWS_LIST_SECTION_PAGE_LIST_SECTIONS_PRODUCT_TYPE'),
            "SVG" => '<svg class="icon-panel__icon" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.8312 21.9635C20.8322 21.934 20.8333 21.9045 20.8333 21.875C20.8333 21.4325 20.6898 21.0063 20.4304 20.6533C20.6929 20.2397 20.8333 19.7626 20.8333 19.2708C20.8333 17.835 19.6654 16.6667 18.2291 16.6667C17.7632 16.6667 17.3125 16.7913 16.9158 17.0242C16.2312 16.1494 15.1824 15.625 14.0624 15.625C13.0838 15.625 12.1571 16.0228 11.4705 16.7267C9.81538 16.361 8.33325 17.6605 8.33325 19.2708C8.33325 20.5287 9.22944 21.5811 10.4176 21.8226C10.4166 21.8404 10.4166 21.8577 10.4166 21.875C10.4166 22.9416 11.2223 23.8235 12.2568 23.9441C12.622 24.588 13.3076 25 14.0624 25C14.8162 25 15.5039 24.5824 15.867 23.942C16.0521 23.9629 16.2332 23.9654 16.4224 23.9405C16.7856 24.5819 17.4732 25 18.2291 25C18.6329 25 19.0246 24.8805 19.3582 24.6618C19.6278 24.8774 19.9625 25 20.3124 25C21.174 25 21.8749 24.2991 21.8749 23.4375C21.8749 22.758 21.4385 22.1781 20.8312 21.9635Z"/><path d="M9.51846 22.8139C9.47676 22.6822 9.38521 22.5723 9.26211 22.5083C8.04648 21.8765 7.2917 20.636 7.2917 19.2708C7.2917 17.2607 8.92744 15.625 10.9548 15.625C11.0678 15.625 11.1786 15.5879 11.2682 15.5197C11.8063 15.1138 12.4319 14.8351 13.1267 14.6917C13.3678 14.6414 13.5417 14.4288 13.5417 14.1815V7.8125C13.5417 6.36367 12.6856 5.11987 11.4584 4.53237V0.52085C11.4584 0.232959 11.2254 0 10.9375 0H5.72915C5.44126 0 5.2083 0.232959 5.2083 0.52085V4.53237C3.9811 5.11987 3.125 6.36367 3.125 7.8125V22.9167C3.125 24.0657 4.05986 25 5.20835 25H9.96299C10.1746 25 10.3658 24.8718 10.4452 24.6755C10.5255 24.4792 10.4788 24.2543 10.3261 24.1063C9.94873 23.7376 9.66899 23.2905 9.51846 22.8139Z"/></svg>',
        ),
        "PRODUCT_FEATURE" => array(
            'TITLE' => GetMessage('NEWS_LIST_SECTION_PAGE_LIST_SECTIONS_PRODUCT_FEATURE'),
            'SVG' => '<svg class="icon-panel__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2044 3.6114C11.8698 3.6114 12.4091 3.07205 12.4091 2.40672C12.4091 1.74138 11.8698 1.20203 11.2044 1.20203C10.5391 1.20203 9.99976 1.74138 9.99976 2.40672C9.99976 3.07205 10.5391 3.6114 11.2044 3.6114Z"/><path d="M13.6143 1.9278C14.1466 1.9278 14.5782 1.49625 14.5782 0.9639C14.5782 0.431553 14.1466 0 13.6143 0C13.0819 0 12.6504 0.431553 12.6504 0.9639C12.6504 1.49625 13.0819 1.9278 13.6143 1.9278Z"/><path d="M17.6625 16.4452L12.6503 8.43093V6.02416H14.0961V4.33752H5.90332V6.02416H7.34917V8.43093L2.33697 16.4452C2.15321 16.7859 2.0481 17.1754 2.0481 17.5902C2.0481 18.9209 3.1268 20 4.45785 20H15.542C16.8726 20 17.9517 18.9213 17.9517 17.5902C17.9517 17.1754 17.8466 16.7859 17.6625 16.4452ZM6.17393 13.4908L9.03581 8.91475V6.02379H10.9636V8.91475L13.8255 13.4908H6.17393Z"/></svg>',
        ),
        "PRODUCT_PROPS" => array(
            'TITLE' => GetMessage('NEWS_LIST_SECTION_PAGE_LIST_SECTIONS_PRODUCT_PROPS'),
            'SVG' => '<svg class="icon-panel__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2044 3.6114C11.8698 3.6114 12.4091 3.07205 12.4091 2.40672C12.4091 1.74138 11.8698 1.20203 11.2044 1.20203C10.5391 1.20203 9.99976 1.74138 9.99976 2.40672C9.99976 3.07205 10.5391 3.6114 11.2044 3.6114Z"/><path d="M13.6143 1.9278C14.1466 1.9278 14.5782 1.49625 14.5782 0.9639C14.5782 0.431553 14.1466 0 13.6143 0C13.0819 0 12.6504 0.431553 12.6504 0.9639C12.6504 1.49625 13.0819 1.9278 13.6143 1.9278Z"/><path d="M17.6625 16.4452L12.6503 8.43093V6.02416H14.0961V4.33752H5.90332V6.02416H7.34917V8.43093L2.33697 16.4452C2.15321 16.7859 2.0481 17.1754 2.0481 17.5902C2.0481 18.9209 3.1268 20 4.45785 20H15.542C16.8726 20 17.9517 18.9213 17.9517 17.5902C17.9517 17.1754 17.8466 16.7859 17.6625 16.4452ZM6.17393 13.4908L9.03581 8.91475V6.02379H10.9636V8.91475L13.8255 13.4908H6.17393Z"/></svg>',
        ),
        "PRODUCT_COMPOSITION" => array(
            'TITLE' => GetMessage('NEWS_LIST_SECTION_PAGE_LIST_SECTIONS_PRODUCT_COMPOSITION'),
            'SVG' => '<svg class="icon-panel__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2044 3.6114C11.8698 3.6114 12.4091 3.07205 12.4091 2.40672C12.4091 1.74138 11.8698 1.20203 11.2044 1.20203C10.5391 1.20203 9.99976 1.74138 9.99976 2.40672C9.99976 3.07205 10.5391 3.6114 11.2044 3.6114Z"/><path d="M13.6143 1.9278C14.1466 1.9278 14.5782 1.49625 14.5782 0.9639C14.5782 0.431553 14.1466 0 13.6143 0C13.0819 0 12.6504 0.431553 12.6504 0.9639C12.6504 1.49625 13.0819 1.9278 13.6143 1.9278Z"/><path d="M17.6625 16.4452L12.6503 8.43093V6.02416H14.0961V4.33752H5.90332V6.02416H7.34917V8.43093L2.33697 16.4452C2.15321 16.7859 2.0481 17.1754 2.0481 17.5902C2.0481 18.9209 3.1268 20 4.45785 20H15.542C16.8726 20 17.9517 18.9213 17.9517 17.5902C17.9517 17.1754 17.8466 16.7859 17.6625 16.4452ZM6.17393 13.4908L9.03581 8.91475V6.02379H10.9636V8.91475L13.8255 13.4908H6.17393Z"/></svg>',
        ),
        "PRODUCT_UNIQUE" => array(
            'TITLE' => GetMessage('NEWS_LIST_SECTION_PAGE_LIST_SECTIONS_PRODUCT_UNIQUE'),
            'SVG' => '<svg class="icon-panel__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2044 3.6114C11.8698 3.6114 12.4091 3.07205 12.4091 2.40672C12.4091 1.74138 11.8698 1.20203 11.2044 1.20203C10.5391 1.20203 9.99976 1.74138 9.99976 2.40672C9.99976 3.07205 10.5391 3.6114 11.2044 3.6114Z"/><path d="M13.6143 1.9278C14.1466 1.9278 14.5782 1.49625 14.5782 0.9639C14.5782 0.431553 14.1466 0 13.6143 0C13.0819 0 12.6504 0.431553 12.6504 0.9639C12.6504 1.49625 13.0819 1.9278 13.6143 1.9278Z"/><path d="M17.6625 16.4452L12.6503 8.43093V6.02416H14.0961V4.33752H5.90332V6.02416H7.34917V8.43093L2.33697 16.4452C2.15321 16.7859 2.0481 17.1754 2.0481 17.5902C2.0481 18.9209 3.1268 20 4.45785 20H15.542C16.8726 20 17.9517 18.9213 17.9517 17.5902C17.9517 17.1754 17.8466 16.7859 17.6625 16.4452ZM6.17393 13.4908L9.03581 8.91475V6.02379H10.9636V8.91475L13.8255 13.4908H6.17393Z"/></svg>',
        ),
    ];
    // <--

    foreach ($arResult['ITEMS'] as &$arItem) {
        $arItem["PRODUCT_VARIANTS"] = false;
        if (!empty($arItem["PROPERTIES"]["ACTIVE_SUBSTANCE"]["VALUE"])) {
            $arItem["PRODUCT_VARIANTS"] = General::infinityGetProductVariantsEn($arItem["ID"], "ACTIVE_SUBSTANCE");
        } elseif (!empty($arItem["PROPERTIES"]["PACK_VOLUME"]["VALUE"])) {
            $arItem["PRODUCT_VARIANTS"] = General::infinityGetProductVariantsEn($arItem["ID"], "PACK_VOLUME");
        } elseif (!empty($arItem["PROPERTIES"]["FIXATION_STRENGTH"]["VALUE"])) {
            $arItem["PRODUCT_VARIANTS"] = General::infinityGetProductVariantsEn($arItem["ID"], "FIXATION_STRENGTH");
        }


        // Слайдер -->
        $arItem["PRODUCT_GALLERY"] = [];
        if (!empty($arItem['DETAIL_PICTURE'])) {
            //$arItem["PRODUCT_GALLERY"][] = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);

            // Изображение -->
            if (is_array($arItem["DETAIL_PICTURE"])) {
                $arFile = $arItem["DETAIL_PICTURE"];
            } else {
                $arFile = CFile::GetFileArray($arItem["DETAIL_PICTURE"]);
            }
            $arResultLocal = getImageFormatted(array(
                'RESIZE' => 'Y',
                'FILE_VALUE' => $arFile,
                'WIDTH' => 1000,
                'HEIGHT' => 1000,
                'DEFAULT_ALT_TITLE' => $arItem['NAME']
            ));
            $arItem["PRODUCT_GALLERY"][] = $arResultLocal['PICTURE'];
            // <-- Изображение
        }
        if (!empty($arItem['PROPERTIES']['PRODUCT_PHOTOS']['VALUE'])) {
            if (!is_array($arItem['PROPERTIES']['PRODUCT_PHOTOS']['VALUE'])) {
                $arItem['PROPERTIES']['PRODUCT_PHOTOS']['VALUE'] = array($arItem['PROPERTIES']['PRODUCT_PHOTOS']['VALUE']);
            }
            foreach ($arItem['PROPERTIES']['PRODUCT_PHOTOS']['VALUE'] as $image) {
                //$arItem["PRODUCT_GALLERY"][] = CFile::ResizeImageGet($image, array('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);

                // Изображение -->
                if (is_array($image)) {
                    $arFile = $image;
                } else {
                    $arFile = CFile::GetFileArray($image);
                }
                $arResultLocal = getImageFormatted(array(
                    'RESIZE' => 'Y',
                    'FILE_VALUE' => $arFile,
                    'WIDTH' => 1000,
                    'HEIGHT' => 1000,
                    'DEFAULT_ALT_TITLE' => $arItem['NAME']
                ));
                $arItem["PRODUCT_GALLERY"][] = $arResultLocal['PICTURE'];
                // <-- Изображение
            }
        }
        // <--

        // Маркетплейсы
        $marketplaces = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_ID" => 43,
                "ACTIVE" => "Y",
            ),
            false,
            array()
        );
        $marketplaceArray = [];
        $arItem['MARKETPLACE_LINKS'] = [];
        while ($marketplace = $marketplaces->GetNextElement()) {
            $marketplaceFields = $marketplace->GetFields();
            $marketplaceProperties = $marketplace->GetProperties();
            $arItem['MARKETPLACE_LINKS'][$marketplaceFields["CODE"]] = array(
                "ID" => $marketplaceFields["ID"],
                "NAME" => $marketplaceFields["NAME"],
                "CODE" => $marketplaceFields["CODE"],
                "LOGO" => CFile::ResizeImageGet($marketplaceFields["DETAIL_PICTURE"], array('width' => 126, 'height' => 70), BX_RESIZE_IMAGE_PROPORTIONAL, true),
                "URL" => $marketplaceProperties["URL"]["VALUE"],
                "URL_MATCH" => $marketplaceProperties["URL_MATCH"]["VALUE"],
            );
        }

        // Основной раздел
        $arItem["ROOT_SECTION"] = [];
        $rsRootSection = \CIBlockSection::GetNavChain($arItem["IBLOCK_ID"], $arItem['IBLOCK_SECTION_ID']);
        if ($arRootSection = $rsRootSection->Fetch()) {
            $arItem["ROOT_SECTION"] = \CIBlockSection::GetList(
                ["ID" => "ASC"],
                ["IBLOCK_ID" => $arRootSection["IBLOCK_ID"], "ID" => $arRootSection['ID']],
                false,
                ["*", "UF_*"]
            )->Fetch();
        }

        // Материалы для скачивания -->
        $arProductDownloadsPropsParams = array(
            array(
                'CODE' => 'PALLETTE',
                'SVG' => '<svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M7.99996 10.6667C7.8633 10.6667 7.73263 10.6107 7.63863 10.512L4.13863 6.84537C3.8353 6.52804 4.06063 6.00004 4.49996 6.00004H6.3333V2.16671C6.3333 1.70737 6.7073 1.33337 7.16663 1.33337H8.8333C9.29263 1.33337 9.66663 1.70737 9.66663 2.16671V6.00004H11.5C11.9393 6.00004 12.1646 6.52804 11.8613 6.84537L8.3613 10.512C8.2673 10.6107 8.13663 10.6667 7.99996 10.6667Z" />
                                                                            <path d="M14.8333 14.6667H1.16667C0.523333 14.6667 0 14.1433 0 13.5V13.1667C0 12.5233 0.523333 12 1.16667 12H14.8333C15.4767 12 16 12.5233 16 13.1667V13.5C16 14.1433 15.4767 14.6667 14.8333 14.6667Z" />
                                                                        </svg>',
                'TITLE' => GetMessage('NEWS_LIST_SECTION_PAGE_LIST_DOWNLOADS_PALETTE'),
            ),
            array(
                'CODE' => 'INSTRUCTION',
                'SVG' => '<svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M14.3125 4.53125H1.6875C0.912094 4.53125 0.28125 5.16209 0.28125 5.9375V11.5625C0.28125 12.3379 0.912094 12.9688 1.6875 12.9688H14.3125C15.0879 12.9688 15.7188 12.3379 15.7188 11.5625V5.9375C15.7188 5.16209 15.0879 4.53125 14.3125 4.53125ZM3.99191 9.47931C3.87206 9.47931 3.66731 9.48016 3.47566 9.48112V10.5623C3.47566 10.8212 3.26578 11.031 3.00691 11.031C2.74803 11.031 2.53816 10.8212 2.53816 10.5623L2.53125 7.0015C2.53084 6.87694 2.58006 6.75731 2.668 6.66906C2.75594 6.58081 2.87544 6.53125 3 6.53125H3.99191C4.81553 6.53125 5.48562 7.1925 5.48562 8.00528C5.48562 8.81806 4.81553 9.47931 3.99191 9.47931ZM8.01591 10.918C7.73672 10.9229 7.03838 10.9255 7.00878 10.9257C7.00819 10.9257 7.00759 10.9257 7.007 10.9257C6.88331 10.9257 6.76459 10.8768 6.67678 10.7896C6.58853 10.702 6.53872 10.5829 6.53825 10.4586C6.53822 10.4461 6.53125 7.00091 6.53125 7.00091C6.53103 6.87644 6.58028 6.75697 6.66822 6.66888C6.75616 6.58078 6.87553 6.53125 7 6.53125H7.97906C9.09444 6.53125 9.84381 7.41425 9.84381 8.72847C9.84381 9.97866 9.07506 10.8995 8.01591 10.918ZM12.8194 8.22969C13.0782 8.22969 13.2881 8.43956 13.2881 8.69844C13.2881 8.95731 13.0782 9.16719 12.8194 9.16719H11.9688V10.5C11.9688 10.7589 11.7589 10.9688 11.5 10.9688C11.2411 10.9688 11.0312 10.7589 11.0312 10.5V6.96381C11.0312 6.70494 11.2411 6.49506 11.5 6.49506H12.9332C13.1921 6.49506 13.402 6.70494 13.402 6.96381C13.402 7.22269 13.1921 7.43256 12.9332 7.43256H11.9688V8.22969H12.8194Z" />
                                                                        <path d="M7.97895 7.46875H7.46948C7.4702 7.89187 7.47276 9.57856 7.47408 9.98572C7.66914 9.98447 7.87801 9.98275 7.99942 9.98063C8.62582 9.96969 8.90622 9.34384 8.90622 8.72847C8.90619 8.43294 8.83935 7.46875 7.97895 7.46875Z" />
                                                                        <path d="M3.99196 7.46875H3.47021C3.47078 7.67734 3.47131 7.89925 3.47131 8.00528C3.47131 8.12919 3.47218 8.34409 3.47318 8.54366C3.66556 8.54269 3.87106 8.54181 3.992 8.54181C4.2935 8.54181 4.54822 8.29613 4.54822 8.00528C4.54822 7.71444 4.29347 7.46875 3.99196 7.46875Z" />
                                                                        <path d="M13.8267 3.59375C13.7181 3.29594 13.5493 3.02069 13.3259 2.785L11.3788 0.731219C10.9383 0.266531 10.3183 0 9.67797 0H3.4375C2.66209 0 2.03125 0.630844 2.03125 1.40625V3.59375H13.8267Z" />
                                                                        <path d="M2.03125 13.9062V14.5938C2.03125 15.3692 2.66209 16 3.4375 16H12.5625C13.3379 16 13.9688 15.3692 13.9688 14.5938V13.9062H2.03125Z" />
                                                                    </svg>',
                'TITLE' => GetMessage('NEWS_LIST_SECTION_PAGE_LIST_DOWNLOADS_CATALOG'),
            ),
            array(
                'CODE' => 'PROMOTIONAL_MATERIALS',
                'SVG' => '<svg class="icon-link__icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M14.3125 4.53125H1.6875C0.912094 4.53125 0.28125 5.16209 0.28125 5.9375V11.5625C0.28125 12.3379 0.912094 12.9688 1.6875 12.9688H14.3125C15.0879 12.9688 15.7188 12.3379 15.7188 11.5625V5.9375C15.7188 5.16209 15.0879 4.53125 14.3125 4.53125ZM3.99191 9.47931C3.87206 9.47931 3.66731 9.48016 3.47566 9.48112V10.5623C3.47566 10.8212 3.26578 11.031 3.00691 11.031C2.74803 11.031 2.53816 10.8212 2.53816 10.5623L2.53125 7.0015C2.53084 6.87694 2.58006 6.75731 2.668 6.66906C2.75594 6.58081 2.87544 6.53125 3 6.53125H3.99191C4.81553 6.53125 5.48562 7.1925 5.48562 8.00528C5.48562 8.81806 4.81553 9.47931 3.99191 9.47931ZM8.01591 10.918C7.73672 10.9229 7.03838 10.9255 7.00878 10.9257C7.00819 10.9257 7.00759 10.9257 7.007 10.9257C6.88331 10.9257 6.76459 10.8768 6.67678 10.7896C6.58853 10.702 6.53872 10.5829 6.53825 10.4586C6.53822 10.4461 6.53125 7.00091 6.53125 7.00091C6.53103 6.87644 6.58028 6.75697 6.66822 6.66888C6.75616 6.58078 6.87553 6.53125 7 6.53125H7.97906C9.09444 6.53125 9.84381 7.41425 9.84381 8.72847C9.84381 9.97866 9.07506 10.8995 8.01591 10.918ZM12.8194 8.22969C13.0782 8.22969 13.2881 8.43956 13.2881 8.69844C13.2881 8.95731 13.0782 9.16719 12.8194 9.16719H11.9688V10.5C11.9688 10.7589 11.7589 10.9688 11.5 10.9688C11.2411 10.9688 11.0312 10.7589 11.0312 10.5V6.96381C11.0312 6.70494 11.2411 6.49506 11.5 6.49506H12.9332C13.1921 6.49506 13.402 6.70494 13.402 6.96381C13.402 7.22269 13.1921 7.43256 12.9332 7.43256H11.9688V8.22969H12.8194Z" />
                                                                        <path d="M7.97895 7.46875H7.46948C7.4702 7.89187 7.47276 9.57856 7.47408 9.98572C7.66914 9.98447 7.87801 9.98275 7.99942 9.98063C8.62582 9.96969 8.90622 9.34384 8.90622 8.72847C8.90619 8.43294 8.83935 7.46875 7.97895 7.46875Z" />
                                                                        <path d="M3.99196 7.46875H3.47021C3.47078 7.67734 3.47131 7.89925 3.47131 8.00528C3.47131 8.12919 3.47218 8.34409 3.47318 8.54366C3.66556 8.54269 3.87106 8.54181 3.992 8.54181C4.2935 8.54181 4.54822 8.29613 4.54822 8.00528C4.54822 7.71444 4.29347 7.46875 3.99196 7.46875Z" />
                                                                        <path d="M13.8267 3.59375C13.7181 3.29594 13.5493 3.02069 13.3259 2.785L11.3788 0.731219C10.9383 0.266531 10.3183 0 9.67797 0H3.4375C2.66209 0 2.03125 0.630844 2.03125 1.40625V3.59375H13.8267Z" />
                                                                        <path d="M2.03125 13.9062V14.5938C2.03125 15.3692 2.66209 16 3.4375 16H12.5625C13.3379 16 13.9688 15.3692 13.9688 14.5938V13.9062H2.03125Z" />
                                                                    </svg>',
                'TITLE' => GetMessage('NEWS_LIST_SECTION_PAGE_LIST_DOWNLOADS_INSTRUCTIONS'),
            ),
        );
        foreach ($arProductDownloadsPropsParams as $arDownloadParams) {
            switch ($arDownloadParams['CODE']) {
                case 'PALLETTE':
                    if (!empty($arItem['PROPERTIES']['PALLETTE']['VALUE'])) {
                        $fileSrc = CFile::GetPath($arItem['PROPERTIES']['PALLETTE']['VALUE']);
                        $ar = $arDownloadParams;
                        $ar['LINK'] = $fileSrc;
                        $arItem['DOWNLOADS']['PALLETTE']['VALUES'][] = $ar;
                    }
                    break;
                case 'INSTRUCTION':
                    foreach ($arItem['PROPERTIES']['INSTRUCTION']['VALUE'] as $itemId) {
                        if (!empty($arMaterials[$itemId])) {
                            $arItem['DOWNLOADS']['INSTRUCTION']['VALUES'][] = array(
                                'CODE' => $arDownloadParams['CODE'],
                                'SVG' => $arDownloadParams['SVG'],
                                'TITLE' => $arMaterials[$itemId]['NAME'],
                                'LINK' => $arMaterials[$itemId]['LINK'],
                            );
                        }
                    }
                    break;
                case 'PROMOTIONAL_MATERIALS':
                    foreach ($arItem['PROPERTIES']['PROMOTIONAL_MATERIALS']['VALUE'] as $itemId) {
                        if (!empty($arMaterials[$itemId])) {
                            $arItem['DOWNLOADS']['PROMOTIONAL_MATERIALS']['VALUES'][] = array(
                                'CODE' => $arDownloadParams['CODE'],
                                'SVG' => $arDownloadParams['SVG'],
                                'TITLE' => $arMaterials[$itemId]['NAME'],
                                'LINK' => $arMaterials[$itemId]['LINK'],
                            );
                        }
                    }
                    break;
            }
        }
        // <-- Материалы для скачивания

        //vardump($arItem['DOWNLOADS']);

        // -->
        $arItem['FEATURE_SECTIONS'] = array();
        foreach ($arProductSections as $productSectionCode => $productSectionName) {
            if (!empty($arItem['PROPERTIES'][$productSectionCode]['VALUE'])) {
                $arDisplayProp = CIBlockFormatProperties::GetDisplayValue($arProduct, $arItem['PROPERTIES'][$productSectionCode]);

                //$file_content = file_get_contents($_SERVER["DOCUMENT_ROOT"] . General::getProductPropertycon($productSectionCode));

                $value = $arDisplayProp['DISPLAY_VALUE'];
                if (!is_array($value)) {
                    $value = array($value);
                }

                $arItem['FEATURE_SECTIONS'][] = array(
                    "FILE_CONTENT" => $productSectionName['SVG'],
                    "TITLE" => $productSectionName['TITLE'],
                    "VALUE" => $value
                );
            }
        }
        // <--

        // -->
        //vardump($arItem['PROPERTIES']['PRODUCT_OPTIONS']);
        if (!empty($arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'])) {
            if (!is_array($arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'])) {
                $arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE'] = array($arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE']);
            }
            $arProductOptionsIds = array_merge($arProductOptionsIds, $arItem['PROPERTIES']['PRODUCT_OPTIONS']['VALUE']);
        }
        // <--

        // -->
        if (!empty($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE']) && !is_array($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE'])) {
            $arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE'] = array($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['VALUE']);
            $arItem['PROPERTIES']['TEXT_WITH_HEADERS']['DESCRIPTION'] = array($arItem['PROPERTIES']['TEXT_WITH_HEADERS']['DESCRIPTION']);
        }
        // <--
    }

    // Product options -->
    $arProductOptions = array();
    //vardump($arProductOptionsIds);
    if (!empty($arProductOptionsIds)) {
        $arSelect = false;
        $arFilter = [
            'IBLOCK_ID' => INFINITY_CATALOG_EN_VARS_IB_ID,
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
    //vardump($arProductOptions);
    foreach ($arResult['ITEMS'] as &$arItem) {
        if (!empty($arProductOptions[$arItem['ID']]['PRODUCT_OPTIONS'])) {
            $arItem['PRODUCT_OPTIONS'] = $arProductOptions[$arItem['ID']]['PRODUCT_OPTIONS'];
            //vardump($arItem['PRODUCT_OPTIONS']);
        }
    }
    // <-- Product options
}
