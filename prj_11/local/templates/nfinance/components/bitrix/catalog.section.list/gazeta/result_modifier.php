<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (0 < $arResult['SECTIONS_COUNT'])
{
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
        if (!empty($arSection["UF_ICON"]))
        {
            $arFile = \CFile::GetFileArray($arSection["UF_ICON"]);
            if (is_file($_SERVER["DOCUMENT_ROOT"] . $arFile["SRC"]))
            {
                $arSection["ICON"] = file_get_contents($_SERVER["DOCUMENT_ROOT"] . $arFile["SRC"]);
            }
        }
    }
}