<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="ml-social-auth">
    <ul class="ml-social-auth__list">
        <? foreach($arParams["~AUTH_SERVICES"] as $service): ?>
            <li class="ml-social-auth__item js--hidden_popup_after_auth_social">
                <a class="ml-social-auth__link"
                   href="javascript:void(0)"
                   title="<?=htmlspecialcharsbx($service["NAME"])?>"
                   <? /* onclick="BxShowAuthFloat('<?=$service["ID"]?>', '<?=$arParams["SUFFIX"]?>')" */?>
                   onclick="<?=$service['ONCLICK']?>"
                >
                    <svg class="icon icon-<?=htmlspecialcharsbx($service["ICON"])?>">
                        <use xlink:href="#<?=htmlspecialcharsbx($service["ICON"])?>"></use>
                    </svg>
                </a>
            </li>
        <? endforeach ?>
    </ul>
</div>
