<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-authors-section">
    <div class="container">
        <div class="dp-kkm-authors-inner">
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
            <div class="dp-section__desc">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_02.php",
                    )
                ); ?>
                </div>
            <div class="dp-kkm-authors-list">
                <div class="dp-kkm-authors-item dp-kkm-authors-item_main">
                    <picture class="dp-kkm-authors-item__image">
                        <?/*<img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-authors-1-desk.png" alt="">*/?>
                        <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-authors-1-tab.png" media="(max-width: 1201px) and (min-width: 768px)">
                        <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-authors-1-mob.png" media="(max-width: 767px)">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-authors-1-desk.png" alt="">
                    </picture>
                    <div class="dp-kkm-authors-item__info">
                        <div class="dp-kkm-authors-item__title">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_03.php",
                                )
                            ); ?>
                            </div>
                        <div class="dp-kkm-authors-item__subtitle">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_04.php",
                                )
                            ); ?>
                            </div>
                        <div class="dp-kkm-authors-item__text">
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
                </div>
                <div class="dp-kkm-authors-item dp-kkm-authors-item_1">
                    <div class="dp-kkm-authors-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-authors-2.png" alt=""></div>
                    <div class="dp-kkm-authors-item__info">
                        <div class="dp-kkm-authors-item__title">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_06.php",
                                )
                            ); ?>
                            </div>
                        <div class="dp-kkm-authors-item__subtitle">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_07.php",
                                )
                            ); ?>
                            </div>
                        <div class="dp-kkm-authors-item__text">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_08.php",
                                )
                            ); ?>
                            </div>
                    </div>
                </div>
                <div class="dp-kkm-authors-item dp-kkm-authors-item_2">
                    <div class="dp-kkm-authors-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/kkm-authors-3.png" alt=""></div>
                    <div class="dp-kkm-authors-item__info">
                        <div class="dp-kkm-authors-item__title">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_09.php",
                                )
                            ); ?>
                            </div>
                        <div class="dp-kkm-authors-item__subtitle">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_10.php",
                                )
                            ); ?>
                            </div>
                        <div class="dp-kkm-authors-item__text">
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
                </div>
            </div>
        </div>
    </div>
</div>