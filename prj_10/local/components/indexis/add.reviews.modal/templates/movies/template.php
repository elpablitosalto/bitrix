<?php use Bitrix\Main\Localization\Loc; ?>


<button class="add_review_in_movie js--add_review_in_movie ml-btn ml-btn_round ml-btn_orange ml-section-btn" type="button" data-modal="#modal-review">
    <?=Loc::getMessage('ADD_REVIEWS_BUTTON')?>
</button>


<div class="ml-modal ml-modal-review ml-modal_active" id="modal-review">
    <div class="ml-modal__overlay"></div>
    <div class="ml-modal__dialog">
        <div class="ml-modal__header">
            <h3 class="ml-modal__title">
                <?=Loc::getMessage('TITLE_FORM')?>
            </h3>
            <button class="ml-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
        </div>
        <div class="ml-modal__body">
            <form class="ml-form ml-form-review js-ml-form-review js--form_modal_add_review" id="form-review" method="post">
                <div class="ml-form__body">
                    <div class="ml-form-field">
                        <textarea id="text_area_review_text" name="review_text" placeholder="<?=Loc::getMessage('PLACEHOLDER_TEXTAREA')?>"></textarea>

                        <input type="hidden" id="user_id" name="user_id" value="<?=$arParams['USER_ID']?>">
                        <input type="hidden" id="movie_id" name="movie_id" value="<?=$arParams['MOVIED_ID']?>">
                        <input type="hidden" id="iblock_id" name="iblock_id" value="<?=$arParams['IBLOCK_ID']?>">
                    </div>
                </div>

                <div class="ml-form__footer">
                    <button class="ml-btn ml-btn_round ml-btn_submit1 ml-btn_anim-submit1"
                            type="submit" data-start-text="<?=Loc::getMessage('SEND_REVIEW')?>"
                            data-proccessing-text="<?=Loc::getMessage('PROCESS_SEND_REVIEW')?>"
                            data-complete-text="<?=Loc::getMessage('SUCCESS_SEND_REVIEW')?>"
                    >
                        <span>
                            <?=Loc::getMessage('SEND_REVIEW') ?>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="ml-modal ml-modal-success modal-review-success" id="modal-review-success">
    <div class="ml-modal__overlay"></div>
    <div class="ml-modal__dialog">
        <div class="ml-modal__header">
            <h3 class="ml-modal__title">
                <?=Loc::getMessage('SUCCESS_SEND_REVIEW_MESSAGE')?>
            </h3>
            <button class="ml-modal__close" type="button">
                <svg class="icon icon-close ">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
        </div>
    </div>
</div>





