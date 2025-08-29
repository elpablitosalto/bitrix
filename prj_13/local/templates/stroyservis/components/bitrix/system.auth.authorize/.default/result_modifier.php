<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $USER, $APPLICATION;
$arResult["CAPTCHA_CODE"] = false;

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'login') {

	$APPLICATION->RestartBuffer();
	if (!defined('PUBLIC_AJAX_MODE')) {
		define('PUBLIC_AJAX_MODE', true);
	}

	header('Content-type: application/json');

	if (!$USER->IsAuthorized()) {

		if($arResult["CAPTCHA_CODE"]):?>
			<?
			ob_start();
			?>
			<div class="captcha-row">
				<div class="captcha-cell captcha-cell-img">
					<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
				</div>
				<div class="captcha-cell captcha-cell-input">
					<input class="bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" placeholder="<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>">
				</div>
			</div>
			<?
			$captchaHTML = ob_get_contents();
			ob_end_clean();

			echo json_encode(array(
				'type' => 'error',
				'message' => GetMessage("INCORRECT_LOGIN"),
				'catcha' => $captchaHTML
			));
			die();
			?>
		<?else:

			echo json_encode(array(
				'type' => 'error',
				'message' => $arParams["~AUTH_RESULT"]["MESSAGE"],
			));
			die();

		endif;
		
	} else {
		echo json_encode(array('type' => 'ok'));
		die();
	}

	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
	die();
}
?>