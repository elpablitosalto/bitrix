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
//echo '!!';
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<h2>
	<?= $arResult['IBLOCK']['H2']; ?>
</h2>
<div class="materials-wrapper">
	<img src="<?= $arResult['IBLOCK']['PICTURE']['SRC']; ?>" alt="<?= $arResult['IBLOCK']['PICTURE']['ALT']; ?>" title="<?= $arResult['IBLOCK']['PICTURE']['TITLE']; ?>" />
</div>
<? if (!empty($arResult['SECTIONS'])) { ?>
	<? foreach ($arResult['SECTIONS'] as $sectId => $arSection) { ?>
		<?
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>
		<div class="materials-wrapper">
			<div class="materials-item__wrapper" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<div class="materials-item__description" id="<?= $arSection['ID']; ?>">
					<p class="materials-item__title"><?= $arSection['NAME'] ?></p>
					<? if (strlen($arSection['UF_SUBTITLE']) > 0) { ?>
						<p class="materials-item__subtitle"><?= $arSection['UF_SUBTITLE'] ?></p>
					<? } ?>
					<div class="materials-item__text">
						<?= $arSection['DESCRIPTION'] ?>
						<? if (strlen($arSection['UF_HIDE_TEXT']) > 0) { ?>
							<div class="materials-item__text_hide display-none">
								<?= htmlspecialchars_decode($arSection['UF_HIDE_TEXT']); ?>
							</div>
						<? } ?>
					</div>
					<? if (strlen($arSection['UF_HIDE_TEXT']) > 0) { ?>
						<a class="materials-item__more" href="#">Читать больше</a>
					<? } ?>
					<? if (!empty($arSection['arElementsIds'])) { ?>
						<? if (count($arSection['arElementsIds']) == 1) { ?>
							<? foreach ($arSection['ELEMENTS'] as $elId => $arItem) { ?>
								<?
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								?>
								<a class="dp-btn materials-item__button" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
									<span>Подробнее</span>
									<svg class="icon icon-drop-right ">
										<use xlink:href="#drop-right"></use>
									</svg>
								</a>
							<? } ?>
						<? } ?>
					<? } ?>
				</div>
				<div class="materials-item__image">
					<img src="<?= $arSection['PICTURE_ALT']['SRC']; ?>" alt="<?= $arSection['PICTURE_ALT']['ALT']; ?>" title="<?= $arSection['PICTURE_ALT']['TITLE']; ?>" />
				</div>
			</div>
			<? if (!empty($arSection['arElementsIds'])) { ?>
				<? if (count($arSection['arElementsIds']) > 1) { ?>
					<?/*?>
					<? $APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"materials",
						array(
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "N",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"AJAX_MODE" => "N",
							"IBLOCK_TYPE" => "content",
							"IBLOCK_ID" => Indexis::getIblockId('materials', 'content'),
							"NEWS_COUNT" => "10",
							"SORT_BY1" => 'SORT',
							"SORT_ORDER1" => 'ASC',
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "arrFilterMaterials",
							"FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
							"PROPERTY_CODE" => array('CODE', 'COLOR_CODE'),
							"CHECK_DATES" => "N",
							"DETAIL_URL" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "Подразделы",
							"PAGER_SHOW_ALWAYS" => "Y",
							"PAGER_TEMPLATE" => "show_more_colors",
							//"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SET_STATUS_404" => "N",
							"SHOW_404" => "N",
							"MESSAGE_404" => "",
							"PAGER_BASE_LINK" => "",
							"PAGER_PARAMS_NAME" => "arrPager",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",

							// Мои параметры -->
							// <-- Мои параметры
						)
					); ?>
					<?*/ ?>
					<div class="materials-item__images">
						<? foreach ($arSection['ELEMENTS'] as $elId => $arItem) { ?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<a class="materials-item__img" id="<?= $this->GetEditAreaId($arItem['ID']); ?>" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
								<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
								<p><?= $arItem['NAME'] ?></p>
							</a>
						<? } ?>
					</div>
				<? } else { ?>
				<? } ?>
			<? } ?>
			<? if ($arSection['CODE'] == 'metall') { ?>
				<div class="materials-item__colors-wrapper">
					<? $GLOBALS['arrFilterColors']['!PROPERTY_COLOR_CODE'] = false; ?>
					<? $APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"colors",
						array(
							"DISPLAY_DATE" => "N",
							"DISPLAY_NAME" => "N",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"AJAX_MODE" => "N",
							"IBLOCK_TYPE" => "directory",
							"IBLOCK_ID" => Indexis::getIblockId('colors', 'directory'),
							"NEWS_COUNT" => "9",
							"SORT_BY1" => $ELEMENT_SORT_FIELD,
							"SORT_ORDER1" => $ELEMENT_SORT_ORDER,
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "arrFilterColors",
							"FIELD_CODE" => array("ID", 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE'),
							"PROPERTY_CODE" => array('CODE', 'COLOR_CODE'),
							"CHECK_DATES" => "N",
							"DETAIL_URL" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "Y",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "Подразделы",
							"PAGER_SHOW_ALWAYS" => "Y",
							"PAGER_TEMPLATE" => "show_more_colors",
							//"PAGER_TEMPLATE" => "",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SET_STATUS_404" => "N",
							"SHOW_404" => "N",
							"MESSAGE_404" => "",
							"PAGER_BASE_LINK" => "",
							"PAGER_PARAMS_NAME" => "arrPager",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",

							// Мои параметры -->
							// <-- Мои параметры
						)
					); ?>
					<?/*?>
					<p class="materials-item__title">Варианты порошковой окраски в цветах RAL</p>
					<div class="materials-item__colors">
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#F0E0CB"></path>
							</svg>
							<p>Ral 1003</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#F1DFB9"></path>
							</svg>
							<p>Ral 1015</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#FCE540"></path>
							</svg>
							<p>Ral 1021</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#EF6C36"></path>
							</svg>
							<p>Ral 2004</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#F37F36"></path>
							</svg>
							<p>Ral 2008</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#9C3443"></path>
							</svg>
							<p>Ral 3003</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#EBAAAF"></path>
							</svg>
							<p>Ral 3015</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#D53539"></path>
							</svg>
							<p>Ral 3020</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#8E79B5"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#B75382"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#384B8A"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#35374C"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#2C84C5"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#27648C"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#6094B5"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#40804A"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#59B85F"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#2D9468"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#7DC4C1"></path>
							</svg>
							<p>Ral 1003</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#726B62"></path>
							</svg>
							<p>Ral 1015</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#515C56"></path>
							</svg>
							<p>Ral 1021</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#33424A"></path>
							</svg>
							<p>Ral 2004</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#3A3F41"></path>
							</svg>
							<p>Ral 2008</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#404441"></path>
							</svg>
							<p>Ral 3003</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#474D56"></path>
							</svg>
							<p>Ral 3015</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#C3CDCB"></path>
							</svg>
							<p>Ral 3020</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#4D565B"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#BFC1C0"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#724940"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#3C3A3D"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#775342"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#FFFFFF"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#212E30"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#9E9C9C"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#999797"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#FFFDF3"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#474746"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#7B4637"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#6D6F6E"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#625751"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
						<div class="materials-item__color">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 147">
								<path d="M4.96476 33.4055L58.9648 1.93453C62.0766 0.120935 65.9234 0.120937 69.0353 1.93453L123.035 33.4055C126.109 35.1971 128 38.4872 128 42.0453V105.045C128 108.607 126.105 111.9 123.025 113.691L69.0254 145.079C65.9185 146.885 62.0815 146.885 58.9746 145.079L4.97463 113.691C1.89493 111.9 0 108.607 0 105.045V42.0453C0 38.4872 1.89063 35.1971 4.96476 33.4055Z" fill="#2C3036"></path>
							</svg>
							<p>Ral 4005</p>
							<p>Green beiege</p>
						</div>
					</div><a class="materials-item__colors-all" href="#">Cмотреть больше</a>
					<?*/ ?>
				</div>
			<? } ?>
		</div>
	<? } ?>
<? } ?>