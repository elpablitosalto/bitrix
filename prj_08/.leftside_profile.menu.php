<?
$aMenuLinks = Array(
	Array(
		"Моя ведомость", 
		"/cart/",
		Array(), 
		Array("PARAM_1"=>"VALUE_1"), 
		"\$GLOBALS['USER']->IsAuthorized()" 
	),
	Array(
		"Профиль", 
		"/profile/", 
		Array(), 
		Array("PARAM_1"=>"VALUE_1"), 
		"\$GLOBALS['USER']->IsAuthorized()" 
	),
	Array(
		"Рассылка", 
		"/subscription/", 
		Array(), 
		Array("PARAM_1"=>"VALUE_1"), 
		"\$GLOBALS['USER']->IsAuthorized()" 
	),
	Array(
		"Выйти из профиля", 
		"/?logout=yes&sessid=0d6ff55a73d28a93331bb6039cced05c", 
		Array(), 
		Array("PARAM_1"=>"VALUE_1"), 
		"\$GLOBALS['USER']->IsAuthorized()" 
	)
);
?>