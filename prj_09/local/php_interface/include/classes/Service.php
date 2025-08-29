<?

namespace Mirvendinga;

class Service
{
    public static function moveValueFromOnePropListToTwoElements($arParams = array())
    {
        $arResult = array();
        $iblockId = CATALOG_IB_ID;
        //vardump($arParams);
        if (!empty($arParams['PROP_CODE_FROM']) && !empty($arParams['PROP_CODE_TO']) && !empty($arParams['PROP_CODE_TO_IBLOCK_ID']) && !empty($iblockId)) {
            // to prop values -->
            $arPropValuesTo = array();
            $arSelect = array("ID", "NAME");
            if (!empty($arParams['PROP_CODE_TO_COMPARE'])) {
                $arSelect[] = 'PROPERTY_' . $arParams['PROP_CODE_TO_COMPARE'];
            }
            $arFilter = array("IBLOCK_ID" => $arParams['PROP_CODE_TO_IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            $res = \CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
            while ($arFields = $res->GetNext()) {
                $name = $arFields['NAME'];
                if (!empty($arParams['PROP_CODE_TO_COMPARE'])) {
                    $n = $arFields['PROPERTY_' . $arParams['PROP_CODE_TO_COMPARE'] . '_VALUE'];
                    if (!empty($n)) {
                        $name = $n;
                    }
                }
                $arPropValuesTo[ToLower($name)] = $arFields['ID'];
            }
            // <-- to prop values

            $arSelect = array("ID", "NAME", "PROPERTY_" . $arParams['PROP_CODE_FROM'], "PROPERTY_" . $arParams['PROP_CODE_TO']);
            $arFilter = array("IBLOCK_ID" => $iblockId, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($arFields = $res->GetNext()) {
                $propValueFrom = $arFields["PROPERTY_" . $arParams['PROP_CODE_FROM'] . '_VALUE'];
                $propValueFrom = ToLower($propValueFrom);

                if (!empty($arPropValuesTo[$propValueFrom])) {
                    $propValueIdTo = $arPropValuesTo[$propValueFrom];

                    \CIBlockElement::SetPropertyValuesEx(
                        $arFields['ID'],
                        $iblockId,
                        array($arParams['PROP_CODE_TO'] => $propValueIdTo)
                    );
                }
            }
        }
    }

    public static function moveValueFromOnePropToTwoList($arParams = array())
    {
        $arResult = array();
        $iblockId = CATALOG_IB_ID;

        if (!empty($arParams['PROP_CODE_FROM']) && !empty($arParams['PROP_CODE_TO']) && !empty($iblockId)) {

            // to prop values -->
            $arPropValuesTo = array();
            $property_enums = \CIBlockPropertyEnum::GetList(
                array("DEF" => "DESC", "SORT" => "ASC"),
                array("IBLOCK_ID" => $iblockId, "CODE" => $arParams['PROP_CODE_TO'])
            );
            while ($enum_fields = $property_enums->GetNext()) {
                $arPropValuesTo[$enum_fields['VALUE']] = $enum_fields['ID'];
                //echo $enum_fields["ID"] . " - " . $enum_fields["VALUE"] . "<br>";
            }
            // <-- to prop values

            $arSelect = array("ID", "NAME", "PROPERTY_" . $arParams['PROP_CODE_FROM'], "PROPERTY_" . $arParams['PROP_CODE_TO']);
            $arFilter = array("IBLOCK_ID" => $iblockId, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            $res = \CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($arFields = $res->GetNext()) {
                $propValueFrom = $arFields["PROPERTY_" . $arParams['PROP_CODE_FROM'] . '_VALUE'];

                if (!empty($arPropValuesTo[$propValueFrom])) {
                    $propValueIdTo = $arPropValuesTo[$propValueFrom];

                    \CIBlockElement::SetPropertyValuesEx(
                        $arFields['ID'],
                        $iblockId,
                        array($arParams['PROP_CODE_TO'] => $propValueIdTo)
                    );
                }
            }
        }

        return $arResult;
    }
}
