<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<section class="nb-section nb-doctors-section">
    <div class="container">
        <div class="nb-section__header">
            <h2 class="nb-section__title desktop">
                ВРАЧИ СЕТИ КЛИНИК <span class="font-weight_normal">«БЕЛЫЙ КРОЛИК»</span>
            </h2>
        </div>
        <div class="nb-section__body">
            <? $APPLICATION->IncludeComponent(
                "indexis:block.filter",
                "",
                array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "SHOW_FILTER" => "Y",
                    "IBLOCK_ID" => Indexis::getIblockId('our_doctors', 'our_doctors'),
                    "IBLOCK_TYPE" => "our_doctors",
                    "PREFILTER_NAME" => "arPreFilterDoctors",
                    "FILTER_NAME" => "arFilterDoctors",
                    "TEMPLATE" => 'tile'
                )
            ); ?>
        </div>
    </div>
</section>

