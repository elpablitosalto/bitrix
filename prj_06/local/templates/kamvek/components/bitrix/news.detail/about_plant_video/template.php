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
?>

<? if (strlen($arResult['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE']) > 0) { ?>
  <div id="ContentSections" class="contentSectionArea">
    <div id="cs-227" class="contentSection csvideo bgGrau noparallax smallwidImg ">
      <?
      $h2 = 'Видео';
      if (strlen($arParams['VIDEO_SECTION_HEADER']) > 0) {
        $h2 = $arParams['VIDEO_SECTION_HEADER'];
      }
      ?>
      <div class="csTitle responsiveBlock">
        <h2 class="csHeadline"><?= $h2; ?></h2>
      </div>
      <?
      $arYouTubeUrlParts = parse_url($arResult['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE']);
      $videoCode = str_replace('/embed/', '', $arYouTubeUrlParts['path']);
      ?>
      <div class="csImage smallWid video ">
        <img class="preview" loading="lazy" src="<? if (isset($arResult['DISPLAY_PROPERTIES']['VIDEO_PREVIEW']['FILE_VALUE']['SRC'])) : ?><?= $arResult['DISPLAY_PROPERTIES']['VIDEO_PREVIEW']['FILE_VALUE']['SRC']; ?><? else : ?>https://img.youtube.com/vi/<?= $videoCode ?>/maxresdefault.jpg<? endif; ?>" alt="Видео" />
        <div id='player-227' data-id="227" class="videoFrame lazy plyr__video-embed" data-plyr-provider="youtube" data-type="youtube" data-plyr-embed-id="<?= $videoCode ?>" data-plyr-config="{'autoplay':'false','noCookie':'true'}" style="--plyr-color-main: #b70c1d;">
          <span class="play"></span>
        </div>
      </div>
      <? if (!empty($arResult['DISPLAY_PROPERTIES']['VIDEO_DESCRIPTION']['DISPLAY_VALUE'])) { ?>
        <div class="csContent responsiveBlock">
          <div class="page-opener-description video-desc">
            <h3><?= $arResult['DISPLAY_PROPERTIES']['VIDEO_SUBTITLE']['DISPLAY_VALUE']; ?></h3>
            <p><?= $arResult['DISPLAY_PROPERTIES']['VIDEO_DESCRIPTION']['DISPLAY_VALUE']; ?></p>
          </div>
        </div>
      <? } ?>
    </div>
  </div>
  <?/*?>
  <div class="contentSectionArea">
    <div class="content centerMargin contentSection csvideo bgGrau" style="text-align: center;">
      <iframe width="560" height="315" src="<?= $arResult['DISPLAY_PROPERTIES']['VIDEO_LINK']['VALUE'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
  </div>
  <?*/ ?>
<? } ?>

