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

if($arResult["SECTIONS"]) :?>
    <?
    $strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
    $strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
    $arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
    ?>
    <div class="bgGrau wideGallery">
        <div  class=" responsiveBlock">
            <div id="RefKatList">
                <div class="refKatWrap">
                    <div class="refKatTitle filterButton visible">
                        <span class="buttonDesc">Категории</span>
                        <span class="pfeil icon-pfeil"> </span>
                    </div>
                    <div class="refKatListe">
                        <?foreach($arResult["SECTIONS"] as &$section): ?>
                            <?
                            $this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
                            $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                            ?>
                            <a id="<? echo $this->GetEditAreaId($section['ID']); ?>" class="refKat <?if($section["CODE"] == $arParams["SECTION_CODE_ACTIVE"]):?>active<?endif;?>" href="<?=$section["SECTION_PAGE_URL"];?>" title="<?=$section["NAME"];?>"><span class="title"><?=$section["NAME"];?></span></a>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endif;?>