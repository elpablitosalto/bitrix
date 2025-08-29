<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>

<section class="dp-section dp-subscribe-section">
    <div class="container">
        <div class="dp-subscribe">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="dp-section__title">Не пропускайте новые материалы</h2>
                    <p class="dp-section__desc">Подпишитесь на&nbsp;рассылку и&nbsp;получайте новые статьи, новости о&nbsp;предстоящих вебинарах и&nbsp;другие анонсы.</p>
                </div>
                <div class="col-md-6">
					<form class="dp-form dp-form-subscribe-section ajax-form" id="form-subscribe-section" method="post" action="#">
						<input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
						<?= bitrix_sessid_post() ?>
						<div class="dp-form__body">
							<div class="dp-field dp-field_m dp-field_filled">
								<input type="email" name="NAME" placeholder="Ваш e-mail" required>
							</div>
							<div class="dp-field dp-field_m dp-field_filled">
								<select class="dp-form-select" name="PROPERTY_SPECIALITY">
									<?
									$i = 0;
									foreach($arResult["ENUMS"]["SPECIALITY"] as $arEnum){?>
									<option value="<?=$arEnum["UF_XML_ID"]?>"<?if($i === 0){echo " selected";}?>><?=$arEnum["UF_NAME"]?></option>
									<?
									$i++;
									}?>
								</select>
							</div>
						</div>
						<div class="dp-form__footer">
							<button class="dp-btn dp-btn_m dp-btn_orange dp-form__submit" type="submit">
								Подписаться
							</button>
						</div>
						<div class="main_error"></div>
						<div class="msg"></div>
					</form>
                </div>
            </div>
        </div>
    </div>
</section>