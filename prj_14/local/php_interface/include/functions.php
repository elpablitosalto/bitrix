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
    $noPhotoSrc = '/img/common/no_photo.png';
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