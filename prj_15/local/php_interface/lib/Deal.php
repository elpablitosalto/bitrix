<?

use Bitrix\Main\Loader;

class Deal
{
    protected $iblockId;
    protected $el;
    protected $arEntityTypeList;

    public function __construct()
    {
        Loader::includeModule('iblock');
        $this->iblockId = Indexis::getIblockId('deals', 'service');
        $this->el = new CIBlockElement;
        $this->arEntityTypeList = $this->getEntityTypeList();
    }

    
    public function createUserIfNotExist($userIdInGetCourse, $userEmail, $userName)
    {
        $arFilter = array(
            array(
                "LOGIC" => "OR",
                array(
                    "=EMAIL" => $userEmail
                ),
                array(
                    "=UF_GETCOURSE_ID" => $userIdInGetCourse
                )
            )
        );

        $res = Bitrix\Main\UserTable::getList(array(
            "select" => array("ID"),
            "filter" => $arFilter,
        ));

        if ($arUser = $res->fetch()) {
            return $arUser['ID'];
        } else {
            $password = randString(10);
            return (new CUser)->Add([
                'NAME' => $userName,
                'EMAIL' => $userEmail,
                'LOGIN' => $userEmail,
                'PASSWORD' => $password,
                'CONFIRM_PASSWORD' => $password,
                'UF_GETCOURSE_ID' => $userIdInGetCourse
            ]);
        }
    }

    public function getList($arOrder = array("ID" => "DESC"), $arFilter = array(), $arGroupBy = false, $arNavStartParams = false, $arSelectFields = array())
    {
        $arFilter['IBLOCK_ID'] = $this->iblockId;

        return CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            $arGroupBy,
            $arNavStartParams,
            $arSelectFields
        );
    }

    protected function getEntityTypeList()
    {
        $arEntityTypeList = [];

        $propertyEnums = CIBlockPropertyEnum::GetList(
            ["DEF" => "DESC", "SORT" => "ASC"],
            ["IBLOCK_ID" => $this->iblockId, "CODE" => "TYPE"]
        );

        while ($enumField = $propertyEnums->GetNext()) {
            $arEntityTypeList[$enumField["XML_ID"]] = $enumField["ID"];
        }

        return $arEntityTypeList;
    }

    public function getEntityIdByCode($code)
    {
        return (isset($this->arEntityTypeList[$code]) ? $this->arEntityTypeList[$code] : '');
    }

    public function add($gcDealId, $title, $userId, $dateActiveFrom)
    {
        $arEntity = $this->getEntityByTitle($title);

        $period = (isset($arEntity['PERIOD'])) ? $arEntity['PERIOD'] : '+6 months';
        $dateActiveTo = date('d.m.Y H:i:s', strtotime($period, strtotime($dateActiveFrom)));

        return $this->el->Add([
            'NAME' => $title,
            'PROPERTY_VALUES' => [
                'USER_ID' => $userId,
                'DATE_ACTIVE_TO' => $dateActiveTo,
                'ORDER_ID' => $gcDealId,
                'ENTITY_ID' => (isset($arEntity['ID']) ? $arEntity['ID'] : false),
                'TYPE' => (isset($this->arEntityTypeList[$arEntity['IBLOCK_CODE']]) ? $this->arEntityTypeList[$arEntity['IBLOCK_CODE']] : false)
            ],
            'IBLOCK_ID' => $this->iblockId,
            'DATE_ACTIVE_FROM' => $dateActiveFrom
        ]);
    }

    public function getEntityByTitle($title)
    {
        //echo 'title = ' . $title . '<br />';

        $title = trim($title);
        if (mb_strlen($title) == 0)
            return [];

        //echo 'title 2 = ' . $title . '<br />';

        foreach (['courses', 'webinars'] as $entityCode) {
            $res = CIBlockElement::GetList(['SORT' => 'DESC', 'ID' => 'DESC'], [
                'IBLOCK_ID' => Indexis::getIblockId($entityCode, 'content'),
                'ACTIVE_DATE' => 'Y',
                'ACTIVE' => 'Y',
                '=PROPERTY_GC_NAME' => $title,
            ], false, ['nPageSize' => 1], [
                'ID',
                'IBLOCK_CODE',
                'IBLOCK_ID',
            ]);

            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();

                $arResult = [111];

                //vardump($arProps['GC_NAME']);

                if (is_array($arProps['GC_NAME']['~VALUE'])) {
                    foreach ($arProps['GC_NAME']['~VALUE'] as $index => $name) {
                        if (toLower(trim($name)) == toLower($title)) {
                            $arResult = [
                                'ID' => $arFields['ID'],
                                'IBLOCK_CODE' => $arFields['IBLOCK_CODE'],
                                'PERIOD' => (isset($arProps['GC_PERIOD']['VALUE_XML_ID'][$index]) ? '+' . str_replace('_', ' ', $arProps['GC_PERIOD']['VALUE_XML_ID'][$index]) : '+6 months')
                            ];
                        }
                    }
                }

                return $arResult;
            }
        }

        return [];
    }

    public function getMyOrderList($code)
    {
        global $USER;

        /*
        use \Bitrix\Main\Data\Cache;
        $cache = Cache::createInstance();
        $cachePath = 'filter_theme';
        $cacheTtl = 60 * 60 * 24;
        $cacheKey = 'filter_theme';
        $taggedCache = Application::getInstance()->getTaggedCache(); // Служба пометки кеша тегами
        */
        
        $result = [];

        $filter = [
            'PROPERTY_USER_ID' => $USER->GetID(),
            'ACTIVE' => 'Y',
            'DATE_ACTIVE' => 'Y',
            'PROPERTY_TYPE' => $this->getEntityIdByCode($code),
            '!PROPERTY_ENTITY_ID' => false
        ];

        $res = $this->getList(
            ['ID' => 'DESC'],
            $filter,
            false,
            false,
            [
                'ID',
                'NAME',
                'PROPERTY_ENTITY_ID'
            ]
        );

        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $result[$arFields['PROPERTY_ENTITY_ID_VALUE']] = $arFields;
        }

        return $result;
    }
}
