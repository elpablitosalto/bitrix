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


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<? if (!empty($arResult["SECTIONS"])) { ?>
    <div class="lk__section">
        <h4 class="documentation__anchor" id="lkdocumentation"><?= $arParams['HEADER']; ?></h4>
        <ul class="button-list">
            <? foreach ($arResult["SECTIONS"] as $section) {

                //if (!isset($section["PICTURE"]["ID"]) || !($section["PICTURE"]["ID"]))
                //continue;
                //vardump($section);
                $count = $section["ELEMENT_CNT"];        //вытаскиваем кол-во элем.
                if ($count == 0) continue;                             //выход из текущей итерации цикла


                $this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
                $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
            ?>
                <li class="button-item" id="<? echo $this->GetEditAreaId($section['ID']); ?>">
                    <a class="link-button_grey link-button_s" href="<?= $section["SECTION_PAGE_URL"] ?>">
                        <?= $section["NAME"] ?>
                        <div class="link-button_arrow">
                            <svg width="10" height="20">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#arrow"></use>
                            </svg>
                        </div>
                    </a>
                </li>
            <? } ?>
        </ul>
    </div>
<? } ?>