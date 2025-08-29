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
    <div class="bgGrau wideGallery">
        <div  class=" responsiveBlock">
            <div id="RefKatList">
                <div class="refKatWrap">
                    <div class="refKatTitle filterButton visible">
                        <span class="buttonDesc">Категории</span>
                        <span class="pfeil icon-pfeil"> </span>
                    </div>
                    <div class="refKatListe">
                        <?foreach($arResult["SECTIONS"] as $section): ?>
                            <a class="refKat" href="<?=$section["SECTION_PAGE_URL"];?>" title="<?=$section["NAME"];?>"><span class="title"><?=$section["NAME"];?></span></a>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endif;?>