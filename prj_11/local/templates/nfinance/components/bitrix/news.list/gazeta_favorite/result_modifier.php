<?php
if (!empty($arResult["ITEMS"]))
{
    foreach ($arResult["ITEMS"] as &$arItem)
    {
        if (!empty($arItem["IBLOCK_SECTION_ID"]))
        {
            $rsSection = \Bitrix\Iblock\SectionTable::getById(intval($arItem["IBLOCK_SECTION_ID"]));
            if ($arSection = $rsSection->fetch())
            {
                $arItem["SECTION_NAME"] = $arSection["NAME"];
            }
        }
    }
}