<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $frame = $this->createFrame()->begin(); ?>
<?
if (strlen($arResult["ERROR_MESSAGE"]) > 0) {
    ShowError($arResult["ERROR_MESSAGE"]);
}
?>
<? if (count($arResult["STORES"]) > 0): ?>
    <?
    // get shops
    $arShops = array();
    CModule::IncludeModule('iblock');
    $dbRes = CIBlock::GetList(array(), array('CODE' => 'aspro_mshop_shops', 'ACTIVE' => 'Y', 'SITE_ID' => SITE_ID));
    if ($arShospIblock = $dbRes->Fetch()) {
        $dbRes = CIBlockElement::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arShospIblock['ID']), false, false, array('ID', 'DETAIL_PAGE_URL', 'PROPERTY_STORE_ID'));
        while ($arShop = $dbRes->GetNext()) {
            $arShops[$arShop['PROPERTY_STORE_ID_VALUE']] = $arShop;
        }
    }
    ?>
    <div class="stores_block_wrap">
        <? $empty_count = 0;
        $count_stores = count($arResult["STORES"]);
        $sStoreType = \Bitrix\Main\Config\Option::get('aspro.mshop', 'STORES_SOURCE', 'IBLOCK'); ?>
        <? foreach ($arResult["STORES"] as $pid => $arProperty):
            if ($arParams['SHOW_EMPTY_STORE'] == 'N' && $arProperty['AMOUNT'] <= 0)
                $empty_count++; ?>
            <?
            $totalCount = CMShop::CheckTypeCount($arProperty["NUM_AMOUNT"]);
            $arQuantityData = CMShop::GetQuantityArray($totalCount);
            ?>
            <? if (strlen($arQuantityData["TEXT"])):?>
                <?= $arQuantityData["HTML"] ?>
            <? endif; ?>
        <? endforeach; ?>

    </div>
<? endif; ?>