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

if(!isset($_REQUEST['NAME']) ) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'NAME';
    $arResult['MESSAGE'] = 'Не указано ФИО';
    echo json_encode($arResult);
    die();
}

if(!isset($_REQUEST['PHONE'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'PHONE';
    $arResult['MESSAGE'] = 'Не указан телефон';
    die();
}

if(!isset($_REQUEST['CITY'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'CITY';
    $arResult['MESSAGE'] = 'Не указан город';
    die();
}

if(!isset($_REQUEST['ADDRESS'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'ADDRESS';
    $arResult['MESSAGE'] = 'Не указан адрес';
    die();
}

/*if(!isset($_REQUEST['PACKAGE'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'PACKAGE';
    $arResult['MESSAGE'] = 'Не пакет';
    die();
}*/

if(!isset($_REQUEST['suggestion'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'suggestion';
    echo json_encode($arResult);
    die();
}

$el = new CIBlockElement;

$arProps = array();
$arProps['PHONE'] = $_REQUEST['PHONE'];
$arProps['CITY']  = $_REQUEST['CITY'];
$arProps['ADDRESS'] = $_REQUEST['ADDRESS'];
//$arProps['PACKAGE'] = $_REQUEST['PACKAGE'];

$arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_ID"      => ORDER_REQUEST,
    "PROPERTY_VALUES"=> $arProps,
    "NAME"           => $_REQUEST['NAME'],
    "ACTIVE"         => "Y"
);

$message = Array(
    "NAME"           => $_REQUEST['NAME'],
    "PHONE"          => $_REQUEST['PHONE'],
    "CITY"           => $_REQUEST['CITY'],
    "ADDRESS"        => $_REQUEST['ADDRESS'],
    //"PACKAGE"        => $_REQUEST['PACKAGE'],
    "PAGE_URL"       => $_SERVER['REQUEST_URI'],
);

CEvent::Send("ORDER_REQUEST", "s1", $message, "N", 38, "");

if($id = $el->Add($arLoadProductArray)):
    $arResult['TYPE'] = 'SUCCESS';
    $arResult['RESULT'] = $id;
    $arResult['MESSAGE'] = '<p>Мы получили ваше сообщение. </p><p>В ближайшее время наши специалисты займутся им.</p>';
else:
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'RECAPTCHA';
    $arResult['MESSAGE'] = 'Ошибка при обработке формы! '.$el->LAST_ERROR;
endif;

echo json_encode($arResult);