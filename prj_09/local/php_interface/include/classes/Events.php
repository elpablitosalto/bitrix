<?

namespace Mirvendinga;

use \Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;

class Events
{
    public static function OnSuccessCatalogImport1C($arPropertyValues, $ABS_FILE_NAME)
    {
        \Mirvendinga\Agents::moveValueFromOnePropToTwoList(array('PROP_CODE_FROM' => 'SAYT', 'PROP_CODE_TO' => 'SALE_ACTIONS'));
    }

    public static function OnEpilogHandler()
    {
        global $APPLICATION;

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        $server = $context->getServer();
        $isIblockElementEditPage = $server->getPhpSelf() == '/bitrix/admin/iblock_element_edit.php';
        $isIblockSectionEditPage = $server->getPhpSelf() == '/bitrix/admin/iblock_section_edit.php';

        if (
            $isIblockElementEditPage
            //&& $request->get('IBLOCK_ID') == Indexis::getIblockId('news', 'news')
        ) {
            $idProp = '317';
            // Доставки -->
            \Bitrix\Main\Loader::includeModule('sale');
            $arDeliveries = array();
            $db_dtype = \CSaleDelivery::GetList(
                array(
                    "NAME" => "ASC",
                    "SORT" => "ASC",
                ),
                array(
                    "ACTIVE" => "Y",
                ),
                false,
                false,
                array()
            );
            while ($ar_dtype = $db_dtype->Fetch()) {
                $arDeliveries[$ar_dtype['ID']] = $ar_dtype;
                $arDeliveryParams = \Bitrix\Sale\Delivery\Services\Manager::getById($ar_dtype['ID']);

                $arDeliveries[$ar_dtype['ID']]['PRICE'] = $arDeliveryParams['CONFIG']['MAIN']['PRICE'];
            }
            $selVales = array();
            foreach ($arDeliveries as $key => $val) {
                $v = $val['ID'];
                $title = "[$v] " . $val['NAME'];
                $selVales[] = "'$v':'$title'";
            }
            // <-- Доставки

            // включаем буфер
            ob_start();

            // выводим информацию
?>
            <script>
                $(document).ready(function() {
                    var $input = $("#tr_PROPERTY_<?= $idProp; ?>").find("input");

                    var data = {
                        <? echo implode(',', $selVales); ?>
                    }
                    var s = $('<select />');
                    $(s).attr('name', $input.attr('name'));
                    for (var val in data) {
                        $('<option />', {
                            value: val,
                            text: data[val]
                        }).appendTo(s);
                    }
                    $(s).val($input.val());

                    $input.replaceWith(s);
                    //console.log(val);
                    //console.log("work it!");
                });
            </script>
<?

            // сохраняем всё что есть в буфере в переменную $content
            $content = ob_get_contents();

            // отключаем и очищаем буфер
            ob_end_clean();

            Asset::getInstance()->addString('<script type="text/javascript" src="/local/templates/mirvendinga/mockup/dist/assets/components/jquery-3.4.1/jquery.min.js"></script>');
            Asset::getInstance()->addString($content);
        }
    }


    // 40307 - Защита раздела "Услуги" от изменений
    private static function isOneCRequest(): bool
    {
        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
        return preg_match('/1C.Enterprise/i', $request->getUserAgent());
    }

    private static function isProtectedSection(int $sectionId): bool
    {
        return in_array($sectionId, [REPAIR_SERVICES_SECTION_ID, TRANSPORT_SERVICES_SECTION_ID, SERVICES_SECTION_ID]);
    }

    public static function servicesSectionDeleteProtect(int $sectionId): bool
    {

        if (self::isOneCRequest() && self::isProtectedSection($sectionId)) {
            $GLOBALS["APPLICATION"]->throwException("Разделы услуг удалять нельзя");
            return false;
        }
        return true;
    }

    public static function servicesDeleteProtect(int $elementId): bool
    {
        if (self::isOneCRequest()) {
            $arElement = \Bitrix\Iblock\ElementTable::getById($elementId)->fetch();
            if (self::isProtectedSection($arElement["IBLOCK_SECTION_ID"])) {
                $GLOBALS["APPLICATION"]->throwException("Услуги удалять нельзя");
                return false;
            }
        }
        return true;
    }

    public static function servicesSectionUpdateProtect(array $arFields): bool
    {
        if (self::isOneCRequest() && self::isProtectedSection($arFields["ID"])) {
            $GLOBALS["APPLICATION"]->throwException("Разделы услуг изменять нельзя");
            return false;
        }
        return true;
    }

    public static function servicesUpdateProtect(array $arFields): bool
    {
        if (self::isOneCRequest()) {
            $arElement = \Bitrix\Iblock\ElementTable::getById($arFields["ID"])->fetch();
            if (self::isProtectedSection($arElement["IBLOCK_SECTION_ID"])) {
                $GLOBALS["APPLICATION"]->throwException("Услуги изменять нельзя");
                return false;
            }
        }
        return true;
    }
    //

    /**
     * Убирает ненужное из поискового индекса (раздел услуги)
     * @see /local/components/waim/search/class.php
     * @param $arFields
     * @return mixed
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function beforeIndexHandler($arFields)
    {
        if ($arFields["PARAM2"] == CATALOG_IB_ID && !empty($arFields["ITEM_ID"]) && Loader::IncludeModule("iblock")) {
            $arItemInfo = \Bitrix\Iblock\ElementTable::getById($arFields["ITEM_ID"])->fetch();
            if (in_array($arItemInfo['IBLOCK_SECTION_ID'], [REPAIR_SERVICES_SECTION_ID, TRANSPORT_SERVICES_SECTION_ID])) {
                $arFields["PARAMS"]["SEARCH_PAGE"] = 'N';
            } else {
                $arFields["PARAMS"]["SEARCH_PAGE"] = 'Y';
            }
            $arFields["PARAMS"]["SECTION_ID"] = $arItemInfo['IBLOCK_SECTION_ID'];
        } else {
            $arFields["PARAMS"]["SEARCH_PAGE"] = 'Y';
        }
        return $arFields;
    }
}
