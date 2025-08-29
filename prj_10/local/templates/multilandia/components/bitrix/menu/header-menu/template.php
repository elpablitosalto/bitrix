<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):
    global $USER;
    $arUserGroups = [];
    if ($USER->IsAuthorized()) {
        #Получаем группы пользователя
        $arUserGroups = CUser::GetUserGroup($USER->GetID());
    }
    ?>
    <ul class="ml-header-menu__list">
        <?foreach($arResult as $arItem):
            if ($arItem['PARAMS']['user_group'] && $arUserGroups) {
                if (!in_array($arItem['PARAMS']['user_group'], $arUserGroups)) {
                    continue;
                }
            } else if ($arItem['PARAMS']['user_group'] && !$arUserGroups) {
                continue;
            }

            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
            <li class="ml-header-menu__item">
                <a class="ml-header-menu__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </li>
        <?endforeach?>
    </ul>
    <div class="ml-header-menu-dropdown">
        <button class="ml-header-menu-dropdown__btn" type="button"><?=GetMessage('HEADER_MENU_MORE')?></button>
        <ul class="ml-header-menu-dropdown__list">
            <?foreach($arResult as $arItem):
                if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <li class="ml-header-menu-dropdown__item">
                    <a class="ml-header-menu-dropdown__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                </li>
            <?endforeach?>
        </ul>
    </div>
<?endif?>