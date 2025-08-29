<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<?
//vardump($arResult["USER"]);
//vardump($_POST);
?>

<div class="dp-account-profile">
    <div class="dp-account-profile-block">
        <p class="dp-account-profile-block__title">Данные профиля</p>
        <form class="dp-form dp-form-profile" id="form-profile" method="post" action="#">
            <div class="dp-form__body">
                <div class="dp-field">
                    <input type="text" name="NAME" placeholder="Имя" value="<?= $arResult["USER"]["NAME"] ?>" required="">
                </div>
                <div class="dp-field">
                    <input type="text" name="LAST_NAME" placeholder="Фамилия" value="<?= $arResult["USER"]["LAST_NAME"] ?>" required="">
                </div>
                <div class="dp-field dp-field-confirm">
                    <input type="email" name="EMAIL" placeholder="E-mail" value="<?= $arResult["USER"]["EMAIL"] ?>" required="">
                    <?if(!$arResult["USER"]["UF_EMAIL_CONFIRMED"]){?>
                    <div class="dp-field-confirm__actions">
                        <button data-id="<?= $arResult["USER"]["ID"] ?>" class="dp-btn dp-btn_white dp-field-confirm__btn" type="button">Подтвердить почту</button>
                    </div>
                    <?}?>
                </div>
                <div class="dp-field dp-field-confirm js_phone_mask_container" id="js_phone_country_profile_container">
                    <input type="tel" class="iti-input js_phone_country_profile" name="PERSONAL_PHONE" placeholder="Телефон" value="<?= $arResult["USER"]["PERSONAL_PHONE"] ?>" required="">
                </div>
                <div class="dp-field">
                    <select class="dp-form-select" name="UF_SPECIALITY" required>
                        <?foreach($arResult["ENUMS"]["SPECIALITY"] as $arSpeciality){?>
                        <option <?if($arResult["USER"]["UF_SPECIALITY"] == $arSpeciality["ID"]) echo "selected"?> value="<?=$arSpeciality["ID"]?>"><?=$arSpeciality["VALUE"]?></option>
                        <?}?>
                    </select>
                </div>
            </div>
            <div class="dp-form__footer">
                <button class="dp-btn dp-form__submit" type="submit">Сохранить</button>
            </div>
            <div class="result"></div>
        </form>
    </div>
    <div class="dp-account-profile-block">
        <p class="dp-account-profile-block__title">Пароль</p><a class="dp-btn dp-btn_white dp-form-change-password-toggle-btn" href="#">Изменить</a>
        <form class="dp-form dp-form-change-password" id="form-change-password" method="post" action="#">
            <div class="dp-form__body">
                <div class="dp-field dp-field-password">
                    <input type="password" name="old_pas" placeholder="Текущий пароль" required="">
					<button class="dp-field-password-toggle-btn" type="button">
						<svg class="icon icon-eye ">
							<use xlink:href="#eye"></use>
						</svg>
						<svg class="icon icon-eye-hidden ">
							<use xlink:href="#eye-hidden"></use>
						</svg>
					</button>
                </div>
                <div class="dp-field dp-field-password">
                    <input type="password" name="new_pas" placeholder="Новый пароль" required="">
					<button class="dp-field-password-toggle-btn" type="button">
						<svg class="icon icon-eye ">
							<use xlink:href="#eye"></use>
						</svg>
						<svg class="icon icon-eye-hidden ">
							<use xlink:href="#eye-hidden"></use>
						</svg>
					</button>
                </div>
                <div class="dp-field dp-field-password">
                    <input type="password" name="new_pas_confirm" placeholder="Повторить пароль" required="">
					<button class="dp-field-password-toggle-btn" type="button">
						<svg class="icon icon-eye ">
							<use xlink:href="#eye"></use>
						</svg>
						<svg class="icon icon-eye-hidden ">
							<use xlink:href="#eye-hidden"></use>
						</svg>
					</button>
                </div>
            </div>
            <div class="dp-form__footer">
                <button class="dp-btn dp-form__submit" type="submit">Сохранить</button>
                <button class="dp-btn dp-btn_white dp-form__cancel" type="button">Отмена</button>
            </div>
            <div class="result"></div>
        </form>
    </div>
	<div class="dp-account-profile-block">
		<a href="/?logout=yes&<?=bitrix_sessid_get();?>" class="dp-btn dp-btn_orange">Выйти</a>
	</div>
</div>

