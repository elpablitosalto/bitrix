<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Loader;
Loader::includeModule("iblock");

if(!recaptchaCheck()){
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'RECAPTCHA';
    $arResult['MESSAGE'] = 'Ошибка проверки recaptcha!';
    echo json_encode($arResult);
    die();
}

if (filter_var($_REQUEST['EMAIL'], FILTER_VALIDATE_EMAIL) === false) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'EMAIL';
    $arResult['MESSAGE'] = 'E-mail адрес <b>'.$_REQUEST['EMAIL'].'</b> указан неверно';
    echo json_encode($arResult);
    die();
}

if(!isset($_REQUEST['suggestion'])) {
    $arResult['TYPE'] = 'ERROR';
    $arResult['FIELDS'] = 'suggestion';
    echo json_encode($arResult);
    die();
}

$el = new CIBlockElement;

$arProps = array();
$arProps['EMAIL'] = $_REQUEST['EMAIL'];
$arProps['PAGE_URL'] = $_REQUEST['PAGE_URL'];

$arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_ID"      => ASK_QUESTION,
    "PROPERTY_VALUES"=> $arProps,
    "NAME"           => $_REQUEST['NAME'],
    "ACTIVE"         => "Y",            // активен
    "PREVIEW_TEXT"   => $_REQUEST['MESSAGE']
);
$message = Array(
    "NAME"           => $_REQUEST['NAME'],
    "EMAIL"          => $_REQUEST['EMAIL'],
    "MESSAGE"        => $_REQUEST['MESSAGE'],
    "PAGE_URL"       => $_REQUEST['PAGE_URL'],
);

CEvent::Send("FEEDBACK_FORM", "s1", $message, "N", 7, "");

if($id = $el->Add($arLoadProductArray)):
    $arResult['TYPE'] = 'SUCCESS';
    $arResult['RESULT'] = $id;
    $arResult['MESSAGE'] = '<p>Мы получили ваше сообщение. </p><p>В ближайшее время наши специалисты займутся им.</p>';
else:
    $arResult['TYPE'] = 'SUCCESS';
    $arResult['RESULT'] = $id;
    $arResult['MESSAGE'] = '<p>Мы получили ваше сообщение. </p><p>В ближайшее время наши специалисты займутся им.</p>';
endif;

echo json_encode($arResult);