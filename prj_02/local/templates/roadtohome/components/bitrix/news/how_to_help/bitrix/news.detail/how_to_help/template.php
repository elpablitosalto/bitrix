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

//use Bitrix\Main\Grid\Declension;
//$rDeclension = new Declension('рубль', 'рубля', 'рублей');

/*
// перенесено в header.php
use \Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/targeted-assistance.js");
*/

$this->setFrameMode(true);
?>
<?
$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<section class="targeted-assistance-main" id="<?= $this->GetEditAreaId($arResult['ID']); ?>">
<div class="container">
<div class="row">

<div class="col-md-8 targeted-assistance-main__wrapper">
	<div class="targeted-assistance-main__info">
    	<h3 class="targeted-assistance-main__title"><?=$arResult["NAME"]?></h3>
        <div class="sub-title text-color-gray"><?=$arResult["ACTIVE_FROM"]?></div>
		<?if ($arResult["TAGS"]) {
			$tags = explode(',', $arResult["TAGS"]);
		?>				
            <div class="targeted-assistance-main__tags">
				<?foreach ($tags as $tag) {?>
					<span><?echo trim($tag);?></span>
				<?}?>
			</div>
		<?}?>
        <div class="targeted-assistance-main__desc">
        	<div class="text-expand-content detail_text"><div class="detail_text_inner"><?=$arResult["DETAIL_TEXT"]?></div></div>
			<a class="div text-expand-controller"><u>Читать полностью</u></a>
        </div>

        <div class="kurator-card">
			<?if ($arResult['DISPLAY_PROPERTIES']['CURATOR']['VALUE']) {?>
				<?if (isset($arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PICTURE'])) {?>
                    <div class="kurator-card__image">
                      <picture>
						<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/loader.svg" data-src="<?=$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PICTURE']?>" loading="lazy" alt="<?=$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['NAME']?>" title="<?=$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['NAME']?>" />
                      </picture>
                    </div>
				<?}?>
                <div class="kurator-card__desc">
                	<div class="kurator-card__name"><?=$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['NAME']?></div>
					<?if(strlen($arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['POSITION'])>0) {?>					
                      <div class="kurator-card__job"><?=$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['POSITION']?></div>
					<?}?>
					<?if(isset($arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PHONE'])) {?>	
						<a class="kurator-card__phone" href="tel:+<?=$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PHONE']['TRIM']?>">
                        	<u><?=$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PHONE']['SRC']?></u>
						</a>				
						<a class="kurator-card__question" href="https://wa.me/<?=$arResult['DISPLAY_PROPERTIES']['CURATOR']['DATA']['PHONE']['TRIM']?>" target="_blank">
                        	<u>Задать вопрос куратору</u>
						</a>
					<?}?>
                </div>
			<?}?>
        </div>

    </div>
</div>

<?
$totalProds = 0;
$closedProds = 0;
$donat = [];

$categoryProds = [];
foreach ($arResult['DISPLAY_PROPERTIES']['ITEM']["~VALUE"] as $pos => $prodItem) {
	$totalProds++; 
	if ($prodItem["SUB_VALUES"]["ITEM_CLOSED"]["VALUE"] == 'Да') {
		$closedProds++;
		if(strlen($prodItem["SUB_VALUES"]["ITEM_DONATOR"]["VALUE"]) > 0) {
			$donat[] = [0 => $prodItem["SUB_VALUES"]["ITEM_NAME"]["VALUE"], 1 => $prodItem["SUB_VALUES"]["ITEM_DONATOR"]["VALUE"]];
		}
	} 
	$categoryProds[$prodItem["SUB_VALUES"]["ITEM_CATEGORY"]["VALUE"]][$pos] = $prodItem["SUB_VALUES"];
}   
?>

<div class="col-md-4 targeted-assistance-main__img">

<?if (($totalProds == $closedProds) || ($arResult['PROPERTIES']['CLOSED']['VALUE'] == 'Да')) { 
$donat_text = 'Мы собрали всё!';?>
<div class="targeted-assistance__status-img animate-svg-image"><span class="h4 text">Мы собрали всё!</span><svg class="image box-heart" width="233" height="274" viewBox="0 0 233 274" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path class="box-heart__box" d="M4 270V122H229V270H4Z" stroke="#FFE271" stroke-width="8"/>
    <path class="box-heart__text" d="M62.684 201V187.116H75.996V201H72.772V189.118L73.526 189.872H65.18L65.934 189.118V201H62.684ZM86.5693 201.182C85.1479 201.182 83.8826 200.879 82.7733 200.272C81.6639 199.648 80.7886 198.799 80.1473 197.724C79.5059 196.649 79.1853 195.427 79.1853 194.058C79.1853 192.671 79.5059 191.449 80.1473 190.392C80.7886 189.317 81.6639 188.477 82.7733 187.87C83.8826 187.263 85.1479 186.96 86.5693 186.96C88.0079 186.96 89.2819 187.263 90.3913 187.87C91.5179 188.477 92.3933 189.309 93.0173 190.366C93.6586 191.423 93.9793 192.654 93.9793 194.058C93.9793 195.427 93.6586 196.649 93.0173 197.724C92.3933 198.799 91.5179 199.648 90.3913 200.272C89.2819 200.879 88.0079 201.182 86.5693 201.182ZM86.5693 198.4C87.3666 198.4 88.0773 198.227 88.7013 197.88C89.3253 197.533 89.8106 197.031 90.1573 196.372C90.5213 195.713 90.7033 194.942 90.7033 194.058C90.7033 193.157 90.5213 192.385 90.1573 191.744C89.8106 191.085 89.3253 190.583 88.7013 190.236C88.0773 189.889 87.3753 189.716 86.5953 189.716C85.7979 189.716 85.0873 189.889 84.4633 190.236C83.8566 190.583 83.3713 191.085 83.0073 191.744C82.6433 192.385 82.4613 193.157 82.4613 194.058C82.4613 194.942 82.6433 195.713 83.0073 196.372C83.3713 197.031 83.8566 197.533 84.4633 197.88C85.0873 198.227 85.7893 198.4 86.5693 198.4ZM97.1899 201V187.116H100.596L106.186 196.97H104.834L110.71 187.116H113.752L113.778 201H110.84V190.6L111.36 190.938L106.16 199.544H104.756L99.5299 190.704L100.154 190.548V201H97.1899ZM124.325 201.182C122.904 201.182 121.638 200.879 120.529 200.272C119.42 199.648 118.544 198.799 117.903 197.724C117.262 196.649 116.941 195.427 116.941 194.058C116.941 192.671 117.262 191.449 117.903 190.392C118.544 189.317 119.42 188.477 120.529 187.87C121.638 187.263 122.904 186.96 124.325 186.96C125.764 186.96 127.038 187.263 128.147 187.87C129.274 188.477 130.149 189.309 130.773 190.366C131.414 191.423 131.735 192.654 131.735 194.058C131.735 195.427 131.414 196.649 130.773 197.724C130.149 198.799 129.274 199.648 128.147 200.272C127.038 200.879 125.764 201.182 124.325 201.182ZM124.325 198.4C125.122 198.4 125.833 198.227 126.457 197.88C127.081 197.533 127.566 197.031 127.913 196.372C128.277 195.713 128.459 194.942 128.459 194.058C128.459 193.157 128.277 192.385 127.913 191.744C127.566 191.085 127.081 190.583 126.457 190.236C125.833 189.889 125.131 189.716 124.351 189.716C123.554 189.716 122.843 189.889 122.219 190.236C121.612 190.583 121.127 191.085 120.763 191.744C120.399 192.385 120.217 193.157 120.217 194.058C120.217 194.942 120.399 195.713 120.763 196.372C121.127 197.031 121.612 197.533 122.219 197.88C122.843 198.227 123.545 198.4 124.325 198.4ZM144.28 198.244L143.578 199.024V187.116H146.828V199.024L146.048 198.244H152.912L152.158 199.024V187.116H155.408V201H134.946V187.116H138.196V199.024L137.442 198.244H144.28ZM154.368 203.86V200.194L155.122 201H152.054V198.244H157.41V203.86H154.368ZM166.746 191.692C168.531 191.692 169.892 192.091 170.828 192.888C171.764 193.685 172.232 194.812 172.232 196.268C172.232 197.776 171.712 198.955 170.672 199.804C169.632 200.636 168.167 201.043 166.278 201.026L159.778 201V187.116H163.028V191.666L166.746 191.692ZM165.992 198.634C166.945 198.651 167.673 198.452 168.176 198.036C168.678 197.62 168.93 197.013 168.93 196.216C168.93 195.419 168.678 194.847 168.176 194.5C167.69 194.136 166.962 193.945 165.992 193.928L163.028 193.902V198.608L165.992 198.634Z" fill="#FFE271"/>
    <rect class="box-heart__button" x="35" y="167" width="164" height="57" rx="28.5" stroke="#FFE271" stroke-width="8"/>
    <path class="box-heart__heart" d="M145.547 122.121C181.175 102.72 207.106 77.9665 207.115 49.4778C207.126 15.5342 178.752 2.3785 156.66 5.17708C134.569 7.97566 110.178 41.8876 110.178 41.8876C110.178 41.8876 78.815 5.024 49.6579 24.3316C32.3489 35.7935 29.2456 63.6385 43.2984 86.9723C51.933 101.31 64.2609 111.959 78.3413 122.121" stroke="#FFE271" stroke-width="8"/>
	</svg>
</div>
<?} elseif  ($closedProds >= $totalProds/2) {
$donat_text = 'Почти собрали!';?>
<div class="targeted-assistance__status-img animate-svg-image"><span class="h4 text">Почти собрали!</span><svg class="image box-wash" width="278" height="282" viewBox="0 0 278 282" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path class="box-wash__box" d="M4 95L42.452 149.315M42.452 149.315V278H238.056V149.315M42.452 149.315H238.056M238.056 149.315L274 95" stroke="#FFE271" stroke-width="8"/>
    <path class="box-wash__text" d="M86.184 221.5V207.616H99.496V221.5H96.272V209.618L97.026 210.372H88.68L89.434 209.618V221.5H86.184ZM110.069 221.682C108.648 221.682 107.383 221.379 106.273 220.772C105.164 220.148 104.289 219.299 103.647 218.224C103.006 217.149 102.685 215.927 102.685 214.558C102.685 213.171 103.006 211.949 103.647 210.892C104.289 209.817 105.164 208.977 106.273 208.37C107.383 207.763 108.648 207.46 110.069 207.46C111.508 207.46 112.782 207.763 113.891 208.37C115.018 208.977 115.893 209.809 116.517 210.866C117.159 211.923 117.479 213.154 117.479 214.558C117.479 215.927 117.159 217.149 116.517 218.224C115.893 219.299 115.018 220.148 113.891 220.772C112.782 221.379 111.508 221.682 110.069 221.682ZM110.069 218.9C110.867 218.9 111.577 218.727 112.201 218.38C112.825 218.033 113.311 217.531 113.657 216.872C114.021 216.213 114.203 215.442 114.203 214.558C114.203 213.657 114.021 212.885 113.657 212.244C113.311 211.585 112.825 211.083 112.201 210.736C111.577 210.389 110.875 210.216 110.095 210.216C109.298 210.216 108.587 210.389 107.963 210.736C107.357 211.083 106.871 211.585 106.507 212.244C106.143 212.885 105.961 213.657 105.961 214.558C105.961 215.442 106.143 216.213 106.507 216.872C106.871 217.531 107.357 218.033 107.963 218.38C108.587 218.727 109.289 218.9 110.069 218.9ZM120.69 221.5V207.616H124.096L129.686 217.47H128.334L134.21 207.616H137.252L137.278 221.5H134.34V211.1L134.86 211.438L129.66 220.044H128.256L123.03 211.204L123.654 211.048V221.5H120.69ZM147.825 221.682C146.404 221.682 145.138 221.379 144.029 220.772C142.92 220.148 142.044 219.299 141.403 218.224C140.762 217.149 140.441 215.927 140.441 214.558C140.441 213.171 140.762 211.949 141.403 210.892C142.044 209.817 142.92 208.977 144.029 208.37C145.138 207.763 146.404 207.46 147.825 207.46C149.264 207.46 150.538 207.763 151.647 208.37C152.774 208.977 153.649 209.809 154.273 210.866C154.914 211.923 155.235 213.154 155.235 214.558C155.235 215.927 154.914 217.149 154.273 218.224C153.649 219.299 152.774 220.148 151.647 220.772C150.538 221.379 149.264 221.682 147.825 221.682ZM147.825 218.9C148.622 218.9 149.333 218.727 149.957 218.38C150.581 218.033 151.066 217.531 151.413 216.872C151.777 216.213 151.959 215.442 151.959 214.558C151.959 213.657 151.777 212.885 151.413 212.244C151.066 211.585 150.581 211.083 149.957 210.736C149.333 210.389 148.631 210.216 147.851 210.216C147.054 210.216 146.343 210.389 145.719 210.736C145.112 211.083 144.627 211.585 144.263 212.244C143.899 212.885 143.717 213.657 143.717 214.558C143.717 215.442 143.899 216.213 144.263 216.872C144.627 217.531 145.112 218.033 145.719 218.38C146.343 218.727 147.045 218.9 147.825 218.9ZM167.78 218.744L167.078 219.524V207.616H170.328V219.524L169.548 218.744H176.412L175.658 219.524V207.616H178.908V221.5H158.446V207.616H161.696V219.524L160.942 218.744H167.78ZM177.868 224.36V220.694L178.622 221.5H175.554V218.744H180.91V224.36H177.868ZM190.246 212.192C192.031 212.192 193.392 212.591 194.328 213.388C195.264 214.185 195.732 215.312 195.732 216.768C195.732 218.276 195.212 219.455 194.172 220.304C193.132 221.136 191.667 221.543 189.778 221.526L183.278 221.5V207.616H186.528V212.166L190.246 212.192ZM189.492 219.134C190.445 219.151 191.173 218.952 191.676 218.536C192.178 218.12 192.43 217.513 192.43 216.716C192.43 215.919 192.178 215.347 191.676 215C191.19 214.636 190.462 214.445 189.492 214.428L186.528 214.402V219.108L189.492 219.134Z" fill="#FFE271"/>
    <rect class="box-wash__button" x="70" y="190" width="141" height="48" rx="24" stroke="#FFE271" stroke-width="8"/>
    <circle class="box-wash__wash-circle-big" cx="139.11" cy="97.066" r="35.7538" transform="rotate(-30.3136 139.11 97.066)" stroke="#FFE271" stroke-width="8"/>
    <circle class="box-wash__wash-circle-small" cx="138.894" cy="96.7034" r="21.1077" transform="rotate(-30.3136 138.894 96.7034)" stroke="#FFE271" stroke-width="8"/>
    <path class="box-wash__wash" d="M66.4939 76.5039L56.1445 58.8027L80.7094 44.4404M66.4939 76.5039L91.0587 62.1415M66.4939 76.5039L108.702 148.696L161.896 148.696L212.566 119.071L156.806 23.7012M156.806 23.7012L146.457 6.00001L80.7094 44.4404M156.806 23.7012L91.0587 62.1415M80.7094 44.4404L91.0587 62.1415" stroke="#FFE271" stroke-width="8"/>
	</svg>
</div>
<?} else {
$donat_text = 'Нужна помощь!';?>
<div class="targeted-assistance__status-img animate-svg-image"><span class="h4 text">Нужна помощь!</span><svg class="image heart" width="229" height="230" viewBox="0 0 229 230" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0.74501 175.755C0.74501 175.755 35.4026 173.194 99.0431 154.835C162.684 136.475 218.732 105.328 222.626 61.8515C226.1 23.0656 195.021 5.1394 169.493 6.0845C143.966 7.0296 112.638 43.2931 112.638 43.2931C112.638 43.2931 80.5615 -2.0287 45.2769 17.0606C24.3302 28.3928 17.9444 59.8945 31.6215 87.9908C41.8207 108.942 58.7894 124.242 77.9806 140.072C97.1717 155.903 149.981 201.169 187.458 223.999" stroke="#FFE271" stroke-width="12"/>
	</svg>
</div>
<?}?>

<? if(count($donat)>0) {?>
	<div class="targeted-assistance-close-info" style="display:block;">
    	<div class="targeted-assistance-close-info__wrapper">
        	<div class="targeted-assistance-close-info__title">Искренне благодарим всех, кто помог!</div>
            	<div class="targeted-assistance-close-info__img">
                	<picture>
						<img class="lazyload" src="<?= SITE_TEMPLATE_PATH ?>/images/heart-vector.svg" data-src="<?= SITE_TEMPLATE_PATH ?>/images/heart-vector.svg" loading="lazy" alt="<?=$donut_text;?>" title="<?=$donut_text;?>">
                    </picture>
            </div>
        </div>
        <ul class="targeted-assistance-close-info__list">
			<?foreach($donat as $donat_item) { ?>
           		<li class="targeted-assistance-close-info__item">
					<span class="targeted-assistance-close-info__short"><?=$donat_item[0]?></span>
					<span class="targeted-assistance-close-info__name"><?=$donat_item[1]?></span>
				</li>
			<?}?>
        </ul>
	</div>
<?}?>

</div>


<div class="col-md-8 targeted-assistance-how-help__wrapper">
	<div class="targeted-assistance-how-help">
    	<h2 class="targeted-assistance-how-help__title">Чем помочь</h2>

        <div class="targeted-assistance-how-help__category swiper-container">
        <div class="swiper-wrapper">
		<?
		$itemActiveClass = 'targeted-assistance-how-help__category-item--active';
		$itemActive = $itemActiveClass;
		?>
        <?foreach ($categoryProds as $category => $categoryItems) {?>
        	<div class="swiper-slide"><a href="" data-id="<?=$arResult['THCATEGORY']['LEGEND'][$category]['ID']?>" class="category-link targeted-assistance-how-help__category-item <? echo $itemActive; $itemActive='';?>">
            	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-<?=$arResult['THCATEGORY']['LEGEND'][$category]['ICON']?> icon--square-stroke">
                	<use xlink:href="#<?=$arResult['THCATEGORY']['LEGEND'][$category]['ICON']?>"></use>
                </svg>
				<span><?=$arResult['THCATEGORY']['LEGEND'][$category]['NAME']?></span></a>
			</div>
		<?}?>
        </div>
        </div>

		<?$itemActive = 'block;'?>
        <?foreach ($categoryProds as $category => $categoryItems) {?>
			<div data-catid="<?=$arResult['THCATEGORY']['LEGEND'][$category]['ID']?>" class="category-block" style="display:<? echo $itemActive; $itemActive='none';?>";>
            	<h4><?=$arResult['THCATEGORY']['LEGEND'][$category]['NAME']?></h4>
                <div class="targeted-assistance-how-help__list">
        		<?foreach ($categoryItems as $pos => $item) {;?>
                    <div class="targeted-assistance-how-help__item product_item" data-id="<?=$pos?>" id="product<?=$pos?>">
                      	<div class="name"><?=$item['ITEM_NAME']['VALUE']?></div>
					    <?if ($item['ITEM_LINK']['VALUE']) {?>
	                    	<div class="desc"><a href="<?=$item['ITEM_LINK']['VALUE']?>" target="_blank">Пример товара</a></div>
						<?}?>
						<? if($item['ITEM_CLOSED']['VALUE'] == 'Да') {?>
                      		<div class="targeted-assistance-how-help__btn-line">
                        		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-success">
                          			<use xlink:href="#success"></use>
                        		</svg><span>Позиция закрыта</span>
                      		</div>
                      	<?} else {?>	
                      		<div class="targeted-assistance-how-help__btn-line product_selected" style="display:none;">
                        		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-success">
                          			<use xlink:href="#success"></use>
                        		</svg><span>Вы выбрали</span> 
                      		</div>
                      		<button type="button" class="btn btn-no-borders select_product">Выбрать
                        		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-arrow">
		                          <use xlink:href="#arrow"></use>
    		                    </svg>
        	              </button>
						<?}?>
                    </div>
				<?}?>
                </div>
			</div>
		<?}?>


    </div>
</div>

<?if (!(($totalProds == $closedProds) || ($arResult['PROPERTIES']['CLOSED']['VALUE'] == 'Да'))) { ?>
	<div class="col-md-4 targeted-assistance-you-help__wrapper">
    	<div class="targeted-assistance-you-help">
        	<h3>Вы хотите пожертвовать:</h3>
            <div class="targeted-assistance-you-help__list"></div>
            <button type="button" data-modal="#modal-book" class="btn" id="reserve">Забронировать</button>
         </div>
     </div>
<?}?>
</div>
</div>
</section>


<section>
<div class="container">
<div class="row">
<div class="col-md-12">
	<div class="banner-double-quotes">
    	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-double-quotes">
        	<use xlink:href="#double-quotes"></use>
        </svg>
        <p>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include", "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/how_to_help/addr.php"
            )
        ); ?>
		</p>
    </div>
</div>
</div>
</div>
</section>

<script>
	function hide_detail_expand_button() {
		/*
		в вёрстку добавлен дополнительный вложенный блок .detail_text_inner, высота которого сравнивается с высотой основного блока текста для определения скрывать/показывать кнопку
		если блок уже раскрыт, кнопка показывается в любом случае
		*/
		var det = $('.detail_text'); 
		if(!($(det).hasClass("open"))) { 
			if ($('.detail_text_inner').height() > $(det).height()) {
        		$(".text-expand-controller").show();
			} else {
        		$(".text-expand-controller").hide();
			}
		}		
	}
	hide_detail_expand_button();

	$( document ).ready(function() {

		window.addEventListener("resize", hide_detail_expand_button);

		$(".category-link").on( "click", function(event) {
		  	event.preventDefault();   
			$(".category-link").removeClass("<?=$itemActiveClass?>");
			$(this).addClass("<?=$itemActiveClass?>");
			var catID = $(this).attr("data-id");
			$(".category-block").hide();
			$(".category-block[data-catid="+catID+"]").show();

		});

		$(".select_product").on( "click", function(event) {
		  	event.preventDefault(); 
			var product = $(this).closest('.product_item');
			name = $(product).find('.name').html();  
			product_pos = $(product).attr('data-id');
			$('.targeted-assistance-you-help__list').append('<div class="targeted-assistance-you-help__item" data_pos="'+product_pos+'">'+name+'</div>');
			$(this).hide();
			$(product).find('.product_selected').show();

		});

		$('.targeted-assistance-you-help__list').on('click', '.targeted-assistance-you-help__item', function(event){
			product_pos = $(this).attr('data_pos');
			product = "#product"+product_pos; 
			$(product).find('.product_selected').hide();
			$(product).find('.select_product').show();
			$(this).remove();
			
		});


		$("#reserve").on( "click", function(event) {
			var comment = '<a href="'+window.location.href+'">'+window.location.href+'</a><br><br/>Список товаров: <br />';
			$( ".targeted-assistance-you-help__list .targeted-assistance-you-help__item" ).each(function( index ) {
				  comment = comment + $(this).text()+'<br />';
			});
			$('#PREVIEW_TEXT').val(comment);
		});


	});
</script>
