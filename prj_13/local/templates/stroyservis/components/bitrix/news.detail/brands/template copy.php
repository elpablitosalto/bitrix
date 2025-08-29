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
<?
$APPLICATION->SetPageProperty(
	"MICROMARKING_PARAMS_META_HEADLINE",
	'<meta itemprop="headline" content="' . $arResult["NAME"] . '">'
);

$APPLICATION->SetPageProperty(
	"MICROMARKING_PARAMS_META_URL",
	'<meta itemprop="url" content="' . $arResult["DETAIL_PAGE_URL"] . '">'
);

$APPLICATION->SetPageProperty(
	"MICROMARKING_PARAMS_META_DESCRIPTION",
	'<meta itemprop="description" content="' . $arResult["PREVIEW_TEXT"] . '">'
);
?>
<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) : ?>
	<div class="article__main-image">
		<img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>" />
	</div>
<? endif ?>
<?
//vardump($arResult);
?>
<?
//vardump($arResult);
$DETAIL_TEXT_1 = $arResult["DETAIL_TEXT"];
$arDetailText = explode("#PRODUCT_LIST#", $arResult["DETAIL_TEXT"]);
if (count($arDetailText) > 1 && is_array($arDetailText)) {
	$DETAIL_TEXT_1 = $arDetailText[0];
	$DETAIL_TEXT_2 = $arDetailText[1];
}

?>
<div class="article__wrapper" itemprop="articleBody">
	<? echo $DETAIL_TEXT_1; ?>

	<?/*?>
	#PRODUCT_LIST#
	<?*/ ?>

	<? if (strlen($DETAIL_TEXT_2) > 0) { ?>
		<? echo $DETAIL_TEXT_2; ?>
	<? } ?>

	<?/*?>
	#PRODUCT_LIST#
	<?*/ ?>

	<?
	$sharing_url = 'https://' . SITE_SERVER_NAME . $arResult["DETAIL_PAGE_URL"];
	?>
	<ul class="article__contact-list">
		<li class="article__contact-item">
			<a href="https://web.whatsapp.com/send?text=<?= $sharing_url ?>" data-action="share/whatsapp/share" target="_blank">
				<svg width="30" height="30">
					<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#whatsapp"></use>
				</svg>
			</a>
		</li>
		<li class="article__contact-item">
			<a href="https://telegram.me/share/url?url=<?= $sharing_url ?>" target="_blank">
				<svg width="30" height="30">
					<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#telegram"></use>
				</svg>
			</a>
		</li>

		<?/*?>
		<li class="article__contact-item">
			<a href="#">
				<svg width="30" height="30">
					<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#telegram"></use>
				</svg>
			</a>
		</li>
		<li class="article__contact-item">
			<a href="#">
				<svg width="30" height="30">
					<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons/sprite/svg-sprite.svg#telegram"></use>
				</svg>
			</a>
		</li>
		<? */ ?>
	</ul>

	<? $APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"question_to_technologist",
		array(
			"SEF_MODE" => "N",
			"WEB_FORM_ID" => $GLOBALS["arSiteConfig"]["WEB_FORM_ID_QUESTION_TO_TECHNOLOGIST"],
			"LIST_URL" => "",
			"EDIT_URL" => "",
			"SUCCESS_URL" => "",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "Y",
			"USE_EXTENDED_ERRORS" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"SEF_FOLDER" => "/",
			"VARIABLE_ALIASES" => array(),
		)
	); ?>

	<?/*?>
	<div class="article-form">
		<p class="article-form__title">Планируете покупку материалов?<br><span>— Задайте вопрос нашему технологу!</span></p>
		<div class="article-form__wrapper">
			<div class="form__input">
				<label class="visually-hidden" for="article-form__name">Ваше имя*</label>
				<input class="article-form__input" id="article-form__name" type="text" name="name" placeholder="Ваше имя*" required>
			</div>
			<div class="form__input">
				<label class="visually-hidden" for="article-form__phone">Телефон*</label>
				<input class="article-form__input" id="article-form__phone" type="number" name="phone" placeholder="Телефон*" required>
			</div>
			<div class="form__input">
				<label class="visually-hidden" for="article-form__email">E-mail*</label>
				<input class="article-form__input" id="article-form__email" type="email" name="email" placeholder="E-mail*" required>
			</div>
			<div class="form__input">
				<label class="visually-hidden" for="article-form__inn">ИНН компании*</label>
				<input class="article-form__input" id="article-form__inn" type="number" name="inn" placeholder="ИНН компании*" required>
			</div>
			<div class="form__input article-form__textarea">
				<label class="visually-hidden" for="article-form__textarea">Укажите необходимые материалы и количество</label>
				<textarea id="article-form__textarea" name="text" placeholder="Укажите необходимые материалы и количество"></textarea>
			</div>
		</div>
		<p class="article-form__policy">Нажимая кнопку Отправить, вы даете согласие на <a href="#">обработку персональных данных</a>
		</p>
		<button class="article-form__submit" type="submit">Отправить</button>
	</div>
	<?*/?>
</div>