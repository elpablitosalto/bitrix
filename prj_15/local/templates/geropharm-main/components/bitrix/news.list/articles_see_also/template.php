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

<? if (!empty($arResult["ITEMS"])) { ?>
	<section class="dp-section dp-effectiveness-section">
		<div class="container">
			<div class="dp-section__header">
				<h2 class="dp-section__title">Смотрите также:</h2>
			</div>
			<div class="dp-section__body">
				<div class="dp-slider dp-blog-slider dp-effectiveness-slider">
					<div class="dp-slider__list">
						<? foreach ($arResult["ITEMS"] as $arItem) : ?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>

							<div class="dp-slider__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="dp-blog-item">
									<a class="dp-blog-item__link" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
										<div class="dp-blog-item__img">
											<img src="<?= $arItem["PICTURE"]["SRC"] ?>" alt="<?= $arItem["PICTURE"]["ALT"] ?>" title="<?= $arItem["PICTURE"]["TITLE"] ?>">
										</div>
										<div class="dp-blog-item__caption">
											<? if (!empty($arItem["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'])) { ?>
												<div class="dp-blog-item__tags">
													<? foreach ($arItem["DISPLAY_PROPERTIES"]['THEME']['DISPLAY_VALUE'] as $key => $val) { ?>
														<span class="dp-blog-item__tag dp-blog-item__category"><?= $val; ?></span>
													<? } ?>
												</div>
											<? } ?>
											<h3 class="dp-blog-item__title"><?= $arItem['NAME']; ?></h3>
											<? if (!empty($arItem["ACTIVE_FROM"])) { ?>
												<time class="dp-blog-item__date" datetime="<? echo FormatDate("Y-m-d", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?>">
													<? echo FormatDate("j F Y", MakeTimeStamp($arItem["ACTIVE_FROM"])); ?>
												</time>
											<? } ?>
										</div>
									</a>
								</div>
							</div>
						<? endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<? } ?>