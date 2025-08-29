<?
$currentPage = urlencode("https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
?>
<div class="social-nav social-nav_style_secondary">
    <div class="social-nav__caption">Поделиться:
    </div>
    <ul class="social-nav__list">
        <li class="social-nav__item">
            <a class="social-nav__link" href="https://t.me/share/url?url=<?=$currentPage?>" target="_blank" aria-label="telegram">
                <svg class="social-nav__icon">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/icon.svg#icon_telegram"></use>
                </svg>
                <span class="social-nav__name">telegram</span>
            </a>
        </li>
        <li class="social-nav__item">
            <a class="social-nav__link" href="https://vk.com/share.php?url=<?=$currentPage?>" target="_blank" aria-label="vk">
                <svg class="social-nav__icon">
                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/assets/images/icon.svg#icon_vk"></use>
                </svg>
                <span class="social-nav__name">vk</span>
            </a>
        </li>
    </ul>
</div>