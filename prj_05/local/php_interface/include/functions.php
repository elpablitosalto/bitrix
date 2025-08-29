<?

function d($arr, $flag = false)
{
    global $USER;
    if ($USER->isAdmin() || $flag == true) {
        print_r('<pre>');
        print_r($arr);
        print_r('</pre>');
    }
}

function pluralForm($n, $forms)
{
    return $n % 10 == 1 && $n % 100 != 11 ? $forms[0] : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? $forms[1] : $forms[2]);
}


function p($array, $bReturn = false)
{
    $sResult = '<pre>' . print_r($array, true) . '</pre>';
    if ($bReturn) {
        return $sResult;
    } else {
        echo $sResult;
    }
}

function l($array)
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/l.log', print_r($array, true) . "\n", FILE_APPEND);
}

if (!function_exists("recaptchaCheck")) {
    function recaptchaCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

            // Создаем POST запрос
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = CAPTCHA_SECRET_KEY;
            if (empty($recaptcha_secret)) {
                $recaptcha_secret = Bitrix\Main\Config\Option::get("main", "recaptcha_secret_code", '6LdsmFkoAAAAADoB76YFK1XaTiwQNr6D_shbVdkQ');
            }
            $recaptcha_response = $_POST['recaptcha_response'];

            // Отправляем POST запрос и декодируем результаты ответа
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);

            // Принимаем меры в зависимости от полученного результата
            if ($recaptcha->success && $recaptcha->score >= 0.5) {
                return true;
            }
        }
        return false;
    }
}

/**
 * Функция выводит массив на экран
 * param  $arr  Array Массив данных
 * param  $var_dump Bool Если true, то выводит в массиве и типы данных
 * Void
 */
function vardump($arr = false, $var_dump = false)
{
    echo "<pre >";
    if ($var_dump) {
        var_dump($arr);
    } else {
        print_r($arr);
    }
    echo "</pre>";
}


function array_multisort_value()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row) {
                $tmp[$key] = $row[$field];
            }
            $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

function getImageFormatted($arParams)
{
    $arResult = array();

    $arResult['FILE_VALUE'] = $arParams['FILE_VALUE'];
    $noPhotoSrc = '/upload/img/common/no_image.png';
    if (strlen($arParams['NO_IMAGE_DEFAULT']) > 0) {
        $noPhotoSrc = $arParams['NO_IMAGE_DEFAULT'];
    }

    $arPicture = [];
    if ($arParams['RESIZE'] == 'Y') {
        $arFileResized = CFile::ResizeImageGet(
            $arResult['FILE_VALUE']['ID'],
            array('width' => $arParams['WIDTH'], 'height' => $arParams['HEIGHT']),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            true
        );
        $arPicture['SRC'] = $arFileResized['src'];
        $arPicture['WIDTH'] = $arFileResized['width'];
        $arPicture['HEIGHT'] = $arFileResized['height'];
    } else {
        $arPicture['SRC'] = $arResult['FILE_VALUE']['SRC'];
        $arPicture['WIDTH'] = $arResult['FILE_VALUE']['WIDTH'];
        $arPicture['HEIGHT'] = $arResult['FILE_VALUE']['HEIGHT'];
    }
    //echo 'SRC = '.$_SERVER["DOCUMENT_ROOT"] . $arResult['FILE_VALUE']['SRC'].'<br />';
    //echo 'is_file = '.is_file($_SERVER["DOCUMENT_ROOT"] . $arResult['FILE_VALUE']['SRC']).'<br />';
    //echo '<br />';
    if (!is_file($_SERVER["DOCUMENT_ROOT"] . $arResult['FILE_VALUE']['SRC']) && is_file($_SERVER["DOCUMENT_ROOT"] . $noPhotoSrc)) {
        $arPicture['SRC'] = $noPhotoSrc;
        $arPicture['WIDTH'] = $arParams['WIDTH'];
        $arPicture['HEIGHT'] = $arParams['HEIGHT'];
    }
    $arResult['PICTURE'] = array(
        'SRC' => $arPicture['SRC'],
        'ALT' => ('' != $arResult['FILE_VALUE']['ALT']
            ? $arResult['FILE_VALUE']['ALT']
            : $arParams['DEFAULT_ALT_TITLE']
        ),
        'TITLE' => ('' != $arResult['FILE_VALUE']['TITLE']
            ? $arResult['FILE_VALUE']['TITLE']
            : $arParams['DEFAULT_ALT_TITLE']
        ),
        'WIDTH' => $arPicture['WIDTH'],
        'HEIGHT' => $arPicture['HEIGHT'],
        'FILE_VALUE_SOURCE' => $arResult['FILE_VALUE'],
    );

    return $arResult;
}
