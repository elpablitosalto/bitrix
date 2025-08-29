<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");

use Hair\Personal;

global $USER;

$el = new CIBlockElement;

$arProps = array();
$arProps['PRODUCTS'] = [];
$arProps['USER'] = $USER->GetID();

foreach($_POST['products'] as $id => $cnt):
    if($cnt == 0) continue;
    $arValues[] = [
        "VALUE" => $id,
        "DESCRIPTION" => $cnt
    ];
endforeach;

if(!empty($arValues)):   

    $arProps['PRODUCTS'] = $arValues;

    $arLoadProductArray = Array(
        "MODIFIED_BY"    => $USER->GetID(),
        "IBLOCK_ID"      => ORDERS,
        "PROPERTY_VALUES"=> $arProps,
        "NAME"           => $USER->GetFullName(),
        "ACTIVE"         => "N"            // активен
    );

    if($id = $el->Add($arLoadProductArray)):
        $arResult['STATUS'] = 'SUCCESS';
        $arResult['RESULT'] = $id;
        $arResult['MESSAGE'] = '<p>Мы получили ваш заказ. </p><p>В ближайшее время наши специалисты займутся им.</p>';
    else:
        $arResult['STATUS'] = 'ERROR';
        $arResult['RESULT'] = 'N';
        $arResult['MESSAGE'] = '<p>Что-то пошло не так :(</p><p>Попробуйте перезагрузить страницу и попробовать снова.</p>';
    endif;

else:
    $arResult['STATUS'] = 'ERROR';
    $arResult['RESULT'] = 'N';
    $arResult['MESSAGE'] = '<p>Вы не выбрали ни одного товара для заказа</p>';
endif;

echo json_encode($arResult);