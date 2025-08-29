<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?
// Отзыв -->
?>
<div class="dp-modal dp-review-detail-modal" id="review-detail">
    <div class="dp-modal__overlay"></div>
    <div class="dp-modal__dialog">
        <button class="dp-modal__close" type="button">
            <svg class="icon icon-cross" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.1003 10.1006L29.8993 29.8996" />
                <path d="M10.1003 29.8994L29.8993 10.1004" />
            </svg>
        </button>
        <div class="dp-modal__header">
            <p class="dp-modal__title js_review_full_name"></p>
            <p class="dp-modal__desc js_review_full_about"></p>
        </div>
        <div class="dp-modal__body js_review_full_text">
        </div>
    </div>
</div>
<?
// <-- Отзыв
?>