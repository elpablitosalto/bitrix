<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-order-section">
    <div class="container">
        <div class="dp-kkm-order-inner">
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
            <div class="dp-kkm-order-wrapper">
                <div class="dp-kkm-order-block dp-kkm-order-block_items">
                    <div class="dp-kkm-order-list">
                        <div class="dp-kkm-order-item dp-kkm-order-item_lessons">
                            <div class="dp-kkm-order-item__title">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_02.php",
                                    )
                                ); ?>
                            </div>
                            <div class="dp-kkm-order-item__text">
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
                        <div class="dp-kkm-order-item dp-kkm-order-item_analysis">
                            <div class="dp-kkm-order-item__title">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_04.php",
                                    )
                                ); ?>
                            </div>
                            <div class="dp-kkm-order-item__text">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_05.php",
                                    )
                                ); ?>
                            </div>
                        </div>
                        <div class="dp-kkm-order-item dp-kkm-order-item_workshop">
                            <div class="dp-kkm-order-item__title">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_06.php",
                                    )
                                ); ?>
                            </div>
                            <div class="dp-kkm-order-item__text">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_07.php",
                                    )
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dp-kkm-order-block dp-kkm-order-block_image">
                    <picture class="dp-kkm-order-image">
                        <?/*<img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-order-image.png" alt="">*/?>
                        <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-order-image-mob.png" media="(max-width: 767px)">
                        <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-order-image-mob.png" media="(max-width: 1201px) and (min-width: 768px)">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-order-image-desk.png" alt="">
                    </picture>
                </div>
                <div class="dp-kkm-order-block dp-kkm-order-block_items">
                    <div class="dp-kkm-order-list">
                        <div class="dp-kkm-order-item dp-kkm-order-item_chat">
                            <div class="dp-kkm-order-item__title">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_08.php",
                                    )
                                ); ?>
                            </div>
                            <div class="dp-kkm-order-item__text">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_09.php",
                                    )
                                ); ?>
                            </div>
                        </div>
                        <div class="dp-kkm-order-item dp-kkm-order-item_homework">
                            <div class="dp-kkm-order-item__title">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_10.php",
                                    )
                                ); ?>
                            </div>
                            <div class="dp-kkm-order-item__text">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_11.php",
                                    )
                                ); ?>
                            </div>
                        </div>
                        <div class="dp-kkm-order-item dp-kkm-order-item_reward">
                            <div class="dp-kkm-order-item__title">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_12.php",
                                    )
                                ); ?>
                            </div>
                            <div class="dp-kkm-order-item__text">
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
                    </div>
                </div>
            </div>
            <div class="dp-kkm-order__buttons"><a class="dp-btn" href="#" data-scroll-to="#kkm-rates">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_14.php",
                        )
                    ); ?>
                </a><a class="dp-btn dp-btn_outlined" href="#" data-modal="#kkm-course-program">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_15.php",
                        )
                    ); ?>
                </a></div>
        </div>
    </div>
</div>