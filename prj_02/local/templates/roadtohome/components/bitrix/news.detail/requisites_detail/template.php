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

CJSCore::Init(array('clipboard'));
?>
<section class="contacts-requisites">
	<div class="container">
     <div class="section__content">
      <div class="section__head">
    	<h3 class="section__title"><?=$arResult["NAME"]?></h3>
		<?if(!empty($arResult["PROPERTIES"]["FILE"]["VALUE"])) {?>
        	<div class="section__nav">
				<a href="<?=CFile::GetPath($arResult["PROPERTIES"]["FILE"]["VALUE"])?>" target="_blank" class="contacts-requisites__download"><span>Скачать</span>
            		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-download">
                		<use xlink:href="#download"></use>
	                </svg>
				</a>
			</div>
        <?}?>
	  </div>

	  <?if (count($arResult["PROPERTIES"]["REQUISITE"]['VALUE']) > 0) {?>
      	<div class="items-list requisites-list text-size-lg">
	  		<?foreach ($arResult["PROPERTIES"]["REQUISITE"]['VALUE'] as $pos => $requisite)  {?>
                <div class="list-item requisites-item">
                  <div class="requisites-item__name"><?=$requisite['SUB_VALUES']["REQUISITE_NAME"]["VALUE"]?></div>
                  <div class="requisites-item__value"><?=$requisite['SUB_VALUES']["REQUISITE_VALUE"]["VALUE"]?></div>
                  <button type="button" class="requisites-item__copy" id="req<?=$pos?>">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-copy2" onclick="copyReq('req<?=$pos?>');">
                      <use xlink:href="#copy2"></use>
                    </svg>
                  </button>
                </div>
			<?}?>
		</div>
	  <?}?>

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
 <input type="hidden" id="balloonContent" value="<?=htmlspecialchars($arResult["PREVIEW_TEXT"])?>" />
 <input type="hidden" id="lat" value="<?=$arResult["DISPLAY_PROPERTIES"]["LATITUDE"]["DISPLAY_VALUE"]?>" />
 <input type="hidden" id="lon" value="<?=$arResult["DISPLAY_PROPERTIES"]["LONGITUDE"]["DISPLAY_VALUE"]?>" />
 <section class="contacts-map-block">
	<div class="container">
    	<div id="contacts-map" class="contacts-map"></div>
    </div>
 </section>

<?}?>

<script>
 // копирование в буфер
 function copyReq(id) {
	let reqId = id;
	bId = "#"+id;
	let reqValue = $(bId).closest(".requisites-item").find(".requisites-item__value").html();
	//alert(reqValue);
	BX.clipboard.bindCopyClick(	
	    BX(reqId), 
    	{
        	text: reqValue
	    }
	);
 }
/*
 // в данном варианте работает только со 2-го клика по кнопке, сделан вызов функции непосредственно на svg
 $( document ).ready(function() {
	$('.requisites-item__copy').on('click', function(event) {
		event.preventDefault();
		copyReq($(this).attr("id"));	
	});
 });
*/
</script>
