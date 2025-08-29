<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-goals-section">
    <div class="dp-kkm-goals-section__inner">
        <div class="container">
            <div class="items-list">
                <div class="list-item">
                    <div class="dp-kkm-goals-item structure">
                        <div class="dp-kkm-goals-item__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-structure.svg" alt=""></div>
                        <h2 class="dp-kkm-goals-item__text">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_01.php",
                                )
                            ); ?>
                            
                        </h2>
                    </div>
                </div>
                <div class="list-item">
                    <div class="dp-kkm-goals-item">
                        <div class="dp-kkm-goals-item__image time"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-time.svg" alt=""></div>
                        <h2 class="dp-kkm-goals-item__text">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_02.php",
                                )
                            ); ?>
                            
                        </h2>
                    </div>
                </div>
                <div class="list-item">
                    <div class="dp-kkm-goals-item">
                        <div class="dp-kkm-goals-item__image dialog"><img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/icon-kkm-dialog.svg" alt=""></div>
                        <h2 class="dp-kkm-goals-item__text">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_03.php",
                                )
                            ); ?>
                            
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>