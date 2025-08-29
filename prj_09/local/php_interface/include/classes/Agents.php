<?

namespace Mirvendinga;

use \Bitrix\Main\Loader;
use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale\DiscountCouponsManager;
use Bitrix\Main\Type\DateTime;

class Agents
{
    /**
     * Сортировка по наличию
     * @return string
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function updateProductsSortParameters()
    {
        if (\Bitrix\Main\Loader::includeModule("iblock") && \Bitrix\Main\Loader::includeModule("catalog")) {
            // выбираем товары
            $rsProducts = \Bitrix\Catalog\ProductTable::getList(array(
                'filter' => array('=ELEMENT.IBLOCK_ID' => CATALOG_IB_ID, 'ELEMENT.ACTIVE' => 'Y',),
                'select' => array('ID', 'QUANTITY', 'AVAILABLE', 'ELEMENT.NAME', 'ELEMENT.CODE', 'ELEMENT.IBLOCK_ID', 'PRICE.PRICE'),
                'runtime' => [
                    new \Bitrix\Main\Entity\ReferenceField(
                        "ELEMENT",
                        \Bitrix\Iblock\ElementTable::class,
                        ['=this.ID' => 'ref.ID'],
                        ['join_type' => 'LEFT']
                    ),
                    new \Bitrix\Main\Entity\ReferenceField(
                        "PRICE",
                        \Bitrix\Catalog\PriceTable::class,
                        ['=this.ID' => 'ref.PRODUCT_ID'],
                        ['join_type' => 'LEFT']
                    )
                ]
            ));
            // основной цикл
            while ($product = $rsProducts->fetch()) {
                if (intval($product["QUANTITY"]) > 0 && floatval($product['CATALOG_PRODUCT_PRICE_PRICE'])) {
                    \CIBlockElement::SetPropertyValuesEx($product["ID"], $product["CATALOG_PRODUCT_ELEMENT_IBLOCK_ID"], array("SORT_AVAILABLE" => 1));
                } else {
                    \CIBlockElement::SetPropertyValuesEx($product["ID"], $product["CATALOG_PRODUCT_ELEMENT_IBLOCK_ID"], array("SORT_AVAILABLE" => 0));
                }
            }
        }
        return "\Mirvendinga\Agents::updateProductsSortParameters();";
    }

    public static function setProductsSaleFlag()
    {
        if (\Bitrix\Main\Loader::includeModule("iblock")) {
            $salePropValueId = 302;
            // выбираем товары которые есть в акциях
            $arProductsId = [];
            $rsSales = \CIBlockElement::GetList(
                ["ID" => "ASC"],
                ["IBLOCK_ID" => PROMO_IB_ID, "ACTIVE" => "Y", "ACTIVE_DATE" => "Y", "!PROPERTY_PRODUCTS" => false]
            );
            while ($sale = $rsSales->GetNextElement()) {
                $arSaleProps = $sale->GetProperties();
                if (!empty($arSaleProps["PRODUCTS"]["VALUE"]) && is_array($arSaleProps["PRODUCTS"]["VALUE"])) {
                    $arProductsId = array_unique(array_merge($arProductsId, $arSaleProps["PRODUCTS"]["VALUE"]));
                }
            }
            // основной цикл по вообще всем товарам
            $rsAllProducts = \CIBlockElement::GetList(["ID" => "ASC"], ["IBLOCK_ID" => CATALOG_IB_ID, "ACTIVE" => "Y"]);
            while ($product = $rsAllProducts->GetNextElement()) {
                $arProductFields = $product->GetFields();
                $arProductProps = $product->GetProperties();
                if (!empty($arProductsId) && in_array($arProductFields["ID"], $arProductsId)) {
                    // добавляем значение, если уже есть другие
                    if (!empty($arProductProps["SALE_ACTIONS"]["VALUE_ENUM_ID"]) && is_array($arProductProps["SALE_ACTIONS"]["VALUE_ENUM_ID"])) {
                        $newValue = array_unique(array_merge($arProductProps["SALE_ACTIONS"]["VALUE_ENUM_ID"], [$salePropValueId]));
                        \CIBlockElement::SetPropertyValuesEx($arProductFields["ID"], $arProductFields["IBLOCK_ID"], array("SALE_ACTIONS" => $newValue));
                    } else {
                        \CIBlockElement::SetPropertyValuesEx($arProductFields["ID"], $arProductFields["IBLOCK_ID"], array("SALE_ACTIONS" => [$salePropValueId]));
                    }
                } else {
                    // удаляем значение, если уже есть другие
                    if (!empty($arProductProps["SALE_ACTIONS"]["VALUE_ENUM_ID"]) && is_array($arProductProps["SALE_ACTIONS"]["VALUE_ENUM_ID"])) {
                        $newValue = array_unique(array_diff($arProductProps["SALE_ACTIONS"]["VALUE_ENUM_ID"], [$salePropValueId]));
                        \CIBlockElement::SetPropertyValuesEx($arProductFields["ID"], $arProductFields["IBLOCK_ID"], array("SALE_ACTIONS" => !empty($newValue) ? $newValue : false));
                    }
                }
            }
        }
        return "\Mirvendinga\Agents::setProductsSaleFlag();";
    }

    public static function setProductsSortRegion()
    {
        if (\Bitrix\Main\Loader::includeModule("iblock")) {
            \Mirvendinga\Catalog::setSortRegion();
        }
        return "\Mirvendinga\Agents::setProductsSortRegion();";
    }

    public static function setProductsSectionsLinks()
    {
        if (\Bitrix\Main\Loader::includeModule("iblock")) {
            \Mirvendinga\Catalog::setSectionsLinks();
        }
        return "\Mirvendinga\Agents::setProductsSectionsLinks();";
    }

    // Запуск: \Mirvendinga\Agents::moveValueFromOnePropToTwoList(array('PROP_CODE_FROM' => 'SAYT', 'PROP_CODE_TO' => 'SALE_ACTIONS'))
    public static function moveValueFromOnePropToTwoList($arParams = array())
    {
        if (\Bitrix\Main\Loader::includeModule("iblock")) {
            \Mirvendinga\Service::moveValueFromOnePropToTwoList(
                array('PROP_CODE_FROM' => $arParams['PROP_CODE_FROM'], 'PROP_CODE_TO' => $arParams['PROP_CODE_TO'])
            );
        }
        return "\Mirvendinga\Agents::moveValueFromOnePropToTwoList(array('PROP_CODE_FROM' => '" . $arParams['PROP_CODE_FROM'] . "', 'PROP_CODE_TO' => '" . $arParams['PROP_CODE_TO'] . "'));";
    }

    // Запуск: \Mirvendinga\Agents::moveValueFromOnePropListToTwoElements(array('PROP_CODE_FROM' => 'BREND', 'PROP_CODE_TO' => 'BRAND', 'PROP_CODE_TO_IBLOCK_ID' => BRANDS_IB_ID))
    public static function moveValueFromOnePropListToTwoElements($arParams = array())
    {
        if (\Bitrix\Main\Loader::includeModule("iblock")) {
            \Mirvendinga\Service::moveValueFromOnePropListToTwoElements(
                array(
                    'PROP_CODE_FROM' => $arParams['PROP_CODE_FROM'],
                    'PROP_CODE_TO' => $arParams['PROP_CODE_TO'],
                    'PROP_CODE_TO_IBLOCK_ID' => $arParams['PROP_CODE_TO_IBLOCK_ID'],
                    'PROP_CODE_TO_COMPARE' => $arParams['PROP_CODE_TO_COMPARE'],
                )
            );
        }
        return "\Mirvendinga\Agents::moveValueFromOnePropListToTwoElements(array('PROP_CODE_FROM' => '" . $arParams['PROP_CODE_FROM'] . "', 'PROP_CODE_TO' => '" . $arParams['PROP_CODE_TO'] . "', 'PROP_CODE_TO_IBLOCK_ID' => '" . $arParams['PROP_CODE_TO_IBLOCK_ID'] . "', 'PROP_CODE_TO_COMPARE' => '" . $arParams['PROP_CODE_TO_COMPARE'] . "'));";
    }
}
