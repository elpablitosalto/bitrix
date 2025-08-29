<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->AddChainItem("404");
?>

<div class="bx-404-container">
	<div class="bx-404-text-block">Неправильно набран адрес, или такой страницы на сайте больше не существует.</div>
	<div class="">Вернитесь на главную или воспользуйтесь поиском.</div>
</div>
<script>
window.onload = function () {
yaCounter16721107.reachGoal('404error');
}
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>