<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Удаляем ранее выбранный адрес клиники при заходе на страницу контактов
if (!isset($_REQUEST['bxajaxid']) && isset($_COOKIE['chosenAddressId'])) {
    unset($_COOKIE['chosenAddressId']);
    setcookie('chosenAddressId', '', -1, '/');
}
?>
<section class="nb-top-banner-section nb-top-banner-section-contact nb-top-banner-main">
    <? $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "",
        array(
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => SITE_ID
        )
    ); ?>
    <div class="nb-top-banner is-tablet">
        <div class="nb-top-banner__caption">
            <h1 class="nb-top-banner__title"><?$APPLICATION->ShowTitle(false)?></h1>
        </div>
        <div class="nb-top-banner__img"></div>
    </div>
    <div class="nb-affiliated--header">
        <h3 class="nb-section__title">Клиники «Белый кролик»</h3>
        <div class="nb-affiliated--country">
            <div class="nb-dropdown">
                <div class="nb-dropdown__inner">
                    <div class="nb-dropdown__header">
                        <p class="nb-dropdown__title">в Москве</p>
                        <svg class="icon icon-list-arrow ">
                            <use xlink:href="#list-arrow"></use>
                        </svg>
                    </div>
                    <div class="nb-dropdown__body">
                        <div class="nb-affiliated--country-address--box">
                            <?
                            $APPLICATION->IncludeFile(
                                SITE_DIR . 'include/common/list_locations.php',
                                array(
                                    "TEMPLATE_NAME" => "contact_banner_locations",
                                    "NEWS_COUNT" => 20
                                ),
                                array('SHOW_BORDER' => false)
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nb-affiliated--country-phone--box">Единый номер: <a class="nb-affiliated--country-phone" href="tel:+74957836606">+7 (495) 783-66-06</a>
        </div>
    </div>
</section>