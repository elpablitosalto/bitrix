<?
define('CUSTOM_LAYOUT_PAGE', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Интернет магазин сухих строительных смесей, клея, затирки, гидроизоляции и ремонтных составов для бетона. Доставка по Москве и Московской области в компании Стройсервис. Широкий ассортимент, выгодные цены. ☎ +7 (495) 229-30-20");
$APPLICATION->SetTitle("MAPEI оптом и в розницу у официально дистрибьютора | «Стройсервис»");
$APPLICATION->SetPageProperty("BODY_CLASS", 'page-home');
?>
<h1 style="height: 0;opacity: 0;">Поставки строительной химии с технологической экспертизой по оптовым ценам</h1>
<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/home/top_slider.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/home/actions.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/catalog/popular_sections.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/brand/best.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/catalog/popular_products.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/home/advantages.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/home/projects.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/forms/object_exist.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/review/history_our_clients.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/home/they_trust_us.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/home/loyalty.php',
	array(),
	array()
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/forms/wholesale_purchase.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/home/marketplace.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
	SITE_DIR . 'include/home/our_office.php',
	array(),
	array('SHOW_BORDER' => false)
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>