<?

use Bitrix\Iblock\PropertyIndex\Indexer;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<section class="dp-section dp-stat-section">
    <div class="container">
        <div class="dp-section__header">
            <h2 class="dp-section__title">Ваша статистика</h2>
        </div>
        <div class="dp-section__body">
            <div class="dp-stat">
                <ul class="dp-stat__list">
                    <li class="dp-stat__item">
                        <span class="dp-stat__number"><?= $arResult['DIGITS']['ARTICLES']['COUNT']; ?></span>
                        <span class="dp-stat__desc"><?= Indexis::num2word($arResult['DIGITS']['ARTICLES']['COUNT'], ['статья была <br>прочитана вами', 'статьи было <br>прочитано вами', 'статей было <br>прочитано вами'], false); ?></span>
                    </li>
                    <li class="dp-stat__item">
                        <span class="dp-stat__number"><?= $arResult['DIGITS']['WEBINARS']['COUNT']; ?></span>
                        <span class="dp-stat__desc"><?= Indexis::num2word($arResult['DIGITS']['WEBINARS']['COUNT'], ['запись вебинара <br>просмотрена', 'записи вебинаров <br>просмотрено', 'записей вебинаров <br>просмотрено'], false); ?></span>
                    </li>
                    <?/*?>
                        <li class="dp-stat__item"><span class="dp-stat__number">2</span><span class="dp-stat__desc">вебинара <br>вы посетили онлайн</span></li>
                        <?*/ ?>
                </ul>
            </div>
        </div>
    </div>
</section>