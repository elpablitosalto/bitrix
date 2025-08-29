<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-rates-section" id="kkm-rates">
    <div class="container">
        <div class="dp-kkm-rates-inner">
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
            <div class="dp-kkm-rates-wrapper">
                <div class="dp-kkm-rates-block">
                    <div class="dp-kkm-rates-item">
                        <div class="dp-kkm-rates-item__top">
                            <div class="dp-kkm-rates-item__title">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_02.php",
                                    )
                                ); ?>
                            </div>
                            <div class="dp-kkm-rates-item__desc">
                                <p>
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_03.php",
                                        )
                                    ); ?>
                                </p>
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
                        <div class="dp-kkm-rates-item__options">
                            <div class="dp-kkm-rates-item__option">
                                <div class="dp-kkm-rates-item__option-title">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_05.php",
                                        )
                                    ); ?>
                                </div>
                                <div class="dp-kkm-rates-item__option-price">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_06.php",
                                        )
                                    ); ?>

                                </div>
                                <button class="dp-btn dp-btn_m dp-kkm-rates-item__option-btn" type="button" data-modal="#tariff-base-pay-modal">
                                    Оплатить
                                </button>
                            </div>
                            <div class="dp-kkm-rates-item__option">
                                <div class="dp-kkm-rates-item__option-title">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_07.php",
                                        )
                                    ); ?>
                                </div>
                                <div class="dp-kkm-rates-item__option-price">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_08.php",
                                        )
                                    ); ?>

                                </div>
                                <button class="dp-btn dp-btn_m dp-btn_outlined dp-kkm-rates-item__option-btn" type="button" data-modal="#tariff-base-installment-modal">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_09.php",
                                        )
                                    ); ?>
                                </button>
                            </div>
                        </div>
                        <div class="dp-kkm-rates-item__info">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_10.php",
                                )
                            ); ?>

                        </div>
                    </div>
                </div>
                <div class="dp-kkm-rates-block">
                    <div class="dp-kkm-rates-item">
                        <div class="dp-kkm-rates-item__top">
                            <div class="dp-kkm-rates-item__title">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_11.php",
                                    )
                                ); ?>
                            </div>
                            <div class="dp-kkm-rates-item__desc">
                                <p>
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_12.php",
                                        )
                                    ); ?>
                                </p>

                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_13.php",
                                    )
                                ); ?>

                            </div>
                        </div>
                        <div class="dp-kkm-rates-item__options">
                            <div class="dp-kkm-rates-item__option">
                                <div class="dp-kkm-rates-item__option-title">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_14.php",
                                        )
                                    ); ?>
                                </div>
                                <div class="dp-kkm-rates-item__option-price">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_15.php",
                                        )
                                    ); ?>

                                </div>
                                <button class="dp-btn dp-btn_m dp-kkm-rates-item__option-btn" type="button" data-modal="#tariff-optima-pay-modal">
                                    Оплатить
                                </button>
                            </div>
                            <div class="dp-kkm-rates-item__option">
                                <div class="dp-kkm-rates-item__option-title">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_16.php",
                                        )
                                    ); ?>
                                </div>
                                <div class="dp-kkm-rates-item__option-price">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_17.php",
                                        )
                                    ); ?>

                                </div>
                                <button class="dp-btn dp-btn_m dp-btn_outlined dp-kkm-rates-item__option-btn" type="button" data-modal="#tariff-optima-installment-modal">Купить в рассрочку</button>
                            </div>
                        </div>
                        <div class="dp-kkm-rates-item__info">

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_18.php",
                                )
                            ); ?>

                        </div>
                    </div>
                </div>
                <div class="dp-kkm-rates-block dp-kkm-rates-block_offer">
                    <div class="dp-kkm-rates-item dp-kkm-rates-item_offer" id="rates-item-offer">
                        <div class="dp-kkm-rates-item__title">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_19.php",
                                )
                            ); ?>
                        </div>
                        <div class="dp-kkm-rates-item__desc">
                            <p class="text-width-m">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_20.php",
                                    )
                                ); ?>
                            </p>
                            <p>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_21.php",
                                    )
                                ); ?>
                            </p>
                        </div>
                        <button class="dp-btn dp-btn_m" type="button" data-modal="#submit-application">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_22.php",
                                )
                            ); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>