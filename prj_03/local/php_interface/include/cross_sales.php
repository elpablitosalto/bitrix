<?
use \Bitrix\Main\Loader;
use \Bitrix\Main\Web\Json;
use \Bitrix\Iblock;

/**
 * 31559 - Аналоги товара
 * Class CrossSales
 */
class CrossSales
{
    private const CROSS_SALES_IB_ID = 44;

    /**
     * Основной метод
     * @param int $elementId
     * @param array $arComponentParams
     * @return array
     * @throws \Bitrix\Main\LoaderException
     */
    public static function getAnalogs(int $elementId, array $arComponentParams) : array
    {
        $arResult = [];
        if(!Loader::includeModule('iblock') || !Loader::includeModule('aspro.mshop')){
            throw new \Exception(__METHOD__.": Не установлены необходимые модули!");
        }
        if(empty($elementId)){
            return $arResult;
        }
        $rsElement = \CIBlockElement::GetList(["ID" => "ASC"], ["IBLOCK_ID" => $arComponentParams["IBLOCK_ID"], "ID" => $elementId]);
        if($element = $rsElement->GetNextElement()) {
            $arElement = array_merge($element->GetFields(), ["PROPERTIES" => $element->GetProperties()]);
            // Проверяем, что для товара есть правила
            $arCsRules = self::findMatchedRules($arElement["ID"]);
            if (!empty($arCsRules) && is_array($arCsRules)) {
                $firstRule = current($arCsRules);
                $arResult = self::findMatchedProducts($firstRule, $arElement, $arComponentParams);
            }
        }
        return $arResult;
    }

    /**
     * Проверка правил для товара
     * @param int $elementId
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    private static function findMatchedRules(int $elementId) : array
    {
        $arCrossSales = [];
        $iblock = Iblock\Iblock::wakeUp(self::CROSS_SALES_IB_ID);
        $rsCrossSales = $iblock->getEntityDataClass()::getList([
            "filter" => [
                "IBLOCK_ID" => self::CROSS_SALES_IB_ID,
                "ACTIVE" => "Y",

            ],
            "order" => ["SORT" => "ASC"],
            "select" => [
                "*",
                "ROOT_ELEMENTS",
                "ROOT_SECTIONS",
                "LIMIT",
                "ANALOG_FILTER",
                "ANALOG_PROPERTIES",
            ],
            "cache" => ["ttl" => 3600]
        ]);
        while($csRule = $rsCrossSales->fetchObject()){
            $csRuleMatched = false;
            // Выясняем привязку к элементам
            foreach($csRule->getRootElements()->getAll() as $rootElementValue) {
                if($elementId == $rootElementValue->getValue()){
                    $csRuleMatched = true;
                }
            }
            // Выясняем привязку к разделам
            foreach($csRule->getRootSections()->getAll() as $csSectionValue) {
                $rsElementSections = \CIBlockElement::GetElementGroups($elementId, true);
                while ($arElementSection = $rsElementSections->fetch()){
                    if ((int)$arElementSection['ID'] == (int)$csSectionValue->getValue()){
                        $csRuleMatched = true;
                    }
                }
            }
            if($csRuleMatched){
                $arAnalogProperties = [];
                foreach($csRule->getAnalogProperties()->getAll() as $analogPropertiesValue) {
                    $arAnalogProperties[] = $analogPropertiesValue->getValue();
                }
                $arCrossSales[$csRule->getId()] = [
                    "ID"        => $csRule->getId(),
                    "NAME"      => $csRule->getName(),
                    "SORT"      => $csRule->getSort(),
                    "LIMIT"     => !empty($csRule->getLimit()->getValue()) ? $csRule->getLimit()->getValue() : 50,
                    "ANALOG_FILTER"     => !empty($csRule->getAnalogFilter()->getValue()) ? Json::decode($csRule->getAnalogFilter()->getValue()) : [],
                    "ANALOG_PROPERTIES" => $arAnalogProperties,
                ];
            }
        }
        return $arCrossSales;
    }

    /**
     * Поиск аналогичных товаров
     * @param array $arCsRule
     * @param array $arElement
     * @param array $arComponentParams
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    private static function findMatchedProducts(array $arCsRule, array $arElement, array $arComponentParams) : array
    {
        $arProducts = $arFilter = [];
        // Получаем фильтр, если есть
        if(!empty($arCsRule["ANALOG_FILTER"])) {
            $obCondition = new CMShopCondition();
            $filter = $obCondition->parseCondition($arCsRule["ANALOG_FILTER"], $arComponentParams);
            if(!empty($filter) && is_array($filter)){
                $arFilter[] = $filter;
            }
        }
        // Проверяем, есть ли аналогичные поля для товара
        if(!empty($arCsRule["ANALOG_PROPERTIES"]) && !empty($arElement["PROPERTIES"])){
            $arAnalogPropertiesFilter = ["LOGIC" => "AND"];
            $rsPropList = Iblock\PropertyTable::getList([
                "filter" => [
                    "IBLOCK_ID" => $arElement["IBLOCK_ID"],
                    "ID" => $arCsRule["ANALOG_PROPERTIES"],
                    "ACTIVE" => "Y"
                ]
            ]);
            while ($arProperty = $rsPropList->fetch()){
                $productProperty = $arElement["PROPERTIES"][$arProperty["CODE"]];
                if(!empty($productProperty) && !empty($productProperty["VALUE"])){
                    $arAnalogPropertiesFilter[]["PROPERTY_".$productProperty["ID"]."_VALUE"] = $productProperty["VALUE"];
                }
            }
            if(!empty($arAnalogPropertiesFilter) && is_array($arAnalogPropertiesFilter)){
                $arFilter[] = $arAnalogPropertiesFilter;
            }
        }
        if(!empty($arFilter)){
            $arProducts = CMshopCache::CIBLockElement_GetList(
                array(
                    'SORT' => 'ASC', // сортировка товаров
                    'CACHE' => array("MULTI" => "Y", "TAG" => CMshopCache::GetIBlockCacheTag($arComponentParams["IBLOCK_ID"]))
                ),
                $arFilter,
                false,
                !empty($arCsRule["LIMIT"]) ? ['nTopCount' => intval($arCsRule["LIMIT"])] : false,
                ["ID", "NAME", "CODE"]
            );
        }
        return $arProducts;
    }
}

/**
 * Пользовательское поле "Привязка к свойствам ИБ"
 * Class CUserTypePropertyList
 */
class CUserTypePropertyList extends \Bitrix\Main\UserField\Types\StringType
{
    const CATALOG_IBLOCK_ID = 34;

    /**
     * Описание пользовательского типа свойства
     * @return array
     */
    public static function OnIBlockPropertyBuildList() : array
    {
        return array(
            'PROPERTY_TYPE' => 'S',
            'USER_TYPE' => 'SPropertyList',
            "DESCRIPTION" => "Список свойств",
            'GetPropertyFieldHtml' => array(__CLASS__, 'GetPropertyFieldHtml'),
            'GetAdminListViewHTML' => array(__CLASS__, 'GetAdminListViewHTML'),
        );
    }

    /**
     * Описание пользовательского свойства для модуля <b>iblock</b>
     * @return array
     */
    function GetIBlockPropertyDescription()
    {
        return array(
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "property_list",
            "DESCRIPTION" => "Список свойств",
            'GetAdminListViewHTML' => ['CUserTypePropertyList', 'GetAdminListViewHTML']
        );
    }


    /**
     * Отображение пользовательского свойства в меню редактирования пользователя
     * @param $name
     * @param $jsonArValues
     * @param bool $is_ajax
     * @return string
     */
    public static function getEditHTML(array $arPropertyData, string $fieldValue, $is_ajax = false)
    {
        $sHtml = "";
        $arProperties = [];
        // Get all sections
        $PHPCache = new CPHPCache ();
        if($PHPCache->InitCache(84600, md5("property_list"), '/waim/property_list_user_type')) {
            $arVars = $PHPCache->GetVars();
            $arProperties = $arVars['RESULT'];
        } else {
            $arFilter = array(
                'IBLOCK_ID' => self::CATALOG_IBLOCK_ID,
                'ACTIVE' => 'Y',
            );
            //
            $rsProperties = Iblock\PropertyTable::getList([
                "filter" => $arFilter,
                "order" => ["NAME" => "ASC", "SORT" => "ASC"]
            ]);
            while ($arProperty = $rsProperties->fetch()) {
                $arProperties[] = $arProperty;
            }
            if($PHPCache->StartDataCache()) {
                $GLOBALS['CACHE_MANAGER']->StartTagCache('/waim/property_list_user_type');
                $GLOBALS['CACHE_MANAGER']->RegisterTag(md5("property_list"));
                $GLOBALS['CACHE_MANAGER']->EndTagCache();
                $PHPCache->EndDataCache(array(
                    'RESULT' => $arProperties,
                ));
            }
        }
        if(!empty($arProperties)) {
            $sHtml .= "<select name='PROP[".$arPropertyData["ID"]."][]'>";
            $sHtml .= "<option></option>";
            foreach ($arProperties as $property) {
                $sHtml .= "<option value='".$property["ID"]."'".(($fieldValue == $property["ID"]) ? " selected" : "").">".$property["NAME"]." [".$property["CODE"]."]</option>";
            }
            $sHtml .= "</select>";
        }
        return $sHtml;
    }


    /**
     * Отображение пользовательского свойства в списке
     * @param array $arUserField
     * @param array $arHtmlControl
     * @return string
     */
    public static function GetAdminListViewHTML($arUserField, $arHtmlControl)
    {
        $sHTML = "";
        if(!empty($arHtmlControl["VALUE"])) {
            $rsProperty = Iblock\PropertyTable::getById(intval($arHtmlControl["VALUE"]));
            if($arProperty = $rsProperty->fetch()){
                $sHTML .= $arProperty["NAME"]." [".$arProperty["CODE"]."]";
            }
        }
        return "<span>".$sHTML."</span>";
    }

    public static function GetPropertyFieldHtml(array $arUserField, ?array $arHtmlControl) : string
    {
        return self::getEditHTML($arUserField, $arHtmlControl['VALUE'], false);
    }

    public static function canUseArrayValueForSingleField()
    {
        return true;
    }

    public static function checkFields(array $userField, $value): array
    {
        return [];
    }
}

AddEventHandler("iblock", "OnIBlockPropertyBuildList", array("CUserTypePropertyList", "OnIBlockPropertyBuildList"));