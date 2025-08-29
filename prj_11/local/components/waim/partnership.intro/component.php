<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @var CDatabase $DB */
/** @var CUser $USER */
/** @var CMain $APPLICATION */

$arPresets = Array(
	"A" => Array(
		"TITLE" => "Статьи про финансы",
		"DESCRIPTION" => "Раз в неделю будем присылать вам интересную, понятную и полезную статью про финансы бизнеса",
		"IMAGE" => $componentPath . '/templates/' . $componentTemplate . "/images/subscribe_a.png"
	),
	"B" => Array(
		"TITLE" => "Управленка",
		"DESCRIPTION" => "Курс по финансам бизнеса, специально для предпринимателей. Два раза в неделю будем присылать письма с уроками — понятными и кайфовыми",
		"IMAGE" =>  $componentPath . '/templates/' . $componentTemplate . "/images/subscribe_b.png"
	),
	"C" => Array(
		"TITLE" => "Шаблон ОПиУ",
		"DESCRIPTION" => "Скачайте шаблон отчета о прибылях и убытках с инструкцией, и держите прибыль компании под контролем"
	),
	"D" => Array(
		"TITLE" => "План-капкан",
		"DESCRIPTION" => "Три вебинара по финансовому планированию, а также файлы для внедрения. Бесплатно, придет вам на почту"
	),
	"E" => Array(
		"TITLE" => "Шаблон ДДС",
		"DESCRIPTION" => "Шаблон отчета о движении дережных средств — с настроенными формулами и видеоинструкцией"
	),
	"F" => Array(
		"TITLE" => "Скачать шаблон баланса",
		"DESCRIPTION" => "Он покажет, сколько у вашей компании активов, каков темп роста собственного капитала и на чьи деньги вообще живет ваш бизнес — свои или заемные. Это бесплатно"
	),
	"G" => Array(
		"TITLE" => "Мини-книга «ДДС, ОПиУ и баланс»",
		"DESCRIPTION" => "Получите бесплатно книгу о том, как внедрить отчеты о движении денежных средств, прибылях и убытках и баланс"
	),
	"H" => Array(
		"TITLE" => "Барсетка шаблонов",
		"DESCRIPTION" => "15+ инструментов финансового учета для малого бизнеса. Бесплатные шаблоны готовы к работе и сопровождаются инструкцией"
	),
	"I" => Array(
		"TITLE" => "Шаблон финмодели",
		"DESCRIPTION" => "Запланируйте прибыль и определите ключевые показатели. Внутри примеры для разных типов бизнеса"
	),
	"J" => Array(
		"TITLE" => "Платежный календарь",
		"DESCRIPTION" => "Шаблоны таблицы для планирования денежного потока. Две версии с видеоинструкцией"
	)
);

$arParams["FORM_TYPE"] = !empty($arParams["FORM_TYPE"]) ? $arParams["FORM_TYPE"] : strip_tags(htmlspecialchars_decode($arParams["TITLE"]));

if(!empty($arParams["PRESET"])) {
	$arPresetParams = !empty($arPresets[$arParams["PRESET"]]) ? $arPresets[$arParams["PRESET"]] : [];
	$arParams = array_replace($arParams, $arPresetParams);
}

$arParams["POLICY_FULL_TEXT"] = $arParams["POLICY_TEXT"];
$linkClass = !empty($arParams["POLICY_LINK_CLASS"]) ? $arParams["POLICY_LINK_CLASS"] : "";
$linkClassAttribute = !empty($linkClass) ? sprintf('class="%s"', $linkClass) : "";

if(!empty($arParams["POLICY_TEXT"]) && !empty($arParams["POLICY_LINK"]) && !empty($arParams["POLICY_LINK_TEXT"])) {
	$link = sprintf('<a href="%s" %s target="_blank">%s</a>', $arParams["POLICY_LINK"], $linkClassAttribute, $arParams["POLICY_LINK_TEXT"]);

	$arParams["POLICY_FULL_TEXT"] = sprintf($arParams["POLICY_FULL_TEXT"], $link);

	$arParams["FORM_ID"] = substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
}

$this->includeComponentTemplate();
