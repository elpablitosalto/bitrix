<?

namespace Hair;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Service\GeoIp;
use Hair\General;
use Bitrix\Main;

class Geo
{
    public $currentIP;
    public $resultObj;
    public $resultArray;

    public function __construct($byIP = true)
    {
        if ($byIP && !General::isBot()) :
            $this->currentIP = GeoIp\Manager::getRealIp();
            if (isset($_COOKIE['GEO_POSITION']) && !empty($_COOKIE['GEO_POSITION'])) :
                $this->resultArray = unserialize($_COOKIE['GEO_POSITION']);
            else :
                $this->resultObj = GeoIp\Manager::getDataResult($this->currentIP, "ru");
                if (isset($this->resultObj)) {
                    $this->resultArray = $this->resultObj->GetGeoData();
                }

                setcookie("GEO_POSITION", serialize($this->resultArray), time() + 3600 * 24, "/", "." . self::getRootDomain());
            endif;
        endif;
        // 41593
        $currentSubDomain = self::getCurrentSubDomain();
        if (!empty($currentSubDomain)) {
            $this->resultArray = new \Bitrix\Main\Service\GeoIp\Data();
            $this->resultArray->regionCode = !empty($currentSubDomain["REGION_CODE"]) ? "RU-" . $currentSubDomain["REGION_CODE"] : "";
            $this->resultArray->cityName = $currentSubDomain["NAME"];
            $this->resultArray->latitude = $currentSubDomain["COORDS"]["LAT"];
            $this->resultArray->longitude = $currentSubDomain["COORDS"]["LON"];
            // TODO: сюда можно еще напихать чего не хватает если где-то
        } else {
            $subDomain = self::getSubDomainByName($this->getCity());
            if (!empty($subDomain) && empty($currentSubDomain)) {
                $request = \Bitrix\Main\Context::getCurrent()->getRequest();
                $rootDomain = self::getRootDomain();
                $domain = $request->getServer()->getRequestScheme() . "://" . $subDomain["CODE"] . "." . $rootDomain;
                LocalRedirect($domain . $request->getRequestUri(), true);
                exit(200);
            }
        }
    }

    /* public function getCoords() {
        return $this->resultArray->longitude.';'.$this->resultArray->latitude;
    }*/

    public function getCity()
    {
        if (empty($this->resultArray->cityName)) return 'Ростов-на-Дону';
        return $this->resultArray->cityName;
    }

    public function getArray()
    {
        return $this->resultArray;
    }

    public function getCoordsByValue($value)
    {
        $resp = file_get_contents('https://geocode-maps.yandex.ru/1.x/?apikey=' . YANDEX_MAP . '&geocode=' . urlencode($value) . '&format=json');

        return json_decode($resp);
    }

    public static function getCurrentSubDomain(): array
    {
        $arResult = [];
        $request = Main\Context::getCurrent()->getRequest();
        if (preg_match('/^([^\.]+)\.hair\.(ru|local)$/i', $request->getHttpHost(), $arMatches)) {
            if (!empty($arMatches[1]) && Main\Loader::includeModule("iblock")) {
                $subDomain = trim($arMatches[1]);
                $entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock(SALONS);
                $arSelect = [
                    "*",
                    "COORDS" => "UF_COORDS",
                    "REGION_CODE" => "PARENT_SECTION.CODE"
                ];
                foreach (\Hair\GeoTemplates::$arRegionNameDeclines as $regionNameDecline) {
                    $arSelect[$regionNameDecline] = "UF_" . $regionNameDecline;
                }
                $rsRegion = $entity::getList([
                    "filter" => [
                        'IBLOCK_ID' => SALONS,
                        '=CODE' => $subDomain,
                        'ACTIVE' => 'Y',
                        '!UF_SUBDOMAIN' => false
                    ],
                    "select" => $arSelect
                ]);
                if ($arRegion = $rsRegion->fetch()) {
                    $arCoords = [
                        "LAT" => "",
                        "LON" => "",
                    ];
                    if (!empty($arRegion["COORDS"])) {
                        list($arCoords["LAT"], $arCoords["LON"]) = array_map("trim", explode(",", $arRegion["COORDS"]));
                    }
                    $arResult = [
                        "ID" => $arRegion["ID"],
                        "IBLOCK_ID" => $arRegion["IBLOCK_ID"],
                        "CODE" => $arRegion["CODE"],
                        "NAME" => $arRegion["NAME"],
                        "COORDS" => $arCoords,
                        "REGION_CODE" => $arRegion["REGION_CODE"],
                    ];
                    foreach (\Hair\GeoTemplates::$arRegionNameDeclines as $regionNameDecline) {
                        $arResult[$regionNameDecline] = trim($arRegion[$regionNameDecline]);
                    }
                };
            }
        }
        return $arResult;
    }

    public static function getSubDomainByName(string $subDomain): array
    {
        $arResult = [];
        $subDomain = trim($subDomain);
        if (!empty($subDomain) && Main\Loader::includeModule("iblock")) {
            $entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock(SALONS);
            $rsRegion = $entity::getList([
                "filter" => [
                    'IBLOCK_ID' => SALONS,
                    '=NAME' => $subDomain,
                    'ACTIVE' => 'Y',
                    '!UF_SUBDOMAIN' => false
                ]
            ]);
            if ($arRegion = $rsRegion->fetch()) {
                $arResult = [
                    "ID" => $arRegion["ID"],
                    "IBLOCK_ID" => $arRegion["IBLOCK_ID"],
                    "CODE" => $arRegion["CODE"],
                    "NAME" => $arRegion["NAME"],
                ];
            };
        }
        return $arResult;
    }

    public static function getRootDomain(): string
    {
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $rootDomain = trim(preg_replace('/^(.*)(hair\.(ru|local))/i', "$2", $request->getHttpHost()));
        return $rootDomain;
    }
}

// 41593 - ТЗ функционала замены заголовков для геолокации
class GeoTemplates
{
    public static $arRegionNameDeclines = [
        "REGION_NAME_DECLINE_RP",
        "REGION_NAME_DECLINE_PP",
        "REGION_NAME_DECLINE_TP",
    ];

    public static function replaceTemplates(&$html)
    {
        $adminSection = (defined('ADMIN_SECTION') && ADMIN_SECTION === true);
        if (!$adminSection) {
            $subDomain = \Hair\Geo::getCurrentSubDomain();
            if (!empty($subDomain)) {
                $html = str_replace('#REGION_NAME#', $subDomain["NAME"], $html);
                foreach (self::$arRegionNameDeclines as $regionNameDecline) {
                    $html = str_replace('#' . $regionNameDecline . '#', $subDomain[$regionNameDecline], $html);
                }
            } else {
                $html = str_replace('#REGION_NAME#', '', $html);
                foreach (self::$arRegionNameDeclines as $regionNameDecline) {
                    $html = str_replace('#' . $regionNameDecline . '#', '', $html);
                }
            }
        }
        return true;
    }
}
