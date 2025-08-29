<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if ($arResult["ERROR_MESSAGE"] <> '') {
    ShowError($arResult["ERROR_MESSAGE"]);
}

if(!function_exists("showProfileField")){
    /**
     * Выводит шаблон полей профиля
     * @param int $propId
     * @param array $arFieldsValues
     * @param bool $isRequired
     * @param array $additionalClasses
     * @return string
     */
    function showProfileField(int $propId, array $arFieldsValues, bool $isRequired = true, string $inputType = 'text', array $additionalClasses = [], array $additionalAttributes = []) : string {
        $fieldTempalte = '
            <div class="form-control profile-panel__line">
                <label class="form-control__holder">
                    <span class="form-control__label">
                        #TITLE#
                    </span>
                    <span class="form-control__field">
                        <input type="#TYPE#" class="form-control__input #CLASSES#" #REQUIRED# name="#NAME#" value="#VALUE#" #ATTRIBUTES#/>
                    </span>
                    <span class="form-control__messages">
                        <span style="display: none;" class="form-control__message form-control__message_style_error">
                            Ошибка поля
                        </span>
                    </span>
                </label>
            </div>
        ';
        return str_replace(["#TITLE#", "#NAME#", "#VALUE#", "#REQUIRED#", "#TYPE#", "#CLASSES#", "#ATTRIBUTES#"], [
            $arFieldsValues[$propId]["NAME"],
            "PROPERTY_".$arFieldsValues[$propId]["ID"],
            $arFieldsValues[$propId]["VALUE"],
            $isRequired ? 'required="required"' : "",
            $inputType ?: "text",
            !empty($additionalClasses) ? implode(" ", $additionalClasses) : "",
            !empty($additionalAttributes) ? implode(" ", $additionalAttributes) : ""
        ], $fieldTempalte);
    }
}
if(!function_exists("showAddressField")){
    /**
     * Выводит шаблон полей адресов
     * @param int $propId
     * @param array $arFieldsValues
     * @param bool $isRequired
     * @param array $additionalClasses
     * @return string
     */
    function showAddressField(int $propId, array $arFieldsValues, bool $isRequired = true, string $inputType = 'text', array $additionalClasses = [], array $additionalAttributes = []) : string {
        $fieldTempalte = '
            <div class="form-control address-option__line">
                <label class="form-control__holder">
                    <span class="form-control__label">
                        #TITLE#
                    </span>
                    <span class="form-control__field">
                        <input type="#TYPE#" class="form-control__input #CLASSES#" #REQUIRED# name="#NAME#" value="#VALUE#" #ATTRIBUTES#/>
                    </span>
                    <span class="form-control__messages">
                        <span style="display: none;" class="form-control__message form-control__message_style_error">
                            Ошибка поля
                        </span>
                    </span>
                </label>
            </div>
        ';
        return str_replace(["#TITLE#", "#NAME#", "#VALUE#", "#REQUIRED#", "#TYPE#", "#CLASSES#", "#ATTRIBUTES#"], [
            $arFieldsValues[$propId]["NAME"],
            "PROPERTY_".$arFieldsValues[$propId]["ID"],
            $arFieldsValues[$propId]["VALUE"],
            $isRequired ? 'required="required"' : "",
            $inputType ?: "text",
            !empty($additionalClasses) ? implode(" ", $additionalClasses) : "",
            !empty($additionalAttributes) ? implode(" ", $additionalAttributes) : ""
        ], $fieldTempalte);
    }
}
if (is_array($arResult["PROFILES"]) && !empty($arResult["PROFILES"])) {
    ?>
    <div class="profiles-wrapper">
        <div class="profile__profile-list">
            <!-- begin .profile-list-->
            <div class="profile-list">
                <div class="profile-list__list js-profile-panel-list">
                    <?
                    foreach ($arResult["PROFILES"] as $profile) {
                        $arFieldsMap = $arResult["PROPERTY_MAP"][$profile["PERSON_TYPE_ID"]];
                        $arFieldsValues = $profile["PROPS"];
                        ?>
                        <div class="profile-list__item js-profile-panel-item" data-profile-id="<?=$profile["ID"]?>">
                            <!-- begin .profile-panel-->
                            <div class="profile-panel js-profile-panel" data-open-modifier="profile-panel_state_open">
                                <div class="profile-panel__header">
                                    <div class="profile-panel__title">
                                        <?= $profile["NAME"] ?>
                                    </div>
                                    <div class="profile-panel__link profile-panel__remove">
                                        <!-- begin .link-item-->
                                        <a class="link-item link-item_icon-size_m js-profile-panel-remove js-modal" href="#modalConfirmProfileDeletion">
                                            <div class="link-item__icon-wrapper">
                                                <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                            d="M4.99935 15.8333C4.99935 16.75 5.74935 17.5 6.66602 17.5H13.3327C14.2493 17.5 14.9993 16.75 14.9993 15.8333V5.83333H4.99935V15.8333ZM6.66602 7.5H13.3327V15.8333H6.66602V7.5ZM12.916 3.33333L12.0827 2.5H7.91602L7.08268 3.33333H4.16602V5H15.8327V3.33333H12.916Z"
                                                    />
                                                </svg>
                                            </div>
                                            <div class="link-item__label">
                                                Удалить профиль
                                            </div>
                                        </a>
                                        <!-- end .link-item-->
                                    </div>
                                    <button type="button" class="profile-panel__trigger js-profile-panel-trigger">
                                        Открыть / закрыть
                                    </button>
                                </div>
                                <div class="profile-panel__body">
                                    <form class="profile-panel__main js-profile-panel-form">
                                        <div class="profile-panel__inputs">
                                            <!-- begin .form-control-->
                                                <?=showProfileField(intval($arFieldsMap["customer"]["fullName"]), $arFieldsValues, true, "text", ["js-profile-name"])?>
                                            <!-- end .form-control-->
                                            <!-- begin .form-control-->
                                                <?=showProfileField(intval($arFieldsMap["customer"]["email"]), $arFieldsValues, true, "email")?>
                                            <!-- end .form-control-->
                                            <!-- begin .form-control-->
                                                <?$propId = intval($arFieldsMap["customer"]["phone"]);?>
                                                <?=showProfileField(intval($arFieldsMap["customer"]["phone"]), $arFieldsValues, true, "tel", ["js-broad-phone-input"])?>
                                            <!-- end .form-control-->
                                        </div>
                                        <?if($profile["PERSON_TYPE_ID"] == 1):?>
                                            <div class="profile-panel__inputs">
                                                <div class="profile-panel__heading">
                                                    <div class="profile-panel__title">
                                                        Данные компании:
                                                    </div>
                                                </div>
                                                <!-- begin .form-control-->
                                                    <?=showProfileField(intval($arFieldsMap["company"]["name"]), $arFieldsValues)?>
                                                <!-- end .form-control-->
                                                <!-- begin .form-control-->
                                                    <?=showProfileField(intval($arFieldsMap["company"]["legalAdress"]), $arFieldsValues)?>
                                                <!-- end .form-control-->
                                                <div class="profile-panel__multiline">
                                                    <!-- begin .form-control-->
                                                        <?=showProfileField(intval($arFieldsMap["company"]["inn"]), $arFieldsValues, true, "number", [], ['minlength="10"', 'maxlength="12"'])?>
                                                    <!-- end .form-control-->
                                                    <!-- begin .form-control-->
                                                        <?=showProfileField(intval($arFieldsMap["company"]["kpp"]), $arFieldsValues, false)?>
                                                    <!-- end .form-control-->
                                                </div>
                                            </div>
                                        <?endif;?>
                                        <div class="profile-panel__inputs">
                                            <div class="profile-panel__heading">
                                                <div class="profile-panel__title">
                                                    Адрес доставки:
                                                </div>
                                            </div>
                                            <div class="profile-panel__address-group">
                                                <div class="profile-panel__address-list js-profile-panel-address-list">
                                                    <div class="profile-panel__address-item js-profile-panel-address-item">
                                                        <div class="address-option__inputs">
                                                            <div class="address-option__multiline">
                                                                <!-- begin .form-control-->
                                                                    <?=showAddressField(intval($arFieldsMap["address"]["city"]), $arFieldsValues)?>
                                                                <!-- end .form-control-->
                                                                <!-- begin .form-control-->
                                                                    <?=showAddressField(intval($arFieldsMap["address"]["street"]), $arFieldsValues)?>
                                                                <!-- end .form-control-->
                                                            </div>
                                                            <div class="address-option__multiline address-option__multiline_type_permanent">
                                                                <!-- begin .form-control-->
                                                                    <?=showAddressField(intval($arFieldsMap["address"]["houseNumber"]), $arFieldsValues, true, 'text', [], ['pattern="^[\d-/]+$"'])?>
                                                                <!-- end .form-control-->
                                                                <!-- begin .form-control-->
                                                                    <?=showAddressField(intval($arFieldsMap["address"]["building"]), $arFieldsValues, false)?>
                                                                <!-- end .form-control-->
                                                                <!-- begin .form-control-->
                                                                    <?=showAddressField(intval($arFieldsMap["address"]["floor"]), $arFieldsValues, false, 'number')?>
                                                                <!-- end .form-control-->
                                                            </div>
                                                        </div>
                                                        <div class="profile-panel__controls">
                                                            <div class="profile-panel__control">
                                                                <!-- begin .button-->
                                                                <button class="button button_width_full button_size_s" type="submit">
                                                            <span class="button__holder">
                                                                Сохранить
                                                            </span>
                                                                </button>
                                                                <!-- end .button-->
                                                            </div>
                                                            <div class="profile-panel__link profile-panel__remove">
                                                                <!-- begin .link-item-->
                                                                <a class="link-item link-item_icon-size_m js-profile-panel-remove js-modal" href="#modalConfirmProfileDeletion">
                                                                    <div class="link-item__icon-wrapper">
                                                                        <svg class="link-item__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                    d="M4.99935 15.8333C4.99935 16.75 5.74935 17.5 6.66602 17.5H13.3327C14.2493 17.5 14.9993 16.75 14.9993 15.8333V5.83333H4.99935V15.8333ZM6.66602 7.5H13.3327V15.8333H6.66602V7.5ZM12.916 3.33333L12.0827 2.5H7.91602L7.08268 3.33333H4.16602V5H15.8327V3.33333H12.916Z"
                                                                            />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="link-item__label">
                                                                        Удалить профиль
                                                                    </div>
                                                                </a>
                                                                <!-- end .link-item-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end .profile-panel-->
                        </div>
                        <?
                    } ?>
                </div>
                <div class="profile-list__message">
                    Вы еще не создали ни одного профиля. Сделайте заказ, чтобы создать профиль.
                </div>
            </div>
            <!-- end .profile-list-->
        </div>
    </div>
    <?
} elseif ($arResult['USER_IS_NOT_AUTHORIZED'] !== 'Y') {
    ?>
    <!-- begin .profile-list-->
    <div class="profile-list">
        <div class="profile-list__list"></div>
        <div class="profile-list__message">
            Вы еще не создали ни одного профиля. Сделайте заказ, чтобы создать профиль.
        </div>
    </div>
    <!-- end .profile-list-->
    <?
}
?>
