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
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if($INPUT_ID == '')
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);
$INPUT_SCOPE = '.header';
$INPUT_TOGGLE_CLASS = 'header_state_search';

if($arParams["INPUT_ID"] == 'gazeta-fixed-search-input'){
	$INPUT_TOGGLE_CLASS = 'page__body_state_fixed-search, fixed-header_state_search';
	$INPUT_SCOPE = '.page__body, .fixed-header';
}

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if($CONTAINER_ID == '')
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);
if($arParams["SHOW_INPUT"] !== "N"):?>
	<form id="<?echo $CONTAINER_ID?>" action="<?echo $arResult["FORM_ACTION"]?>" class="search-panel <?=$arParams["CSS_CLASS"]?>">
			<label class="search-panel__label" aria-label="Поиск">
				<input id="<?echo $INPUT_ID?>" type="text" name="q" value="" size="40" maxlength="50" autocomplete="off" class="search-panel__input"/>
			</label>
			<div class="search-panel__control">
				<button type="submit" value="<?=GetMessage("CT_BST_SEARCH_BUTTON");?>" class="search-panel__submit" aria-label="Искать" title="Искать">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M19.8169 18.9331L16.2515 15.3677C17.7312 13.6785 18.5397 11.5364 18.5397 9.26987C18.5397 6.79382 17.5754 4.46597 15.8246 2.71511C14.0737 0.964257 11.7459 0 9.26983 0C6.79378 0 4.46589 0.964257 2.71504 2.71507C0.964218 4.46593 0 6.79378 0 9.26983C0 11.7459 0.964257 14.0737 2.71507 15.8246C4.46589 17.5754 6.79378 18.5397 9.26983 18.5397C11.5364 18.5397 13.6784 17.7312 15.3677 16.2515L18.9331 19.8169C19.0551 19.939 19.2151 20 19.375 20C19.5349 20 19.6949 19.9389 19.8169 19.8169C20.061 19.5728 20.061 19.1771 19.8169 18.9331ZM9.26983 17.2897C4.84765 17.2897 1.25 13.692 1.25 9.26983C1.25 4.84765 4.84765 1.25 9.26983 1.25C13.692 1.25 17.2897 4.84769 17.2897 9.26983C17.2897 13.692 13.692 17.2897 9.26983 17.2897Z" fill="#A8A8A8" />
					</svg>
				</button>
			</div>
			<button class="header__search-close js-toggle" type="button" data-toggle-scope="<?echo $INPUT_SCOPE?>" data-toggle-class="<?echo $INPUT_TOGGLE_CLASS?>" aria-label="Закрыть поиск">
				<svg class="header__icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 10.7302L11 0.999946" stroke="#A8A8A8" stroke-linecap="round"></path>
					<path d="M1 1.26978L11 11.0001" stroke="#A8A8A8" stroke-linecap="round"></path>
				</svg>
			</button>
	</form>
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
