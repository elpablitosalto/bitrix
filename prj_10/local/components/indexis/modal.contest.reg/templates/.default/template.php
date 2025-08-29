<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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


if ($arResult["REG_EXIST"] != "Y") {
    // JS -->
    $script_url = $_SERVER["DOCUMENT_ROOT"] . "/" . $templateFolder . "/script_custom.js";
    $script_url = str_replace("//", "/", $script_url);
    if (is_file($script_url)) {
        $script_content = file_get_contents($script_url);
        ?>
        <script type="text/javascript">
            <? echo $script_content; ?>
        </script>
    <?
    }
    // <-- JS

    // Hiddens -->
    {
        ?>
        <input id="MODAL_CONTEST_AJAX_PATH" type="hidden" value="<? echo $componentPath . "/ajax.php"; ?>" />
        <input id="MODAL_CONTEST_COMPONENT_NAME" type="hidden" value="<? echo $arResult["COMPONENT_NAME"]; ?>" />
        <input id="MODAL_CONTEST_TEMPLATE_NAME" type="hidden" value="<? echo $arResult["TEMPLATE_NAME"]; ?>" />
        <input id="SERVER_VALIDATE_ERROR_CONT_ID" type="hidden" value="<?= $arResult["MODAL_DIV_ID"]; ?>-error" />
        <input id="MODAL_DIV_ID" type="hidden" value="<? echo $arResult["MODAL_DIV_ID"]; ?>" />
    <?
    }
    // <-- Hiddens
}
?>

<div class="ml-modal ml-modal-contest-registration" id="<?= $arResult["MODAL_DIV_ID"]; ?>">
    <div class="ml-modal__overlay"></div>
    <div class="ml-modal__dialog">
        <div class="ml-modal__header">
            <h3 class="ml-modal__title">Регистрация</h3>
            <button class="ml-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
        </div>
        <div class="ml-modal__body">
            <?
            if ($arResult["REG_EXIST"] == "Y") {
                ShowMessage(array("TYPE" => "ERROR", "MESSAGE" => "Можно отправить только одну работу."));
            } else {
                ?>
                <form class="ml-form ml-form-contest-registration" id="form-contest-registration"
                    action="<?= $arResult["SEND_FORM_URL"]; ?>" method="post" <? /*?>enctype="multipart/form-data"<?*/?>>

                    <?
                    // Form Hiddens -->
                    ?>
                    <input name="IBLOCK_CODE" type="hidden" value="<? echo $arResult["CONTEST_REG_IBLOCK_CODE"]; ?>" />
                    <input name="SEND_FORM" type="hidden" value="Y" />
                    <input name="USER_ID" type="hidden" value="<? echo $arResult["USER_ID"]; ?>" />
                    <input name="CONTEST_UPLOAD_FILE_NAME" id="CONTEST_UPLOAD_FILE_NAME" type="hidden" value="" />
                    <input name="CONTEST_ELEMENT_ID" type="hidden"
                        value="<? echo $arResult["arContest"]["ELEMENT_ID"]; ?>" />
                    <?
                    // <-- Form Hiddens
                    ?>

                    <div class="ml-form__body">
                        <div class="ml-form-section">
                            <p class="ml-form-section__title">Фамилия и имя участника</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ml-form-field">
                                        <input <? /*value="email@email.com"*/?> type="text" name="participantLastName"
                                            placeholder="Фамилия" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="ml-form-field">
                                        <input <? /*value="email@email.com"*/?> type="text" name="participantFirstName"
                                            placeholder="Имя" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-form-section">
                            <p class="ml-form-section__title">Фамилия, имя, отчество законного представителя участника</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="ml-form-field">
                                        <input <? /*value="email@email.com"*/?> type="text" name="representativeLastName"
                                            placeholder="Фамилия" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ml-form-field">
                                        <input <? /*value="email@email.com"*/?> type="text" name="representativeFirstName"
                                            placeholder="Имя" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="ml-form-field">
                                        <input <? /*value="email@email.com"*/?> type="text" name="representativeMiddleName"
                                            placeholder="Отчество" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-form-field">
                            <label class="ml-form-field__label" for="fcr-participantAge">Возраст участника</label>
                            <input <? /*value="email@email.com"*/?> id="fcr-participantAge" type="text"
                                name="participantAge" placeholder="Возраст" required>
                        </div>
                        <div class="ml-form-field">
                            <label class="ml-form-field__label" for="fcr-phone">Номер телефона (для связи с законным
                                представителем, победителем</label>
                            <input <? /*value="email@email.com"*/?> id="fcr-phone" type="tel" name="phone"
                                placeholder="Телефон" required>
                        </div>
                        <div class="ml-form-field">
                            <label class="ml-form-field__label" for="fcr-email">Email (для связи с законным представителем,
                                победителем)</label>
                            <input <? /*value="email@email.com"*/?> id="fcr-email" type="text" name="email"
                                placeholder="Email" required>
                            <? /*?>
                             <input id="fcr-email" type="email" name="email" placeholder="Email" required>
                             <?*/?>
                        </div>
                        <div class="ml-form-field">
                            <label class="ml-form-field__label" for="fcr-city">Город участника</label>
                            <input <? /*value="email@email.com"*/?> id="fcr-city" type="text" name="city"
                                placeholder="Город" required>
                        </div>
                        <div class="ml-form-field">
                            <label class="ml-form-field__label" for="fcr-desc">Описание работы</label>
                            <textarea id="fcr-desc" name="desc"
                                placeholder="Описание"><? /*value="email@email.com"*/?></textarea>
                        </div>
                        <div class="ml-form-field">
                            <p class="ml-form-field__label">Фото работы</p>
                            <div class="ml-dropzone ml-dropzone_required js-ml-dropzone-contest-reg"
                                id="contest-registration-dropzone" data-error="Необходимо загрузить фото работы">
                                <div class="ml-dropzone-desc"><span class="color_dark-blue">Перетащите файл сюда или <span
                                            class="color_orange">выберите файл</span></span><span
                                        class="color_grey">Допустимый формат JPEG, JPG, PNG, вес до 10 мб</span></div>
                                <div class="fallback">
                                    <input type="file" name="file" id="js-file" accept=".jpg, .jpeg, .png" />
                                </div>
                            </div>
                        </div>
                        <div class="ml-form-field">
                            Согласно законадательству участниками конкурса могут быть только граждане РФ
                        </div>
                        <div class="ml-form-section ml-form-section-checkboxes">
                            <div class="ml-form-field ml-agreement-checkbox">
                                <input id="fcr-personal-data-processing-agreement" name="personalDataProcessing"
                                    type="checkbox" <?/*?>checked<?*/?> required
                                    data-error="Необходимо дать согласие на обработку персональных данных">
                                <label for="fcr-personal-data-processing-agreement"><span>Согласие на обработку персональных
                                        данных</span></label>
                                <p>Согласие на обработку <a href="<?= $arResult["URL_PRIVACY_POLICY"] ?>"
                                        target="_blank">персональных данных</a>
                                </p>
                            </div>
                            <div class="ml-form-field ml-agreement-checkbox">
                                <input id="fcr-сontest-rules-agreement" name="contestRules" type="checkbox" 
                                <?/*?>checked<?*/?> required
                                    data-error="Необходимо согласиться с правилами конкурса">
                                <label for="fcr-сontest-rules-agreement"><span>Согласие с правилами конкурса</span></label>
                                <p>Согласие с <a href="<?= $arResult["arContest"]["URL_TO_CONDITIONS"]; ?>"
                                        target="_blank">правилами конкурса</a>
                                </p>
                            </div>
                            <div class="ml-form-field ml-agreement-checkbox">
                                <input id="fcr-subscribe" name="subscribe" type="checkbox" <?/*?>checked<?*/?>>
                                <label for="fcr-subscribe"><span>Подписаться на нашу рассылку</span></label>
                                <p>Подписаться на нашу рассылку</p>
                            </div>
                        </div>
                        <div id="<?= $arResult["MODAL_DIV_ID"]; ?>-error" style="display: none; color: red;">
                        </div>
                        <div><br /></div>
                    </div>
                    <div class="ml-form__footer">
                        <button id="contest_reg_button" name="contest_reg_button" type="submit"
                            class="ml-btn ml-btn_round ml-btn_submit_contest_reg ml-btn_anim-submit"
                            data-start-text="Зарегистрироваться" data-proccessing-text="Регистрация участника"
                            data-complete-text="Участник зарегистрирован"><span>Зарегистрироваться</span></button>
                    </div>
                </form>
            <?
            }
            ?>
        </div>
    </div>
</div>

<?
if ($arResult["REG_EXIST"] != "Y") {
    ?>
    <div class="ml-modal ml-modal-success modal-upload-work-success" id="<?= $arResult["MODAL_DIV_ID"]; ?>-success">
        <div class="ml-modal__overlay"></div>
        <div class="ml-modal__dialog">
            <div class="ml-modal__header">
                <h3 class="ml-modal__title">Ваша заявка успешно отправлена</h3>
                <button class="ml-modal__close" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <? /* ?>
     <div class="ml-modal ml-modal-success modal-upload-work-success" id="<?= $arResult["MODAL_DIV_ID"]; ?>-error">
     <div class="ml-modal__overlay"></div>
     <div class="ml-modal__dialog">
     <div class="ml-modal__header">
     <h3 class="ml-modal__title">При отправке заявки возникли ошибки</h3>
     <div id="<?= $arResult["MODAL_DIV_ID"]; ?>-error-container"></div>
     <button class="ml-modal__close" type="button">
     <svg class="icon icon-close ">
     <use xlink:href="#close"></use>
     </svg>
     </button>
     </div>
     </div>
     </div>
     <? */?>
    <div class="ml-modal ml-modal-contest-auth" id="modal-contest-auth">
        <div class="ml-modal__overlay"></div>
        <div class="ml-modal__dialog">
            <div class="ml-modal__header">
                <h3 class="ml-modal__title">Регистрация</h3>
                <button class="ml-modal__close" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="#close"></use>
                    </svg>
                </button>
            </div>
            <div class="ml-modal__body">
                <p>Чтобы принять участие в конкурсе, нужно авторизоваться.</p>
            </div>
            <div class="ml-modal__footer">
                <button class="ml-btn ml-btn_round" type="button" data-modal="#modal-auth">Авторизоваться</button>
            </div>
        </div>
    </div>
<?
}
?>