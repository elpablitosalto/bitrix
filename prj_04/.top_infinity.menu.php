<?
$aMenuLinks = Array(
	Array(
		"О компании", 
		"/about/", 
		Array(), 
		Array(),
		"" 
	),
	Array(
		"Каталог", 
		INFINITY_ROOT."/catalog/",
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Скачать материалы",
        INFINITY_ROOT."/downloads/",
		Array(),
		Array(),
		""
	),
	Array(
		"Look Book",
        INFINITY_ROOT."/lookbook/",
		Array(),
		Array(),
		""
	),
	Array(
		"Учитесь у нас",
		"/press-center/events/",
		Array(),
		Array(
		    "NO_LINK" => "Y",
            "IS_PARENT" => true,
            "FROM_IBLOCK" => true
        ),
		""
	),
    Array(
        "Обучающее видео",
        "/press-center/videos/",
        Array(),
        Array(
            "FROM_IBLOCK" => "Y",
            "DEPTH_LEVEL" => 2,
        ),
        ""
    ),
    Array(
        "Мероприятия",
        "/press-center/events/",
        Array(),
        Array(
            "FROM_IBLOCK" => "Y",
            "DEPTH_LEVEL" => 2,
        ),
        ""
    ),
	Array(
		"Блог",
		"/press-center/blog/",
		Array(),
		Array(),
		""
	),
	Array(
		"Контакты",
		"/contacts/",
		Array(),
		Array(),
		""
	),
	Array(
		"Помощь",
		"/faq/",
		Array(),
		Array(),
		""
	)
);
?>