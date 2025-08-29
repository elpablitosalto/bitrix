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
<?
$addrContent = '';
if(!empty($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"])) {
	$addrContent = $addrContent.'<p><span class="title">Адрес:</span> '.$arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"].'</p>';
}
if(!empty($arResult["DISPLAY_PROPERTIES"]["PHONE_INFO"]["DISPLAY_VALUE"])) {
	$addrContent = $addrContent.'<p><span class="title">Информационный сектор:</span> '.
	'<a href="tel:'.$arResult["DISPLAY_PROPERTIES"]["PHONE_INFO"]["DISPLAY_VALUE"].'"><u>'.$arResult["DISPLAY_PROPERTIES"]["PHONE_INFO"]["DISPLAY_VALUE"].'</u></a>'.
	'</p>';
}
if(!empty($arResult["DISPLAY_PROPERTIES"]["PHONE_911"]["DISPLAY_VALUE"])) {
	//$addrContent = $addrContent.'<p><span class="title">Телефон оперативной помощи:</span> '.
	$addrContent = $addrContent.'<p><span class="title">Телефон доверия:</span> '.
	'<a href="tel:'.$arResult["DISPLAY_PROPERTIES"]["PHONE_911"]["DISPLAY_VALUE"].'"><u>'.$arResult["DISPLAY_PROPERTIES"]["PHONE_911"]["DISPLAY_VALUE"].'</u></a>'.
	'</p>';
}
if(!empty($arResult["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"])) {
	$addrContent = $addrContent.'<p><span class="title">Электронная почта:</span> '.
	'<a href="mailto:'.$arResult["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"].'"><u>'.$arResult["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"].'</u></a>'.
	'</p>';
}
$balloonContent = $addrContent;
if(!empty($arResult["DISPLAY_PROPERTIES"]["VK_LINK"]["DISPLAY_VALUE"])) {
	$addrContent = $addrContent.'<p><span class="title">Группа ВКонтакте:</span> '.
	'<a href="'.$arResult["DISPLAY_PROPERTIES"]["VK_LINK"]["VALUE"].'" target="_blank"><u>'.$arResult["DISPLAY_PROPERTIES"]["VK_LINK"]["VALUE"].'</u></a>'.
	'</p>';
}
if(!empty($arResult["DISPLAY_PROPERTIES"]["YOUTUBE_LINK"]["DISPLAY_VALUE"])) {
	$addrContent = $addrContent.'<p><span class="title">Канал на Youtube:</span> '.
	'<a href="'.$arResult["DISPLAY_PROPERTIES"]["YOUTUBE_LINK"]["VALUE"].'" target="_blank"><u>'.$arResult["DISPLAY_PROPERTIES"]["YOUTUBE_LINK"]["VALUE"].'</u></a>'.
	'</p>';
}
?>

<section class="contacts-main">
	<div class="container">
    	<h3 class="section__title"><?=$arResult["NAME"]?></h3>
        <div class="text-size-lg section__content"><?=$addrContent?></div>
        <div class="section__nav">
        	<div class="buttons-line"><a href="#site-callback" data-scroll-to="#site-callback" class="btn">Связаться с нами</a></div>
        </div>
    </div>
</section>


<?if((!empty($arResult["DISPLAY_PROPERTIES"]["LATITUDE"]["DISPLAY_VALUE"])) && (!empty($arResult["DISPLAY_PROPERTIES"]["LONGITUDE"]["DISPLAY_VALUE"]))){
  if(empty($arResult["DISPLAY_PROPERTIES"]["BALLOON_HEADER"]["DISPLAY_VALUE"])) {
	$balloonHeader = $arResult["NAME"];
  } else {
	$balloonHeader = $arResult["DISPLAY_PROPERTIES"]["BALLOON_HEADER"]["DISPLAY_VALUE"];
  }
  ?>
 <input type="hidden" id="balloonHeader" value="<?=htmlspecialchars($balloonHeader)?>" />
 <input type="hidden" id="balloonContent" value="<?=htmlspecialchars($balloonContent)?>" />
 <input type="hidden" id="lat" value="<?=$arResult["DISPLAY_PROPERTIES"]["LATITUDE"]["DISPLAY_VALUE"]?>" />
 <input type="hidden" id="lon" value="<?=$arResult["DISPLAY_PROPERTIES"]["LONGITUDE"]["DISPLAY_VALUE"]?>" />
 <section class="contacts-map-block">
	<div class="container">
    	<div id="contacts-map" class="contacts-map"></div>
    </div>
 </section>

<?}?>


