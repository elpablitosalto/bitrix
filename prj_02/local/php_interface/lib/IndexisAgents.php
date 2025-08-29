<?
//CAgent::AddAgent("IndexisAgents::ChangeChildSort();");

class IndexisAgents
{
    public static function ChangeChildSort()
    {
        \Bitrix\Main\Loader::includeModule('iblock');

        $iblock_id = Indexis::getIblockId("adaptation");

        if (intval($iblock_id) > 0) {
            $arSelect = array("ID", "NAME", "SORT");
            $arFilter = array(
                "IBLOCK_ID" => $iblock_id,
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y"
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();

                /*
                $arLoadProductArray = array(
                    "SORT" => rand( 1, 10000 )
                );
                $res = $el->Update($arFields["ID"], $arLoadProductArray);
                */
                CIBlockElement::SetPropertyValuesEx(
                    $arFields["ID"], 
                    $iblock_id, 
                    array("RAND_SORT_IND" => rand( 1, 10000 ))
                );
            }
        }

        return "IndexisAgents::ChangeChildSort();";
    }
}
