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

<div class="requisites__list">
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['FULL_NAME']['VALUE'])) { ?>
		<dl>
			<dt><span>Полное наименование организации</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['FULL_NAME']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['SHORT_NAME']['VALUE'])) { ?>
		<dl>
			<dt><span>Сокращенное наименование:</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['SHORT_NAME']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['INN']['VALUE'])) { ?>
		<dl>
			<dt><span>ИНН</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['INN']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['KPP']['VALUE'])) { ?>
		<dl>
			<dt><span>КПП</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['KPP']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['OGRN']['VALUE'])) { ?>
		<dl>
			<dt><span>ОГРН</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['OGRN']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['ADDRESS_REG']['VALUE'])) { ?>
		<dl>
			<dt><span>Адрес регистрации</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['ADDRESS_REG']['VALUE'] ?></dd>
		</dl>
	<? } ?>

	<? if (!empty($arResult['DISPLAY_PROPERTIES']['BANK_NAME']['VALUE'])) { ?>
		<h3>Банковские реквизиты</h3>
		<dl>
			<dt><span>Банк</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['BANK_NAME']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['BIK']['VALUE'])) { ?>
		<dl>
			<dt><span>БИК</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['BIK']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['KS']['VALUE'])) { ?>
		<dl>
			<dt><span>Кор. счет</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['KS']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['RS']['VALUE'])) { ?>
		<dl>
			<dt><span>Рассчетный счет</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['RS']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['CEO']['VALUE'])) { ?>
		<dl>
			<dt><span>Генеральный директор</span></dt>
			<dd><?= $arResult['DISPLAY_PROPERTIES']['CEO']['VALUE'] ?></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['EMAIL']['VALUE'])) { ?>
		<dl>
			<dt><span>Электронная почта</span></dt>
			<dd><a href="mailto:<?= $arResult['DISPLAY_PROPERTIES']['EMAIL']['VALUE'] ?>"><?= $arResult['DISPLAY_PROPERTIES']['EMAIL']['VALUE'] ?></a></dd>
		</dl>
	<? } ?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE'])) { ?>
		<a class="requisites__download" href="<?= $arResult['DISPLAY_PROPERTIES']['FILE']['FILE_VALUE']['SRC'] ?>" download="<?=trim($arResult['NAME'] . ' ' . $arResult['DISPLAY_PROPERTIES']['SHORT_NAME']['VALUE'])?>">Скачать</a>
	<? } ?>
</div>