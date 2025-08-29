<?$random = md5(microtime().rand(0, PHP_INT_MAX));?>
<div class="form-control">
    <div class="form-control__holder">
        <div class="form-control__check-group">
            <div class="form-control__check-item">
                <!-- begin .check-elem-->
                <div class="check-elem">
                    <input
                            id="<?=$random?>"
                            class="check-elem__input js-disabling-checkbox"
                            type="checkbox"
                            required="required"
                            checked="checked"
                    />
                    <label for="<?=$random?>" class="check-elem__label">
                        Даю согласие на обработку
                        <a class="link" href="<?=PERSONAL_DATA_LINK?>" target="_blank">
                            персональных данных
                        </a>
                    </label>
                </div>
                <!-- end .check-elem-->
            </div>
        </div>
        <div class="form-control__messages">
            <div style="display: none" class="form-control__message form-control__message_style_error">
                Дайте согласие на обработку персональных данных
            </div>
        </div>
    </div>
</div>