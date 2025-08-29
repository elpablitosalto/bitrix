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
<section class="dp-section">
	<div class="container">
		<div class="dp-section__body">

			<? if (intval($arResult["DISPLAY_PROPERTIES"]["CONSTRUCTOR"]["VALUE"]) > 0) { ?>
				<? $APPLICATION->IncludeComponent(
					"indexis:page.constructor",
					"",
					array(
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"SECTION_ID" => $arResult["DISPLAY_PROPERTIES"]["CONSTRUCTOR"]["VALUE"]
					)
				); ?>
			<? } else {
			} ?>

		</div>
	</div>
</section>