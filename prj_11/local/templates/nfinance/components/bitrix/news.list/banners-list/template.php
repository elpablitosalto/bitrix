<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Type\DateTime;

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
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="banner-list">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="banner-list__item">
                <?if($arItem["PROPERTIES"]["TYPE"]["VALUE_XML_ID"] === "DEFAULT_DARK"):?>
                <?else:?>
                    <div class="page__holder">
                <?endif;?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:news.detail",
                    "common_banner",
                    Array(
                        "IBLOCK_ID" => 27,
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
                        "BUTTON_LINK" => $downloadLink,
                        "BUTTON_TEXT" => "Скачать книгу бесплатно",
                        "DOWNLOAD_BUTTON" => true
                    ),
                    $component
                );
                ?>
                <?if($arItem["PROPERTIES"]["TYPE"]["VALUE_XML_ID"] === "DEFAULT_DARK"):?>
                <?else:?>
                    </div>
                <?endif;?>
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>