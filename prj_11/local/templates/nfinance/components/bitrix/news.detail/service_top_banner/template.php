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
$this->setFrameMode(true);?>
<?if(!empty($arResult)):?>
    <div class="section section_space_top-m">
        <div class="section__content">
            <div class="section__media-panel">
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
                        "ELEMENT_ID" => $arParams["ELEMENT_ID"],
                        "SET_TITLE" => "N"
                    ),
                    $component
                );
                ?>
            </div>
        </div>
    </div>
<?endif;?>