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

//vardump($arResult['PICTURES']);
?>

<?
// Слайдшоу -->
if (!empty($arResult['ID'])) {
  $this->SetViewTarget('slideShow');
  //ob_start();
?>
  <?
  $this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
  <div id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
    <? foreach ($arResult['PICTURES'] as $key => $arFileCustom) { ?>
      <div class="slide" itemscope="" itemtype="https://schema.org/ImageObject">
        <meta itemprop="contentUrl" content="">
        <meta itemprop="thumbnailUrl" content="">
        <img class="bbimg" src="<?= $arFileCustom['SRC'] ?>" sizes="100vw" style="object-position:50% 50%;" width="1920" height="750" alt="<?= $arFileCustom['ALT'] ?>" title="<?= $arFileCustom['TITLE'] ?>" />
        <? if (strlen($arFileCustom['DESCRIPTION']) > 0) { ?>
          <div class="subtitle">
            <div class="description" itemprop="description"><?= $arFileCustom['DESCRIPTION']; ?></div>
          </div>
        <? } ?>
      </div>
    <? } ?>
  </div>
<?
  $this->EndViewTarget();
  //$out1 = ob_get_contents();
  //ob_end_clean();
  //$APPLICATION->AddViewContent('slideShow', $out1);
}
// <-- Слайдшоу
?>

<?
// Данные, которые были в хедере -->
?>
<?
$GLOBALS['PAGE_H1'] = $arResult['NAME'];
$GLOBALS['PAGE_H2'] = $arResult['DISPLAY_PROPERTIES']['H_2']['VALUE'];
$GLOBALS['PAGE_DESCRIPTION'] = $arResult['~DETAIL_TEXT'];
$GLOBALS['RED_BLOCK'] = $arResult['DISPLAY_PROPERTIES']['RED_BLOCK']['DISPLAY_VALUE'];
include($_SERVER["DOCUMENT_ROOT"] . "/include/header_first_content.php");
?>
<?
// <-- Данные, которые были в хедере
?>
<?
/*
  // Дата -->
  if ($arParams['DISPLAY_DATE'] == 'Y') {
    $this->SetViewTarget('NEWS_DATE');
  ?>
    <div class="artikelMeta">
      <span class="datum"><? echo FormatDate("j F Y", MakeTimeStamp($arResult['DATE_CREATE'])); ?></span>
    </div>
  <?
    $this->EndViewTarget();
  }
  // <-- Дата
  */
?>

<?
// Галерея -->
if (!empty($arResult['PICTURES_GALLERY'])) {
?>
  <div id="cs-Galerie" class="pb2020 productSection wideGallery">
    <div class="sectionContent gallery">
      <div class="gallerySwitch"><span class="galleryOpener">Открыть галерею</span><span class="galleryCloser">Закрыть галерею</span></div>
      <?
      $bCentered = false;
			if (!empty($arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'])) {
				if ($arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'] == 'Y') {
					$bCentered = true;
				}
			}
      /*
      if (
        (
        !isset($arResult['PROPERTIES']['CENTERED'])
        || (
          isset($arResult['PROPERTIES']['CENTERED'])
          && $arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'] == 'Y'
        )
        )
        && $arResult['PROPERTIES']['CENTERED']['VALUE_XML_ID'] != 'N'
      ) {
        $bCentered = true;
      }
      */
      ?>
      <div id="JustifiedGallery" class="justified-gallery<? if ($bCentered) { ?> centered<? } ?> <? if (is_array($arResult['PICTURES_GALLERY']) && count($arResult['PICTURES_GALLERY']) == 1) : ?> one-item<? endif; ?>">

        <? foreach ($arResult['PICTURES_GALLERY'] as $key => $arFile) { ?>
          <div itemscope itemtype="https://schema.org/ImageObject" class="inspirationsBild" title="">
            <img loading="lazy" src="<?= $arFile['SRC']; ?>" alt="<?= $arFile['ALT']; ?>" title="<?= $arFile['TITLE']; ?>" width="<?= $arFile['WIDTH']; ?>" height="<?= $arFile['HEIGHT']; ?>" />
            <meta itemprop="contentUrl" content="<?= $arFile['SOURCE_PICTURE']['SRC']; ?>" />
            <meta itemprop="description" content="<?= $arFile['TITLE']; ?>" />
            <meta itemprop="thumbnailUrl" content="<?= $arFile['SRC']; ?>" />
            <div class="interaction"><span class="butty galThumb lupe full insp-icon iconfont " data-mfp-src="<?= $arFile['SOURCE_PICTURE']['SRC']; ?>" title="">&#xe815;</span></div>
          </div>
        <? } ?>

      </div>
    </div>
  </div>
<?
}
// <-- Галерея
?>

<?
// Таблица -->
//vardump($arResult['DISPLAY_PROPERTIES']['TABLE']);
?>
<? if (!empty($arResult['DISPLAY_PROPERTIES']['TABLES']['VALUE'])) { ?>
  <?
  foreach ($arResult['DISPLAY_PROPERTIES']['TABLES']['VALUE'] as $key => $ar) {
  ?>
    <div id="ContentSections-Content" class="contentSectionArea">
      <div id="cs-473" class="contentSection  bgGrau noparallax ">
        <div class="csContent responsiveBlock">
          <? if (strlen($ar['SUB_VALUES']['TABLE_HEADER']['VALUE']) > 0) { ?>
            <h2 class="sectionTitle smallTitle checkR"><?= $ar['SUB_VALUES']['TABLE_HEADER']['VALUE']; ?></h2>
          <? } ?>
          <div class="blockContent">
            <div class="tablewrapper format-table-wrapper">
              <?= $ar['SUB_VALUES']['TABLE']['~VALUE']['TEXT']; ?>
              <? if (strlen($ar['SUB_VALUES']['TABLE_AFTER_TEXT']['~VALUE']['TEXT']) > 0) { ?>
                <p class="small"><?= $ar['SUB_VALUES']['TABLE_AFTER_TEXT']['~VALUE']['TEXT']; ?></p>
              <? } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <? } ?>
<? } ?>

<?
// Преимущества -->
if (!empty($arResult['arAdvantages'])) {
?>
  <div id="cs-Eigenschaften" class="contentSection respCElement  ">
    <div class="csContent responsiveBlock checkR">
      <?/*?>
      <h2 class="csHeadline">Eigenschaften</h2>
      <?*/ ?>
      <div class="esIconBlock">
        <? foreach ($arResult['arAdvantages'] as $key => $val) { ?>
          <div class="esIcon">
            <img class="iconimg" alt="<?= $val['PICTURE']['ALT'] ?>" src="<?= $val['PICTURE']['SRC'] ?>" width="40" />
            <div class="esIconTxt">
              <h3><?= $val['HEADER'] ?></h3>
              <p><?= $val['TEXT'] ?></p>
            </div>
          </div>
        <? } ?>
      </div>
    </div>
  </div>
<?
}
// <-- Преимущества
?>