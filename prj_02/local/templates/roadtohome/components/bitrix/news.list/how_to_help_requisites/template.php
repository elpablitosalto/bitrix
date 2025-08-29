<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

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

<? if (!empty($arResult["ITEMS"])) { ?>

    <div class="table">
    <? foreach ($arResult["ITEMS"] as $num => $item) { ?>
        <?
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="line" id="<?=$this->GetEditAreaId($item['ID']);?>">
            <div class="name"><?=$item["NAME"]?></div>
            <div class="value"><?=$item["PREVIEW_TEXT"]?></div>
            <div class="button copy-item-class" onclick="copyReq('req<?=$num?>');" id="req<?=$num?>">
                <svg xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-copy">
                    <use xlink:href="#copy"></use>
                </svg>
            </div>
        </div>
         <? } ?>
    </div>
<? } ?>