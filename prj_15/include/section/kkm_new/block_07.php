<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dp-section dp-kkm-structure-section">
    <div class="container">
        <div class="dp-kkm-structure-inner">
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
                <p class="text-width-xs">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_02.php",
                        )
                    ); ?>
                    
                </p>
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
            </div>
            <div class="dp-kkm-structure__buttons"><a class="dp-btn-video" href="https://youtu.be/PDmYZKOiORY" data-fancybox="about"><span class="dp-btn-video__icon">
                        <svg class="icon icon-play ">
                            <use xlink:href="#play"></use>
                        </svg></span><span class="dp-btn-video__label">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_04.php",
                            )
                        ); ?>
                        
                    </span></a></div>
            <div class="dp-kkm-structure-wrapper">
                <div class="dp-kkm-structure-block">
                    <div class="dp-kkm-structure-item dp-kkm-structure-item_list">
                        <div class="dp-kkm-structure-list">
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
                    <div class="dp-kkm-structure-item dp-kkm-structure-item_image">
                        <picture class="dp-kkm-structure-image">
                            <?/*<img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/structure-image.jpg" alt="">*/?>
                            <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/structure-image-mob.png" media="(max-width: 767px)">
                            <source srcset="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/structure-image-tab.png" media="(max-width: 1201px) and (min-width: 768px)">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/content/kkm-landing/structure-image-desk.png" alt="">
                        </picture>
                    </div>
                    <div class="dp-kkm-structure-item dp-kkm-structure-item_list">
                        <div class="dp-kkm-structure-list">
                            <div class="dp-section__subtitle">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kkm_new/" . basename(__FILE__, '.php') . "_text_07.php",
                                    )
                                ); ?>
                                
                            </div>
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
            </div>
        </div>
    </div>
</div>