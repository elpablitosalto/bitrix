<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<? foreach ($arParams["~AUTH_SERVICES"] as $service) { ?>
	<?/*?>
	<a title="<?= htmlspecialcharsbx($service["NAME"]) ?>" href="javascript:void(0)" onclick="BxShowAuthFloat('<?= $service["ID"] ?>', '<?= $arParams["SUFFIX"] ?>')">
		<i class="bx-ss-icon <?= htmlspecialcharsbx($service["ICON"]) ?>"></i>
	</a>
	<?*/ ?>
	<?
	//vardump($service);
	?>

	<li class="dp-modal-login__item">
		<a class="dp-modal-login__link" title="<?= htmlspecialcharsbx($service["NAME"]) ?>" href="javascript:void(0)" onclick="BxShowAuthFloat('<?= $service["ID"] ?>', '<?= $arParams["SUFFIX"] ?>')">
			<div class="dp-modal-login__image">
				<? if ($service['ID'] == 'YandexOAuth') { ?>
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/yandex.png" alt="<?= $service["NAME"]; ?>">
				<? } else if ($service['ID'] == 'VKontakte') { ?>
					<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/vk.png" alt="<?= $service["NAME"]; ?>">
				<? } ?>
			</div>
			<p><?= $service["NAME"]; ?></p>
		</a>
	</li>
<? } ?>

<?/*?>
<li class="dp-modal-login__item">
	<a class="dp-modal-login__link" href="#">
		<div class="dp-modal-login__image">
			<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/vk.png" alt="VK">
		</div>
		<p>Вконтакте</p>
	</a>
</li>
<li class="dp-modal-login__item"><a class="dp-modal-login__link" href="#">
		<div class="dp-modal-login__image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/google.png" alt="Google"></div>
		<p>Google</p>
	</a></li>
<li class="dp-modal-login__item"><a class="dp-modal-login__link" href="#">
		<div class="dp-modal-login__image">
			<img src="<?= SITE_TEMPLATE_PATH ?>/img/design/yandex.png" alt="Yandex">
		</div>
		<p>Яндекс</p>
	</a></li>
	<?*/ ?>