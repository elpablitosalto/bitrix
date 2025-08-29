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


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<section class="catalog-block">
    <h2>Каталог продукции</h2>

    <div class="catalog-link-category">

        <a class="catalog-link-category__item" href="/catalog/" data-catalog-link-id="catalog_link">Вся продукция</a>

        <?foreach($arResult["SECTIONS"] as $section){

    if(!isset($section["PICTURE"]["ID"]) || !($section["PICTURE"]["ID"]) )
        continue;

    $this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <a  id="<? echo $this->GetEditAreaId($section['ID']); ?>" href="<?=$section["SECTION_PAGE_URL"]?>" class="catalog-link-category__item" data-catalog-link-id="<?=$section["ID"]?>"><?=$section["NAME"]?></a>
<?}?>
    </div>
    <div class="catalog-link-category__images">
        <div class="catalog-link-category__img catalog-link-category--active" data-catalog-link-id="catalog_link"
             style="background-image: url('/local/templates/dirui/img/content/catalog/item.jpg')"></div>
        <?foreach($arResult["SECTIONS"] as $section){
        ?>
        <div class="catalog-link-category__img catalog-link-category--active" data-catalog-link-id="<?=$section["ID"]?>"
             style="background-image: url('<?=$section["PICTURE"]["SAFE_SRC"]?>')"></div>
        <?}?>
    </div>
</section>