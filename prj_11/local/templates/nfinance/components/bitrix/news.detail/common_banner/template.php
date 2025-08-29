<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$arBreakpoints = [
  "XS" => "max-width: 0px",
  "S" => "max-width: 479px",
  "M" => "max-width: 767px",
  "L" => "max-width: 1024px",
  "XL" => "max-width: 1279px",
  "XXL" => "max-width: 1439px",
];
?>
<?if(!empty($arResult)):?>
    <?if($arResult["TYPE"] === "MAIN" || $arResult["TYPE"] === "MAIN_PANEL"):?>
        <div class="main-banner <?if($arResult["TYPE"] === "MAIN_PANEL"):?>main-banner_style_secondary<?endif;?>">
            <div class="main-banner__container">
                <div class="main-banner__wrapper">
                    <div class="main-banner__content">
                        <div class="main-banner__title"><?=htmlspecialchars_decode($arResult["PROPS"]["TITLE"])?></div>
                        <div class="main-banner__text"><?=htmlspecialchars_decode($arResult["PROPS"]["DESCRIPTION"])?></div>
                        <div class="main-banner__controls">
                            <?if(!empty($arResult["BUTTONS"]["PRIMARY"])):?>
                                <div class="main-banner__control">
                                    <!-- begin .button-->
                                    <a class="button <?if($arResult["BUTTONS"]["PRIMARY"]["MODAL"]):?>js-modal<?endif;?>" href="<?=$arResult["BUTTONS"]["PRIMARY"]["LINK"]?>">
                                        <span class="button__holder">
                                            <span class="button__text"><?=$arResult["BUTTONS"]["PRIMARY"]["TEXT"]?></span>
                                        </span>
                                    </a>
                                    <!-- end .button-->
                                </div>
                            <?endif;?>
                            <?if(!empty($arResult["PROPS"]["BUTTONS_DESC"]) && $arResult["TYPE"] !== "MAIN_PANEL"):?>
                                <div class="main-banner__description"><?=htmlspecialchars_decode($arResult["PROPS"]["BUTTONS_DESC"])?></div>
                            <?endif;?>
                        </div>
                    </div>
                    <div class="main-banner__illustration">
                        <?if(!empty($arResult["IMAGES"]["TIPPY"]["LEFT"]["LABEL"])):?>
                            <!-- begin .tippy-->
                            <div class="tippy tippy_style_primary">
                                <div class="tippy__content">
                                <div class="tippy__icon">?
                                </div>
                                <div class="tippy__container">
                                    <div class="tippy__name"><?=$arResult["IMAGES"]["TIPPY"]["LEFT"]["LABEL"]?></div>
                                    <div class="tippy__role"><?=$arResult["IMAGES"]["TIPPY"]["LEFT"]["VALUE"]?></div>
                                </div>
                                </div>
                            </div>
                            <!-- end .tippy-->
                        <?endif;?>
                        <?if(!empty($arResult["IMAGES"]["TIPPY"]["RIGHT"]["LABEL"])):?>
                            <!-- begin .tippy-->
                            <div class="tippy tippy_style_secondary">
                                <div class="tippy__content">
                                <div class="tippy__icon">?
                                </div>
                                <div class="tippy__container">
                                    <div class="tippy__name"><?=$arResult["IMAGES"]["TIPPY"]["RIGHT"]["LABEL"]?></div>
                                    <div class="tippy__role"><?=$arResult["IMAGES"]["TIPPY"]["RIGHT"]["VALUE"]?></div>
                                </div>
                                </div>
                            </div>
                            <!-- end .tippy-->
                        <?endif;?>
                        <?if(!empty($arResult["IMAGES"]["DEFAULT"]["SRC"])):?>
                            <picture class="main-banner__picture">
                                <?foreach($arResult["IMAGES"]["BREAKPOINTS"] as $point => $arImage):?>
                                    <source srcset="<?=$arImage["SRC"]?>" type="image/png" media="(<?=$arBreakpoints[$point]?>)" class="main-banner__source">
                                <?endforeach;?>
                                <img
                                    src="<?=$arResult["IMAGES"]["DEFAULT"]["SRC"]?>"
                                    alt="<?=strip_tags(htmlspecialchars_decode($arResult["PROPS"]["TITLE"]))?>"
                                    class="main-banner__image"
                                    <?=($arResult["TYPE"] === "MAIN" ? 'fetchpriority="high"' : '')?>
                                >
                            </picture>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>


    <?if($arResult["TYPE"] === "PANEL" || $arResult["TYPE"] === "PANEL_FILL"):?>
        <div class="banner <?if($arResult["TYPE"] === "PANEL"):?>banner_style_primary banner_layout_primary<?endif;?>">
            <div class="banner__wrapper">
                <div class="banner__background">
                    <?if(!empty($arResult["IMAGES"]["DEFAULT"]["SRC"])):?>
                        <picture class="banner__picture">
                            <?foreach($arResult["IMAGES"]["BREAKPOINTS"] as $point => $arImage):?>
                                <source srcset="<?=$arImage["SRC"]?>" type="image/png" media="(<?=$arBreakpoints[$point]?>)" class="banner__source">
                            <?endforeach;?>
                            <img src="<?=$arResult["IMAGES"]["DEFAULT"]["SRC"]?>" alt="<?=strip_tags(htmlspecialchars_decode($arResult["PROPS"]["TITLE"]))?>" class="banner__image" <?=($arResult["TYPE"] === "PANEL_FILL" ? 'loading="lazy"' : '')?>>
                        </picture>
                    <?endif;?>
                </div>
                <div class="banner__icons">
                    <?if($arResult["TYPE"] === "PANEL"):?>
                        <img class="banner__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/banner/images/icon-check.svg" role="presentation" alt="icon" <?=($arResult["TYPE"] === "PANEL_FILL" ? 'loading="lazy"' : '')?>>
                        <img class="banner__icon banner__icon_type_main" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/banner/images/icon-lamp.svg" role="presentation" alt="icon">
                    <?endif;?>
                </div>
                <div class="banner__content">
                    <div class="banner__title"><?=htmlspecialchars_decode($arResult["PROPS"]["TITLE"])?></div>
                    <div class="banner__text"><?=htmlspecialchars_decode($arResult["PROPS"]["DESCRIPTION"])?></div>

                    <div class="banner__description"><?=htmlspecialchars_decode($arResult["PROPS"]["BUTTONS_DESC"])?></div>

                    <?if(!empty($arResult["PROPS"]["MULTIPLE_TEXT"])):?>
                        <ol class="banner__list">
                            <?foreach($arResult["PROPS"]["MULTIPLE_TEXT"] as $arRow):?>
                                <li class="banner__item"><?=$arRow["LABEL"]?> — <span class="highlight highlight_weight_medium"><?=$arRow["VALUE"]?></span>
                                </li>
                            <?endforeach;?>
                        </ol>
                    <?endif;?>
                    <div class="banner__controls">
                        <?if(!empty($arResult["BUTTONS"]["PRIMARY"])):?>
                            <div class="banner__control <?if($arResult["TYPE"] === "PANEL_FILL"):?>banner__control_width_s<?endif;?>">
                                <!-- begin .button-->
                                <a class="button button_type_wide <?if($arResult["BUTTONS"]["PRIMARY"]["MODAL"]):?>js-modal<?endif;?>" href="<?=$arResult["BUTTONS"]["PRIMARY"]["LINK"]?>">
                                    <span class="button__holder">
                                        <span class="button__text"><?=$arResult["BUTTONS"]["PRIMARY"]["TEXT"]?></span>
                                    </span>
                                </a>
                                <!-- end .button-->
                            </div>
                        <?endif;?>

                        <?if(!empty($arResult["BUTTONS"]["SECONDARY"])):?>
                            <div class="banner__control <?if($arResult["TYPE"] === "PANEL_FILL"):?>banner__control_width_l<?endif;?>">
                                <!-- begin .button-->
                                <a class="button button_type_wide button_style_dark <?if($arResult["BUTTONS"]["SECONDARY"]["MODAL"]):?>js-modal<?endif;?>" href="<?=$arResult["BUTTONS"]["SECONDARY"]["LINK"]?>">
                                    <span class="button__holder">
                                        <span class="button__text"><?=$arResult["BUTTONS"]["SECONDARY"]["TEXT"]?></span>
                                    </span>
                                </a>
                                <!-- end .button-->
                            </div>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>



    <?if($arResult["TYPE"] === "CONTACT"):?>
        <div class="banner banner_text-size_s banner_style_primary banner_layout_secondary banner_background-pointer_visible">
            <div class="banner__wrapper">
                <div class="banner__background">
                    <?if(!empty($arResult["IMAGES"]["DEFAULT"]["SRC"])):?>
                        <picture class="banner__picture">
                            <?foreach($arResult["IMAGES"]["BREAKPOINTS"] as $point => $arImage):?>
                                <source srcset="<?=$arImage["SRC"]?>" type="image/png" media="(<?=$arBreakpoints[$point]?>)" class="banner__source">
                            <?endforeach;?>
                            <img src="<?=$arResult["IMAGES"]["DEFAULT"]["SRC"]?>" alt="<?=strip_tags(htmlspecialchars_decode($arResult["PROPS"]["TITLE"]))?>" class="banner__image">
                        </picture>
                    <?endif;?>
                </div>
                <div class="banner__icons">
                    <img class="banner__icon banner__icon_type_main banner__icon_size_l" src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/banner/images/icon-lamp.svg" role="presentation" alt="icon">
                </div>
                <div class="banner__content">
                    <div class="banner__title">
                        <span class="highlight"><?=htmlspecialchars_decode($arResult["PROPS"]["TITLE"])?></span>
                    </div>
                    <div class="banner__text"><?=htmlspecialchars_decode($arResult["PROPS"]["DESCRIPTION"])?></div>
                    <!-- begin .list-->
                    <ul class="list list_layout_desktop-horizontal list_weight_medium list_text-size_l list_style_secondary banner__bullet-list">
                        <li class="list__item list__item_no_bullet list__item_has_icon">
                        <div class="list__icon-wrapper">
                            <svg class="list__icon">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/icon.svg#icon_contained-telegram"></use>
                            </svg>
                        </div>
                        <div class="list__text"><a class="link link_style_ninja" target="_blank" href="https://t.me/maruyank">@maruyank</a>
                        </div>
                        </li>
                        <li class="list__item list__item_no_bullet list__item_has_icon">
                        <div class="list__icon-wrapper">
                            <svg class="list__icon">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/icon.svg#icon_contained-whatsapp"></use>
                            </svg>
                        </div>
                        <div class="list__text"><a class="link link_style_ninja" href="https://wa.me/+79998552531" target="_blank">+7 (999) 855-25-31</a>
                        </div>
                        </li>
                        <li class="list__item">
                        <div class="list__text"><a class="link link_style_ninja" href="mailto:referal1@noboring-finance.ru">referal1@noboring-finance.ru</a>
                        </div>
                        </li>
                    </ul>
                    <!-- end .list-->
                </div>
            </div>
        </div>
    <?endif;?>



    <?if($arResult["TYPE"] === "SIMPLE"):?>
        <div class="main-banner main-banner_layout-type_a">
            <div class="main-banner__container">
                <div class="main-banner__wrapper">
                    <div class="main-banner__content">
                        <div class="main-banner__title"><?=htmlspecialchars_decode($arResult["PROPS"]["TITLE"])?></div>
                        <div class="main-banner__controls">
                            <div class="main-banner__control">
                            <!-- begin .button-->
                            <a class="button button_type_wide js-go-to" href="#participationSection">
                                <span class="button__holder">
                                    <span class="button__text">Подробнее</span>
                                </span>
                            </a>
                            <!-- end .button-->
                            </div>
                        </div>
                    </div>
                    <div class="main-banner__illustration">
                        <?if(!empty($arResult["IMAGES"]["DEFAULT"]["SRC"])):?>
                            <picture class="main-banner__picture">
                                <?foreach($arResult["IMAGES"]["BREAKPOINTS"] as $point => $arImage):?>
                                    <source srcset="<?=$arImage["SRC"]?>" type="image/png" media="(<?=$arBreakpoints[$point]?>)" class="main-banner__source">
                                <?endforeach;?>
                                <img src="<?=$arResult["IMAGES"]["DEFAULT"]["SRC"]?>" alt="<?=strip_tags(htmlspecialchars_decode($arResult["PROPS"]["TITLE"]))?>" class="main-banner__image">
                            </picture>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>



    <?if($arResult["TYPE"] === "BOOK"):?>
        <div class="main-banner main-banner_style_secondary main-banner_style_transparent main-banner_image-size_l main-banner_image_mobile-stretch main-banner_height_fit main-banner_title-size_m main-banner_indent_l">
            <div class="main-banner__container">
                <div class="main-banner__background">
                    <picture class="main-banner__picture">
                        <source srcset="<?=SITE_TEMPLATE_PATH?>/assets/blocks/main-banner/images/bg-4-s.png" type="image/png" media="(max-width: 480px)" class="main-banner__source">
                        <source srcset="<?=SITE_TEMPLATE_PATH?>/assets/blocks/main-banner/images/bg-4-m.png" type="image/png" media="(max-width: 1280px)" class="main-banner__source">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/main-banner/images/bg-4.png" alt="<?=strip_tags(htmlspecialchars_decode($arResult["PROPS"]["TITLE"]))?>" class="main-banner__image">
                    </picture>
                </div>
                <div class="main-banner__wrapper">
                    <div class="main-banner__content">
                    <div class="main-banner__title"><?=htmlspecialchars_decode($arResult["PROPS"]["TITLE"])?></div>
                    <div class="main-banner__text"><?=htmlspecialchars_decode($arResult["PROPS"]["DESCRIPTION"])?></div>
                    <div class="main-banner__controls">
                        <div class="main-banner__control">
                        <!-- begin .button-->
                        <a class="button" href="/">
                            <span class="button__holder">
                                <span class="button__text">Скачать книгу бесплатно</span>
                                <svg class="button__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.99967 14.1667V2.5M16.6663 17.5H3.33301M14.1663 10L9.99884 14.1675L5.83217 10" stroke="currentColor" fill="transparent" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                        <!-- end .button-->
                        </div>
                    </div>
                    </div>
                    <div class="main-banner__illustration">
                        <?if(!empty($arResult["IMAGES"]["DEFAULT"]["SRC"])):?>
                            <picture class="main-banner__picture">
                                <?foreach($arResult["IMAGES"]["BREAKPOINTS"] as $point => $arImage):?>
                                    <source srcset="<?=$arImage["SRC"]?>" type="image/png" media="(<?=$arBreakpoints[$point]?>)" class="main-banner__source">
                                <?endforeach;?>
                                <img src="<?=$arResult["IMAGES"]["DEFAULT"]["SRC"]?>" alt="<?=strip_tags(htmlspecialchars_decode($arResult["PROPS"]["TITLE"]))?>" class="main-banner__image">
                            </picture>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>



    <?if($arResult["TYPE"] === "DEFAULT_DARK"):?>
        <div class="wide-banner wide-banner_type_full wide-banner_indent_s">
            <div class="wide-banner__container">
                <div class="wide-banner__background">
                    <picture class="wide-banner__picture">
                        <source srcset="<?=SITE_TEMPLATE_PATH?>/assets/blocks/wide-banner/images/bg-3.png" type="image/png" media="(max-width: 479px)" class="wide-banner__source">
                        <source srcset="<?=SITE_TEMPLATE_PATH?>/assets/blocks/wide-banner/images/bg-3-m.png" type="image/png" media="(max-width: 1024px)" class="wide-banner__source">
                        <img src="<?=SITE_TEMPLATE_PATH?>/assets/blocks/wide-banner/images/bg-1.png" alt="image" class="wide-banner__image">
                    </picture>
                  </div>
                <div class="wide-banner__wrapper">
                    <div class="wide-banner__content">
                        <div class="wide-banner__title"><?=htmlspecialchars_decode($arResult["PROPS"]["TITLE"])?></div>
                        <div class="wide-banner__text"><?=htmlspecialchars_decode($arResult["PROPS"]["DESCRIPTION"])?></div>
                        <div class="wide-banner__controls">
                            <div class="wide-banner__control">
                                <!-- begin .button-->
                                <button class="button" href="/">
                                    <span class="button__holder">
                                        <span class="button__text">Скачать книгу бесплатно</span>
                                        <svg class="button__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.99967 14.1667V2.5M16.6663 17.5H3.33301M14.1663 10L9.99884 14.1675L5.83217 10" stroke="currentColor" fill="transparent" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </button>
                                <!-- end .button-->
                            </div>
                        </div>
                    </div>
                    <div class="wide-banner__illustration">
                        <?if(!empty($arResult["IMAGES"]["DEFAULT"]["SRC"])):?>
                            <picture class="wide-banner__picture">
                                <?foreach($arResult["IMAGES"]["BREAKPOINTS"] as $point => $arImage):?>
                                    <source srcset="<?=$arImage["SRC"]?>" type="image/png" media="(<?=$arBreakpoints[$point]?>)" class="wide-banner__source">
                                <?endforeach;?>
                                <img src="<?=$arResult["IMAGES"]["DEFAULT"]["SRC"]?>" alt="<?=strip_tags(htmlspecialchars_decode($arResult["PROPS"]["TITLE"]))?>" class="wide-banner__image">
                            </picture>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>
<?endif;?>