<?php

use Bitrix\Sale;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Context;

Loader::includeModule('iblock');

class IndexisEvents
{
    public static function OnEpilogHandler()
    {
        /*
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
            $arSelect = array("ID", "NAME", "DATE_ACTIVE_FROM", 'PREVIEW_PICTURE', 'DETAIL_PICTURE');
            $arFilter = array(
                "IBLOCK_ID" => $request->get('IBLOCK_ID'),
                "ID" => $request->get('ID'),
            );
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arPreviewPicture = CFile::GetFileArray($arFields["PREVIEW_PICTURE"]);
                if (!empty($arPreviewPicture['WIDTH'])) {
                    $picture_resolution_preview = $arPreviewPicture['WIDTH'] . 'x' . $arPreviewPicture['HEIGHT'];
                }

                $arDetailPicture = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
                if (!empty($arDetailPicture['WIDTH'])) {
                    $picture_resolution_detail = $arDetailPicture['WIDTH'] . 'x' . $arDetailPicture['HEIGHT'];
                }

                Asset::getInstance()->addString('<script type="text/javascript" src="/local/templates/kamvek/js/jquery-3.6.3.min.js"></script>');
                Asset::getInstance()->addString('
                    <script>
                    $(document).ready(function () {
                        $(".adm-detail-valign-top").each(function () {
                            var text = $(this).html();
                            if( text == "Картинка для анонса:" )
                            {
                                $(this).html( text + "<br />' . $picture_resolution_preview . '" );
                            } else if( text == "Детальная картинка:" ) {
                                $(this).html( text + "<br />' . $picture_resolution_detail . '" );
                            }
                        });
                    });
                    </script>
                ');
            }
        }
        */
    }
}
