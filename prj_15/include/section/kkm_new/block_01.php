<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-top-section">
    <div class="container">
        <div class="dp-kkm-top__inner">
            <div class="dp-kkm-top__col-caption">
                <div class="dp-kkm-top__caption">
                    <div class="dp-kkm-top__title-wrapper">
                        <div class="dp-kkm-top__subtitle">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_01.php",
                                )
                            ); ?>

                        </div>
                        <h1 class="dp-kkm-top__title">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_02.php",
                                )
                            ); ?>

                        </h1>
                        <div class="dp-kkm-top__subtitle">
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
                    <div class="dp-kkm-top__actions">
                        <button class="dp-btn" type="button" data-scroll-to="#kkm-rates">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_04.php",
                                )
                            ); ?>

                        </button>
                        <a class="dp-btn dp-btn_outlined" href="#" data-scroll-to="#rates-item-offer">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_05.php",
                                )
                            ); ?>

                        </a>
                    </div>
                </div>
            </div>
            <div class="dp-kkm-top__col-img">
                <div class="dp-kkm-top__img"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/top-section.png" alt=""></div>
                <div class="dp-kkm-top__certificate">
                    <div class="dp-kkm-top__certificate-btn">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_06.php",
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>