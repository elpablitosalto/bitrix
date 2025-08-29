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

<ul class="c-menu__category-list">
    <!--li: a.c-menu__category-item.c-menu--active(data-menu-link-id="1") Вся продукция-->
    <li><a class="c-menu__category-item" data-menu-link-id="1">Вся продукция</a></li>
    <?
    $i = 2;
    ?>
    <? foreach ($arResult["SECTIONS"] as $section) {
        $this->AddEditAction($section['ID'], $section['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($section['ID'], $section['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
        <li id="<? echo $this->GetEditAreaId($section['ID']); ?>">
            <a class="c-menu__category-item" data-menu-link-id="<?= $i; ?>" href="<?= $section['SECTION_PAGE_URL']; ?>"><?= $section['NAME']; ?></a>
        </li>
        <?
        $i++;
        ?>
    <? } ?>
</ul>
<div class="c-menu__category-img">
    <img class="c-menu__link--active" src="<?= SITE_TEMPLATE_PATH ?>/img/content/top-banner/top-banner.jpg" data-menu-link-id="1">
    <?
    $i = 2;
    ?>
    <? foreach ($arResult["SECTIONS"] as $section) { ?>
        <img src="<?= $section['PICTURE']['SRC']; ?>" alt="<?= $section['PICTURE']['ALT']; ?>" title="<?= $section['PICTURE']['TITLE']; ?>" data-menu-link-id="<?= $i; ?>" />
        <?
        $i++;
        ?>
    <? } ?>
    <?/*?>
    <img src="<?= SITE_TEMPLATE_PATH ?>/img/content/about/productions.jpg" data-menu-link-id="2">
    <img src="<?= SITE_TEMPLATE_PATH ?>/img/content/about/poster.jpg" data-menu-link-id="3">
    <?*/ ?>
</div>