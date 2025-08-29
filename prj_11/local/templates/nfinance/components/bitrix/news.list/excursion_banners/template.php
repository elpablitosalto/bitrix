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
$sectionClass = !isset($arParams["SECTION_MODIF_CLASS"]) ? "section_space_top-close" : $arParams["SECTION_MODIF_CLASS"];
?>
<?if(!empty($arResult["ITEMS"])):?>
    <div class="section <?=$sectionClass?>">
        <div class="section__content">
            <div class="section__advertisement-carousel">
                <!-- begin .advertisement-carousel-->
                <div class="advertisement-carousel">
                    <div class="advertisement-carousel__container swiper js-advertisement-carousel">
                        <div class="advertisement-carousel__wrapper swiper-wrapper">
                            <?foreach($arResult["ITEMS"] as $arItem):?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                                <div class="advertisement-carousel__slide swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                    <?
                                        $modifiers = Array(
                                            "recomendation" => "banner_style_primary banner_layout_primary"
                                        );
                                        $bannerType = !empty($arItem["PROPERTIES"]["BANNER_TYPE"]["VALUE_XML_ID"]) ? $arItem["PROPERTIES"]["BANNER_TYPE"]["VALUE_XML_ID"] : '';
                                        $bannerModifiers = !empty($modifiers[$bannerType]) ? $modifiers[$bannerType] : '';
                                    ?>
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
                    <?if(count($arResult["ITEMS"]) > 1):?>
                        <div class="advertisement-carousel__navigation">
                            <div class="advertisement-carousel__pagination">
                                <!-- begin .bullet-pagination-->
                                <div class="bullet-pagination bullet-pagination_role_advertisement">
                                </div>
                                <!-- end .bullet-pagination-->
                            </div>
                        </div>
                    <?endif;?>
                </div>
                <!-- end .advertisement-carousel-->
            </div>
        </div>
    </div>
<?endif;?>