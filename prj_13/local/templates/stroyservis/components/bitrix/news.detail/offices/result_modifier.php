<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


// Фотографии офиса -->
if (!empty($arResult['DISPLAY_PROPERTIES']['OFFICE_PHOTO']['FILE_VALUE'])) {
    $fileValues = (isset($arResult['DISPLAY_PROPERTIES']['OFFICE_PHOTO']['FILE_VALUE']['ID']) ?
        array(0 => $arResult['DISPLAY_PROPERTIES']['OFFICE_PHOTO']['FILE_VALUE']) :
        $arResult['DISPLAY_PROPERTIES']['OFFICE_PHOTO']['FILE_VALUE']
    );
    foreach ($fileValues as $key => $photo) {
        $arResultLocal = Indexis::getImageFormatted( array(
			'RESIZE' => 'N',
			'FILE_VALUE' => $photo,
			'WIDTH' => 1468,
			'HEIGHT' => 1000,
			'DEFAULT_ALT_TITLE' => $arResult['NAME']
		));
		$arResult['PICTURES'][] = $arResultLocal['PICTURE'];
    }
}
// <-- 
