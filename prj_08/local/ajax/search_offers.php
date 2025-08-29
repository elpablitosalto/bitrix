<?
use Bitrix\Main\Context,
    Bitrix\Main\Loader;

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = "N";
$APPLICATION->ShowIncludeStat = false;

if (\Bitrix\Main\Loader::includeModule('iblock'))
{
    $request = Context::getCurrent()->getRequest();
    $arInput = [
        "ID" => intval($request->get("id")),
    ];

    if($arInput > 0){

        $OffersProps = [
            "PROPERTY_VID_DREVESINY_BRUSKA_DOSKI",
            "PROPERTY_METALL",
            "PROPERTY_OKRAS_BRUSKA",
            "PROPERTY_TSVET_METALLICHESKOGO_POKRYTIYA"
        ];

        $arFilter = array(
            "IBLOCK_ID" => Indexis::getIblockId("catalog_1c_offers", "1c_catalog"),
            "ACTIVE" => "Y",
            "PROPERTY_CML2_LINK" => $arInput["ID"]
        );
        foreach($OffersProps as $prop){
            $var = $request->get($prop);
            if(isset($var) && mb_strlen($var) > 0){
                $arFilter[$prop."_VALUE"] = $var;
            }
        }

        $result = [];
        $rs = CIBlockElement::GetList(
            array(),
            $arFilter,
            false,
            false,
            array_merge(array("ID"), $OffersProps)
        );
        while($ar = $rs->GetNext()) {
            $result["ELEMENTS"][] = $ar["ID"];
            foreach($OffersProps as $prop){
                $propName = $prop."_VALUE";
                $ar[$propName] = mb_strtolower($ar[$propName]);
                if(!isset( $result[$prop]))
                    $result[$prop] = [];
                if(isset($ar[$propName]) && mb_strlen($ar[$propName]) > 0 && !in_array($ar[$propName], $result[$prop])){
                    $result[$prop][] = $ar[$propName];
                }
            }
        }
        echo json_encode($result);
    }
}
?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php"); ?>