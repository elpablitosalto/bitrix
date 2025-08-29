const queryMobile576 = window.matchMedia('(max-width: 576px)')
const queryMobile768 = window.matchMedia('(max-width: 768px)')
const queryMobile992 = window.matchMedia('(max-width: 992px)')
// if (headerHamburger) {
//     headerHamburger.addEventListener('click', (event) => {
//         event.preventDefault()
//         // headerHamburger.classList.toggle('header__hamburger_active')
//         // headerHamburger.classList.toggle('header__hamburger')
//     })
// }

getTopBannerSlider ()
function getTopBannerSlider () {
    const topBannerSlider = document.querySelector('.top-banner__slider')
    if (topBannerSlider) {
        addClassSlider(topBannerSlider)
        const swiperTopBanner = new Swiper('.top-banner__slider', {
            direction: 'horizontal',
            speed: 800,
            spaceBetween: 30,
            navigation: {
                nextEl: '.slider-navigation-next',
                prevEl: '.slider-navigation-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 1.1,
                    spaceBetween: 30,
                }
            },
        });
    }
}

getPartnersSlider ()
function getPartnersSlider () {
    const partnersSlider = document.querySelector('.partners__slider')
    if (partnersSlider) {
        addClassSlider(partnersSlider)
        const swiperPartners = new Swiper('.partners__slider', {
            direction: 'horizontal',
            speed: 800,
            slidesPerView: 1.5,
            spaceBetween: 20,
            navigation: {
                nextEl: '.slider-navigation-next',
                prevEl: '.slider-navigation-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 1.3,
                    spaceBetween: 30,
                },
                993: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                }
            },
        });
    }
}


getProductSlider ()
function getProductSlider () {
    const productSlider = document.querySelector('.product-detail__collage_slider')
    if (productSlider && queryMobile576.matches) {
        addClassSlider(productSlider)
        const swiperProduct = new Swiper('.product-detail__collage_slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            slidesPerView: 1.3,
            spaceBetween: 20,
            navigation: {
                nextEl: '.slider-navigation-next',
                prevEl: '.slider-navigation-prev',
            }
        });
    }
}

getServiceSlider ()
function getServiceSlider () {
    const serviceSlider = document.querySelector('.service__swiper')
    if (serviceSlider) {
        addClassSlider(serviceSlider)
        const swiperService = new Swiper('.service__swiper', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            spaceBetween: 20,
            navigation: {
                nextEl: '.service__navigation > .slider-navigation-next',
                prevEl: '.service__navigation > .slider-navigation-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                }
            }
        })
    }
}

getTeamSlider ()
function getTeamSlider () {
    const teamSlider = document.querySelector('.our-team__slider')
    if (teamSlider && queryMobile992.matches) {
        addClassSlider(teamSlider)
        const swiperTeam = new Swiper('.our-team__slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            spaceBetween: 20,
            navigation: {
                nextEl: '.service__navigation > .slider-navigation-next',
                prevEl: '.service__navigation > .slider-navigation-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                }
            }
        })
    }
}

getDocumentationSlider ()
function getDocumentationSlider () {
    const documentationSlider = document.querySelector('.documentation__slider')
    if (documentationSlider && queryMobile768.matches) {
        addClassSlider(documentationSlider)
        const swiperDocumentation = new Swiper('.documentation__slider', {
            direction: 'horizontal',
            speed: 800,
            spaceBetween: 20,
            breakpoints: {
                320: {
                    slidesPerView: 1.1
                },
                577: {
                    slidesPerView: 1.5
                }
            }
        })
    }
}
getLkSlider ()
function getLkSlider () {
    const lkSlider = document.querySelector('.lk-slider')
    if (lkSlider) {
        addClassSlider(lkSlider)
        const swiperLk = new Swiper('.lk-slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            spaceBetween: 20,
            breakpoints: {
                320: {
                    slidesPerView: 1.2
                },
                577: {
                    slidesPerView: 1.5
                },
                993: {
                    slidesPerView: 2.1
                },
                1281: {
                    slidesPerView: 2.1
                },
            }
        })
    }
}

function addClassSlider(nameSlider) {
    nameSlider.classList.add('swiper')
    nameSlider.firstElementChild.classList.add('swiper-wrapper')
    const swiperSlider = nameSlider.querySelector('.swiper-wrapper')
    for (const child of swiperSlider.children) {
        child.classList.add('swiper-slide')
    }
}

// selectrics init
function initSelectrics() {
    $('select').selectric();
}
initSelectrics();

// custom table hover js logic
function customTableHover() {
    $(".c-custom-table__item").hover(
        e => {
            if (!$(e.currentTarget).hasClass('c-custom-table__item--title')) {
                const siblings = $(e.currentTarget).siblings()
                const top = $(e.currentTarget).offset().top;
                for(let elem of siblings) {
                    ($(elem).offset().top === top) ? $(elem).css({backgroundColor: "#E61865", color: "white"}).addClass('js--no-border') : $(elem).css({backgroundColor: "#F8F8F8", color: "#1D1B1B"}).removeClass('js--no-border')
                }
                $(e.currentTarget).css({backgroundColor: "#E61865", color: "white"}).addClass('js--no-border')
            }
        },
        e => {
            const siblings = $(e.currentTarget).siblings()
            const top = $(e.currentTarget).offset().top;
            for(let elem of siblings) {
                ($(elem).offset().top === top) ? $(elem).css({backgroundColor: "#F8F8F8", color: "#1D1B1B"}).removeClass('js--no-border') : ''
            }
            $(e.currentTarget).css({backgroundColor: "#F8F8F8", color: "#1D1B1B"}).removeClass('js--no-border')
        }
    )
}
customTableHover();

function scrollAnchorInit() {
    $(".js--scroll-link").click(function() {
        $("html, body").animate({
            scrollTop: $($(this).attr("href")).offset().top - 20 + "px"
        }, {
            duration: 500,
            easing: "swing"
        });
        return false;
    });
}
scrollAnchorInit();

function bannerVideoButtonInit() {
    $(".header-top-banner__play").click(({currentTarget: target}) => {
        const pause = $(target).siblings(".header-top-banner__pause")
        const video = $(target).parent().find("video")[0]

        $(target).fadeOut()
        $(pause).fadeIn()

        video.addEventListener('ended', () => {
            $(pause).fadeOut()
            $(target).fadeIn()
        })

        $(pause).click(() => {
            $(pause).fadeOut()
            $(target).fadeIn()
            video.pause()
        })

        if (video) { video.play() }
    })
}
bannerVideoButtonInit();

function initMenuHoverCategory() {
    $(".c-menu .c-menu__category-item").hover(
        ({currentTarget:target}) => {
            const id = target.dataset.menuLinkId
            $('.c-menu__category-img img').removeClass("c-menu__link--active")
            $(`.c-menu__category-img img[data-menu-link-id="${id}"]`).addClass('c-menu__link--active')
        }
    )
}
initMenuHoverCategory();


function initMenu() {
    const headerHamburger = $(".header__hamburger")
    // $(headerHamburger).on('click tap touchstart', ()=> {
    headerHamburger.click(()=> {
        if ($(headerHamburger).hasClass("burger--active")) {
            $(".c-menu").fadeOut()
            $(headerHamburger).toggleClass("burger--active")
        }
        else {
            $(headerHamburger).toggleClass("burger--active")
            $(".c-menu").fadeIn('medium', function () {
                $(this).css('display','inline-block');
            })
        }
    })

    $(".c-menu__close").click(() => {
        $(".c-menu").fadeOut()
        $(headerHamburger).toggleClass("burger--active")
    })
}
initMenu();

const overlay = document.querySelector('.overlay')
const popupClose = document.querySelector('.popup_close')

function closePopup(popupName, buttonClose, overlay) {
    if (popupName && buttonClose && overlay) {
        buttonClose.addEventListener('click', event => {
            event.preventDefault()
            popupName.classList.remove('display-on')
            overlay.classList.remove('display-on')
        })
        overlay.addEventListener('click', event => {
            event.preventDefault()
            popupName.classList.remove('display-on')
            overlay.classList.remove('display-on')
        })
        window.addEventListener('keydown', event => {
            if (event.keyCode === 27) {
                event.preventDefault()
                popupName.classList.remove('display-on')
                overlay.classList.remove('display-on')
            }
        })
    }
}
function openPopup(popupName, buttonOpen, buttonClose) {
    if (popupName && buttonOpen && buttonClose) {
        buttonOpen.addEventListener('click', (event) => {
            event.preventDefault()
            popupName.classList.add('display-on')
            overlay.classList.add('display-on')
        })
        closePopup(popupName, buttonClose, overlay)
    }
}

initPopupBaseVideo ()
function initPopupBaseVideo () {
    const popupVideo = document.querySelector('.popup__video')
    const baseVideo = document.querySelectorAll('.base__item-video')
    const popupVideoLocal = document.querySelector('.local-video')
    const popupVideoYoutube = document.querySelector('.youtube-video')
    if (popupVideo && baseVideo && popupClose && popupVideoLocal && popupVideoYoutube) {
        const popupVideoLink = popupVideoLocal.querySelector('.popup__video video source')
        const popupYoutubeLink = popupVideoYoutube.querySelector('iframe')
        baseVideo.forEach(item => {
            item.addEventListener('click', (event) => {
                event.preventDefault()
                const videoBlock = item.querySelector('.base__video')
                const videoLink = videoBlock.dataset.linkVideo
                if (videoLink.includes('https://youtu')) {
                    popupVideoYoutube.classList.add('display-on')
                    // popupYoutubeLink.setAttribute('src', videoLink)
                } else {
                    popupVideoLocal.classList.add('display-on')
                    // popupVideoLink.setAttribute('src', videoLink)
                }
                popupVideo.classList.add('display-on')
                overlay.classList.add('display-on')
            })
            popupClose.addEventListener('click', (event) => {
                event.preventDefault()
                popupVideo.classList.remove('display-on')
                overlay.classList.remove('display-on')
                popupVideoYoutube.classList.remove('display-on')
                popupVideoLocal.classList.remove('display-on')
            })
            overlay.addEventListener('click', (event) => {
                event.preventDefault()
                popupVideo.classList.remove('display-on')
                overlay.classList.remove('display-on')
                popupVideoYoutube.classList.remove('display-on')
                popupVideoLocal.classList.remove('display-on')
            })
            window.addEventListener("keydown", function (event) {
                if (event.keyCode === 27) {
                    event.preventDefault()
                    popupVideo.classList.remove('display-on')
                    overlay.classList.remove('display-on')
                    popupVideoYoutube.classList.remove('display-on')
                    popupVideoLocal.classList.remove('display-on')
                }
            })
        })
    }
}
const popupOrder = document.querySelector('.popup__order')
initPopupOrder ()
function initPopupOrder () {
    const popupOrderOpen = document.querySelector('.lk-order__add')
    if (popupOrder && popupOrderOpen && popupClose) {
        openPopup(popupOrder, popupOrderOpen, popupClose)
    }
}

initPopupReagent ()
function initPopupReagent () {
    const popupReagent = document.querySelector('.popup-reagent')
    const popupReagentOpen = document.querySelectorAll('.js_bookmarks-table__popup')
    const popupReagentItem = document.querySelectorAll('.popup-reagent__item')
    if (popupReagent && popupReagentOpen && popupClose) {
        popupReagentOpen.forEach(item => {
            openPopup(popupReagent, item, popupClose)
        })
    }
    if (popupReagentItem && popupReagent) {
        popupReagentItem.forEach(item => {
            item.addEventListener('click', event => {
                popupReagent.classList.remove('display-on')
                overlay.classList.remove('display-on')
            })
        })
    }
}

initPopupAuthorization ()
function initPopupAuthorization () {
    const popupAuthorization = document.querySelector('.popup-authorization')
    const popupAuthorizationOpen = document.querySelectorAll('.bookmarks-table_add')
    if (popupAuthorizationOpen && popupAuthorization && popupClose) {
        popupAuthorization.querySelector('.popup_close').addEventListener('click', e => {
            e.preventDefault()
            popupAuthorization.classList.remove('display-on')
            overlay.classList.remove('display-on')
        })
        popupAuthorizationOpen.forEach(item => {
            openPopup(popupAuthorization, item, popupClose)
        })
    }
}

const observerDocumentation = new IntersectionObserver(entries => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            document.querySelectorAll('.page-menu__item > a').forEach((link) => {
                link.classList.toggle('page-menu__link_active', link.getAttribute('href').replace('#', '') === entry.target.id)
            })
        }
    })
}, { threshold: 0.3 })
document.querySelectorAll('.documentation__anchor').forEach((item) => observerDocumentation.observe(item))

function prettify(number) {
    let n = number.toString()
    return n.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g, "$1" + ' ')
}

const lkOrderSum = document.querySelector('.lk__order-sum')
const lkOrderTotalCoast = document.querySelector('.lk__order-total_coast')
if (lkOrderSum) {
    lkOrderSum.innerText = prettify(lkOrderSum.innerText)
}
if (lkOrderTotalCoast) {
    lkOrderTotalCoast.innerText = prettify(lkOrderTotalCoast.innerText)
}

initPopupConfirm ()
function initPopupConfirm () {
    const popupConfirm = document.querySelector('.popup-confirm')
    const popupConfirmOpen = document.querySelector('.c-form__send')
    if (popupConfirm && popupConfirmOpen && popupClose) {
        openPopup(popupConfirm, popupConfirmOpen, popupClose)
    }
}

initPopupConfirmation ()
function initPopupConfirmation () {
    const popupConfirmation = document.querySelector('.popup-confirmation')
    const popupConfirmationOpen = document.querySelector('.link-button_registration')
    if (popupConfirmation && popupConfirmationOpen && popupClose) {
        openPopup(popupConfirmation, popupConfirmationOpen, popupClose)
    }
}

initPopupPassword ()
function initPopupPassword () {
    const popupPassword = document.querySelector('.popup-password')
    const popupPasswordOpen = document.querySelector('.password-form__wrapper > .link-button_rose')
    if (popupPassword && popupPasswordOpen && popupClose) {
        openPopup(popupPassword, popupPasswordOpen, popupClose)
    }
}

initSearchInputs()
function initSearchInputs() {
    const searchInputs = document.querySelectorAll('.c-form--label__search')
    const inputOrderSearch = document.querySelector('.c-form--label__order-search > .c-form--input')
    const popupOrderOpenSearch = document.querySelector('.lk-order__add-search')

    if (searchInputs) {
        searchInputs.forEach(item => {
            const searchInput = item.querySelector('.c-form--input')
            const searchClear = item.querySelector('.c-form--label__search_clear')
            const searchResult = item.querySelector('.c-form--label__result')
            searchInput.addEventListener('input', event => {
                if (searchInput.value.length > 0) {
                    searchClear.classList.remove('display-none')
                    if (searchResult) {
                        searchResult.classList.remove('display-none')
                    }
                }
                if (searchInput.value.length < 1) {
                    searchClear.classList.add('display-none')
                    if (searchResult) {
                        searchResult.classList.add('display-none')
                    }
                }
                if (popupOrder && popupOrderOpenSearch && popupClose) {
                    popupOrderOpenSearch.addEventListener('click', (event) => {
                        if (searchInput.value.length > 2) {
                            event.preventDefault()
                            popupOrder.classList.add('display-on')
                            overlay.classList.add('display-on')
                        }
                    })
                    inputOrderSearch.addEventListener('keydown', event => {
                        if (event.keyCode === 13 && searchInput.value.length > 2) {
                            event.preventDefault()
                            popupOrder.classList.add('display-on')
                            overlay.classList.add('display-on')
                        }
                    })
                    closePopup(popupOrder, popupClose, overlay)
                }
            })
            searchClear.addEventListener('click', event => {
                event.preventDefault()
                searchClear.classList.add('display-none')
                if (searchResult) {
                    searchResult.classList.add('display-none')
                }
                searchInput.value = ''
            })
        })
    }
}



const passwordInputs = document.querySelectorAll('.registration-input')
const showPasswordButtons = document.querySelectorAll('.registration-form__show-password')
const hidePasswordButtons = document.querySelectorAll('.registration-form__hide-password')
const passwordSubmitButton = document.querySelector('.password-form__wrapper > .link-button_rose')
if (passwordInputs) {
    showPasswordButtons.forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault()
            item.parentNode.querySelector('.registration-input').type = 'text'
            item.classList.add('display-none')
            item.parentNode.querySelector('.registration-form__hide-password').classList.remove('display-none')
        })
    })
    hidePasswordButtons.forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault()
            item.parentNode.querySelector('.registration-input').type = 'password'
            item.classList.add('display-none')
            item.parentNode.querySelector('.registration-form__show-password').classList.remove('display-none')
        })
    })

    checkPasswordInputs()
    function checkPasswordInputs() {
        if (passwordSubmitButton) {
            const passwordInputs = document.querySelectorAll('.registration-input')
            for (let i=0; i<passwordInputs.length; i++) {
                if (passwordInputs[i].value.length < 1) {
                    passwordSubmitButton.classList.add('link-button_password')
                    passwordSubmitButton.disabled = true
                    break
                } else {
                    passwordSubmitButton.classList.remove('link-button_password')
                    passwordSubmitButton.disabled = false
                }
            }
        }
    }
    passwordInputs.forEach(item => {
        item.addEventListener('input', event => {
            checkPasswordInputs()
        })
    })
}

showpPofileFormPassword ()
function showpPofileFormPassword () {
    const profileFormPasswords = document.querySelector('.profile-form__passwords')
    const profilePasswordButton = document.querySelector('.profile-form__password')
    const profilePasswordSaveButton = document.querySelector('.profile-form__password-save')
    if (profileFormPasswords && profilePasswordButton && profilePasswordSaveButton) {
        profilePasswordButton.addEventListener('click', event => {
            event.preventDefault()
            profilePasswordButton.classList.add('display-none')
            profileFormPasswords.classList.remove('display-none')
            profilePasswordSaveButton.classList.remove('display-none')
        })
        /*
        profilePasswordSaveButton.addEventListener('click', event => {
            event.preventDefault()
            profilePasswordSaveButton.classList.add('display-none')
            profileFormPasswords.classList.add('display-none')
            profilePasswordButton.classList.remove('display-none')
        })
        */
    }
}