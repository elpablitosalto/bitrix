<?
    use Hair\General;
    $arUser = $arResult['arUser'];

    $positionsArr = [
        'Ведущий технолог',
        'Технолог'
    ];
?>
<div class="personal-menu">
    <div data-tab="personal-data" class="personal-menu__item _active">ПЕРСОНАЛЬНЫЕ ДАННЫЕ</div>
    <div data-tab="news" class="personal-menu__item">НОВОСТИ</div>
    <div onclick="javascript:location.href='/downloads/'" class="personal-menu__item">СКАЧИВАЕМАЯ ИНФОРМАЦИЯ</div>
    <div data-tab="materials" class="personal-menu__item">МАРКЕТИНГОВЫЕ МАТЕРИАЛЫ</div>
</div>
<div class="personal-content">
    <div class="personal-content__item _personal-data _active" data-tab="personal-data">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595"/>
            </svg>
            <span>Назад в меню</span>
        </a>
        <p class="personal-mobile-title">ПЕРСОНАЛЬНЫЕ ДАННЫЕ</p>
        <?if(empty($arUser['WORK_POSITION'])):?>
            <div class="personal-content__item-row _empty-data">
                <h3><?=$arUser['LAST_NAME'].' '.$arUser['NAME'].' '.$arUser['SECOND_NAME']?></h3>
                <p class="subtitle">Заполните информацию о работе</p>
                <p>Вам необходимо заполнить данные о вашей работе Технологом, для того, чтобы мы смогли связать ваш профиль с вашими материалами и обучающими программами. Также, эти данные помогут в коммуникациях между вами и мастерами и салонами, с которыми вы работаете.</p>
                <a href="#" class="button _empty _free-size" data-edit-button="personal-info">Заполнить данные</a>
            </div>
        <?else:?>
            <div class="personal-content__item-row _edit" data-show-block="personal-info">
                <div class="personal-content__item-row--header">
                    <h3>ИНФОРМАЦИЯ О РАБОТЕ</h3>
                    <a href="#" class="edit-link" data-edit-button="personal-info">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.7279 7.24183L16.8014 4.30042C16.608 4.10801 16.3463 4 16.0735 4C15.8007 4 15.539 4.10801 15.3457 4.30042L4.97094 14.6602L4.0237 18.7482C3.99103 18.8977 3.99215 19.0525 4.02698 19.2015C4.06182 19.3504 4.12949 19.4897 4.22505 19.6092C4.32061 19.7286 4.44165 19.8252 4.57932 19.8919C4.71699 19.9586 4.86782 19.9937 5.02079 19.9946C5.09207 20.0018 5.16389 20.0018 5.23517 19.9946L9.3681 19.0474L19.7279 8.69758C19.9203 8.5042 20.0283 8.2425 20.0283 7.9697C20.0283 7.69691 19.9203 7.43521 19.7279 7.24183ZM8.86956 18.15L4.99587 18.9626L5.87829 15.1637L13.6406 7.43128L16.6319 10.4225L8.86956 18.15ZM17.2999 9.69966L14.3087 6.70839L16.0436 4.98342L18.985 7.97469L17.2999 9.69966Z" fill="#3333CC"/>
                        </svg>
                    </a>
                </div>
                <div class="personal-content__item-row--content">
                    <div class="showed-info user-info _tech">
                        <div class="showed-info__column">
                            <?$userPic = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>183, 'height'=>220), BX_RESIZE_IMAGE_EXACT, true);?>
                            <div class="user-info__pic"><img src="<?=$userPic['src']?>" alt="<?=$userPic['ALT']?>" title="<?=$userPic['TITLE']?>" /></div>
                        </div>
                        <div class="showed-info__column">
                            <p class="user-info__name"><?=$arUser['LAST_NAME'].' '.$arUser['NAME'].' '.$arUser['SECOND_NAME']?></p>
                            <p class="user-info__position"><span>Должность: </span><?=$arUser['WORK_POSITION']?></p>
                            <p class="user-info__position"><?=$arUser['PERSONAL_NOTES']?></p>
                        </div>
                    </div>
                    <p>Дипломы и сертификаты:</p>
                    <section class="swiper-container sertificates">
                        <div class="swiper-wrapper">
                            <?foreach($arUser['UF_PHOTOS'] as $photo):?>
                                <?
                                    $smallPic = CFile::ResizeImageGet($photo, array('width'=>183, 'height'=>262), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                    $fullPic = CFile::GetPath($photo);
                                ?>
                                <a class="swiper-slide" data-image-popup href="<?=$fullPic?>"><img src="<?=$smallPic['src']?>"></a>
                            <?endforeach;?>
                        </div>
                    </section>
<!--                    <a href="#" data-edit-button="personal-info" class="button _empty _free-size">Подтвердить</a>-->
                </div>
            </div>
        <?endif;?>
        <div class="personal-content__item-row _edit _hidden" data-edit-block="personal-info">
            <div class="personal-content__item-row--header">
                <h3>ИНФОРМАЦИЯ О РАБОТЕ</h3>
            </div>
            <div class="personal-content__item-row--content">
                <form id="salon-data" data-personal-form action="/local/ajax/personal/backend.php">
                    <input type="hidden" name="UID" value="<?=$arUser['ID']?>">
                    <input type="hidden" name="TYPE" value="tech">
                    <div class="step">
                        <?$userPic = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>183, 'height'=>220), BX_RESIZE_IMAGE_EXACT, true);?>
                        <div class="form-wrapper__item form-wrapper__item-file<?=($arUser['PERSONAL_PHOTO'] > 0) ? ' _photo' : ''?> " style="background-image:url(<?=$userPic['src']?>)">
                            <input type="file" name="USER_PICTURE">
                            <span>Добавить фото</span>
                        </div>
                        <div class="form-wrapper__item">
                            <label>ФИО*</label>
                            <input type="text" name="NAME" value="<?=$arUser['LAST_NAME'].' '.$arUser['NAME'].' '.$arUser['SECOND_NAME']?>" required/>
                            <span class="error">ФИО введено некорректно</span>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Выберите</label>
                            <select name="POSITION">
                                <option selected>Выберите должность</option>
                                <?foreach($positionsArr as $position):?>
                                    <option value="<?=$position?>" <?=($position == $arUser['WORK_POSITION']) ? 'selected': ''?>><?=$position?></option>
                                <?endforeach;?>
                            </select>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Пара слов о себе</label>
                            <textarea name="NOTES"><?=$arUser['PERSONAL_NOTES']?></textarea>
                        </div>
                        <div class="form-wrapper__item">
                            <p>Загрузить дипломы, сертификаты</p>
                            <div id="aks-file-upload"></div>
                            <div class="preview-upload">
                                <?if(!empty($arUser['UF_PHOTOS'])):?>
                                    <?foreach($arUser['UF_PHOTOS'] as $photoID):?>
                                        <?
                                            $pic = CFile::ResizeImageGet($photoID, array('width'=>72, 'height'=>72), BX_RESIZE_IMAGE_EXACT, true);
                                            $picReal = CFile::GetPath($photoID);
                                        ?>
                                        <div data-file="img-<?=$photoID?>" data-exist="Y" data-photo_id="<?=$photoID?>" class="aks-file-upload-preview _old">
                                            <main class="aks-file-upload-p-main">
                                                <a data-image-popup href="<?=$picReal?>" class="aks-file-upload-image"><img src="<?=$pic['src']?>" alt="<?=$pic['ALT']?>" title="<?=$pic['TITLE']?>"/></a>
                                            </main>
                                        </div>
                                    <?endforeach;?>
                                <?endif;?>
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
                        <path d="M19.7279 7.24183L16.8014 4.30042C16.608 4.10801 16.3463 4 16.0735 4C15.8007 4 15.539 4.10801 15.3457 4.30042L4.97094 14.6602L4.0237 18.7482C3.99103 18.8977 3.99215 19.0525 4.02698 19.2015C4.06182 19.3504 4.12949 19.4897 4.22505 19.6092C4.32061 19.7286 4.44165 19.8252 4.57932 19.8919C4.71699 19.9586 4.86782 19.9937 5.02079 19.9946C5.09207 20.0018 5.16389 20.0018 5.23517 19.9946L9.3681 19.0474L19.7279 8.69758C19.9203 8.5042 20.0283 8.2425 20.0283 7.9697C20.0283 7.69691 19.9203 7.43521 19.7279 7.24183ZM8.86956 18.15L4.99587 18.9626L5.87829 15.1637L13.6406 7.43128L16.6319 10.4225L8.86956 18.15ZM17.2999 9.69966L14.3087 6.70839L16.0436 4.98342L18.985 7.97469L17.2999 9.69966Z" fill="#3333CC"/>
                    </svg>
                </a>
            </div>
            <div class="personal-content__item-row--content">
                <div class="showed-info">
                    <div class="showed-info__column">
                        <p class="label">E-mail: <?=$arUser['EMAIL']?></p>
                        <p class="label">Телефон: <?=$arUser['WORK_PHONE']?></p>
                        <? if($arUser['PERSONAL_CITY']):?><p class="label">Город: <?=$arUser['PERSONAL_CITY']?></p><?endif?>
                    </div>
                </div>
                <div class="showed-info">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:socserv.auth.split",
                        "hair",
                        Array(
                            "ALLOW_DELETE" => "N",
                            "SHOW_PROFILES" => "Y"
                        )
                    );?>
                </div>
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
                            <input type="text" name="EMAIL" value="<?=$arUser['EMAIL']?>" required/>
                            <span class="error">E-mail введен не корректно, используйте @</span>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Телефон*</label>
                            <input type="phone" name="PHONE" value="<?=$arUser['PERSONAL_PHONE']?>" required/>
                            <span class="error">E-mail введен не корректно, используйте @</span>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Пароль*</label>
                            <input type="password" name="PASS" value="" required/>
                            <span class="error">E-mail введен не корректно, используйте @</span>
                        </div>
                        <div class="form-wrapper__item">
                            <label>Город*</label>
                            <input type="text" name="CITY" value="<?=$arUser['PERSONAL_CITY']?>" required/>
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
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595"/>
            </svg>
            <span>Назад в меню</span>
        </a>
        <?if($arResult['TECH']['ERROR'] == 'Y'):?>
            <div class="personal-content__item-row">
                <div class="personal-content__item-row--header">
                    <h3 class="_blue">ТЕХНОЛОГ «CONCEPT» В ВАШЕМ ГОРОДЕ</h3>
                </div>
            </div>
            <div class="personal-content__item-row">
                <div class="personal-content__item-row--header">
                    <p><?=$arResult['TECH']['MESSAGE']?></p>
                </div>
            </div>
        <?else:?>
            <div class="personal-content__item-row">
                <div class="personal-content__item-row--header">
                    <h3 class="_blue">ТЕХНОЛОГ «CONCEPT» В ВАШЕМ ГОРОДЕ</h3>
                </div>
                <?
                    $pic = CFile::ResizeImageGet($arResult['TECH']['CITY']['FIELDS']['PREVIEW_PICTURE'], array('width'=>285, 'height'=>332), BX_RESIZE_IMAGE_EXACT, true);
                ?>
                <div class="personal-content__item-row--content">
                    <div class="seminar-detail__who-leads">
                        <div class="seminar-detail__who-leads--picture">
                            <div class="seminar-detail__who-leads-image">
                                <img src="<?=$pic['src']?>" alt="<?=$pic['ALT']?>" title="<?=$pic['TITLE']?>">
                            </div>
                            <div class="seminar-detail__who-leads--image-description">
                                <a class="seminar-detail__who-leads--image-description-link" href="#"><?=$arResult['TECH']['CITY']['FIELDS']['NAME']?></a>
                                <a href="mailto:<?=$arResult['TECH']['CITY']['PROPS']['EMAIL']['VALUE']?>" class="email-link seminar-detail__who-leads--image-description-post _white"><?=$arResult['TECH']['CITY']['PROPS']['EMAIL']['VALUE']?></a>
                                <a href="tel:<?=General::formatPhone($arResult['TECH']['CITY']['PROPS']['PHONE']['VALUE'])?>" class="phone-link seminar-detail__who-leads--image-description-post _white"><?=$arResult['TECH']['CITY']['PROPS']['PHONE']['VALUE']?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="ask-question">
                <div class="container">
                    <div class="ask-question__text">
                        <p>Если вам срочно нужно связаться с технологом «CONCEPT», напишите ему сообщение, не покидая наш сайт</p>
                    </div>
                    <div class="ask-question__button"><a href="#" class="button _big">Написать</a></div>
                </div>
            </section>
            <div class="department">
                <h3>ТЕХНОЛОГИ «CONCEPT» В ВАШЕМ РЕГИОНЕ</h3>
                <div class="department-list">
                    <?foreach($arResult['TECH']['REGION'] as $k => $arItem):?>
                        <div class="department-list__item">
                            <a href="#" class="department-list__item--name"><?=$arItem['FIELDS']['NAME']?></a>
                            <a href="mailto:<?=$arItem['PROPS']['EMAIL']['VALUE']?>" class="email-link"><?=$arItem['PROPS']['EMAIL']['VALUE']?></a>
                            <a href="tel:<?=General::formatPhone($arItem['PROPS']['EMAIL']['VALUE'])?>" class="phone-link"><?=$arItem['PROPS']['PHONE']['VALUE']?></a>
                        </div>
                    <?endforeach;?>
                </div>
            </div>
        <?endif;?>
    </div>
    <div class="personal-content__item" data-tab="news">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595"/>
            </svg>
            <span>Назад в меню</span>
        </a>
        <h3 class="_blue">МЕРОПРИЯТИЯ В ВАШЕМ РЕГИОНЕ</h3>
        <div class="personal-news">
            <?if(empty($arResult['EVENTS'])):?>
                <p>В вашем ргеионе нет запланированных мероприятий</p>
            <?else:?>
                <?foreach($arResult['EVENTS'] as $arItem):?>
                    <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>285, 'height'=>240), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                    <div class="personal-news__item">
                        <div class="personal-news__item-illustration">
                            <img src="<?= $pic['src'] ?>" alt role="presentation" class="personal-news__item-image">
                        </div>
                        <div class="personal-news__item--content">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="personal-news__item-title"><?=$arItem['NAME']?></a>
                            <p class="personal-news__item-date"><?=FormatDate('j F Y года',strtotime($arItem['ACTIVE_FROM']))?></p>
                            <p class="personal-news__item-text"><?=$arItem['PREVIEW_TEXT']?></p>
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button _empty">Подробнее</a>
                        </div>
                    </div>
                <?endforeach;?>
            <?endif;?>
        </div>
        <h3 class="_blue">ДРУГИЕ НОВОСТИ</h3>
        <div class="personal-news">
            <?if(empty($arResult['NEWS'])):?>
                <p>В вашем регионе нет интересующих вас новостей</p>
            <?else:?>
                <?foreach($arResult['NEWS'] as $arItem):?>
                    <?$pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>285, 'height'=>240), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
                    <div class="personal-news__item">
                        <div class="personal-news__item-illustration">
                            <img src="<?= $pic['src'] ?>" alt role="presentation" class="personal-news__item-image">
                        </div>
                        <div class="personal-news__item--content">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="personal-news__item-title"><?=$arItem['NAME']?></a>
                            <p class="personal-news__item-date"><?=FormatDate('j F Y года',strtotime($arItem['ACTIVE_FROM']))?></p>
                            <p class="personal-news__item-text"><?=$arItem['PREVIEW_TEXT']?></p>
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button _empty">Подробнее</a>
                        </div>
                    </div>
                <?endforeach;?>
            <?endif;?>
        </div>
    </div>
    <div class="personal-content__item" data-tab="download">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595"/>
            </svg>
            <span class="level-1">Назад в меню</span>
            <span class="level-2">Назад</span>
        </a>
        <div class="slide-toggle-container">
            <div class="slide-toggle-buttons">
                <?foreach($arResult['DOWNLOADS'] as $k => $mainSection):?>
                    <div class="slide-toggle-buttons__item" data-download-tab="<?=$k?>"><?=$mainSection['NAME']?></div>
                <?endforeach;?>
            </div>
            <div class="slide-toggle-content">
                <?foreach($arResult['DOWNLOADS'] as $k => $mainSection):?>
                    <div class="slide-toggle-content_wrapper" data-download-content="<?=$k?>">
                        <?foreach($mainSection['SECTIONS'] as $sID => $sectionArr):?>
                            <div class="slide-toggle-content__item slide-toggle-content__item--level-1">
                                <div class="slide-toggle-content__item-button"><?=$sectionArr['NAME']?></div>
                                <div class="slide-toggle-content__item-content">
                                    <div class="slide-toggle-content__item-content--list">
                                        <?foreach($sectionArr['FILES'] as $fID => $fileArr):?>
                                            <a target="_blank" href="<?=$fileArr['PATH']?>"><?=$fileArr['NAME']?></a>
                                        <?endforeach;?>
                                    </div>
                                    <div class="slide-toggle-content__item slide-toggle-content__item--level-2">
                                        <div class="slide-toggle-content__item-button">Продукты</div>
                                        <div class="slide-toggle-content__item-content">
                                            <div class="slide-toggle-content__item slide-toggle-content__item--level-3">
                                                <?foreach($sectionArr['PRODUCTS'] as $pID => $pArr):?>
                                                    <div class="slide-toggle-content__item-button"><?=$pArr['NAME']?></div>
                                                    <div class="slide-toggle-content__item-content">
                                                        <div class="slide-toggle-content__item-content--list">
                                                            <?foreach($pArr['FILES'] as $fID => $fileArr):?>
                                                                <a target="_blank" href="<?=$fileArr['PATH']?>"><?=$fileArr['NAME']?></a>
                                                            <?endforeach;?>
                                                        </div>
                                                    </div>
                                                <?endforeach;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?endforeach;?>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
    <div class="personal-content__item" data-tab="materials">
        <a href="#" class="personal-mobile-navigation" data-level="1">
            <svg width="5" height="10" viewBox="0 0 5 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.81647 0.209802C4.87464 0.276139 4.9208 0.354944 4.9523 0.441704C4.98379 0.528463 5 0.621474 5 0.715406C5 0.809339 4.98379 0.902349 4.9523 0.989109C4.9208 1.07587 4.87464 1.15467 4.81647 1.22101L1.50919 5.00019L4.81646 8.77936C4.93377 8.91346 4.99967 9.09533 4.99967 9.28497C4.99967 9.47461 4.93377 9.65648 4.81646 9.79057C4.69916 9.92467 4.54006 10 4.37416 10C4.20827 10 4.04917 9.92467 3.93186 9.79057L0.183535 5.50579C0.125356 5.43945 0.0791991 5.36065 0.0477049 5.27389C0.0162113 5.18713 -2.22671e-07 5.09412 -2.18565e-07 5.00019C-2.14459e-07 4.90625 0.0162113 4.81324 0.047705 4.72648C0.0791991 4.63972 0.125356 4.56092 0.183535 4.49458L3.93186 0.209802C3.98989 0.143298 4.05883 0.0905335 4.13473 0.0545321C4.21063 0.0185308 4.29199 -2.45756e-08 4.37416 -2.17233e-08C4.45634 -1.8871e-08 4.5377 0.0185308 4.6136 0.0545321C4.6895 0.0905335 4.75843 0.143298 4.81647 0.209802Z" fill="#959595"/>
            </svg>
            <span>Назад в меню</span>
        </a>
        <div class="personal-content__item-row">
            <div class="personal-content__item-row--header">
                <h3 class="_blue">ВЫ МОЖЕТЕ СКАЧАТЬ ИНФОРМАЦИЮ</h3>
            </div>
            <div class="personal-content__item-row--content">
                <div class="links-list">
                    <?foreach($arResult['MARKETING_MATERIALS'] as $file):?>
                        <?$type = (!empty($file['PROPERTY_MATERIAL_FORMAT_VALUE'])) ? $file['PROPERTY_MATERIAL_FORMAT_VALUE'] : 'download'?>
                        <a href="<?=CFile::GetPath($file['PROPERTY_FILE_VALUE'])?>" class="<?=$type?>-link" target="_blank"><?=$file['NAME']?></a>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>