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
?>

<div class="page__section brands-list">
	<div class="page__container">
		<!-- begin .section-->
		<div class="section">
            <div class="section__header">
                <div class="section__title">
                    <!-- begin .title-->
                    <div class="title title_size_h1"><?$APPLICATION->ShowTitle(false)?></div>
                    <!-- end .title-->
                </div>
            </div>
            <div class="section__content">
                <div class="section__promo-grid">
                    <div class="promo-grid">
                            <?if(!empty($arResult["ITEMS"])):?>
                                <div class="promo-grid__wrapper">
                                    <?foreach($arResult["ITEMS"] as $arItem):?>
                                        <div class="promo-grid__item">
                                            <!-- begin .promo-snippet-->
                                            <div class="promo-snippet promo-snippet_type_adaptive promo-grid__snippet">
                                                <?if(!empty($arItem["IMAGE"]["SRC"])):?>
                                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="promo-snippet__illustration">
                                                        <picture class="promo-snippet__picture">
                                                            <img
                                                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                                data-src="<?=$arItem["IMAGE"]["SRC"]?>"
                                                                alt="<?=$arItem["NAME"]?>"
                                                                class="promo-snippet__image lazyload"
                                                            />
                                                        </picture>
                                                    </a>
                                                <?endif?>
                                            </div>
                                            <!-- end .promo-snippet-->
                                        </div>
                                    <?endforeach;?>
                                </div>
                            <?else:?>
                                <div class="promo-grid__wrapper">Брендов в данных момент нет</div>
                            <?endif?>

                        <div class="promo-grid__pagination">
                            <?=$arResult["NAV_STRING"]?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<!-- end .section-->
	</div>
</div>

