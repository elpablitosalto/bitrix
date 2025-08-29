<?
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