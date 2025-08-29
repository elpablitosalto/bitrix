<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-ec-is-section dp-kkm-ec-is-section_secret">
    <div class="dp-kkm-ec-is-section__inner">
        <div class="container">
            <div class="dp-section__subtitle">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_01.php",
                    )
                ); ?>
                </div>
            <h2 class="dp-section__title">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_02.php",
                    )
                ); ?>
                </h2>
            <div class="dp-kkm-ec-is__images"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/ec-6.png">
            </div>
            <div class="dp-kkm-ec-is__buttons">
                <button class="dp-btn" data-scroll-to="#kkm-rates">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_03.php",
                        )
                    ); ?>
                    </button>
                <button class="dp-btn dp-btn_white-outlined" data-modal="#consulting-application">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_04.php",
                        )
                    ); ?>
                    </button>
            </div>
        </div>
    </div>
</div>