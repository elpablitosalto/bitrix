<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<?if(!empty($arResult["ITEMS"])):?>
    <div class="banner-carousel">
        <div class="banner-carousel__container swiper js-banner-carousel">
            <div class="banner-carousel__wrapper swiper-wrapper">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="banner-carousel__slide swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.detail",
                            "common_banner",
                            Array(
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                "ADD_SECTIONS_CHAIN" => "N",
                                "ADD_ELEMENT_CHAIN" => "N",
                                "FIELD_CODE" => [
                                    "NAME",
                                    "PREVIEW_TEXT",
                                    "PREVIEW_PICTURE",
                                    "DETAIL_PICTURE",
                                ],
                                "PROPERTY_CODE" => [
                                    "TYPE",
                                    "TITLE",
                                    "DESCRIPTION",
                                    "MULTIPLE_TEXT",
                                    "TELEGRAM",
                                    "WHATSAPP",
                                    "EMAIL",
                                    "PRIMARY_BUTTON_TEXT",
                                    "PRIMARY_BUTTON_LINK",
                                    "BUTTONS_DESC",
                                    "SECONDARY_BUTTON_TEXT",
                                    "SECONDARY_BUTTON_LINK",
                                    "IMAGE",
                                    "IMAGE_XL",
                                    "IMAGE_L",
                                    "IMAGE_M",
                                    "IMAGE_S",
                                    "IMAGE_XS",
                                    "TIPPY_RIGHT",
                                    "TIPPY_LEFT"
                                ],
                                "ELEMENT_ID" => $arItem["ID"],
                                "SET_TITLE" => "N"
                            ),
                            $component
                        );
                        ?>
                    </div>
                <?endforeach;?>
            </div>
        </div>
        <div class="banner-carousel__navigation">
            <div class="banner-carousel__pagination">
                <!-- begin .bullet-pagination-->
                <div class="bullet-pagination bullet-pagination_role_banner">
                </div>
                <!-- end .bullet-pagination-->
            </div>
            <div class="banner-carousel__arrows">
                <!-- begin .carousel-nav-->
                <div class="carousel-nav js-carousel-nav"
                     data-nav-scope=".banner-carousel" data-nav-target=".swiper">
                    <!-- begin .button-->
                    <button class="button button_role_banner js-carousel-nav-prev"
                            type="button"><span class="button__holder">
                              <svg class="button__icon" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                   xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L1 5L5 9" stroke="black" stroke-linecap="round"></path>
                              </svg></span>
                    </button>
                    <!-- end .button-->
                    <div class="carousel-nav__control">
                        <!-- begin .button-->
                        <button class="button button_role_banner js-carousel-nav-next"
                                type="button"><span class="button__holder">
                                <svg class="button__icon" width="6" height="10" viewBox="0 0 6 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                  <path d="M1 9L5 5L1 1" stroke="black" stroke-linecap="round"></path>
                                </svg></span>
                        </button>
                        <!-- end .button-->
                    </div>
                </div>
                <!-- end .carousel-nav-->
            </div>
        </div>
    </div>
<?endif;?>