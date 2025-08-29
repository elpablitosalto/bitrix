<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-practice-section">
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
            <div class="dp-list-item dp-list-item_person">
                <div class="dp-kkm-practice-item dp-kkm-practice-item_person">
                    <div class="dp-kkm-practice-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-person.svg" alt=""></div>
                    <div class="dp-kkm-practice-item__text">
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
            </div>
            <div class="dp-list-item dp-list-item_video">
                <div class="dp-kkm-practice-item dp-kkm-practice-item_video">
                    <div class="dp-kkm-practice-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-video.svg" alt=""></div>
                    <div class="dp-kkm-practice-item__text">
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
            </div>
            <div class="dp-list-item dp-list-item_structure">
                <div class="dp-kkm-practice-item dp-kkm-practice-item_structure">
                    <div class="dp-kkm-practice-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-structure.svg" alt=""></div>
                    <div class="dp-kkm-practice-item__text">
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
            <div class="dp-list-item dp-list-item_calendar">
                <div class="dp-kkm-practice-item dp-kkm-practice-item_calendar">
                    <div class="dp-kkm-practice-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-calendar.svg" alt=""></div>
                    <div class="dp-kkm-practice-item__text">
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
            <div class="dp-list-item dp-list-item_way">
                <div class="dp-kkm-practice-item dp-kkm-practice-item_way">
                    <div class="dp-kkm-practice-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-way.svg" alt=""></div>
                    <div class="dp-kkm-practice-item__text">
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
            <div class="dp-list-item dp-list-item">
                <div class="dp-kkm-practice-item dp-kkm-practice-item_conspects">
                    <div class="dp-kkm-practice-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-conspects.svg" alt=""></div>
                    <div class="dp-kkm-practice-item__text">
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
        <div class="dp-buttons-line">
            <button class="dp-btn" type="button" data-modal="#kkm-course-program">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_08.php",
                    )
                ); ?>
            </button>
        </div>
    </div>
</div>