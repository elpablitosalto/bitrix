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
	<?
	$i = 1;
	?>
	<? foreach ($arResult["ITEMS"] as $arItem) { ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<? if ($i == 1) { ?>
			<li class="_js-feed-post t-feed__post t-item t-width t-col t-col_7 t-prefix_4" data-post-uid="nud1d2p7y1" style="cursor: pointer;">
				<div class="t-feed__post__line-separator"></div>
				<div class="t-feed__row-grid__post-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="t-feed__post-imgwrapper">
						<div class="_js-feed-post-image t-feed__post-bgimg t-bgimg loaded" data-original="<?= $arItem["PICTURE"]["SRC"] ?>" style="background-image: url(&quot;<?= $arItem["PICTURE"]["SRC"] ?>&quot;);" bgimgfield="fe_img__nud1d2p7y1"></div>
					</div>
					<div class="t-feed__textwrapper">
						<div class="_js-feed-post-title t-feed__post-title  t-name t-name_xl" field="fe_title__nud1d2p7y1" data-redactor-toolbar="no" style="color:#373844;font-size:24px;font-weight:400;font-family:'Gotham';"><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="t-feed__link _js-feed-post-link" role="button" aria-haspopup="dialog">
								<?= $arItem["NAME"] ?>
							</a></div>
						<div class="_js-feed-post-descr t-feed__post-descr t-descr t-descr_xxs" field="fe_descr__nud1d2p7y1" data-redactor-toolbar="no" style="">
							<?= $arItem["PREVIEW_TEXT"] ?>
						</div>
						<div class="t-feed__post-parts-date-row t-feed__post-parts-date-row_afterdescr"><span class="_js-feed-post-date t-feed__post-date t-uptitle t-uptitle_xs" style=""><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></span><span class="t-feed__post-tag t-uptitle t-uptitle_xs">Код жизни</span>
						</div>
					</div>
				</div>
			</li>
		<? } else if ($i == 2) { ?>
			<li class="_js-feed-post t-feed__post t-item t-width t-col t-col_7 t-prefix_4" data-post-uid="eog78f3pp1" style="cursor: pointer;">
				<div class="t-feed__post__line-separator"></div>
				<div class="t-feed__row-grid__post-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="t-feed__post-imgwrapper">
						<div class="_js-feed-post-image t-feed__post-bgimg t-bgimg loaded" data-original="<?= $arItem["PICTURE"]["SRC"] ?>" style="background-image: url(&quot;<?= $arItem["PICTURE"]["SRC"] ?>&quot;);" bgimgfield="fe_img__eog78f3pp1"></div>
					</div>
					<div class="t-feed__textwrapper">
						<div class="_js-feed-post-title t-feed__post-title  t-name t-name_xl" field="fe_title__eog78f3pp1" data-redactor-toolbar="no" style="color:#373844;font-size:24px;font-weight:400;font-family:'Gotham';"><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="t-feed__link _js-feed-post-link" role="button" aria-haspopup="dialog">
								<?= $arItem["NAME"] ?></a></div>
						<div class="_js-feed-post-descr t-feed__post-descr t-descr t-descr_xxs" field="fe_descr__eog78f3pp1" data-redactor-toolbar="no" style="">
							<?= $arItem["PREVIEW_TEXT"] ?>
						</div>
						<div class="t-feed__post-parts-date-row t-feed__post-parts-date-row_afterdescr"><span class="_js-feed-post-date t-feed__post-date t-uptitle t-uptitle_xs" style=""><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></span><span class="t-feed__post-tag t-uptitle t-uptitle_xs">Код жизни</span></div>
					</div>
				</div>
			</li>
		<? } else if ($i == 3) { ?>
			<li class="_js-feed-post t-feed__post t-item t-width t-col t-col_7 t-prefix_4" data-post-uid="72n5ku7hm1" style="cursor: pointer;">
				<div class="t-feed__post__line-separator"></div>
				<div class="t-feed__row-grid__post-wrapper" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<div class="t-feed__post-imgwrapper">
						<div class="_js-feed-post-image t-feed__post-bgimg t-bgimg loaded" data-original="<?= $arItem["PICTURE"]["SRC"] ?>" style="background-image: url(&quot;<?= $arItem["PICTURE"]["SRC"] ?>&quot;);" bgimgfield="fe_img__72n5ku7hm1"></div>
					</div>
					<div class="t-feed__textwrapper">
						<div class="_js-feed-post-title t-feed__post-title  t-name t-name_xl" field="fe_title__72n5ku7hm1" data-redactor-toolbar="no" style="color:#373844;font-size:24px;font-weight:400;font-family:'Gotham';"><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="t-feed__link _js-feed-post-link" role="button" aria-haspopup="dialog">
								<?= $arItem["NAME"] ?></a></div>
						<div class="_js-feed-post-descr t-feed__post-descr t-descr t-descr_xxs" field="fe_descr__72n5ku7hm1" data-redactor-toolbar="no" style="">
							<?= $arItem["PREVIEW_TEXT"] ?>
						</div>
						<div class="t-feed__post-parts-date-row t-feed__post-parts-date-row_afterdescr"><span class="_js-feed-post-date t-feed__post-date t-uptitle t-uptitle_xs" style=""><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></span><span class="t-feed__post-tag t-uptitle t-uptitle_xs">Код жизни</span></div>
					</div>
				</div>
			</li>
		<? } ?>

	<?
		$i++;
	} ?>

<? } ?>