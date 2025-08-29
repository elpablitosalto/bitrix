<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");
global $USER;

if(!recaptchaCheck()){
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'RECAPTCHA';
    $arResult['MESSAGE'] = 'Ошибка проверки recaptcha!';
    echo json_encode($arResult);
    die();
}

$el = new CIBlockElement;

$arProps = array();
$arProps['QUESTION_FOR'] = $_REQUEST['QUESTION_FOR'];
$arProps['USER'] = $USER->GetID();

$arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_ID"      => DISTRIBUTION_ASK,
    "PROPERTY_VALUES"=> $arProps,
    "NAME"           => $USER->GetFullName(),
    "ACTIVE"         => "Y",            // активен
    "PREVIEW_TEXT"   => $_REQUEST['MESSAGE']
);

if($id = $el->Add($arLoadProductArray)):
    $arResult['STATUS'] = 'Y';
    $arResult['TYPE'] = 'SUCCESS';
    $arResult['RESULT'] = $id;
    $arResult['MESSAGE'] = '<p>Мы получили ваше сообщение. </p><p>В ближайшее время наши специалисты займутся им.</p>';
else:
    $arResult['STATUS'] = 'N';
    $arResult['TYPE'] = 'ERROR';
    $arResult['RESULT'] = $id;
    $arResult['MESSAGE'] = '<p>Что-то пошло не так и мы не получили ваше сообщение.</p><p>Попробуйте перезагрузить страницу и попробовать ещё раз</p>';
endif;

echo json_encode($arResult);