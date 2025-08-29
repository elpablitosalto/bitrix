const queryMobile1201 = window.matchMedia('(min-width: 1201px)')
const queryMobile1200 = window.matchMedia('(max-width: 1200px)')
const queryMobile991 = window.matchMedia('(max-width: 991px)')
const queryMobile768 = window.matchMedia('(max-width: 767px)')
const queryMobile576 = window.matchMedia('(max-width: 576px)')
const queryMobile480 = window.matchMedia('(min-width: 480px)')
const queryMobile479 = window.matchMedia('(min-width: 479px)')
const overlay = document.querySelector('.overlay')

// Отбивка трех цифр в цене
const productPriceSum = document.querySelectorAll('.product__price_sum')
const productPriceOldSum = document.querySelectorAll('.product__price-old-sum')
const productPriceForSum = document.querySelectorAll('.product__price-for_sum')
const productItem = document.querySelectorAll('.product__item')
const cardCost = document.querySelector('.card-title__cost-first')
const cardCostOld = document.querySelector('.card-title__old-price span')
const cardCostSecond = document.querySelector('.card-title__cost-second')
const searchPrice = document.querySelectorAll('.search__item-price')
const searchSumfor = document.querySelectorAll('.search__item-sumfor')
const cardMainPrice = document.querySelector('.card-main__price')
const cardColorCoast = document.querySelector('.order-color__price_coast')

if (productPriceSum) {
    productPriceSum.forEach(element => {
        element.innerText = prettify(element.innerText)
    })
}
if (productPriceOldSum) {
    productPriceOldSum.forEach(element => {
        element.innerText = prettify(element.innerText)
    })
}
if (productPriceForSum) {
    productPriceForSum.forEach(element => {
        element.innerText = prettify(element.innerText)
    })
}
if (cardCost) {
    cardCost.innerText = prettify(cardCost.innerText)
}
if (cardCostOld) {
    cardCostOld.innerText = prettify(cardCostOld.innerText)
}
if (cardCostSecond) {
    cardCostSecond.innerText = prettify(cardCostSecond.innerText)
}
if (cardMainPrice) {
    cardMainPrice.innerText = prettify(cardMainPrice.innerText)
}
if (cardColorCoast) {
    cardColorCoast.innerText = prettify(cardColorCoast.innerText)
}
if (searchPrice) {
    searchPrice.forEach(element => {
        element.innerText = prettify(element.innerText)
    })
}
if (searchSumfor) {
    searchSumfor.forEach(element => {
        element.innerText = prettify(element.innerText)
    })
}

function prettify(number) {
    let n = number.toString()
    return n.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g, "$1" + ' ')
}

// Логика кнопок добавления по количеству в карточке товара

if (productItem) {
    productItem.forEach(element => {
        let productAvailability = element.querySelector('.product__availability_quantity')
        if (productAvailability) {
            productAvailability = +productAvailability.innerText
            const productAddControlMinus = element.querySelector('.product__add_control_minus')
            const productAddControlPlus = element.querySelector('.product__add_control_plus')
            let productAddQuantity = element.querySelector('.product__add span')
            if (productAddQuantity) {
                let productAddQuantityNumber = +productAddQuantity.innerText
                if (productAddQuantityNumber === 0) {
                    productAddControlMinus.disabled = true
                    productAddControlMinus.classList.add('product__add_end')
                }
                if (productAddQuantityNumber === productAvailability) {
                    productAddControlPlus.disabled = true
                    productAddControlPlus.classList.add('product__add_end')
                }

                productAddControlMinus.addEventListener('click', () => {
                    if (productAddQuantityNumber > 0) {
                        productAddQuantityNumber--
                        productAddQuantity.innerText = productAddQuantityNumber
                        productAddControlPlus.disabled = false
                        productAddControlPlus.classList.remove('product__add_end')
                    }
                    if (productAddQuantityNumber === 0) {
                        productAddControlMinus.disabled = true
                        productAddControlMinus.classList.add('product__add_end')
                    }
                })

                productAddControlPlus.addEventListener('click', () => {
                    if (productAddQuantityNumber < productAvailability) {
                        productAddQuantityNumber++
                        productAddQuantity.innerText = productAddQuantityNumber
                        productAddControlMinus.disabled = false
                        productAddControlMinus.classList.remove('product__add_end')
                    }
                    if (productAddQuantityNumber === productAvailability) {
                        productAddControlPlus.classList.add('product__add_end')
                        productAddControlPlus.disabled = true
                    }
                })
            }
        }
    })
}

// Логика кнопок добавления по количеству в сопутствующих товарах
const relatedItem = document.querySelectorAll('.related__item')

if (relatedItem) {
    relatedItem.forEach(element => {
        let productAvailability = element.querySelector('.related__availability_quantity')
        if (productAvailability) {
            productAvailability = +productAvailability.innerText
            const productAddControlMinus = element.querySelector('.related__add_control_minus')
            const productAddControlPlus = element.querySelector('.related__add_control_plus')
            let productAddQuantity = element.querySelector('.related__add span')
            if (productAddQuantity) {
                let productAddQuantityNumber = +productAddQuantity.innerText
                if (productAddQuantityNumber === 0) {
                    productAddControlMinus.disabled = true
                    productAddControlMinus.classList.add('related__add_end')
                }
                if (productAddQuantityNumber === productAvailability) {
                    productAddControlPlus.disabled = true
                    productAddControlPlus.classList.add('related__add_end')
                }

                productAddControlMinus.addEventListener('click', () => {
                    if (productAddQuantityNumber > 0) {
                        productAddQuantityNumber--
                        productAddQuantity.innerText = productAddQuantityNumber
                        productAddControlPlus.disabled = false
                        productAddControlPlus.classList.remove('related__add_end')
                    }
                    if (productAddQuantityNumber === 0) {
                        productAddControlMinus.disabled = true
                        productAddControlMinus.classList.add('related__add_end')
                    }
                })

                productAddControlPlus.addEventListener('click', () => {
                    if (productAddQuantityNumber < productAvailability) {
                        productAddQuantityNumber++
                        productAddQuantity.innerText = productAddQuantityNumber
                        productAddControlMinus.disabled = false
                        productAddControlMinus.classList.remove('related__add_end')
                    }
                    if (productAddQuantityNumber === productAvailability) {
                        productAddControlPlus.classList.add('related__add_end')
                        productAddControlPlus.disabled = true
                    }
                })
            }
        }
    })
}

// Логика кнопок добавления по количеству в аналогичных товарах
const analogItem = document.querySelectorAll('.analog__item')

if (analogItem) {
    analogItem.forEach(element => {
        let productAvailability = element.querySelector('.analog__availability_quantity')
        if (productAvailability) {
            productAvailability = +productAvailability.innerText
            const productAddControlMinus = element.querySelector('.analog__add_control_minus')
            const productAddControlPlus = element.querySelector('.analog__add_control_plus')
            let productAddQuantity = element.querySelector('.analog__add span')
            if (productAddQuantity) {
                let productAddQuantityNumber = +productAddQuantity.innerText
                if (productAddQuantityNumber === 0) {
                    productAddControlMinus.disabled = true
                    productAddControlMinus.classList.add('analog__add_end')
                }
                if (productAddQuantityNumber === productAvailability) {
                    productAddControlPlus.disabled = true
                    productAddControlPlus.classList.add('analog__add_end')
                }

                productAddControlMinus.addEventListener('click', () => {
                    if (productAddQuantityNumber > 0) {
                        productAddQuantityNumber--
                        productAddQuantity.innerText = productAddQuantityNumber
                        productAddControlPlus.disabled = false
                        productAddControlPlus.classList.remove('analog__add_end')
                    }
                    if (productAddQuantityNumber === 0) {
                        productAddControlMinus.disabled = true
                        productAddControlMinus.classList.add('analog__add_end')
                    }
                })

                productAddControlPlus.addEventListener('click', () => {
                    if (productAddQuantityNumber < productAvailability) {
                        productAddQuantityNumber++
                        productAddQuantity.innerText = productAddQuantityNumber
                        productAddControlMinus.disabled = false
                        productAddControlMinus.classList.remove('analog__add_end')
                    }
                    if (productAddQuantityNumber === productAvailability) {
                        productAddControlPlus.classList.add('analog__add_end')
                        productAddControlPlus.disabled = true
                    }
                })
            }
        }
    })
}

// Слайдеры

const topBannerSlider = document.querySelector('.top-banner__slider')
const suppliesSlider = document.querySelector('.supplies__slider')
const storySlider = document.querySelector('.story__slider')
const productSlider = document.querySelector('.product__slider')
const distributorSlider = document.querySelector('.distributor__slider')
const officeSlider = document.querySelector('.office__slider')
const relatedSlider = document.querySelector('.related__slider')
const analogSlider = document.querySelector('.analog__slider')
const popularSlider = document.querySelector('.popular__slider')
const viewedSlider = document.querySelector('.viewed__slider')
const cardSlider = document.querySelector('.card-title__images-slider')
const officesSlider = document.querySelector('.offices__slider')
const certificateSlider = document.querySelector('.certificate__slider')
const deliverySlider = document.querySelector('.delivery__slider')
const recommendationSlider = document.querySelector('.recommendation__slider')
const cardTitleImageSlider = document.querySelector('.card-title__image-slider')
const articleSlide = document.querySelectorAll('.article__slide')
const storiesSlider = document.querySelector('.stories__slider')

if (articleSlide) {
    for(let i=0; i< articleSlide.length; i++) {
        addClassSlider(articleSlide[i])
        articleSlide[i].classList.add('article__slide-' + i);
        const swiperArticle = new Swiper('.article__slide-' + i, {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            breakpoints: {
                360: {
                    slidesPerView: 2.1,
                    spaceBetween: 0
                },
                577: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                992: {
                    slidesPerView: 2.6,
                    spaceBetween: 20
                }
            },
        });
    }
}

if (topBannerSlider) {
    addClassSlider(topBannerSlider)
    const swiperTopBanner = new Swiper('.top-banner__slider', {
        direction: 'horizontal',
        loop: true,
        speed: 800,
        autoplay: {
            delay: 5000
        },
        navigation: {
            nextEl: '.top-banner__control_right',
            prevEl: '.top-banner__control_left',
        },
    });
}
if (suppliesSlider) {
    addClassSlider(suppliesSlider)
    const swiperSupplies = new Swiper('.supplies__slider', {
        direction: 'horizontal',
        loop: true,
        speed: 800,

        navigation: {
            nextEl: '.supplies__next',
            prevEl: '.supplies__prev',
        },
    });
}
if (storySlider) {
    addClassSlider(storySlider)
    const swiperStory = new Swiper('.story__slider', {
        direction: 'horizontal',
        loop: true,
        speed: 800,

        navigation: {
            nextEl: '.story__next',
            prevEl: '.story__prev',
        },
    });
}
if (productSlider) {
    addClassSlider(productSlider)
    const swiperProductMenu = document.querySelectorAll('.products__item')
    swiperProductMenu.forEach(function (slide, number) {
        slide.addEventListener('click', () => {
            swiperProductMenu[swiperProduct.activeIndex].classList.remove('products__item_active')
            swiperProductMenu[number].classList.add('products__item_active')
            swiperProduct.slideTo(number)
        })
    })
    const swiperProduct = new Swiper('.product__slider', {
        direction: 'horizontal',
        simulateTouch: false,
        speed: 800,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
    });
}
if (deliverySlider) {
    addClassSlider(deliverySlider)
    const swiperDeliveryMenu = document.querySelectorAll('.delivery__slider-item')
    swiperDeliveryMenu.forEach(function (slide, number) {
        slide.addEventListener('click', () => {
            swiperDeliveryMenu[swiperDelivery.activeIndex].classList.remove('delivery__slider-item_active')
            swiperDeliveryMenu[number].classList.add('delivery__slider-item_active')
            swiperDelivery.slideTo(number)
        })
    })
    const swiperDelivery = new Swiper('.delivery__slider', {
        direction: 'horizontal',
        speed: 800,
        effect: 'fade',
        simulateTouch: false,
        fadeEffect: {
            crossFade: true
        },
    });
}
if (distributorSlider) {
    addClassSlider(distributorSlider)
    const swiperDistributor = new Swiper('.distributor__slider', {
        direction: 'horizontal',
        loop: true,
        speed: 800,
        slidesPerView: 4,
        spaceBetween: 20,
        breakpoints: {
            360: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 20
            }
        },
        pagination: {
            el: '.distributor__pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.distributor__next',
            prevEl: '.distributor__prev',
        },
    });
}
if (certificateSlider) {
    addClassSlider(certificateSlider)
    const swiperCertificate = new Swiper('.certificate__slider', {
        direction: 'horizontal',
        loop: true,
        speed: 800,
        slidesPerView: 4,
        spaceBetween: 20,
        breakpoints: {
            360: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 20
            }
        },
        navigation: {
            nextEl: '.certificate__next',
            prevEl: '.certificate__prev',
        },
    });
}
if (officeSlider) {
    if (queryMobile991.matches) {
        addClassSlider(officeSlider)
        const swiperOffice = new Swiper('.office__slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            breakpoints: {
                360: {
                    slidesPerView: 1.1,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 1.2,
                    spaceBetween: 15
                }
            },
            navigation: {
                nextEl: '.office__next',
                prevEl: '.office__prev',
            },
        });
    }
}
if (officesSlider) {
    addClassSlider(officesSlider)
    const swiperOffices = new Swiper('.offices__slider', {
        direction: 'horizontal',
        loop: true,
        speed: 800,

        navigation: {
            nextEl: '.offices__next',
            prevEl: '.offices__prev',
        },
    });
}
if (relatedSlider) {
    if (queryMobile480.matches) {
        addClassSlider(relatedSlider)
        const swiperRelated = new Swiper('.related__slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            slidesPerView: 4,
            spaceBetween: 20,
            breakpoints: {
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 20
                }
            },
            navigation: {
                nextEl: '.related__next',
                prevEl: '.related__prev',
            }

        });
    }
}
if (analogSlider) {
    if (queryMobile480.matches) {
        addClassSlider(analogSlider)
        const swiperAnalog = new Swiper('.analog__slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            slidesPerView: 4,
            spaceBetween: 20,
            breakpoints: {
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 20
                }
            },
            navigation: {
                nextEl: '.analog__next',
                prevEl: '.analog__prev',
            }
        });
    }
}
if (popularSlider) {
    if (queryMobile480.matches) {
        addClassSlider(popularSlider)
        const swiperPopular = new Swiper('.popular__slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            slidesPerView: 4,
            spaceBetween: 20,
            breakpoints: {
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 20
                }
            },
            navigation: {
                nextEl: '.popular__next',
                prevEl: '.popular__prev',
            },
        });
    }
}
if (viewedSlider) {
    if (queryMobile480.matches) {
        addClassSlider(viewedSlider)
        const swiperViewed = new Swiper('.viewed__slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            slidesPerView: 4,
            spaceBetween: 20,
            breakpoints: {
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 20
                }
            },
            navigation: {
                nextEl: '.viewed__next',
                prevEl: '.viewed__prev',
            }
        });
    }
}
if (recommendationSlider) {
    if (queryMobile480.matches) {
        addClassSlider(recommendationSlider)
        const swiperRecommendation = new Swiper('.recommendation__slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            slidesPerView: 4,
            spaceBetween: 20,
            breakpoints: {
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 20
                }
            },
            navigation: {
                nextEl: '.recommendation__next',
                prevEl: '.recommendation__prev',
            }
        });
    }
}
if (storiesSlider) {
    addClassSlider(storiesSlider)
    const swiperStories = new Swiper('.stories__slider', {
        direction: 'horizontal',
        loop: true,
        speed: 800,
        slidesPerView: 4,
        spaceBetween: 20,
        breakpoints: {
            360: {
                slidesPerView: 2,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 4,
                spaceBetween: 20
            }
        },
        navigation: {
            nextEl: '.stories__next',
            prevEl: '.stories__prev',
        },
    });
}
initPopupAddToBasketSlider()
function initPopupAddToBasketSlider() {
    const orderBasketSlider = document.querySelector('.order-basket__slider')
    if (orderBasketSlider) {
        if (queryMobile480.matches) {
            addClassSlider(orderBasketSlider)
            const swiperOrderBasket = new Swiper('.order-basket__slider', {
                direction: 'horizontal',
                loop: true,
                speed: 800,
                slidesPerView: 1,
                spaceBetween: 20,
                breakpoints: {
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    576: {
                        slidesPerView: 1,
                        spaceBetween: 15
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    }
                },
                navigation: {
                    nextEl: '.order-basket__next',
                    prevEl: '.order-basket__prev',
                }
            });
        }
    }
}

if (cardSlider) {
    addClassSlider(cardSlider)
    const swiperCardMenu = document.querySelectorAll('.card-title__image-slide')
    const cardTitleVideoSlide = document.querySelectorAll('.card-title__image')
    swiperCardMenu.forEach(function (slide, number) {
        slide.addEventListener('click', () => {
            swiperCard.slideTo(number)
        })
    })

    const swiperCard = new Swiper('.card-title__images-slider', {
        direction: 'horizontal',
        loop: true,
        speed: 800,
        pagination: {
            el: '.card-title__images-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.card-title__image-slider-navigation_next',
            prevEl: '.card-title__image-slider-navigation_prev'
        },
    });
    swiperCard.on('slideChange', function () {
        swiperCardMenu.forEach((slide) => {
            slide.classList.remove('card-title__image-slide_active')
        })
        swiperCardMenu[swiperCard.realIndex].classList.add('card-title__image-slide_active')
    });
}

if (cardTitleImageSlider) {
    if (queryMobile1201.matches) {
        addClassSlider(cardTitleImageSlider)
        const swiperCardTitleImage = new Swiper('.card-title__image-slider', {
            direction: 'horizontal',
            loop: true,
            speed: 800,
            slidesPerView: 5,
            spaceBetween: 0,
            navigation: {
                prevEl: '.card-title__image-slider-navigation',
            },
        });
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

// Ограничение по количеству видимых товаров в блоке goods

const goodsGroutsList = document.querySelector('.goods-grouts__list')
const productsGroutsGoods = document.querySelector('.products-grouts__goods')

if (queryMobile991.matches) {
    limitationGoods(goodsGroutsList, 6)
    limitationGoods(productsGroutsGoods, 9)
} if (queryMobile576.matches) {
    limitationGoods(goodsGroutsList, 4)
}
else {
    limitationGoods(productsGroutsGoods, 7)
}

function limitationGoods(block, limitNumber) {
    if (block) {
        const goodsGroutsItemShow = block.querySelector('.goods-grouts__item_show')
        const goodsGroutsItem = block.querySelectorAll('.goods-grouts__item')
        goodsGroutsItem.forEach((item, index) => {
            if (index > limitNumber - 1) {
                item.classList.add('goods-grouts__item_hidden')
                goodsGroutsItemShow.classList.remove('goods-grouts__item_hidden')
            }
        })
        goodsGroutsItemShow.addEventListener('click', () => {
            goodsGroutsItem.forEach(item => {
                item.classList.remove('goods-grouts__item_hidden')
            })
            goodsGroutsItemShow.classList.add('goods-grouts__item_hidden')
        })
    }
}

// Ограничение по количеству видимых товаров в блоке category
const categoryMapei = document.querySelector('.category-mapei')

if (queryMobile991.matches) {
    limitationCategory(categoryMapei, 8)
}
if (queryMobile576.matches) {
    limitationCategory(categoryMapei, 6)
}
function limitationCategory(block, limitNumber) {
    if (block) {
        const categoryItemShow = block.querySelector('.category__show-list')
        const categoryItem = block.querySelectorAll('.category__item')
        categoryItemShow.classList.remove('category__show-list_hidden')
        categoryItem.forEach((item, index) => {
            if (index > limitNumber - 1) {
                item.classList.add('category-hidden')
            }
        })
        categoryItemShow.addEventListener('click', () => {
            categoryItem.forEach(item => {
                item.classList.remove('category-hidden')
            })
            categoryItemShow.classList.add('category__show-list_hidden')
        })

    }
}

// Ограничение по количеству видимых товаров в блоке characteristics
const characteristicsList = document.querySelector('.card-title__characteristics-list')

if (characteristicsList) {
    limitationCharacteristics(characteristicsList, 3)
}

function limitationCharacteristics(block, limitNumber) {
    if (block) {
        const characteristicsItemShow = block.querySelector('.card-title__characteristics-list button')
        const characteristicsItem = block.querySelectorAll('.card-title__characteristics-list dl')
        if (characteristicsItem.length > limitNumber) {
            characteristicsItemShow.classList.remove('card-title__characteristics-list_hidden')
            characteristicsItem.forEach((item, index) => {
                if (index > limitNumber - 1) {
                    item.classList.add('card-title__characteristics-list_hidden')
                }
            })
            characteristicsItemShow.addEventListener('click', () => {
                characteristicsItem.forEach(item => {
                    item.classList.remove('card-title__characteristics-list_hidden')
                })
                characteristicsItemShow.classList.add('card-title__characteristics-list_hidden')
            })
        } else {
            characteristicsItemShow.classList.add('card-title__characteristics-list_hidden')
        }
    }
}

// Ограничение по количеству видимых товаров в блоке color
const colorList = document.querySelector('.card-title__color-wrapper')
const orderColorPopup = document.querySelector('.order-color')

if (colorList && orderColorPopup) {
    limitationColor(colorList, 3, orderColorPopup)
}
function limitationColor(block, limitNumber, popup) {
    const orderColorClose = orderColorPopup.querySelector('.popup-form__popup_close')
    const orderColorCancel = orderColorPopup.querySelector('.card-title__control > .card-title__buy')
    if (block && orderColorPopup) {
        const colorItemShow = block.querySelector('.card-title__colors button')
        const colorLastItem = block.querySelector('.card-title__colors:last-child')
        const colorItem = block.querySelectorAll('.card-title__colors')
        if (colorItemShow) {
            colorItemShow.classList.remove('card-title__color-hidden')
        }
        if (colorItem) {
            colorItem.forEach((item, index) => {
                item.classList.remove('display-none')
                if (index > limitNumber - 1) {
                    item.classList.add('card-title__color-hidden')
                    colorLastItem.classList.remove('card-title__color-hidden')
                }
            })
        }
        if (colorItemShow && orderColorClose) {
            openPopup(popup, colorItemShow, orderColorClose)
        }
        /*        colorItemShow.addEventListener('click', () => {
                    colorItem.forEach(item => {
                        item.classList.remove('card-title__color-hidden')
                    })
                    colorItemShow.classList.add('card-title__color-hidden')
                })*/

        if (colorItemShow && colorItem) {
            colorItemShow.innerText = '+' + (colorItem.length - limitNumber - 1)
        }
    }
    orderColorCancel.addEventListener('click', (event) => {
        event.preventDefault()
        popup.classList.remove('display-on')
        overlay.classList.remove('display-on')
    })
}

// Радиокнопки из ссылок цвета и веса
makeRadiobuttonColor()
function makeRadiobuttonColor() {
    const colorItem = document.querySelectorAll('.card-title__characteristic-wrapper .card-title__colors')
    const colorItemPopup = document.querySelectorAll('.order-color .card-title__colors')
    if (colorItem) {
        colorItem.forEach((item) => {
            const colorBlock = item.querySelector('.card-title__colors-block')
            if (colorBlock) {
                item.addEventListener('click', event => {
                    document.querySelectorAll('.card-title__characteristic-wrapper .card-title__colors-active').forEach(element => {
                        element.classList.remove('card-title__colors-active')
                    })
                    colorBlock.classList.add('card-title__colors-active')
                })
            }
        })
    }
    if (colorItemPopup) {
        colorItemPopup.forEach((item) => {
            const colorBlockPopup = item.querySelector('.card-title__colors-block')
            if (colorBlockPopup) {
                item.addEventListener('click', event => {
                    document.querySelectorAll('.order-color .card-title__colors-active').forEach(element => {
                        element.classList.remove('card-title__colors-active')
                    })
                    colorBlockPopup.classList.add('card-title__colors-active')
                })
            }
        })
    }
}

makeRadiobuttonWeight()
function makeRadiobuttonWeight() {
    const cardTitleWeights = document.querySelectorAll('.card-title__characteristic-wrapper .card-title__weights a')
    const cardTitleWeightsPopup = document.querySelectorAll('.order-color .card-title__weights a')
    if (cardTitleWeights) {
        cardTitleWeights.forEach(item => {
            item.addEventListener('click', event => {
                document.querySelectorAll('.card-title__characteristic-wrapper .card-title__weights-active').forEach(element => {
                    element.classList.remove('card-title__weights-active')
                })
                item.classList.add('card-title__weights-active')
            })
        })
    }
    if (cardTitleWeightsPopup) {
        cardTitleWeightsPopup.forEach(item => {
            item.addEventListener('click', event => {
                document.querySelectorAll('.order-color .card-title__weights-active').forEach(element => {
                    element.classList.remove('card-title__weights-active')
                })
                item.classList.add('card-title__weights-active')
            })
        })
    }
}
// Аккордион в фильтре

filterAccordion();
function filterAccordion() {
    $('.filter__item_title').on('click', function (e) {
        e.preventDefault();
        var $this = $(this).closest('.filter__item');
        $this.find('.filter__item-wrapper').slideToggle(300);
        $this.find('.filter__item_title').toggleClass('filter__item_closed');
    });
}

// Аккордеон внутри аккордиона в фильтре

filterAccordionInside();
function filterAccordionInside() {
    $('.filter__more').on('click', function (e) {
        e.preventDefault();
        var $this = $(this).closest('.filter__item-wrapper');
        var $filterMore = $this.find('.filter__more')
        $filterMore.toggleClass('filter__more_closed');
        $this.find('.filter__item-wrapper_second').slideToggle({
            duration: 0,
            complete: function () {
                if ($filterMore.hasClass('filter__more_closed')) {
                    $filterMore.text('Скрыть')
                    $(this).css('display', 'contents');
                } else {
                    $filterMore.text('Ещё')
                }
            }
        });
    });
}

// Аккордеон в контактах

contactsAccordion();
function contactsAccordion() {
    $('.contacts__route-title').on('click', function (e) {
        e.preventDefault();
        var $this = $(this).closest('.contacts__route');
        $this.find('.contacts__route-wrapper').slideToggle(300);
        $this.find('.contacts__route-title').toggleClass('contacts__route-title_open');
    });
}

// Filter

getFilters()
function getFilters() {
    const pageMainWrapper = document.querySelector('.page-main__wrapper')
    const mainFilter = document.querySelector('.page-main__filter')
    if (pageMainWrapper && mainFilter) {
        const filter = mainFilter.querySelector('.filter')
        const selectFilter = mainFilter.querySelectorAll('.filter__input[type="checkbox"]')
        const filterSelectedWrapper = filter.querySelector('.filter__selected_wrapper')
        const filterSelected = filter.querySelector('.filter__selected')
        const filterClear = mainFilter.querySelector('.filter__clear')

        selectFilter.forEach(item => {
            item.addEventListener('change', event => {
                getFilter()
            })
        })

        getFilter()

        function getFilter() {
            if (filter) {
                const filterInput = filter.querySelectorAll('.filter__input[type="checkbox"]:checked')

                if(filterInput.length < 1) {
                    filterSelected.classList.add('filter__hidden')
                    pageMainWrapper.classList.remove('page-main__filter_close')
                }

                filterSelectedWrapper.innerHTML = ''
                filterInput.forEach(element => {
                    filterSelected.classList.remove('filter__hidden')
                    const button = document.createElement('button')
                    button.type = 'button'
                    button.dataset.target = '#' + element.id
                    button.innerHTML = element.nextElementSibling.innerText
                    button.classList.add('filter__select')
                    filterSelectedWrapper.append(button)
                })

                filterSelectedWrapper.addEventListener('click', function (e) {
                    if (e.target.matches('.filter__select') && e.target.matches('button[data-target]')) {
                        const targetId = e.target.dataset.target
                        const target = document.querySelector(targetId)
                        if (target.checked) {
                            target.checked = !target.checked
                        }
                        const event = new Event('change', { bubbles: true })
                        target.dispatchEvent(event)
                        e.target.remove()
                        if (typeof runFilter === 'function') {
                            runFilter()
                        }
                    }
                })

                filterClear.addEventListener('click', () => {
                    filterSelected.classList.add('filter__hidden')
                    pageMainWrapper.classList.remove('page-main__filter_close')
                    filterSelectedWrapper.innerHTML = ''
                    filterInput.forEach(item => {
                        item.checked = false
                    })
                    if (typeof runFilter === 'function') {
                        runFilter()
                    }
                })
            }
        }

        const filterMobileOpen = document.querySelector('.page-main__control-filter')
        const filterMobileClose = document.querySelector('.filter__cancel')
        const setFilter = mainFilter.querySelector('#set_filter')

        if (queryMobile1200.matches) {
            const filterSelect = document.querySelector('.filter__selected_wrapper > .filter__select')
            if (filterSelect && !pageMainWrapper.classList.contains('page-main__filter_open')) {
                mainFilter.classList.remove('display-on')
                pageMainWrapper.classList.add('page-main__filter_close')
            } else if (filterSelect && pageMainWrapper.classList.contains('page-main__filter_open')) {
                pageMainWrapper.classList.remove('page-main__filter_close')
            } else {
                mainFilter.classList.remove('display-on')
            }
        }

        if (filterMobileOpen && filterMobileClose) {
            filterMobileOpen.addEventListener('click', event => {
                mainFilter.classList.add('display-on')
                pageMainWrapper.classList.add('page-main__filter_open')
                pageMainWrapper.classList.remove('page-main__filter_close')
            })
            filterMobileClose.addEventListener('click', event => {
                const filterSelect = document.querySelector('.filter__selected_wrapper > .filter__select')
                pageMainWrapper.classList.remove('page-main__filter_open')
                if (filterSelect) {
                    mainFilter.classList.remove('display-on')
                    pageMainWrapper.classList.add('page-main__filter_close')
                } else {
                    mainFilter.classList.remove('display-on')
                }
            })
            setFilter.addEventListener('click', event => {
                const filterSelect = document.querySelector('.filter__selected_wrapper > .filter__select')
                pageMainWrapper.classList.remove('page-main__filter_open')
                if (filterSelect) {
                    mainFilter.classList.remove('display-on')
                    pageMainWrapper.classList.add('page-main__filter_close')
                } else {
                    mainFilter.classList.remove('display-on')
                }
            })
        }
    }
}



// Сортировка товаров по цене
const buttonSort = document.querySelector('.products__button-sort')

if (buttonSort) {
    buttonSort.addEventListener('click', () => {
        buttonSort.classList.toggle('products__button-sort_on')
    })
}

// Аккордион в футере
if (document.querySelector('.footer-main__title')) {
    if (queryMobile768.matches) {
        footerAccordion();
    }
}

function footerAccordion() {
    $('.footer-main__title').on('click', function (e) {
        e.preventDefault();
        var $this = $(this).closest('.footer-main__wrapper');
        $this.find('.footer-main__list').slideToggle(300);
        $this.find('.footer-main__title').toggleClass('footer-main__title-closed');
    });
}

if (queryMobile1200.matches) {
    showHeader();
}
function showHeader() {
    $('.header__button-catalog').on('click', function (e) {
        e.preventDefault();
        var $body = $('body');
        var $mobileMenu = $('.header-dropdown');
        if (!$body.hasClass('header-mobile-menu-active')) {
            $body.addClass('header-mobile-menu-active');
            $('.wrapper').append($("<div></div>").addClass('header-dropdown__overlay'));
            $mobileMenu.slideDown(300);
        }
        else {
            $body.removeClass('header-mobile-menu-active');
            $('.header-dropdown__overlay').remove();
            $mobileMenu.slideUp(300);
        }
    });
}
closeHeaderMenu()
function closeHeaderMenu() {
    $('.header-dropdown__close').on('click', function (e) {
        e.preventDefault();
        var $body = $('body');
        var $mobileMenu = $('.header-dropdown');
        $body.removeClass('header-mobile-menu-active');
        $('.header-dropdown__overlay').remove();
        $mobileMenu.slideUp(300);
    });
}

// Выравнивание блоков по высоте

alignHeightElements()
function alignHeightElements() {
    const topBanner = document.querySelector('.top-banner')
    const analogList = document.querySelector('.analog__list')
    const viewedList = document.querySelector('.viewed__list')
    const relatedList = document.querySelector('.related__list')
    const dropdownList = document.querySelector('.header__dropdown-list')
    const popularList = document.querySelector('.popular__list')
    const productsGroutsList = document.querySelector('.products-grouts__list')
    const productsMapeiList = document.querySelector('.products-mapei__list')

    if (topBanner) {
        if (queryMobile1200.matches) {
            window.addEventListener('load', () => someHight(topBanner, '.top-banner__title'))
            window.addEventListener('load', () => someHight(topBanner, '.top-banner__slide'))
        }
    }
    if (analogList) {
        window.addEventListener('load', () => someHight(analogList, '.analog__image'))
    }
    if (viewedList) {
        window.addEventListener('load', () => someHight(viewedList, '.viewed__image'))
    }
    if (relatedList) {
        window.addEventListener('load', () => someHight(relatedList, '.related__image'))
    }

    if (popularList) {
        window.addEventListener('load', () => someHight(popularList, '.product__image'))
        window.addEventListener('load', () => someHight(popularList, '.product__title'))
    }
    if (productsGroutsList) {
        window.addEventListener('load', () => someHight(productsGroutsList, '.product__image'))
        window.addEventListener('load', () => someHight(productsGroutsList, '.product__title'))
    }
    if (productsMapeiList) {
        window.addEventListener('load', () => someHight(productsMapeiList, '.product__image'))
        window.addEventListener('load', () => someHight(productsMapeiList, '.product__title'))
    }
}

function alignHeightElement() {
    const topBanner = document.querySelector('.top-banner')
    const analogList = document.querySelector('.analog__list')
    const viewedList = document.querySelector('.viewed__list')
    const relatedList = document.querySelector('.related__list')
    const dropdownList = document.querySelector('.header__dropdown-list')
    const popularList = document.querySelector('.popular__list')
    const productsGroutsList = document.querySelector('.products-grouts__list')
    const productsMapeiList = document.querySelector('.products-mapei__list')

    if (topBanner) {
        if (queryMobile1200.matches) {
            someHight(topBanner, '.top-banner__title')
        }
    }
    if (analogList) {
        someHight(analogList, '.analog__image')
    }
    if (viewedList) {
        someHight(viewedList, '.viewed__image')
    }
    if (relatedList) {
        someHight(relatedList, '.related__image')
    }

    if (popularList) {
        someHight(popularList, '.product__image')
        someHight(popularList, '.product__title')
    }
    if (productsGroutsList) {
        someHight(productsGroutsList, '.product__image')
        someHight(productsGroutsList, '.product__title')
    }
    if (productsMapeiList) {
        someHight(productsMapeiList, '.product__image')
        someHight(productsMapeiList, '.product__title')
    }
}

function someHight(mainBlock, blockClass) {
    let item = mainBlock.querySelectorAll(blockClass);
    let hightItem = 0;
    for (let i = 0; i < item.length; i++) {
        if (hightItem < item[i].offsetHeight) hightItem = item[i].offsetHeight;
    }
    for (let i = 0; i < item.length; i++) {
        item[i].style.height = hightItem + 'px';
    }
}

// Ограничение по высоте
const cardCharacteristics = document.querySelector('.card-main__characteristics-list')
const cardCharacteristicsButton = document.querySelector('.card-main__characteristics-button')
const cardDescription = document.querySelector('.card-main__description-wrapper')
const cardDescriptionButton = document.querySelector('.card-main__description-button')
const cardInstruction = document.querySelector('.card-main__instruction-wrapper')
const cardInstructionButton = document.querySelector('.card-main__instruction-button')

if (cardCharacteristicsButton) {
    cardCharacteristicsButton.addEventListener('click', () => {
        hideHeight(cardCharacteristics, cardCharacteristicsButton)
    })
}
if (cardDescriptionButton) {
    cardDescriptionButton.addEventListener('click', () => {
        hideHeight(cardDescription, cardDescriptionButton)
    })
}
if (cardInstructionButton) {
    cardInstructionButton.addEventListener('click', () => {
        hideHeight(cardInstruction, cardInstructionButton)
    })
}

function hideHeight(block, button) {
    if (block) {
        if (block.classList.contains('card-main__height') && button.classList.contains('card-main__button_close')) {
            block.classList.remove('card-main__height')
            button.classList.remove('card-main__button_close')
        } else {
            block.classList.add('card-main__height')
            button.classList.add('card-main__button_close')
        }
    }
}

// Якоря в карточке товара
const observerCard = new IntersectionObserver(entries => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            document.querySelectorAll('.card-main__item > a').forEach((link) => {
                link.parentElement.classList.toggle('card-main__item_active', link.getAttribute('href').replace('#', '') === entry.target.id)
            })
        }
    })
}, { threshold: 0.5 })

document.querySelectorAll('.card-title__anchor').forEach((item) => observerCard.observe(item))

const cardMainList = document.querySelector('.card-main__list')
if (cardMainList && queryMobile1201.matches) {
    const observerCardMainList = new IntersectionObserver(
        ([e]) => e.target.classList.toggle('card-main__list_sticky', e.intersectionRatio < 1),
        { rootMargin: '-1px 0px 133px 0px', threshold: [1] }
    )
    observerCardMainList.observe(cardMainList)
}

// Якоря в контактах
const observerContact = new IntersectionObserver(entries => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            document.querySelectorAll('.contacts__item > a').forEach((link) => {
                link.parentElement.classList.toggle('contacts__item_active', link.getAttribute('href').replace('#', '') === entry.target.id)
            })
        }
    })
}, { threshold: 0.5 })

document.querySelectorAll('.contacts__address').forEach((item) => observerContact.observe(item))

// Якоря в оплате
const observerPayment = new IntersectionObserver(entries => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            document.querySelectorAll('.payment__item > a').forEach((link) => {
                link.parentElement.classList.toggle('payment__item_active', link.getAttribute('href').replace('#', '') === entry.target.id)
            })
        }
    })
}, { threshold: 0.1 })

document.querySelectorAll('.payment__type').forEach((item) => observerPayment.observe(item))

// Yandex maps
var yMapsBlockId;
yMapsBlockId = document.querySelector('#map-rumyantsevo');
if (yMapsBlockId) {
    ymaps.ready(function () {
        var myMap = new ymaps.Map('map-rumyantsevo', {
            center: [55.635225, 37.436716],
            zoom: 14,
        }, {
            searchControlProvider: 'yandex#search'
        })

        myPlacemarkFirst = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: 'Стройсервис в Румянцево'
        }, {
            iconLayout: 'default#image',
            iconImageHref: '../img/design/marker-maps.svg',
            iconImageSize: [40, 40],
            iconImageOffset: [0, 5]
        })

        myPlacemarkSecond = new ymaps.Placemark([55.615641, 37.274374], {
            hintContent: 'Стройсервис во Внуково',
        }, {
            iconLayout: 'default#image',
            iconImageHref: './img/design/marker-maps.svg',
            iconImageSize: [40, 40],
        })

        myPlacemarkFirst.events.add('click', function () {
            myMap.setCenter([55.635225, 37.436716], 14, {
                checkZoomRange: true
            });
        });
        myPlacemarkSecond.events.add('click', function () {
            myMap.setCenter([55.615641, 37.274374], 14, {
                checkZoomRange: true
            });
        });

        myMap.geoObjects
            .add(myPlacemarkFirst)
            .add(myPlacemarkSecond)
    });
}

yMapsBlockId = document.querySelector('#map-rumyan');
if (yMapsBlockId) {
    ymaps.ready(function () {
        var myMap = new ymaps.Map('map-rumyan', {
            center: [55.635225, 37.436716],
            zoom: 14
        }, {
            searchControlProvider: 'yandex#search'
        }),

            myPlacemarkFirst = new ymaps.Placemark(myMap.getCenter(), {
                hintContent: 'Стройсервис в Румянцево'
            }, {
                iconLayout: 'default#image',
                iconImageHref: '../img/design/marker-maps.svg',
                iconImageSize: [40, 40],
                iconImageOffset: [0, 5]
            }),

            myPlacemarkSecond = new ymaps.Placemark([55.615641, 37.274374], {
                hintContent: 'Стройсервис во Внуково',
            }, {
                iconLayout: 'default#image',
                iconImageHref: './img/design/marker-maps.svg',
                iconImageSize: [40, 40],
            });

        myPlacemarkFirst.events.add('click', function () {
            myMap.setCenter([55.635225, 37.436716], 14, {
                checkZoomRange: true
            });
        });
        myPlacemarkSecond.events.add('click', function () {
            myMap.setCenter([55.615641, 37.274374], 14, {
                checkZoomRange: true
            });
        });

        myMap.geoObjects
            .add(myPlacemarkFirst)
            .add(myPlacemarkSecond)
    });
}

yMapsBlockId = document.querySelector('#map-vnukovo');
if (yMapsBlockId) {
    ymaps.ready(function () {
        var myMap = new ymaps.Map('map-vnukovo', {
            center: [55.615641, 37.274374],
            zoom: 14
        }, {
            searchControlProvider: 'yandex#search'
        }),

            myPlacemarkFirst = new ymaps.Placemark(myMap.getCenter(), {
                hintContent: 'Стройсервис во Внуково'
            }, {
                iconLayout: 'default#image',
                iconImageHref: '../img/design/marker-maps.svg',
                iconImageSize: [40, 40],
                iconImageOffset: [0, 5]
            }),

            myPlacemarkSecond = new ymaps.Placemark([55.635225, 37.436716], {
                hintContent: 'Стройсервис в Румянцево',
            }, {
                iconLayout: 'default#image',
                iconImageHref: './img/design/marker-maps.svg',
                iconImageSize: [40, 40],
            });

        myPlacemarkFirst.events.add('click', function () {
            myMap.setCenter([55.615641, 37.274374], 14, {
                checkZoomRange: true
            });
        });
        myPlacemarkSecond.events.add('click', function () {
            myMap.setCenter([55.635225, 37.436716], 14, {
                checkZoomRange: true
            });
        });

        myMap.geoObjects
            .add(myPlacemarkFirst)
            .add(myPlacemarkSecond)
    });
}

// Header меню
const headerButtonCatalog = document.querySelector('.header__button-catalog')
const headerCatalog = document.querySelector('.header__catalog')
const headerCatalogOverlay = document.querySelector('.header-catalog__overlay')
const headerDropdown = document.querySelector('.header-dropdown')
const headerButtonCatalogMobile = document.querySelector('.header-dropdown__catalog')
const categoryItem = document.querySelectorAll('.category-item')
const catalogs = document.querySelectorAll('.catalogs')
const headerCatalogClose = document.querySelector('.header__catalog-close')
const categoryList = document.querySelector('.category-list')

if (headerCatalog && queryMobile1201.matches) {
    headerButtonCatalog.addEventListener('click', (e) => {
        e.stopPropagation();
        const footerHeight = document.querySelector('.footer').offsetHeight
        headerButtonCatalog.classList.toggle('header__button-catalog_active');
        headerCatalog.classList.toggle('header__catalog_none');
        headerCatalogOverlay.style.height = `calc(100% + ${footerHeight}px)`
        headerCatalogOverlay.classList.toggle('display-on');
        if (headerCatalog.classList.contains('header__catalog_none')) {
            resetDropdownCatalog();
        }
    });

    categoryItem.forEach(function (item, number) {
        item.onmouseenter = function (event) {
            categoryItem.forEach(function (item, number) {
                if (item.classList.contains('category-item_active')) {
                    item.classList.remove('category-item_active');
                }
            });
            catalogs.forEach(function (item, number) {
                item.style.display = 'none';
            });
            catalogs[number].style.display = 'block';
            item.classList.add('category-item_active');
        };
        // item.onmouseleave = function (event) {
        //     item.classList.remove('category-item_active');
        //     catalogs[number].style.display = 'none';
        // };
    });

    headerCatalog.onclick = function (e) {
        e.stopPropagation();
    };

    document.onclick = function (e) {
        if (!headerCatalog.classList.contains('header__catalog_none')) {
            headerButtonCatalog.classList.remove('header__button-catalog_active');
            headerCatalog.classList.add('header__catalog_none');
            headerCatalogOverlay.classList.remove('display-on');
            resetDropdownCatalog();
        }
    };

    function resetDropdownCatalog() {
        categoryItem.forEach(function (item, number) {
            if (item.classList.contains('category-item_active')) {
                item.classList.remove('category-item_active');
            }
        });
        catalogs.forEach(function (item, number) {
            item.style.display = 'none';
        });
        catalogs[0].style.display = 'block';
        categoryItem[0].classList.add('category-item_active');
    }
}
if (headerCatalog && headerDropdown && queryMobile1200.matches) {
    const catalogsClose = headerCatalog.querySelectorAll('.catalogs button')

    headerButtonCatalogMobile.addEventListener('click', (e) => {
        e.preventDefault()
        headerCatalog.classList.remove('header__catalog_none')
        headerDropdown.style.display = 'none'
        headerCatalogOverlay.classList.add('display-on')
        categoryItem.forEach(function (item) {
            item.classList.remove('category-item_active')
        })
        catalogs.forEach((item) => {
            item.style.display = 'none'
        })
    })
    headerCatalogClose.addEventListener('click', (e) => {
        e.preventDefault()
        headerCatalog.classList.add('header__catalog_none')
        headerDropdown.style.display = 'block'
        headerCatalogOverlay.classList.remove('display-on')
        categoryList.classList.remove('display-none')
    })
    categoryItem.forEach(function (item, number) {
        item.addEventListener('click', (e) => {
            if(catalogs[number].classList.contains('display-none')) {
            } else {
                e.preventDefault()
                catalogs[number].style.display = 'flex'
                categoryList.classList.add('display-none')
            }
        })
    })
    catalogsClose.forEach((item, number) => {
        item.addEventListener('click', (e) => {
            e.preventDefault()
            catalogs[number].style.display = 'none'
            categoryList.classList.remove('display-none')
        })
    })
}

// Логика работы табов лк.
const tabsInit = () => {
    const links = document.querySelectorAll('[data-tabslink]');
    for (let link of links) {
        link.addEventListener('click', e => {
            e.preventDefault();
            if ($(link).parent().hasClass('swiper-slide')) {
                for (let sibling of link.parentNode.parentNode.children) {
                    sibling.classList.remove('c-tabs__active')
                }
            }
            else {
                for (let sibling of link.parentNode.children) {
                    sibling.classList.remove('c-tabs__active')
                }
            }
            const elem = document.querySelector(`[data-tabsitem="${e.currentTarget.dataset.tabslink}"]`)
            if (elem !== null) {
                if ($(link).parent().hasClass('swiper-slide')) {
                    link.parentNode.classList.add('c-tabs__active')
                } else {
                    link.classList.add('c-tabs__active')
                }
                for (let sibling of elem.parentNode.children) {
                    sibling.classList.remove('c-tabs__list-item--open')
                }
                elem.classList.add('c-tabs__list-item--open')
            } else {
                console.log(`tabs attr error for mark: "${e.currentTarget.dataset.tabslink}"`)
            }
        })
    }
    const Swipes = new Swiper('.c-tabs__mob-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 20,
    });
}

tabsInit()

// Часто задаваемые вопросы
faqAccordion();
function faqAccordion() {
    const faq = true
    $('.faq').on('click', '.faq__name', function (e) {
        e.preventDefault();
        var $this = $(this).closest('.faq__name');
        $this.find('.faq__wrapper').slideToggle(300);
        $this.find('.faq__question').toggleClass('faq__question_open');
    });
}

// Оформление заказа
orderAccordion();
function orderAccordion() {
    $('.order__section-title').on('click', function (e) {
        e.preventDefault();
        var $this = $(this).closest('.order__section');
        $this.find('.order__body').slideToggle(300);
        $this.find('.order__section-title').toggleClass('order__section_open');
    });
}

// Выбрать все элементы в корзине
const basketAll = document.getElementById('basket__all')
const basketGoodsList = document.querySelector('.basket__goods')
if (basketGoodsList) {
    const basketGoodsItems = basketGoodsList.querySelectorAll('.basket__item')
    if (basketAll) {
        basketAll.onchange = function () {
            if (basketAll.checked) {
                basketGoodsItems.forEach(function (element) {
                    element.querySelector('input').checked = true
                })
            } else {
                basketGoodsItems.forEach(function (element) {
                    element.querySelector('input').checked = false
                })
            }
        }
    }

    // Временные id в корзине
    basketGoodsItems.forEach(function (element, number) {
        element.querySelector('#basket-item').id = '#basket-item-' + number
        element.querySelector('label').htmlFor = '#basket-item-' + number
    })

    // Удалить товар из корзины
    const basketButtonsDelete = document.querySelectorAll('.basket__item-button')
    if (basketButtonsDelete) {
        basketButtonsDelete.forEach(function (element, number) {
            element.addEventListener('click', () => {
                basketGoodsList.removeChild(basketGoodsItems[number])
            })
        })
    }
}

// Отслеживание количества товаров
const totalQuantity = document.querySelector('.basket__total-quantity')
const totalNumber = document.querySelector('.basket__mobile-number')
const orderFastQuantity = document.querySelector('.order-fast__total-quantity')

if (totalQuantity && basketGoodsList && totalNumber) {
    totalQuantity.innerText = basketGoodsList.querySelectorAll('.basket__item').length
    totalNumber.innerText = basketGoodsList.querySelectorAll('.basket__item').length
    const observerQuantity = new MutationObserver(mutations => {
        totalQuantity.innerText = basketGoodsList.querySelectorAll('.basket__item').length
        totalNumber.innerText = basketGoodsList.querySelectorAll('.basket__item').length
    })
    observerQuantity.observe(basketGoodsList, { childList: true })
}
if (orderFastQuantity && basketGoodsList) {
    orderFastQuantity.innerText = basketGoodsList.querySelectorAll('.basket__item').length
}

// Отслеживание корзины товаров
const basketMobile = document.querySelector('.basket__mobile')
const basketTotal = document.querySelector('.basket__total')

// Popup Быстрый заказ
const orderFastPopup = document.querySelector('.order-fast')
const buttonFastOrder = document.querySelector('.basket__button-fast-order')
const buttonFastOrderCardCheck = document.querySelector('.card-title__fast-order')
initPopupOrderFast()
function initPopupOrderFast() {
    if (orderFastPopup && buttonFastOrder) {
        const buttonOneClick = document.querySelector('.basket__button-one-click')
        const orderFastClose = document.querySelector('.order-fast__popup_close')
        openPopup(orderFastPopup, buttonFastOrder, orderFastClose)
        buttonOneClick.addEventListener('click', (event) => {
            event.preventDefault()
            orderFastPopup.classList.add('display-on')
            overlay.classList.add('display-on')
        })
    }
    if (orderFastPopup && buttonFastOrderCardCheck) {
        const orderFastClose = document.querySelector('.order-fast__popup_close')
        openPopup(orderFastPopup, buttonFastOrderCardCheck, orderFastClose)
    }
}

// Popup аналогичный товар
const orderAnalogPopup = document.querySelector('.order-analog')
const buttonAnalog = document.querySelectorAll('.product__analog')
const cardEndedAnalogCheck = document.querySelector('.card-title__ended-analog')
initPopupOrderAnalog()
function initPopupOrderAnalog() {
    if (orderAnalogPopup && buttonAnalog) {
        const orderAnalogClose = orderAnalogPopup.querySelector('.popup-form__popup_close')
        buttonAnalog.forEach((element) => {
            openPopup(orderAnalogPopup, element, orderAnalogClose)
        })
    }
    if (orderAnalogPopup && cardEndedAnalogCheck) {
        const orderAnalogClose = orderAnalogPopup.querySelector('.popup-form__popup_close')
        openPopup(orderAnalogPopup, cardEndedAnalogCheck, orderAnalogClose)
    }
}

// Popup оптовая цена
const orderWholesalePopup = document.querySelector('.order-wholesale')
const buttonWholesaleCheck = document.querySelector('.card-title__buy-wholesale')
initPopupOrderWholesale()
function initPopupOrderWholesale() {
    if (orderWholesalePopup && buttonWholesaleCheck) {
        const orderWholesaleClose = orderWholesalePopup.querySelector('.popup-form__popup_close')
        openPopup(orderWholesalePopup, buttonWholesaleCheck, orderWholesaleClose)
    }
}

// Popup товар на заказ
const orderOrderPopup = document.querySelector('.order-order')
const buttonOrder = document.querySelectorAll('.product__order')
const cardOrderCheck = document.querySelector('.card-title__buy')
const cardPriceQuantity = document.querySelector('.card-title__price-quantity span')
initPopupOrderOrder()
function initPopupOrderOrder() {
    if (orderOrderPopup && cardOrderCheck) {
        const orderOrderClose = orderOrderPopup.querySelector('.popup-form__popup_close')
        buttonOrder.forEach((element) => {
            openPopup(orderOrderPopup, element, orderOrderClose)
        })
    }
    if (orderOrderPopup && cardOrderCheck && cardPriceQuantity) {
        let cardPriceQuantityNumber = cardPriceQuantity.innerText
        cardPriceQuantityNumber = parseInt(cardPriceQuantityNumber.match(/\d+/))
        if (cardPriceQuantityNumber < 1) {
            const orderOrderClose = orderOrderPopup.querySelector('.popup-form__popup_close')
            openPopup(orderOrderPopup, cardOrderCheck, orderOrderClose)
        }
    }
}

// Popup купить товар
initPopupOrderCard()
function initPopupOrderCard() {
    const orderCardPopup = document.querySelector('.order-card')
    if (orderCardPopup && cardOrderCheck && cardPriceQuantity) {
        let cardPriceQuantityNumber = cardPriceQuantity.innerText
        cardPriceQuantityNumber = parseInt(cardPriceQuantityNumber.match(/\d+/))
        if (cardPriceQuantityNumber > 1) {
            const orderOrderClose = orderCardPopup.querySelector('.popup-form__popup_close')
            openPopup(orderCardPopup, cardOrderCheck, orderOrderClose)
        }
    }
}

// Popup карточки товара
initPopupToCard()
function initPopupToCard() {
    const orderCardPopup = document.querySelector('.order-card')
    const cardRadioButton = document.querySelectorAll('.order-card__form-wrapper input')
    if (orderCardPopup && cardRadioButton) {
        const orderCardPopupInputs = orderCardPopup.querySelectorAll('.form__input')
        cardRadioButton.forEach((element, number) => {
            element.onchange = () => {
                if (number === 0) {
                    orderCardPopupInputs[0].classList.add('order-individual__name')
                    orderCardPopupInputs[1].classList.add('display-none')
                }
                if (number === 1) {
                    orderCardPopupInputs[0].classList.remove('order-individual__name')
                    orderCardPopupInputs[1].classList.remove('display-none')
                }
            }
        })
    }
}

// Popup авторизация
const authorizationPopup = document.querySelector('.popup-authorization')
const registrationPopup = document.querySelector('.popup-registration')
const headerEnter = document.querySelector('.header__enter')
const headerRegistration = document.querySelector('.header__registration')
const headerEnterMobile = document.querySelector('.header__enter_mobile')
const headerRegistrationMobile = document.querySelector('.header__registration_mobile')
const linkCreate = document.querySelector('.popup-authorization .popup-authorization__link-create')
const linkLogin = document.querySelector('.popup-registration .popup-authorization__link-create')
const loyalRegistration = document.querySelector('.loyal-registration')
const orderBonusPopup = document.querySelector('.order-bonus')
const bonusRegistration = document.querySelector('.order-bonus-registration')

initPopupAuthorization()
function initPopupAuthorization() {
    if (authorizationPopup && registrationPopup && headerEnter && linkCreate && headerRegistration && linkLogin && headerEnterMobile && headerRegistrationMobile) {
        const authorizationClose = authorizationPopup.querySelector('.popup-form__popup_close')
        headerEnter.addEventListener('click', (event) => {
            event.preventDefault()
            authorizationPopup.classList.add('display-on')
            overlay.classList.add('display-on')
        })
        headerEnterMobile.addEventListener('click', (event) => {
            event.preventDefault()
            authorizationPopup.classList.add('display-on')
            overlay.classList.add('display-on')
        })
        authorizationClose.addEventListener('click', (event) => {
            event.preventDefault()
            authorizationPopup.classList.remove('display-on')
            overlay.classList.remove('display-on')
        })
        window.addEventListener("keydown", function (event) {
            if (event.keyCode === 27) {
                event.preventDefault()
                authorizationPopup.classList.remove('display-on')
                overlay.classList.remove('display-on')
            }
        })
        linkCreate.addEventListener('click', event => {
            event.preventDefault()
            authorizationPopup.classList.remove('display-on')
            registrationPopup.classList.add('display-on')
        })
    }
}

initPopupRegistration()
function initPopupRegistration() {
    if (authorizationPopup && registrationPopup && headerEnter && linkCreate && headerRegistration && linkLogin && headerEnterMobile && headerRegistrationMobile) {
        const registrationClose = registrationPopup.querySelector('.popup-form__popup_close')
        headerRegistration.addEventListener('click', (event) => {
            event.preventDefault()
            registrationPopup.classList.add('display-on')
            overlay.classList.add('display-on')
        })
        if (loyalRegistration) {
            loyalRegistration.addEventListener('click', (event) => {
                event.preventDefault()
                registrationPopup.classList.add('display-on')
                overlay.classList.add('display-on')
            })
        }
        if (bonusRegistration && orderBonusPopup) {
            bonusRegistration.addEventListener('click', (event) => {
                event.preventDefault()
                orderBonusPopup.classList.remove('display-on')
                registrationPopup.classList.add('display-on')
                overlay.classList.add('display-on')
            })
        }
        headerRegistrationMobile.addEventListener('click', (event) => {
            event.preventDefault()
            registrationPopup.classList.add('display-on')
            overlay.classList.add('display-on')
        })
        registrationClose.addEventListener('click', (event) => {
            event.preventDefault()
            registrationPopup.classList.remove('display-on')
            overlay.classList.remove('display-on')
        })
        window.addEventListener("keydown", function (event) {
            if (event.keyCode === 27) {
                event.preventDefault()
                registrationPopup.classList.remove('display-on')
                overlay.classList.remove('display-on')
            }
        })
        linkLogin.addEventListener('click', event => {
            event.preventDefault()
            registrationPopup.classList.remove('display-on')
            authorizationPopup.classList.add('display-on')
        })
    }
}

selectOrderSection()
function selectOrderSection() {
    const orderSectionRadioButton = document.querySelectorAll('.order__type input')
    const orderSectionRadioInput = document.querySelectorAll('.order__buyer .form__input')
    if (orderSectionRadioButton && orderSectionRadioInput) {
        orderSectionRadioButton.forEach((element, number) => {
            element.onchange = () => {
                if (number === 0) {
                    orderSectionRadioInput[0].classList.remove('order__input-name')
                    orderSectionRadioInput[1].classList.remove('display-none')
                }
                if (number === 1) {
                    orderSectionRadioInput[0].classList.add('order__input-name')
                    orderSectionRadioInput[1].classList.add('display-none')
                }
            }
        })
    }
}

// Popup товар добавлен в корзину
const orderBasketPopup = document.querySelector('.order-basket')
const productBottoms = document.querySelectorAll('.product__add_basket')
initPopupToBasket()
function initPopupToBasket() {
    const orderBasketPopup = document.querySelector('.order-basket')
    if (orderBasketPopup && productBottoms) {
        const orderBasketPopupClose = orderBasketPopup.querySelector('.popup-form__popup_close')
        productBottoms.forEach((element) => {
            openPopup(orderBasketPopup, element, orderBasketPopupClose)
        })
    }
}

const continueShoppingButton = document.querySelector('.order-basket__wrapper > .button-grey')
continueShopping()
function continueShopping() {
    if (orderBasketPopup && continueShoppingButton) {
        continueShoppingButton.addEventListener('click', (event) => {
            event.preventDefault()
            orderBasketPopup.classList.remove('display-on')
            overlay.classList.remove('display-on')
        })
    }
}

function openPopup(popupName, buttonOpen, buttonClose) {
    buttonOpen.addEventListener('click', (event) => {
        event.preventDefault()
        popupName.classList.add('display-on')
        overlay.classList.add('display-on')
    })
    buttonClose.addEventListener('click', (event) => {
        event.preventDefault()
        popupName.classList.remove('display-on')
        overlay.classList.remove('display-on')
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault()
            popupName.classList.remove('display-on')
            overlay.classList.remove('display-on')
        }
    })
}

// Popup бонусы
const productBonusButton = document.querySelectorAll('.product__bonus_help')
const relatedBonusButton = document.querySelectorAll('.related__bonus_help')
const analogBonusButton = document.querySelectorAll('.analog__bonus_help')
const recommendationBonusButton = document.querySelectorAll('.recommendation__bonus_help')

if (orderBonusPopup && productBonusButton) {
    const orderBonusPopupClose = orderBonusPopup.querySelector('.popup-form__popup_close')
    productBonusButton.forEach((element) => {
        openPopup(orderBonusPopup, element, orderBonusPopupClose)
    })
}
if (orderBonusPopup && relatedBonusButton) {
    const orderBonusPopupClose = orderBonusPopup.querySelector('.popup-form__popup_close')
    relatedBonusButton.forEach((element) => {
        openPopup(orderBonusPopup, element, orderBonusPopupClose)
    })
}
if (orderBonusPopup && analogBonusButton) {
    const orderBonusPopupClose = orderBonusPopup.querySelector('.popup-form__popup_close')
    analogBonusButton.forEach((element) => {
        openPopup(orderBonusPopup, element, orderBonusPopupClose)
    })
}
if (orderBonusPopup && recommendationBonusButton) {
    const orderBonusPopupClose = orderBonusPopup.querySelector('.popup-form__popup_close')
    recommendationBonusButton.forEach((element) => {
        openPopup(orderBonusPopup, element, orderBonusPopupClose)
    })
}

// Popup Сертификат
const popupCertificate = document.querySelector('.popup-certificate')
const buttonCardCertificate = document.querySelector('.card-title__characteristics-certificate')

Fancybox.bind("[data-fancybox]", {
    Toolbar: {
        display: {
            left: [],
            middle: [],
            right: [ "close" ]
        }
    },
    Thumbs: false
});

Fancybox.bind(".card-title__image  [data-fancybox]", {
    Toolbar: {
        display: {
            Navigation: true,
            right: [ "close" ]
        }
    },
    Thumbs: true
});

Fancybox.bind(".reviews  [data-fancybox]", {
    Toolbar: {
        display: {
            Navigation: true,
            right: [ "close" ]
        }
    },
    Thumbs: true
});

Fancybox.bind(".stories  [data-fancybox]", {
    Toolbar: {
        display: {
            Navigation: true,
            right: [ "close" ]
        }
    },
    Thumbs: true
});

// Стилизация селекторов

$(function () {
    $('select').selectric({
        onOpen: function () {
            $('.selectric .label').addClass('products__button-sort_on')
        },
        onClose: function () {
            $('.selectric .label').removeClass('products__button-sort_on')
        }
    });
});

// Слайдер в карточке товара

let hvrSliderCards = true
hvrSliderCard()
function hvrSliderCard() {
    if (hvrSliderCards === true) {
        hvrSliderCards = false
        class HvrSlider {
            constructor(selector) {
                const elements = document.querySelectorAll(selector);
                elements.forEach((el) => {
                    if (el.querySelectorAll('img').length > 1) {
                        const hvr = document.createElement('div');
                        hvr.classList.add('hvr');

                        const hvrImages = document.createElement('div');
                        hvrImages.classList.add('hvr__images');
                        hvr.appendChild(hvrImages);

                        const hvrSectors = document.createElement('div');
                        hvrSectors.classList.add('hvr__sectors');
                        hvrImages.appendChild(hvrSectors);

                        const hvrDots = document.createElement('div');
                        hvrDots.classList.add('hvr__dots');
                        hvr.appendChild(hvrDots);

                        el.parentNode.insertBefore(hvr, el);
                        hvrImages.prepend(el);

                        const hvrImagesArray = hvr.querySelectorAll('img');
                        hvrImagesArray.forEach(() => {
                            hvrSectors.insertAdjacentHTML('afterbegin', '<div class="hvr__sector"></div>');
                            hvrDots.insertAdjacentHTML('afterbegin', '<div class="hvr__dot"></div>');
                        });
                        hvrDots.firstChild.classList.add('hvr__dot--active');
                        const setActiveEl = function (targetEl) {
                            const index = [...hvrSectors.children].indexOf(targetEl);
                            hvrImagesArray.forEach((img, idx) => {
                                if (index == idx) {
                                    img.style.display = 'block';
                                } else {
                                    img.style.display = 'none';
                                }
                            });
                            hvr.querySelectorAll('.hvr__dot').forEach((dot, idx) => {
                                if (index == idx) {
                                    dot.classList.add('hvr__dot--active');
                                } else {
                                    dot.classList.remove('hvr__dot--active');
                                }
                            });
                        };
                        hvrSectors.addEventListener('mouseover', function (e) {
                            if (e.target.matches('.hvr__sector')) {
                                setActiveEl(e.target);
                            }
                        });
                        hvrSectors.addEventListener('touchmove', function (e) {
                            const position = e.changedTouches[0];
                            const target = document.elementFromPoint(position.clientX, position.clientY);
                            if (target.matches('.hvr__sector')) {
                                setActiveEl(target);
                            }
                        });
                        hvrSectors.addEventListener('mouseleave', function (e) {
                            hvrImagesArray.forEach(img => {
                                img.style.display = 'none';
                            })
                            hvr.querySelectorAll('.hvr__dot').forEach(dot => {
                                dot.classList.remove('hvr__dot--active')
                            })
                            hvrImagesArray[0].style.display = 'block';
                            hvr.querySelectorAll('.hvr__dot')[0].classList.add('hvr__dot--active')
                        })
                    }
                });
            }
        }

        new HvrSlider('.product__image-wrapper');
    }
}

// Загрузка файла input в форме

/*function processSelectedFiles(fileInput, classNameBlock, classNameInput) {

    let labelFileName = document.querySelector(`${classNameBlock} ${classNameInput}`)
    labelFileName.innerText = 'Загрузить файл'
    let files = fileInput.files

    for (let i = 0; i < files.length; i++) {
        labelFileName.innerText = files[i].name
    }
}*/

// Поиск
const search = document.querySelector('.header__search_searching')
const searchForm = document.querySelector('.search__form-wrapper')
const searchInput = document.querySelector('.search__input')
const searchWrapper = document.querySelector('.search__wrapper')
const searchCancel = document.querySelector('.search__form-cancel')
searching()
function searching() {
    if (search && searchForm && searchInput && searchWrapper && searchCancel) {
        search.addEventListener('click', (event) => {
            event.stopPropagation()
            searchForm.classList.remove('display-none')
        })
        searchCancel.addEventListener('click', (event) => {
            event.preventDefault()
            searchForm.classList.add('display-none')
            searchWrapper.classList.add('display-none')
        })
        window.addEventListener("keydown", function (event) {
            if (event.keyCode === 27) {
                event.preventDefault()
                searchWrapper.classList.add('display-none')
            }
        })
        document.addEventListener('click', event => {
            if (!event.target.closest('.search__form-wrapper')) {
                searchForm.classList.add('display-none')
            }
        })
    }
}

$(".review-popup__wrapper-stars span").hover(e => {
    const parent = $(e.currentTarget).closest('.review-popup__star-input')
    if (!parent.hasClass('reviewed')) {
        const rating = e.currentTarget.dataset.rating;
        const elements = $(e.currentTarget).parent().children();
        for (let i = 0; i < rating; i++) {
            $(elements[i]).addClass('star-fill')
        }
    }
}, e => {
    const parent = $(e.currentTarget).closest('.review-popup__star-input')
    if (!parent.hasClass('reviewed')) {
        const elements = $(e.currentTarget).parent().children();
        elements.each((z, x) => $(x).removeClass('star-fill'))
    }
})
$(".review-popup__wrapper-stars span").click(e => {
    const parent = $(e.currentTarget).closest('.review-popup__star-input')
    const rating = e.currentTarget.dataset.rating;
    const input = parent.find(".js--review-star-rating");
    const elements = $(e.currentTarget).parent().children();
    elements.each((z, x) => $(x).removeClass('star-fill'))
    for (let i = 0; i < rating; i++) {
        $(elements[i]).addClass('star-fill')
    }
    parent.addClass("reviewed");
    input.val(rating);
})
$(".card-main__reviews-button").click(e => {
    const basket = $('.review-popup')
    basket.addClass('display-on');
    $('.overlay').addClass('display-on');
    const closeBtn = basket.find(".popup-form__popup_close")
    closeBtn.on('click', e => {
        basket.removeClass('display-on')
        $('.overlay').removeClass('display-on')
    })
    window.addEventListener("keydown", function (event) {
        if (event.keyCode === 27) {
            event.preventDefault()
            basket.removeClass('display-on')
            $('.overlay').removeClass('display-on')
        }
    })
})

$("input[type='file']").on('change', function() {
    this.parentNode.querySelector('button').classList.remove('display-none')

    let nameFile = ''
    for (let i = 0; i < this.files.length; i++) {
        if (i === (this.files.length-1)) {
            nameFile += this.files[i].name
            break
        }
        nameFile += this.files[i].name + '; '
    }

    this.parentNode.querySelector('.meeting-form__placeholder').innerText = nameFile
})
$(".delete-file").on('click', function() {
    this.parentNode.querySelector('.meeting-form__placeholder').innerText = "Загрузить файл"
    this.parentNode.querySelector('input[type="file"]').value = ''
    $(this).addClass('display-none')
})