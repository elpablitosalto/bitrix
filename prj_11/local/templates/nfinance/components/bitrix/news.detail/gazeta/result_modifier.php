<?
$arResult["AUTHORS"] = $arResult["EDITOR"] = [];
if (!empty($arResult["PROPERTIES"]["AUTHORS"]["VALUE"]) && is_array($arResult["PROPERTIES"]["AUTHORS"]["VALUE"]))
{
    foreach ($arResult["PROPERTIES"]["AUTHORS"]["VALUE"] as $authorId)
    {
        $rsAuthor = \Bitrix\Iblock\ElementTable::getById(intval($authorId));
        if ($arAuthor = $rsAuthor->fetch())
        {
            $arAuthor["DETAIL_PICTURE"] = \CFile::GetFileArray($arAuthor["DETAIL_PICTURE"]);
            $arResult["AUTHORS"][] = $arAuthor;
        }
    }
}
if (!empty($arResult["PROPERTIES"]["EDITOR"]["VALUE"]))
{
    $rsEditor = \Bitrix\Iblock\ElementTable::getById(intval($arResult["PROPERTIES"]["EDITOR"]["VALUE"]));
    if ($arEditor = $rsEditor->fetch())
    {
        $arEditor["DETAIL_PICTURE"] = \CFile::GetFileArray($arEditor["DETAIL_PICTURE"]);
        $arResult["EDITOR"] = $arEditor;
    }
}