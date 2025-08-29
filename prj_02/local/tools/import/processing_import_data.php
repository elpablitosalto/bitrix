<?
// Обработка импортированных данных

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
//$APPLICATION->IncludeModule('iblock');
//CMain::IncludeModule('iblock');
\Bitrix\Main\Loader::includeModule('iblock');


if (!$USER->IsAdmin()) {
    die("Нет прав доступа к файлу");
}

// Обработка новостей -->
$arParams = array(
    //"IBLOCK_CODE" => "news",
    "IBLOCK_CODE" => "materials",
);
ProcessNews::process($arParams);
// <--

class ProcessNews
{
    static public function process($arParams)
    {
        if (strlen($arParams["IBLOCK_CODE"]) <= 0) {
            return;
        }

        // -->
        $bFind = false;
        //$arSelect = array("ID", "NAME", "CODE", "IBLOCK_ID", "DETAIL_TEXT");
        $arSelect = false;
        $arFilter = array(
            "IBLOCK_CODE" => $arParams["IBLOCK_CODE"],
            "!PROPERTY_PROCESS" => "Y",
            //"ID" => 18697,
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 1000), $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arFields["PROPERTIES"] = $ob->GetProperties();

            $arAttMediafiles = $arFields["PROPERTIES"]["ATT_MEDIAFILES"]["VALUE"];

            // поиск конструкции [gallery link="file" ids="24176,24177,24178,24179,24180"] -->
            if (strlen($arFields["~DETAIL_TEXT"]) > 0) {
                $pattern = '/\[gallery link="file" ids="(.+)"\]/';
                preg_match($pattern, $arFields["~DETAIL_TEXT"], $matches);
                //vardump($matches);
                if (strlen($matches[1]) > 0) {
                    $ar_match = explode(",", $matches[1]);
                    //vardump($ar_match);

                    // Прикреплённые медиафайлы -->
                    CIBlockElement::SetPropertyValuesEx(
                        $arFields["ID"],
                        $arFields["IBLOCK_ID"],
                        array("ATT_MEDIAFILES" => $ar_match)
                    );
                    $arAttMediafiles = $ar_match;
                    // <--

                    // Удалим из детального текста конструкцию -->
                    $new_detail_text = str_replace($matches[0], "", $arFields["~DETAIL_TEXT"]);
                    if (strlen($new_detail_text) > 0) {
                        $el = new CIBlockElement;
                        $arLoadProductArray = array(
                            "DETAIL_TEXT"    => $new_detail_text,
                            "DETAIL_TEXT_TYPE"    => "html",
                        );
                        $result = $el->Update($arFields["ID"], $arLoadProductArray);
                    }
                    // <--
                } else {
                    /*
                    $el = new CIBlockElement;
                    $arLoadProductArray = array(
                        "DETAIL_TEXT_TYPE"    => "html",
                    );
                    $result = $el->Update($arFields["ID"], $arLoadProductArray);
                    */
                }
            }
            // <-- 

            // Детальная и картинки слайдера -->
            //vardump($arAttMediafiles);
            //die();
            if (!empty($arAttMediafiles)) {
                $ar_slides_ids = array();
                $detail_att_id = false;
                $i = 0;
                foreach ($arAttMediafiles as $attach_id) {
                    $i++;
                    if ($i > 1) {
                        $ar_slides_ids[] = $attach_id;
                    } else if ($i == 1) {
                        $detail_att_id = $attach_id;
                    }
                }

                // Детальная картинка -->
                if (intval($detail_att_id) > 0) {
                    $ar_params = array(
                        "DETAIL_ATT_ID" => $detail_att_id,
                        "ELEMENT_ID" => $arFields["ID"],
                    );
                    //vardump($ar_params);
                    //die();
                    ProcessNews::CreateDetailPicture($ar_params);
                }
                // <-- Детальная картинка

                // Картинки слайдера -->
                if (!empty($ar_slides_ids)) {
                    $ar_result = ProcessNews::CreateConstructorElementSlidesPhoto(array(
                        "MEDIA_FILES_IDS" => $ar_slides_ids,
                        "ELEMENT_ID" => $arFields["ID"],
                        "ELEMENT_NAME" => $arFields["NAME"],
                        "ELEMENT_CODE" => $arFields["CODE"],
                    ));
                    if (intval($ar_result["CONSTR_SECTION_ID"]) > 0) {
                        CIBlockElement::SetPropertyValuesEx(
                            $arFields["ID"],
                            $arFields["IBLOCK_ID"],
                            array("CONSTRUCTOR" => $ar_result["CONSTR_SECTION_ID"])
                        );
                        //die();
                    }
                }
                // <-- Картинки слайдера
            }
            // <-- Детальная и картинки слайдера

            // Дата публикации -->
            $POST_DATE = $arFields["PROPERTIES"]["POST_DATE"]["VALUE"];
            $PUBLIC_DATE = $arFields["PROPERTIES"]["PUBLIC_DATE"]["VALUE"];
            echo "POST_DATE = " . $POST_DATE . "<br />";
            echo "PUBLIC_DATE = " . $PUBLIC_DATE . "<br />";
            //if (strlen($POST_DATE) > 0 && MakeTimeStamp($POST_DATE) != MakeTimeStamp($PUBLIC_DATE)) {
            if (strlen($POST_DATE) > 0 && $POST_DATE != $PUBLIC_DATE) {
                $PUBLIC_DATE = FormatDate(
                    //CSite::GetDateFormat("SHORT"),
                    //"Y-m-d",
                    "d.m.Y",
                    //MakeTimeStamp($POST_DATE)
                    strtotime($POST_DATE)
                );

                echo "POST_DATE = " . $POST_DATE . "<br />";
                echo "PUBLIC_DATE = " . $PUBLIC_DATE . "<br /><br />";

                if (strlen($PUBLIC_DATE) > 0) {
                    // Начало активности -->
                    $el = new CIBlockElement;
                    $arLoadProductArray = array(
                        "ACTIVE_FROM"    => $PUBLIC_DATE,
                    );
                    $result = $el->Update($arFields["ID"], $arLoadProductArray);
                    // <-- Начало активности

                    // Дата публикации -->
                    CIBlockElement::SetPropertyValuesEx(
                        $arFields["ID"],
                        $arFields["IBLOCK_ID"],
                        array("PUBLIC_DATE" => $PUBLIC_DATE)
                    );
                    // <--
                }
            }
            // <-- Дата публикации

            // Элемент обработан, Y/N (заполняется автоматом) -->
            CIBlockElement::SetPropertyValuesEx(
                $arFields["ID"],
                $arFields["IBLOCK_ID"],
                array("PROCESS" => "Y")
            );
            // <--

            $bFind = true;
        }
        // <--

        // Обнулим свойство PROCESS у всех элементов -->
        if ($bFind == false) {
            $arSelect = array("ID", "IBLOCK_ID");
            $arFilter = array(
                "IBLOCK_CODE" => $arParams["IBLOCK_CODE"],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();

                CIBlockElement::SetPropertyValuesEx(
                    $arFields["ID"],
                    $arFields["IBLOCK_ID"],
                    array("PROCESS" => "")
                );
            }

            echo "Finish";
        }
        // <--
    }

    static public function CreateDetailPicture($arParams)
    {
        if (intval($arParams["DETAIL_ATT_ID"]) > 0 && intval($arParams["ELEMENT_ID"]) > 0) {
            $arSelect = array("ID", "NAME", "CODE", "IBLOCK_ID", "PROPERTY_attachment_url");
            $arFilter = array(
                "IBLOCK_CODE" => "mediafiles_import_wp",
                "XML_ID" => $arParams["DETAIL_ATT_ID"],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                //vardump($arFields);
                //die();

                if (strlen($arFields["PROPERTY_ATTACHMENT_URL_VALUE"]) > 0) {
                    $arFile = CFile::MakeFileArray($arFields["PROPERTY_ATTACHMENT_URL_VALUE"]);

                    $el = new CIBlockElement;
                    $arLoadProductArray = array(
                        "DETAIL_PICTURE"    => $arFile,
                        "PREVIEW_PICTURE"    => $arFile,
                    );
                    $result = $el->Update($arParams["ELEMENT_ID"], $arLoadProductArray);

                    //vardump($arFile);
                    //die($arParams["ELEMENT_ID"]);
                }
            }
        }
    }
    static public function CreateConstructorElementSlidesPhoto($arParams)
    {
        $arResult = array();

        if (
            !empty($arParams["MEDIA_FILES_IDS"])
            && intval($arParams["ELEMENT_ID"]) > 0
            && strlen($arParams["ELEMENT_NAME"]) > 0
        ) {
            $arFiles = array();
            $arSelect = array("ID", "NAME", "CODE", "IBLOCK_ID", "PROPERTY_attachment_url");
            $arFilter = array(
                "IBLOCK_CODE" => "mediafiles_import_wp",
                "XML_ID" => $arParams["MEDIA_FILES_IDS"],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();

                if (strlen($arFields["PROPERTY_ATTACHMENT_URL_VALUE"]) > 0) {
                    $arFile = CFile::MakeFileArray($arFields["PROPERTY_ATTACHMENT_URL_VALUE"]);
                    $arFiles[] = $arFile;

                    //vardump($arFile);
                    //die($arParams["ELEMENT_ID"]);
                }
            }

            if (!empty($arFiles)) {
                $section_name = htmlspecialchars_decode($arParams["ELEMENT_NAME"] . " (" . $arParams["ELEMENT_ID"] . ")");
                $ar_result = ProcessNews::GetConstructorSection(
                    array(
                        "SECTION_NAME" => $section_name
                    )
                );
                if (intval($ar_result["SECTION_ID"]) > 0) {
                    $ar_result_2 = ProcessNews::GetSliderConstructBlockId();
                    if (intval($ar_result_2["BLOCK_ID"]) > 0) {
                        $ar_result_3 = ProcessNews::CreateBlockSlider(array(
                            "BLOCK_ID" => $ar_result_2["BLOCK_ID"],
                            "SECTION_ID" => $ar_result["SECTION_ID"],
                        ));
                        if (intval($ar_result_3["ELEMENT_BLOCK_ID"]) > 0) {
                            CIBlockElement::SetPropertyValuesEx(
                                $ar_result_3["ELEMENT_BLOCK_ID"],
                                false,
                                array("NO_3_IMAGES" => $arFiles)
                            );
                            $arResult["CONSTR_SECTION_ID"] = $ar_result["SECTION_ID"];
                        }
                    }
                }
            }
        }

        return $arResult;
    }

    static public function CreateConstructorSection($arParams)
    {
        $arResult = array();

        if (strlen($arParams["SECTION_NAME"]) > 0) {
            $bs = new CIBlockSection;
            $arFields = array(
                "ACTIVE" => "Y",
                "IBLOCK_SECTION_ID" => false,
                "IBLOCK_ID" => Indexis::getIblockId("pages"),
                "NAME" => $arParams["SECTION_NAME"],
                "SORT" => "500",
            );
            $arResult["SECTION_ID"] = $bs->Add($arFields);
        }

        return $arResult;
    }

    static public function GetConstructorSection($arParams)
    {
        $arResult = array();

        if (strlen($arParams["SECTION_NAME"]) > 0) {

            $arFilter = array('IBLOCK_CODE' => "pages", "NAME" => $arParams["SECTION_NAME"]);
            $rsSections = CIBlockSection::GetList(array('LEFT_MARGIN' => 'ASC'), $arFilter);
            if ($arSection = $rsSections->Fetch()) {
                $arResult["SECTION_ID"] = $arSection["ID"];
            } else {
                $ar_result = ProcessNews::CreateConstructorSection(array("SECTION_NAME" => $arParams["SECTION_NAME"]));
                $arResult["SECTION_ID"] = $ar_result["SECTION_ID"];
            }
        }

        return $arResult;
    }


    static public function CreateBlockSlider($arParams = array())
    {
        $arResult = array();

        if (intval($arParams["BLOCK_ID"]) > 0 && intval($arParams["SECTION_ID"]) > 0) {
            $arSelect = array("ID");
            $arFilter = array(
                "IBLOCK_CODE" => "pages",
                "SECTION_ID" => $arParams["SECTION_ID"],
                "PROPERTY_BLOCK_ID" => $arParams["BLOCK_ID"],
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();

                $arResult["ELEMENT_BLOCK_ID"] = $arFields["ID"];
            } else {
                $el = new CIBlockElement;
                $PROPERTY_VALUES["BLOCK_ID"] = $arParams["BLOCK_ID"];
                $arLoadProductArray = array(
                    "IBLOCK_SECTION_ID" => $arParams["SECTION_ID"],          // элемент лежит в корне раздела  
                    "IBLOCK_ID"      => Indexis::getIblockId("pages"),
                    "NAME"           => "Карусель фотографий",
                    "ACTIVE"         => "Y",
                    "PROPERTY_VALUES" => $PROPERTY_VALUES,        // активен  
                );
                $arResult["ELEMENT_BLOCK_ID"] = $el->Add($arLoadProductArray);
            }
        }

        return $arResult;
    }

    static public function GetSliderConstructBlockId($arParams = array())
    {
        $arResult = array();

        $arSelect = array("ID");
        $arFilter = array(
            "IBLOCK_CODE" => "blocks",
            "CODE" => "no_3",
        );
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();

            $arResult["BLOCK_ID"] = $arFields["ID"];
        }

        return $arResult;
    }
}

require_once($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/include/epilog_after.php");
