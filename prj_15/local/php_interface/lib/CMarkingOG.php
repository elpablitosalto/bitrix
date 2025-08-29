<?
class CMarkingOG
{
    public static $site_name = 'Академия «Врач будущего»';
    public static $host = 'https://vrachbudushego.ru';

    public static function show()
    {
        global $APPLICATION;

        //echo 'OG_TITLE = '.$APPLICATION->GetPageProperty("OG_TITLE").'<br />';

        // title -->
        $title = $APPLICATION->GetPageProperty("OG_TITLE");
        // <-- title

        // site_name -->
        //$site_name = self::$site_name;
        $site_name = $APPLICATION->GetPageProperty("OG_SITE_NAME");
        // <-- site_name

        // url -->
        $url = $APPLICATION->GetPageProperty("OG_URL");
        // <-- url

        // description -->
        $description = $APPLICATION->GetPageProperty("OG_DESCRIPTION");
        // <-- description

        // image -->
        $image = $APPLICATION->GetPageProperty("OG_IMAGE");
        // <-- image

        // image:width -->
        $image_width = $APPLICATION->GetPageProperty("OG_IMAGE_WIDTH");
        // <-- image:width

        // image:height -->
        $image_height = $APPLICATION->GetPageProperty("OG_IMAGE_HEIGHT");
        // <-- image:height

?>
        <?/*?>
        <? if (!empty($title)) { ?>
            <meta property="og:title" content="<? echo $title; ?>">
        <? } ?>
        <? if (!empty($site_name)) { ?>
            <meta property="og:site_name" content="<? echo $site_name; ?>">
        <? } ?>
        <? if (!empty($url)) { ?>
            <meta property="og:url" content="<? echo  $url; ?>">
        <? } ?>
        <? if (!empty($description)) { ?>
            <meta property="og:description" content="<? echo $description; ?>">
        <? } ?>
        <? if (!empty($image)) { ?>
            <meta property="og:image" content="<? echo $image; ?>">
        <? } ?>
        <? if (!empty($image_width)) { ?>
            <meta property="og:image:width" content="<? echo $image_width; ?>" />
        <? } ?>
        <? if (!empty($image_height)) { ?>
            <meta property="og:image:height" content="<? echo $image_height; ?>" />
        <? } ?>
        <?*/ ?>
        <?/**/ ?>
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="<? $APPLICATION->ShowProperty("OG_SITE_NAME"); ?>">
        <meta property="og:url" content="<? $APPLICATION->ShowProperty("OG_URL"); ?>">
        <meta property="og:title" content="<? $APPLICATION->ShowProperty("OG_TITLE"); ?>">
        <meta property="og:description" content="<? $APPLICATION->ShowProperty("OG_DESCRIPTION"); ?>">
        <meta name="twitter:card" content="summary_large_image" />
        <meta property="og:image" content="<? $APPLICATION->ShowProperty("OG_IMAGE"); ?>">
        <meta property="og:image:width" content="<? $APPLICATION->ShowProperty("OG_IMAGE_WIDTH"); ?>" />
        <meta property="og:image:height" content="<? $APPLICATION->ShowProperty("OG_IMAGE_HEIGHT"); ?>" />
        <meta name="twitter:image" content="<? $APPLICATION->ShowProperty("OG_IMAGE"); ?>">
        <meta name="vk:image" content="<? $APPLICATION->ShowProperty("OG_IMAGE"); ?>">

        <?/*?>
        <meta property="og:image" content="">
        <meta property="og:image:width" content="400">
        <meta property="og:image:height" content="400">
        <?*/ ?>

        <?/*?>
        <meta name="twitter:card" content="<? $APPLICATION->ShowProperty("OG_IMAGE"); ?>" />
        <?*/ ?>
<?
    }

    public static function setPageProps()
    {
        global $APPLICATION;
        //echo 'OG_DESCRIPTION = '.$GLOBALS['OG']['OG_DESCRIPTION'].'<br />';
        //vardump($GLOBALS['OG']);

        if ($GLOBALS['OG']['SET_OG'] == 'Y') {
            if (!empty($GLOBALS['OG']['OG_TITLE'])) {
                $APPLICATION->SetPageProperty("OG_TITLE", $GLOBALS['OG']['OG_TITLE']);
            }
            if (!empty($GLOBALS['OG']['OG_SITE_NAME'])) {
                $APPLICATION->SetPageProperty("OG_SITE_NAME", $GLOBALS['OG']['OG_SITE_NAME']);
            }
            if (!empty($GLOBALS['OG']['OG_URL'])) {
                $APPLICATION->SetPageProperty("OG_URL", $GLOBALS['OG']['OG_URL']);
            }
            if (!empty($GLOBALS['OG']['OG_DESCRIPTION'])) {
                $APPLICATION->SetPageProperty("OG_DESCRIPTION", $GLOBALS['OG']['OG_DESCRIPTION']);
            }
            if (!empty($GLOBALS['OG']['OG_IMAGE'])) {
                $APPLICATION->SetPageProperty("OG_IMAGE", $GLOBALS['OG']['OG_IMAGE']);
            }
            if (!empty($GLOBALS['OG']['OG_IMAGE_WIDTH'])) {
                $APPLICATION->SetPageProperty("OG_IMAGE_WIDTH", $GLOBALS['OG']['OG_IMAGE_WIDTH']);
            }
            if (!empty($GLOBALS['OG']['OG_IMAGE_HEIGHT'])) {
                $APPLICATION->SetPageProperty("OG_IMAGE_HEIGHT", $GLOBALS['OG']['OG_IMAGE_HEIGHT']);
            }
        }

        //echo 'OG_TITLE = '.$APPLICATION->GetPageProperty("OG_TITLE").'<br />';
    }

    public static function getDataFromIB($arParams = array())
    {
        $arResult = array();

        if (!empty($arParams['ELEMENT_CODE'])) {

            // создаем объект
            $obCache = new CPHPCache;

            // время кеширования, секунды
            $life_time = 60 * 60;

            // формируем идентификатор кеша в зависимости от всех параметров 
            // которые могут повлиять на результирующий HTML
            $cache_id = $arParams['ELEMENT_CODE'];

            // если кэш есть и он ещё не истек то
            if ($obCache->InitCache($life_time, $cache_id, "/opengraph/")) {
                // получаем закешированные переменные
                $vars = $obCache->GetVars();
                $arResult = $vars["arResult"];
            } else {
                // иначе обращаемся к базе
                $IBLOCK_ID = Indexis::getIblockId("openpraph", "service", "s1");
                if (intval($IBLOCK_ID) > 0) {
                    $arSelect = array("ID", "NAME", "CODE", "PREVIEW_TEXT", "PROPERTY_OG_URL", "PREVIEW_PICTURE");
                    $arFilter = array(
                        "IBLOCK_ID" => $IBLOCK_ID,
                        "ACTIVE_DATE" => "Y",
                        "ACTIVE" => "Y",
                        "CODE" => $arParams['ELEMENT_CODE'],
                    );
                    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
                    if ($ob = $res->GetNextElement()) {
                        $arFields = $ob->GetFields();

                        //vardump($arFields);

                        $arFile = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);

                        $arResult = array(
                            'OG_TITLE' => $arFields['NAME'],
                            'OG_URL' => $arFields['PROPERTY_OG_URL_VALUE'],
                            'OG_DESCRIPTION' => $arFields['PREVIEW_TEXT'],
                            'OG_IMAGE' => $arFile['SRC'],
                        );
                    }
                }
            }

            // начинаем буферизирование вывода
            if ($obCache->StartDataCache()) {
                // записываем предварительно буферизированный вывод в файл кэша
                // вместе с дополнительной переменной
                $obCache->EndDataCache(array(
                    "arResult"    => $arResult
                ));
            }
        }

        return $arResult;
    }

    public static function getGlobalData($arParams = array())
    {
        global $APPLICATION;

        $arResult = array();

        //vardump($arParams);

        if (!empty($arParams['ELEMENT_CODE'])) {
            $arResultFunc = CMarkingOG::getDataFromIB(array(
                "ELEMENT_CODE" => $arParams['ELEMENT_CODE']
            ));
            $arResult['OG_TITLE'] = $arResultFunc['OG_TITLE'];
            $arResult['OG_URL'] = $arResultFunc['OG_URL'];
            $arResult['OG_DESCRIPTION'] = $arResultFunc['OG_DESCRIPTION'];
            $arResult['OG_IMAGE'] = $arResultFunc['OG_IMAGE'];
        }

        // Приоритет параметров функции над данными из ИБ -->
        if (!empty($arParams['IMPORTANT'])) {
            // title -->
            if (!empty($arParams['IMPORTANT']['OG_TITLE']) && $arParams['IMPORTANT']['OG_TITLE'] == 'Y') {
                if (!empty($arParams['OG_TITLE'])) {
                    $arResult['OG_TITLE'] = $arParams['OG_TITLE'];
                }
            }
            // <-- title

            // url -->
            if (!empty($arParams['IMPORTANT']['OG_URL']) && $arParams['IMPORTANT']['OG_URL'] == 'Y') {
                if (!empty($arParams['OG_URL'])) {
                    $arResult['OG_URL'] = $arParams['OG_URL'];
                }
            }
            // <-- url

            // description -->
            if (!empty($arParams['IMPORTANT']['OG_DESCRIPTION']) && $arParams['IMPORTANT']['OG_DESCRIPTION'] == 'Y') {
                if (!empty($arParams['OG_DESCRIPTION'])) {
                    $arResult['OG_DESCRIPTION'] = $arParams['OG_DESCRIPTION'];
                }
            }
            // <-- description

            // image -->
            if (!empty($arParams['IMPORTANT']['OG_IMAGE']) && $arParams['IMPORTANT']['OG_IMAGE'] == 'Y') {
                if (!empty($arParams['OG_IMAGE'])) {
                    $arResult['OG_IMAGE'] = $arParams['OG_IMAGE'];
                }
            }
            // <-- image
        }
        // <-- Приоритет параметров функции над данными из ИБ

        // Значения по умолчанию -->
        if (empty($arResult['OG_TITLE'])) {
            if (!empty($arParams['OG_TITLE'])) {
                $arResult['OG_TITLE'] = $arParams['OG_TITLE'];
            } else {
                $arResult['OG_TITLE'] = $APPLICATION->GetTitle(false, true);
            }
        }
        if (empty($arResult['OG_URL'])) {
            if (!empty($arParams['OG_URL'])) {
                $arResult['OG_URL'] = $arParams['OG_URL'];
            } else {
                $arResult['OG_URL'] = $APPLICATION->GetCurUri("", false);
            }
        }
        if (empty($arResult['OG_DESCRIPTION'])) {
            if (!empty($arParams['OG_DESCRIPTION'])) {
                $arResult['OG_DESCRIPTION'] = $arParams['OG_DESCRIPTION'];
            } else {
                $arResult['OG_DESCRIPTION'] = $APPLICATION->GetPageProperty("description");
            }
        }
        if (empty($arResult['OG_IMAGE'])) {
            if (!empty($arParams['OG_IMAGE'])) {
                $arResult['OG_IMAGE'] = $arParams['OG_IMAGE'];
            } else {
                //$arResult['OG_IMAGE'] = '/local/templates/geropharm-main/img/design/logo.svg';
                $arResult['OG_IMAGE'] = '/local/templates/geropharm-main/img/design/doc3.png';
            }
            //$arResult['DEFAULT_OG_IMAGE'] = 'Y';
        }
        // <-- Значения по умолчанию

        // Имя сайта -->
        $arResult['OG_SITE_NAME'] = self::$site_name;
        // <-- Имя сайта

        // Обработка URL -->
        $arResult['OG_URL'] =  self::$host . $arResult['OG_URL'];
        // <-- Обработка URL

        // Обработка изображения -->
        $imgPath = $arResult['OG_IMAGE'];
        $imgPathFull = $_SERVER['DOCUMENT_ROOT'] . $imgPath;
        $arResult['OG_IMAGE'] = self::$host . $arResult['OG_IMAGE'];
        // <-- Обработка изображения

        // Размеры изображения -->
        //echo 'imgPathFull = '.$imgPathFull.'<br />';
        list($width, $height, $type, $attr) = getimagesize($imgPathFull);
        $arResult['OG_IMAGE_WIDTH'] = $width;
        $arResult['OG_IMAGE_HEIGHT'] = $height;
        // <-- Размеры изображения

        // Обработка описания -->
        if (!empty($arResult['OG_DESCRIPTION'])) {
            $arResult['OG_DESCRIPTION'] = strip_tags($arResult['OG_DESCRIPTION']);
            $arResult['OG_DESCRIPTION'] = trim($arResult['OG_DESCRIPTION']);
            $arResult['OG_DESCRIPTION'] = str_replace(array("\r", "\n"), '', $arResult['OG_DESCRIPTION']);

            // Обрезка описания -->
            $TEXT_MAX_LEN = $arParams['TEXT_MAX_LEN'];
            if (intval($TEXT_MAX_LEN) <= 0) {
                $TEXT_MAX_LEN = 500;
            }
            if (mb_strlen($arResult['OG_DESCRIPTION']) > $TEXT_MAX_LEN) {
                $obParser = new CTextParser;
                $arResult['OG_DESCRIPTION'] = $obParser->html_cut($arResult['OG_DESCRIPTION'], $TEXT_MAX_LEN);
            }
            // <-- Обрезка описания
        }
        // <-- Обработка описания

        return $arResult;
    }

    public static function setGlobalData($arParams = array())
    {
        global $APPLICATION;

        $GLOBALS['OG']['SET_OG'] = 'Y';

        $arResult = array();

        if (!empty($arParams['OG_TITLE'])) {
            $GLOBALS['OG']['OG_TITLE'] = $arParams['OG_TITLE'];
        }
        if (!empty($arParams['OG_URL'])) {
            $GLOBALS['OG']['OG_URL'] = $arParams['OG_URL'];
        }
        if (!empty($arParams['OG_DESCRIPTION'])) {
            $GLOBALS['OG']['OG_DESCRIPTION'] = $arParams['OG_DESCRIPTION'];
        }
        if (!empty($arParams['OG_IMAGE'])) {
            $GLOBALS['OG']['OG_IMAGE'] = $arParams['OG_IMAGE'];
        }
        if (!empty($arParams['OG_IMAGE_WIDTH'])) {
            $GLOBALS['OG']['OG_IMAGE_WIDTH'] = $arParams['OG_IMAGE_WIDTH'];
        }
        if (!empty($arParams['OG_IMAGE_HEIGHT'])) {
            $GLOBALS['OG']['OG_IMAGE_HEIGHT'] = $arParams['OG_IMAGE_HEIGHT'];
        }
        if (!empty($arParams['OG_SITE_NAME'])) {
            $GLOBALS['OG']['OG_SITE_NAME'] = $arParams['OG_SITE_NAME'];
        }

        return $arResult;
    }

    public static function getSetGlobalData($arParams = array())
    {

        $arResultFunc = CMarkingOG::getGlobalData(array(
            "ELEMENT_CODE" => $arParams['ELEMENT_CODE'],
            "OG_TITLE" => $arParams['OG_TITLE'],
            "OG_URL" => $arParams['OG_URL'],
            "OG_DESCRIPTION" => $arParams['OG_DESCRIPTION'],
            "OG_IMAGE" => $arParams['OG_IMAGE'],
            "IMPORTANT" => $arParams['IMPORTANT'],
        ));
        //vardump($arResultFunc);
        $arResultFunc = CMarkingOG::setGlobalData(array(
            "OG_TITLE" => $arResultFunc['OG_TITLE'],
            "OG_URL" => $arResultFunc['OG_URL'],
            "OG_DESCRIPTION" => $arResultFunc['OG_DESCRIPTION'],
            "OG_IMAGE" => $arResultFunc['OG_IMAGE'],
            "OG_IMAGE_WIDTH" => $arResultFunc['OG_IMAGE_WIDTH'],
            "OG_IMAGE_HEIGHT" => $arResultFunc['OG_IMAGE_HEIGHT'],
            "OG_SITE_NAME" => $arResultFunc['OG_SITE_NAME'],
        ));

        //vardump($arParams);
        //vardump($GLOBALS['OG']);
    }
}
?>