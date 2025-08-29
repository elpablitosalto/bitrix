<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

$sectionColor = !empty($arParams['COLOR_CODE']) ? $arParams['COLOR_CODE'] : false;
if (
    empty($sectionColor)
    && !empty($arParams['COLOR_ID'])
    && Loader::includeModule("highloadblock")
) {
    $rsHighloadData = \Bitrix\Highloadblock\HighloadBlockTable::getList([
        'filter' => [
            '=NAME'=> "Color"
        ]
    ]);
    if ($arHighloadData = $rsHighloadData->fetch()) {
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHighloadData);
        $entityDataClass = $entity->getDataClass();
        $rsSectionColor = $entityDataClass::getList([
            'filter' => [
                '=ID' => intval($arParams['COLOR_ID'])
            ]
        ]);
        if($arSectionColor = $rsSectionColor->fetch()){
            $sectionColor = $arSectionColor["UF_COLOR_CODE"];
        }
    }
}
if(!empty($sectionColor)) {
    $asset = \Bitrix\Main\Page\Asset::getInstance();
    $asset->addString(
        preg_replace(
            '/%COLOR_CODE%/', $sectionColor,
            '<style>.logo, .title:not(.title_style_dependent), .button_style_light, .button_style_light:not(:disabled):hover, .button_style_light:not(:disabled):active, .button_style_light:not(:disabled):focus, .button_style_dashed-outline, .link:not(.link_style_ninja), .link:not(.link_style_ninja):hover, .link:not(.link_style_ninja):focus, .burger:hover, .burger:focus, .social-nav__link, .social-nav__link:hover, .social-nav__link:focus, .breadcrumbs__label, .breadcrumbs__link:hover, .breadcrumbs__link:focus, .breadcrumbs__link:active, .product-snippet__link, .product-snippet__link:hover, .product-snippet__link:focus, .video-card__illustration:hover .video-card__icon, .choice-group_type_solid .choice-group__input:checked ~ .choice-group__panel, .choice-group_type_solid .choice-group__label:hover .choice-group__panel, .icon-panel__illustration > svg, .text h2:not([class]), .text__columns h2:not([class]) {   color: %COLOR_CODE%; } .header__panel, .footer, .nav_layout_horizontal.nav_type_primary .nav__submenu, .nav_layout_horizontal.nav_type_primary .nav__submenu .nav__link, .section_style_filled, .choice-group__label:hover .choice-group__panel, .choice-group__input:checked ~ .choice-group__panel, .skewed-panel, .properties__label, .info-panel__title, .product-card-carousel:before {   background-color: %COLOR_CODE%; } @media only screen and (min-width: 1025px) {     .product-card-carousel .product-card-carousel__container {         background-color: %COLOR_CODE%;     } } .button:not([class*="button_style_"]), .button:not([class*="button_style_"]):not(:disabled):hover, .button:not([class*="button_style_"]):not(:disabled):active, .button:not([class*="button_style_"]):not(:disabled):focus, .button_style_dashed-outline:not(:disabled):hover, .button_style_dashed-outline:not(:disabled):active, .button_style_dashed-outline:not(:disabled):focus, .carousel-nav_arrow-style_solid .carousel-nav__arrow:not(:disabled):focus {   background-color: %COLOR_CODE%;   border-color: %COLOR_CODE%; } .icon-panel__icon {   fill: %COLOR_CODE%; } .header__referrer .logo__picture svg path {   fill: %COLOR_CODE%; } .footer__logo .logo__picture svg path:nth-child(2), .footer__logo .logo__picture svg g path {   fill: %COLOR_CODE%; } [style*="color: #8d0e57"] {     color: %COLOR_CODE% !important; }</style>'
        )
    );
}
?>