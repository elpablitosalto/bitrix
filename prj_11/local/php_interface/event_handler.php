<?php

use Bitrix\Main;
$eventManager = Main\EventManager::getInstance();

//Вешаем обработчик на событие создания списка пользовательских свойств OnUserTypeBuildList
// $eventManager->addEventHandler('main', 'OnUserTypeBuildList', ['lib\UserType\CUserTypeStorybook', 'GetUserTypeDescription']);

// $eventManager->addEventHandler('main', 'OnUserTypeBuildList', ['lib\usertype\MultiStringBlock', 'GetUserTypeDescription']);
$eventManager->addEventHandler('iblock', 'OnIBlockPropertyBuildList', ['lib\usertype\StorybookUserType', 'GetUserTypeDescription']);

function changePageContent(&$content) {
	$content = removeFloatingPrepositions($content);
}
/**
 * Заменяет пробелы после предлогов на неразрывный пробел
 */

 function removeFloatingPrepositions($buffer) {
		// Определяем предлоги для замены
    $prepositions = 'в|во|без|до|из|к|ко|на|по|о|от|перед|при|через|с|у|не|за|над|для|об|под|про|и|а|но|да|или|ли|бы|то|что|как|я|он|мы|они|ни';

    $result = preg_replace('/\b(' . $prepositions . ')\s+(\S)/iu', '$1&nbsp;$2', $buffer);

		return $result;
}

$eventManager->addEventHandler('main', 'OnEndBufferContent', 'changePageContent');

 function formСheckOnBeforeResultAdd($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
	global $APPLICATION;

	if(!\NoboringFinance\General::formValidate()) {
		$APPLICATION->ThrowException('Форма заполнена неверно');
	}
}

AddEventHandler('form', 'onBeforeResultAdd', 'formСheckOnBeforeResultAdd');