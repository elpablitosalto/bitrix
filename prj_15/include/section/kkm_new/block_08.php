<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-summary-section">
    <div class="container">
        <h2 class="dp-section__title">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_01.php",
                )
            ); ?>
        </h2>
        <div class="dp-items-list">
            <div class="dp-list-item">
                <div class="dp-kkm-summary-item dp-kkm-summary-item_skills">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_02.php",
                        )
                    ); ?>
                </div>
            </div>
            <div class="dp-list-item">
                <div class="dp-kkm-summary-item dp-kkm-summary-item_management">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_03.php",
                        )
                    ); ?>
                </div>
            </div>
            <div class="dp-list-item">
                <div class="dp-kkm-summary-item dp-kkm-summary-item_partnership">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_04.php",
                        )
                    ); ?>
                </div>
            </div>
        </div>
        <div class="dp-section__subtitle">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_05.php",
                )
            ); ?>
        </div>
        <div class="dp-buttons-line">
            <button class="dp-btn" type="button" data-modal="#free-lesson-modal">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_06.php",
                    )
                ); ?>
            </button>
        </div>
    </div>
</div>