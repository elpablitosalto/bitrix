<?
use \Bitrix\Main\Loader;
use \Bitrix\Iblock;

/**
 * 35705 - сортировка в каталоге
 * Class CatalogSort
 */
class CatalogSort
{
    const USE_AGENT_LOG = false; // false на проде
    private static $toOrderCoefficient = 0.02;
    private static $catalogIblockId = 34;
    private static $catalogSortFieldCode = "CATALOG_SORT_RANKING";
    private static $arSegmentMatrix = [
        "1000"      => ["NAME" => "1000+", "ID" => 10],
        "999_500"   => ["NAME" => "999 - 500", "ID" => 20],
        "499_300"   => ["NAME" => "499-300", "ID" => 30],
        "299_100"   => ["NAME" => "299-100", "ID" => 40],
        "99_50"     => ["NAME" => "99-50", "ID" => 50],
        "49_10"     => ["NAME" => "49-10", "ID" => 60],
        "9_1"       => ["NAME" => "9-1", "ID" => 70],
        "0"         => ["NAME" => "0", "ID" => 80],
    ];
    private static $maxDepthLevel = 5;
    /**
     * Логирование
     * @param $data
     * @param string $fileName
     * @return bool
     * @throws \Bitrix\Main\IO\FileNotFoundException
     * @throws \Bitrix\Main\IO\FileNotOpenedException
     * @throws \Bitrix\Main\IO\FileOpenException
     * @throws \Bitrix\Main\ObjectException
     */
    private static function writeLog($data, string $fileName = ""): bool
    {
        if(self::USE_AGENT_LOG) {
            $delimeter = "\n-------------------------------\n";
            $logDirectory = new \Bitrix\Main\IO\Directory(\Bitrix\Main\Application::getDocumentRoot() . "/logs/" . (new \Bitrix\Main\Type\DateTime())->format("y_m_d"));
            if (!$logDirectory->isExists()) {
                $logDirectory->create();
            }
            $file = new \Bitrix\Main\IO\File(
                $logDirectory->getPath() . "/" .
                (!empty($fileName) ? $fileName : __CLASS__) . ".log"
            );
            $file->open("a+");
            if (!$file->isWritable()) {
                $file->markWritable();
            }
            $fileContent = (new \Bitrix\Main\Type\DateTime())->format("d:m:y H:i:s\t") . print_r($data, true);
            $file->putContents($fileContent . $delimeter, \Bitrix\Main\IO\File::APPEND);
            $file->close();
        }
        return true;
    }

    /**
     * Подключение модулей
     * @return bool
     * @throws \Bitrix\Main\LoaderException
     */
    private static function init() : bool
    {
        if(!Loader::includeModule("iblock")){
            throw new \Exception("Не подключен модуль инфоблоков");
        }
        if(!Loader::includeModule("catalog")){
            throw new \Exception("Не подключен модуль каталога");
        }
        return true;
    }

    /**
     * Поиск нужного раздела для товара (они привязаны к нескольким)
     * @param int $productId
     * @param int $mainSectionId
     * @return int
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    private static function getProductSection(int $productId, int $mainSectionId) : int
    {
        $result = 0;
        if(!empty($productId) && !empty($mainSectionId)) {
            $cache = \Bitrix\Main\Application::getInstance()->getManagedCache();
            $arAvalSections = [];
            $cacheId = md5($mainSectionId);
            if ($cache->read(3600, $cacheId)) {
                $cacheVars = $cache->get($cacheId);
                $arAvalSections = $cacheVars["SECTIONS"];
            }else {
                $rsParentSection = CIBlockSection::GetByID($mainSectionId);
                if ($arParentSection = $rsParentSection->GetNext()) {
                    $arAvalSections[] = $arParentSection["ID"];
                    $arFilter = [
                        'ACTIVE' => "Y",
                        'IBLOCK_ID' => $arParentSection["IBLOCK_ID"],
                        '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
                        '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
                        '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']
                    ];
                    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter);
                    while ($arSect = $rsSect->GetNext()) {
                        $arAvalSections[] = $arSect["ID"];
                    }
                    $cache->set($cacheId, ["SECTIONS" => $arAvalSections]);
                }
            }
            $rsSections = Iblock\SectionElementTable::getList([
                "filter" => [
                    "IBLOCK_SECTION_ID" => !empty($arAvalSections) ? $arAvalSections : false,
                    "IBLOCK_ELEMENT_ID" => $productId
                ],
                "order" => ["IBLOCK_SECTION.DEPTH_LEVEL" => "DESC"]
            ]);
            if ($arSection = $rsSections->fetch()) {
                $result = $arSection["IBLOCK_SECTION_ID"];
            }
        }
        return $result;
    }

    /**
     * Расчет коэффициента для товара с учетом его наличия
     * @param array $arProduct
     * @return array
     */
    private static function getProductCoefficient(array $arProduct) : array
    {
        $orderNum = floatval($arProduct["ORDER"]);
        $avalNum = floatval($arProduct["AVAILABLE"]);
        $coefficientSum = floatval(($orderNum * self::$toOrderCoefficient) + $avalNum);
        // Определяем сегмент
        if($coefficientSum >= 1000){
            $segmentName = "1000";
        }elseif($coefficientSum >= 500 && $coefficientSum < 1000){
            $segmentName = "999_500";
        }elseif($coefficientSum >= 300 && $coefficientSum < 500){
            $segmentName = "499_300";
        }elseif($coefficientSum >= 100 && $coefficientSum < 300){
            $segmentName = "299_100";
        }elseif($coefficientSum >= 50 && $coefficientSum < 100){
            $segmentName = "99_50";
        }elseif($coefficientSum >= 10 && $coefficientSum < 50){
            $segmentName = "49_10";
        }elseif($coefficientSum >= 1 && $coefficientSum < 10){
            $segmentName = "9_1";
        }else{
            $segmentName = "0";
        }
        return [
            "SUM" => $coefficientSum,
            "SEGMENT" => self::$arSegmentMatrix[$segmentName]
        ];
    }

    /**
     * Список категорий с их рангами (сортировка и вложенность)
     * @return array
     */
    public static function getCategoriesRanking() : array
    {
        $arCategories = [];
        $rsCategories = \CIBlockSection::GetList(
            ["DEPTH_LEVEL" => "ASC", "SORT" => "ASC"],
            [
                "ACTIVE" => "Y",
                "IBLOCK_ID" => self::$catalogIblockId
            ]
        );
        while ($category = $rsCategories->Fetch()){
            $arSectionPath = [];
            $rsSectionPath = \CIBlockSection::getNavChain($category['IBLOCK_ID'], $category['ID'], array('ID', 'DEPTH_LEVEL', 'NAME', 'SORT'));
            while ($rootSection = $rsSectionPath->Fetch()){
                $arSectionPath[$rootSection["DEPTH_LEVEL"]] = $rootSection["SORT"];
            }
            $sectionSort = "";
            foreach (range(1, self::$maxDepthLevel) as $depthLevel){
                $sectionSort .= $depthLevel;
                if(!empty($arSectionPath[$depthLevel])){
                    $sectionSort .= $arSectionPath[$depthLevel];
                }else{
                    $sectionSort .= 1;
                }
            }
            $arCategories[$category["ID"]] = $sectionSort;
        }
        return $arCategories;
    }

    /**
     * Список товаров со всех енобходимой информацией для заполнения поля сортировки
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function getProductsData() : array
    {
        $arResult = [];
        $arProducts = Iblock\ElementTable::getList([
            "filter" => [
                "ACTIVE" => "Y",
                "IBLOCK_ID" => self::$catalogIblockId
            ],
            "select" => ["ID", "SORT", "NAME", "IBLOCK_SECTION_ID"],
        ])->fetchAll();
        $arOffers = CCatalogSKU::getOffersList(array_column($arProducts, "ID"), self::$catalogIblockId);
        // основной цикл
        foreach ($arProducts as $product){
            if(!empty($arOffers[$product["ID"]])){
                $product["OFFERS"] = $arOffers[$product["ID"]];
            }
            $availableData = getProductQty($product);
            $elementSection = self::getProductSection($product["ID"], intval($product["IBLOCK_SECTION_ID"]));
            if(!empty($availableData) && is_array($availableData) && !empty($elementSection)) {
                $productData = [
                    "ID" => $product["ID"],
                    "SORT" => $product["SORT"],
                    "NAME" => $product["NAME"],
                    "SECTION_ID" => $elementSection
                ];
                $arResult[$product["ID"]] = array_merge($availableData, $productData);
            }
        }
        return $arResult;
    }

    /**
     * Основной агент для проставления товарам новой сортировки
     * @return string
     * @throws Exception
     */
    public static function agent__setCatalogSortOrder() : string
    {
        if(self::init()){
            self::writeLog("Начало обработки", "agent__setCatalogSortOrder.log");
            $arCategories = self::getCategoriesRanking();
            $arProducts = self::getProductsData();
            self::writeLog("Товары получены. Всего: ".count($arProducts), "agent__setCatalogSortOrder.log");
            foreach ($arProducts as $arProduct){
                $productCoefficient = self::getProductCoefficient($arProduct);
                $newSort = $arCategories[$arProduct["SECTION_ID"]].$productCoefficient["SEGMENT"]["ID"].rand(0, 9);
                // Сохраняем значения
                \CIBlockElement::SetPropertyValuesEx($arProduct["ID"], self::$catalogIblockId, array(self::$catalogSortFieldCode => $newSort));
                // Логируем изменения
                $arProduct["СOEFFICIENT"] = $productCoefficient;
                $arProduct["NEW_SORT"] = $newSort;
                self::writeLog($arProduct, "agent__setCatalogSortOrder.log");
            }
            self::writeLog("Конец обработки", "agent__setCatalogSortOrder.log");
        }
        return "\CatalogSort::agent__setCatalogSortOrder();";
    }
}