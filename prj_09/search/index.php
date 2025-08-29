<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
?>
<div class="section__search">
    <? $APPLICATION->IncludeComponent(
        "waim:search",
        "catalog_promo",
        array(
            'GROUPS' => array(
                array(
                    'IBLOCK_ID' => CATALOG_IB_ID,
                    'CODE' => 'catalog',
                    'NAME' => 'Товары',
                    'TEMPALTE_PAGE' => 'catalog'
                ),
                array(
                    'IBLOCK_ID' => PROMO_IB_ID,
                    'CODE' => 'promo',
                    'NAME' => 'Акции',
                    'TEMPALTE_PAGE' => 'promo'
                )
            ),
            'RESULT_LABEL' => array(
                'ONE' => 'результат',
                'FOUR' => 'результата',
                'FIVE' => 'результатов'
            ),
            'SHOW_TYPE' => 'ALL'
        )
    ); ?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>