<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");
if(extension_loaded('zip')):
    if(isset($_POST['FILES']) && !empty($_POST['FILES'])):
        
        $files = explode(',',$_POST['FILES']);
        $filesPath = [];

        $obj = CIBlockElement::GetList(false,['IBLOCK_ID' => MATERIALS,'ID' => $files],false,false,['ID','NAME','PROPERTY_FILE']);
        while($res = $obj->GetNext()) {
            $filesPath[] = CFile::GetPath($res['PROPERTY_FILE_VALUE']);
        }
        // проверяем выбранные файлы
        if(!is_dir($_SERVER['DOCUMENT_ROOT'].'/upload/downloads/')){
            mkdir($_SERVER['DOCUMENT_ROOT'].'/upload/downloads/');
        }
        $zip = new ZipArchive(); // подгружаем библиотеку zip
        $zipName = '/upload/downloads/'.time().".zip";
        $zipPath = $_SERVER['DOCUMENT_ROOT'].$zipName; // имя файла

        if($zip->open($zipPath, ZIPARCHIVE::CREATE)!==TRUE):
            $arResult['SUCCESS'] = 'N';
            $arResult['MESSAGE'] = '<p>К сожалению, сейчас невозможно создать архив со скачиваемыми файлами. Попробуйте позднее.</p>';
        endif;

        foreach($filesPath as $file):
            $new_filename = substr($file,strrpos($file,'/') + 1);
            $zip->addFile($_SERVER['DOCUMENT_ROOT'].$file,$new_filename);
        endforeach;
        $zip->close();

        if(file_exists($zipPath)):
            $arResult['SUCCESS'] = 'Y';
            $arResult['MESSAGE'] = $zipName;
        endif;
    else:
        $arResult['MESSAGE'] .= '<p>Вы не выбрали файлы для скачивания</p>';
    endif;
else:
    $arResult['MESSAGE'] .= '<p>На сервере не установлено расширение для работы с архивами. Сообщите об этом администраторам сайта.</p>';
endif;

echo json_encode($arResult);