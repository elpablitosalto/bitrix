<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Grid\Declension;

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
<? if (!empty($arResult["ITEMS"])) { ?>
	<section class="page-content">
		<div class="container">
			<h3 class="section__title">Программа</h3>
			<? foreach ($arResult['arShedule'] as $date => $arEvents) { ?>
				<div class="conference-block">
					<div class="conference-block__head">
						<div class="h4 conference-block__title"><?= $date; ?></div>
					</div>
					<div class="conference-block__body">
						<div class="conference-block__list">
							<?
							$i = 0;
							foreach ($arEvents as $key => $arEvent) {
								$i++;
								if ($i > 0 && strlen($arEvent['THEME']) <= 0) {
							?>
						</div>
						<div class="conference-block__list">
						<?
								}
						?>
						<?
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<?
								if (strlen($arEvent['THEME']) > 0) {
						?>
							<div class="conference-block__item" id="<?=$this->GetEditAreaId($arEvent['ID']);?>">
								<? if ($arEvent['SHOW_THEME'] == 'Y') { ?>
									<div class="conference-block__item-header"><?= $arEvent['THEME']; ?></div>
								<? } ?>
								<div class="conference-card" data-modal="#modal-conference-<?= $arEvent['ID']; ?>">
									<div class="h6 conference-card__time"><?= $arEvent['TIME']; ?></div>
									<div class="conference-card__title"><?= $arEvent['NAME']; ?></div>
									<div class="conference-card__info"><?= $arEvent['PREVIEW_TEXT']; ?></div>
								</div>
								<div id="modal-conference-<?= $arEvent['ID']; ?>" class="modal modal-conference">
									<button type="button" data-fancybox-close="data-fancybox-close" class="modal-close">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="icon icon-close">
											<use xlink:href="#close"></use>
										</svg>
									</button>
									<h4 class="modal-title"><?= $date; ?></h4>
									<div class="text-size-lg modal-conference__time"><?= $arEvent['TIME']; ?></div>
									<div class="h5 modal-conference__title"><?= $arEvent['NAME']; ?></div>
									<? if (!empty($arEvent['DETAIL_TEXT'])) { ?>
										<div class="modal-conference__desc"><?= $arEvent['DETAIL_TEXT']; ?></div>
									<? } ?>
									<div class="modal-conference__info"><?= $arEvent['PREVIEW_TEXT']; ?></div>
								</div>
							</div>
						<?
								} else {
						?>
							<div class="conference-block__item size-full" id="<?=$this->GetEditAreaId($arEvent['ID']);?>">
								<div class="conference-card">
									<div class="h6 conference-card__time"><?= $arEvent['TIME']; ?></div>
									<div class="conference-card__type"><?= $arEvent['NAME']; ?></div>
								</div>
							</div>
						<?
								}
						?>
					<?
							}
					?>
						</div>
					</div>
				</div>
			<? } ?>
			<div class="section__nav">
				<div class="buttons-line">
                    <?if(isset($arParams["END_REG"]) && mb_strlen($arParams["END_REG"])){?>
                        <a hreg="javascript:void(0)" class="btn">Регистрация закрыта</a>
                    <?} else {?>
                        <a target="_blank" href="<?= $GLOBALS['FORM_REG_LINK']; ?>" class="btn">Зарегистрироваться</a>
                    <?}?>
                </div>
			</div>
		</div>
	</section>
<? } ?>