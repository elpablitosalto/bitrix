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
?>

<?
$curVideoPoster =  SITE_TEMPLATE_PATH . "/img/content/catalog/item.jpg";
$curVideo = SITE_TEMPLATE_PATH."/img/content/catalog/catalog.mp4";
?>
<div class="catalog-link-category catalog-link-category--catalog" id="filter-start">
    <a class="catalog-link-category__item<?if(!mb_strlen($arParams["CURRENT_CODE"])){?> catalog-link-category--active<?}?>" href="<?=$arParams["SEF_FOLDER"]?>">Вся продукция</a>
    <?foreach($arResult["SECTIONS"] as $section){
        $class = "";
        if($arParams["CURRENT_CODE"] == $section["CODE"]){
            $class = " catalog-link-category--active";
            if(isset($section["UF_VIDEO"]) && $section["UF_VIDEO"] > 0)
                $curVideo = CFile::GetPath($section["UF_VIDEO"]);
            if(isset($section["UF_POSTER"]) && $section["UF_POSTER"] > 0)
                $curVideoPoster = CFile::GetPath($section["UF_POSTER"]);
        }
        ?>
        <a class="catalog-link-category__item<?=$class?>" href="<?=$section["SECTION_PAGE_URL"]?>">
            <?=$section["NAME"]?>
        </a>
    <?}?>
</div>

<?$this->SetViewTarget('top_video');?>
<div class="header-top-banner__content">
    <div class="header-top-banner__video">
        <div class="header-top-banner__play">
            <img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/play.png"></div>
        <div class="header-top-banner__pause"><img src="<?= SITE_TEMPLATE_PATH ?>/img/icons/pause.svg"></div>
<!--        <video preload="none" poster="--><?php //=$curVideoPoster?><!--">-->
        <video preload="metadata">
            <source src="<?=$curVideo?>" type="video/mp4">
        </video>
    </div>
</div>
<?$this->EndViewTarget();?>


