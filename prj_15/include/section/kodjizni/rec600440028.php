<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<div id="rec600440028" class="r t-rec t-screenmax-640px" style="background-color:#f4ece0; "
     data-animationappear="off" data-record-type="451" data-screen-max="640px" data-bg-color="#f4ece0"><!-- T451 -->
    <div id="nav600440028marker"></div>
    <div id="nav600440028" class="t451" data-menu="yes">
        <div class="t451__container t451__positionfixed t451__panel t451__beforeready" data-appearoffset="100px"
             style="height: 50px;">
            <div class="t451__container__bg" style="background-color: rgba(244,236,224,1); "
                 data-bgcolor-hex="#f4ece0" data-bgcolor-rgba="rgba(244,236,224,1)"
                 data-navmarker="nav600440028marker" data-appearoffset="100px" data-bgopacity="1"
                 data-menu-shadow="0px 1px 3px rgba(0,0,0,0.)"></div>
            <div class="t451__menu__content ">
                <div class="t451__burger-wrapper__mobile">
                    <button type="button"
                            class="t-menuburger t-menuburger_first "
                            aria-label="Навигационное меню"
                            aria-expanded="false"><span style="background-color:#373844;"></span><span
                            style="background-color:#373844;"></span><span
                            style="background-color:#373844;"></span><span style="background-color:#373844;"></span>
                    </button>
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
                                t_menuburger_init('600440028');
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
                <div class="t451__leftside t451__side t451__side_burger">
                    <button type="button"
                            class="t-menuburger t-menuburger_first "
                            aria-label="Навигационное меню"
                            aria-expanded="false"><span style="background-color:#373844;"></span><span
                            style="background-color:#373844;"></span><span
                            style="background-color:#373844;"></span><span style="background-color:#373844;"></span>
                    </button>
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
                                t_menuburger_init('600440028');
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
                <div class="t451__centerside t451__side">
                    <div class="t451__logo__container t451__textlogo__container">
                        <div class="t451__logo__content">
                            <div field="title" class="t-heading t-heading_xs"
                                 style="font-size:20px;font-weight:500;font-family:'Gotham';"><span
                                    style="font-family: Gotham; color: rgb(146, 113, 124);">КОД ЖИЗНИ</span></div>
                        </div>
                    </div>
                </div>
                <div class="t451__rightside t451__side t451__side_socials">
                    <div class="t-sociallinks">
                        <ul role="list" class="t-sociallinks__wrapper" aria-label="Соц. сети"><!-- new soclinks -->
                            <li class="t-sociallinks__item t-sociallinks__item_telegram"><a
                                    href="https://t.me/vrachbudushego?utm_source=site_vb&amp;utm_medium=link&amp;utm_campaign=telegram_vb"
                                    target="_blank" rel="nofollow" aria-label="telegram"
                                    style="width: 30px; height: 30px;">
                                    <svg class="t-sociallinks__svg" role="presentation" width=30px height=30px
                                         viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm21.977-68.056c.386-4.38-4.24-2.576-4.24-2.576-3.415 1.414-6.937 2.85-10.497 4.302-11.04 4.503-22.444 9.155-32.159 13.734-5.268 1.932-2.184 3.864-2.184 3.864l8.351 2.577c3.855 1.16 5.91-.129 5.91-.129l17.988-12.238c6.424-4.38 4.882-.773 3.34.773l-13.49 12.882c-2.056 1.804-1.028 3.35-.129 4.123 2.55 2.249 8.82 6.364 11.557 8.16.712.467 1.185.778 1.292.858.642.515 4.111 2.834 6.424 2.319 2.313-.516 2.57-3.479 2.57-3.479l3.083-20.226c.462-3.511.993-6.886 1.417-9.582.4-2.546.705-4.485.767-5.362Z"
                                              fill="#000000"/>
                                    </svg>
                                </a></li>
                            <li class="t-sociallinks__item t-sociallinks__item_vkmessenger"><a
                                    href="https://vk.com/public211082564?utm_source=site_vb&amp;utm_medium=link&amp;utm_campaign=vk_vb"
                                    target="_blank" rel="nofollow" aria-label="vkmessenger"
                                    style="width: 30px; height: 30px;">
                                    <svg class="t-sociallinks__svg" role="presentation" width=30px height=30px
                                         viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm-5.08-76.414a48.135 48.135 0 0 0 2.187-.422c.324-.08 1.735-.153 3.134-.163 2.047-.013 3.002.067 4.89.41 7.843 1.428 13.918 5.42 18.472 12.135 1.99 2.934 3.603 7.076 4.066 10.44.313 2.276.265 7.758-.084 9.632-.373 2.006-1.503 5.362-2.424 7.2-2.132 4.25-5.556 8.135-9.378 10.638-1.183.774-3.108 1.843-3.838 2.13-.324.127-.669.291-.766.364-.387.29-3.382 1.191-5.337 1.604-1.807.382-2.488.44-5.279.445-2.862.007-3.437-.042-5.395-.455-3.863-.814-7.02-2.082-9.589-3.85-.587-.404-1.059-.363-4.407.381-3.654.812-4.57.94-4.88.682-.382-.316-.335-.8.4-4.153.749-3.409.938-4.215.702-4.867-.082-.227-.216-.436-.397-.731-2.693-4.394-3.984-9.062-3.997-14.46-.012-4.75.867-8.55 2.898-12.526.727-1.424 2.002-3.481 2.66-4.293.753-.927 4.735-4.855 5.312-5.24 2.412-1.604 2.967-1.933 4.722-2.79 1.91-.934 4.466-1.787 6.329-2.11Zm-4.47 22.33c-.949-2.514-1.303-3.314-1.605-3.615-.316-.317-.585-.352-3.088-.4-2.973-.058-3.103-.022-3.396.94-.119.39.636 3.353.932 3.657a.624.624 0 0 1 .156.375c0 .21.655 1.726 1.42 3.283.396.807 2.79 4.884 2.955 5.034.051.047.547.692 1.102 1.433 1.524 2.037 3.773 4.03 5.762 5.105 1.877 1.015 4.904 1.58 7.043 1.312 1.52-.19 1.615-.358 1.615-2.881 0-3.283.375-3.786 2.166-2.903.73.36 3.253 2.726 4.916 4.61.417.473.924.947 1.127 1.054.385.204 5.693.285 6.19.094.496-.19.516-1.17.043-2.138-.546-1.117-2.396-3.43-4.437-5.55-1.08-1.121-1.575-1.76-1.575-2.033 0-.34.841-1.897 1.161-2.15.107-.084.956-1.339 1.282-1.893.094-.16.636-1.07 1.204-2.023 1.464-2.455 1.755-3.08 1.864-4.002.088-.74.057-.84-.335-1.097-.367-.24-.822-.275-3.044-.228-2.49.051-2.631.073-3.043.46-.237.223-.479.565-.536.758-.168.565-1.947 4.025-2.2 4.278-.127.127-.23.305-.23.397 0 .281-1.514 2.377-2.339 3.24-.903.943-1.416 1.2-1.888.947-.31-.165-.326-.399-.329-4.679-.002-3.293-.06-4.617-.216-4.926l-.213-.421H45.35l-.25.447c-.24.425-.219.501.414 1.518l.666 1.07v4.3c0 4.29 0 4.3-.367 4.352-.5.07-1.505-.864-2.465-2.296-.797-1.188-2.506-4.389-2.898-5.429Z"
                                              fill="#000000"/>
                                    </svg>
                                </a></li>
                            <li class="t-sociallinks__item t-sociallinks__item_youtube"><a
                                    href="https://www.youtube.com/@vrachbudushego/videos?utm_source=site_vb&amp;utm_medium=link&amp;utm_campaign=youtube_vb"
                                    target="_blank" rel="nofollow" aria-label="youtube"
                                    style="width: 30px; height: 30px;">
                                    <svg class="t-sociallinks__svg" role="presentation" width=30px height=30px
                                         viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm17.9-67.374c3.838.346 6 2.695 6.474 6.438.332 2.612.626 6.352.626 10.375 0 7.064-.626 11.148-.626 11.148-.588 3.728-2.39 5.752-6.18 6.18-4.235.48-13.76.7-17.992.7-4.38 0-13.237-.184-17.66-.552-3.8-.317-6.394-2.44-6.916-6.218-.38-2.752-.626-6.022-.626-11.222 0-5.788.209-8.238.7-10.853.699-3.732 2.48-5.54 6.548-5.96C36.516 32.221 40.55 32 49.577 32c4.413 0 13.927.228 18.322.626Zm-23.216 9.761v14.374L58.37 49.5l-13.686-7.114Z"
                                              fill="#000000"/>
                                    </svg>
                                </a></li>
                            <li class="t-sociallinks__item t-sociallinks__item_ok"><a
                                    href="https://ok.ru/group/59792646275093?utm_source=site_vb&amp;utm_medium=link&amp;utm_campaign=ok_vb"
                                    target="_blank" rel="nofollow" aria-label="ok" style="width: 30px; height: 30px;">
                                    <svg class="t-sociallinks__svg" role="presentation" width=30px height=30px
                                         viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm13.463-63.08c0 7.688-6.233 13.92-13.92 13.92-7.688 0-13.92-6.232-13.92-13.92S41.855 23 49.543 23s13.92 6.232 13.92 13.92Zm-7.072 0a6.848 6.848 0 1 0-13.696 0 6.848 6.848 0 0 0 13.696 0Zm3.341 15.006c2.894-2.28 5.07-.967 5.856.612 1.37 2.753-.178 4.084-3.671 6.326-2.96 1.9-7.016 2.619-9.665 2.892l2.217 2.216 8.203 8.203a3.192 3.192 0 0 1 0 4.514l-.376.376a3.192 3.192 0 0 1-4.514 0l-8.203-8.203-8.203 8.203a3.192 3.192 0 0 1-4.514 0l-.376-.376a3.192 3.192 0 0 1 0-4.514l8.203-8.203 2.21-2.21c-2.648-.268-6.748-.983-9.732-2.898-3.494-2.243-5.041-3.573-3.671-6.326.786-1.579 2.963-2.892 5.855-.612 3.91 3.08 10.19 3.08 10.19 3.08s6.282 0 10.191-3.08Z"
                                              fill="#000000"/>
                                    </svg>
                                </a></li><!-- /new soclinks --></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="t451m__overlay">
        <div class="t451m__overlay_bg" style="background-color:#734c58; "></div>
    </div>
    <div class="t451 t451m t451m__left" data-tooltip-hook="" style="background-color: #92717c;">
        <button type="button" class="t451m__close-button t451m__close t451m_opened"
                style="background-color: #92717c;" aria-label="Закрыть меню">
            <div class="t451m__close_icon"><span style="background-color:#fefbf6;"></span><span
                    style="background-color:#fefbf6;"></span><span style="background-color:#fefbf6;"></span><span
                    style="background-color:#fefbf6;"></span></div>
        </button>
        <div class="t451m__container t-align_left">
            <div class="t451m__top">
                <nav class="t451m__menu"
                     aria-label="Основная навигация">
                    <ul role="list" class="t451m__list t-menu__list">
                        <li class="t451m__list_item"
                        ><a class="t-menu__link-item"
                            href="#about" data-menu-submenu-hook="" data-menu-item-number="1"
                            style="color:#fefbf6;font-size:21px;font-weight:400;font-family:'Gotham';">О проекте</a>
                        </li>
                        <li class="t451m__list_item"
                        ><a class="t-menu__link-item"
                            href="#vebinar" data-menu-submenu-hook="" data-menu-item-number="2"
                            style="color:#fefbf6;font-size:21px;font-weight:400;font-family:'Gotham';">Вебинары</a>
                        </li>
                        <li class="t451m__list_item"
                        ><a class="t-menu__link-item"
                            href="#peptids" data-menu-submenu-hook="" data-menu-item-number="3"
                            style="color:#fefbf6;font-size:21px;font-weight:400;font-family:'Gotham';">О
                                пептидах</a></li>
                        <li class="t451m__list_item"
                        ><a class="t-menu__link-item"
                            href="#rec599021753" data-menu-submenu-hook="" data-menu-item-number="4"
                            style="color:#fefbf6;font-size:21px;font-weight:400;font-family:'Gotham';">РЕГИСТРАЦИЯ
                                НА&nbsp;ВЕБИНАР</a></li>
                    </ul>
                </nav>
            </div>
            <div class="t451m__rightside">
                <div class="t451m__rightcontainer">
                    <div class="t-sociallinks">
                        <ul role="list" class="t-sociallinks__wrapper" aria-label="Соц. сети"><!-- new soclinks -->
                            <li class="t-sociallinks__item t-sociallinks__item_telegram"><a
                                    href="https://t.me/vrachbudushego?utm_source=site_vb&amp;utm_medium=link&amp;utm_campaign=telegram_vb"
                                    target="_blank" rel="nofollow" aria-label="telegram"
                                    style="width: 30px; height: 30px;">
                                    <svg class="t-sociallinks__svg" role="presentation" width=30px height=30px
                                         viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm21.977-68.056c.386-4.38-4.24-2.576-4.24-2.576-3.415 1.414-6.937 2.85-10.497 4.302-11.04 4.503-22.444 9.155-32.159 13.734-5.268 1.932-2.184 3.864-2.184 3.864l8.351 2.577c3.855 1.16 5.91-.129 5.91-.129l17.988-12.238c6.424-4.38 4.882-.773 3.34.773l-13.49 12.882c-2.056 1.804-1.028 3.35-.129 4.123 2.55 2.249 8.82 6.364 11.557 8.16.712.467 1.185.778 1.292.858.642.515 4.111 2.834 6.424 2.319 2.313-.516 2.57-3.479 2.57-3.479l3.083-20.226c.462-3.511.993-6.886 1.417-9.582.4-2.546.705-4.485.767-5.362Z"
                                              fill="#fefbf6"/>
                                    </svg>
                                </a></li>
                            <li class="t-sociallinks__item t-sociallinks__item_vkmessenger"><a
                                    href="https://vk.com/public211082564?utm_source=site_vb&amp;utm_medium=link&amp;utm_campaign=vk_vb"
                                    target="_blank" rel="nofollow" aria-label="vkmessenger"
                                    style="width: 30px; height: 30px;">
                                    <svg class="t-sociallinks__svg" role="presentation" width=30px height=30px
                                         viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm-5.08-76.414a48.135 48.135 0 0 0 2.187-.422c.324-.08 1.735-.153 3.134-.163 2.047-.013 3.002.067 4.89.41 7.843 1.428 13.918 5.42 18.472 12.135 1.99 2.934 3.603 7.076 4.066 10.44.313 2.276.265 7.758-.084 9.632-.373 2.006-1.503 5.362-2.424 7.2-2.132 4.25-5.556 8.135-9.378 10.638-1.183.774-3.108 1.843-3.838 2.13-.324.127-.669.291-.766.364-.387.29-3.382 1.191-5.337 1.604-1.807.382-2.488.44-5.279.445-2.862.007-3.437-.042-5.395-.455-3.863-.814-7.02-2.082-9.589-3.85-.587-.404-1.059-.363-4.407.381-3.654.812-4.57.94-4.88.682-.382-.316-.335-.8.4-4.153.749-3.409.938-4.215.702-4.867-.082-.227-.216-.436-.397-.731-2.693-4.394-3.984-9.062-3.997-14.46-.012-4.75.867-8.55 2.898-12.526.727-1.424 2.002-3.481 2.66-4.293.753-.927 4.735-4.855 5.312-5.24 2.412-1.604 2.967-1.933 4.722-2.79 1.91-.934 4.466-1.787 6.329-2.11Zm-4.47 22.33c-.949-2.514-1.303-3.314-1.605-3.615-.316-.317-.585-.352-3.088-.4-2.973-.058-3.103-.022-3.396.94-.119.39.636 3.353.932 3.657a.624.624 0 0 1 .156.375c0 .21.655 1.726 1.42 3.283.396.807 2.79 4.884 2.955 5.034.051.047.547.692 1.102 1.433 1.524 2.037 3.773 4.03 5.762 5.105 1.877 1.015 4.904 1.58 7.043 1.312 1.52-.19 1.615-.358 1.615-2.881 0-3.283.375-3.786 2.166-2.903.73.36 3.253 2.726 4.916 4.61.417.473.924.947 1.127 1.054.385.204 5.693.285 6.19.094.496-.19.516-1.17.043-2.138-.546-1.117-2.396-3.43-4.437-5.55-1.08-1.121-1.575-1.76-1.575-2.033 0-.34.841-1.897 1.161-2.15.107-.084.956-1.339 1.282-1.893.094-.16.636-1.07 1.204-2.023 1.464-2.455 1.755-3.08 1.864-4.002.088-.74.057-.84-.335-1.097-.367-.24-.822-.275-3.044-.228-2.49.051-2.631.073-3.043.46-.237.223-.479.565-.536.758-.168.565-1.947 4.025-2.2 4.278-.127.127-.23.305-.23.397 0 .281-1.514 2.377-2.339 3.24-.903.943-1.416 1.2-1.888.947-.31-.165-.326-.399-.329-4.679-.002-3.293-.06-4.617-.216-4.926l-.213-.421H45.35l-.25.447c-.24.425-.219.501.414 1.518l.666 1.07v4.3c0 4.29 0 4.3-.367 4.352-.5.07-1.505-.864-2.465-2.296-.797-1.188-2.506-4.389-2.898-5.429Z"
                                              fill="#fefbf6"/>
                                    </svg>
                                </a></li>
                            <li class="t-sociallinks__item t-sociallinks__item_youtube"><a
                                    href="https://www.youtube.com/@vrachbudushego/videos?utm_source=site_vb&amp;utm_medium=link&amp;utm_campaign=youtube_vb"
                                    target="_blank" rel="nofollow" aria-label="youtube"
                                    style="width: 30px; height: 30px;">
                                    <svg class="t-sociallinks__svg" role="presentation" width=30px height=30px
                                         viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm17.9-67.374c3.838.346 6 2.695 6.474 6.438.332 2.612.626 6.352.626 10.375 0 7.064-.626 11.148-.626 11.148-.588 3.728-2.39 5.752-6.18 6.18-4.235.48-13.76.7-17.992.7-4.38 0-13.237-.184-17.66-.552-3.8-.317-6.394-2.44-6.916-6.218-.38-2.752-.626-6.022-.626-11.222 0-5.788.209-8.238.7-10.853.699-3.732 2.48-5.54 6.548-5.96C36.516 32.221 40.55 32 49.577 32c4.413 0 13.927.228 18.322.626Zm-23.216 9.761v14.374L58.37 49.5l-13.686-7.114Z"
                                              fill="#fefbf6"/>
                                    </svg>
                                </a></li>
                            <li class="t-sociallinks__item t-sociallinks__item_ok"><a
                                    href="https://ok.ru/group/59792646275093?utm_source=site_vb&amp;utm_medium=link&amp;utm_campaign=ok_vb"
                                    target="_blank" rel="nofollow" aria-label="ok" style="width: 30px; height: 30px;">
                                    <svg class="t-sociallinks__svg" role="presentation" width=30px height=30px
                                         viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M50 100c27.614 0 50-22.386 50-50S77.614 0 50 0 0 22.386 0 50s22.386 50 50 50Zm13.463-63.08c0 7.688-6.233 13.92-13.92 13.92-7.688 0-13.92-6.232-13.92-13.92S41.855 23 49.543 23s13.92 6.232 13.92 13.92Zm-7.072 0a6.848 6.848 0 1 0-13.696 0 6.848 6.848 0 0 0 13.696 0Zm3.341 15.006c2.894-2.28 5.07-.967 5.856.612 1.37 2.753-.178 4.084-3.671 6.326-2.96 1.9-7.016 2.619-9.665 2.892l2.217 2.216 8.203 8.203a3.192 3.192 0 0 1 0 4.514l-.376.376a3.192 3.192 0 0 1-4.514 0l-8.203-8.203-8.203 8.203a3.192 3.192 0 0 1-4.514 0l-.376-.376a3.192 3.192 0 0 1 0-4.514l8.203-8.203 2.21-2.21c-2.648-.268-6.748-.983-9.732-2.898-3.494-2.243-5.041-3.573-3.671-6.326.786-1.579 2.963-2.892 5.855-.612 3.91 3.08 10.19 3.08 10.19 3.08s6.282 0 10.191-3.08Z"
                                              fill="#fefbf6"/>
                                    </svg>
                                </a></li><!-- /new soclinks --></ul>
                    </div>
                    <div class="t451m__right_descr t-descr t-descr_xs" field="descr" style="font-family:'Gotham';">©
                        2023
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>t_onReady(function () {
            var rec = document.querySelector("#rec600440028");
            if (!rec) return
            rec.setAttribute('data-animationappear', 'off');
            rec.style.opacity = 1;
            t_onFuncLoad('t451_initMenu', function () {
                t451_initMenu('600440028');
            });
            t_onFuncLoad('t_menu__interactFromKeyboard', function () {
                t_menu__interactFromKeyboard('600440028');
            });
        });</script>
    <script>t_onReady(function () {
            t_onFuncLoad('t451_appearMenu', function () {
                t451_appearMenu('600440028');
                window.addEventListener('scroll', t_throttle(function () {
                    t451_appearMenu('600440028');
                }));
            });
        });</script>
    <style>#rec600440028 .t-menu__link-item {
        }

        @supports (overflow:-webkit-marquee) and (justify-content:inherit) {
            #rec600440028 .t-menu__link-item,
            #rec600440028 .t-menu__link-item.t-active {
                opacity: 1 !important;
            }
        }</style>
</div>