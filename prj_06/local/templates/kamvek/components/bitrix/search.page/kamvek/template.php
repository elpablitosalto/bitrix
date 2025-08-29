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
?>
<?
if (!empty($arResult["REQUEST"]["QUERY"])) {
	$APPLICATION->SetPageProperty("PAGE_H1", 'Поиск «<span class="searchPhrase">' . $arResult["REQUEST"]["QUERY"] . '</span>»');
}
$APPLICATION->SetPageProperty("PAGE_H2", 'Результаты поиска');
?>

<div class="respBlock">
	<? if ($arResult["ERROR_CODE"] != 0) { ?>
		<p><?= GetMessage("SEARCH_ERROR") ?></p>
		<? ShowError($arResult["ERROR_TEXT"]); ?>
		<p><?= GetMessage("SEARCH_CORRECT_AND_CONTINUE") ?></p>
		<br /><br />
		<p><?= GetMessage("SEARCH_SINTAX") ?><br /><b><?= GetMessage("SEARCH_LOGIC") ?></b></p>
		<table border="0" cellpadding="5">
			<tr>
				<td align="center" valign="top"><?= GetMessage("SEARCH_OPERATOR") ?></td>
				<td valign="top"><?= GetMessage("SEARCH_SYNONIM") ?></td>
				<td><?= GetMessage("SEARCH_DESCRIPTION") ?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?= GetMessage("SEARCH_AND") ?></td>
				<td valign="top">and, &amp;, +</td>
				<td><?= GetMessage("SEARCH_AND_ALT") ?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?= GetMessage("SEARCH_OR") ?></td>
				<td valign="top">or, |</td>
				<td><?= GetMessage("SEARCH_OR_ALT") ?></td>
			</tr>
			<tr>
				<td align="center" valign="top"><?= GetMessage("SEARCH_NOT") ?></td>
				<td valign="top">not, ~</td>
				<td><?= GetMessage("SEARCH_NOT_ALT") ?></td>
			</tr>
			<tr>
				<td align="center" valign="top">( )</td>
				<td valign="top">&nbsp;</td>
				<td><?= GetMessage("SEARCH_BRACKETS_ALT") ?></td>
			</tr>
		</table>
	<? } else if (count($arResult["SEARCH"]) > 0) { ?>
		<div id="SearchItems" class="searchItems">

			<? foreach ($arResult["SEARCH"] as $arItem) { ?>
				<div class="searchItem">
					<h3 class="searchItem_title">
						<a href="<? echo $arItem["URL"] ?>"><? echo $arItem["TITLE_FORMATED"] ?></a>
					</h3>
					<div class="searchItem_text"><? echo $arItem["BODY_FORMATED"] ?></div>
				</div>
			<? } ?>

		</div>
	<? } else {
	?>
		<? ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND")); ?>
	<?
	} ?>
</div>

<? if (count($arResult["SEARCH"]) > 0) { ?>
	<?
	echo $arResult["NAV_STRING"]
	?>
<? } ?>