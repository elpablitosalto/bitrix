<?
use Bitrix\Main\Loader;

$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . "/../..");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once $_SERVER["DOCUMENT_ROOT"].'/local/lib/PHPExcel-1.8/Classes/PHPExcel.php';
Loader::includeModule('iblock');

$excelFile = 'redirects.xlsx';

$objPHPExcel = PHPExcel_IOFactory::load($excelFile);

// Выбор активного листа
$sheet = $objPHPExcel->getActiveSheet();

// Получение максимального количества строк и столбцов
$highestRow = $sheet->getHighestDataRow();
$highestColumn = $sheet->getHighestDataColumn();
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

// Массив для хранения значений из 2, 3 и 4 столбцов
$dataArray = array();

// Чтение данных из 2, 3 и 4 столбцов и сохранение их в массив
for ($row = 2; $row <= $highestRow; $row++) {
    $dataColumn1 = $sheet->getCellByColumnAndRow(0, $row)->getValue(); // 1 столбец
    $dataColumn2 = $sheet->getCellByColumnAndRow(1, $row)->getValue(); // 2 столбец

    // Сохранение значений в массив
    $dataArray[$row]['UrlOne'] = $dataColumn1;
    $dataArray[$row]['UrlTwo'] = $dataColumn2;
}

// Вывод массива с данными
//$dataArray = array_filter($dataArray);
//$dataArray = array_values($dataArray);
//print_r($dataArray);
saveArray($dataArray);


function saveArray($arrayData){
	$file = fopen("array_redirects.php", "w");

	// Записываем PHP код для массива в файл
	fwrite($file, "<?php \$arrRedirections = " . var_export($arrayData, true) . "; ?>");

	// Закрываем файл
	fclose($file);

		echo "Массив успешно записан в файл array_redirects.php";
	}

?>