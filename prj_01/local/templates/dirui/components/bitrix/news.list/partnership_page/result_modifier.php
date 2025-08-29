<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

foreach ($arResult["ITEMS"] as &$item) {
    if (!is_array($item["DISPLAY_PROPERTIES"]["SECT_DESC"]["DISPLAY_VALUE"])) {
        if (!empty($item["DISPLAY_PROPERTIES"]["SECT_DESC"]["DISPLAY_VALUE"])) {
            $item["DISPLAY_PROPERTIES"]["SECT_DESC"]["DISPLAY_VALUE"] = array($item["DISPLAY_PROPERTIES"]["SECT_DESC"]["DISPLAY_VALUE"]);
        }
    }

    // Контактное лицо -->
    $item['CONTACT_USER'] = array();
    //vardump($item["DISPLAY_PROPERTIES"]["CONTACT_USER"]);
    if (!empty($item["DISPLAY_PROPERTIES"]["CONTACT_USER"]["VALUE"])) {
        $rsUser = CUser::GetByID($item["DISPLAY_PROPERTIES"]["CONTACT_USER"]["VALUE"]);
        $arUser = $rsUser->Fetch();
        //vardump($arUser);

        // ФИО -->
        $item['CONTACT_USER']['FIO'] = '';
        if (strlen($arUser['LAST_NAME']) > 0) {
            $item['CONTACT_USER']['FIO'] = $arUser['LAST_NAME'];
        }
        if (strlen($arUser['NAME']) > 0) {
            if (strlen($item['CONTACT_USER']['FIO']) > 0) {
                $item['CONTACT_USER']['FIO'] .= ' ';
            }
            $item['CONTACT_USER']['FIO'] .= $arUser['NAME'];
        }
        if (strlen($arUser['SECOND_NAME']) > 0 && strlen($item['CONTACT_USER']['FIO']) > 0) {
            if (strlen($item['CONTACT_USER']['FIO']) > 0) {
                $item['CONTACT_USER']['FIO'] .= ' ';
            }
            $item['CONTACT_USER']['FIO'] .= $arUser['SECOND_NAME'];
        }
        // <-- ФИО

        $item['CONTACT_USER']['EMAIL'] = $arUser['EMAIL'];
        $item['CONTACT_USER']['PERSONAL_PHONE'] = $arUser['PERSONAL_PHONE'];
        $item['CONTACT_USER']['PERSONAL_PHONE_DIGITS'] = preg_replace("/[^,.0-9]/", '', $arUser['PERSONAL_PHONE']);

        // Фото -->
        if (!empty($arUser['PERSONAL_PHOTO'])) {
            $arFile = CFile::GetFileArray($arUser['PERSONAL_PHOTO']);
            //vardump($arFile);
            $arResultLocal = Indexis::getImageFormatted(array(
                'RESIZE' => 'N',
                'FILE_VALUE' => $arFile,
                'NO_IMAGE_DEFAULT' => $this->GetFolder() . '/images/reviewer-thumb.png',
                //'WIDTH' => 576,
                //'HEIGHT' => 5000,
                'DEFAULT_ALT_TITLE' => $item['CONTACT_USER']['FIO']
            ));
            $item['CONTACT_USER']['PICTURE'] = $arResultLocal['PICTURE'];
        }
        // <-- Фото
    }
    // <-- Контактное лицо
}
