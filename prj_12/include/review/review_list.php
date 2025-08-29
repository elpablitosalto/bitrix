<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

$arFilter = array(
    "IBLOCK_ID" => Indexis::getIblockId('reviews', 'our_doctors'),
    "ACTIVE" => "Y",
    "PROPERTY_DOCTORS" => $arParams["DOCTOR_ID"]
);

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/review"))
{
    $arDoctor = $obCache->GetVars();
}
elseif ($obCache->StartDataCache())
{
    $arDoctor = array();
    if (Loader::includeModule("iblock"))
    {
        $dbRes = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "PROPERTY_DOCTORS.NAME"));

        if(defined("BX_COMP_MANAGED_CACHE"))
        {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache("/iblock/review");

            if ($arDoctor = $dbRes->Fetch())
                $CACHE_MANAGER->RegisterTag("iblock_id_".Indexis::getIblockId('reviews', 'our_doctors'));

            $CACHE_MANAGER->EndTagCache();
        }
        else
        {
            if(!$arDoctor = $dbRes->Fetch())
                $arDoctor = array();
        }
    }
    $obCache->EndDataCache($arDoctor);
}
if (!isset($arDoctor))
    $arDoctor = array();
?>
<?if (!empty($arDoctor)):?>
    <section class="nb-section nb-reviews-section">
        <div class="container">
            <div class="nb-section__header">
                <h2 class="nb-section__title">Отзывы О РАБОТЕ врача и Примеры работ  <span class="font-weight_normal">#врач: <?=$arDoctor['PROPERTY_DOCTORS_NAME']?></span></h2>
            </div>
            <div class="nb-section__body">
                <? $APPLICATION->IncludeComponent(
                    "indexis:block.filter",
                    "reviews",
                    array(
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "N",
                        "SHOW_FILTER" => "Y",
                        "IBLOCK_ID" => Indexis::getIblockId('reviews', 'our_doctors'),
                        "IBLOCK_TYPE" => "our_doctors",
                        "PREFILTER_NAME" => $arParams['PREFILTER_NAME'],
                        "FILTER_NAME" => $arParams['FILTER_NAME'],
                    )
                ); ?>
            </div>
        </div>
    </section>
<?endif;?>