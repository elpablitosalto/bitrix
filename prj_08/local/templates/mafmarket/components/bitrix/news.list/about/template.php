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

//vardump($arResult);

if (!empty($arResult["ITEMS"])) {
?>
	<?
	foreach ($arResult["ITEMS"] as $arItem) {
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

		<section class="dp-section" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="container">
				<h2>
					<?
					//vardump($arItem['DISPLAY_PROPERTIES']['HEADER']);
					?>
					<?= $arItem['DISPLAY_PROPERTIES']['HEADER']['DISPLAY_VALUE']; ?>
				</h2>
				<div class="dp-about-img">
					<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
				</div>
				<div class="dp-about-desc">
					<p>
						<?= $arItem['DETAIL_TEXT']; ?>
					</p>
				</div>
				<table class="dp-about-table">
					<tbody>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['FOUNDATION']['DISPLAY_VALUE'])) { ?>
							<tr>
								<td>Основание</td>
								<td><?= $arItem['DISPLAY_PROPERTIES']['FOUNDATION']['DISPLAY_VALUE']; ?></td>
							</tr>
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['PRODUCTION']['DISPLAY_VALUE'])) { ?>
							<tr>
								<td>Собственное производство в России</td>
								<td>
									<?= $arItem['DISPLAY_PROPERTIES']['PRODUCTION']['DISPLAY_VALUE']; ?>
								</td>
							</tr>
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['PRICE_SEGMENT']['DISPLAY_VALUE'])) { ?>
							<tr>
								<td>Ценовой сегмент</td>
								<td>
									<?= $arItem['DISPLAY_PROPERTIES']['PRICE_SEGMENT']['DISPLAY_VALUE']; ?>
								</td>
							</tr>
						<? } ?>
						<? if (!empty($arItem['DISPLAY_PROPERTIES']['WE_OFFIC_REPRESENT']['DISPLAY_VALUE'])) { ?>
							<tr>
								<td>Мы официальные представители</td>
								<td>
									<?= $arItem['DISPLAY_PROPERTIES']['WE_OFFIC_REPRESENT']['DISPLAY_VALUE']; ?>
								</td>
							</tr>
						<? } ?>
						<tr>
							<td>
								<? if (!empty($arItem['DISPLAY_PROPERTIES']['REQ_FILE']['FILE_VALUE']['SRC'])) { ?>
									Реквизиты <br>
									<a class="dp-btn dp-btn_xs dp-btn_outlined" href="<?= $arItem['DISPLAY_PROPERTIES']['REQ_FILE']['FILE_VALUE']['SRC']; ?>">
										<span>Скачать</span>
										<svg class="icon icon-download ">
											<use xlink:href="#download"></use>
										</svg>
									</a>
								<? } ?>
							</td>
							<td>
								<ul class="dp-about-requisites">
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['FULL_NAME']['DISPLAY_VALUE'])) { ?>
										<li>
											<span class="dp-about-requisites__label">
												Полное наименование:</span> <?= $arItem['DISPLAY_PROPERTIES']['FULL_NAME']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['SHORT_NAME']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">Краткое наименование:</span> <?= $arItem['DISPLAY_PROPERTIES']['SHORT_NAME']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['INN']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">ИНН:</span> <?= $arItem['DISPLAY_PROPERTIES']['INN']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['KPP']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">КПП:</span> <?= $arItem['DISPLAY_PROPERTIES']['KPP']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['OGRN']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">ОГРН:</span> <?= $arItem['DISPLAY_PROPERTIES']['OGRN']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['OKPO']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">ОКПО:</span> <?= $arItem['DISPLAY_PROPERTIES']['OKPO']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['OKVED']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">ОКВЭД:</span> <?= $arItem['DISPLAY_PROPERTIES']['OKVED']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['OKATO']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">ОКАТО:</span> <?= $arItem['DISPLAY_PROPERTIES']['OKATO']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['LEGAL_ADDRESS']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">Юридический адрес:</span> <?= $arItem['DISPLAY_PROPERTIES']['LEGAL_ADDRESS']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['ACTUAL_ADDRESS']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">Фактический адрес (почтовый):</span> <?= $arItem['DISPLAY_PROPERTIES']['ACTUAL_ADDRESS']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['RS']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">Расчётный счёт:</span> <?= $arItem['DISPLAY_PROPERTIES']['RS']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['KS']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">Кор. счёт:</span> <?= $arItem['DISPLAY_PROPERTIES']['KS']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['BIK']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">БИК:</span> <?= $arItem['DISPLAY_PROPERTIES']['BIK']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
									<? if (!empty($arItem['DISPLAY_PROPERTIES']['BANK']['DISPLAY_VALUE'])) { ?>
										<li><span class="dp-about-requisites__label">Банк:</span> <?= $arItem['DISPLAY_PROPERTIES']['BANK']['DISPLAY_VALUE']; ?>
										</li>
									<? } ?>
								</ul>
							</td>
						</tr>
					</tbody>
				</table>
				<button class="dp-btn dp-about-contact-btn" type="button" onclick="window.location.href = '/contacts/#contact_us'">
					<span>Связаться с нами</span>
				</button>
			</div>
		</section>

		<?/*?>
		<div class="section-materials__also-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
			<div class="materials-card__image">
				<img src="<?= $arItem['PICTURE']['SRC']; ?>" alt="<?= $arItem['PICTURE']['ALT']; ?>" title="<?= $arItem['PICTURE']['TITLE']; ?>" />
			</div>
			<div class="section-materials__description">
				<p class="materials-item__title"><?= $arItem['NAME']; ?></p>
				<div class="materials-item__text">
					<?= $arItem['PREVIEW_TEXT']; ?>
				</div>
				<a class="dp-btn materials-item__button" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
					<span>Подробнее</span>
					<svg class="icon icon-drop-right ">
						<use xlink:href="#drop-right"></use>
					</svg>
				</a>
			</div>
		</div>
		<?*/ ?>
	<?
	}
	?>
<? } ?>