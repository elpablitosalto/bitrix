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

$types = ['txt','doc','pdf','jpeg','png'];

if (filter_var($_REQUEST['EMAIL'], FILTER_VALIDATE_EMAIL) === false) {
    $arResult['TYPE'] = 'INPUT_ERROR';
    $arResult['FIELDS'] = 'EMAIL';
    $arResult['MESSAGE'] = 'E-mail адрес <b>'.$_REQUEST['EMAIL'].'</b> указан неверно';
    echo json_encode($arResult);
    die();
}

if(isset($_FILES['REZUME_FILE'])) {
    $fileType = explode('.',$_FILES['REZUME_FILE']['name']);
    $fileType = end($fileType);

    if(!in_array($fileType,$types)) {        
        $arResult['TYPE'] = 'INPUT_ERROR';
        $arResult['FIELDS'] = 'REZUME_FILE';
        $arResult['MESSAGE'] = 'Недопустимый формат файла <b>'.$fileType.'</b>';
        echo json_encode($arResult);
        die();
    }
}

if(!isset($_REQUEST['suggestion'])) {
    $arResult['TYPE'] = 'INPUT_ERROR';
    $arResult['FIELDS'] = 'suggestion';
    $arResult['MESSAGE'] = 'Вы не согласились с условиями обработки персональных данных';
    echo json_encode($arResult);
    die();
}


$el = new CIBlockElement;

$arProps = array();

$arProps['EMAIL'] = $_POST['EMAIL'];
$arProps['PHONE'] = $_POST['PHONE'];
$arProps['POSITION'] = $_POST['POSITION'];
$arProps['VACANCY'] = $_POST['VACANCY'];

if(!empty($_FILES['REZUME_FILE']))
    $arProps['REZUME_FILE'] = $_FILES['REZUME_FILE'];

$arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_ID"      => REZUME,
    "PROPERTY_VALUES"=> $arProps,
    "NAME"           => $_POST['NAME'],
    "ACTIVE"         => "Y",            // активен
    "PREVIEW_TEXT"   => $_REQUEST['REZUME_TEXT']
);

$message = Array(
    "NAME"           => $_REQUEST['NAME'],
    "EMAIL"          => $_REQUEST['EMAIL'],
    'PHONE'          => $_REQUEST['PHONE'],
    "MESSAGE"        => $_REQUEST['MESSAGE'],
    "POSITION"       => $_REQUEST['POSITION'],
    "VACANCY"        => $_REQUEST['VACANCY'],
    "REZUME_TEXT"    => $_REQUEST['REZUME_TEXT'],
);

CEvent::Send("RESUME", "s1", $message, "N", 37, array_column($_FILES, "tmp_name"));

if($id = $el->Add($arLoadProductArray)):
    $arResult['STATUS'] = 'Y';
    $arResult['TYPE'] = 'success';
    $arResult['MESSAGE'] = '<p>Мы получили ваше резюме. </p><p>В ближайшее время наши специалисты займутся им.</p>';
else:
    $arResult['STATUS'] = 'N';
    $arResult['TYPE'] = 'error';
    $arResult['MESSAGE'] = $el->LAST_ERROR;
endif;

echo json_encode($arResult);