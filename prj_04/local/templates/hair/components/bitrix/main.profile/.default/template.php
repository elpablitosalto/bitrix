<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

switch($arResult['USER_GROUP']){
	case 5:
		$title = 'ЛИЧНЫЙ КАБИНЕТ МАСТЕРА';
		break;
	case 6:
		$title = 'ЛИЧНЫЙ КАБИНЕТ ТЕХНОЛОГА';
		break;
	case 7:
		$title = 'ЛИЧНЫЙ КАБИНЕТ ДИСТРИБЬЮТОРА';
		break;
}
?>
<h1 class="_small _mobile-text-center"><?=$title?></h1>
<div class="personal-wrapper">
	<div class="personal">
		<?
			switch($arResult['USER_GROUP']){
				case 5:
					include_once('include/lk_master.php');
					break;
				case 6:
					include_once('include/lk_tech.php');
					break;
				case 7:
					include_once('include/lk_distributor.php');
					break;
			}
		?>
	</div>
</div>