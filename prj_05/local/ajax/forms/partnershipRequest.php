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

if(!isset($_REQUEST['ADDRESS'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'ADDRESS';
    $arResult['MESSAGE'] = 'Не указан адрес';
    die();
}

if(!isset($_REQUEST['PACKAGE'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'PACKAGE';
    $arResult['MESSAGE'] = 'Выберите пакет';
    die();
}

if(!isset($_REQUEST['suggestion'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'suggestion';
    echo json_encode($arResult);
    die();
}

$el = new CIBlockElement;
$package = CIBlockElement::GetByID($_REQUEST['PACKAGE'])->getNext();

$arProps = array();
$arProps['PHONE'] = $_REQUEST['PHONE'];
$arProps['ADDRESS'] = $_REQUEST['ADDRESS'];
$arProps['PACKAGE'] = $_REQUEST['PACKAGE'];
$arProps['PACKAGE_NAME'] = $package['NAME'];

$arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_ID"      => PARTNERSHIP_REQUEST,
    "PROPERTY_VALUES"=> $arProps,
    "NAME"           => $_REQUEST['NAME'],
    "ACTIVE"         => "Y"
);

$message = Array(
    "NAME"           => $_REQUEST['NAME'],
    "PHONE"          => $_REQUEST['PHONE'],
    "ADDRESS"        => $_REQUEST['ADDRESS'],
    "PACKAGE"        => $_REQUEST['PACKAGE'],
    "PACKAGE_NAME"   => $package['NAME'],
    "PAGE_URL"       => $_SERVER['REQUEST_URI'],
);

CEvent::Send("PARTNERSHIP_REQUEST", "s1", $message, "N", 39, "");

if($id = $el->Add($arLoadProductArray)):
    $arResult['TYPE'] = 'SUCCESS';
    $arResult['RESULT'] = $id;
    $arResult['MESSAGE'] = '<h3>Заявка отправлена</h3><p>Наши представители свяжутся с вами в течение 48 часов</p>';
else:
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'RECAPTCHA';
    $arResult['MESSAGE'] = 'Ошибка при обработке формы! '.$el->LAST_ERROR;
endif;

echo json_encode($arResult);