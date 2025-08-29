<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult['IS_ACTIVE_CONTEST'] = strtotime($arResult['PROPERTIES']['DATE_END']['VALUE']) > time();

// Данные конкурса -->
$arResult["arContest"] = array(
    "DATE_START" => $arResult['PROPERTIES']['DATE_START']['VALUE'],
    "DATE_END" => $arResult['PROPERTIES']['DATE_END']['VALUE'],
);
// <--

// Дата окончания конкурса для счётчика -->
if (strlen($arResult["arContest"]["DATE_END"]) > 0) {
    $arResult["arContest"]["DATE_END_COUNT"] = date("c", strtotime($arResult["arContest"]["DATE_END"]));
}
// <--

// Проверка конкурса на начало и конец -->
$arResult["arContest"]['START'] = strtotime($arResult["arContest"]["DATE_START"]) > time() ? "N" : "Y";
$arResult["arContest"]['END'] = strtotime($arResult["arContest"]["DATE_END"]) > time() ? "N" : "Y";
// <--

// Что показывать, а что нет -->
{
    // Показывать ли кнопку Принять участие -->
    $arResult["SHOW"]["BUTTON_PARTICIPATE"] =
        ($arResult["arContest"]['START'] == "Y" && $arResult["arContest"]['END'] == "N") ? "Y" : "N";
    // <--

    // Счётчик времени -->
    if (
        strlen($arResult["arContest"]["DATE_END_COUNT"]) > 0
        && $arResult["arContest"]['END'] == "N"
    ) {
        $arResult["SHOW"]["COUNTER"] = "Y";
    }
}
// <--    

$this->__component->SetResultCacheKeys(array("PROPERTIES", "IS_ACTIVE_CONTEST"));