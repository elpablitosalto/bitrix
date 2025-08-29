<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="search__filters">
    <!-- begin .link-filter-->
    <div class="link-filter undefined js-link-filter">
        <ul class="link-filter__list">
            <? foreach ($arResult["GROUPS"] as $key => $group) : ?>
                <? if ($group["ITEMS"]) : ?>
                    <li class="link-filter__item">
                        <a class="link-filter__link
								<? if ($group["CODE"] == $arResult["TYPE"]) echo "link-filter__link_state_active" ?>" href="<?= $group["URL"] ?>">
                            <?= $group["NAME"] ?>
                        </a>
                    </li>
                <? endif; ?>
            <? endforeach; ?>

        </ul>
    </div>
    <!-- end .link-filter-->
</div>