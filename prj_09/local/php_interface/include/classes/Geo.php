<?

namespace Mirvendinga;

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Web\Cookie;
use \Bitrix\Sale\Location\LocationTable;

class Geo
{
    private static $defaultCity = "Москва";
    public const COOKIE_NAME = "REGION";

    // XML_ID группы местоположений - ID цены
    private static $priceMatrix = [
        "siberian"      => 4,
        "far_eastern"   => 4,
        "default"       => 6,
    ];
    // XML_ID группы местоположений - ID склада
    private static $storageMatrix = [
        "central"           => 6,
        "northwestern"      => 3,
        "volga"             => 6,
        "southern"          => 7,
        "ural"              => 5,
        "siberian"          => 4,
        "far_eastern"       => 4,
    ];

    private static function getPriceStorageMatrix(): array
    {
        $arResult = [];
        if (Loader::includeModule("iblock")) {
            $rsIblock = \CIBlock::GetList([], ["CODE" => "regions"]);
            if ($arIblock = $rsIblock->Fetch()) {
                $arSelect = false;
                $rsRegions = \CIBlockElement::GetList(
                    ["ID" => "ASC"],
                    [
                        "IBLOCK_ID" => $arIblock["ID"],
                        "ACTIVE" => "Y"
                    ],
                    false,
                    false,
                    $arSelect
                );
                while ($ob = $rsRegions->GetNextElement()) {
                    $arRegion = $ob->GetFields();
                    $arRegion['PROPERTIES'] = $ob->GetProperties();

                    $arResult[$arRegion["CODE"]] = [
                        "PRICE_ID" => intval($arRegion['PROPERTIES']['PRICE_ID']['VALUE']),
                        //"STORE_ID" => intval($arRegion['PROPERTIES']["STORE_ID"]['VALUE']),
                        //"STORAGE_ID" => intval($arRegion['PROPERTIES']["STORE_ID"]['VALUE']),
                        "WAREHOUSE_IDS" => $arRegion['PROPERTIES']['WAREHOUSE_IDS']['VALUE']
                    ];
                }
                /*
                $rsRegions = \CIBlockElement::GetList(
                    ["ID" => "ASC"],
                    [
                        "IBLOCK_ID" => $arIblock["ID"],
                        "ACTIVE" => "Y"
                    ],
                    false,
                    false,
                    ["ID", "NAME", "CODE", "PROPERTY_PRICE_ID", "PROPERTY_STORE_ID"]
                );
                while ($arRegion = $rsRegions->GetNext()) {
                    $arResult[$arRegion["CODE"]] = [
                        "PRICE_ID" => intval($arRegion["PROPERTY_PRICE_ID_VALUE"]),
                        "STORE_ID" => intval($arRegion["PROPERTY_STORE_ID_VALUE"])
                    ];
                }
                */
            }
        }
        return $arResult;
    }

    /**
     * Получение всех регионов
     * @return array
     * @throws \Bitrix\Main\LoaderException
     */
    private static function getRegions()
    {
        global $USER;

        $arResult = [];
        if (Loader::includeModule("sale")) {
            $obCache = new \CPHPCache();
            $cacheId = "all_regions";
            $cachePath = '/' . $cacheId;
            //$cacheTime = 86400;
            $cacheTime = 0;
            if ($obCache->InitCache($cacheTime, $cacheId, $cachePath)) {
                $vars = $obCache->GetVars();
                $arResult = $vars['result'];
            } elseif ($obCache->StartDataCache()) {

                // -->
                $arLocationsIds = array();
                $rsLocationGroups = \Bitrix\Sale\Location\GroupLocationTable::getList([
                    "select" => [
                        "LOCATION_ID",
                        "LOCATION_GROUP_ID",
                        "GROUP_CODE" => "GROUP.CODE"
                    ]
                ]);
                while ($locationGroup = $rsLocationGroups->fetch()) {
                    $arLocationsIds[] = $locationGroup["LOCATION_ID"];
                }
                $arGroupSubLocationsList = array();
                $rsGroupSubLocations = LocationTable::getList(array(
                    'runtime' => array(
                        'SUB' => array(
                            'data_type' => '\Bitrix\Sale\Location\Location',
                            'reference' => array(
                                '>=ref.LEFT_MARGIN' => 'this.LEFT_MARGIN',
                                '<=ref.RIGHT_MARGIN' => 'this.RIGHT_MARGIN'
                            ),
                            'join_type' => "inner"
                        )
                    ),
                    'filter' => array(
                        '=ID' => $arLocationsIds,
                        '=SUB.TYPE_ID' => [5, 6],
                        '=SUB.NAME.LANGUAGE_ID' => LANGUAGE_ID
                    ),
                    'select' => array(
                        'S_ID' => 'SUB.ID',
                        'ID' => 'ID',
                    )
                ));
                while ($subLocation = $rsGroupSubLocations->fetch()) {
                    $arGroupSubLocationsList[$subLocation['ID']][] = $subLocation["S_ID"];
                }
                // <--

                $arPriceStorageMatrix = self::getPriceStorageMatrix();

                // Выбираем группы
                $arLocationGroups = [];
                $rsLocationGroups = \Bitrix\Sale\Location\GroupLocationTable::getList([
                    "select" => [
                        "LOCATION_ID",
                        "LOCATION_GROUP_ID",
                        "GROUP_CODE" => "GROUP.CODE"
                    ]
                ]);
                while ($locationGroup = $rsLocationGroups->fetch()) {
                    if (empty($arLocationGroups[$locationGroup["GROUP_CODE"]])) {
                        $arLocationGroups[$locationGroup["GROUP_CODE"]] = [];
                    }
                    $arGroupSubLocations = [];
                    /*
                    $rsGroupSubLocations = LocationTable::getList(array(
                        'runtime' => array(
                            'SUB' => array(
                                'data_type' => '\Bitrix\Sale\Location\Location',
                                'reference' => array(
                                    '>=ref.LEFT_MARGIN' => 'this.LEFT_MARGIN',
                                    '<=ref.RIGHT_MARGIN' => 'this.RIGHT_MARGIN'
                                ),
                                'join_type' => "inner"
                            )
                        ),
                        'filter' => array(
                            '=ID' => $locationGroup["LOCATION_ID"],
                            '=SUB.TYPE_ID' => [5, 6],
                            '=SUB.NAME.LANGUAGE_ID' => LANGUAGE_ID
                        ),
                        'select' => array(
                            'S_ID' => 'SUB.ID'
                        )
                    ));
                    while($subLocation = $rsGroupSubLocations->fetch()){
                        $arGroupSubLocations[] = $subLocation["S_ID"];
                    }
                    /**/
                    if (is_array($arGroupSubLocationsList[$locationGroup["LOCATION_ID"]])) {
                        $arGroupSubLocations = $arGroupSubLocationsList[$locationGroup["LOCATION_ID"]];
                    } else if (!is_array($arGroupSubLocations)) {
                        $arGroupSubLocations = array();
                    }
                    $arLocationGroups[$locationGroup["GROUP_CODE"]] = array_unique(array_merge($arLocationGroups[$locationGroup["GROUP_CODE"]], $arGroupSubLocations));
                }
                //vardump($arLocationGroups);
                //
                $rsRegions = LocationTable::getList([
                    'filter' => [
                        '=TYPE_ID' => [5, 6],
                        'NAME.LANGUAGE_ID' => LANGUAGE_ID,
                        'TYPE.NAME.LANGUAGE_ID' => LANGUAGE_ID,
                    ],
                    'select' => [
                        'ID',
                        'CODE',
                        'LOCATION_NAME' => 'NAME.NAME',
                        'TYPE_NAME' => 'TYPE.NAME.NAME',
                        'TYPE_CODE' => 'TYPE.CODE',
                    ],
                    'order' => ["SORT" => "ASC", "ID" => "ASC"]
                ]);
                while ($region = $rsRegions->fetch()) {
                    // Выясняем группу
                    $groupCode = "";
                    if (!empty($arLocationGroups)) {
                        foreach ($arLocationGroups as $locationGroupCode => $locationGroup) {
                            if (in_array($region["ID"], $locationGroup)) {
                                $groupCode = $locationGroupCode;
                                break;
                            }
                        }
                    }
                    //
                    $arResult[] = [
                        "ID" => $region["ID"],
                        "CODE" => $region["CODE"],
                        "NAME" => $region["LOCATION_NAME"],
                        "TYPE_NAME" => $region["TYPE_NAME"],
                        "TYPE_CODE" => $region["TYPE_CODE"],
                        "PRICE_ID" => (!empty($groupCode) && !empty($arPriceStorageMatrix[$groupCode]["PRICE_ID"])) ? $arPriceStorageMatrix[$groupCode]["PRICE_ID"] : false,
                        //"STORAGE_ID" => (!empty($groupCode) && !empty($arPriceStorageMatrix[$groupCode]["STORE_ID"])) ? $arPriceStorageMatrix[$groupCode]["STORE_ID"] : false,
                        "WAREHOUSE_IDS" => (!empty($groupCode) && !empty($arPriceStorageMatrix[$groupCode]["WAREHOUSE_IDS"])) ? $arPriceStorageMatrix[$groupCode]["WAREHOUSE_IDS"] : false,
                        "MEGAREGION_CODE" => $groupCode
                    ];
                }
                $obCache->EndDataCache(array('result' => $arResult));
            }
        }
        return $arResult;
    }

    /**
     * Получение всех регионов
     * @return array
     * @throws \Bitrix\Main\LoaderException
     */
    /*
     private static function getRegions_old()
    {
        $arResult = [];
        if (Loader::includeModule("sale")) {
            $obCache = new \CPHPCache();
            $cacheId = "all_regions";
            $cachePath = '/' . $cacheId;
            if ($obCache->InitCache(86400, $cacheId, $cachePath)) {
                $vars = $obCache->GetVars();
                $arResult = $vars['result'];
            } elseif ($obCache->StartDataCache()) {
                $arPriceStorageMatrix = self::getPriceStorageMatrix();
                // Выбираем группы
                $arLocationGroups = [];
                $rsLocationGroups = \Bitrix\Sale\Location\GroupLocationTable::getList([
                    "select" => [
                        "LOCATION_ID",
                        "LOCATION_GROUP_ID",
                        "GROUP_CODE" => "GROUP.CODE"
                    ]
                ]);
                while ($locationGroup = $rsLocationGroups->fetch()) {
                    if (empty($arLocationGroups[$locationGroup["GROUP_CODE"]])) {
                        $arLocationGroups[$locationGroup["GROUP_CODE"]] = [];
                    }
                    $arGroupSubLocations = [];
                    $rsGroupSubLocations = LocationTable::getList(array(
                        'runtime' => array(
                            'SUB' => array(
                                'data_type' => '\Bitrix\Sale\Location\Location',
                                'reference' => array(
                                    '>=ref.LEFT_MARGIN' => 'this.LEFT_MARGIN',
                                    '<=ref.RIGHT_MARGIN' => 'this.RIGHT_MARGIN'
                                ),
                                'join_type' => "inner"
                            )
                        ),
                        'filter' => array(
                            '=ID' => $locationGroup["LOCATION_ID"],
                            '=SUB.TYPE_ID' => [5, 6],
                            '=SUB.NAME.LANGUAGE_ID' => LANGUAGE_ID
                        ),
                        'select' => array(
                            'S_ID' => 'SUB.ID',
                            'ID' => 'ID',
                        )
                    ));
                    while ($subLocation = $rsGroupSubLocations->fetch()) {
                        //echo 'LOCATION_ID = ' . $locationGroup["LOCATION_ID"];
                        //vardump($subLocation);
                        //die();
                        $arGroupSubLocations[] = $subLocation["S_ID"];
                    }
                    $arLocationGroups[$locationGroup["GROUP_CODE"]] = array_unique(array_merge($arLocationGroups[$locationGroup["GROUP_CODE"]], $arGroupSubLocations));
                }
                //
                $rsRegions = LocationTable::getList([
                    'filter' => [
                        '=TYPE_ID' => [5, 6],
                        'NAME.LANGUAGE_ID' => LANGUAGE_ID,
                        'TYPE.NAME.LANGUAGE_ID' => LANGUAGE_ID,
                    ],
                    'select' => [
                        'ID',
                        'CODE',
                        'LOCATION_NAME' => 'NAME.NAME',
                        'TYPE_NAME' => 'TYPE.NAME.NAME',
                        'TYPE_CODE' => 'TYPE.CODE',
                    ],
                    'order' => ["SORT" => "ASC", "ID" => "ASC"]
                ]);
                while ($region = $rsRegions->fetch()) {
                    // Выясняем группу
                    $groupCode = "";
                    if (!empty($arLocationGroups)) {
                        foreach ($arLocationGroups as $locationGroupCode => $locationGroup) {
                            if (in_array($region["ID"], $locationGroup)) {
                                $groupCode = $locationGroupCode;
                                break;
                            }
                        }
                    }
                    //
                    $arResult[] = [
                        "ID" => $region["ID"],
                        "CODE" => $region["CODE"],
                        "NAME" => $region["LOCATION_NAME"],
                        "TYPE_NAME" => $region["TYPE_NAME"],
                        "TYPE_CODE" => $region["TYPE_CODE"],
                        "PRICE_ID" => (!empty($groupCode) && !empty($arPriceStorageMatrix[$groupCode]["PRICE_ID"])) ? $arPriceStorageMatrix[$groupCode]["PRICE_ID"] : false,
                        "STORAGE_ID" => (!empty($groupCode) && !empty($arPriceStorageMatrix[$groupCode]["STORE_ID"])) ? $arPriceStorageMatrix[$groupCode]["STORE_ID"] : false,
                        "MEGAREGION_CODE" => $groupCode
                    ];
                }
                $obCache->EndDataCache(array('result' => $arResult));
            }
        }
        return $arResult;
    }
    */

    /**
     * Получение текущего региона (global $arRegion)
     * @return array
     * @throws \Bitrix\Main\LoaderException
     */
    public static function getCurrentRegion()
    {
        $arCurrentRegion = [];
        $currentIP = \Bitrix\Main\Service\GeoIp\Manager::getRealIp();
        $location = \Bitrix\Main\Service\GeoIp\Manager::getDataResult($currentIP, "ru");
        if ($location) {
            $geoData = $location->GetGeoData();
        }
        $arRegions = self::getRegions();
        if (!empty($arRegions)) {
            $regionCookie = Application::getInstance()->getContext()->getRequest()->getCookie(self::COOKIE_NAME);
            if (!empty($regionCookie)) {
                $currentCityIndex = array_search($regionCookie, array_column($arRegions, "ID"));
                if ($currentCityIndex !== false) {
                    $curRegion = $arRegions[$currentCityIndex];
                }
            } elseif (!empty($geoData) && !empty($geoData->cityName)) {
                $currentCityIndex = array_search($geoData->cityName, array_column($arRegions, "NAME"));
                if ($currentCityIndex !== false) {
                    $curRegion = $arRegions[$currentCityIndex];
                }
            }
            // default
            if (empty($curRegion)) {
                $defaultCityIndex = array_search(self::$defaultCity, array_column($arRegions, "NAME"));
                if ($defaultCityIndex !== false) {
                    $curRegion = $arRegions[$defaultCityIndex];
                } else {
                    $curRegion = current($arRegions);
                }
            }
            $arCurrentRegion = $curRegion;
        }
        return $arCurrentRegion;
    }

    /**
     * Проверяет, показывать ли popup с выбором города
     * @return bool
     */
    public static function showPopUp(): bool
    {
        $request =  Application::getInstance()->getContext()->getRequest();
        $regionCookie = $request->getCookie(self::COOKIE_NAME);
        if (!empty($regionCookie)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Получение всех регионов
     * @return array
     * @throws \Bitrix\Main\LoaderException
     */
    public static function getAllRegions()
    {
        $arRegions = self::getRegions();
        return $arRegions;
    }

    /**
     * Получение региона по его ID
     * @param int $regionId
     * @return array
     * @throws \Bitrix\Main\LoaderException
     */
    public static function getRegionById(int $regionId): array
    {
        $arResult = [];
        $arRegions = self::getRegions();
        if (!empty($regionId)) {
            $cityIndex = array_search($regionId, array_column($arRegions, "ID"));
            if ($cityIndex !== false) {
                $arResult = $arRegions[$cityIndex];
            }
        }
        return $arResult;
    }

    public static function getRegionByName(string $searchQuery): array
    {
        $arResult = [];
        $arRegions = self::getRegions();
        if (!empty($searchQuery)) {
            $arResult = array_filter($arRegions, function ($element) use ($searchQuery) {
                return strstr(mb_strtolower($element["NAME"]), mb_strtolower($searchQuery)) !== false;
            });
        }
        return $arResult;
    }
}
