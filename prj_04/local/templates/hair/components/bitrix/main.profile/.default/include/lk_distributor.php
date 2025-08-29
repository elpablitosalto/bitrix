<?

use Hair\General;

$arUser = $arResult['arUser'];
$arUserProps = $arResult['USER_PROPERTIES']['DATA'];
?>
<div class="personal-menu">
    <div data-tab="personal-data" class="personal-menu__item _active">ПЕРСОНАЛЬНЫЕ ДАННЫЕ</div>
    <div data-tab="team" class="personal-menu__item">МЕНЕДЖЕРЫ «CONCEPT»</div>
    <div data-tab="news" class="personal-menu__item">НОВОСТИ</div>
    <div onclick="javascript:location.href='/downloads/'" class="personal-menu__item">СКАЧИВАЕМАЯ ИНФОРМАЦИЯ</div>
    <div data-tab="materials" class="personal-menu__item">МАРКЕТИНГОВЫЕ МАТЕРИАЛЫ</div>
    <div data-tab="ask" class="personal-menu__item">Задать вопрос</div>
    <div data-tab="get-order" class="personal-menu__item">Сделать заказ</div>
</div>
<div class="personal-content">
    <div class="personal-content__item _personal-data _active" data-tab="personal-data">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595" />
            </svg>
            <span>Назад в меню</span>
        </a>
        <p class="personal-mobile-title">ПЕРСОНАЛЬНЫЕ ДАННЫЕ</p>
        <? if (empty($arUser['WORK_COMPANY'])) : ?>
            <div class="personal-content__item-row _empty-data">
                <h3><?= $arUser['LAST_NAME'] . ' ' . $arUser['NAME'] ?></h3>
                <p class="subtitle">Заполните информацию о работе</p>
                <p>Заполните данные вашего магазина/бренда и мы сможем показать информацию на карте наших партнеров в вашем городе, где ее увидят ваши потенциальные клиенты!</p>
                <a href="#" class="button _empty _free-size" data-edit-button="personal-info">Заполнить данные</a>
            </div>
        <? else : ?>
            <div class="personal-content__item-row _edit" data-show-block="personal-info">
                <div class="personal-content__item-row--header">
                    <h3>ИНФОРМАЦИЯ О КОМПАНИИ</h3>
                    <a href="#" class="edit-link" data-edit-button="personal-info">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7279 7.24183L16.8014 4.30042C16.608 4.10801 16.3463 4 16.0735 4C15.8007 4 15.539 4.10801 15.3457 4.30042L4.97094 14.6602L4.0237 18.7482C3.99103 18.8977 3.99215 19.0525 4.02698 19.2015C4.06182 19.3504 4.12949 19.4897 4.22505 19.6092C4.32061 19.7286 4.44165 19.8252 4.57932 19.8919C4.71699 19.9586 4.86782 19.9937 5.02079 19.9946C5.09207 20.0018 5.16389 20.0018 5.23517 19.9946L9.3681 19.0474L19.7279 8.69758C19.9203 8.5042 20.0283 8.2425 20.0283 7.9697C20.0283 7.69691 19.9203 7.43521 19.7279 7.24183ZM8.86956 18.15L4.99587 18.9626L5.87829 15.1637L13.6406 7.43128L16.6319 10.4225L8.86956 18.15ZM17.2999 9.69966L14.3087 6.70839L16.0436 4.98342L18.985 7.97469L17.2999 9.69966Z" fill="#3333CC" />
                        </svg>
                    </a>
                </div>
                <div class="personal-content__item-row--content">
                    <div class="showed-info user-info">
                        <div class="showed-info__column">
                            <? $userPic = CFile::GetPath($arUser['PERSONAL_PHOTO']) ?>
                            <!--                            --><? //$userPic = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>72, 'height'=>72), BX_RESIZE_IMAGE_EXACT, true);
                                                                ?>
                            <!--                            <img src="--><? //=$userPic
                                                                            ?><!--" alt="--><? //=$userPic
                                                                                                        ?><!--" title="--><? //=$userPic
                                                                                                                                        ?><!--"  />-->
                            <div class="user-info__pic"><img src="<?= $userPic ?>" /></div>
                        </div>
                        <div class="showed-info__column">
                            <p class="user-info__name"><?= $arUser['LAST_NAME'] . ' ' . $arUser['NAME'] ?></p>
                            <? if (!empty($arUser['WORK_POSITION'])) : ?><p><?= $arUser['WORK_POSITION'] ?></p><? endif; ?>
                        </div>
                    </div>
                    <div class="showed-info company-info">
                        <!--                        <p class="_blue">--><? //=$arUserProps['UF_BRAND_NAME']['VALUE']
                                                                        ?><!--</p>-->
                        <p><?= $arUser['WORK_COMPANY'] ?></p>
                        <? if ($arUser['WORK_PHONE']) : ?>
                            <a href="tel:<?= General::formatPhone($arUser['WORK_PHONE']) ?>" class="phone-link"><?= $arUser['WORK_PHONE'] ?></a>
                        <? endif; ?>
                        <? if (!empty($arUserProps['UF_ADDRESS']['VALUE'])) { ?>
                            <? foreach ($arUserProps['UF_ADDRESS']['VALUE'] as $adressItem) : ?>
                                <a href="#" class="location-link disabled"><?= $adressItem ?></a>
                            <? endforeach; ?>
                        <? } ?>
                    </div>
                    <? if (!empty($arUserProps['UF_PHOTOS']['VALUE'])) : ?>
                        <section class="images-list">
                            <? foreach ($arUserProps['UF_PHOTOS']['VALUE'] as $photoID) : ?>
                                <?
                                $pic = CFile::ResizeImageGet($photoID, array('width' => 72, 'height' => 72), BX_RESIZE_IMAGE_EXACT, true);
                                $picReal = CFile::GetPath($photoID);
                                ?>
                                <a data-image-popup="" href="<?= $picReal ?>"><img src="<?= $pic['src'] ?>" alt="<?= $pic['ALT'] ?>" title="<?= $pic['TITLE'] ?>"></a>
                            <? endforeach; ?>
                        </section>
                    <? endif; ?>
                </div>
            </div>
        <? endif; ?>
        <div class="personal-content__item-row _edit _hidden" data-edit-block="personal-info">
            <div class="personal-content__item-row--header">
                <h3>ИНФОРМАЦИЯ О КОМПАНИИ</h3>
            </div>
            <div class="personal-content__item-row--content">
                <form id="distributor-data" data-personal-form action="/local/ajax/personal/backend.php">
                    <input type="hidden" name="ID" value="<?= $arUser['ID'] ?>">
                    <input type="hidden" name="TYPE" value="distributor">
                    <div class="step">
                        <div class="form-wrapper__item">
                            <label>Юридическое название организации*</label>
                            <input type="text" name="LEGAL_NAME" value="<?= $arUser['WORK_COMPANY'] ?>" required />
                        </div>
                        <div class="form-wrapper__item">
                            <label>Название бренда/магазина*</label>
                            <input type="text" name="BRAND_NAME" value="<?= $arUserProps['UF_BRAND_NAME']['VALUE'] ?>" required />
                        </div>
                        <div class="form-wrapper__item">
                            <label>Адрес*</label>
                            <div data-address-init-list>
                                <? if (!empty($arUserProps['UF_ADDRESS'])) { ?>
                                    <? foreach ($arUserProps['UF_ADDRESS']['VALUE'] as $key => $value) { ?>
                                        <div class="wrapper-adress-edit" data-address-init-item>
                                            <input type="text" data-address-init name="ADDRESS[]" value="<?= $value ?>" required />
                                            <input type="hidden" data-address-init-geo name="GEO_DATA[]" />
                                            <input type="hidden" name="REGION[]" value="<?= $arUserProps['UF_REGION']['VALUE'][$key] ?>" />
                                            <a href="" data-address-remove class="remove-icon">
                                                <svg width="16" height="16" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.46995 3L6.89995 0.569996C6.95456 0.506228 6.98309 0.424203 6.97985 0.340311C6.97661 0.256419 6.94184 0.176839 6.88247 0.117475C6.82311 0.0581097 6.74353 0.0233321 6.65963 0.0200917C6.57574 0.0168513 6.49372 0.0453868 6.42995 0.0999956L3.99995 2.53L1.56995 0.0966622C1.50618 0.0420534 1.42416 0.0135182 1.34027 0.0167586C1.25637 0.019999 1.17679 0.0547763 1.11743 0.114141C1.05806 0.173506 1.02329 0.253086 1.02005 0.336978C1.01681 0.42087 1.04534 0.502895 1.09995 0.566662L3.52995 3L1.09662 5.43C1.06172 5.45988 1.03338 5.49665 1.01338 5.53801C0.993368 5.57936 0.982124 5.6244 0.980351 5.67031C0.978578 5.71622 0.986313 5.762 1.00307 5.80477C1.01983 5.84755 1.04525 5.88639 1.07773 5.91888C1.11022 5.95136 1.14907 5.97678 1.19184 5.99354C1.23462 6.0103 1.2804 6.01803 1.3263 6.01626C1.37221 6.01449 1.41725 6.00325 1.45861 5.98324C1.49996 5.96323 1.53673 5.93489 1.56662 5.9L3.99995 3.47L6.42995 5.9C6.49372 5.9546 6.57574 5.98314 6.65963 5.9799C6.74353 5.97666 6.82311 5.94188 6.88247 5.88252C6.94184 5.82315 6.97661 5.74357 6.97985 5.65968C6.98309 5.57579 6.95456 5.49376 6.89995 5.43L4.46995 3Z" fill="#282323"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    <? } ?>
                                <? } else { ?>
                                    <div data-address-init-item>
                                        <input type="text" data-address-init name="ADDRESS[]" value="" required />
                                        <input type="hidden" data-address-init-geo name="GEO_DATA[]" />
                                    </div>
                                <? } ?>
                            </div>
                            <a href="" data-address-add>+ Добавить еще</a>
                        </div>
                        <?/*?><div class="form-wrapper__item">
                            <label>Контактный телефон бренда/магазина*</label>
                            <input type="phone" name="PHONE" value="<?=$arUser['WORK_PHONE']?>" required/>
                            <span>Телефон введен не корректно</span>
                        </div><?*/ ?>
                        <div class="form-wrapper__item">
                            <label>Сайт бренда/магазина*</label>
                            <input type="text" name="SITE" value="<?= $arUser['WORK_WWW'] ?>" required />
                            <span>Сайт введен не корректно</span>
                        </div>
                        <div class="form-wrapper__item form-wrapper__item-file">
                            <input type="file" name="SALON_LOGO" accept="image/png, image/gif, image/jpeg">
                            <span><?= ($arUser['PERSONAL_PHOTO'] ? 'Изменить' : 'Добавить') ?> логотип</span>
                        </div>
                        <div class="form-wrapper__item">
                            <p>Загрузите фотографии салона</p>
                            <div id="aks-file-upload"></div>
                            <div class="preview-upload">
                                <? if (!empty($arUserProps['UF_PHOTOS']['VALUE'])) : ?>
                                    <input type="hidden" name="PHOTOS_TO_DELETE" />
                                    <? foreach ($arUserProps['UF_PHOTOS']['VALUE'] as $photoID) : ?>
                                        <input type="hidden" name="UF_PHOTOS_exists[]" value="<?= $photoID ?>">
                                        <?
                                        $pic = CFile::ResizeImageGet($photoID, array('width' => 72, 'height' => 72), BX_RESIZE_IMAGE_EXACT, true);
                                        $picReal = CFile::GetPath($photoID);
                                        ?>
                                        <div data-file="img-<?= $photoID ?>" data-exist="Y" data-photo_id="<?= $photoID ?>" class="aks-file-upload-preview">
                                            <div class="aks-file-upload-p-header">
                                                <div class="exist-delete" data-delete="img-<?= $photoID ?>"><svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.46995 3L6.89995 0.569996C6.95456 0.506228 6.98309 0.424203 6.97985 0.340311C6.97661 0.256419 6.94184 0.176839 6.88247 0.117475C6.82311 0.0581097 6.74353 0.0233321 6.65963 0.0200917C6.57574 0.0168513 6.49372 0.0453868 6.42995 0.0999956L3.99995 2.53L1.56995 0.0966622C1.50618 0.0420534 1.42416 0.0135182 1.34027 0.0167586C1.25637 0.019999 1.17679 0.0547763 1.11743 0.114141C1.05806 0.173506 1.02329 0.253086 1.02005 0.336978C1.01681 0.42087 1.04534 0.502895 1.09995 0.566662L3.52995 3L1.09662 5.43C1.06172 5.45988 1.03338 5.49665 1.01338 5.53801C0.993368 5.57936 0.982124 5.6244 0.980351 5.67031C0.978578 5.71622 0.986313 5.762 1.00307 5.80477C1.01983 5.84755 1.04525 5.88639 1.07773 5.91888C1.11022 5.95136 1.14907 5.97678 1.19184 5.99354C1.23462 6.0103 1.2804 6.01803 1.3263 6.01626C1.37221 6.01449 1.41725 6.00325 1.45861 5.98324C1.49996 5.96323 1.53673 5.93489 1.56662 5.9L3.99995 3.47L6.42995 5.9C6.49372 5.9546 6.57574 5.98314 6.65963 5.9799C6.74353 5.97666 6.82311 5.94188 6.88247 5.88252C6.94184 5.82315 6.97661 5.74357 6.97985 5.65968C6.98309 5.57579 6.95456 5.49376 6.89995 5.43L4.46995 3Z" fill="#282323"></path>
                                                    </svg></div>
                                            </div>
                                            <main class="aks-file-upload-p-main">
                                                <a data-image-popup href="<?= $picReal ?>" class="aks-file-upload-image"><img src="<?= $pic['src'] ?>" alt="<?= $pic['ALT'] ?>" title="<?= $pic['TITLE'] ?>" /></a>
                                            </main>
                                        </div>
                                    <? endforeach; ?>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="step">
                        <div class="form-wrapper__item">
                            <button class="button _small" data-save-info="personal-info">Сохранить</button> <!-- для показа/скрытия блоков рулить классом _hidden и смотреть за data-атрибутами -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="personal-content__item-row _edit">
            <div class="personal-content__item-row--header">
                <h3>ИНФОРМАЦИЯ ДЛЯ ВХОДА НА САЙТ</h3>
                <a href="#" class="edit-link" data-edit-button="login-data">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.7279 7.24183L16.8014 4.30042C16.608 4.10801 16.3463 4 16.0735 4C15.8007 4 15.539 4.10801 15.3457 4.30042L4.97094 14.6602L4.0237 18.7482C3.99103 18.8977 3.99215 19.0525 4.02698 19.2015C4.06182 19.3504 4.12949 19.4897 4.22505 19.6092C4.32061 19.7286 4.44165 19.8252 4.57932 19.8919C4.71699 19.9586 4.86782 19.9937 5.02079 19.9946C5.09207 20.0018 5.16389 20.0018 5.23517 19.9946L9.3681 19.0474L19.7279 8.69758C19.9203 8.5042 20.0283 8.2425 20.0283 7.9697C20.0283 7.69691 19.9203 7.43521 19.7279 7.24183ZM8.86956 18.15L4.99587 18.9626L5.87829 15.1637L13.6406 7.43128L16.6319 10.4225L8.86956 18.15ZM17.2999 9.69966L14.3087 6.70839L16.0436 4.98342L18.985 7.97469L17.2999 9.69966Z" fill="#3333CC" />
                    </svg>
                </a>
            </div>
            <div class="personal-content__item-row--content">
                <div class="showed-info">
                    <div class="showed-info__column">
                        <p class="label">E-mail:</p>
                        <p class="label">Телефон:</p>
                        <p class="label">Город:</p>
                    </div>
                    <div class="showed-info__column">
                        <p><?= $arUser['EMAIL'] ?></p>
                        <p><?= $arUser['PERSONAL_PHONE'] ?></p>
                        <p><?= $arUser['PERSONAL_CITY'] ?></p>
                    </div>
                </div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:socserv.auth.split",
                    "hair",
                    array(
                        "ALLOW_DELETE" => "N",
                        "SHOW_PROFILES" => "Y"
                    )
                ); ?>
            </div>
        </div>
        <div class="personal-content__item-row _edit _hidden" data-edit-block="login-data">
            <div class="personal-content__item-row--header">
                <h3>ИНФОРМАЦИЯ О САЛОНЕ</h3>
            </div>
            <div class="personal-content__item-row--content">
                <form id="personal-data" data-personal-form action="/local/ajax/personal/backend.php">
                    <div class="step">
                        <div class="form-wrapper__item">
                            <label>E-mail*</label>
                            <input type="text" name="EMAIL" value="<?= $arUser['EMAIL'] ?>" required />
                            <span class="error">E-mail введен не корректно, используйте @</span>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Телефон*</label>
                            <input type="phone" name="PHONE" value="<?= $arUser['PERSONAL_PHONE'] ?>" required />
                            <span class="error">E-mail введен не корректно, используйте @</span>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Пароль*</label>
                            <input type="password" name="PASS" value="" required />
                            <span class="error">E-mail введен не корректно, используйте @</span>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Город*</label>
                            <input type="text" name="CITY" value="<?= $arUser['PERSONAL_CITY'] ?>" required />
                            <span class="error">E-mail введен не корректно, используйте @</span>
                            <label class="form-wrapper__item-comment">Город, в котором вы находитесь, для того, чтобы мы смогли показать вам новости/скидки/семинары вашего города и региона</label>
                        </div>
                    </div>
                    <div class="step">
                        <div class="form-wrapper__item">
                            <button class="button _small" data-save-info="login-data">Сохранить</button> <!-- для показа/скрытия блоков рулить классом _hidden и смотреть за data-атрибутами -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="personal-content__item" data-tab="team">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595" />
            </svg>
            <span>Назад в меню</span>
        </a>
        <div class="personal-content__item-row _managers">
            <div class="personal-content__item-row--header">
                <h3 class="_blue">МЕНЕДЖЕРЫ «CONCEPT»</h3>
            </div>
            <div class="personal-content__item-row--content">
                <div class="representatives-wrapper">
                    <?
                    global $arTeamFilter;
                    $arTeamFilter['SECTION_ID'] = 74; //ID раздела менеджеров
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "our_team.personal",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "ID",
                                1 => "CODE",
                                2 => "PREVIEW_PICTURE",
                                3 => "DETAIL_PICTURE",
                                4 => "",
                            ),
                            "FILTER_NAME" => "arTeamFilter",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "9",
                            "IBLOCK_TYPE" => "content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "0",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "EMAIL",
                                1 => "POSITION",
                                2 => "PHONE",
                                3 => "",
                                4 => "",
                                5 => "",
                                6 => "",
                                7 => "",
                            ),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N",
                            "COMPONENT_TEMPLATE" => "our_team.page"
                        ),
                        false
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="personal-content__item" data-tab="news">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595" />
            </svg>
            <span>Назад в меню</span>
        </a>
        <h3 class="_blue">МЕРОПРИЯТИЯ В ВАШЕМ РЕГИОНЕ</h3>
        <div class="personal-news">
            <? if (empty($arResult['EVENTS'])) : ?>
                <p>В вашем ргеионе нет запланированных мероприятий</p>
            <? else : ?>
                <? foreach ($arResult['EVENTS'] as $arItem) : ?>
                    <? $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 285, 'height' => 240), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                    <div class="personal-news__item">
                        <div class="personal-news__item-illustration">
                            <img src="<?= $pic['src'] ?>" alt role="presentation" class="personal-news__item-image">
                        </div>
                        <div class="personal-news__item--content">
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="personal-news__item-title"><?= $arItem['NAME'] ?></a>
                            <p class="personal-news__item-date"><?= FormatDate('j F Y года', strtotime($arItem['ACTIVE_FROM'])) ?></p>
                            <p class="personal-news__item-text"><?= $arItem['PREVIEW_TEXT'] ?></p>
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="button _empty">Подробнее</a>
                        </div>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
        </div>
        <h3 class="_blue">ДРУГИЕ НОВОСТИ</h3>
        <div class="personal-news">
            <? if (empty($arResult['NEWS'])) : ?>
                <p>В вашем регионе нет интересующих вас новостей</p>
            <? else : ?>
                <? foreach ($arResult['NEWS'] as $arItem) : ?>
                    <? $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 285, 'height' => 240), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                    <div class="personal-news__item">
                        <div class="personal-news__item-illustration">
                            <img src="<?= $pic['src'] ?>" alt role="presentation" class="personal-news__item-image">
                        </div>
                        <div class="personal-news__item--content">
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="personal-news__item-title"><?= $arItem['NAME'] ?></a>
                            <p class="personal-news__item-date"><?= FormatDate('j F Y года', strtotime($arItem['ACTIVE_FROM'])) ?></p>
                            <p class="personal-news__item-text"><?= $arItem['PREVIEW_TEXT'] ?></p>
                            <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="button _empty">Подробнее</a>
                        </div>
                    </div>
                <? endforeach; ?>
            <? endif; ?>
        </div>
    </div>
    <div class="personal-content__item" data-tab="download">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595" />
            </svg>
            <span class="level-1">Назад в меню</span>
            <span class="level-2">Назад</span>
        </a>
        <div class="slide-toggle-container">
            <div class="slide-toggle-buttons">
                <? foreach ($arResult['DOWNLOADS'] as $k => $mainSection) : ?>
                    <div class="slide-toggle-buttons__item" data-download-tab="<?= $k ?>"><?= $mainSection['NAME'] ?></div>
                <? endforeach; ?>
            </div>
            <div class="slide-toggle-content">
                <? foreach ($arResult['DOWNLOADS'] as $k => $mainSection) : ?>
                    <div class="slide-toggle-content_wrapper" data-download-content="<?= $k ?>">
                        <? foreach ($mainSection['SECTIONS'] as $sID => $sectionArr) : ?>
                            <div class="slide-toggle-content__item slide-toggle-content__item--level-1">
                                <div class="slide-toggle-content__item-button"><?= $sectionArr['NAME'] ?></div>
                                <div class="slide-toggle-content__item-content">
                                    <div class="slide-toggle-content__item-content--list">
                                        <? foreach ($sectionArr['FILES'] as $fID => $fileArr) : ?>
                                            <a target="_blank" href="<?= $fileArr['PATH'] ?>"><?= $fileArr['NAME'] ?></a>
                                        <? endforeach; ?>
                                    </div>
                                    <div class="slide-toggle-content__item slide-toggle-content__item--level-2">
                                        <div class="slide-toggle-content__item-button">Продукты</div>
                                        <div class="slide-toggle-content__item-content">
                                            <div class="slide-toggle-content__item slide-toggle-content__item--level-3">
                                                <? foreach ($sectionArr['PRODUCTS'] as $pID => $pArr) : ?>
                                                    <div class="slide-toggle-content__item-button"><?= $pArr['NAME'] ?></div>
                                                    <div class="slide-toggle-content__item-content">
                                                        <div class="slide-toggle-content__item-content--list">
                                                            <? foreach ($pArr['FILES'] as $fID => $fileArr) : ?>
                                                                <a target="_blank" href="<?= $fileArr['PATH'] ?>"><?= $fileArr['NAME'] ?></a>
                                                            <? endforeach; ?>
                                                        </div>
                                                    </div>
                                                <? endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <div class="personal-content__item" data-tab="materials">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595" />
            </svg>
            <span>Назад в меню</span>
        </a>
        <div class="personal-content__item-row">
            <div class="personal-content__item-row--header">
                <h3 class="_blue">ВЫ МОЖЕТЕ СКАЧАТЬ ИНФОРМАЦИЮ</h3>
            </div>
            <div class="personal-content__item-row--content">
                <div class="links-list">
                    <? foreach ($arResult['MARKETING_MATERIALS'] as $file) : ?>
                        <? $type = (!empty($file['PROPERTY_MATERIAL_FORMAT_VALUE'])) ? $file['PROPERTY_MATERIAL_FORMAT_VALUE'] : 'download' ?>
                        <a href="<?= CFile::GetPath($file['PROPERTY_FILE_VALUE']) ?>" class="<?= $type ?>-link" target="_blank"><?= $file['NAME'] ?></a>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="personal-content__item" data-tab="ask">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595" />
            </svg>
            <span>Назад в меню</span>
        </a>
        <div class="personal-content__item-row">
            <div class="personal-content__item-row--content">
                <form action="/local/ajax/forms/distributorsAsk.php" data-personal-form>
                    <div class="step">
                        <div class="form-wrapper__item">
                            <select name="QUESTION_FOR">
                                <option>Выберите...</option>
                                <option value="Вопрос по продукту">Вопрос по продукту</option>
                                <option value="Вопрос по технологиям">Вопрос по технологиям</option>
                                <option value="Вопрос по продажам">Вопрос по продажам</option>
                                <option value="Прочие вопросы">Прочие вопросы</option>
                            </select>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Ваше сообщение*</label>
                            <textarea name="MESSAGE"></textarea>
                        </div>
                    </div>
                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => "/local/include/capcha.php",
                            "AREA_FILE_RECURSIVE" => "N",
                            "EDIT_MODE" => "html",
                        ),
                        false,
                        array('HIDE_ICONS' => 'Y')
                    );
                    ?>
                    <div class="step">
                        <div class="form-wrapper__item">
                            <button class="button _small" data-save-info="personal-info">Отправить</button> <!-- для показа/скрытия блоков рулить классом _hidden и смотреть за data-атрибутами -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="personal-content__item" data-tab="get-order">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595" />
            </svg>
            <span>Назад в меню</span>
        </a>
        <div class="personal-content__item-row _product-order">
            <div class="personal-content__item-row--content">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "personal.order",
                    array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "ID",
                            1 => "CODE",
                            2 => "PREVIEW_PICTURE",
                            3 => "DETAIL_PICTURE",
                            4 => "",
                        ),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => CATALOG,
                        "IBLOCK_TYPE" => "catalog",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "0",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "EMAIL",
                            1 => "POSITION",
                            2 => "PHONE",
                            3 => "",
                            4 => "",
                            5 => "",
                            6 => "",
                            7 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "DESC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N",
                        "COMPONENT_TEMPLATE" => "our_team.page"
                    ),
                    false
                );
                ?>
            </div>
        </div>
    </div>
</div>