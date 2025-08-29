<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (isset($_POST["quiz"]) && isset($_POST["contact"]) && CModule::IncludeModule('iblock')) {

	$arMessage = Array(
		  "IBLOCK_ID"      => Indexis::getIblockId("quiz", "requests", "s1"),
		  "DETAIL_TEXT_TYPE" => 'html',
		  "ACTIVE"         => "Y",
	);
	$title = 'Сообщение'; // инициализация, будет заменена реальными данными
	$message = '';

	foreach($_POST["quiz"] as $item) {
		if ($item['id'] == $_POST["contact"]) {
			$arMessage["PROPERTY_VALUES"]['NAME'] = htmlspecialchars($item['answer']);
			$arMessage["PROPERTY_VALUES"]['PHONE'] = $item['phone'];
			$title = $arMessage["PROPERTY_VALUES"]['NAME'].', '.$item['phone'];
			$message = $message.'<p>'.$item['text'].': '.$title;
		} else {
			$message = $message.'<p>'.$item['text'].': '.$item['answer'];
		}

	}
    $arMessage["NAME"] = $title;
    $arMessage["DETAIL_TEXT"] = $message;

	$el = new CIBlockElement;
	$newID = $el->Add($arMessage);

    CEvent::Send('NEED_HELP_CALLBACK', SITE_ID, ['NAME' => $title, 'TEXT' => $message]);

	//AddMessage2Log(print_r($_POST, true), "tst");

}


