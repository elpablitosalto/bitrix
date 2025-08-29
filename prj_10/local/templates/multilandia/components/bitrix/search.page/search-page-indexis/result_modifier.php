<?
if(!CModule::IncludeModule("iblock"))
    return;
$search = array();
$movies = 0;
$contests = 0;
$about = 0;
$about_block = array();
$partners_block = array();
//echo '<pre>' . print_r($arResult['SEARCH'], true) . '</pre>';
foreach($arResult['SEARCH'] as $search_item){
    if($search_item['MODULE_ID'] == 'main'){
        $search_item['URL'] = str_replace('content.php', '', $search_item['URL']);
        $search_item['~URL'] = str_replace('content.php', '', $search_item['URL']);
        $about++;
        if(stripos($search_item['URL'], '/about/') === 0){
            $about_block[] = $search_item;
        } elseif(stripos($search_item['URL'], '/partners/') === 0){
            $partners_block[] = $search_item;
        }
    } elseif($search_item['MODULE_ID'] == 'iblock') {
        if($search_item['PARAM1'] == 'movies') {
            $res = CIBlockElement::GetByID($search_item['ITEM_ID']);
            if ($ar_res = $res->GetNext()) {
                $search_item['NAME'] = $ar_res['NAME'];
                $search_item['PREVIEW_PICTURE'] = $ar_res['PREVIEW_PICTURE'];
                $search_item['DETAIL_PAGE_URL'] = $ar_res['DETAIL_PAGE_URL'];
            }

            if (!empty($search_item['PREVIEW_PICTURE'])) {
                $search_item['PREVIEW_PICTURE'] = CFile::GetPath($search_item['PREVIEW_PICTURE']);
            }

            $search_item['PROPERTIES'] = array();


            $arFilter = array("IBLOCK_ID" => $search_item['PARAM2'], "ID" => $search_item['ITEM_ID']);
            $res = CIBlockElement::GetList(array(), $arFilter);
            if ($ob = $res->GetNextElement()) {
                $arProps = $ob->GetProperties();
                $search_item['PROPERTIES'] = $arProps;
            }

            if ($search_item['PARAM1'] == 'movies') {
                $movies++;
            }
        } elseif($search_item['PARAM1'] == 'contests'){
            $res = CIBlockElement::GetByID($search_item['ITEM_ID']);
            if ($ar_res = $res->GetNext()) {
                $search_item['NAME'] = $ar_res['NAME'];
                $search_item['PREVIEW_PICTURE'] = $ar_res['PREVIEW_PICTURE'];
                $search_item['DETAIL_PAGE_URL'] = $ar_res['DETAIL_PAGE_URL'];
            }

            if (!empty($search_item['PREVIEW_PICTURE'])) {
                $search_item['PREVIEW_PICTURE'] = CFile::GetPath($search_item['PREVIEW_PICTURE']);
            }

            $search_item['PROPERTIES'] = array();


            $arFilter = array("IBLOCK_ID" => $search_item['PARAM2'], "ID" => $search_item['ITEM_ID']);
            $res = CIBlockElement::GetList(array(), $arFilter);
            if ($ob = $res->GetNextElement()) {
                $arProps = $ob->GetProperties();
                $search_item['PROPERTIES'] = $arProps;
            }

            if ($search_item['PARAM1'] == 'contests') {
                $contests++;
            }
        }
    }

    $search[] = $search_item;
}

$arResult['SEARCH'] = $search;
$arResult['MOVIES_COUNT'] = $movies;
$arResult['CONTESTS_COUNT'] = $contests;
$arResult['ABOUT_COUNT'] = $about;
$arResult['ABOUT_BLOCK'] = $about_block;
$arResult['PARTNERS_BLOCK'] = $partners_block;

//echo '<pre>' . print_r($arResult['SEARCH'], true) . '</pre>';
?>