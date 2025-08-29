<?

function d($arr,$flag = false) {
    global $USER;
    if($USER->isAdmin() || $flag == true) {
        print_r('<pre>');
        print_r($arr);
        print_r('</pre>');
    }
}

function pluralForm($n, $forms) {
    return $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
  }


function p($array, $bReturn = false) {
    $sResult = '<pre>' . print_r($array, true) . '</pre>';
    if ($bReturn) {
        return $sResult;
    } else {
        echo $sResult;
    }
}

function l($array){
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/l.log', print_r($array, true)."\n", FILE_APPEND);
}

if (!function_exists("recaptchaCheck")) {
    function recaptchaCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

            // Создаем POST запрос
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = Bitrix\Main\Config\Option::get("main", "recaptcha_secret_code", '6LeiX3cfAAAAAGLXC_vPzQ2B2ULkBGyBrQfabL2V');
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