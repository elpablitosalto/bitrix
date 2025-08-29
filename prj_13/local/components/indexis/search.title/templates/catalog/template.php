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
$this->addExternalJS(SITE_TEMPLATE_PATH . "/components/bitrix/catalog.section/drop_search/script.js");
$this->addExternalJS(SITE_TEMPLATE_PATH . "/components/bitrix/catalog.item/drop_search/script.js");
?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if($INPUT_ID == '')
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if($CONTAINER_ID == '')
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<div class="search__form-wrapper" id="<?echo $CONTAINER_ID?>">
		<form class="search__form" action="<?echo $arResult["FORM_ACTION"]?>">
			<input id="<?echo $INPUT_ID?>" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" placeholder="Найти" class="search__input" />&nbsp;
			<button class="search__button" type="submit">
				<svg width="19" height="19">
					<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#search"></use>
				</svg>
			</button>
		</form>
	</div>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearchCustom({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
