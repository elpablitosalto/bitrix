<?
if(empty($_SERVER["DOCUMENT_ROOT"])) {
    $_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)) . "/../../";
}

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define("BX_CRONTAB", true);
define('BX_NO_ACCELERATOR_RESET', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Context,
    Bitrix\Main\Type\DateTime,
    Bitrix\Main\Loader,
    Bitrix\Iblock;

define("ARTICLES_IBLOCK_ID", 4);
define("AUTHORS_IBLOCK_ID", 5);
define("EDITORS_IBLOCK_ID", 6);
$arSite = \CSite::GetByID(SITE_ID)->Fetch();

function getEnumPropertyValue($propertyCode, $value)
{
    $arResult = [];
    if(!empty($propertyCode)){
        $rsProperty = \Bitrix\Iblock\PropertyTable::getList([
            "filter" => [
                "IBLOCK_ID" => ARTICLES_IBLOCK_ID,
                "CODE" => $propertyCode
            ]
        ]);
        if($arProperty = $rsProperty->fetch()){
            $rsValue = \Bitrix\Iblock\PropertyEnumerationTable::getList([
                "filter" => [
                    "PROPERTY_ID" => $arProperty["ID"],
                    "=VALUE" => $value,
                ]
            ]);
            if($arValue = $rsValue->fetch()){
                $arResult = $arValue;
            }
        }
    }
    return $arResult;
}
function writeLog($data){
    $delimeter = "\n-------------------------------\n";
    $logDirectory = new \Bitrix\Main\IO\Directory(\Bitrix\Main\Application::getDocumentRoot() . "/local/gazeta_parcer/logs");
    if(!$logDirectory->isExists()){
        $logDirectory->create();
    }
    $file = new \Bitrix\Main\IO\File(
        $logDirectory->getPath() . "/" .
        (new \Bitrix\Main\Type\DateTime())->format("d_m_y__"). "import.log"
    );
    $file->open("a+");
    if(!$file->isWritable()){
        $file->markWritable();
    }
    $fileContent = (new \Bitrix\Main\Type\DateTime())->format("d.m.y H:i:s\t") . print_r($data, true);
    $file->putContents($fileContent.$delimeter, \Bitrix\Main\IO\File::APPEND);
    $file->close();

    return true;
}


global $DB;
$ts = microtime(true);
writeLog("======= Начало =======");
if(Loader::includeModule('iblock')) {
    $arPosts = [];
    $dbh = new PDO('mysql:host=localhost;dbname=noboring_finance_old_wp', 'root', '');
    $posts = $dbh->query("
        SELECT *
        FROM wp_posts
        WHERE 
        post_status = 'publish' AND 
        post_parent = 0 AND 
        post_type = 'post' AND 
        guid LIKE '%/?p=%'
        ORDER BY ID DESC;
    ");
    while ($arPost = $posts->fetch(PDO::FETCH_ASSOC)) {
        if (!empty($arPost)) {
            $postMeta = [];
            $meta = $dbh->query("
                SELECT wp_postmeta.*, guid, post_name, post_title, ID FROM wp_postmeta 
                LEFT OUTER JOIN wp_posts ON wp_posts.ID = meta_value AND post_type = 'attachment' AND meta_key != 'views'
                WHERE post_id = '{$arPost["ID"]}' AND meta_key NOT LIKE '\_%'
            ");
            while ($metaRow = $meta->fetch(PDO::FETCH_ASSOC)) {
                if(!empty($metaRow["guid"])){
                    $metaRow["meta_value"] = $metaRow["guid"];
                }
                $postMeta[$metaRow["meta_key"]] = $metaRow["meta_value"];
            }
            //
            $arPost["category"] = $arPost["tags"] = [];
            $taxonomy = $dbh->query("
                SELECT * FROM wp_term_relationships rel
                INNER JOIN wp_term_taxonomy tx ON tx.term_taxonomy_id = rel.term_taxonomy_id
                INNER JOIN wp_terms t ON t.term_id = rel.term_taxonomy_id
                WHERE rel.object_id = '{$arPost["ID"]}';
            ");
            while ($taxonomyRow = $taxonomy->fetch(PDO::FETCH_ASSOC)) {
                if($taxonomyRow["taxonomy"] == "category"){
                    $arTaxMeta = [];
                    $taxMeta = $dbh->query("
                        SELECT * FROM wp_termmeta
                        WHERE term_id = '{$taxonomyRow["term_taxonomy_id"]}' AND meta_key NOT LIKE '\_%'
                    ");
                    while ($taxMetaRow = $taxMeta->fetch(PDO::FETCH_ASSOC)) {
                        $arTaxMeta[$taxMetaRow["meta_key"]] = $taxMetaRow["meta_value"];
                    }
                    $arPost["category"] = [
                        "id" => $taxonomyRow["term_taxonomy_id"],
                        "code" => $taxonomyRow["slug"],
                        "name" => $taxonomyRow["name"],
                        "meta" => $arTaxMeta
                    ];
                }elseif ($taxonomyRow["taxonomy"] == "post_tag") {
                    $arPost["tags"][] = [
                        "id" => $taxonomyRow["term_taxonomy_id"],
                        "code" => $taxonomyRow["slug"],
                        "name" => $taxonomyRow["name"]
                    ];
                }
            }
            //
            $postSeo = [
                'title' => "",
                'description' => ""
            ];
            $seo = $dbh->query("
                SELECT * FROM wp_aioseo_posts 
                WHERE post_id = '{$arPost["ID"]}';
            ");
            if ($seoRow = $seo->fetch(PDO::FETCH_ASSOC)) {
                $postSeo = [
                    'title' => str_replace('#site_title', $arSite["NAME"], $seoRow['title']),
                    'description' => $seoRow['description']
                ];
            }
            //
            $arPosts[] = [
                "id" => $arPost["ID"],
                "title" => strip_tags($arPost["post_title"]),
                "code" => $arPost["post_name"],
                "desc" => $arPost["post_excerpt"],
                "content" => str_replace('https://noboring-finance.ru/', '/', $arPost["post_content"]),
                "date" => $arPost["post_date"],
                "meta" => $postMeta,
                "category" => $arPost["category"],
                "tags" => $arPost["tags"],
                "seo" => $postSeo,
            ];
        }
    }
    //
    if(!empty($arPosts)){
        $obElement = new \CIBlockElement();
        // ***** Получаем текущие значения
        // текущие разделы
        $arSections = [];
        $rsSections = \CIBlockSection::GetList();
        while ($section = $rsSections->Fetch()){
            $arSections[$section["CODE"]] = $section["ID"];
        }
        // текущие авторы
        $arAuthors = [];
        $rsAuthors = \CIBlockElement::GetList([], ["IBLOCK_ID" => AUTHORS_IBLOCK_ID]);
        while ($author = $rsAuthors->Fetch()){
            $arAuthors[$author["NAME"]] = $author["ID"];
        }
        // текущие редакторы
        $arEditors = [];
        $rsEditors = \CIBlockElement::GetList([], ["IBLOCK_ID" => EDITORS_IBLOCK_ID]);
        while ($editor = $rsEditors->Fetch()){
            $arEditors[$editor["NAME"]] = $editor["ID"];
        }
        // текущие статьи
        $arElements = [];
        $rsElements = \CIBlockElement::GetList(
            [],
            [
                "IBLOCK_ID" => ARTICLES_IBLOCK_ID,
                "!PROPERTY_OLD_SITE_ID" => false
            ],
            false,
            false,
            [
                "ID",
                "NAME",
                "PROPERTY_OLD_SITE_ID"
            ]
        );
        while ($element = $rsElements->GetNext()){
            $arElements[$element["PROPERTY_OLD_SITE_ID_VALUE"]] = $element["ID"];
        }
        // ***** Получаем текущие значения END
        foreach ($arPosts as $post){
            if(in_array($post["id"], array_keys($arElements))){
                $elementId = $arElements[$post["id"]];
                $rsElement = Iblock\ElementTable::getById(intval($elementId));
                if($arElement = $rsElement->fetch()) {
                    writeLog("Статья {$arElement["NAME"]} [{$arElement["ID"]}] - пропущена (уже существует).");
                }
                // TODO: можно обновить
            }else{
                // авторы
                if(!empty($post["meta"]["authors"])){
                    $arPostAuthors = [];
                    $postEditor = 0;
                    for($index = 0; $index < intval($post["meta"]["authors"]); $index++){
                        if(!empty($post["meta"]["authors_{$index}_name"])){
                            // редакторы
                            if(
                                !empty(trim($post["meta"]["authors_{$index}_about"])) &&
                                (
                                    strstr(trim($post["meta"]["authors_{$index}_about"]), "редактор") !== false ||
                                    strstr(trim($post["meta"]["authors_{$index}_about"]), "редкатор") !== false ||
                                    strstr(trim($post["meta"]["authors_{$index}_about"]), "рекдатор") !== false
                                )
                            ){
                                if(!empty($arEditors[$post["meta"]["authors_{$index}_name"]])){
                                    $postEditor = intval($arEditors[$post["meta"]["authors_{$index}_name"]]);
                                }else {
                                    $postEditor = $obElement->Add([
                                        "IBLOCK_SECTION_ID" => false,
                                        "IBLOCK_ID" => EDITORS_IBLOCK_ID,
                                        "ACTIVE" => "Y",
                                        "NAME" => trim($post["meta"]["authors_{$index}_name"]),
                                        "CODE" => \CUtil::translit(
                                            trim($post["meta"]["authors_{$index}_name"]),
                                            LANGUAGE_ID,
                                            array("max_len" => 255, "replace_other" => "-", "replace_space" => '-')
                                        ),
                                        "PREVIEW_TEXT" => trim($post["meta"]["authors_{$index}_about"]),
                                        "DETAIL_PICTURE" => !empty($post["meta"]["authors_{$index}_photo"]) ? \CFile::MakeFileArray($post["meta"]["authors_{$index}_photo"]) : false,
                                    ]);
                                    $arEditors[$post["meta"]["authors_{$index}_name"]] = $postEditor;
                                    writeLog("Редактор ".trim($post["meta"]["authors_{$index}_name"])." [$postEditor] - добавлен.");
                                }
                            }else {
                                // авторы
                                if(!empty($arAuthors[$post["meta"]["authors_{$index}_name"]])){
                                    $arPostAuthors[] =  intval($arAuthors[$post["meta"]["authors_{$index}_name"]]);
                                }else {
                                     $authorId = $obElement->Add([
                                        "IBLOCK_SECTION_ID" => false,
                                        "IBLOCK_ID" => AUTHORS_IBLOCK_ID,
                                        "ACTIVE" => "Y",
                                        "NAME" => trim($post["meta"]["authors_{$index}_name"]),
                                        "CODE" => \CUtil::translit(
                                            trim($post["meta"]["authors_{$index}_name"]),
                                            LANGUAGE_ID,
                                            array("max_len" => 255, "replace_other" => "-", "replace_space" => '-')
                                        ),
                                        "PREVIEW_TEXT" => trim($post["meta"]["authors_{$index}_about"]),
                                        "DETAIL_PICTURE" => !empty($post["meta"]["authors_{$index}_photo"]) ? \CFile::MakeFileArray($post["meta"]["authors_{$index}_photo"]) : false,
                                    ]);
                                    $arPostAuthors[] = $authorId;
                                    $arAuthors[trim($post["meta"]["authors_{$index}_name"])] = $authorId;
                                    writeLog("Автор ".trim($post["meta"]["authors_{$index}_name"])." [$authorId] - добавлен.");
                                }
                            }
                        }
                    }
                }
                // Формируем данные для вставки
                $format = getEnumPropertyValue("FORMAT", $post["meta"]["format"]);
                $arPropertyValues = [
                    "AUTHORS" => $arPostAuthors,
                    "EDITOR" => $postEditor,
                    "FORMAT" => trim($format["ID"]),
                    "VERTICAL_BG" => !empty($post["meta"]["vertical-bg"]) ? \CFile::MakeFileArray($post["meta"]["vertical-bg"]) : false,
                    "HORIZONTAL_BG" => !empty($post["meta"]["horizontal-bg"]) ? \CFile::MakeFileArray($post["meta"]["vertical-bg"]) : false,
                    "POST_IMG" => !empty($post["meta"]["post-img"]) ? \CFile::MakeFileArray($post["meta"]["vertical-bg"]) : false,
                    "POST_IMG_MOB" => !empty($post["meta"]["post-img-mob"]) ? \CFile::MakeFileArray($post["meta"]["vertical-bg"]) : false,
                    "VIEWS" => $post["meta"]["views"],
                    "OLD_SITE_ID" => $post["id"],
                ];
                // Раздел
                $sectionId = false;
                if(!empty($post["category"]["code"]) && !empty($arSections[$post["category"]["code"]])){
                    $sectionId = intval($arSections[$post["category"]["code"]]);
                }
                $arAddProduct = [
                    "IBLOCK_SECTION_ID" => $sectionId,
                    "IBLOCK_ID" => ARTICLES_IBLOCK_ID,
                    "PROPERTY_VALUES" => $arPropertyValues,
                    "ACTIVE" => "Y",
                    "NAME" => $post["title"],
                    "CODE" => $post["code"],
                    "PREVIEW_TEXT" => $post["desc"],
                    "DETAIL_TEXT"  => $post["content"],
                    "DETAIL_TEXT_TYPE" => 'html',
                    "ACTIVE_FROM" => new DateTime($post["date"], 'Y-m-d H:i:s'),
                    "TAGS" => implode(",", array_column($post["tags"], "name"))
                ];
                // SEO
                if(!empty($post["seo"]["title"])){
                    $arAddProduct["IPROPERTY_TEMPLATES"]["ELEMENT_META_TITLE"] = trim($post["seo"]["title"]);
                    //$arAddProduct["IPROPERTY_TEMPLATES"]["ELEMENT_PAGE_TITLE"] = trim($post["title"]);
                }
                if(!empty($post["seo"]["description"])){
                    $arAddProduct["IPROPERTY_TEMPLATES"]["ELEMENT_META_DESCRIPTION"] = trim($post["seo"]["description"]);
                }
                if(!empty($post["tags"])){
                    $arAddProduct["IPROPERTY_TEMPLATES"]["ELEMENT_META_KEYWORDS"] = implode(",", array_column($post["tags"], "name"));
                }
                //
                $addResult = $obElement->Add($arAddProduct);
                if(!$addResult){
                    writeLog(["ОШИБКА ДОБАВЛЕНИЯ ЭЛЕМЕНТА: ".$obElement->LAST_ERROR, $arAddProduct]);
                }else{
                    writeLog("Статья {$post["title"]} [$addResult] - добавлена. Старый ID = {$post["id"]}");
                }
            }
        }
    }
}
writeLog("======= Конец =======");
echo PHP_EOL."COMPLETE: ".count($arPosts)." in ".(microtime(true) - $ts);
\CMain::FinalActions();
exit(200);