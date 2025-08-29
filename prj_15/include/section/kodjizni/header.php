<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<!--header-->
<div id="t-header" class="t-records" data-hook="blocks-collection-content-node" data-tilda-project-id="4232380"
     data-tilda-page-id="21035862" data-tilda-formskey="e9090ef6e5c9a81dd52ba3f7fd0ed0ff" data-tilda-lazy="yes"
     data-tilda-project-lang="RU" data-tilda-project-headcode="yes">
    <div id="rec604963314" class="r t-rec t-rec_pt_45 t-rec_pb_75"
         style="padding-top:45px;padding-bottom:75px;background-color:#ffffff; " data-animationappear="off"
         data-record-type="257" data-bg-color="#ffffff"><!-- T228 -->
        <div id="nav604963314marker"></div>
        <div class="tmenu-mobile">
            <div class="tmenu-mobile__container">
                <div class="tmenu-mobile__text t-name t-name_md" field="menu_mob_title">Меню</div>
                <button type="button"
                        class="t-menuburger t-menuburger_first t-menuburger__big"
                        aria-label="Навигационное меню"
                        aria-expanded="false"><span style="background-color:#000000;"></span><span
                        style="background-color:#000000;"></span><span style="background-color:#000000;"></span><span
                        style="background-color:#000000;"></span></button>
                <script>function t_menuburger_init(recid) {
                        var rec = document.querySelector('#rec' + recid);
                        if (!rec) return;
                        var burger = rec.querySelector('.t-menuburger');
                        if (!burger) return;
                        var isSecondStyle = burger.classList.contains('t-menuburger_second');
                        if (isSecondStyle && !window.isMobile && !('ontouchend' in document)) {
                            burger.addEventListener('mouseenter', function () {
                                if (burger.classList.contains('t-menuburger-opened')) return;
                                burger.classList.remove('t-menuburger-unhovered');
                                burger.classList.add('t-menuburger-hovered');
                            });
                            burger.addEventListener('mouseleave', function () {
                                if (burger.classList.contains('t-menuburger-opened')) return;
                                burger.classList.remove('t-menuburger-hovered');
                                burger.classList.add('t-menuburger-unhovered');
                                setTimeout(function () {
                                    burger.classList.remove('t-menuburger-unhovered');
                                }, 300);
                            });
                        }
                        burger.addEventListener('click', function () {
                            if (!burger.closest('.tmenu-mobile') &&
                                !burger.closest('.t450__burger_container') &&
                                !burger.closest('.t466__container') &&
                                !burger.closest('.t204__burger') &&
                                !burger.closest('.t199__js__menu-toggler')) {
                                burger.classList.toggle('t-menuburger-opened');
                                burger.classList.remove('t-menuburger-unhovered');
                            }
                        });
                        var menu = rec.querySelector('[data-menu="yes"]');
                        if (!menu) return;
                        var menuLinks = menu.querySelectorAll('.t-menu__link-item');
                        var submenuClassList = ['t978__menu-link_hook', 't978__tm-link', 't966__tm-link', 't794__tm-link', 't-menusub__target-link'];
                        Array.prototype.forEach.call(menuLinks, function (link) {
                            link.addEventListener('click', function () {
                                var isSubmenuHook = submenuClassList.some(function (submenuClass) {
                                    return link.classList.contains(submenuClass);
                                });
                                if (isSubmenuHook) return;
                                burger.classList.remove('t-menuburger-opened');
                            });
                        });
                        menu.addEventListener('clickedAnchorInTooltipMenu', function () {
                            burger.classList.remove('t-menuburger-opened');
                        });
                    }

                    t_onReady(function () {
                        t_onFuncLoad('t_menuburger_init', function () {
                            t_menuburger_init('604963314');
                        });
                    });</script>
                <style>.t-menuburger {
                        position: relative;
                        flex-shrink: 0;
                        width: 28px;
                        height: 20px;
                        padding: 0;
                        border: none;
                        background-color: transparent;
                        outline: none;
                        -webkit-transform: rotate(0deg);
                        transform: rotate(0deg);
                        transition: transform .5s ease-in-out;
                        cursor: pointer;
                        z-index: 999;
                    }

                    /*---menu burger lines---*/
                    .t-menuburger span {
                        display: block;
                        position: absolute;
                        width: 100%;
                        opacity: 1;
                        left: 0;
                        -webkit-transform: rotate(0deg);
                        transform: rotate(0deg);
                        transition: .25s ease-in-out;
                        height: 3px;
                        background-color: #000;
                    }

                    .t-menuburger span:nth-child(1) {
                        top: 0px;
                    }

                    .t-menuburger span:nth-child(2),
                    .t-menuburger span:nth-child(3) {
                        top: 8px;
                    }

                    .t-menuburger span:nth-child(4) {
                        top: 16px;
                    }

                    /*menu burger big*/
                    .t-menuburger__big {
                        width: 42px;
                        height: 32px;
                    }

                    .t-menuburger__big span {
                        height: 5px;
                    }

                    .t-menuburger__big span:nth-child(2),
                    .t-menuburger__big span:nth-child(3) {
                        top: 13px;
                    }

                    .t-menuburger__big span:nth-child(4) {
                        top: 26px;
                    }

                    /*menu burger small*/
                    .t-menuburger__small {
                        width: 22px;
                        height: 14px;
                    }

                    .t-menuburger__small span {
                        height: 2px;
                    }

                    .t-menuburger__small span:nth-child(2),
                    .t-menuburger__small span:nth-child(3) {
                        top: 6px;
                    }

                    .t-menuburger__small span:nth-child(4) {
                        top: 12px;
                    }

                    /*menu burger opened*/
                    .t-menuburger-opened span:nth-child(1) {
                        top: 8px;
                        width: 0%;
                        left: 50%;
                    }

                    .t-menuburger-opened span:nth-child(2) {
                        -webkit-transform: rotate(45deg);
                        transform: rotate(45deg);
                    }

                    .t-menuburger-opened span:nth-child(3) {
                        -webkit-transform: rotate(-45deg);
                        transform: rotate(-45deg);
                    }

                    .t-menuburger-opened span:nth-child(4) {
                        top: 8px;
                        width: 0%;
                        left: 50%;
                    }

                    .t-menuburger-opened.t-menuburger__big span:nth-child(1) {
                        top: 6px;
                    }

                    .t-menuburger-opened.t-menuburger__big span:nth-child(4) {
                        top: 18px;
                    }

                    .t-menuburger-opened.t-menuburger__small span:nth-child(1),
                    .t-menuburger-opened.t-menuburger__small span:nth-child(4) {
                        top: 6px;
                    }

                    /*---menu burger first style---*/
                    @media (hover), (min-width: 0\0
                    ) {
                        .t-menuburger_first:hover span:nth-child(1) {
                            transform: translateY(1px);
                        }

                        .t-menuburger_first:hover span:nth-child(4) {
                            transform: translateY(-1px);
                        }

                        .t-menuburger_first.t-menuburger__big:hover span:nth-child(1) {
                            transform: translateY(3px);
                        }

                        .t-menuburger_first.t-menuburger__big:hover span:nth-child(4) {
                            transform: translateY(-3px);
                        }
                    }

                    /*---menu burger second style---*/
                    .t-menuburger_second span:nth-child(2),
                    .t-menuburger_second span:nth-child(3) {
                        width: 80%;
                        left: 20%;
                        right: 0;
                    }

                    @media (hover), (min-width: 0\0
                    ) {
                        .t-menuburger_second.t-menuburger-hovered span:nth-child(2),
                        .t-menuburger_second.t-menuburger-hovered span:nth-child(3) {
                            animation: t-menuburger-anim 0.3s ease-out normal forwards;
                        }

                        .t-menuburger_second.t-menuburger-unhovered span:nth-child(2),
                        .t-menuburger_second.t-menuburger-unhovered span:nth-child(3) {
                            animation: t-menuburger-anim2 0.3s ease-out normal forwards;
                        }
                    }

                    .t-menuburger_second.t-menuburger-opened span:nth-child(2),
                    .t-menuburger_second.t-menuburger-opened span:nth-child(3) {
                        left: 0;
                        right: 0;
                        width: 100% !important;
                    }

                    /*---menu burger third style---*/
                    .t-menuburger_third span:nth-child(4) {
                        width: 70%;
                        left: unset;
                        right: 0;
                    }

                    @media (hover), (min-width: 0\0
                    ) {
                        .t-menuburger_third:not(.t-menuburger-opened):hover span:nth-child(4) {
                            width: 100%;
                        }
                    }

                    .t-menuburger_third.t-menuburger-opened span:nth-child(4) {
                        width: 0 !important;
                        right: 50%;
                    }

                    /*---menu burger fourth style---*/
                    .t-menuburger_fourth {
                        height: 12px;
                    }

                    .t-menuburger_fourth.t-menuburger__small {
                        height: 8px;
                    }

                    .t-menuburger_fourth.t-menuburger__big {
                        height: 18px;
                    }

                    .t-menuburger_fourth span:nth-child(2),
                    .t-menuburger_fourth span:nth-child(3) {
                        top: 4px;
                        opacity: 0;
                    }

                    .t-menuburger_fourth span:nth-child(4) {
                        top: 8px;
                    }

                    .t-menuburger_fourth.t-menuburger__small span:nth-child(2),
                    .t-menuburger_fourth.t-menuburger__small span:nth-child(3) {
                        top: 3px;
                    }

                    .t-menuburger_fourth.t-menuburger__small span:nth-child(4) {
                        top: 6px;
                    }

                    .t-menuburger_fourth.t-menuburger__small span:nth-child(2),
                    .t-menuburger_fourth.t-menuburger__small span:nth-child(3) {
                        top: 3px;
                    }

                    .t-menuburger_fourth.t-menuburger__small span:nth-child(4) {
                        top: 6px;
                    }

                    .t-menuburger_fourth.t-menuburger__big span:nth-child(2),
                    .t-menuburger_fourth.t-menuburger__big span:nth-child(3) {
                        top: 6px;
                    }

                    .t-menuburger_fourth.t-menuburger__big span:nth-child(4) {
                        top: 12px;
                    }

                    @media (hover), (min-width: 0\0
                    ) {
                        .t-menuburger_fourth:not(.t-menuburger-opened):hover span:nth-child(1) {
                            transform: translateY(1px);
                        }

                        .t-menuburger_fourth:not(.t-menuburger-opened):hover span:nth-child(4) {
                            transform: translateY(-1px);
                        }

                        .t-menuburger_fourth.t-menuburger__big:not(.t-menuburger-opened):hover span:nth-child(1) {
                            transform: translateY(3px);
                        }

                        .t-menuburger_fourth.t-menuburger__big:not(.t-menuburger-opened):hover span:nth-child(4) {
                            transform: translateY(-3px);
                        }
                    }

                    .t-menuburger_fourth.t-menuburger-opened span:nth-child(1),
                    .t-menuburger_fourth.t-menuburger-opened span:nth-child(4) {
                        top: 4px;
                    }

                    .t-menuburger_fourth.t-menuburger-opened span:nth-child(2),
                    .t-menuburger_fourth.t-menuburger-opened span:nth-child(3) {
                        opacity: 1;
                    }

                    /*---menu burger animations---*/
                    @keyframes t-menuburger-anim {
                        0% {
                            width: 80%;
                            left: 20%;
                            right: 0;
                        }
                        50% {
                            width: 100%;
                            left: 0;
                            right: 0;
                        }
                        100% {
                            width: 80%;
                            left: 0;
                            right: 20%;
                        }
                    }

                    @keyframes t-menuburger-anim2 {
                        0% {
                            width: 80%;
                            left: 0;
                        }
                        50% {
                            width: 100%;
                            right: 0;
                            left: 0;
                        }
                        100% {
                            width: 80%;
                            left: 20%;
                            right: 0;
                        }
                    }</style>
            </div>
        </div>
        <style>.tmenu-mobile {
                background-color: #111;
                display: none;
                width: 100%;
                top: 0;
                z-index: 990;
            }

            .tmenu-mobile_positionfixed {
                position: fixed;
            }

            .tmenu-mobile__text {
                color: #fff;
            }

            .tmenu-mobile__container {
                min-height: 64px;
                padding: 20px;
                position: relative;
                box-sizing: border-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-justify-content: space-between;
                -ms-flex-pack: justify;
                justify-content: space-between;
            }

            .tmenu-mobile__list {
                display: block;
            }

            .tmenu-mobile__burgerlogo {
                display: inline-block;
                font-size: 24px;
                font-weight: 400;
                white-space: nowrap;
                vertical-align: middle;
            }

            .tmenu-mobile__imglogo {
                height: auto;
                display: block;
                max-width: 300px !important;
                box-sizing: border-box;
                padding: 0;
                margin: 0 auto;
            }

            @media screen and (max-width: 980px) {
                .tmenu-mobile__menucontent_hidden {
                    display: none;
                    height: 100%;
                }

                .tmenu-mobile {
                    display: block;
                }
            }

            @media screen and (max-width: 980px) {
                #rec604963314 .tmenu-mobile {
                    background-color: #ffffff;
                }

                #rec604963314 .t-menuburger {
                    -webkit-order: 1;
                    -ms-flex-order: 1;
                    order: 1;
                }
            }</style>
        <div id="nav604963314" data-full-submenu-mob="y"
             class="t228 t228__positionstatic tmenu-mobile__menucontent_hidden"
             style="background-color: rgba(255,255,255,0.50); height:5vh; " data-bgcolor-hex="#ffffff"
             data-bgcolor-rgba="rgba(255,255,255,0.50)" data-navmarker="nav604963314marker" data-appearoffset=""
             data-bgopacity-two="" data-menushadow="" data-bgopacity="0.50" data-menu-items-align="center"
             data-menu="yes">
            <div class="t228__maincontainer " style="height:5vh;">
                <div class="t228__padding40px"></div>
                <div class="t228__leftside">
                    <div class="t228__leftcontainer"><a href="" class="t228__imgwrapper"
                                                        style="color:#ffffff;"><img
                                class="t228__imglogo t228__imglogomobile"
                                src="<?=SITE_TEMPLATE_PATH?>/images/tild6135-3366-4533-a431-326661393331__logo.png"
                                imgfield="img"
                                style="max-width: 170px; width: 170px; min-width: 170px; height: auto; display: block;"
                                alt="Цифровая академия «Врач будущего»"
                            ></a></div>
                </div>
                <div class="t228__centerside ">
                    <nav class="t228__centercontainer"
                         aria-label="Основная навигация">
                        <ul role="list" class="t228__list t-menu__list t228__list_hidden">
                            <li class="t228__list_item"
                                style="padding:0 15px 0 0;"><a class="t-menu__link-item"
                                                               href="#vebinar" data-menu-submenu-hook=""
                                                               data-menu-item-number="1"
                                                               style="color:#000000;font-size:12px;font-weight:700;font-family:'Gotham';text-transform:uppercase;">Вебинары</a>
                            </li>
                            <li class="t228__list_item"
                                style="padding:0 15px;"><a class="t-menu__link-item"
                                                           href="#about" data-menu-submenu-hook=""
                                                           data-menu-item-number="2"
                                                           style="color:#000000;font-size:12px;font-weight:700;font-family:'Gotham';text-transform:uppercase;">О
                                    нас</a></li>
                            <li class="t228__list_item"
                                style="padding:0 15px;"><a class="t-menu__link-item"
                                                           href=""
                                                           target="_blank" data-menu-submenu-hook=""
                                                           data-menu-item-number="3"
                                                           style="color:#000000;font-size:12px;font-weight:700;font-family:'Gotham';text-transform:uppercase;">Статьи</a>
                            </li>
                            <li class="t228__list_item"
                                style="padding:0 15px;"><a class="t-menu__link-item"
                                                           href=""
                                                           target="_blank"
                                                           aria-haspopup="true" aria-expanded="false" role="button"
                                                           data-menu-submenu-hook="link_sub4_604963314"
                                                           data-menu-item-number="4"
                                                           style="color:#000000;font-size:12px;font-weight:700;font-family:'Gotham';text-transform:uppercase;">Курсы</a>
                                <div class="t-menusub" data-submenu-hook="link_sub4_604963314"
                                     data-submenu-margin="15px" data-add-submenu-arrow="on">
                                    <div class="t-menusub__menu">
                                        <div class="t-menusub__content">
                                            <ul role="list" class="t-menusub__list">
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href="/courses/vygoranie_osnovybalansa"
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        data-menu-item-number="4">Эмоциональное выгорание</a></li>
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href="/courses/calgary_model"
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        data-menu-item-number="4">Калгари-Кембриджская модель</a></li>
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href="/courses/trudnyj_pacient"
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        data-menu-item-number="4">Трудный пациент</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="t228__list_item"
                                style="padding:0 15px;"><a class="t-menu__link-item"
                                                           href=""
                                                           target="_blank"
                                                           aria-haspopup="true" aria-expanded="false" role="button"
                                                           data-menu-submenu-hook="link_sub5_604963314"
                                                           data-menu-item-number="5"
                                                           style="color:#000000;font-size:12px;font-weight:700;font-family:'Gotham';text-transform:uppercase;">Библиотека</a>
                                <div class="t-menusub" data-submenu-hook="link_sub5_604963314"
                                     data-submenu-margin="15px" data-add-submenu-arrow="on">
                                    <div class="t-menusub__menu">
                                        <div class="t-menusub__content">
                                            <ul role="list" class="t-menusub__list">
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href="/kabinet/nevrologbudushego"
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        data-menu-item-number="5">Неврология</a></li>
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href="/kabinet/ginekologbudushchego"
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        data-menu-item-number="5">Гинекология</a></li>
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href="/kabinet/endokrinologbudushchego"
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        data-menu-item-number="5">Эндокринология</a></li>
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href="/kabinet/oftalmologbudushchego"
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        data-menu-item-number="5">Офтальмология</a></li>
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href="/vebinary/vrachpacient"
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        data-menu-item-number="5">Врач и Пациент</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="t228__list_item"
                                style="padding:0 15px;"><a class="t-menu__link-item"
                                                           href="#contacts" data-menu-submenu-hook=""
                                                           data-menu-item-number="6"
                                                           style="color:#000000;font-size:12px;font-weight:700;font-family:'Gotham';text-transform:uppercase;">Контакты</a>
                            </li>
                            <li class="t228__list_item"
                                style="padding:0 15px;"><a class="t-menu__link-item"
                                                           href=""
                                                           target="_blank" data-menu-submenu-hook=""
                                                           data-menu-item-number="7"
                                                           style="color:#000000;font-size:12px;font-weight:700;font-family:'Gotham';text-transform:uppercase;">Код
                                    жизни</a></li>
                            <li class="t228__list_item"
                                style="padding:0 0 0 15px;"><a class="t-menu__link-item"
                                                               href=""
                                                               target="_blank"
                                                               aria-haspopup="true" aria-expanded="false"
                                                               role="button"
                                                               data-menu-submenu-hook="link_sub8_604963314"
                                                               data-menu-item-number="8"
                                                               style="color:#000000;font-size:12px;font-weight:700;font-family:'Gotham';text-transform:uppercase;">Мастер-классы</a>
                                <div class="t-menusub" data-submenu-hook="link_sub8_604963314"
                                     data-submenu-margin="15px" data-add-submenu-arrow="on">
                                    <div class="t-menusub__menu">
                                        <div class="t-menusub__content">
                                            <ul role="list" class="t-menusub__list">
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href=""
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        target="_blank" data-menu-item-number="8">Как договориться с
                                                        пациентом</a></li>
                                                <li class="t-menusub__list-item t-name t-name_xs"><a
                                                        class="t-menusub__link-item t-name t-name_xs"
                                                        href=""
                                                        style="font-size:12px;font-weight:400;font-family:'Gotham';text-transform:uppercase;"
                                                        target="_blank" data-menu-item-number="8">Основы баланса:
                                                        гореть, но не выгорать</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="t228__rightside">
                    <div class="t228__rightcontainer">
                        <div class="t228__right_buttons">
                            <div class="t228__right_buttons_wrap">
                                <div class="t228__right_buttons_but"><a href="https://vrachbudushego.ru/pupupenter"
                                                                        target=""
                                                                        class="t-btn t-btn_md js-click-stat"
                                                                        data-tilda-event-name="/tilda/click/rec604963314/button1"
                                                                        style="color:#000000;border:2px solid #ff8800;border-radius:10px; -moz-border-radius:10px; -webkit-border-radius:10px;">
                                        <table role="presentation" style="width:100%; height:100%;">
                                            <tr>
                                                <td>Войти</td>
                                            </tr>
                                        </table>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="t228__padding40px"></div>
            </div>
        </div>
        <style>@media screen and (max-width: 980px) {
                #rec604963314 .t228__leftcontainer {
                    padding: 20px;
                }

                #rec604963314 .t228__imglogo {
                    padding: 20px 0;
                }

                #rec604963314 .t228 {
                    position: static;
                }
            }</style>
        <script>window.addEventListener('load', function () {
                t_onFuncLoad('t228_setWidth', function () {
                    t228_setWidth('604963314');
                });
            });
            window.addEventListener('resize', t_throttle(function () {
                t_onFuncLoad('t228_setWidth', function () {
                    t228_setWidth('604963314');
                });
                t_onFuncLoad('t_menu__setBGcolor', function () {
                    t_menu__setBGcolor('604963314', '.t228');
                });
            }));
            t_onReady(function () {
                t_onFuncLoad('t_menu__highlightActiveLinks', function () {
                    t_menu__highlightActiveLinks('.t228__list_item a');
                });
                t_onFuncLoad('t228__init', function () {
                    t228__init('604963314');
                });
                t_onFuncLoad('t_menu__setBGcolor', function () {
                    t_menu__setBGcolor('604963314', '.t228');
                });
                t_onFuncLoad('t_menu__interactFromKeyboard', function () {
                    t_menu__interactFromKeyboard('604963314');
                });
                t_onFuncLoad('t228_setWidth', function () {
                    t228_setWidth('604963314');
                });
                t_onFuncLoad('t_menu__createMobileMenu', function () {
                    t_menu__createMobileMenu('604963314', '.t228');
                });
            });</script>
        <!--[if IE 8]>
        <style>#rec604963314 .t228 {
            filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#D9ffffff', endColorstr='#D9ffffff');
        }</style><![endif]-->
        <style>#rec604963314 .t-menu__link-item {
                -webkit-transition: color 0.3s ease-in-out, opacity 0.3s ease-in-out;
                transition: color 0.3s ease-in-out, opacity 0.3s ease-in-out;
            }

            #rec604963314 .t-menu__link-item.t-active:not(.t978__menu-link) {
                color: #ff8800 !important;
                font-weight: 700 !important;
            }

            #rec604963314 .t-menu__link-item:not(.t-active):not(.tooltipstered):hover,
            #rec604963314 .t-menu__link-item:not(.t-active):not(.tooltipstered):focus-visible {
                color: #ff8800 !important;
            }

            @supports (overflow:-webkit-marquee) and (justify-content:inherit) {
                #rec604963314 .t-menu__link-item,
                #rec604963314 .t-menu__link-item.t-active {
                    opacity: 1 !important;
                }
            }</style>
        <script>t_onReady(function () {
                setTimeout(function () {
                    t_onFuncLoad('t_menusub_init', function () {
                        t_menusub_init('604963314');
                    });
                }, 500);
            });</script>
        <style>#rec604963314 .t-menusub__link-item {
                -webkit-transition: color 0.3s ease-in-out, opacity 0.3s ease-in-out;
                transition: color 0.3s ease-in-out, opacity 0.3s ease-in-out;
            }

            #rec604963314 .t-menusub__link-item:not(.t-active):not(.tooltipstered):hover {
                color: #ff8800 !important;
            }

            @supports (overflow:-webkit-marquee) and (justify-content:inherit) {
                #rec604963314 .t-menusub__link-item,
                #rec604963314 .t-menusub__link-item.t-active {
                    opacity: 1 !important;
                }
            }

            @media screen and (max-width: 980px) {
                #rec604963314 .t-menusub__menu .t-menusub__link-item {
                    color: #000000 !important;
                }

                #rec604963314 .t-menusub__menu .t-menusub__link-item.t-active {
                    color: #000000 !important;
                }
            }

            @media screen and (min-width: 981px) {
                #rec604963314 .t-menusub__menu {
                    text-align: left;
                }
            }</style>
    </div>
</div>
<!--/header-->
