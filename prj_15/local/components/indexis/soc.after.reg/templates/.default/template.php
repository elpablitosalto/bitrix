<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
?>

<div class="dp-modal dp-modal-sign dp-modal-registration" id="modal-registration-soc" <?if($arResult["SHOW_WINDOW"] == "Y") echo ' style="display:block;"';?>>
    <div class="dp-modal__overlay"></div>
    <div class="dp-modal__dialog">
        <div class="dp-modal__header">
            <h3 class="dp-modal__title">Регистрация</h3>
        </div>
        <div class="dp-modal__body">
            <form class="dp-form modal-registration-soc" method="post" enctype="multipart/form-data">
                <div class="dp-form__body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dp-field">
                                <input type="text" name="NAME" placeholder="Имя" value="<?= $arResult["USER"]["NAME"] ?>" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dp-field">
                                <input type="text" name="LAST_NAME" placeholder="Фамилия" value="<?= $arResult["USER"]["LAST_NAME"] ?>" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dp-field">
                                <input type="email" name="EMAIL" placeholder="E-mail" value="<?= $arResult["USER"]["EMAIL"] ?>" required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dp-form__footer">
                    <div class="dp-form__actions">
                        <button class="dp-btn dp-btn_orange dp-form__submit" type="submit">Сохранить
                        </button>
                    </div>
                    <div class="result"></div>
                </div>
            </form>
        </div>
    </div>
</div>
