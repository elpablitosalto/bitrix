<?
/*
*ЗДЕСЬ ПРОПИСЫВАЮТСЯ PHP РЕДИРЕКТЫ*
*1. Если нужно перенаправление с одной конкретной страницы на другую, то в массив добавляем новое значение в котором указываем "UrlOne" и в него прописываем url с которого делаем редирект и указываем 'UrlTwo' со страницей на которую делаем редирект. ВНИМАНИЕ! указывать url без https://domen.ru/.
2. Если нужно добавить редирект по шаблону регулярного выражения, то добавляем в массиы новое значение, в котором указываем 'Pattern' и с него прописываем нужный шаблон регулярного выражения и указываем 'Replacement' в него прописываем на что будет замененно наше регулярное выражение. 
3. Если есть какое-то дополнительное условие для редиректа, то в массив добавляем новое значение, в него прописываем 'Condition' в котором пишем наше условие с результатами "true" и "false" (пример $arrRedirections[2]), и прописываем 'UrlTwo' в котором указываем куда будет осуществляться перенапавление. 

Ниже код цикла, который осуществляет редиректы, его можно аккуратно править под свои нужды. 
*/

/*$arrRedirections = array(
	0 => array(
		'Pattern' => '', 
		'Replacement' => "",
		'Condition' => "",
		'UrlOne' => "/products-bestsellers/?page=1",
		'UrlTwo' => "/products-bestsellers/",
	),
	1 => array(
		'Pattern' => '', 
		'Replacement' => "",
		'Condition' => "",
		'UrlOne' => "/products-newest/?page=1",
		'UrlTwo' => "/products-newest/",
	),
	2 => array(
		'Pattern' => '', 
		'Replacement' => "",
		'Condition' => file_exists($_SERVER['REQUEST_URI']) != true && preg_match("/\?/", $_SERVER['REQUEST_URI']) != true && substr($_SERVER['REQUEST_URI'] , -1)!='/' ? "true" : "false",
		'UrlOne' => "",
		'UrlTwo' => $_SERVER['REQUEST_URI']."/",
	),
	3 => array(
		'Pattern' => '', 
		'Replacement' => "",
		'Condition' => "",
		'UrlOne' => "/promotions/?page=1",
		'UrlTwo' => "/promotions/",
	),



		 );*/
include 'array_redirects.php';		 

for($i=0;$i<count($arrRedirections);$i++){

	if(isset($arrRedirections[$i]['Condition']) && $arrRedirections[$i]['Condition'] == "true" && isset($arrRedirections[$i]['UrlTwo'])){
		$new_url = $arrRedirections[$i]['UrlTwo'];
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: https://".$_SERVER['SERVER_NAME'].$new_url);
		exit();
		
	}
	elseif(isset($arrRedirections[$i]['UrlOne']) && isset($arrRedirections[$i]['UrlTwo']) && $arrRedirections[$i]['UrlTwo'] != "" && $arrRedirections[$i]['UrlOne'] != "" && $_SERVER['REQUEST_URI'] == $arrRedirections[$i]['UrlOne']){
			$new_url = $arrRedirections[$i]['UrlTwo'];
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: https://".$_SERVER['SERVER_NAME'].$new_url);
			exit();
	}
	else{
		if(isset($arrRedirections[$i]['Pattern']) && $arrRedirections[$i]['Pattern'] != "" && isset($arrRedirections[$i]['Replacement']) && preg_match($arrRedirections[$i]['Pattern'], $_SERVER['REQUEST_URI'])){
			$new_url = $_SERVER['REQUEST_URI'];
			$new_url = preg_replace($arrRedirections[$i]['Pattern'], $arrRedirections[$i]['Replacement'], $new_url);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: https://".$_SERVER['SERVER_NAME'].$new_url);
			exit();
		}
		else echo "";
	}
}




?>


