<?//Константы
require_once('constants.php');

//Автозагрузка классов
require dirname(__FILE__) . '/autoload.php';

//Обработка событий
require dirname(__FILE__) . '/event_handler.php';

//Общие функции
require dirname(__FILE__) . '/lib/functions.php';

/**
 * обёртка для print_r() и var_dump()
 * @param $val - значение
 * @param string $name - заголовок
 * @param bool $mode - использовать var_dump() или print_r()
 * @param bool $die - использовать die() после вывода
 */
function print_p($val, $name = 'Содержимое переменной', $mode = false, $die = false){
    global $USER;
    if($USER->IsAdmin()){
        echo '<pre>'.(!empty($name) ? $name.': ' : ''); if($mode) { var_dump($val); } else { print_r($val); } echo '</pre>';
        if($die) die;
    }
}